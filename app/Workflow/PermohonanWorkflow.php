<?php

namespace App\Workflow;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Workflow;
use App\Models\Task;
use App\Models\Pendaftar;
use App\Models\PendaftarKetenagakerjaan;
use App\Models\PendaftarLingkungan;
use App\Models\PendaftarPembangunan;
use App\Models\PendaftarPerusahaan;
use App\Models\PendaftarProfesi;
use App\Models\PendaftarReklame;
use App\Models\PendaftarTransportasi;
use App\Models\Permohonan;
use App\Models\PermohonanPendaftar;
use App\Models\PermohonanKetenagakerjaan;
use App\Models\PermohonanLingkungan;
use App\Models\PermohonanPembangunan;
use App\Models\PermohonanPerusahaan;
use App\Models\PermohonanProfesi;
use App\Models\PermohonanReklame;
use App\Models\PermohonanTransportasi;
use App\Models\JenisPermohonanIzin;
use App\Models\Verifikasi;

class PermohonanWorkflow
{
    use PerizinanTrait;

    public $jenis_permohonan_izin = null;
    public $event = 'mulai';
    public $task  = 'permohonan';
    public $executor;
    public $daftar_online = false;
    public $workflow_token;
    public $workflow_id;

    public function __construct($token)
    {
        $this->executor = auth()->user()->nama;
        $this->workflow_token = $token;
        $proccess_exist = Step::CekTokenTransition($token);
        if(!$proccess_exist) {
            $this->StartPermohonanProses();
        } else {
            $this->workflow_id = $proccess_exist->id;
        }

    }

    public function SetJenisPermohonanIzin($jenis_permohonan_izin)
    {
        $this->jenis_permohonan_izin = JenisPermohonanIzin::findOrFail($jenis_permohonan_izin);
    }

    protected function StartPermohonanProses()
    {
        $workflow = new Workflow;
        $workflow->event = $this->event;
        $workflow->task  = $this->task;
        $workflow->executor = $this->executor;
        $workflow->token = $this->workflow_token;
        $workflow->save();
        $this->workflow_id = $workflow->id;
    }

    public function GetForm()
    {
        $property = $this->GetFormProperty($this->jenis_permohonan_izin);
        Step::SetTask($this->workflow_id, [
            'event'=>'mulai',
            'sub_task'=>'mengisi.formulir.permohonan',
            'next_task'=>'mengisi.formulir.permohonan',
            'executor'=>$this->executor
        ]);
        return new FormPermohonan($property);
    }

    public function GetFormEdit($edit)
    {
        $property = $this->GetFormPropertyEdit($this->jenis_permohonan_izin, $edit);
        return new FormPermohonan($property);
    }

    public function generateNomorPendaftaran($data){
        $permohonan = Permohonan::where("id",$data->id)->first();
        $permohonan->no_pendaftaran_sementara = $this->NomorPendaftaranSementara("", $data->getIzin);
        $permohonan->save();
    }

    public function SubmitFormPermohonan($req)
    {
        $meta = $this->MetadataForm($req, $this->jenis_permohonan_izin);
        Step::SetTask($this->workflow_id, [
            'event'=>'selesai',
            'sub_task'=>'mengisi.formulir.permohonan',
            'next_task'=>'submit.formulir.permohonan',
            'executor'=>$this->executor
        ]);
        Step::SetTask($this->workflow_id, [
            'event'=>'mulai',
            'sub_task'=>'submit.formulir.permohonan',
            'next_task'=>'submit.formulir.permohonan',
            'executor'=>$this->executor
        ]);
        $permohonan = new Permohonan;
        $permohonan->workflow = $this->workflow_id;
        $permohonan->izin = $this->jenis_permohonan_izin->id;
        $permohonan->tgl_pendaftaran = \Carbon\Carbon::now();
        /*$permohonan->no_pendaftaran_sementara = $this->NomorPendaftaranSementara($this->executor, $this->jenis_permohonan_izin);*/
        $permohonan->metadata = json_encode($meta);
        $permohonan->id_pendaftar = auth()->user()->id;
        $permohonan->id_profil = $req['id_profil'];
        $permohonan->koordinat = $req['koordinat'];
        $permohonan->lokasi_kec = $req['lokasi_kec'];
        $permohonan->lokasi_kel = $req['lokasi_kel'];
        $permohonan->lokasi_rt = $req['lokasi_rt'];
        $permohonan->lokasi_rw = $req['lokasi_rw'];
        $permohonan->alamat_permohonan = strtoupper($req['alamat_permohonan']);
        $permohonan->tgl_penerimaan = date('Y-m-d');
        $permohonan->save();
        $this->SubmitPendaftar($permohonan->id, $permohonan->id_pendaftar);
        $kategoriProfilId = $this->jenis_permohonan_izin->jenisIzin->kategoriProfil->id;
        if ($kategoriProfilId == 1) 
        {
            $this->SubmitProfesi($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 2) 
        {
            $this->SubmitPerusahaan($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 3) 
        {
            $this->SubmitPembangunan($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 4) 
        {
            $this->SubmitKetenagakerjaan($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 5) 
        {
            $this->SubmitLingkungan($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 6) 
        {
            $this->SubmitReklame($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 7) 
        {
            $this->SubmitTransportasi($permohonan->id, $permohonan->id_profil);
        }
        Step::SetTask($this->workflow_id, [
            'event'=>'selesai',
            'sub_task'=>'submit.formulir.permohonan',
            'next_task'=>'melengkapi.persyaratan',
            'executor'=>$this->executor
        ]);
    }

    public function SubmitFormPermohonanIsExist($permohonan,$req)
    {
        $meta = $this->MetadataForm($req, $this->jenis_permohonan_izin);
        Step::SetTask($this->workflow_id, [
            'event'=>'selesai',
            'sub_task'=>'mengisi.formulir.permohonan',
            'next_task'=>'submit.formulir.permohonan',
            'executor'=>$this->executor
        ]);
        Step::SetTask($this->workflow_id, [
            'event'=>'mulai',
            'sub_task'=>'submit.formulir.permohonan',
            'next_task'=>'submit.formulir.permohonan',
            'executor'=>$this->executor
        ]);
        $permohonan->workflow = $this->workflow_id;
        $permohonan->izin = $this->jenis_permohonan_izin->id;
        $permohonan->tgl_pendaftaran = \Carbon\Carbon::now();
        /*$permohonan->no_pendaftaran_sementara = $this->NomorPendaftaranSementara($this->executor, $this->jenis_permohonan_izin);*/
        $permohonan->metadata = json_encode($meta);
        $permohonan->id_pendaftar = auth()->user()->id;
        $permohonan->id_profil = $req['id_profil'];
        $permohonan->koordinat = $req['koordinat'];
        $permohonan->lokasi_kec = $req['lokasi_kec'];
        $permohonan->lokasi_kel = $req['lokasi_kel'];
        $permohonan->lokasi_rt = $req['lokasi_rt'];
        $permohonan->lokasi_rw = $req['lokasi_rw'];
        $permohonan->alamat_permohonan = strtoupper($req['alamat_permohonan']);
        $permohonan->tgl_penerimaan = date('Y-m-d');
        $permohonan->save();
        $this->SubmitPendaftar($permohonan->id, $permohonan->id_pendaftar);
        $kategoriProfilId = $this->jenis_permohonan_izin->jenisIzin->kategoriProfil->id;
        if ($kategoriProfilId == 1) 
        {
            $this->SubmitProfesi($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 2) 
        {
            $this->SubmitPerusahaan($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 3) 
        {
            $this->SubmitPembangunan($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 4) 
        {
            $this->SubmitKetenagakerjaan($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 5) 
        {
            $this->SubmitLingkungan($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 6) 
        {
            $this->SubmitReklame($permohonan->id, $permohonan->id_profil);
        }
        else if ($kategoriProfilId == 7) 
        {
            $this->SubmitTransportasi($permohonan->id, $permohonan->id_profil);
        }
        Step::SetTask($this->workflow_id, [
            'event'=>'selesai',
            'sub_task'=>'submit.formulir.permohonan',
            'next_task'=>'melengkapi.persyaratan',
            'executor'=>$this->executor
        ]);
    }

    private function SubmitPendaftar($id_permohonan, $id_pendaftar)
    {
        $pendaftar = Pendaftar::where('id', $id_pendaftar)->first();
        /*
            check table permohonan
        */
        $t_pendaftar = PermohonanPendaftar::where("id_permohonan",$id_permohonan);
        if($t_pendaftar->count() > 0){
            $permohonanPendaftar = $t_pendaftar->first();
        }else{
            $permohonanPendaftar = new PermohonanPendaftar;
        }
        //dd($permohonanPendaftar);
        $permohonanPendaftar->id_permohonan = $id_permohonan;
        $permohonanPendaftar->email = $pendaftar->email;
        $permohonanPendaftar->nik = $pendaftar->nik;
        $permohonanPendaftar->nama = $pendaftar->nama;
        $permohonanPendaftar->gelar_depan = $pendaftar->gelar_depan;
        $permohonanPendaftar->gelar_belakang = $pendaftar->gelar_belakang;
        $permohonanPendaftar->tempat_lahir = $pendaftar->tempat_lahir;
        $permohonanPendaftar->tanggal_lahir = date('Y-m-d', strtotime($pendaftar->tanggal_lahir));
        $permohonanPendaftar->jenis_kelamin = $pendaftar->jenis_kelamin;
        $permohonanPendaftar->agama = $pendaftar->agama;
        $permohonanPendaftar->status_perkawinan = $pendaftar->status_perkawinan;
        $permohonanPendaftar->pekerjaan = $pendaftar->pekerjaan;
        $permohonanPendaftar->provinsi = $pendaftar->provinsi;
        $permohonanPendaftar->kabupaten = $pendaftar->kabupaten;
        $permohonanPendaftar->kecamatan = $pendaftar->kecamatan;
        $permohonanPendaftar->kelurahan = $pendaftar->kelurahan;
        $permohonanPendaftar->rw = $pendaftar->rw;
        $permohonanPendaftar->rt = $pendaftar->rt;
        $permohonanPendaftar->kode_pos = $pendaftar->kode_pos;
        $permohonanPendaftar->alamat = $pendaftar->alamat;
        $permohonanPendaftar->no_telp = $pendaftar->no_telp;
        $permohonanPendaftar->kewarganegaraan = $pendaftar->kewarganegaraan;
        $permohonanPendaftar->nomor_passpor = $pendaftar->nomor_passpor;
        $permohonanPendaftar->tempat_terbit_passpor = $pendaftar->tempat_terbit_passpor;
        $permohonanPendaftar->save();
    }

    private function SubmitProfesi($id_permohonan, $id_profil)
    {
        $pendaftarProfesi = PendaftarProfesi::where('id', $id_profil)->first();
        $t_profesi = PermohonanProfesi::where("id_permohonan",$id_permohonan)
                                        ->where("id_profesi",$pendaftarProfesi->id_profesi);
        if($t_profesi->count() > 0){
            $permohonanProfesi = $t_profesi->first();
        }else{
            $permohonanProfesi = new PermohonanProfesi;
        }

        $permohonanProfesi->id_permohonan = $id_permohonan;
        $permohonanProfesi->id_profesi = $pendaftarProfesi->id_profesi;
        $permohonanProfesi->nomor_str = $pendaftarProfesi->nomor_str;
        $permohonanProfesi->penerbit = $pendaftarProfesi->penerbit;
        $permohonanProfesi->berlaku_mulai = $pendaftarProfesi->berlaku_mulai;
        $permohonanProfesi->berlaku_sampai = $pendaftarProfesi->berlaku_sampai;
        $permohonanProfesi->kota_terbit = $pendaftarProfesi->kota_terbit;
        $permohonanProfesi->jenis_cetakan_str = $pendaftarProfesi->jenis_cetakan_str;
        $permohonanProfesi->jenis_pt = $pendaftarProfesi->jenis_pt;
        $permohonanProfesi->nama_pt = $pendaftarProfesi->nama_pt;
        $permohonanProfesi->status_pt = $pendaftarProfesi->status_pt;
        $permohonanProfesi->kota_pt = $pendaftarProfesi->kota_pt;
        $permohonanProfesi->tahun_lulus = $pendaftarProfesi->tahun_lulus;
        $permohonanProfesi->kompetensi = $pendaftarProfesi->kompetensi;
        $permohonanProfesi->nomor_sertifikat_kompetensi = $pendaftarProfesi->nomor_sertifikat_kompetensi;
        $permohonanProfesi->save();
    }

    private function SubmitPerusahaan($id_permohonan, $id_profil)
    {
        $pendaftarPerusahaan = PendaftarPerusahaan::where('id', $id_profil)->first();
        $t_perusahaan = PermohonanPerusahaan::where("id_permohonan",$id_permohonan);
        if($t_perusahaan->count() > 0){
            $permohonanPerusahaan = $t_perusahaan->first();
        }else{
            $permohonanPerusahaan = new PermohonanPerusahaan;
        }

        $permohonanPerusahaan->id_permohonan = $id_permohonan;
        $permohonanPerusahaan->jenis_perusahaan = $pendaftarPerusahaan->jenis_perusahaan;
        $permohonanPerusahaan->status_jabatan = $pendaftarPerusahaan->status_jabatan;
        $permohonanPerusahaan->nomor_akte_pendirian = $pendaftarPerusahaan->nomor_akte_pendirian;
        $permohonanPerusahaan->tanggal_akte_pendirian = $pendaftarPerusahaan->tanggal_akte_pendirian;
        $permohonanPerusahaan->nama_notaris_pendirian = $pendaftarPerusahaan->nama_notaris_pendirian;
        $permohonanPerusahaan->modal_dasar_pendirian = $pendaftarPerusahaan->modal_dasar_pendirian;
        $permohonanPerusahaan->modal_ditempatkan_pendirian = $pendaftarPerusahaan->modal_ditempatkan_pendirian;
        $permohonanPerusahaan->nomor_akte_perubahan = $pendaftarPerusahaan->nomor_akte_perubahan;
        $permohonanPerusahaan->tanggal_akte_perubahan = $pendaftarPerusahaan->tanggal_akte_perubahan;
        $permohonanPerusahaan->nama_notaris_perubahan = $pendaftarPerusahaan->nama_notaris_perubahan;
        $permohonanPerusahaan->modal_dasar_perubahan = $pendaftarPerusahaan->modal_dasar_perubahan;
        $permohonanPerusahaan->modal_ditempatkan_perubahan = $pendaftarPerusahaan->modal_ditempatkan_perubahan;
        $permohonanPerusahaan->kegiatan_utama = $pendaftarPerusahaan->kegiatan_utama;
        $permohonanPerusahaan->nama_perusahaan = $pendaftarPerusahaan->nama_perusahaan;
        $permohonanPerusahaan->alamat_perusahaan = $pendaftarPerusahaan->alamat_perusahaan;
        $permohonanPerusahaan->tlp_perusahaan = $pendaftarPerusahaan->tlp_perusahaan;
        $permohonanPerusahaan->npwp_perusahaan = $pendaftarPerusahaan->npwp_perusahaan;
        $permohonanPerusahaan->no_ahu = $pendaftarPerusahaan->no_ahu;
        $permohonanPerusahaan->status_perusahaan = $pendaftarPerusahaan->status_perusahaan;
        $permohonanPerusahaan->direktur = $pendaftarPerusahaan->direktur;
        $permohonanPerusahaan->saham_direktur = $pendaftarPerusahaan->saham_direktur;
        $permohonanPerusahaan->komisaris_utama = $pendaftarPerusahaan->komisaris_utama;
        $permohonanPerusahaan->saham_komisaris_utama = $pendaftarPerusahaan->saham_komisaris_utama;
        $permohonanPerusahaan->komisaris = $pendaftarPerusahaan->komisaris;
        $permohonanPerusahaan->saham_komisaris = $pendaftarPerusahaan->saham_komisaris;
        $permohonanPerusahaan->kedudukan_perusahaan = $pendaftarPerusahaan->kedudukan_perusahaan;
        $permohonanPerusahaan->save();
    }

    private function SubmitPembangunan($id_permohonan, $id_profil)
    {
        $pendaftarPembangunan = PendaftarPembangunan::where('id', $id_profil)->first();
        $t_pembangunan = PermohonanPembangunan::where("id_permohonan",$id_permohonan);
        if($t_pembangunan->count() > 0){
            $permohonanPembangunan = $t_pembangunan->first();
        }else{
            $permohonanPembangunan = new PermohonanPembangunan;
        }

        $permohonanPembangunan->id_permohonan = $id_permohonan;
        $permohonanPembangunan->jenis_sertifikat = $pendaftarPembangunan->jenis_sertifikat;
        $permohonanPembangunan->nama_pada_sertifikat = $pendaftarPembangunan->nama_pada_sertifikat;
        $permohonanPembangunan->nomor_sertifikat = $pendaftarPembangunan->nomor_sertifikat;
        $permohonanPembangunan->tanggal_sertifikat = $pendaftarPembangunan->tanggal_sertifikat;
        $permohonanPembangunan->luas_tanah = $pendaftarPembangunan->luas_tanah;
        $permohonanPembangunan->nomor_akte_jual_beli = $pendaftarPembangunan->nomor_akte_jual_beli;
        $permohonanPembangunan->tanggal_akte_jual_beli = $pendaftarPembangunan->tanggal_akte_jual_beli;
        $permohonanPembangunan->nama_notaris = $pendaftarPembangunan->nama_notaris;
        $permohonanPembangunan->nama_ahli_waris = $pendaftarPembangunan->nama_ahli_waris;
        $permohonanPembangunan->nomor_gs = $pendaftarPembangunan->nomor_gs;
        $permohonanPembangunan->tahun_gs = $pendaftarPembangunan->tahun_gs;
        $permohonanPembangunan->save();
    }

    private function SubmitKetenagakerjaan($id_permohonan, $id_profil)
    {
        $pendaftarKetenagakerjaan = PendaftarKetenagakerjaan::where('id', $id_profil)->first();
        $t_ketenagakerjaaan = PermohonanKetenagakerjaan::where("id_permohonan",$id_permohonan);
        if($t_ketenagakerjaaan->count() > 0){
            $permohonanKetenagakerjaan = $t_ketenagakerjaaan->first();
        }else{
            $permohonanKetenagakerjaan = new PermohonanKetenagakerjaan;
        }
        $permohonanKetenagakerjaan->id_permohonan = $id_permohonan;
        $permohonanKetenagakerjaan->nama_perusahaan = $pendaftarKetenagakerjaan->nama_perusahaan;
        $permohonanKetenagakerjaan->wni_pria = $pendaftarKetenagakerjaan->wni_pria;
        $permohonanKetenagakerjaan->wni_wanita = $pendaftarKetenagakerjaan->wni_wanita;
        $permohonanKetenagakerjaan->wna_pria = $pendaftarKetenagakerjaan->wna_pria;
        $permohonanKetenagakerjaan->wna_wanita = $pendaftarKetenagakerjaan->wna_wanita;
        $permohonanKetenagakerjaan->save();
    }

    private function SubmitLingkungan($id_permohonan, $id_profil)
    {
        $pendaftarLingkungan = PendaftarLingkungan::where('id', $id_profil)->first();
        $t_lingkungan = PermohonanLingkungan::where("id_permohonan",$id_permohonan);
        if($t_lingkungan->count() > 0){
            $permohonanLingkungan = $t_lingkungan->first();
        }else{
            $permohonanLingkungan = new PermohonanLingkungan;
        }

        $permohonanLingkungan->id_permohonan = $id_permohonan;
        $permohonanLingkungan->jenis_kegiatan = $pendaftarLingkungan->jenis_kegiatan;
        $permohonanLingkungan->oleh = $pendaftarLingkungan->oleh;
        $permohonanLingkungan->nama_perusahaan = $pendaftarLingkungan->nama_perusahaan;
        $permohonanLingkungan->alamat_perusahaan = $pendaftarLingkungan->alamat_perusahaan;
        $permohonanLingkungan->save();
    }

    private function SubmitReklame($id_permohonan, $id_profil)
    {
        $pendaftarReklame = PendaftarReklame::where('id', $id_profil)->first();
        $t_profil = PermohonanReklame::where("id_permohonan",$id_permohonan);
        if($t_profil->count() > 0){
            $permohonanReklame = $t_profil->first();
        }else{
            $permohonanReklame = new PermohonanReklame;
        }

        $permohonanReklame->id_permohonan = $id_permohonan;
        $permohonanReklame->jenis_advertising = $pendaftarReklame->jenis_advertising;
        $permohonanReklame->nama_perusahaan = $pendaftarReklame->nama_perusahaan;
        $permohonanReklame->provinsi = $pendaftarReklame->provinsi;
        $permohonanReklame->kabupaten = $pendaftarReklame->kabupaten;
        $permohonanReklame->kecamatan = $pendaftarReklame->kecamatan;
        $permohonanReklame->kelurahan = $pendaftarReklame->kelurahan;
        $permohonanReklame->rw = $pendaftarReklame->rw;
        $permohonanReklame->rt = $pendaftarReklame->rt;
        $permohonanReklame->kode_pos = $pendaftarReklame->kode_pos;
        $permohonanReklame->alamat = $pendaftarReklame->alamat;
        $permohonanReklame->npwp = $pendaftarReklame->npwp;
        $permohonanReklame->npwp_d = $pendaftarReklame->npwp_d;
        $permohonanReklame->save();
    }

    private function SubmitTransportasi($id_permohonan, $id_profil)
    {
        $pendaftarTransportasi = PendaftarTransportasi::where('id', $id_profil)->first();
        $t_transportasi = PermohonanTransportasi::where("id_permohonan",$id_permohonan);
        if($t_transportasi->count() > 0){
            $permohonanTransportasi = $t_transportasi->first();
        }else{
            $permohonanTransportasi = new PermohonanTransportasi;
        }
        $permohonanTransportasi->id_permohonan = $id_permohonan;
        $permohonanTransportasi->nomor_kendaraan = $pendaftarTransportasi->nomor_kendaraan;
        $permohonanTransportasi->nomor_rangka = $pendaftarTransportasi->nomor_rangka;
        $permohonanTransportasi->nomor_mesin = $pendaftarTransportasi->nomor_mesin;
        $permohonanTransportasi->nama_pada_stnk = $pendaftarTransportasi->nama_pada_stnk;
        $permohonanTransportasi->tahun_pembuatan = $pendaftarTransportasi->tahun_pembuatan;
        $permohonanTransportasi->save();
    }

    protected function set_sertifikat($per)
    {
        if(session()->has('sertifikat')){
            $luas = 0;
            foreach(session('sertifikat') as $sr){
                $srt = new \App\Models\Sertifikat;
                $srt->permohonan = $per->id;
                $srt->pemohon = $sr['pemohon'];
                $srt->jenis = $sr['jenis'];
                $srt->nomor = $sr['nomor'];
                $srt->kecamatan = $sr['kecamatan'];
                $srt->kelurahan = $sr['kelurahan'];
                $srt->desa = $sr['desa'];
                $srt->surat_ukur = $sr['surat_ukur'];
                $srt->no_surat_ukur = $sr['no_surat_ukur'];
                $srt->tgl_surat_ukur = $sr['tgl_surat_ukur'];
                $srt->persil = $sr['persil'];
                $srt->kelas = $sr['kelas'];
                $srt->luas=$sr['luas'];
                $srt->keadaan_tanah = $sr['keadaan_tanah'];
                $srt->atas_nama = $sr['atas_nama'];
                $srt->save();
                $luas = ($luas + $sr['luas']);
            }

            $per->luas_sertifikat = $luas;
            $per->save();
        }

        session()->forget('sertifikat');
    }

    public function SubmitFormEditPermohonan($req, $per)
    {
        $meta = $this->MetadataForm($req, $this->jenis_permohonan_izin);
        $per->metadata = json_encode($meta);
        $per->id_profil = $req['id_profil'];
        $per->koordinat = $req['koordinat'];
        $per->lokasi_kec = $req['lokasi_kec'];
        $per->lokasi_kel = $req['lokasi_kel'];
        $per->alamat_permohonan = strtoupper($req['alamat_permohonan']);
        $per->save();
        $this->SubmitPendaftar($per->id, $per->id_pendaftar);
        $kategoriProfilId = $this->jenis_permohonan_izin->jenisIzin->kategoriProfil->id;
        if ($kategoriProfilId == 1) 
        {
            $this->SubmitProfesi($per->id, $per->id_profil);
        }
        else if ($kategoriProfilId == 2) 
        {
            $this->SubmitPerusahaan($per->id, $per->id_profil);
        }
        else if ($kategoriProfilId == 3) 
        {
            $this->SubmitPembangunan($per->id, $per->id_profil);
        }
        else if ($kategoriProfilId == 4) 
        {
            $this->SubmitKetenagakerjaan($per->id, $per->id_profil);
        }
        else if ($kategoriProfilId == 5) 
        {
            $this->SubmitLingkungan($per->id, $per->id_profil);
        }
        else if ($kategoriProfilId == 6) 
        {
            $this->SubmitReklame($per->id, $per->id_profil);
        }
        else if ($kategoriProfilId == 7) 
        {
            $this->SubmitTransportasi($per->id, $per->id_profil);
        }        
    }

    public function GetFormPersyaratan($action)
    {
        Step::SetTask($this->workflow_id, [
            'event'=>'mulai',
            'sub_task'=>'melengkapi.persyaratan',
            'next_task'=>'melengkapi.persyaratan',
            'executor'=>$this->executor
        ]);

        $permohonan = Permohonan::where('workflow', $this->workflow_id)->first();
        $syarat = $permohonan->getIzin->syarat()->get();

        $ext_file = $permohonan->getVerifikasi()->get();
        if($ext_file->count() > 0){
            $file = $ext_file->pluck('file')->toArray();
        }else{
            $file = false;
        }

        return new FormPersyaratan($syarat, $action, $this->executor, $file);
    }

    public function SubmitPersyaratan($file, $r)
    {
        $permohonan = Permohonan::where('workflow', $this->workflow_id)->first();
        $permohonan->getVerifikasi()->delete();
        foreach($r['syarat_id'] as $key=>$val)
        {
            $verifikasi = new Verifikasi;
            $verifikasi->permohonan = $permohonan->id;
            $verifikasi->syarat = $val;
            if(isset($r['syarat'][$key]))
            {
                $verifikasi->file = $file[$key];
            }else{
                $verifikasi->file = $r['syarat_value'][$key];
            }
            $verifikasi->lengkap_tidak = 0;
            $verifikasi->ada_tidak = 1;
            $verifikasi->save();
        }

        PerizinanWorkflow::ToPendaftaranFromPemohon($permohonan);
    }

    public function UpdatePermohonanAdmin($req, $per)
    {
        $meta = $this->MetadataForm($req, $this->jenis_permohonan_izin);
        $per->metadata = json_encode($meta);
        //$per->id_profil = $req['id_profil'];
        $per->koordinat = $req['koordinat'];
        $per->lokasi_kec = $req['lokasi_kec'];
        $per->lokasi_kel = $req['lokasi_kel'];
        $per->alamat_permohonan = strtoupper($req['alamat_permohonan']);
        $per->save();
        $this->UpdatePendaftarAdmin($per->id, $req);
        $kategoriProfilId = $this->jenis_permohonan_izin->jenisIzin->kategoriProfil->id;
        if ($kategoriProfilId == 1) 
        {
            $this->UpdateProfesiAdmin($per->id, $req);
        }
        else if ($kategoriProfilId == 2) 
        {
            $this->UpdatePerusahaanAdmin($per->id, $req);
        }
        else if ($kategoriProfilId == 3) 
        {
            $this->UpdatePembangunanAdmin($per->id, $req);
        }
        else if ($kategoriProfilId == 4) 
        {
            $this->UpdateKetenagakerjaanAdmin($per->id, $req);
        }
        else if ($kategoriProfilId == 5) 
        {
            $this->UpdateLingkunganAdmin($per->id, $req);
        }
        else if ($kategoriProfilId == 6) 
        {
            $this->UpdateReklameAdmin($per->id, $req);
        }
        else if ($kategoriProfilId == 7) 
        {
            $this->UpdateTransportasiAdmin($per->id, $req);
        }        
    }

    private function UpdatePendaftarAdmin($id_permohonan, $pendaftar)
    {
        $permohonanPendaftar = PermohonanPendaftar::where("id_permohonan",$id_permohonan)->first();
        $pendaftar = (object) $pendaftar;
        //dd($permohonanPendaftar);
        $permohonanPendaftar->email = $pendaftar->email;
        $permohonanPendaftar->nik = strtoupper($pendaftar->nik);
        $permohonanPendaftar->nama = strtoupper($pendaftar->nama);
        $permohonanPendaftar->gelar_depan = $pendaftar->gelar_depan;
        $permohonanPendaftar->gelar_belakang = $pendaftar->gelar_belakang;
        $permohonanPendaftar->tempat_lahir = strtoupper($pendaftar->tempat_lahir);
        $permohonanPendaftar->tanggal_lahir = date('Y-m-d', strtotime($pendaftar->tanggal_lahir));
        $permohonanPendaftar->jenis_kelamin = $pendaftar->jenis_kelamin;
        $permohonanPendaftar->agama = $pendaftar->agama;
        $permohonanPendaftar->status_perkawinan = $pendaftar->status_perkawinan;
        $permohonanPendaftar->pekerjaan = strtoupper($pendaftar->pekerjaan);
        $permohonanPendaftar->provinsi = $pendaftar->provinsi;
        $permohonanPendaftar->kabupaten = $pendaftar->kabupaten;
        $permohonanPendaftar->kecamatan = $pendaftar->kecamatan;
        $permohonanPendaftar->kelurahan = $pendaftar->kelurahan;
        $permohonanPendaftar->rw = $pendaftar->rw;
        $permohonanPendaftar->rt = $pendaftar->rt;
        $permohonanPendaftar->kode_pos = strtoupper($pendaftar->kode_pos);
        $permohonanPendaftar->alamat = strtoupper($pendaftar->alamat);
        $permohonanPendaftar->no_telp = strtoupper($pendaftar->no_telp);
        $permohonanPendaftar->kewarganegaraan = strtoupper($pendaftar->kewarganegaraan);
        $permohonanPendaftar->nomor_passpor = strtoupper($pendaftar->nomor_passpor);
        $permohonanPendaftar->tempat_terbit_passpor = strtoupper($pendaftar->tempat_terbit_passpor);
        $permohonanPendaftar->save();
    }

    private function UpdateProfesiAdmin($id_permohonan, $pendaftarProfesi)
    {
        $permohonanProfesi = PermohonanProfesi::where("id_permohonan",$id_permohonan)->first();
        $pendaftarProfesi = (object) $pendaftarProfesi;
        
        $permohonanProfesi->id_profesi = $pendaftarProfesi->id_profesi;
        $permohonanProfesi->nomor_str = $pendaftarProfesi->nomor_str;
        $permohonanProfesi->penerbit = $pendaftarProfesi->penerbit;
        $permohonanProfesi->berlaku_mulai = $pendaftarProfesi->berlaku_mulai;
        $permohonanProfesi->berlaku_sampai = $pendaftarProfesi->berlaku_sampai;
        $permohonanProfesi->kota_terbit = $pendaftarProfesi->kota_terbit;
        $permohonanProfesi->jenis_cetakan_str = $pendaftarProfesi->jenis_cetakan_str;
        $permohonanProfesi->jenis_pt = $pendaftarProfesi->jenis_pt;
        $permohonanProfesi->nama_pt = $pendaftarProfesi->nama_pt;
        $permohonanProfesi->status_pt = $pendaftarProfesi->status_pt;
        $permohonanProfesi->kota_pt = $pendaftarProfesi->kota_pt;
        $permohonanProfesi->tahun_lulus = $pendaftarProfesi->tahun_lulus;
        $permohonanProfesi->kompetensi = $pendaftarProfesi->kompetensi;
        $permohonanProfesi->nomor_sertifikat_kompetensi = $pendaftarProfesi->nomor_sertifikat_kompetensi;
        $permohonanProfesi->save();
    }

    private function UpdateReklameAdmin($id_permohonan, $pendaftarReklame)
    {
        $permohonanReklame = PermohonanReklame::where("id_permohonan",$id_permohonan)->first();
        $pendaftarReklame = (object) $pendaftarReklame;

        $permohonanReklame->id_permohonan = $id_permohonan;
        $permohonanReklame->jenis_advertising = $pendaftarReklame->jenis_advertising;
        $permohonanReklame->nama_perusahaan = $pendaftarReklame->nama_perusahaan;
        $permohonanReklame->provinsi = $pendaftarReklame->provinsi_reklame;
        $permohonanReklame->kabupaten = $pendaftarReklame->kabupaten_reklame;
        $permohonanReklame->kecamatan = $pendaftarReklame->kecamatan_reklame;
        $permohonanReklame->kelurahan = $pendaftarReklame->kelurahan_reklame;
        $permohonanReklame->rw = $pendaftarReklame->rw_reklame;
        $permohonanReklame->rt = $pendaftarReklame->rt_reklame;
        $permohonanReklame->npwp = $pendaftarReklame->npwp;
        $permohonanReklame->npwp_d = $pendaftarReklame->npwp_d;
        $permohonanReklame->kode_pos = $pendaftarReklame->kode_pos_reklame;
        $permohonanReklame->alamat = $pendaftarReklame->alamat_reklame;
        $permohonanReklame->save();
    }

    private function UpdatePerusahaanAdmin($id_permohonan, $pendaftarPerusahaan)
    {
        $permohonanPerusahaan = PermohonanPerusahaan::where("id_permohonan",$id_permohonan)->first();
        $pendaftarPerusahaan = (object) $pendaftarPerusahaan;

        $permohonanPerusahaan->id_permohonan = $id_permohonan;
        $permohonanPerusahaan->jenis_perusahaan = $pendaftarPerusahaan->jenis_perusahaan;
        $permohonanPerusahaan->status_jabatan = $pendaftarPerusahaan->status_jabatan;
        $permohonanPerusahaan->nomor_akte_pendirian = $pendaftarPerusahaan->nomor_akte_pendirian;
        $permohonanPerusahaan->tanggal_akte_pendirian = $pendaftarPerusahaan->tanggal_akte_pendirian;
        $permohonanPerusahaan->nama_notaris_pendirian = $pendaftarPerusahaan->nama_notaris_pendirian;
        $permohonanPerusahaan->modal_dasar_pendirian = $pendaftarPerusahaan->modal_dasar_pendirian;
        $permohonanPerusahaan->modal_ditempatkan_pendirian = $pendaftarPerusahaan->modal_ditempatkan_pendirian;
        $permohonanPerusahaan->kedudukan_perusahaan = $pendaftarPerusahaan->kedudukan_perusahaan;
        $permohonanPerusahaan->kegiatan_utama = $pendaftarPerusahaan->kegiatan_utama;
        $permohonanPerusahaan->nama_perusahaan = $pendaftarPerusahaan->nama_perusahaan;
        $permohonanPerusahaan->alamat_perusahaan = $pendaftarPerusahaan->alamat_perusahaan;
        $permohonanPerusahaan->no_ahu = $pendaftarPerusahaan->no_ahu;
        $permohonanPerusahaan->status_perusahaan = $pendaftarPerusahaan->status_perusahaan;
        $permohonanPerusahaan->direktur = $pendaftarPerusahaan->direktur;
        $permohonanPerusahaan->saham_direktur = $pendaftarPerusahaan->saham_direktur;
        $permohonanPerusahaan->komisaris_utama = $pendaftarPerusahaan->komisaris_utama;
        $permohonanPerusahaan->saham_komisaris_utama = $pendaftarPerusahaan->saham_komisaris_utama;
        $permohonanPerusahaan->komisaris = $pendaftarPerusahaan->komisaris;
        $permohonanPerusahaan->saham_komisaris = $pendaftarPerusahaan->saham_komisaris;
        $permohonanPerusahaan->save();
    }

    private function UpdatePembangunanAdmin($id_permohonan, $pendaftarPembangunan)
    {
        $permohonanPembangunan = PermohonanPembangunan::where("id_permohonan",$id_permohonan)->first();
        $pendaftarPembangunan = (object) $pendaftarPembangunan;

        $permohonanPembangunan->id_permohonan = $id_permohonan;
        $permohonanPembangunan->jenis_sertifikat = $pendaftarPembangunan->jenis_sertifikat;
        $permohonanPembangunan->nomor_sertifikat = $pendaftarPembangunan->nomor_sertifikat;
        $permohonanPembangunan->tanggal_sertifikat = $pendaftarPembangunan->tanggal_sertifikat;
        $permohonanPembangunan->nama_pada_sertifikat = $pendaftarPembangunan->nama_pada_sertifikat;
        $permohonanPembangunan->luas_tanah = $pendaftarPembangunan->luas_tanah;
        $permohonanPembangunan->nomor_akte_jual_beli = $pendaftarPembangunan->nomor_akte_jual_beli;
        $permohonanPembangunan->tanggal_akte_jual_beli = $pendaftarPembangunan->tanggal_akte_jual_beli;
        $permohonanPembangunan->nama_notaris = $pendaftarPembangunan->nama_notaris;
        $permohonanPembangunan->nama_ahli_waris = $pendaftarPembangunan->nama_ahli_waris;
        $permohonanPembangunan->nomor_gs = $pendaftarPembangunan->nomor_gs;
        $permohonanPembangunan->tahun_gs = $pendaftarPembangunan->tahun_gs;
        $permohonanPembangunan->save();
    }

    private function UpdateKetenagakerjaanAdmin($id_permohonan, $pendaftarKetenagakerjaan)
    {
        $permohonanKetenagakerjaan = PermohonanKetenagakerjaan::where("id_permohonan",$id_permohonan)->first();
        $pendaftarKetenagakerjaan = (object) $pendaftarKetenagakerjaan;

        $permohonanKetenagakerjaan->id_permohonan = $id_permohonan;
        $permohonanKetenagakerjaan->nama_perusahaan = $pendaftarKetenagakerjaan->nama_perusahaan;
        $permohonanKetenagakerjaan->wni_pria = $pendaftarKetenagakerjaan->wni_pria;
        $permohonanKetenagakerjaan->wni_wanita = $pendaftarKetenagakerjaan->wni_wanita;
        $permohonanKetenagakerjaan->wna_pria = $pendaftarKetenagakerjaan->wna_pria;
        $permohonanKetenagakerjaan->wna_wanita = $pendaftarKetenagakerjaan->wna_wanita;
        $permohonanKetenagakerjaan->save();
    }

    private function UpdateLingkunganAdmin($id_permohonan, $pendaftarLingkungan)
    {
        $permohonanLingkungan = PermohonanLingkungan::where("id_permohonan",$id_permohonan)->first();
        $pendaftarLingkungan = (object) $pendaftarLingkungan;

        $permohonanLingkungan->id_permohonan = $id_permohonan;
        $permohonanLingkungan->jenis_kegiatan = $pendaftarLingkungan->jenis_kegiatan;
        $permohonanLingkungan->oleh = $pendaftarLingkungan->oleh;
        $permohonanLingkungan->nama_perusahaan = $pendaftarLingkungan->nama_perusahaan;
        $permohonanLingkungan->alamat_perusahaan = $pendaftarLingkungan->alamat_perusahaan;
        $permohonanLingkungan->save();
    }

    private function UpdateTransportasiAdmin($id_permohonan, $pendaftarTransportasi)
    {
        $permohonanTransportasi = PermohonanTransportasi::where("id_permohonan",$id_permohonan)->first();
        $pendaftarTransportasi = (object) $pendaftarTransportasi;

        $permohonanTransportasi->id_permohonan = $id_permohonan;
        $permohonanTransportasi->nomor_kendaraan = $pendaftarTransportasi->nomor_kendaraan;
        $permohonanTransportasi->nomor_rangka = $pendaftarTransportasi->nomor_rangka;
        $permohonanTransportasi->nomor_mesin = $pendaftarTransportasi->nomor_mesin;
        $permohonanTransportasi->nama_pada_stnk = $pendaftarTransportasi->nama_pada_stnk;
        $permohonanTransportasi->tahun_pembuatan = $pendaftarTransportasi->tahun_pembuatan;
        $permohonanTransportasi->save();
    }
}

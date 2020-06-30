<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Proses\TraitSurat;
use App\Http\Requests\UploadRequest;
use App\Models\JenisPermohonanIzin;
use App\Models\KategoriProfil;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pendaftar;
use App\Models\PendaftarKetenagakerjaan;
use App\Models\PendaftarLingkungan;
use App\Models\PendaftarPembangunan;
use App\Models\PendaftarPerusahaan;
use App\Models\PendaftarProfesi;
use App\Models\PendaftarReklame;
use App\Models\PendaftarTransportasi;
use App\Models\Permohonan;
use App\Models\Verifikasi;
use App\Models\Identitas;
use App\Models\Workflow;
use App\Models\Pencabutan;
use App\Workflow\PermohonanWorkflow;
use App\Notifications\NotifikasiPerizinan;
use Carbon\Carbon;
use File;

use App\Mail\PermohonanEmail;
use Mail;

class PermohonanController extends Controller
{
    use TraitSurat;

    public function __construct()
    {
        $this->middleware('auth:pendaftar');
    }

    function Home()
    {
        $title = "Permohonan Izin";
        $id_pendaftar = auth()->user()->id;
        $rs = Permohonan::where('id_pendaftar', $id_pendaftar)->orderBy('created_at','desc')->paginate(10);
        $no = $rs->firstItem();
        return view('anggota.permohonan.home',compact('title','rs','no'));
    }

    function AddPermohonan()
    {
        if (auth()->user()->nama == null) {
            flash('Data Profil harus dilengkapi dahulu sebelum mengajukan permohonan izin.')->error();
            return redirect('permohonan');
        }
        $title = "Permohonan Izin Baru";
        $izin = JenisPermohonanIzin::orderBy('kode')->get();
        $kategoriProfil = KategoriProfil::all();
        return view('anggota.permohonan.add',compact('title','kategoriProfil','izin'));
    }

    function FilterPermohonan($filter)
    {
        $title = "Permohonan Izin Baru";
        $izin = KategoriProfil::find($filter)->jenisPermohonanIzins()->orderBy('kode')->get();
        $kategoriProfil = KategoriProfil::all();
        return view('anggota.permohonan.add',compact('title','filter','kategoriProfil','izin'));
    }

    function ProsesPermohonan(JenisPermohonanIzin $izin, $token)
    {
        /*
         * validasi limit
         */
        
        $workflow = Workflow::where("token",$token)->count();

        if($workflow == 0){
            $limit = $izin->limit;
            $pendaftar = Pendaftar::find(auth()->user()->id);
            $permohonanExist = Permohonan::where("id_pendaftar",$pendaftar->id)
                                            ->where("izin",$izin->id)
                                            ->where("posisi","!=","tolak")
                                            ->where("is_cabut","!=","2")
                                            ->count();
            if($limit != 0 && $limit != null){
                if($permohonanExist >= $limit){
                    $messages = [
                        'msg' => 'Maksimal Permohonan Izin '.$limit
                    ];
                    return back()->withErrors($messages);
                }
            }
        }


        if ($izin->jenisIzin->kategoriProfil->id == 1) {
            $profil = PendaftarProfesi::where('id_pendaftar', auth()->user()->id)->first();
            if ($profil == null) {
                flash('Data Profil Profesi harus dilengkapi dahulu sebelum mengajukan permohonan izin ini.')->error();
                return redirect('permohonan');
            }
            $view = 'anggota.permohonan.input.profesi';
        } else if ($izin->jenisIzin->kategoriProfil->id == 2) {
            $profil = PendaftarPerusahaan::where('id_pendaftar', auth()->user()->id)->first();
            if ($profil == null) {
                flash('Data Profil Perusahaan harus dilengkapi dahulu sebelum mengajukan permohonan izin ini.')->error();
                return redirect('permohonan');
            }
            $view = 'anggota.permohonan.input.perusahaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 3) {
            $profil = PendaftarPembangunan::where('id_pendaftar', auth()->user()->id)->first();
            if ($profil == null) {
                flash('Data Profil Pembangunan harus dilengkapi dahulu sebelum mengajukan permohonan izin ini.')->error();
                return redirect('permohonan');
            }
            $view = 'anggota.permohonan.input.pembangunan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 4) {
            $profil = PendaftarKetenagakerjaan::where('id_pendaftar', auth()->user()->id)->first();
            if ($profil == null) {
                flash('Data Profil Ketenagakerjaan harus dilengkapi dahulu sebelum mengajukan permohonan izin ini.')->error();
                return redirect('permohonan');
            }
            $view = 'anggota.permohonan.input.ketenagakerjaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 5) {
            $profil = PendaftarLingkungan::where('id_pendaftar', auth()->user()->id)->first();
            if ($profil == null) {
                flash('Data Profil Lingkungan harus dilengkapi dahulu sebelum mengajukan permohonan izin ini.')->error();
                return redirect('permohonan');
            }
            $view = 'anggota.permohonan.input.lingkungan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 6) {
            $profil = PendaftarReklame::where('id_pendaftar', auth()->user()->id)->first();
            if ($profil == null) {
                flash('Data Profil Reklame harus dilengkapi dahulu sebelum mengajukan permohonan izin ini.')->error();
                return redirect('permohonan');
            }
            $view = 'anggota.permohonan.input.reklame';
        } else if ($izin->jenisIzin->kategoriProfil->id == 7) {
            $profil = PendaftarTransportasi::where('id_pendaftar', auth()->user()->id)->first();
            if ($profil == null) {
                flash('Data Profil Transportasi harus dilengkapi dahulu sebelum mengajukan permohonan izin ini.')->error();
                return redirect('permohonan');
            }
            $view = 'anggota.permohonan.input.transportasi';
        } else {
            flash('Data Kategori Profil tidak ditemukan.')->error();
            return redirect('permohonan');
        }
        $daftar =  new PermohonanWorkflow($token);
        $daftar->SetJenisPermohonanIzin($izin->id);
        $form = $daftar->GetForm()->form;
        $title = "Permohonan ".$izin->nama."";
        $pendaftar = Pendaftar::find(auth()->user()->id);
        $kecamatan = Kecamatan::where('kabupaten', 112)->get();

        return view($view,compact('form','title','pendaftar','kecamatan','izin','token','profil'));
    }

    function SaveProsesPermohonan(Request $r, JenisPermohonanIzin $izin, $token)
    {
        $daftar =  new PermohonanWorkflow($token);
        $daftar->SetJenisPermohonanIzin($izin->id);
        $validate_field = $daftar->FormValidationWorkflow($daftar->jenis_permohonan_izin);
        $this->validate($r, $validate_field);
        //check if exist permohonan by token
        $is_exist = Permohonan::whereHas('getWorkflowStatus', function($q) use ($token){
                        $q->where('token', $token);
                    })->first();
        if(!$is_exist){
            $daftar->SubmitFormPermohonan($r->all());
        }else{
            $daftar->SubmitFormPermohonanIsExist($is_exist,$r->all());
        }
        return redirect('permohonan/persyaratan/'.$izin->id.'/'.$token.'');
    }

    function CancelProsesPermohonan($token)
    {
        $tk = \App\Models\Workflow::where('token', $token)->first();
        $task = \App\Models\Task::where('workflow', $tk->id)->delete();
        $task = \App\Models\Permohonan::where('workflow', $tk->id)->delete();
        $per = Permohonan::whereHas('getWorkflowStatus', function($q) use ($token){
                                $q->where('token', $token);
                            })->first();
        if($per){
            $verifikasi_file = Verifikasi::where('permohonan', $oer->id)->delete();
        }
        $tk->delete();
        flash('Permohonan berhasil dibatalkan')->success();
        return redirect('permohonan');
    }

    function ProsesUploadDokumen(JenisPermohonanIzin $izin, $token)
    {
        $daftar =  new PermohonanWorkflow($token);
        $daftar->SetJenisPermohonanIzin($izin->id);
        $form = $daftar->GetFormPersyaratan(url('permohonan/persyaratan',[$izin->id,$token]))->form;
        $title = "Permohonan ".$izin->nama."";
        return view('anggota.permohonan.persyaratan',compact('form','title','izin'));
    }

    function SaveProsesUploadDokumen(Request $r, JenisPermohonanIzin $izin, $token)
    {
        $daftar =  new PermohonanWorkflow($token);
        $daftar->SetJenisPermohonanIzin($izin->id);
        $file = [];
        if($r->hasFile('syarat')){
            foreach ($r->syarat as $key=>$sy) {
                if(!is_null($sy)){
                    $ext = $sy->getClientOriginalExtension();
                    $per = Permohonan::whereHas('getWorkflowStatus', function($q) use ($token){
                                $q->where('token', $token);
                            })->first();
                    $ver = Verifikasi::where("permohonan",$per->id)->where("syarat",$r->syarat_id[$key])->first();
                    if($ver){
                        if($ver->file){
                            File::delete(storage_path("app/".$ver->file));
                        }
                    };
                    $filename = $r->syarat[$key]->storeAs($token."/uploads", "persyaratan_$key.$ext");
                    $file[$key] = $filename;
                }
            }
        }


        $daftar->SubmitPersyaratan($file, $r->all());
        flash('Permohonan berhasil diproses')->success();

        return redirect('permohonan/review/'.$token.'');
    }



    function ReviewPermohonan($token)
    {
        $per = Permohonan::whereHas('getWorkflowStatus', function($q) use ($token){
                    $q->where('token', $token);
                })->first();
        $izin = $per->getIzin()->first();
        $token = $per->getWorkflowStatus->token;
        $daftar =  new PermohonanWorkflow($token);
        $daftar->SetJenisPermohonanIzin($izin->id);
        $meta = (array)json_decode($per->metadata);
        unset($meta['_token']);

        $syarat = $per->getIzin->syarat()->get();
        $ext_file = $per->getVerifikasi()->get();
        if($ext_file->count() > 0){
            $file = $ext_file->toArray();
        }else{
            $file = false;
        }
        $form = (new \App\Workflow\FormView($syarat, $file))->form;

        //dd($per->getPemohon->nik);

        $pendaftar = $per->getPemohon;
        $kecamatan = Kecamatan::where('kabupaten', 112)->get();
        $kelurahan = Kelurahan::where('kecamatan', 112)->get();
        $title = "Review Permohonan ".$per->getIzin->nama."";

        if ($izin->jenisIzin->kategoriProfil->id == 1) {
            $permohonan_profile = 'anggota.partial.per_profesi';
        } else if ($izin->jenisIzin->kategoriProfil->id == 2) {
            $permohonan_profile = 'anggota.partial.per_perusahaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 3) {
            $permohonan_profile = 'anggota.partial.per_pembangunan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 4) {
            $permohonan_profile = 'anggota.partial.per_ketenagakerjaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 5) {
            $permohonan_profile = 'anggota.partial.per_lingkungan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 6) {
            $permohonan_profile = 'anggota.partial.per_reklame';
        } else if ($izin->jenisIzin->kategoriProfil->id == 7) {
            $permohonan_profile = 'anggota.partial.per_transportasi';
        }

        $view = 'anggota.permohonan.review.permohonan';

        return view($view, compact('meta', 'form', 'title', 'per', 'pendaftar', 'kecamatan', 'kelurahan','token','permohonan_profile'));
    }

    function ReviewSelesai($token){

        $data =  Permohonan::whereHas('getWorkflowStatus', function($q) use ($token){
            $q->where('token', $token);
        })->first();
        $daftar =  new PermohonanWorkflow($token);
        $daftar->generateNomorPendaftaran($data);

        return redirect('permohonan/selesai/'.$token.'');
    }

    function ProsesSelesai($token)
    {
        $title = "Permohonan Perizinan";
        $data =  Permohonan::whereHas('getWorkflowStatus', function($q) use ($token){
            $q->where('token', $token);
        })->first();
        $data->posisi = 'pendaftaran';
        $data->save();
        
        $this->generatedBuktiSementara($data);
        $petugas = \App\Models\Role::where('id', 2)->first();
        $petugas->notify(new NotifikasiPerizinan($data,'pendaftaran','Permohonan Baru'));
        return view('anggota.permohonan.selesai',compact('title','data'));
    }

    protected function generatedBuktiSementara($per)
    {

        $identitas  = Identitas::first();
        $kop_surat = "uploads/".$identitas->kop_surat;

        //dd($per->getIzin->template_bukti_pendaftaran);
        if($per->getIzin->template_bukti_pendaftaran){
            $file = storage_path('app/'.$per->getIzin->template_bukti_pendaftaran.'');
        }else{
            $file = "uploads/".$identitas->bukti_pendaftaran;
        }

        $render = new \App\Workflow\TemplateProccessorCustom($file);
        $nama = $per->getPemohon->nama;
        $alamat = ($per->alamat_permohonan != "-") ? $per->alamat_permohonan : "";
        $render->setValue('date_time', $per->updated_at->format('d/m/Y H:i:s'));
        $render->setValue('nomor_surat', $per->no_pendaftaran_sementara);
        $render->setValue('nama_pemohon',$nama);
        $render->setValue('jenis_perizinan', $per->getIzin->nama);

        $meta = json_decode($per->metadata, true);

        // nama tempat kerja/usaha berdasarkan kategori profil

        $izin = $per->getIzin()->first();

        if ($izin->jenisIzin->kategoriProfil->id == 1) {
            if(isset($meta['nama_tempat_kerja'])){
              $render->setValue('badan_usaha', strtoupper($meta['nama_tempat_kerja']));
            }
        } else if ($izin->jenisIzin->kategoriProfil->id == 2) {
            $render->setValue('badan_usaha',$per->getPerusahaan->nama_perusahaan);
        } else if ($izin->jenisIzin->kategoriProfil->id == 3) {
            $render->setValue('badan_usaha','-');
        } else if ($izin->jenisIzin->kategoriProfil->id == 4) {
            $render->setValue('badan_usaha',$per->badan_usaha);
        } else if ($izin->jenisIzin->kategoriProfil->id == 5) {
           $render->setValue('badan_usaha',$per->badan_usaha);
        } else if ($izin->jenisIzin->kategoriProfil->id == 6) {
            if($per->getReklame->nama_perusahaan){
              $render->setValue('badan_usaha', strtoupper($per->getReklame->nama_perusahaan));
            }
        } else if ($izin->jenisIzin->kategoriProfil->id == 7) {
            $render->setValue('badan_usaha',$per->badan_usaha);
        } else {
            $render->setValue('badan_usaha',$per->badan_usaha);
        }

        //identitas
        $nama_kadin = $identitas->kepala_dinas;
        $nip_kadin = $identitas->nip_kepala_dinas;
        $jabatan_kadin = $identitas->jabatan_kadin;
        $pangkat_kadin = $identitas->pangkat_kadin;
        $atas_nama = $identitas->atas_nama;

        $izin = $per->getIzin;
        $sk = $per->getFinal;

        if($izin->penanda_tangan_akhir == 'bupati'){
            $nama_ttd = $identitas->bupati;
            $nip="";
        }else{
            $nama_ttd = $identitas->kepala_dinas;
            $nip=$identitas->nip_kepala_dinas;
        }

        //pemohon
        $gelar_depan = is_nol_string('',$per->getPemohon->gelar_depan);
        $gelar_belakang = is_nol_string(',',$per->getPemohon->gelar_belakang);
        $nama_tengah = strtoupper($per->getPemohon->nama);
        $nama_pemohon = $gelar_depan." ".$nama_tengah." ".$gelar_belakang;
        $kode_tengah = ($per->getIzin->kode_sk_tengah != '' && $per->getIzin->kode_sk_tengah != null) ? $per->getIzin->kode_sk_tengah : 'DPMPTSP-PPL';

        //alamat pemohon
        $alamat_lengkap = ($per->getPemohon->alamat)? $per->getPemohon->alamat : "" ;
        $rt = is_nol_string('RT',$per->getPemohon->rt);
        $rw = is_nol_string('RW',$per->getPemohon->rw);
        $kel = is_nol_string('',$per->getPemohon->getKelurahan->name);
        $kec = is_nol_string('',$per->getPemohon->getKecamatan->name);
        $kab = is_nol_string('',$per->getPemohon->getKabupaten->name);
        $provinsi = is_nol_string('',$per->getPemohon->getProvinsi->name);
        $kodepos = is_nol_string('KODE POS',$per->getPemohon->kode_pos);

        //alamat permohonan
        $per_alamat = ($per->alamat_permohonan != "-") ? $per->alamat_permohonan : "";
        $per_rt = is_nol_string('RT',$per->lokasi_rt);
        $per_rw = is_nol_string('RW',$per->lokasi_rw);
        $per_kel = is_nol_string('',$per->lokasi_kel);
        $per_kec = is_nol_string('',$per->lokasi_kec);

        $alamat_pemohon = "$alamat_lengkap $rt $rw $kel $kec $kab $provinsi $kodepos";
        $alamat = "$per_alamat $per_rt $per_rw $per_kel $per_kec KOTA PALEMBANG";


        if(isset($meta['nama_tempat_kerja'])){
          $render->setValue('badan_usaha', strtoupper($meta['nama_tempat_kerja']));
        }else{
          $render->setValue('badan_usaha',$per->badan_usaha);
        }

        if(isset($meta['nama_tempat_kerja'])){
          $render->setValue('badan_usaha', strtoupper($meta['nama_tempat_kerja']));
        }else{
          $render->setValue('badan_usaha',$per->badan_usaha);
        }

        $render->setValue('lokasinya',htmlentities($alamat.",RT ".$per->lokasi_rt.",RW ".$per->lokasi_rw.",".$per->lokasi_kel.", ".$per->lokasi_kec));
        $render->setvalue('tanggal_pendaftaran', date_id($per->tgl_pendaftaran));
        $render->setValue('no_telp', htmlentities($per->getPemohon->no_telp));
        $render->setValue('tgl_cetak',date_id(date('Y-m-d')));

        $qrcode = generate_qrcode_2($per,$per->getPendaftar->nama,$per->getIzin->nama, true);
        $render->setImg('qrcode',array('src' => $qrcode,'swh'=>'120'));
        $render->setImg('kop_surat',array('src' => $kop_surat,'swh'=>'783'));

        $render->setValue('alamat_usaha', htmlentities(strtoupper($alamat)));
        $render->setValue('koordinat', htmlentities(strtoupper($per->koordinat)));

        //BAP
        $render->setValue('tgl_bap', htmlentities(date_id($per->tanggal_bap)));
        $render->setValue('no_bap', htmlentities(strtoupper($per->nomor_bap)));

        //Rekomendasi Teknis
        $render->setValue('tgl_rekom', htmlentities(date_id($per->tanggal_rekomendasi)));
        $render->setValue('no_rekom', htmlentities(strtoupper($per->nomor_rekomendasi_teknis)));

        //Pemohon
        $render->setValue('email', htmlentities(strtoupper($per->getPemohon->email)));
        $render->setValue('nik', htmlentities(strtoupper($per->getPemohon->nik)));
        $render->setValue('nama', htmlentities($nama_pemohon));
        $render->setValue('tempat_lahir', htmlentities(strtoupper($per->getPemohon->tempat_lahir)));
        $render->setValue('tanggal_lahir', htmlentities(date_id($per->getPemohon->tanggal_lahir)));
        $render->setValue('jenis_kelamin', htmlentities(strtoupper(($per->getPemohon->jenis_kelamin)? "Laki-laki" : "Perempuan")));
        $render->setValue('agama', htmlentities(strtoupper($per->getPemohon->getAgama->name)));
        $render->setValue('status_perkawinan', htmlentities(strtoupper($per->getPemohon->status_perkawinan)));
        $render->setValue('pekerjaan', htmlentities(strtoupper($per->getPemohon->pekerjaan)));
        $render->setValue('alamat', htmlentities(strtoupper($alamat_pemohon)));
        $render->setValue('no_telp', htmlentities(strtoupper($per->getPemohon->no_telp)));
        $render->setValue('kewarganegaraan', htmlentities(strtoupper($per->getPemohon->kewarganegaraan)));
        $render->setValue('nomor_paspor', htmlentities(strtoupper($per->getPemohon->nomor_paspor)));
        $render->setValue('tempat_terbit_passpor', htmlentities(strtoupper($per->getPemohon->tempat_terbit_passpor)));

        //Tanda tangan
        $render->setValue('nama_kadin', htmlentities($nama_kadin));
        $render->setValue('nip_kadin', htmlentities($nip_kadin));
        $render->setValue('jabatan_kadin', htmlentities($jabatan_kadin));
        $render->setValue('pangkat_kadin', htmlentities($pangkat_kadin));
        $render->setValue('atas_nama', htmlentities($atas_nama));

        $meta = json_decode($per->metadata, true);

        $kat = $per->getIzin->jenisIzin->kategoriProfil;
        if ($kat->id == 1) {

            $berlaku_sampai = (is_date_bol($per->getProfesi->berlaku_sampai)) ? date_id($per->getProfesi->berlaku_sampai) : $per->getProfesi->berlaku_sampai;

            $tahun_sip_str = (is_date_bol($per->getProfesi->berlaku_mulai)) ? date('Y',strtotime($per->getProfesi->berlaku_mulai)) : $per->getProfesi->berlaku_mulai;

            $render->setValue('nomor_str', htmlentities($per->getProfesi->nomor_str));
            $render->setValue('nomor_strfs', htmlentities($per->getProfesi->nomor_str));
            $render->setValue('penerbit', htmlentities(strtoupper($per->getProfesi->penerbit)));
            $render->setValue('berlaku_mulai', htmlentities($per->getProfesi->berlaku_mulai));
            $render->setValue('berlaku_sampai', htmlentities($berlaku_sampai));
            $render->setValue('kota_terbit', htmlentities(strtoupper($per->getProfesi->kota_terbit)));
            $render->setValue('jenis_cetakan_str', htmlentities(strtoupper($per->getProfesi->jenis_cetakan_str)));
            $render->setValue('jenis_pt', htmlentities(strtoupper($per->getProfesi->jenis_pt)));
            $render->setValue('nama_pt', htmlentities(strtoupper($per->getProfesi->nama_pt)));
            $render->setValue('kota_pt', htmlentities(strtoupper($per->getProfesi->kota_pt)));
            $render->setValue('kompetensi', htmlentities($per->getProfesi->kompetensi));
            $render->setValue('nomor_sertifikat_kompetensi', htmlentities($per->getProfesi->nomor_sertifikat_kompetensi));
            $render->setValue('tahun_lulus', htmlentities($per->getProfesi->tahun_lulus));
            $render->setValue('tahun_sip_str', htmlentities($tahun_sip_str));
        }elseif ($kat->id == 2){
            $render->setValue('jenis_perusahaan', htmlentities(strtoupper($per->getPerusahaan->jenis_perusahaan)));
            $render->setValue('status_jabatan', htmlentities(strtoupper($per->getPerusahaan->status_jabatan)));
            $render->setValue('nama_perusahaan', htmlentities(strtoupper($per->getPerusahaan->nama_perusahaan)));
            $render->setValue('alamat_perusahaan', htmlentities(strtoupper($per->getPerusahaan->alamat_perusahaan)));
            $render->setValue('nomor_akte_pendirian', htmlentities($per->getPerusahaan->nomor_akte_pendirian));
            $render->setValue('tanggal_akte_pendirian', htmlentities(date_id($per->getPerusahaan->tanggal_akte_pendirian)));
            $render->setValue('nama_notaris_pendirian', htmlentities(strtoupper($per->getPerusahaan->nama_notaris_pendirian)));
            $render->setValue('modal_dasar_pendirian', htmlentities($per->getPerusahaan->modal_dasar_pendirian));
            $render->setValue('modal_ditempatkan_pendirian', htmlentities($per->getPerusahaan->modal_ditempatkan_pendirian));
            $render->setValue('nomor_akte_perubahan', htmlentities($per->getPerusahaan->nomor_akte_perubahan));
            $render->setValue('tanggal_akte_perubahan', htmlentities(date_id($per->getPerusahaan->tanggal_akte_perubahan)));
            $render->setValue('nama_notaris_perubahan', htmlentities(strtoupper($per->getPerusahaan->nama_notaris_perubahan)));
            $render->setValue('modal_dasar_perubahan', htmlentities($per->getPerusahaan->modal_dasar_perubahan));
            $render->setValue('modal_ditempatkan_perubahan', htmlentities($per->getPerusahaan->modal_ditempatkan_perubahan));
            $render->setValue('kegiatan_utama', htmlentities(strtoupper($per->getPerusahaan->kegiatan_utama)));
            $render->setValue('no_ahu', htmlentities(strtoupper($per->getPerusahaan->no_ahu)));
            $render->setValue('direktur', htmlentities(strtoupper($per->getPerusahaan->direktur)));
            $render->setValue('komisaris_utama', htmlentities(strtoupper($per->getPerusahaan->komisaris_utama)));
            $render->setValue('komisaris', htmlentities(strtoupper($per->getPerusahaan->komisaris)));
            $render->setValue('saham_direktur', htmlentities(strtoupper($per->getPerusahaan->saham_direktur)));
            $render->setValue('saham_komisaris_utama', htmlentities(strtoupper($per->getPerusahaan->saham_komisaris_utama)));
            $render->setValue('saham_komisaris', htmlentities(strtoupper($per->getPerusahaan->saham_komisaris)));
            $render->setValue('status_perusahaan', htmlentities(strtoupper($per->getPerusahaan->status_perusahaan)));
        }elseif ($kat->id == 3){
            $render->setValue('jenis_sertifikat',  htmlentities(strtoupper($per->getPembangunan->jenis_sertifikat)));
            $render->setValue('nomor_sertifikat', htmlentities($per->getPembangunan->nomor_sertifikat));
            $render->setValue('nama_pada_sertifikat',  htmlentities(strtoupper($per->getPembangunan->nama_pada_sertifikat)));
            $render->setValue('tanggal_sertifikat', htmlentities(date_id($per->getPembangunan->tanggal_sertifikat)));
            $render->setValue('luas_tanah', htmlentities($per->getPembangunan->luas_tanah));
            $render->setValue('nomor_akte_jual_beli', htmlentities($per->getPembangunan->nomor_akte_jual_beli));
            $render->setValue('tanggal_akte_jual_beli', htmlentities(date_id($per->getPembangunan->tanggal_akte_jual_beli)));
            $render->setValue('nama_notaris',  htmlentities(strtoupper($per->getPembangunan->nama_notaris)));
            $render->setValue('nama_ahli_waris',  htmlentities(strtoupper($per->getPembangunan->nama_ahli_waris)));
            $render->setValue('nomor_gs', htmlentities($per->getPembangunan->nomor_gs));
            $render->setValue('tahun_gs', htmlentities($per->getPembangunan->tahun_gs));
        }elseif ($kat->id == 4){
            $render->setValue('nama_perusahaan', htmlentities(strtoupper($per->getKetenagakerjaan->nama_perusahaan)));
            $render->setValue('wni_pria', htmlentities($per->getKetenagakerjaan->wni_pria));
            $render->setValue('wni_wanita', htmlentities($per->getKetenagakerjaan->wni_wanita));
            $render->setValue('wna_pria', htmlentities($per->getKetenagakerjaan->wna_pria));
            $render->setValue('wna_wanita', htmlentities($per->getKetenagakerjaan->wna_wanita));
        }elseif ($kat->id == 5){
            $render->setValue('oleh', htmlentities(strtoupper($per->getLingkungan->oleh)));
            $render->setValue('nama_perusahaan', htmlentities(strtoupper($per->getLingkungan->nama_perusahaan)));
            $render->setValue('alamat_perusahaan', htmlentities(strtoupper($per->getLingkungan->alamat_perusahaan)));
            $render->setValue('jenis_kegiatan', htmlentities(strtoupper($per->getLingkungan->jenis_kegiatan)));
        }elseif ($kat->id == 6){
            $render->setValue('jenis_advertising', htmlentities(strtoupper($per->getReklame->jenis_advertising)));
            $render->setValue('nama_perusahaan', htmlentities(strtoupper($per->getReklame->nama_perusahaan)));
            $render->setValue('provinsi', htmlentities(strtoupper($per->getReklame->getProvinsi->name)));
            $render->setValue('kabupaten', htmlentities(strtoupper($per->getReklame->getKabupaten->name)));
            $render->setValue('kecamatan', htmlentities(strtoupper($per->getReklame->getKecamatan->name)));
            $render->setValue('kelurahan', htmlentities(strtoupper($per->getReklame->getKelurahan->name)));
            $render->setValue('rw', htmlentities($per->getReklame->rw));
            $render->setValue('rt', htmlentities($per->getReklame->rt));
            $render->setValue('kode_pos', htmlentities($per->getReklame->kode_pos));
            $render->setValue('alamat', htmlentities(strtoupper($per->getReklame->alamat)));
            $render->setValue('npwp', htmlentities(strtoupper($per->getReklame->npwp)));
            $render->setValue('npwp_d', htmlentities(strtoupper($per->getReklame->npwp_d)));
        }elseif ($kat->id == 7){
            $render->setValue('nomor_kendaraan', htmlentities($per->getTransportasi->nomor_kendaraan));
            $render->setValue('nomor_rangka', htmlentities($per->getTransportasi->nomor_rangka));
            $render->setValue('nomor_mesin', htmlentities($per->getTransportasi->nomor_mesin));
            $render->setValue('tahun_pembuatan', htmlentities($per->getTransportasi->tahun_pembuatan));
            $render->setValue('nama_pada_stnk', htmlentities(strtoupper($per->getTransportasi->nama_pada_stnk)));
        }

        foreach($meta as $key=>$value){
          if(isset($meta[$key]) && !is_null($value) && !is_array($value)){
              $render->setValue(strtoupper($key), htmlentities(strtoupper($value)));
              $render->setValue(strtolower($key), htmlentities(strtoupper($value)));
          }elseif(is_array($value)){
              $render->setValue(strtoupper($key), htmlentities(strtoupper($value[0])));
              $render->setValue(strtolower($key), htmlentities(strtoupper($value[0])));
          }

        }

        $filename = [
            'pdf'=>dokumen_path($per)."/".str_slug($per->no_pendaftaran_sementara)."_sementara.pdf",
            'docx'=>dokumen_path($per)."/".str_slug($per->no_pendaftaran_sementara)."_sementara.docx"
        ];

        $render->saveAs($filename['docx']);

        $fname = str_slug($per->no_pendaftaran_sementara)."_sementara.pdf";
        // Jika belum pernah di konversi sebelumnya
        $konversi = \App\Http\KonversiPdf::Konversi($per, $filename);
        if($konversi){
            $this->SaveSurat($per->id, 'Bukti Pendaftaran Sementara', 'Surat Bukti Pendaftaran Sementara', $fname);
            return response()->file($konversi,[
                'Content-Type' => 'application/pdf',
                'Content-Disposition'=>'inline;filename="'.$fname.'"'
            ]);
        }
    }

    function Download(Permohonan $per)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $path = dokumen_path($per);
        $file = str_slug($per->no_pendaftaran_sementara)."_sementara.pdf";
        $filename = $path."/".$file;

        $data =  $per;
        if (file_exists($filename)){
            return response()->file($filename);
        }else{
            $this->generatedBuktiSementara($data);
            return response()->file($filename,[
                'Content-Type' => 'application/pdf',
                'Content-Disposition'=>'inline;filename="'.$file.'"'
            ]);
        }
    }

    function CetakUlangBuktiPendaftaran(Request $r)
    {
        if($r->has('keyword')){
            $per = Permohonan::where('no_pendaftaran_sementara', $r['keyword'])
                ->orWhere('no_pendaftaran', $r['keyword'])
                ->orWhere('nik', $r['keyword'])
                ->orWhere('no_telepon', $r['keyword'])->get();

            return view('anggota.permohonan.cetak_ulang',compact('per'));
        }
    }

    function DownloadFormulir(JenisPermohonanIzin $izin)
    {
        return response()->download(storage_path('app/'.$izin->template_pendaftaran));
    }

    function PelengkapanUploadDokumen(Permohonan $per)
    {
        /*validating position*/
        if($per->posisi != 'pemohon')
        {
            return abort('404');
        }
        /**/

        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $izin = $per->getIzin()->first();
        $token = $per->getWorkflowStatus->token;
        $daftar =  new PermohonanWorkflow($token);
        $daftar->SetJenisPermohonanIzin($izin->id);
        $meta = $daftar->GetFormEdit($per)->form;

        $syarat = $per->getIzin->syarat()->get();
        $ext_file = $per->getVerifikasi()->get();
        if($ext_file->count() > 0){
            $file = $ext_file->toArray();
        }else{
            $file = false;
        }
        $form = (new \App\Workflow\FormPelengkapan($syarat, $file))->form;

        $pendaftar = $per->getPendaftar;
        $kecamatan = Kecamatan::where('kabupaten', 112)->get();
        $kelurahan = Kelurahan::where('kecamatan', 112)->get();
        $title = "Permohonan ".$per->getIzin->nama."";

        if ($izin->jenisIzin->kategoriProfil->id == 1) {
            $view = 'anggota.permohonan.melengkapi.berkas_profesi';
        } else if ($izin->jenisIzin->kategoriProfil->id == 2) {
            $view = 'anggota.permohonan.melengkapi.berkas_perusahaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 3) {
            $view = 'anggota.permohonan.melengkapi.berkas_pembangunan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 4) {
            $view = 'anggota.permohonan.melengkapi.berkas_ketenagakerjaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 5) {
            $view = 'anggota.permohonan.melengkapi.berkas_lingkungan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 6) {
            $view = 'anggota.permohonan.melengkapi.berkas_reklame';
        } else if ($izin->jenisIzin->kategoriProfil->id == 7) {
            $view = 'anggota.permohonan.melengkapi.berkas_transportasi';
        }
        return view($view, compact('meta', 'form', 'title', 'per', 'pendaftar', 'kecamatan', 'kelurahan','izin'));
    }

    function SavePelengkapanUploadDokumen(Request $r, Permohonan $per)
    {
        /*validating position*/
        if($per->posisi != 'pemohon')
        {
            return abort('404');
        }
        /**/

        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $izin = $per->getIzin()->first();
        $token = $per->getWorkflowStatus->token;
        $daftar =  new PermohonanWorkflow($token);
        $daftar->SetJenisPermohonanIzin($izin->id);
        $validate_field = $daftar->FormValidationWorkflow($daftar->jenis_permohonan_izin);
        $this->validate($r, $validate_field);
        $daftar->SubmitFormEditPermohonan($r->all(), $per);

        $file = [];
        if($r->hasFile('syarat')){
            foreach ($r->syarat as $key=>$sy) {
                if(!is_null($sy)){
                    $ext = $sy->getClientOriginalExtension();
                    $filename = $r->syarat[$key]->storeAs($token."/uploads", "persyaratan_$key.$ext");
                    $file[$key] = $filename;
                }
            }
        }

        $per->getVerifikasi()->delete();
        foreach($r['syarat_id'] as $key=>$val)
        {
            $verifikasi = new \App\Models\Verifikasi;
            $verifikasi->permohonan = $per->id;
            $verifikasi->syarat = $val;
            if(isset($r['syarat'][$key]))
            {
                $verifikasi->file = $file[$key];
            }else{
                $verifikasi->file = $r['syarat_value'][$key];
            }
            $verifikasi->ada_tidak = 1;

            $verifikasi->save();
        }

        \App\Workflow\PerizinanWorkflow::ToPendaftaranFromPemohon($per);

        //notifikasi
        $petugas = \App\Models\Role::where('id', 2)->first();
        $petugas->notify(new \App\Notifications\NotifikasiPerizinan($per,'pendaftaran','Perbaikan Permohonan'));

        flash('Permohonan berhasil diproses')->success();
        return redirect('permohonan');
    }

    function PerbaikanUploadDokumen(Permohonan $per)
    {
        /*validating position*/
        if($per->posisi != 'pemohon')
        {
            return abort('404');
        }
        /**/

        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $izin = $per->getIzin()->first();
        $token = $per->getWorkflowStatus->token;
        $daftar =  new PermohonanWorkflow($token);
        $daftar->SetJenisPermohonanIzin($izin->id);
        $meta = $daftar->GetFormEdit($per)->form;

        $syarat = $per->getIzin->syarat()->get();
        $ext_file = $per->getVerifikasi()->get();
        if($ext_file->count() > 0){
            $file = $ext_file->toArray();
        }else{
            $file = false;
        }
        $form = (new \App\Workflow\FormPerbaikan($syarat, $file))->form;

        $pendaftar = $per->getPendaftar;
        $kecamatan = Kecamatan::where('kabupaten', 112)->get();
        $kelurahan = Kelurahan::where('kecamatan', 112)->get();
        $title = "Permohonan ".$per->getIzin->nama."";

        if ($izin->jenisIzin->kategoriProfil->id == 1) {
            $view = 'anggota.permohonan.memperbaiki.berkas_profesi';
        } else if ($izin->jenisIzin->kategoriProfil->id == 2) {
            $view = 'anggota.permohonan.memperbaiki.berkas_perusahaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 3) {
            $view = 'anggota.permohonan.memperbaiki.berkas_pembangunan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 4) {
            $view = 'anggota.permohonan.memperbaiki.berkas_ketenagakerjaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 5) {
            $view = 'anggota.permohonan.memperbaiki.berkas_lingkungan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 6) {
            $view = 'anggota.permohonan.memperbaiki.berkas_reklame';
        } else if ($izin->jenisIzin->kategoriProfil->id == 7) {
            $view = 'anggota.permohonan.memperbaiki.berkas_transportasi';
        }

        return view($view, compact('meta', 'form', 'title', 'per', 'pendaftar', 'kecamatan', 'kelurahan','izin'));
    }

    function SavePerbaikanUploadDokumen(Request $r, Permohonan $per)
    {
        /*validating position*/
        if($per->posisi != 'pemohon')
        {
            return abort('404');
        }
        /**/

        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $izin = $per->getIzin()->first();
        $token = $per->getWorkflowStatus->token;
        $daftar =  new PermohonanWorkflow($token);
        $daftar->SetJenisPermohonanIzin($izin->id);
        $validate_field = $daftar->FormValidationWorkflow($daftar->jenis_permohonan_izin);
        $this->validate($r, $validate_field);
        $daftar->SubmitFormEditPermohonan($r->all(), $per);

        $file = [];
        if($r->hasFile('syarat')){
            foreach ($r->syarat as $key=>$sy) {
                if(!is_null($sy)){
                    $ext = $sy->getClientOriginalExtension();
                    $filename = $r->syarat[$key]->storeAs($token."/uploads", "persyaratan_$key.$ext");
                    $file[$key] = $filename;
                }
            }
        }

        $per->getVerifikasi()->delete();


        if($per->dari_kasi_apb && !$per->dari_korlap){
          // Jika sudah lewat kasi tapi belum di korlap
            foreach($r['syarat_id'] as $key=>$val)
            {
                $verifikasi = new \App\Models\Verifikasi;
                $verifikasi->permohonan = $per->id;
                $verifikasi->syarat = $val;
                if(isset($r['syarat'][$key]))
                {
                    $verifikasi->file = $file[$key];
                }else{
                    $verifikasi->file = $r['syarat_value'][$key];
                }
                $verifikasi->ada_tidak = 1;

                $verifikasi->save();
            }
          \App\Workflow\PerizinanWorkflow::ToKasiFromPemohon($per);
          //notifikasi
            $petugas = \App\Models\Role::where('id', 3)->first();
            $petugas->notify(new \App\Notifications\NotifikasiPerizinan($per,'kasi','Perbaikan Permohonan'));
        }elseif($per->dari_kasi_apb && $per->dari_korlap && !$per->dari_korlap_bap){
          // Jika sudah lewat kasi dan sudah lewat korlap tapi belum korlap bap
            foreach($r['syarat_id'] as $key=>$val)
            {
                $verifikasi = new \App\Models\Verifikasi;
                $verifikasi->permohonan = $per->id;
                $verifikasi->syarat = $val;
                if(isset($r['syarat'][$key]))
                {
                    $verifikasi->file = $file[$key];
                }else{
                    $verifikasi->file = $r['syarat_value'][$key];
                }
                $verifikasi->ada_tidak = 1;

                $verifikasi->save();
            }
            //notifikasi
            $petugas = \App\Models\Role::where('id', 4)->first();
            $petugas->notify(new \App\Notifications\NotifikasiPerizinan($per,'korlap','Perbaikan Permohonan'));
          \App\Workflow\PerizinanWorkflow::ToKorlapFromPemohon($per);
        }else{
          // Jika sudah lewat kasi korlap dan korlap bap
            foreach($r['syarat_id'] as $key=>$val)
            {
                $verifikasi = new \App\Models\Verifikasi;
                $verifikasi->permohonan = $per->id;
                $verifikasi->syarat = $val;
                if(isset($r['syarat'][$key]))
                {
                    $verifikasi->file = $file[$key];
                }else{
                    $verifikasi->file = $r['syarat_value'][$key];
                }
                $verifikasi->ada_tidak = 1;
                $verifikasi->sesuai_tidak = 1;

                $verifikasi->save();
            }
            //notifikasi
            $petugas = \App\Models\Role::where('id', 4)->first();
            $petugas->notify(new \App\Notifications\NotifikasiPerizinan($per,'korlap/bap','Perbaikan Permohonan'));
          \App\Workflow\PerizinanWorkflow::ToKorlapBAPFromPemohon($per);
        }

        flash('Permohonan berhasil diproses')->success();
        return redirect('permohonan');
    }

    function detailPermohonan(Permohonan $per)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $izin = $per->getIzin()->first();
        $token = $per->getWorkflowStatus->token;
        $meta = (array)json_decode($per->metadata);
        unset($meta['_token']);

        $syarat = $per->getIzin->syarat()->get();
        $ext_file = $per->getVerifikasi()->get();
        if($ext_file->count() > 0){
            $file = $ext_file->toArray();
        }else{
            $file = false;
        }
        $form = (new \App\Workflow\FormView($syarat, $file))->form;

        $pendaftar = $per->getPemohon;
        $kecamatan = Kecamatan::where('kabupaten', 112)->get();
        $kelurahan = Kelurahan::where('kecamatan', 112)->get();
        $title = "Permohonan ".$per->getIzin->nama."";

        if ($izin->jenisIzin->kategoriProfil->id == 1) {
            $permohonan_profile = 'anggota.partial.per_profesi';
        } else if ($izin->jenisIzin->kategoriProfil->id == 2) {
            $permohonan_profile = 'anggota.partial.per_perusahaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 3) {
            $permohonan_profile = 'anggota.partial.per_pembangunan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 4) {
            $permohonan_profile = 'anggota.partial.per_ketenagakerjaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 5) {
            $permohonan_profile = 'anggota.partial.per_lingkungan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 6) {
            $permohonan_profile = 'anggota.partial.per_reklame';
        } else if ($izin->jenisIzin->kategoriProfil->id == 7) {
            $permohonan_profile = 'anggota.partial.per_transportasi';
        }

        $view = 'anggota.permohonan.detail.permohonan';

        return view($view, compact('meta', 'form', 'title', 'per', 'pendaftar', 'kecamatan', 'kelurahan','permohonan_profile'));
    }

    function Pembayaran(Permohonan $per)
    {
        /*validating position*/
        if($per->posisi != 'pemohon')
        {
            return abort('404');
        }
        /**/

        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $title = 'Pembayaran';
        $view = 'anggota.permohonan.pembayaran';

        if($per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 4){
            $ret = \App\Models\RetImb::where('id_permohonan', $per->id)->first();
        }elseif($per->getIzin->kategori_prosedur_id == 7){
            $ret = \App\Models\RetKrk::where('id_permohonan', $per->id)->first();
        }elseif($per->getIzin->kategori_prosedur_id == 6){
            $ret = \App\Models\RetTrayek::where('id_permohonan', $per->id)->first();
        }else{
            $ret = \App\Models\Ret::where('id_permohonan', $per->id)->first();
        }


        return view($view, compact('title', 'per','ret'));
    }

    function SavePembayaran(Request $r, Permohonan $per)
    {
        /*validating position*/
        if($per->posisi != 'pemohon')
        {
            return abort('404');
        }
        /**/
        
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $this->validate($r, [
            'catatan_pembayaran'=>'required',
            'bukti_pembayaran'=>'required|file'
        ]);

        $token = $per->getWorkflowStatus->token;

        $ext = $r->bukti_pembayaran->getClientOriginalExtension();
        $filename = $r->bukti_pembayaran->storeAs($token."/uploads", "bukti_pembayaran.$ext");

        $per->bukti_pembayaran = $filename;
        $per->catatan_pembayaran = $r->catatan_pembayaran;
        $per->save();

        //notifikasi
        $petugas = \App\Models\Role::where('id', 8)->first();
        $petugas->notify(new \App\Notifications\NotifikasiPerizinan($per,'bendahara','Bukti Pembayaran'));

        \App\Workflow\PerizinanWorkflow::ToBendaharaFromPemohon($per);
        flash('Permohonan berhasil diproses ke BENDAHARA')->success();

        return redirect('permohonan');
    }

    function History()
    {
        $title = "History Permohonan Perizinan";
        $id_pendaftar = auth()->user()->id;
        $rs = Permohonan::where('id_pendaftar', $id_pendaftar)->orderBy('tgl_pendaftaran','desc')->paginate(10);
        $no = $rs->firstItem();
        return view('anggota.permohonan.history',compact('title','rs', 'no'));
    }

    function PrintSPM(Permohonan $per){
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        if($per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 4){
                // IMB dan IMB Revisi
                $ret = \App\Models\RetImb::where('id_permohonan', $per->id)->first();
                if($ret){
                    $user = true;
                    return view('spm.cetak', compact('per','ret','user'));
                }else{
                    return response()->json(['status'=>'false']);
                }
        }elseif($per->getIzin->kategori_prosedur_id == 7){
                // KRK
                $ret = \App\Models\RetKrk::where('id_permohonan', $per->id)->first();
                if($ret){
                    $user = true;
                    return view('spm.cetak', compact('per','ret','user'));
                }else{
                    return response()->json(['status'=>'false']);
                }
        }elseif($per->getIzin->kategori_prosedur_id == 6){
                // TRAYEK
                $ret = \App\Models\RetTrayek::where('id_permohonan', $per->id)->first();
                if($ret){
                    $user = true;
                    return view('spm.cetak', compact('per','ret','user'));
                }else{
                    return response()->json(['status'=>'false']);
                }
        }else{
                // RETRIBUSI
                $ret = \App\Models\Ret::where('id_permohonan', $per->id)->first();
                if($ret){
                    $user = true;
                    return view('spm.cetak', compact('per','ret','user'));
                }else{
                    return response()->json(['status'=>'false']);
                }
        }
    }

    function downloadSK(Permohonan $per)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $izin = $per->getIzin;
        $path = dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara)."_kadin_signed.pdf";
        $filename = $path;
        if (file_exists($filename)){
            return response()->file($filename);
        }else{
            exit('Requested file does not exist on our server!');
        }
    }

    function downloadSKRD(Permohonan $per)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $izin = $per->getIzin;
        $path = dokumen_path($per)."/SKRD_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara)."_kadin_signed.pdf";
        $filename = $path;
        if (file_exists($filename)){
            return response()->file($filename);
        }else{
            exit('Requested file does not exist on our server!');
        }
    }

    function downloadSKPencabutan(Pencabutan $pen)
    {
        $per = $pen->getPermohonan;
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $izin = $per->getIzin;
        $path = dokumen_path_pencabutan($pen)."/SK_PENCABUTAN_".str_slug($izin->nama)."_".str_slug($pen->no_pencabutan)."_kadin_signed.pdf";
        $filename = $path;

        if (file_exists($filename)){
            return response()->file($filename);
        }else{
            exit('Requested file does not exist on our server!');
        }
    }

    function batalPermohonan(Permohonan $per)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        if($per->posisi == 'arsip' || $per->posisi == 'selesai' || $per->posisi == 'pengambilan' || $per->posisi == 'tolak' || $per->posisi == 'batal'){
            return abort('404');
        }

        $izin = $per->getIzin()->first();
        $token = $per->getWorkflowStatus->token;
        $meta = (array)json_decode($per->metadata);
        unset($meta['_token']);

        $syarat = $per->getIzin->syarat()->get();
        $ext_file = $per->getVerifikasi()->get();
        if($ext_file->count() > 0){
            $file = $ext_file->toArray();
        }else{
            $file = false;
        }
        $form = (new \App\Workflow\FormView($syarat, $file))->form;

        $pendaftar = $per->getPemohon;
        $kecamatan = Kecamatan::where('kabupaten', 112)->get();
        $kelurahan = Kelurahan::where('kecamatan', 112)->get();
        $title = "Permohonan ".$per->getIzin->nama."";

        if ($izin->jenisIzin->kategoriProfil->id == 1) {
            $permohonan_profile = 'anggota.partial.per_profesi';
        } else if ($izin->jenisIzin->kategoriProfil->id == 2) {
            $permohonan_profile = 'anggota.partial.per_perusahaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 3) {
            $permohonan_profile = 'anggota.partial.per_pembangunan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 4) {
            $permohonan_profile = 'anggota.partial.per_ketenagakerjaan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 5) {
            $permohonan_profile = 'anggota.partial.per_lingkungan';
        } else if ($izin->jenisIzin->kategoriProfil->id == 6) {
            $permohonan_profile = 'anggota.partial.per_reklame';
        } else if ($izin->jenisIzin->kategoriProfil->id == 7) {
            $permohonan_profile = 'anggota.partial.per_transportasi';
        }

        $view = 'anggota.permohonan.batal.permohonan';

        return view($view, compact('meta', 'form', 'title', 'per', 'pendaftar', 'kecamatan', 'kelurahan','permohonan_profile'));
    }

    function submitBatal(Permohonan $per, Request $r)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        if($per->posisi == 'arsip' || $per->posisi == 'selesai' || $per->posisi == 'pengambilan' || $per->posisi == 'tolak' || $per->posisi == 'batal'){
            return abort('404');
        }

        $this->validate($r,[
            'keterangan' => 'required'
        ]);

        $per->posisi = 'batal';
        $per->keterangan_batal = $r->keterangan;
        $per->tanggal_batal = date('Y-m-d');
        $per->save();

        //notifikasi
        $petugas = \App\Models\Role::where('id', 1)->first();
        $petugas->notify(new \App\Notifications\NotifikasiPerizinan($per,'permohonan','Permohonan dibatalkan'));

        return redirect(url('permohonan'));
    }

    function sendEmailPermohonan(Permohonan $permohonan)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $permohonan->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $email = new PermohonanEmail($permohonan);
        Mail::to($permohonan->getPendaftar->email)->send($email);
        return response()->json(true);
    }

}

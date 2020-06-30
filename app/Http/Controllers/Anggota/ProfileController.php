<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Profesi;
use App\Models\PendaftarProfesi;
use App\Models\PendaftarPerusahaan;
use App\Models\PendaftarPembangunan;
use App\Models\PendaftarKetenagakerjaan;
use App\Models\PendaftarLingkungan;
use App\Models\PendaftarReklame;
use App\Models\PendaftarTransportasi;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Agama;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:pendaftar');
    }

    function Ktp($mode=null)
    {
        $pendaftar = Pendaftar::find(auth()->user()->id);
        $provinsi = Provinsi::get();
        $kabupaten = Kabupaten::get();
        $kecamatan = Kecamatan::get();
        $agama = Agama::get();
        $title = "Profile Data Pribadi";
        return view('anggota.profile.ktp', compact('title', 'pendaftar','provinsi','agama','mode'));
    }

    function getKabupaten($provinsi)
    {
        $opt="";
        $kab = Kabupaten::where('provinsi', $provinsi)->get();
        if($kab->count() > 0){
            foreach($kab as $qry){
                $opt.="<option value='".$qry->id."'>".$qry->name."</option>";
            }
        }else{
            $opt.="";
        }

        return $opt;
    }

    function getKecamatan($kabupaten)
    {
        $opt="";
        $kec = Kecamatan::where('kabupaten', $kabupaten)->get();
        if($kec->count() > 0){
            foreach($kec as $qry){
                $opt.="<option value='".$qry->id."'>".$qry->name."</option>";
            }
        }else{
            $opt.="";
        }

        return $opt;
    }

    function getKelurahan($kecamatan)
    {
        $opt="";
        $kel = Kelurahan::where('kecamatan', $kecamatan)->get();
        if($kel->count() > 0){
            foreach($kel as $qry){
                $opt.="<option value='".$qry->id."'>".$qry->name."</option>";
            }
        }else{
            $opt.="";
        }

        return $opt;
    }

    function UpdateKtp(Request $r)
    {
        $this->validate($r, [
            'nik'=>'required',
            'nama'=>'required',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'jenis_kelamin'=>'required',
            'agama'=>'required',
            'provinsi'=>'required',
            'kabupaten'=>'required',
            'kecamatan'=>'required',
            'kelurahan'=>'required',
            'rw'=>'required',
            'rt'=>'required',
            'kode_pos'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
            'email'=>'required|unique:m_pendaftar,email,'.auth()->user()->id,
            'kewarganegaraan'=>'required',
            'mode'=>'required'
        ]);

        if ($r->mode == 'ubah') {
            return redirect('profile/ktp/ubah');
        }

        $pendaftar = Pendaftar::find(auth()->user()->id);

        /* 
         *--- cek nik ---
         */
            if($r->mode != 'ubah'){
                $isEmptyNull = Pendaftar::where("id","!=",$pendaftar->id)
                                        ->where("nik",$r->nik);
                if($isEmptyNull->count() > 0){
                    $messages = [
                        'msg' => 'NIK Sudah terdaftar Sebelumnya'
                    ];
                    return back()->withErrors($messages);
                }
            }

        /*
         *
         */

        if (empty($pendaftar->pas_foto)) {
            $this->validate($r, [
                'pas_foto'=>'required|image|max:2048'
            ]);
            //required|image|max:2048|dimensions:min_width=152,min_height=226,ratio=4/6'
        }
        $pendaftar->nik = strtoupper($r->nik);
        $pendaftar->gelar_depan = $r->gelar_depan;
        $pendaftar->nama = strtoupper($r->nama);
        $pendaftar->gelar_belakang = $r->gelar_belakang;
        $pendaftar->tempat_lahir = strtoupper($r->tempat_lahir);
        $pendaftar->tanggal_lahir = $r->tanggal_lahir;
        $pendaftar->jenis_kelamin = $r->jenis_kelamin;
        $pendaftar->agama = $r->agama;
        $pendaftar->status_perkawinan = $r->status_perkawinan;
        $pendaftar->pekerjaan = $r->pekerjaan;
        $pendaftar->provinsi = $r->provinsi;
        $pendaftar->kabupaten = $r->kabupaten;
        $pendaftar->kecamatan = $r->kecamatan;
        $pendaftar->kelurahan = $r->kelurahan;
        $pendaftar->rw = $r->rw;
        $pendaftar->rt = $r->rt;
        $pendaftar->kode_pos = $r->kode_pos;
        $pendaftar->alamat = strtoupper($r->alamat);
        $pendaftar->email = $r->email;
        $pendaftar->no_telp = $r->no_telp;
        $pendaftar->kewarganegaraan = $r->kewarganegaraan;
        $pendaftar->nomor_passpor = $r->nomor_passpor;
        $pendaftar->tempat_terbit_passpor = strtoupper($r->tempat_terbit_passpor);

        if ($r->hasFile('pas_foto')) {
            $this->validate($r, [
                'pas_foto'=>'required|image|max:2048'
                //'required|image|mimes:jpeg|max:2048|dimensions:min_width=152,min_height=226,ratio=4/6'
            ]);
            $ext = $r->pas_foto->getClientOriginalExtension();
            $filename = $r->nama."_".time().".".$ext;
            $r->pas_foto->storeAs("pasfoto", $filename);

            $pendaftar->pas_foto = $filename;
        }

        $pendaftar->save();
        flash('Profile sesuai KTP berhasil disimpan')->success();
        return redirect('profile/ktp/');
    }

    function Profesi()
    {
        $title = "Profile Data Profesi";
        $id_pendaftar = auth()->user()->id;
        $data = PendaftarProfesi::where('id_pendaftar', $id_pendaftar)->orderBy('id','DESC')->paginate(10);
        $no = $data->firstItem();
        return view('anggota.profesi.index',compact('title','no','data'));
    }

    function AddProfesi()
    {
        $title = "Tambah Profesi Baru";
        $listProfesi = Profesi::all();
        $profesi = new PendaftarProfesi;
        return view('anggota.profesi.form',compact('title','profesi','listProfesi'));
    }

    function EditProfesi(PendaftarProfesi $profesi)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $profesi->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $title = "Edit Profesi";
        $listProfesi = Profesi::all();
        return view('anggota.profesi.form',compact('title','profesi','listProfesi'));
    }

    function SaveProfesi(Request $r)
    {
        $this->validate($r, [
            'id_profesi'=>'required',
            'nomor_str'=>'required',
            'penerbit'=>'required',
            'kota_terbit'=>'required',
            'jenis_cetakan_str'=>'required',
            'jenis_pt'=>'required',
            'nama_pt'=>'required',
            'status_pt'=>'required',
            'kota_pt'=>'required',
            'kota_pt'=>'required',
            'kompetensi'=>'required',
            'nomor_sertifikat_kompetensi'=>'required',
            'tahun_lulus'=>'required',
            'jenis_berlaku'=>'required'
        ]);

        $id_pendaftar = auth()->user()->id;

        if ($r->id == null) {
            $rs = new PendaftarProfesi;
        }else{
            /*---auth---*/
            $user = PendaftarProfesi::where('id', $r->id)->first()->id_pendaftar;
            $auth = auth()->user()->id;
            if($auth != $user){
                return abort('404');
            }
            /*---/auth---*/
            $rs = PendaftarProfesi::where('id', $r->id)->first();
        }

        $rs->id_pendaftar = $id_pendaftar;
        $rs->id_profesi = $r->id_profesi;
        $rs->jenis_berlaku = $r->jenis_berlaku;
        $rs->nomor_str = strtoupper($r->nomor_str);
        $rs->penerbit = strtoupper($r->penerbit);
        $rs->kota_terbit = strtoupper($r->kota_terbit);
        if($r->jenis_berlaku == "tanggal"){
            $this->validate($r,[
                "berlaku_mulai_tanggal" => 'required',
                "berlaku_sampai_tanggal" => 'required',
            ]);
            $rs->berlaku_mulai = date_indo($r->berlaku_mulai_tanggal);
            $rs->berlaku_sampai = date_indo($r->berlaku_sampai_tanggal);
        }else{
            $this->validate($r,[
                "berlaku_mulai_text" => 'required',
                "berlaku_sampai_text" => 'required',
            ]);
            $rs->berlaku_mulai = strtoupper($r->berlaku_mulai_text);
            $rs->berlaku_sampai = strtoupper($r->berlaku_sampai_text);
        }
        $rs->jenis_cetakan_str = strtoupper($r->jenis_cetakan_str);
        $rs->jenis_pt = strtoupper($r->jenis_pt);
        $rs->nama_pt = strtoupper($r->nama_pt);
        $rs->status_pt = strtoupper($r->status_pt);
        $rs->kota_pt = strtoupper($r->kota_pt);
        $rs->kompetensi = strtoupper($r->kompetensi);
        $rs->nomor_sertifikat_kompetensi = strtoupper($r->nomor_sertifikat_kompetensi);
        $rs->tahun_lulus = $r->tahun_lulus;
        $rs->save();

        if ($r->id == null) {
            flash('Profile Profesi Berhasil Ditambahkan')->success();
        }else{
            flash('Profile Profesi Berhasil Diperbaharui')->success();
        }
        return redirect('profile/profesi');
    }

    function DeleteProfesi(PendaftarProfesi $profesi)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $profesi->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $profesi->delete();
        flash('Data Profesi berhasil dihapus')->success();
        return redirect('profile/profesi');
    }

    //Profil Perusahaan
    function Perusahaan()
    {
        $title = "Profile Perusahaan";
        $id_pendaftar = auth()->user()->id;
        $data = PendaftarPerusahaan::where('id_pendaftar', $id_pendaftar)->orderBy('id','DESC')->paginate(10);
        $no = $data->firstItem();
        return view('anggota.perusahaan.index',compact('title','no','data'));
    }

    function AddPerusahaan()
    {
        $title = "Tambah Perusahaan Baru";
        $perusahaan = new PendaftarPerusahaan;
        return view('anggota.perusahaan.form',compact('title','perusahaan'));
    }

    function EditPerusahaan(PendaftarPerusahaan $perusahaan)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $perusahaan->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $title = "Edit Perusahaan";
        return view('anggota.perusahaan.form',compact('title','perusahaan'));
    }

    function SavePerusahaan(Request $r)
    {
        $this->validate($r, [
            'alamat_perusahaan'=>'required',
            'jenis_perusahaan'=>'required',
            'status_jabatan'=>'required',
            'nomor_akte_pendirian'=>'required',
            'tanggal_akte_pendirian'=>'required',
            'nama_notaris_pendirian'=>'required',
            'modal_dasar_pendirian'=>'required',
            'modal_ditempatkan_pendirian'=>'required',
            'kedudukan_perusahaan'=>'required',
            'kegiatan_utama'=>'required',
            'tlp_perusahaan'=>'required',
            'npwp_perusahaan'=>'required',
            'no_ahu'=>'required',
            'direktur'=>'required',
            'komisaris_utama'=>'required',
            'komisaris'=>'required',
            'saham_direktur'=>'required',
            'saham_komisaris_utama'=>'required',
            'saham_komisaris'=>'required',
            'status_perusahaan'=>'required'

        ]);

        $id_pendaftar = auth()->user()->id;

        if ($r->id == null) {
            $this->validate($r,[
                'nama_perusahaan'=>'required|unique:m_pendaftar_perusahaan',
            ]);
            $rs = new PendaftarPerusahaan;
        }else{
            /*---auth---*/
            $user = PendaftarPerusahaan::where('id', $r->id)->first()->id_pendaftar;
            $auth = auth()->user()->id;
            if($auth != $user){
                return abort('404');
            }
            /*---/auth---*/
            $rs = PendaftarPerusahaan::where('id', $r->id)->first();
        }

        $tanggal_akte_pendirian = date_indo($r->tanggal_akte_pendirian);
        $tanggal_akte_perubahan = date_indo($r->tanggal_akte_perubahan);

        //dd($tanggal_akte_pendirian);

        $rs->id_pendaftar = $id_pendaftar;
        $rs->nama_perusahaan = strtoupper($r->nama_perusahaan);
        $rs->alamat_perusahaan = strtoupper($r->alamat_perusahaan);
        $rs->jenis_perusahaan = strtoupper($r->jenis_perusahaan);
        $rs->status_jabatan = strtoupper($r->status_jabatan);
        $rs->nomor_akte_pendirian = strtoupper($r->nomor_akte_pendirian);
        $rs->tanggal_akte_pendirian = $tanggal_akte_pendirian;
        $rs->nama_notaris_pendirian = strtoupper($r->nama_notaris_pendirian);
        $rs->modal_dasar_pendirian = $r->modal_dasar_pendirian;
        $rs->modal_ditempatkan_pendirian = $r->modal_ditempatkan_pendirian;
        $rs->kedudukan_perusahaan = strtoupper($r->kedudukan_perusahaan);
        $rs->nomor_akte_perubahan = strtoupper($r->nomor_akte_perubahan);
        $rs->tanggal_akte_perubahan = $tanggal_akte_perubahan;
        $rs->nama_notaris_perubahan = strtoupper($r->nama_notaris_perubahan);
        $rs->modal_dasar_perubahan = $r->modal_dasar_perubahan;
        $rs->modal_ditempatkan_perubahan = $r->modal_ditempatkan_perubahan;
        $rs->kegiatan_utama = strtoupper($r->kegiatan_utama);
        $rs->tlp_perusahaan = strtoupper($r->tlp_perusahaan);
        $rs->npwp_perusahaan = strtoupper($r->npwp_perusahaan);
        $rs->no_ahu = strtoupper($r->no_ahu);
        $rs->direktur = strtoupper($r->direktur);
        $rs->komisaris_utama = strtoupper($r->komisaris_utama);
        $rs->komisaris = strtoupper($r->komisaris);
        $rs->saham_direktur = strtoupper($r->saham_direktur);
        $rs->saham_komisaris_utama = strtoupper($r->saham_komisaris_utama);
        $rs->saham_komisaris = strtoupper($r->saham_komisaris);
        $rs->status_perusahaan = strtoupper($r->status_perusahaan);
        $rs->save();

        if ($r->id == null) {
            flash('Profile Perusahaan Berhasil Ditambahkan')->success();
        }else{
            flash('Profile perusahaan Berhasil Diperbaharui')->success();
        }
        return redirect('profile/perusahaan');
    }

    function DeletePerusahaan(PendaftarPerusahaan $perusahaan)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $perusahaan->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $perusahaan->delete();
        flash('Data Perusahaan berhasil dihapus')->success();
        return redirect('profile/perusahaan');
    }

    //Profil Pembangunan
    function Pembangunan()
    {
        $title = "Profile Pembangunan";
        $id_pendaftar = auth()->user()->id;
        $data = PendaftarPembangunan::where('id_pendaftar', $id_pendaftar)->orderBy('id','DESC')->paginate(10);
        $no = $data->firstItem();
        return view('anggota.pembangunan.index',compact('title','no','data'));
    }

    function AddPembangunan()
    {
        $title = "Tambah Pembangunan Baru";
        $pembangunan = new PendaftarPembangunan;
        return view('anggota.pembangunan.form',compact('title','pembangunan'));
    }

    function EditPembangunan(PendaftarPembangunan $pembangunan)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $pembangunan->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $title = "Edit Pembangunan";
        return view('anggota.pembangunan.form',compact('title','pembangunan'));
    }

    function SavePembangunan(Request $r)
    {
        $this->validate($r, [
            'jenis_sertifikat'=>'required',
            'nomor_sertifikat'=>'required',
            'nama_pada_sertifikat'=>'required',
            'tanggal_sertifikat'=>'required',
            'luas_tanah'=>'required',
            'nomor_akte_jual_beli'=>'required',
            'tanggal_akte_jual_beli'=>'required',
            'nama_notaris'=>'required',
            'nama_ahli_waris'=>'required',
            'nomor_gs'=>'required',
            'tahun_gs'=>'required'
        ]);

        $id_pendaftar = auth()->user()->id;

        if ($r->id == null) {
            $rs = new PendaftarPembangunan;
        }else{
            /*---auth---*/
            $user = PendaftarPembangunan::where('id', $r->id)->first()->id_pendaftar;
            $auth = auth()->user()->id;
            if($auth != $user){
                return abort('404');
            }
            /*---/auth---*/
            $rs = PendaftarPembangunan::where('id', $r->id)->first();
        }

        $tanggal_sertifikat = date_indo($r->tanggal_sertifikat);
        $tanggal_akte_jual_beli = date_indo($r->tanggal_akte_jual_beli);
        $rs->id_pendaftar = $id_pendaftar;
        $rs->jenis_sertifikat = strtoupper($r->jenis_sertifikat);
        $rs->nomor_sertifikat = strtoupper($r->nomor_sertifikat);
        $rs->nama_pada_sertifikat = strtoupper($r->nama_pada_sertifikat);
        $rs->tanggal_sertifikat = $tanggal_sertifikat;
        $rs->luas_tanah = strtoupper($r->luas_tanah);
        $rs->nomor_akte_jual_beli = strtoupper($r->nomor_akte_jual_beli);
        $rs->tanggal_akte_jual_beli = $tanggal_akte_jual_beli;
        $rs->nama_notaris = strtoupper($r->nama_notaris);
        $rs->nama_ahli_waris = strtoupper($r->nama_ahli_waris);
        $rs->nomor_gs = strtoupper($r->nomor_gs);
        $rs->tahun_gs = strtoupper($r->tahun_gs);
        $rs->save();

        if ($r->id == null) {
            flash('Profile Pembangunan Berhasil Ditambahkan')->success();
        }else{
            flash('Profile Pembangunan Berhasil Diperbaharui')->success();
        }
        return redirect('profile/pembangunan');
    }

    function DeletePembangunan(PendaftarPembangunan $pembangunan)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $pembangunan->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $pembangunan->delete();
        flash('Data Pembangunan berhasil dihapus')->success();
        return redirect('profile/pembangunan');
    }

    //Profil Ketenagakerjaan
    function Ketenagakerjaan()
    {
        $title = "Profile Ketenagakerjaan";
        $id_pendaftar = auth()->user()->id;
        $data = PendaftarKetenagakerjaan::where('id_pendaftar', $id_pendaftar)->orderBy('id','DESC')->paginate(10);
        $no = $data->firstItem();
        return view('anggota.ketenagakerjaan.index',compact('title','no','data'));
    }

    function AddKetenagakerjaan()
    {
        $title = "Tambah Ketenagakerjaan Baru";
        $ketenagakerjaan = new PendaftarKetenagakerjaan;
        return view('anggota.ketenagakerjaan.form',compact('title','ketenagakerjaan'));
    }

    function EditKetenagakerjaan(PendaftarKetenagakerjaan $ketenagakerjaan)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $ketenagakerjaan->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $title = "Edit Ketenagakerjaan";
        return view('anggota.ketenagakerjaan.form',compact('title','ketenagakerjaan'));
    }

    function SaveKetenagakerjaan(Request $r)
    {
        $this->validate($r, [
            'nama_perusahaan'=>'required',
            'wni_pria'=>'required',
            'wni_wanita'=>'required',
            'wna_pria'=>'required',
            'wna_wanita'=>'required'
        ]);

        $id_pendaftar = auth()->user()->id;

        if ($r->id == null) {
            $rs = new PendaftarKetenagakerjaan;
        }else{
            /*---auth---*/
            $user = PendaftarKetenagakerjaan::where('id', $r->id)->first()->id_pendaftar;
            $auth = auth()->user()->id;
            if($auth != $user){
                return abort('404');
            }
            /*---/auth---*/
            $rs = PendaftarKetenagakerjaan::where('id', $r->id)->first();
        }

        $rs->id_pendaftar = $id_pendaftar;
        $rs->nama_perusahaan = strtoupper($r->nama_perusahaan);
        $rs->wni_pria = strtoupper($r->wni_pria);
        $rs->wni_wanita = strtoupper($r->wni_wanita);
        $rs->wna_pria = strtoupper($r->wna_pria);
        $rs->wna_wanita = strtoupper($r->wna_wanita);
        $rs->save();

        if ($r->id == null) {
            flash('Profile Ketenagakerjaan Berhasil Ditambahkan')->success();
        }else{
            flash('Profile Ketenagakerjaan Berhasil Diperbaharui')->success();
        }
        return redirect('profile/ketenagakerjaan');
    }

    function DeleteKetenagakerjaan(PendaftarKetenagakerjaan $ketenagakerjaan)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $ketenagakerjaan->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $ketenagakerjaan->delete();
        flash('Data Ketenagakerjaan berhasil dihapus')->success();
        return redirect('profile/ketenagakerjaan');
    }

    //Profil Lingkungan
    function Lingkungan()
    {
        $title = "Profile Lingkungan";
        $id_pendaftar = auth()->user()->id;
        $data = PendaftarLingkungan::where('id_pendaftar', $id_pendaftar)->orderBy('id','DESC')->paginate(10);
        $no = $data->firstItem();
        return view('anggota.lingkungan.index',compact('title','no','data'));
    }

    function AddLingkungan()
    {
        $title = "Tambah Lingkungan Baru";
        $lingkungan = new PendaftarLingkungan;
        return view('anggota.lingkungan.form',compact('title','lingkungan'));
    }

    function EditLingkungan(PendaftarLingkungan $lingkungan)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $lingkungan->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $title = "Edit Lingkungan";
        return view('anggota.lingkungan.form',compact('title','lingkungan'));
    }

    function SaveLingkungan(Request $r)
    {
        $this->validate($r, [
            'jenis_kegiatan'=>'required',
            'oleh'=>'required',
        ]);

        $id_pendaftar = auth()->user()->id;

        if ($r->id == null) {
            $this->validate($r,[
                'nama_perusahaan'=>'required|unique:m_pendaftar_lingkungan',
            ]);
            $rs = new PendaftarLingkungan;
        }else{
            /*---auth---*/
            $user = PendaftarLingkungan::where('id', $r->id)->first()->id_pendaftar;
            $auth = auth()->user()->id;
            if($auth != $user){
                return abort('404');
            }
            /*---/auth---*/
            $rs = PendaftarLingkungan::where('id', $r->id)->first();
        }

        $rs->id_pendaftar = $id_pendaftar;
        $rs->jenis_kegiatan = strtoupper($r->jenis_kegiatan);
        $rs->oleh = strtoupper($r->oleh);
        $rs->nama_perusahaan = strtoupper($r->nama_perusahaan);
        $rs->alamat_perusahaan = strtoupper($r->alamat_perusahaan);
        $rs->save();

        if ($r->id == null) {
            flash('Profile Lingkungan Berhasil Ditambahkan')->success();
        }else{
            flash('Profile Lingkungan Berhasil Diperbaharui')->success();
        }
        return redirect('profile/lingkungan');
    }

    function DeleteLingkungan(PendaftarLingkungan $lingkungan)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $lingkungan->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $lingkungan->delete();
        flash('Data Lingkungan berhasil dihapus')->success();
        return redirect('profile/lingkungan');
    }

    //Profil Reklame
    function Reklame()
    {
        $title = "Profile Reklame";
        $id_pendaftar = auth()->user()->id;
        $data = PendaftarReklame::where('id_pendaftar', $id_pendaftar)->orderBy('id','DESC')->paginate(10);
        $no = $data->firstItem();
        return view('anggota.reklame.index',compact('title','no','data'));
    }

    function AddReklame()
    {
        $title = "Tambah Reklame Baru";
        $provinsi = Provinsi::get();
        $reklame = new PendaftarReklame;
        return view('anggota.reklame.form',compact('title','reklame','provinsi'));
    }

    function EditReklame(PendaftarReklame $reklame)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $reklame->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $title = "Edit Reklame";
        $provinsi = Provinsi::get();
        return view('anggota.reklame.form',compact('title','reklame','provinsi'));
    }

    function SaveReklame(Request $r)
    {
        $this->validate($r, [
            'jenis_advertising'=>'required',
            'nama_perusahaan'=>'required',
            'provinsi'=>'required',
            'kabupaten'=>'required',
            'kecamatan'=>'required',
            'kelurahan'=>'required',
            'rw'=>'required',
            'rt'=>'required',
            'kode_pos'=>'required',
            'npwp'=>'required',
            'npwp_d'=>'required',
            'alamat'=>'required'
        ]);

        $id_pendaftar = auth()->user()->id;

        if ($r->id == null) {
            $rs = new PendaftarReklame;
        }else{
            /*---auth---*/
            $user = PendaftarReklame::where('id', $r->id)->first()->id_pendaftar;
            $auth = auth()->user()->id;
            if($auth != $user){
                return abort('404');
            }
            /*---/auth---*/
            $rs = PendaftarReklame::where('id', $r->id)->first();
        }

        $rs->id_pendaftar = $id_pendaftar;
        $rs->jenis_advertising = strtoupper($r->jenis_advertising);
        $rs->nama_perusahaan = strtoupper($r->nama_perusahaan);
        $rs->provinsi = $r->provinsi;
        $rs->kabupaten = $r->kabupaten;
        $rs->kecamatan = $r->kecamatan;
        $rs->kelurahan = $r->kelurahan;
        $rs->npwp = $r->npwp;
        $rs->npwp_d = $r->npwp_d;
        $rs->rw = strtoupper($r->rw);
        $rs->rt = strtoupper($r->rt);
        $rs->kode_pos = strtoupper($r->kode_pos);
        $rs->alamat = strtoupper($r->alamat);
        $rs->save();

        if ($r->id == null) {
            flash('Profile Reklame Berhasil Ditambahkan')->success();
        }else{
            flash('Profile Reklame Berhasil Diperbaharui')->success();
        }
        return redirect('profile/reklame');
    }

    function DeleteReklame(PendaftarReklame $reklame)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $reklame->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $reklame->delete();
        flash('Data Reklame berhasil dihapus')->success();
        return redirect('profile/reklame');
    }

    //Profil Transportasi
    function Transportasi()
    {
        $title = "Profile Transportasi";
        $id_pendaftar = auth()->user()->id;
        $data = PendaftarTransportasi::where('id_pendaftar', $id_pendaftar)->orderBy('id','DESC')->paginate(10);
        $no = $data->firstItem();
        return view('anggota.transportasi.index',compact('title','no','data'));
    }

    function AddTransportasi()
    {
        $title = "Tambah Transportasi Baru";
        $transportasi = new PendaftarTransportasi;
        return view('anggota.transportasi.form',compact('title','transportasi'));
    }

    function EditTransportasi(PendaftarTransportasi $transportasi)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $transportasi->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $title = "Edit Transportasi";
        return view('anggota.transportasi.form',compact('title','transportasi'));
    }

    function SaveTransportasi(Request $r)
    {
        $this->validate($r, [
            'nomor_kendaraan'=>'required',
            'nomor_rangka'=>'required',
            'nomor_mesin'=>'required',
            'tahun_pembuatan'=>'required',
            'nama_pada_stnk'=>'required'
        ]);

        $id_pendaftar = auth()->user()->id;

        if ($r->id == null) {
            $rs = new PendaftarTransportasi;
        }else{
            /*---auth---*/
            $user = PendaftarTransportasi::where('id', $r->id)->first()->id_pendaftar;
            $auth = auth()->user()->id;
            if($auth != $user){
                return abort('404');
            }
            /*---/auth---*/
            $rs = PendaftarTransportasi::where('id', $r->id)->first();
        }

        $rs->id_pendaftar = $id_pendaftar;
        $rs->nomor_kendaraan = strtoupper($r->nomor_kendaraan);
        $rs->nomor_rangka = strtoupper($r->nomor_rangka);
        $rs->nomor_mesin = strtoupper($r->nomor_mesin);
        $rs->tahun_pembuatan = $r->tahun_pembuatan;
        $rs->nama_pada_stnk = strtoupper($r->nama_pada_stnk);
        $rs->save();

        if ($r->id == null) {
            flash('Profile Transportasi Berhasil Ditambahkan')->success();
        }else{
            flash('Profile Transportasi Berhasil Diperbaharui')->success();
        }
        return redirect('profile/transportasi');
    }

    function DeleteTransportasi(PendaftarTransportasi $transportasi)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $transportasi->id_pendaftar;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/
        $transportasi->delete();
        flash('Data Transportasi berhasil dihapus')->success();
        return redirect('profile/transportasi');
    }

}

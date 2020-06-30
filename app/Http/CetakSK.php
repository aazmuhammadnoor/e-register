<?php

namespace App\Http;

use Carbon\Carbon;

trait CetakSK{

    protected function skcetak($per)
    {
        $izin = $per->getIzin;
        $sk = $per->getFinal;
        $identitas = \App\Models\Identitas::where('id', 1)->first();
        if($izin->penanda_tangan_akhir == 'bupati'){
            $nama_ttd = $identitas->bupati;
            $nip="";
        }else{
            $nama_ttd = $identitas->kepala_dinas;
            $nip=$identitas->nip_kepala_dinas;
        }

        $meta = json_decode($per->metadata, true);

        //Tanda Tangan
        $nama_kadin = $identitas->kepala_dinas;
        $nip_kadin = $identitas->nip_kepala_dinas;
        $jabatan_kadin = $identitas->jabatan_kadin;
        $pangkat_kadin = $identitas->pangkat_kadin;
        $atas_nama = $identitas->atas_nama;

        //NAMA PEMOHON
        $gelar_depan = is_nol_string('',$per->getPemohon->gelar_depan);
        $gelar_belakang = is_nol_string(',',$per->getPemohon->gelar_belakang);
        $nama_tengah = strtoupper($per->getPemohon->nama);
        $nama_pemohon = $gelar_depan." ".$nama_tengah." ".$gelar_belakang;
        $kode_tengah = ($per->getIzin->kode_sk_tengah != '' && $per->getIzin->kode_sk_tengah != null) ? $per->getIzin->kode_sk_tengah : 'DPMPTSP-PPL';

        //QR CODE
        if($per->getIzin->penomoran_sk == "Auto"){
            $no_sk = ($sk) ? $sk->nomor_sk."/".$kode_tengah."/".date('Y',strtotime($sk->tgl_penetapan)) : $per->no_pendaftaran_sementara;
        }else{
            $no_sk = ($sk) ? $sk->nomor_sk : $per->no_pendaftaran_sementara;
        }
        if ($per->getIzin->jenisIzin->kategoriProfil->id == 1) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 2) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 3) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 4) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 5) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 6) {
            $nama_tempat_kerja = $per->getReklame->nama_perusahaan;
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 7) {
            $nama_tempat_kerja = "...........";
        }
        $qrcode = generate_qrcode_sk($per,$no_sk,$nama_pemohon,$nama_tempat_kerja);

        
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

        $file = storage_path('app/'.$izin->template_surat.'');

        if(file_exists($file)){

            $filename = [
                            'docx'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".docx",
                            'pdf'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf",
            ];
            $render = new \App\Workflow\TemplateProccessorCustom($file);

            //hapus jika sudah ada file sebelumnya
            if(file_exists($filename['docx'])){
                unlink($filename['docx']);
            }
            if(file_exists($filename['pdf'])){
                unlink($filename['pdf']);
            }

            $sertifikat = $per->getSertifikat()->get()->first();

            if($sk){
                $render->setValue('no_ijin', htmlentities($no_sk));
                $render->setValue('tgl_penetapan', htmlentities((date_id($sk->tgl_penetapan))));
                $render->setValue('tahun', htmlentities(date('Y',strtotime($sk->tgl_penetapan))));
                $render->setValue('tgl_berlaku', htmlentities(date_id($sk->berlaku_hingga)));
            }else{
                $render->setValue('no_ijin', "........");
                $render->setValue('tgl_penetapan', "........");
                $render->setValue('tahun', "........");
                $render->setValue('tgl_berlaku', "........");
            }

            //variabel per kategori profil
            if ($per->getIzin->jenisIzin->kategoriProfil->id == 1) {
                $render->setValue('nama_usaha', htmlentities("..........."));
                
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 2) {
                $nama_tempat_kerja = "...........";
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 3) {
                $nama_tempat_kerja = "...........";
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 4) {
                $nama_tempat_kerja = "...........";
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 5) {
                $nama_tempat_kerja = "...........";
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 6) {
                $render->setValue('jumlah_reklame', '1 (Satu)');
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 7) {
                $nama_tempat_kerja = "...........";
            }

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

            //additional variabel
            $render->setValue('masa_berlaku', htmlentities($izin->masa_berlaku));

            $render->setValue('tahun_sekarang', htmlentities(date('Y')));
            $render->setValue('bulan_sekarang', htmlentities(month_id(date('m'))));
            $render->setValue('tanggal_sekarang', htmlentities(date('d')));

            $render->setValue('tanggal_pendaftaran', htmlentities($per->tgl_pendaftaran->format('d')));
            $render->setValue('bulan_pendaftaran', htmlentities(month_id($per->tgl_pendaftaran->format('m'))));
            $render->setValue('tahun_pendaftaran', htmlentities($per->tgl_pendaftaran->format('Y')));

            if($sk)
            {
                $render->setValue('tanggal_sk', htmlentities($sk->tgl_penetapan->format('d')));
                $render->setValue('bulan_sk', htmlentities(month_id($sk->tgl_penetapan->format('m'))));
                $render->setValue('tahun_sk', htmlentities($sk->tgl_penetapan->format('Y')));
            }else{
                $render->setValue('tanggal_sk', htmlentities('...'));
                $render->setValue('bulan_sk', htmlentities('...'));
                $render->setValue('tahun_sk', htmlentities('...'));
            }



            $foto = generate_foto($per->getPendaftar->pas_foto);
            $kop_surat = "uploads/".$identitas->kop_surat;

            if(is_file($foto)){
                $render->setImg('pas_foto',array('src' => $foto,'swh'=>'180'));
            }else{
                $render->setImg('pas_foto',array('src' => "uploads/pas_foto_default.png",'swh'=>'180'));
            }
            $render->setImg('qrcode',array('src' => $qrcode,'swh'=>'120'));
            $render->setImg('kop_surat',array('src' => $kop_surat,'swh'=>'770'));

            //Permohonan
            $render->setValue('tgl_permohonan', htmlentities(date_id($per->tgl_pendaftaran)));
            $render->setValue('no_daftar', htmlentities(strtoupper($per->no_pendaftaran_sementara)));
            $render->setValue('alamat_permohonan', htmlentities(strtoupper($alamat)));

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

            $meta = json_decode($per->metadata, true);

            foreach($meta as $key=>$value){
              if(isset($meta[$key]) && !is_null($value) && !is_array($value)){
                  $render->setValue(strtoupper($key), htmlentities(strtoupper($value)));
                  $render->setValue(strtolower($key), htmlentities(strtoupper($value)));
              }elseif(is_array($value)){
                  $render->setValue(strtoupper($key), htmlentities(strtoupper($value[0])));
                  $render->setValue(strtolower($key), htmlentities(strtoupper($value[0])));
              }

            }

            $f = "SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf";
            $this->SaveSurat($per->id, 'SK', 'SK Perizinan', $f);

            $render->saveAs($filename['docx']);
            if(file_exists($filename['docx'])){
                //WORD
                response()->file($filename['docx'],[
                    'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.docx"'
                ]);
                // Konversi Ke PDF
                // Jika sudah pernah di konversi sebelumnya
                if(file_exists($filename['pdf'])){
                  return response()->file($filename['docx'],[
                    'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.docx"'
                  ]);
                }else{
                  // Jika belum pernah di konversi sebelumnya
                  $konversi = \App\Http\KonversiPdf::Konversi($per, $filename);
                  return response()->file($filename['docx'],[
                    'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.docx"'
                  ]);
                }
            }else{
                exit('Requested file does not exist on our server!');
            }
        }else{
            dd("Template SK Perizinan Tidak Ditemukan");
        }

    }



    protected function kadincetak($per)
    {
        $izin = $per->getIzin;
        $sk = $per->getFinal;
        $identitas = \App\Models\Identitas::where('id', 1)->first();
        if($izin->penanda_tangan_akhir == 'bupati'){
            $nama_ttd = $identitas->bupati;
            $nip="";
        }else{
            $nama_ttd = $identitas->kepala_dinas;
            $nip=$identitas->nip_kepala_dinas;
        }

        $meta = json_decode($per->metadata, true);

        //Tanda Tangan
        $nama_kadin = '';
        $nip_kadin = '';
        $jabatan_kadin = '';
        $pangkat_kadin = '';
        $atas_nama = '';

        //NAMA PEMOHON
        $gelar_depan = is_nol_string('',$per->getPemohon->gelar_depan);
        $gelar_belakang = is_nol_string(',',$per->getPemohon->gelar_belakang);
        $nama_tengah = strtoupper($per->getPemohon->nama);
        $nama_pemohon = $gelar_depan." ".$nama_tengah." ".$gelar_belakang;
        $kode_tengah = ($per->getIzin->kode_sk_tengah != '' && $per->getIzin->kode_sk_tengah != null) ? $per->getIzin->kode_sk_tengah : 'DPMPTSP-PPL';

        //QR CODE
        if($per->getIzin->penomoran_sk == "Auto"){
            $no_sk = ($sk) ? $sk->nomor_sk."/".$kode_tengah."/".date('Y',strtotime($sk->tgl_penetapan)) : $per->no_pendaftaran_sementara;
        }else{
            $no_sk = ($sk) ? $sk->nomor_sk : $per->no_pendaftaran_sementara;
        }
        if ($per->getIzin->jenisIzin->kategoriProfil->id == 1) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 2) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 3) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 4) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 5) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 6) {
            $nama_tempat_kerja = $per->getReklame->nama_perusahaan;
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 7) {
            $nama_tempat_kerja = "...........";
        }
        $qrcode = generate_qrcode_sk($per,$no_sk,$nama_pemohon,$nama_tempat_kerja);
        
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

        $file = storage_path('app/'.$izin->template_surat.'');

        if(file_exists($file)){

            $filename = [
                            'docx'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara)."_kadin.docx",
                            'pdf'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara)."_kadin.pdf",
            ];
            $render = new \App\Workflow\TemplateProccessorCustom($file);

            //hapus jika sudah ada file sebelumnya
            if(file_exists($filename['docx'])){
                unlink($filename['docx']);
            }
            if(file_exists($filename['pdf'])){
                unlink($filename['pdf']);
            }

            $sertifikat = $per->getSertifikat()->get()->first();

            if($sk){
                $render->setValue('no_ijin', htmlentities($no_sk));
                $render->setValue('tgl_penetapan', htmlentities((date_id($sk->tgl_penetapan))));
                $render->setValue('tahun', htmlentities(date('Y',strtotime($sk->tgl_penetapan))));
                $render->setValue('tgl_berlaku', htmlentities(date_id($sk->berlaku_hingga)));
            }else{
                $render->setValue('no_ijin', "........");
                $render->setValue('tgl_penetapan', "........");
                $render->setValue('tahun', "........");
                $render->setValue('tgl_berlaku', "........");
            }

            //variabel per kategori profil
            if ($per->getIzin->jenisIzin->kategoriProfil->id == 1) {
                $render->setValue('nama_usaha', htmlentities("..........."));
                
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 2) {
                $nama_tempat_kerja = "...........";
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 3) {
                $nama_tempat_kerja = "...........";
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 4) {
                $nama_tempat_kerja = "...........";
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 5) {
                $nama_tempat_kerja = "...........";
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 6) {
                $render->setValue('jumlah_reklame', '1 (Satu)');
            } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 7) {
                $nama_tempat_kerja = "...........";
            }

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

            //additional variabel
            $render->setValue('masa_berlaku', htmlentities($izin->masa_berlaku));
            
            $render->setValue('tahun_sekarang', htmlentities(date('Y')));
            $render->setValue('bulan_sekarang', htmlentities(month_id(date('m'))));
            $render->setValue('tanggal_sekarang', htmlentities(date('d')));

            $render->setValue('tanggal_pendaftaran', htmlentities($per->tgl_pendaftaran->format('d')));
            $render->setValue('bulan_pendaftaran', htmlentities(month_id($per->tgl_pendaftaran->format('m'))));
            $render->setValue('tahun_pendaftaran', htmlentities($per->tgl_pendaftaran->format('Y')));

            if($sk)
            {
                $render->setValue('tanggal_sk', htmlentities($sk->tgl_penetapan->format('d')));
                $render->setValue('bulan_sk', htmlentities(month_id($sk->tgl_penetapan->format('m'))));
                $render->setValue('tahun_sk', htmlentities($sk->tgl_penetapan->format('Y')));
            }else{
                $render->setValue('tanggal_sk', htmlentities('...'));
                $render->setValue('bulan_sk', htmlentities('...'));
                $render->setValue('tahun_sk', htmlentities('...'));
            }


            $foto = generate_foto($per->getPendaftar->pas_foto);
            $kop_surat = "uploads/".$identitas->kop_surat;

            if(is_file($foto)){
                $render->setImg('pas_foto',array('src' => $foto,'swh'=>'180'));
            }else{
                $render->setImg('pas_foto',array('src' => "uploads/pas_foto_default.png",'swh'=>'180'));
            }
            $render->setImg('qrcode',array('src' => $qrcode,'swh'=>'120'));
            $render->setImg('kop_surat',array('src' => $kop_surat,'swh'=>'770'));

            //Permohonan
            $render->setValue('tgl_permohonan', htmlentities(date_id($per->tgl_pendaftaran)));
            $render->setValue('no_daftar', htmlentities(strtoupper($per->no_pendaftaran_sementara)));
            $render->setValue('alamat_permohonan', htmlentities(strtoupper($alamat)));

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

            $meta = json_decode($per->metadata, true);

            foreach($meta as $key=>$value){
              if(isset($meta[$key]) && !is_null($value) && !is_array($value)){
                  $render->setValue(strtoupper($key), htmlentities(strtoupper($value)));
                  $render->setValue(strtolower($key), htmlentities(strtoupper($value)));
              }elseif(is_array($value)){
                  $render->setValue(strtoupper($key), htmlentities(strtoupper($value[0])));
                  $render->setValue(strtolower($key), htmlentities(strtoupper($value[0])));
              }

            }

            $f = "SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf";
            $this->SaveSurat($per->id, 'SK', 'SK Perizinan', $f);

            $render->saveAs($filename['docx']);
            if(file_exists($filename['docx'])){
                //WORD
                response()->file($filename['docx'],[
                    'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'_kadin.docx"'
                ]);
                // Konversi Ke PDF
                // Jika sudah pernah di konversi sebelumnya
                if(file_exists($filename['pdf'])){
                    response()->file($filename['pdf'],[
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'_kadin.pdf"'
                    ]);
                }else{
                    // Jika belum pernah di konversi sebelumnya
                    $konversi = \App\Http\KonversiPdf::Konversi($per, $filename);
                    response()->file($konversi,[
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'_kadin.pdf"'
                    ]);
                }
            }else{
                exit('Requested file does not exist on our server!');
            }
        }else{
            dd("Template SK Perizinan Tidak Ditemukan");
        }

    }

    protected function CreateOrView($per)
    {
        $izin = $per->getIzin;
        $sk = $per->getFinal;
        $identitas = \App\Models\Identitas::where('id', 1)->first();
        if($izin->penanda_tangan_akhir == 'bupati'){
            $nama_ttd = $identitas->bupati;
            $nip="";
        }else{
            $nama_ttd = $identitas->kepala_dinas;
            $nip=$identitas->nip_kepala_dinas;
        }

        $meta = json_decode($per->metadata, true);

        //Tanda Tangan
        $nama_kadin = $identitas->kepala_dinas;
        $nip_kadin = $identitas->nip_kepala_dinas;
        $jabatan_kadin = $identitas->jabatan_kadin;
        $pangkat_kadin = $identitas->pangkat_kadin;
        $atas_nama = $identitas->atas_nama;

        //NAMA PEMOHON
        $gelar_depan = is_nol_string('',$per->getPemohon->gelar_depan);
        $gelar_belakang = is_nol_string(',',$per->getPemohon->gelar_belakang);
        $nama_tengah = strtoupper($per->getPemohon->nama);
        $nama_pemohon = $gelar_depan." ".$nama_tengah." ".$gelar_belakang;
        $kode_tengah = ($per->getIzin->kode_sk_tengah != '' && $per->getIzin->kode_sk_tengah != null) ? $per->getIzin->kode_sk_tengah : 'DPMPTSP-PPL';

        //QR CODE
        if($per->getIzin->penomoran_sk == "Auto"){
            $no_sk = ($sk) ? $sk->nomor_sk."/".$kode_tengah."/".date('Y',strtotime($sk->tgl_penetapan)) : $per->no_pendaftaran_sementara;
        }else{
            $no_sk = ($sk) ? $sk->nomor_sk : $per->no_pendaftaran_sementara;
        }
        if ($per->getIzin->jenisIzin->kategoriProfil->id == 1) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 2) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 3) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 4) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 5) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 6) {
            $nama_tempat_kerja = $per->getReklame->nama_perusahaan;
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 7) {
            $nama_tempat_kerja = "...........";
        }
        $qrcode = generate_qrcode_sk($per,$no_sk,$nama_pemohon,$nama_tempat_kerja);

        
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

        $file = storage_path('app/'.$izin->template_surat.'');

        $filename = [
                            'docx'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".docx",
                            'pdf'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf",
                    ];

        if(file_exists($filename['pdf'])){
            return response()->file($filename['pdf']);
        }else{
                if(file_exists($file)){

                $render = new \App\Workflow\TemplateProccessorCustom($file);

                $sertifikat = $per->getSertifikat()->get()->first();

                if($sk){
                    $render->setValue('no_ijin', htmlentities($no_sk));
                    $render->setValue('tgl_penetapan', htmlentities((date_id($sk->tgl_penetapan))));
                    $render->setValue('tahun', htmlentities(date('Y',strtotime($sk->tgl_penetapan))));
                    $render->setValue('tgl_berlaku', htmlentities(date_id($sk->berlaku_hingga)));
                }else{
                    $render->setValue('no_ijin', "........");
                    $render->setValue('tgl_penetapan', "........");
                    $render->setValue('tahun', "........");
                    $render->setValue('tgl_berlaku', "........");
                }

                //variabel per kategori profil
                if ($per->getIzin->jenisIzin->kategoriProfil->id == 1) {
                    $render->setValue('nama_usaha', htmlentities("..........."));
                    
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 2) {
                    $nama_tempat_kerja = "...........";
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 3) {
                    $nama_tempat_kerja = "...........";
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 4) {
                    $nama_tempat_kerja = "...........";
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 5) {
                    $nama_tempat_kerja = "...........";
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 6) {
                    $render->setValue('jumlah_reklame', '1 (Satu)');
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 7) {
                    $nama_tempat_kerja = "...........";
                }

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

                //additional variabel
                $render->setValue('masa_berlaku', htmlentities($izin->masa_berlaku));
                
                $render->setValue('tahun_sekarang', htmlentities(date('Y')));
                $render->setValue('bulan_sekarang', htmlentities(month_id(date('m'))));
                $render->setValue('tanggal_sekarang', htmlentities(date('d')));

                $render->setValue('tanggal_pendaftaran', htmlentities($per->tgl_pendaftaran->format('d')));
                $render->setValue('bulan_pendaftaran', htmlentities(month_id($per->tgl_pendaftaran->format('m'))));
                $render->setValue('tahun_pendaftaran', htmlentities($per->tgl_pendaftaran->format('Y')));

            if($sk)
            {
                $render->setValue('tanggal_sk', htmlentities($sk->tgl_penetapan->format('d')));
                $render->setValue('bulan_sk', htmlentities(month_id($sk->tgl_penetapan->format('m'))));
                $render->setValue('tahun_sk', htmlentities($sk->tgl_penetapan->format('Y')));
            }else{
                $render->setValue('tanggal_sk', htmlentities('...'));
                $render->setValue('bulan_sk', htmlentities('...'));
                $render->setValue('tahun_sk', htmlentities('...'));
            }


                $foto = generate_foto($per->getPendaftar->pas_foto);
                $kop_surat = "uploads/".$identitas->kop_surat;

                if(is_file($foto)){
                    $render->setImg('pas_foto',array('src' => $foto,'swh'=>'180'));
                }else{
                    $render->setImg('pas_foto',array('src' => "uploads/pas_foto_default.png",'swh'=>'180'));
                }
                $render->setImg('qrcode',array('src' => $qrcode,'swh'=>'120'));
                $render->setImg('kop_surat',array('src' => $kop_surat,'swh'=>'770'));

                //Permohonan
                $render->setValue('tgl_permohonan', htmlentities(date_id($per->tgl_pendaftaran)));
                $render->setValue('no_daftar', htmlentities(strtoupper($per->no_pendaftaran_sementara)));
                $render->setValue('alamat_permohonan', htmlentities(strtoupper($alamat)));

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

                $meta = json_decode($per->metadata, true);

                foreach($meta as $key=>$value){
                  if(isset($meta[$key]) && !is_null($value) && !is_array($value)){
                      $render->setValue(strtoupper($key), htmlentities(strtoupper($value)));
                      $render->setValue(strtolower($key), htmlentities(strtoupper($value)));
                  }elseif(is_array($value)){
                      $render->setValue(strtoupper($key), htmlentities(strtoupper($value[0])));
                      $render->setValue(strtolower($key), htmlentities(strtoupper($value[0])));
                  }

                }

                $f = "SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf";
                $this->SaveSurat($per->id, 'SK', 'SK Perizinan', $f);

                $render->saveAs($filename['docx']);
                if(file_exists($filename['docx'])){
                    //WORD
                    response()->file($filename['docx'],[
                        'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.docx"'
                    ]);
                    // Konversi Ke PDF
                    // Jika sudah pernah di konversi sebelumnya
                    if(file_exists($filename['pdf'])){
                      response()->file($filename['pdf'],[
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.pdf"'
                      ]);
                    }else{
                      // Jika belum pernah di konversi sebelumnya
                      $konversi = \App\Http\KonversiPdf::Konversi($per, $filename);
                      return response()->file($konversi,[
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.pdf"'
                      ]);
                    }
                }else{
                    exit('Requested file does not exist on our server!');
                }
            }else{
                dd("Template SK Perizinan Tidak Ditemukan");
            }
        }

    }

    protected function CreateOrViewKadin($per)
    {
        $izin = $per->getIzin;
        $sk = $per->getFinal;
        $identitas = \App\Models\Identitas::where('id', 1)->first();
        if($izin->penanda_tangan_akhir == 'bupati'){
            $nama_ttd = $identitas->bupati;
            $nip="";
        }else{
            $nama_ttd = $identitas->kepala_dinas;
            $nip=$identitas->nip_kepala_dinas;
        }

        $meta = json_decode($per->metadata, true);

        //Tanda Tangan
        $nama_kadin = "";
        $nip_kadin = "";
        $jabatan_kadin = "";
        $pangkat_kadin = "";
        $atas_nama = "";

        //NAMA PEMOHON
        $gelar_depan = is_nol_string('',$per->getPemohon->gelar_depan);
        $gelar_belakang = is_nol_string(',',$per->getPemohon->gelar_belakang);
        $nama_tengah = strtoupper($per->getPemohon->nama);
        $nama_pemohon = $gelar_depan." ".$nama_tengah." ".$gelar_belakang;
        $kode_tengah = ($per->getIzin->kode_sk_tengah != '' && $per->getIzin->kode_sk_tengah != null) ? $per->getIzin->kode_sk_tengah : 'DPMPTSP-PPL';

        //QR CODE
        if($per->getIzin->penomoran_sk == "Auto"){
            $no_sk = ($sk) ? $sk->nomor_sk."/".$kode_tengah."/".date('Y',strtotime($sk->tgl_penetapan)) : $per->no_pendaftaran_sementara;
        }else{
            $no_sk = ($sk) ? $sk->nomor_sk : $per->no_pendaftaran_sementara;
        }
        if ($per->getIzin->jenisIzin->kategoriProfil->id == 1) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 2) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 3) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 4) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 5) {
            $nama_tempat_kerja = "...........";
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 6) {
            $nama_tempat_kerja = $per->getReklame->nama_perusahaan;
        } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 7) {
            $nama_tempat_kerja = "...........";
        }
        $qrcode = generate_qrcode_sk($per,$no_sk,$nama_pemohon,$nama_tempat_kerja);

        
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

        $file = storage_path('app/'.$izin->template_surat.'');

        $filename = [
                            'docx'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara)."_kadin.docx",
                            'pdf'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara)."_kadin.pdf",
                    ];

        if(file_exists($filename['pdf'])){
            return response()->file($filename['pdf']);
        }else{
                if(file_exists($file)){

                $render = new \App\Workflow\TemplateProccessorCustom($file);

                $sertifikat = $per->getSertifikat()->get()->first();

                if($sk){
                    $render->setValue('no_ijin', htmlentities($no_sk));
                    $render->setValue('tgl_penetapan', htmlentities((date_id($sk->tgl_penetapan))));
                    $render->setValue('tahun', htmlentities(date('Y',strtotime($sk->tgl_penetapan))));
                    $render->setValue('tgl_berlaku', htmlentities(date_id($sk->berlaku_hingga)));
                }else{
                    $render->setValue('no_ijin', "........");
                    $render->setValue('tgl_penetapan', "........");
                    $render->setValue('tahun', "........");
                    $render->setValue('tgl_berlaku', "........");
                }

                //variabel per kategori profil
                if ($per->getIzin->jenisIzin->kategoriProfil->id == 1) {
                    $render->setValue('nama_usaha', htmlentities("..........."));
                    
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 2) {
                    $nama_tempat_kerja = "...........";
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 3) {
                    $nama_tempat_kerja = "...........";
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 4) {
                    $nama_tempat_kerja = "...........";
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 5) {
                    $nama_tempat_kerja = "...........";
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 6) {
                    $render->setValue('jumlah_reklame', '1 (Satu)');
                } else if ($per->getIzin->jenisIzin->kategoriProfil->id == 7) {
                    $nama_tempat_kerja = "...........";
                }

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

                $foto = generate_foto($per->getPendaftar->pas_foto);
                $kop_surat = "uploads/".$identitas->kop_surat;
                $cap = "uploads/".$identitas->ttd_elektronik;

                //Tanda tangan
                $render->setValue('nama_kadin', htmlentities($nama_kadin));
                $render->setValue('nip_kadin', htmlentities($nip_kadin));
                $render->setValue('jabatan_kadin', htmlentities($jabatan_kadin));
                $render->setValue('pangkat_kadin', htmlentities($pangkat_kadin));
                $render->setImg('atas_nama',array('src' => $cap,'swh'=>'350'));

                //additional variabel
                $render->setValue('masa_berlaku', htmlentities($izin->masa_berlaku));
                
                $render->setValue('tahun_sekarang', htmlentities(date('Y')));
                $render->setValue('bulan_sekarang', htmlentities(month_id(date('m'))));
                $render->setValue('tanggal_sekarang', htmlentities(date('d')));

                $render->setValue('tanggal_pendaftaran', htmlentities($per->tgl_pendaftaran->format('d')));
                $render->setValue('bulan_pendaftaran', htmlentities(month_id($per->tgl_pendaftaran->format('m'))));
                $render->setValue('tahun_pendaftaran', htmlentities($per->tgl_pendaftaran->format('Y')));

            if($sk)
            {
                $render->setValue('tanggal_sk', htmlentities($sk->tgl_penetapan->format('d')));
                $render->setValue('bulan_sk', htmlentities(month_id($sk->tgl_penetapan->format('m'))));
                $render->setValue('tahun_sk', htmlentities($sk->tgl_penetapan->format('Y')));
            }else{
                $render->setValue('tanggal_sk', htmlentities('...'));
                $render->setValue('bulan_sk', htmlentities('...'));
                $render->setValue('tahun_sk', htmlentities('...'));
            }


                if(is_file($foto)){
                    $render->setImg('pas_foto',array('src' => $foto,'swh'=>'180'));
                }else{
                    $render->setImg('pas_foto',array('src' => "uploads/pas_foto_default.png",'swh'=>'180'));
                }
                $render->setImg('qrcode',array('src' => $qrcode,'swh'=>'120'));
                $render->setImg('kop_surat',array('src' => $kop_surat,'swh'=>'770'));

                //Permohonan
                $render->setValue('tgl_permohonan', htmlentities(date_id($per->tgl_pendaftaran)));
                $render->setValue('no_daftar', htmlentities(strtoupper($per->no_pendaftaran_sementara)));
                $render->setValue('alamat_permohonan', htmlentities(strtoupper($alamat)));

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

                $meta = json_decode($per->metadata, true);

                foreach($meta as $key=>$value){
                  if(isset($meta[$key]) && !is_null($value) && !is_array($value)){
                      $render->setValue(strtoupper($key), htmlentities(strtoupper($value)));
                      $render->setValue(strtolower($key), htmlentities(strtoupper($value)));
                  }elseif(is_array($value)){
                      $render->setValue(strtoupper($key), htmlentities(strtoupper($value[0])));
                      $render->setValue(strtolower($key), htmlentities(strtoupper($value[0])));
                  }

                }

                $f = "SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf";
                $this->SaveSurat($per->id, 'SK', 'SK Perizinan', $f);

                $render->saveAs($filename['docx']);
                if(file_exists($filename['docx'])){
                    //WORD
                    response()->file($filename['docx'],[
                        'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.docx"'
                    ]);
                    // Konversi Ke PDF
                    // Jika sudah pernah di konversi sebelumnya
                    if(file_exists($filename['pdf'])){
                      response()->file($filename['pdf'],[
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'_kadin.pdf"'
                      ]);
                    }else{
                      // Jika belum pernah di konversi sebelumnya
                      $konversi = \App\Http\KonversiPdf::Konversi($per, $filename);
                      response()->file($konversi,[
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'_kadin.pdf"'
                      ]);
                    }
                }else{
                    exit('Requested file does not exist on our server!');
                }
            }else{
                dd("Template SK Perizinan Tidak Ditemukan");
            }
        }

    }

    protected function skrdcetak($per)
    {
        $izin = $per->getIzin;
        $sk = $per->getFinal;
        $identitas = \App\Models\Identitas::where('id', 1)->first();
        if($izin->penanda_tangan_akhir == 'bupati'){
            $nama_ttd = $identitas->bupati;
            $nip="";
        }else{
            $nama_ttd = $identitas->kepala_dinas;
            $nip=$identitas->nip_kepala_dinas;
        }

        $meta = json_decode($per->metadata, true);

        if($per->getIzin->kategori_prosedur_id == 1){
            // retribusi 
            $ret = \App\Models\Ret::where('id_permohonan', $per->id)->first();
            $file = storage_path('app/template_perizinan/template_skrd.docx');
        }elseif($per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 4){
            // IMB dan IMB Revisi
            $ret = \App\Models\RetImb::where('id_permohonan', $per->id)->first();
            $file = storage_path('app/template_perizinan/template_skrd_imb.docx');
        }elseif($per->getIzin->kategori_prosedur_id == 7){
            // KRK
            $ret = \App\Models\RetKrk::where('id_permohonan', $per->id)->first();
            $file = storage_path('app/template_perizinan/template_skrd_krk.docx');
        }elseif($per->getIzin->kategori_prosedur_id == 6){
            // TRAYEK
            $ret = \App\Models\RetTrayek::where('id_permohonan', $per->id)->first();
            $file = storage_path('app/template_perizinan/template_skrd_trayek.docx');
        }

        //Tanda Tangan
        $nama_kadin = $identitas->kepala_dinas;
        $nip_kadin = $identitas->nip_kepala_dinas;
        $jabatan_kadin = $identitas->jabatan_kadin;
        $pangkat_kadin = $identitas->pangkat_kadin;
        $atas_nama = $identitas->atas_nama;

        //NAMA PEMOHON
        $gelar_depan = is_nol_string('',$per->getPemohon->gelar_depan);
        $gelar_belakang = is_nol_string(',',$per->getPemohon->gelar_belakang);
        $nama_tengah = strtoupper($per->getPemohon->nama);
        $nama_pemohon = $gelar_depan." ".$nama_tengah." ".$gelar_belakang;

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

        if(file_exists($file)){

            $filename = [
                            'docx'=>dokumen_path($per)."/SKRD_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".docx",
                            'pdf'=>dokumen_path($per)."/SKRD_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf",
            ];
            $render = new \App\Workflow\TemplateProccessorCustom($file);

            //hapus jika sudah ada file sebelumnya
            if(file_exists($filename['docx'])){
                unlink($filename['docx']);
            }
            if(file_exists($filename['pdf'])){
                unlink($filename['pdf']);
            }

            $sertifikat = $per->getSertifikat()->get()->first();

            if($ret){
                $render->setValue('no_skrd', $ret->no_skrd);
            }else{
                $render->setValue('no_skrd', "........");
            }

            $nama_usaha = ($per->izin != 139) ? 'BRT/PERUMAHAN MBR' : '-' ;
            $logo = "uploads/".$identitas->logo_public;

            $render->setValue('nama', $nama_pemohon);
            $render->setValue('alamat', strtoupper($alamat_pemohon));
            $render->setValue('nama_usaha', strtoupper($nama_usaha));
            $render->setValue('nomor_pendaftaran', strtoupper($per->no_pendaftaran_sementara));
            $render->setValue('tahun', date('Y'));
            $render->setValue('bulan', month_id(date('m')));
            $render->setImg('logo',array('src' => $logo,'swh'=>'120'));

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



            if($per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 4){ //imb

                $render->setValue('kode_retribusi_imb', htmlentities($ret->kode_retribusi_imb));
                $render->setValue('kode_papan_proyek', htmlentities($ret->kode_papan_proyek));
                $render->setValue('kode_plat_imb', htmlentities($ret->kode_plat_imb));
                $render->setValue('kode_denda_imb', htmlentities($ret->kode_denda_imb));
                $render->setValue('retribusi_imb', 'Rp. '.number_format($ret->retribusi_imb));
                $render->setValue('papan_proyek', 'Rp. '.number_format($ret->papan_proyek));
                $render->setValue('plat_imb', 'Rp. '.number_format($ret->plat_imb));
                $render->setValue('denda_imb', 'Rp. '.number_format($ret->denda_imb));
                $render->setValue('total', 'Rp. '.number_format($ret->total));
                $render->setValue('terbilang', strtoupper(\App\Util\Terbilang::Konversi($ret->total)).' Rupiah');
               
            }elseif($per->getIzin->kategori_prosedur_id == 7){ //krk

                $render->setValue('kode_biaya_ukur', htmlentities($ret->kode_biaya_ukur));
                $render->setValue('kode_blanko_krk', htmlentities($ret->kode_blanko_krk));
                $render->setValue('kode_peta_krk', htmlentities($ret->kode_peta_krk));
                $render->setValue('kode_denda_krk', htmlentities($ret->kode_denda_krk));
                $render->setValue('biaya_ukur', 'Rp. '.number_format($ret->biaya_ukur));
                $render->setValue('blanko_krk', 'Rp. '.number_format($ret->blanko_krk));
                $render->setValue('peta_krk', 'Rp. '.number_format($ret->peta_krk));
                $render->setValue('denda_krk', 'Rp. '.number_format($ret->denda_krk));
                $render->setValue('total', 'Rp. '.number_format($ret->total));
                $render->setValue('terbilang', strtoupper(\App\Util\Terbilang::Konversi($ret->total)).' Rupiah');

            }elseif($per->getIzin->kategori_prosedur_id == 6){ //trayek

                $render->setValue('kode_retribusi_trayek', htmlentities($ret->kode_retribusi_trayek));
                $render->setValue('kode_kartu_pengawasan_trayek', htmlentities($ret->kode_kartu_pengawasan_trayek));
                $render->setValue('kode_denda_trayek', htmlentities($ret->kode_denda_trayek));
                $render->setValue('retribusi_trayek', 'Rp. '.number_format($ret->retribusi_trayek));
                $render->setValue('kartu_pengawasan_trayek', 'Rp. '.number_format($ret->kartu_pengawasan_trayek));
                $render->setValue('denda_trayek', 'Rp. '.number_format($ret->denda_trayek));
                $render->setValue('total', 'Rp. '.number_format($ret->total));
                $render->setValue('terbilang', strtoupper(\App\Util\Terbilang::Konversi($ret->total)).' Rupiah');

            }else{
                $render->setValue('kode_rekening', htmlentities($ret->kode_rekening));
                $render->setValue('kode_denda', htmlentities($ret->kode_denda));
                $render->setValue('jumlah_pembayaran', 'Rp. '.number_format($ret->jumlah_pembayaran));
                $render->setValue('jumlah_denda', 'Rp. '.number_format($ret->jumlah_denda));
                $render->setValue('total', 'Rp. '.number_format($ret->total));
                $render->setValue('terbilang', strtoupper(\App\Util\Terbilang::Konversi($ret->total)).' Rupiah');
            }

            //Tanda tangan
            $render->setValue('nama_kadin', htmlentities($nama_kadin));
            $render->setValue('nip_kadin', htmlentities($nip_kadin));
            $render->setValue('jabatan_kadin', htmlentities($jabatan_kadin));
            $render->setValue('pangkat_kadin', htmlentities($pangkat_kadin));
            $render->setValue('atas_nama', htmlentities($atas_nama));

            //additional variabel
            $render->setValue('masa_berlaku', htmlentities($izin->masa_berlaku));
            
            $render->setValue('tahun_sekarang', htmlentities(date('Y')));
            $render->setValue('bulan_sekarang', htmlentities(month_id(date('m'))));
            $render->setValue('tanggal_sekarang', htmlentities(date('d')));

            $render->setValue('tanggal_pendaftaran', htmlentities($per->tgl_pendaftaran->format('d')));
            $render->setValue('bulan_pendaftaran', htmlentities(month_id($per->tgl_pendaftaran->format('m'))));
            $render->setValue('tahun_pendaftaran', htmlentities($per->tgl_pendaftaran->format('Y')));

            if($sk)
            {
                $render->setValue('tanggal_sk', htmlentities($sk->tgl_penetapan->format('d')));
                $render->setValue('bulan_sk', htmlentities(month_id($sk->tgl_penetapan->format('m'))));
                $render->setValue('tahun_sk', htmlentities($sk->tgl_penetapan->format('Y')));
            }else{
                $render->setValue('tanggal_sk', htmlentities('...'));
                $render->setValue('bulan_sk', htmlentities('...'));
                $render->setValue('tahun_sk', htmlentities('...'));
            }


            $f ="SKRD_".strtoupper($izin->nama)."_".$per->no_pendaftaran.".docx";
            $this->SaveSurat($per->id, 'SKRD', 'SK Perizinan', $f);

            $render->saveAs($filename['docx']);
            if(file_exists($filename['docx'])){
                //WORD
                response()->file($filename['docx'],[
                    'Content-Disposition'=>'inline;filename="SKRD_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.docx"'
                ]);
                // Konversi Ke PDF
                // Jika sudah pernah di konversi sebelumnya
                if(file_exists($filename['pdf'])){
                  response()->file($filename['pdf'],[
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition'=>'inline;filename="SKRD_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.pdf"'
                  ]);
                }else{
                  // Jika belum pernah di konversi sebelumnya
                  $konversi = \App\Http\KonversiPdf::Konversi($per, $filename);
                  return response()->file($konversi,[
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition'=>'inline;filename="SKRD_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.pdf"'
                  ]);
                }
                response()->file($filename['docx'],[
                    'Content-Disposition'=>'inline;filename="SKRD_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.docx"'
                ]);
            }else{
                exit('Requested file does not exist on our server!');
            }
        }else{
            dd("Template SK Perizinan Tidak Ditemukan");
        }

    }

    protected function spmcetak($per)
    {
        $izin = $per->getIzin;
        $sk = $per->getFinal;
        $identitas = \App\Models\Identitas::where('id', 1)->first();
        if($izin->penanda_tangan_akhir == 'bupati'){
            $nama_ttd = $identitas->bupati;
            $nip="";
        }else{
            $nama_ttd = $identitas->kepala_dinas;
            $nip=$identitas->nip_kepala_dinas;
        }

        $meta = json_decode($per->metadata, true);

        if($per->getIzin->kategori_prosedur_id == 1){
            // retribusi 
            $ret = \App\Models\RetImb::where('id_permohonan', $per->id)->first();
            $file = storage_path('app/template_perizinan/template_spm_imb.docx');
        }elseif($per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 4){
            // IMB dan IMB Revisi
            $ret = \App\Models\RetImb::where('id_permohonan', $per->id)->first();
            $file = storage_path('app/template_perizinan/template_spm_imb.docx');
        }elseif($per->getIzin->kategori_prosedur_id == 7){
            // KRK
            $ret = \App\Models\RetKrk::where('id_permohonan', $per->id)->first();
            $file = storage_path('app/template_perizinan/template_spm_krk.docx');
        }elseif($per->getIzin->kategori_prosedur_id == 6){
            // TRAYEK
            $ret = \App\Models\RetTrayek::where('id_permohonan', $per->id)->first();
            $file = storage_path('app/template_perizinan/template_spm_trayek.docx');
        }

        //Tanda Tangan
        $nama_kadin = $identitas->kepala_dinas;
        $nip_kadin = $identitas->nip_kepala_dinas;
        $jabatan_kadin = $identitas->jabatan_kadin;
        $pangkat_kadin = $identitas->pangkat_kadin;
        $atas_nama = $identitas->atas_nama;

        //NAMA PEMOHON
        $gelar_depan = is_nol_string('',$per->getPemohon->gelar_depan);
        $gelar_belakang = is_nol_string(',',$per->getPemohon->gelar_belakang);
        $nama_tengah = strtoupper($per->getPemohon->nama);
        $nama_pemohon = $gelar_depan." ".$nama_tengah." ".$gelar_belakang;

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

        if(file_exists($file)){

            $filename = [
                            'docx'=>dokumen_path($per)."/SKRD_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".docx",
                            'pdf'=>dokumen_path($per)."/SKRD_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf",
            ];
            $render = new \App\Workflow\TemplateProccessorCustom($file);

            //hapus jika sudah ada file sebelumnya
            if(file_exists($filename['docx'])){
                unlink($filename['docx']);
            }
            if(file_exists($filename['pdf'])){
                unlink($filename['pdf']);
            }

            $sertifikat = $per->getSertifikat()->get()->first();

            if($ret){
                $render->setValue('no_spm', $ret->no_spm);
            }else{
                $render->setValue('no_spm', "........");
            }

            $nama_usaha = ($per->izin != 139) ? 'BRT/PERUMAHAN MBR' : '-' ;
            $logo = "uploads/".$identitas->logo_public;

            $render->setValue('nama', $nama_pemohon);
            $render->setValue('alamat', strtoupper($alamat_pemohon));
            $render->setValue('nama_usaha', strtoupper($nama_usaha));
            $render->setValue('nomor_pendaftaran', strtoupper($per->no_pendaftaran_sementara));
            $render->setValue('tahun', date('Y'));
            $render->setValue('bulan', month_id(date('m')));
            $render->setValue('tgl_spm', date_id(date('Y-m-d')));
            $render->setImg('logo',array('src' => $logo,'swh'=>'120'));

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



            if($per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 4){ //imb

                $render->setValue('kode_retribusi_imb', $ret->kode_retribusi_imb);
                $render->setValue('kode_papan_proyek', $ret->kode_papan_proyek);
                $render->setValue('kode_plat_imb', $ret->kode_plat_imb);
                $render->setValue('kode_denda_imb', $ret->kode_denda_imb);
                $render->setValue('retribusi_imb', 'Rp. '.number_format($ret->retribusi_imb));
                $render->setValue('papan_proyek', 'Rp. '.number_format($ret->papan_proyek));
                $render->setValue('plat_imb', 'Rp. '.number_format($ret->plat_imb));
                $render->setValue('denda_imb', 'Rp. '.number_format($ret->denda_imb));
                $render->setValue('total', 'Rp. '.number_format($ret->total));
                $render->setValue('terbilang', strtoupper(\App\Util\Terbilang::Konversi($ret->total)).' Rupiah');
               
            }elseif($per->getIzin->kategori_prosedur_id == 7){ //krk

                $render->setValue('kode_biaya_ukur', $ret->kode_biaya_ukur);
                $render->setValue('kode_blanko_krk', $ret->kode_blanko_krk);
                $render->setValue('kode_peta_krk', $ret->kode_peta_krk);
                $render->setValue('kode_denda_krk', $ret->kode_denda_krk);
                $render->setValue('biaya_ukur', 'Rp. '.number_format($ret->biaya_ukur));
                $render->setValue('blanko_krk', 'Rp. '.number_format($ret->blanko_krk));
                $render->setValue('peta_krk', 'Rp. '.number_format($ret->peta_krk));
                $render->setValue('denda_krk', 'Rp. '.number_format($ret->denda_krk));
                $render->setValue('total', 'Rp. '.number_format($ret->total));
                $render->setValue('terbilang', strtoupper(\App\Util\Terbilang::Konversi($ret->total)).' Rupiah');

            }elseif($per->getIzin->kategori_prosedur_id == 6){ //trayek

                $render->setValue('kode_retribusi_trayek', $ret->kode_retribusi_trayek);
                $render->setValue('kode_kartu_pengawasan_trayek', $ret->kode_kartu_pengawasan_trayek);
                $render->setValue('kode_denda_trayek', $ret->kode_denda_trayek);
                $render->setValue('retribusi_trayek', 'Rp. '.number_format($ret->retribusi_trayek));
                $render->setValue('kartu_pengawasan_trayek', 'Rp. '.number_format($ret->kartu_pengawasan_trayek));
                $render->setValue('denda_trayek', 'Rp. '.number_format($ret->denda_trayek));
                $render->setValue('total', 'Rp. '.number_format($ret->total));
                $render->setValue('terbilang', strtoupper(\App\Util\Terbilang::Konversi($ret->total)).' Rupiah');

            }

            //Tanda tangan
            $render->setValue('nama_kadin', $nama_kadin);
            $render->setValue('nip_kadin', $nip_kadin);
            $render->setValue('jabatan_kadin', $jabatan_kadin);
            $render->setValue('pangkat_kadin', $pangkat_kadin);
            $render->setValue('atas_nama', $atas_nama);

            //additional variabel
            $render->setValue('masa_berlaku', htmlentities($izin->masa_berlaku));
            
            $render->setValue('tahun_sekarang', htmlentities(date('Y')));
            $render->setValue('bulan_sekarang', htmlentities(month_id(date('m'))));
            $render->setValue('tanggal_sekarang', htmlentities(date('d')));

            $render->setValue('tanggal_pendaftaran', htmlentities($per->tgl_pendaftaran->format('d')));
            $render->setValue('bulan_pendaftaran', htmlentities(month_id($per->tgl_pendaftaran->format('m'))));
            $render->setValue('tahun_pendaftaran', htmlentities($per->tgl_pendaftaran->format('Y')));

            if($sk)
            {
                $render->setValue('tanggal_sk', htmlentities($sk->tgl_penetapan->format('d')));
                $render->setValue('bulan_sk', htmlentities(month_id($sk->tgl_penetapan->format('m'))));
                $render->setValue('tahun_sk', htmlentities($sk->tgl_penetapan->format('Y')));
            }else{
                $render->setValue('tanggal_sk', htmlentities('...'));
                $render->setValue('bulan_sk', htmlentities('...'));
                $render->setValue('tahun_sk', htmlentities('...'));
            }


            $f ="SKRD_".strtoupper($izin->nama)."_".$per->no_pendaftaran.".docx";
            $this->SaveSurat($per->id, 'SKRD', 'SK Perizinan', $f);

            $render->saveAs($filename['docx']);
            if(file_exists($filename['docx'])){
                //WORD
                response()->file($filename['docx'],[
                    'Content-Disposition'=>'inline;filename="SKRD_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.docx"'
                ]);
                // Konversi Ke PDF
                // Jika sudah pernah di konversi sebelumnya
                if(file_exists($filename['pdf'])){
                  response()->file($filename['pdf'],[
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition'=>'inline;filename="SKRD_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.pdf"'
                  ]);
                }else{
                  // Jika belum pernah di konversi sebelumnya
                  $konversi = \App\Http\KonversiPdf::Konversi($per, $filename);
                  return response()->file($konversi,[
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition'=>'inline;filename="SKRD_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.pdf"'
                  ]);
                }
                response()->file($filename['docx'],[
                    'Content-Disposition'=>'inline;filename="SKRD_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.docx"'
                ]);
            }else{
                exit('Requested file does not exist on our server!');
            }
        }else{
            dd("Template SK Perizinan Tidak Ditemukan");
        }

    }

}

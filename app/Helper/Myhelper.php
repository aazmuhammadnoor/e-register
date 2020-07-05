<?php
use App\Models\Menu;
use App\Models\RoleMenu;
use App\Models\Identitas;

if(!function_exists('akses'))
{
    function akses($perm)
    {
        $user = Auth::user()->hasPermissionTo($perm);
        if(!$user){
            abort(401);
        }
    }
}

if(!function_exists('isCan'))
{
    function isCan($perm)
    {
        $user = Auth::user()->hasPermissionTo($perm);
        if(!$user){
            return false;
        }else{
            return true;
        }
    }
}

if(!function_exists('jenis_kelamin'))
{
    function jenis_kelamin($jk)
    {
        if($jk == 1){
            return "Laki - laki";
        }else{
            return "Perempuan";
        }
    }
}

if(!function_exists('identitas'))
{
    function identitas()
    {
        $rs = Identitas::where('id', 1)->first();
        return $rs;
    }
}

if(!function_exists('form_perizinan'))
{
    function form_perizinan($id)
    {
        $izin = App\Models\JenisPermohonanIzin::where('id', $id)->first();
        $syarat = $izin->syarat()->get();

        $form_fields = json_decode($izin->metadata);
        $fields_count = sizeof($form_fields->fields) - 1;
        $forms="";
        for($i=0; $i<=$fields_count; $i++){
            if($form_fields->fields[$i]!=null)
            {
                if($form_fields->tipe[$i] == 'text' || $form_fields->tipe[$i] == 'number' || $form_fields->tipe[$i] == 'peta'){
                    $forms.=form_text($form_fields->fields[$i], $form_fields->values[$i], $form_fields->cols[$i]);
                }

                if($form_fields->tipe[$i] == 'date'){
                    $forms.=form_date($form_fields->fields[$i], $form_fields->values[$i], $form_fields->cols[$i]);
                }

                if($form_fields->tipe[$i] == 'radio'){
                    $forms.=form_radio($form_fields->fields[$i], $form_fields->values[$i], $form_fields->cols[$i]);
                }

                if($form_fields->tipe[$i] == 'checkbox'){
                    $forms.=form_checkbox($form_fields->fields[$i], $form_fields->values[$i], $form_fields->cols[$i]);
                }

                if($form_fields->tipe[$i] == 'select'){
                    $forms.=form_select($form_fields->fields[$i], $form_fields->values[$i], $form_fields->cols[$i]);
                }

                if($form_fields->tipe[$i] == 'database'){
                    $forms.=form_database($form_fields->fields[$i], $form_fields->values[$i], $form_fields->cols[$i]);
                }

                if($form_fields->tipe[$i] == 'textarea'){
                    $forms.=form_textarea($form_fields->fields[$i], $form_fields->values[$i], $form_fields->cols[$i]);
                }

                if($form_fields->tipe[$i] == 'file'){
                    $forms.=form_file($form_fields->fields[$i], $form_fields->values[$i], $form_fields->cols[$i]);
                }
            }
        }
        return $forms;
    }
}

function form_text($name, $value=null, $size=6){
    $form = "<div class='col-$size'>";
    $form.=" <div class='form-group'>";
        $form.= "<label>".clean_title($name)."</label>";
        $form.= Form::text($name, old($name), ['class'=>'form-control']);
    $form.= "</div></div>";

    return $form;
}

function form_date($name, $value=null, $size=6)
{
    $form = "<div class='col-$size'>";
    $form.= "<div class='form-group'>";
        $form.= "<label>".clean_title($name)."</label>";
        $form.= "<div class='input-group'>";
            $form.= Form::text($name, old($name), ['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','data-language'=>'id']);
            $form.= '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
        $form.= "</div>";
    $form.= "</div>";
    $form.= "</div>";

    return $form;
}

function form_radio($name, $value=null, $size=6)
{

    $val = explode(",", $value);

    $form = "<div class='col-$size'>";
    $form.= "<div class='form-group'>";
        $form.= "<label>".clean_title($name)."</label>";
        foreach($val as $rd){
            $form.= "<div class='custom-controls-stacked'>";
                $form.= "<label class='custom-control custom-radio'>";
                $form.= Form::radio($name,$rd, null,['class'=>'custom-control-input']);
                $form.= "<span class='custom-control-indicator'></span>";
                $form.= "<span class='custom-control-description'>$rd</span></label>";
            $form.= "</div>";
        }
    $form.= "</div>";
    $form.= "</div>";

    return $form;
}

function form_checkbox($name, $value=null, $size=6)
{

    $val = explode(",", $value);

    $form = "<div class='col-$size'>";
    $form.= "<div class='form-group'>";
        $form.= "<label>".clean_title($name)."</label>";
        foreach($val as $rd){
            $form.= "<div class='custom-controls-stacked'>";
                $form.= "<label class='custom-control custom-checkbox'>";
                $form.= Form::checkbox($name."[]",$rd, null,['class'=>'custom-control-input']);
                $form.= "<span class='custom-control-indicator'></span>";
                $form.= "<span class='custom-control-description'>$rd</span></label>";
            $form.= "</div>";
        }
    $form.= "</div>";
    $form.= "</div>";

    return $form;
}

function form_select($name, $value=null, $size=6)
{
    $val = explode(",", $value);
    $arr = [];
    foreach($val as $r){
        $arr[$r] = $r;
    }

    $form = "<div class='col-$size'>";
    $form.= "<div class='form-group'>";
        $form.= "<label>".clean_title($name)."</label>";
        $form.= Form::select($name, $arr, null, ['class'=>'form-control','data-provide'=>'selectpicker','data-live-search'=>'true']);
    $form.= "</div>";
    $form.= "</div>";

    return $form;
}

function form_textarea($name, $value=null, $size=6)
{
    $form = "<div class='col-$size'>";
    $form.= "<div class='form-group'>";
        $form.= "<label>".clean_title($name)."</label>";
        $form.= Form::textarea($name, $value, ['class'=>'form-control','rows'=>'4']);
    $form.= "</div>";
    $form.= "</div>";

    return $form;
}

function form_file($name, $value=null, $size=6)
{
    $form = "<div class='col-$size'>";
    $form.= "<div class='input-group form-type-combine file-group'>";
        $form.= "<div class='input-group-input'>";
            $form.= "<label>".clean_title($name)."</label>";
            $form.= Form::text($name."_value",null, ['class'=>'form-control file-value']);
            $form.= Form::file($name);
        $form.= "</div>";
        $form.= '<span class="input-group-btn"><button class="btn btn-light file-browser" type="button"><i class="fa fa-upload"></i></button></span>';
    $form.= "</div>";
    $form.= "</div>";

    return $form;
}

function form_database($name, $value=null, $size=6)
{

    if(str_contains($value, '|')){
        $base_model = explode("|", $value);
        $model = app($base_model[0]);
        $var = explode(",", $base_model[1]);
        $val = $model::where($var[0], $var[1])->get();
    }else{
        $model = app("$value");
        $val = $model::get();
    }

    $arr = [];
    foreach($val as $r){
        $arr[$r->name] = $r->name;
    }

    $form = "<div class='col-$size'>";
    $form.= "<div class='form-group'>";
        $form.= "<label>".clean_title($name)."</label>";
        $form.= Form::select($name, $arr, null, ['class'=>'form-control','data-provide'=>'selectpicker','data-live-search'=>'true']);
    $form.= "</div>";
    $form.= "</div>";

    return $form;
}

function clean_title($str)
{
    return str_replace("_", " ", $str);
}


if (!function_exists('activeMenu')) {
    function activeMenu($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active open';
    }
}

if(!function_exists('date_day'))
{
    function date_day($tgl){
        $tanggal = date('D, d M Y', strtotime($tgl));
        $format = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
            'Jan' => 'Januari',
            'Feb' => 'Februari',
            'Mar' => 'Maret',
            'Apr' => 'April',
            'May' => 'Mei',
            'Jun' => 'Juni',
            'Jul' => 'Juli',
            'Aug' => 'Agustus',
            'Sep' => 'September',
            'Oct' => 'Oktober',
            'Nov' => 'November',
            'Dec' => 'Desember'
        );

        return strtr($tanggal, $format);
    }
}

if(!function_exists('date_id'))
{
    function date_id($tgl){
        if($tgl != null && $tgl != '0000-00-00' && $tgl != '1970-01-01'){
            $tanggal = date('d M Y', strtotime($tgl));
            $format = array(
                'Jan' => 'Januari',
                'Feb' => 'Februari',
                'Mar' => 'Maret',
                'Apr' => 'April',
                'May' => 'Mei',
                'Jun' => 'Juni',
                'Jul' => 'Juli',
                'Aug' => 'Agustus',
                'Sep' => 'September',
                'Oct' => 'Oktober',
                'Nov' => 'November',
                'Dec' => 'Desember'
            );

            return strtr($tanggal, $format);
        }else{
            return null;
        }
    }
}

if(!function_exists('date_id_number'))
{
    function date_id_number($tgl){
        if($tgl != null && $tgl != '0000-00-00' && $tgl != '1970-01-01'){
            $tanggal = date('d-m-Y', strtotime($tgl));

            return $tanggal;
        }else{
            return null;
        }
    }
}

if(!function_exists('date_indo'))
{
    function date_indo($tgl){
        if($tgl != null && $tgl != '1970-01-01' && $tgl != '0000-00-00'){
            $tanggal = date('Y-m-d', strtotime($tgl));
            $format = array(
                'Jan' => 'Januari',
                'Feb' => 'Februari',
                'Mar' => 'Maret',
                'Apr' => 'April',
                'May' => 'Mei',
                'Jun' => 'Juni',
                'Jul' => 'Juli',
                'Aug' => 'Agustus',
                'Sep' => 'September',
                'Oct' => 'Oktober',
                'Nov' => 'November',
                'Dec' => 'Desember'
            );
            return strtr($tanggal, $format);
        }else{
            return null ;
        }
    }
}

if(!function_exists('date_month'))
{
    function date_month($tgl){
        $format = array(
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        return strtoupper($format[$tgl]);
    }
}

if(!function_exists('month_id'))
{
    function month_id($tgl){
        $format = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        return ucwords($format[$tgl]);
    }
}

if(!function_exists('menu'))
{
    function menu()
    {
        $userID = auth()->user()->id;
        $isAdmin = auth()->user()->is_admin;

        /*if($isAdmin)
        {
            $menu = Menu::whereNull('parent')
                ->with('childMenu')
                ->orderBy('urutan','asc')
                ->get();
            return render_menu($menu);

        }else{

            $role = Auth::user()->roles()
            ->with(['menus'=>function($query){
                $query->where('parent','=',null);
            }])
            ->first();
            $menu = $role->menus;
            return render_menu($menu);
        }*/

        $role = Auth::user()->roles()
            ->with(['menus'=>function($query){
                $query->where('parent','=',null)
                ->orderBy('urutan','asc');
            }])
            ->first();
            $menu = $role->menus;
            return render_menu($menu);
    }
}

if(!function_exists('render_menu'))
{
    function render_menu($menu)
    {
        $ext_menu = auth()->user()->roles()->with('menus')->first();
        $akses = $ext_menu->menus->pluck('id')->toArray();
        $ret="";
        foreach($menu as $main_menu)
        {
            if($main_menu->childMenu()->count() > 0)
            {
                $ret.="<li class='menu-item ".activeMenu(str_slug(strtolower($main_menu->label)))."'><a href='#' class='menu-link'><span class='".$main_menu->icon."'></span> <span class='title'>".$main_menu->label."</span><span class='arrow'></span></a>";
                $ret.="<ul class='menu-submenu'>";

                $child = \App\Models\Menu::where('parent',$main_menu->id)->orderBy('urutan','asc')->get();
                foreach($child as $sub)
                {
                    if(in_array($sub->id, $akses)){
                        $sub_menu = str_replace("/",".",$sub->url);
                        $ret.="<li class='menu-item ".activeMenu(str_slug(strtolower($sub_menu)))."'><a href='".url($sub->url)."' class='menu-link'><span class='dot'></span><span class='title'>".$sub->label."</span></a></li>";
                    }
                }
                $ret.="</ul>";
                 $ret.="</li>";
            }else{
                $ret.="<li class='menu-item ".activeMenu(str_slug(strtolower($main_menu->url)))."'><a href='".url($main_menu->url)."' class='menu-link'><span class='".$main_menu->icon."'></span> <span class='title'>".$main_menu->label."</span></a></li>";
            }

        }

        return $ret;
    }
}

if(!function_exists('dokumen_path'))
{
    function dokumen_path($permohonan)
    {
        $path = storage_path("permohonan/dokumen/".$permohonan->no_pendaftaran_sementara."/".md5($permohonan->no_pendaftaran_sementara."/"));
		if(!\File::exists($path)) {
			\File::makeDirectory($path, 0775, true, true);
		}
        return $path;
    }
}

if(!function_exists('dokumen_path_pencabutan'))
{
    function dokumen_path_pencabutan($pencabutan)
    {
        $path = storage_path("pencabutan/".$pencabutan->no_pencabutan."/".md5($pencabutan->no_pencabutan."/"));
        if(!\File::exists($path)) {
            \File::makeDirectory($path, 0775, true, true);
        }
        return $path;
    }
}

if(!function_exists('generate_qrcode_sk'))
{
    function generate_qrcode_sk($per,$nomor_sk,$nama_pemohon,$tempat_usaha)
    {
        $path = dokumen_path($per);

        $qrcode_content = $nomor_sk."/".$nama_pemohon."/".$tempat_usaha;
        $qrcode_image = str_slug($nomor_sk).".png";

        \QrCode::format('png')->size(150)
            ->margin(0)
            ->generate($qrcode_content,$path."/".$qrcode_image);

        return $path."/".$qrcode_image;
    }
}

if(!function_exists('generate_qrcode2'))
{
    function generate_qrcode_2($permohonan,$nama,$izin,$is_sementara=false)
    {
        $path = dokumen_path($permohonan);
        if(!$is_sementara)
        {
            $qrcode_content = $permohonan->no_pendaftaran."/".$nama."/".$izin;
            $qrcode_image = str_slug($permohonan->no_pendaftaran).".png";
        }else{
            $qrcode_content = $permohonan->no_pendaftaran_sementara."/".$nama."/".$izin;
            $qrcode_image = str_slug($permohonan->no_pendaftaran_sementara)."_sementara.png";
        }

        \QrCode::format('png')->size(150)
            ->margin(0)
            ->generate($qrcode_content,$path."/".$qrcode_image);

        return $path."/".$qrcode_image;
    }
}

if(!function_exists('generate_qrcode'))
{
    function generate_qrcode($permohonan,$is_sementara=false)
    {
        $path = dokumen_path($permohonan);
        if(!$is_sementara)
        {
            $qrcode_content = $permohonan->no_pendaftaran."/".$permohonan->getPendaftar->nama."/".$permohonan->getIzin->nama;
            $qrcode_image = str_slug($permohonan->no_pendaftaran).".png";
        }else{
            $qrcode_content = $permohonan->no_pendaftaran_sementara."/".$permohonan->getPendaftar->nama."/".$permohonan->getIzin->nama;
            $qrcode_image = str_slug($permohonan->no_pendaftaran_sementara)."_sementara.png";
        }

        \QrCode::format('png')->size(150)
            ->margin(0)
            ->generate($qrcode_content,$path."/".$qrcode_image);

        return $path."/".$qrcode_image;
    }
}

if(!function_exists('generate_foto'))
{
    function generate_foto($pendaftar)
    {
        $path = storage_path("app/pasfoto/".$pendaftar);
        if(!\File::exists($path)) {
            \File::makeDirectory($path, 0775, true, true);
        }

        return $path;
    }
}

if(!function_exists('find_by_name_field'))
{
    function find_by_name_field($json)
    {
        $data = json_decode($json);
        if(isset($data->nama_lengkap)){
            return $data->nama_lengkap;
        }elseif(isset($data->nama_pemohon)){
            return $data->nama_pemohon;
        }else{
            return " ";
        }
    }
}

if(!function_exists('no_pendaftaran'))
{
    function no_pendaftaran($izin)
    {
        if($izin->no_pendaftaran!='')
        {
            $nomor = "<span class='badge badge-success'>".$izin->no_pendaftaran."</span>";
        }else{
            if(!$izin->izin_lama){
                $nomor = "<span class='badge badge-danger'>".$izin->no_pendaftaran_sementara."</span>";
            }else{
                $nomor = '-';
            }
        }

        return $nomor;
    }
}

if(!function_exists('title_sessi'))
{
    function title_sessi()
    {
        if(session()->has('sessi_izin')){
            $id = session()->get('sessi_izin');
            $title = "&rang; ".\App\Models\JenisPermohonanIzin::findOrFail($id)->nama;
        }else{
            $title = "";
        }

        if(session()->has('tgl_dari')){
            $tgl_a = session()->get('tgl_dari');
            $tgl_b = session()->get('tgl_sampai');
            if($tgl_a == $tgl_b){
                $title.=" ".date_day($tgl_a)."";
            }else{
                $title.=" Periode ".date_id($tgl_a)." s/d ".date_id($tgl_b);
            }
        }

        return $title;
    }
}

if(!function_exists('is_koordinat')){
    function is_koordinat($string)
    {
        $valid = preg_match('/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/', $string);
        return (($valid)) ? true : false;
    }
}

if(!function_exists('array_status')){
    function array_status($status)
    {
        $arr = [
            'pendaftaran'=>'Proses Pendaftaran',
            'verifikasi'=>'Verifikasi Administrasi',
            'tinjau'=>'Peninjauan Lapangan',
            'rapat.pasca.tinjau'=>'Rapat Koordinasi',
            'draft'=>'Pembuatan Draft Izin',
            'retribusi'=>'Pembyaran Retribusi',
            'legalisasi'=>'Proses Legalisasi',
            'selesai'=>'Selesai',
            'diambil'=>'Sudah Diambil',
            'ditolak'=>'Ditolak'
        ];

        return $arr[$status];
    }
}

function notifIzin($izin) {
    $rs = \App\Models\JenisPermohonanIzin::where('id',$izin)->first();
    return ($rs) ? $rs->nama : "";
}

function kepemilikan_izin($izin)
{
    $rs = \App\Models\JenisPermohonanIzin::where('id',$izin)->first();
    return ($rs) ? true : false;
}

function pengumumnan($cek=true)
{
    if(\Auth::user())
    {
        $pengumuman = \App\Models\Pengumuman::query()
                                    ->where(function($q)
                                    {
                                        $q->where('publish','keduanya')
                                            ->orWhere('publish','member');
                                    })
                                    ->orderBy('id','desc')
                                    ->limit(5)
                                    ->get();
    }else{
        $pengumuman = \App\Models\Pengumuman::query()
                                    ->where(function($q)
                                    {
                                        $q->where('publish','keduanya')
                                            ->orWhere('publish','publik');
                                    })
                                    ->orderBy('id','desc')
                                    ->limit(5)
                                    ->get();
    }
    $link="";
    $num = 0;
    if($cek){
        return $pengumuman->count();
    }else{
        foreach($pengumuman as $pr){
            if($num!=0)
            {
                $link.="<i class='fa fa-circle-o mx-3'></i>";
            }
            $link.="<a href='#' data-provide='modaler' data-title='Pengumuman' data-url='".url('pengumuman/view',[$pr->id])."' class='text-white'>".$pr->judul."</a>";
            $num++;
        }

        return $link;
    }
}

function text_status_permohonan($status,$posisi=null)
{
    if($posisi){
        switch ($posisi) {
            case 'batal':
               return "Permohonan Dibatalkan";
            break;
            case 'tolak':
               return "Permohonan Ditolak";
            break;
            case 'pemohon':
               return "Permohonan di Pemohon";
            break;
        }
    }

    $arr = [
            'mengisi.formulir.pendaftaran'=>'Mengisi Formulir Permohonan',
            'submit.formulir.pendaftaran'=>'Input Data Permohonan Ke Sistem',
            'mengisi.formulir.permohonan'=>'Mengisi Formulir Permohonan',
            'submit.formulir.permohonan'=>'Input Data Permohonan Ke Sistem',
            'melengkapi.persyaratan'=>'Melengkapi Persyaratan Permohonan',
            'pemeriksaan.berkas'=>'Memeriksa kelengkapan berkas',
            'melengkapi.kekurangan'=>'Melengkapi Kekurangan Persyaratan Permohonan',
            'verifikasi.permohonan'=>'Verifikasi Kelengkapan Berkas Permohonan',
            'approval.pemeriksaan.berkas'=>'Persetujuan Hasil Pemeriksaan Berkas',
            'pembahasan.teknis'=>'Pembahasan Teknis',
            'memperbaiki.berkas'=>'Memperbaiki Berkas',
            'survey'=>'Survey',
            'bap'=>'BAP Rekomensasi Teknis',
            'cetak.sk'=>'Pengetikan SK',
            'cetak.spm'=>'Pengetikan Surat Perintah Membayar',
            'membayar'=>'Membayar',
            'verifikasi.pembayaran'=>'Verifikasi Pembayaran',
            'skrd'=>'Surat Keterangan Retribusi Daerah',
            'approval.cetak.sk'=>'Persetujuan Cetak SK',
            'approval.draft'=>'Persetujuan Draft SK',
            'sign.draft'=>'Tanda Tangan Draft SK',
            'pengambilan'=>'Pengambilan SK',
            'arsip'=>'Pengarsipan',
            'proses.tinjau'=>'Peninjauan Lapangan oleh Petugas',
            'rapat.pasca.tinjau'=>'Rapat Koordinasi Hasil Peninjauan Lapangan',
            'pengetikan.draft.keputusan'=>'Pengetikan Draft Keputusan',
            'pembayaran.retribusi'=>'Pembayaran Retribusi',
            'legalisasi.permohonan'=>'Proses Legalisasi / Penandatangan Berkas/SK Perizinan',
            'pengambilan.berkas.perizinan'=>'Pengambilan SK',
            'permohonan.ditolak'=>'Pengajuan Permohonan Ditolak',
            'permohonan.dicabut'=>'Pengajuan Permohonan Dicabut',
            'pendaftaran.dibatalkan'=>'Pengajuan Permohonan Dibatalkan',
            'kasi.approval.pemeriksaan.berkas'=>'Proses Pemeriksaa Berkas',
            'selesai' => 'Permohonan Selesai'
        ];
    if(array_key_exists($status,$arr)){
        return $arr[$status];
    }else{
        return "Sedang Diproses";
    }
}


if(!function_exists('cek_status_permohonan'))
{
    function cek_status_permohonan($status)
    {
        $arr = [
            'kasi.approval.pemeriksaan.berkas'=>'Di Meja Kasi',
            'kasi.approval.cetak.sk'=>'Di Meja Kasi',
            'pemohon'=>'Posisi Di Pemohon',
            'korlap'=>'Di Meja KORLAP',
            'korlap.bap'=>'Di Meja KORLAP',
            'tim.teknis'=>'Di Meja Tim Teknis',
            'bo.cetak.spm'=>'Di Meja Cetak SPM',
            'bendahara'=>'Di Meja Bendahara',
            'bo.skrd'=>'Di Meja Cetak SKRD dan SK',
            'bo.cetak.sk'=>'Di Meja Cetak  SK',
            'kabid'=>'Di Meja KABID',
            'kadin'=>'Di Meja KADIN',
            'pengambilan'=>'Di Meja PENGAMBILAN',
            'arsip'=>'SK Sudah Diambil ',
        ];
        if(array_key_exists($status,$arr)){
            return $arr[$status];
        }else{
            return "Sedang Diproses";
        }
    }
}

if(!function_exists('check_role_per_dinas'))
{
    function check_role_per_dinas($role)
    {
        if($role == false){
            abort(401,"Permession Denied");
        }
    }
}

if(!function_exists('role_user'))
{
    function role_user($role_a,$role_b)
    {
        $object = [];

        $object['user'] = $role_a;
        $object['permohonan'] = $role_b;
        if($role_b != null){
         $object['status'] = ($role_a == $role_b) ? true : false;
        }else{
         $object['status'] = true ;
        }

        return (object) $object;
    }
}

if(!function_exists('is_date'))
{
    function is_date($date)
    {
        if(strtotime($date)){
            return date('d-m-Y',strtotime($date));
        }else{
            return $date;
        }

    }
}

if(!function_exists('is_date_bol'))
{
    function is_date_bol($date)
    {
        if(strtotime($date)){
            return true ;
        }else{
            return false ;
        }

    }
}

if(!function_exists('is_nol_string'))
{
    function is_nol_string($ket,$text)
    {
        if($text == '0' && $text == null && $text='-'){
            return '';
        }else{
            return $ket.' '.$text;
        }
    }
}

if(!function_exists('sk_lengkap'))
{
    function sk_lengkap($per)
    {   
        if($per->getFinal)
        {
            if($per->getFinal->no_sk_lengkap == '' && $per->getFinal->no_sk_lengkap == null)
            {

                $sk = $per->getFinal;
                $kode_tengah = ($per->getIzin->kode_sk_tengah != '' && $per->getIzin->kode_sk_tengah != null) ? $per->getIzin->kode_sk_tengah : 'DPMPTSP-PPL';

                if($per->getIzin->penomoran_sk == "Auto"){
                    $no_sk = ($sk) ? $sk->nomor_sk."/".$kode_tengah."/".date('Y',strtotime($sk->tgl_penetapan)) : $per->no_pendaftaran_sementara;
                }else{
                    $no_sk = ($sk) ? $sk->nomor_sk : $per->no_pendaftaran_sementara;
                }
            }else{
                $no_sk = $per->getFinal->no_sk_lengkap;
            }
        }else{
            $no_sk = '-';
        }


        return $no_sk;
    }
}

if(!function_exists('workflow_task'))
{
    function workflow_task($row,$sub_task,$event)
    {   
        $workflow = \App\Models\Task::where("workflow",$row->workflow)
                                    ->where("sub_task",$sub_task)
                                    ->where("event",$event)
                                    ->orderBy("created_at","desc")
                                    ->first();
        return $workflow;
    }
}

/* hitung selisih rata2 pengerjaan */
if(!function_exists('workflow_task_izin'))
{
    function workflow_task_izin($izin,$start,$end)
    {   
        $start = \App\Models\Task::where("event","mulai")
                                    ->join("permohonan","permohonan.workflow","=","workflow_task.workflow")
                                    ->join("m_jenis_permohonan_izin","m_jenis_permohonan_izin.id","=","permohonan.izin")
                                    ->where("sub_task",$start)
                                    ->first();
        return $workflow;
    }
}

/* cari identitas user */
if(!function_exists('user_id'))
{
    function user_id($id)
    {   
        $user = \App\Models\User::where("id",$id)->first();
        return $user;
    }
}

/* sortir menu */
if(!function_exists('order'))
{
    /**
     * ordering number
     */
    function order($parent_result,$id,$current)
    {   
        $element = '<select class="form-control custom-select ordering" data-id="'.$id.'">';

        $no = 0;
        foreach($parent_result as $row)
        {
            $no++;
            $isSelected = ($row->urutan == $current) ? 'selected' : '';

            $element .= '<option value="'.$row->urutan.'" '.$isSelected.' >'.$no.'</option>';
        }

        $element .= '</select>';

        echo $element;
    }
}

if(!function_exists('menu_backend'))
{

    /**
     * get menu
     */
    function menu_backend($id_parent=null)
    {   
        if($id_parent)
        {
            $resultMenu = Menu::where("parent",$id_parent)
                                ->orderBy('urutan'); 
        }else{
            $resultMenu = Menu::where(function($q) {
                                      $q->whereNull('parent')
                                        ->orWhere('parent', 0);
                                  })
                                ->orderBy('urutan'); 
        }

        if($resultMenu->count() > 0) // if has result
        {
            $resultMenu = $resultMenu->get();

            foreach($resultMenu as $row)
            {   
                /*is have child*/
                $isHaveChild = Menu::where("parent",$row->id)->count();

                if($isHaveChild > 0)
                {

                    echo '<div class="each_menu">
                           <div class="row parent">
                            <div class="col col-sm-10">
                                <a href="#!" class="menu_link" data-toggle="collapse" data-target="#parent_'.$row->id.'">
                                    <i class="fa fa-chevron-down"></i> '.$row->label.'
                                </a>
                            </div>
                            <div class="col col-sm-2">';
                                order($resultMenu,$row->id,$row->urutan);
                    echo       '</div>
                              </div>

                              <div class="row collapse" name="child" id="parent_'.$row->id.'" style="padding : 10px 30px 7px 20px">
                                <div class="col-sm-12">';
                                    menu_backend($row->id);
                    echo        '</div>
                              </div>
                           </div>';

                }else{

                    echo '<div class="each_menu">
                           <div class="row parent">
                             <div class="col col-sm-10">
                                <i class="fa fa-circle-o"></i> '.$row->label.'
                             </div>
                             <div class="col col-sm-2">';
                                order($resultMenu,$row->id,$row->urutan);
                    echo       '</div>
                              </div>
                           </div>';

                }
                
            }
        }
    }
}

if(!function_exists('status_pencabutan'))
{
    function status_pencabutan($pen)
    {
        $status = $pen->posisi;
        $text = [
            "pengaduan" => "Pendaftaran",
            "kasi" => "Meja Kasi",
            "kabid" => "Meja Kabid",
            "kadin" => "Meja Kadin",
            "pengambilan" => "Meja Pengambilan",
            "arsip" => "Meja Arsip",
            "selesai" => "Selesai",
        ];
        if($status != 'selesai')
        {
            return "<i class='icon ti-timer text-danger'></i> ".$text[$status];
        }else{
            return "<i class='fa fa-check text-success'></i> ".$text[$status];
        }
    }
}

  /**
    * @method notif_admin
    * @return void
    */
if(!function_exists('notif_admin'))
{
    function notif_admin()
    {
        $user = auth()->user();
        $izin = \App\Models\JenisPermohonanIzin::query()
                                        ->select('m_jenis_permohonan_izin.id as izin_id')
                                        ->join('m_jenis_izin','m_jenis_izin.id','=','m_jenis_permohonan_izin.jenis_izin_id')
                                        ->join('m_kategori_dinas','m_kategori_dinas.id','=','m_jenis_izin.kategori_dinas_id');
        switch ($user->roles()->first()->id) {
            case 3: //kasi
                $filter_user = $user->seksi_izin;
                $izin = $izin->where('m_kategori_dinas.seksi_izin_id',$filter_user)->pluck('izin_id')->toArray();
                $notif = filter_notif($izin);
            break;

            case 10: //kabid
                $filter_user = $user->bidang_izin;
                $izin = $izin->where('m_kategori_dinas.bidang_izin_id',$filter_user)->pluck('izin_id')->toArray();
                $notif = filter_notif($izin);
            break;

            case 4: //korlap
            case 5: //teknis
                $filter_user = $user->kategori_dinas;
                $izin = $izin->where('m_jenis_izin.kategori_dinas_id',$filter_user)->pluck('izin_id')->toArray();
                $notif = filter_notif($izin);
            break;
            
            default:
                $notif = filter_notif();
            break;
        }

        return $notif;
    }
}

/**
 * @method filter_notif
 * @return array
 * @param $izin array
 */
if(!function_exists('filter_notif'))
{
    function filter_notif($izin=null)
    {
        $user = auth()->user();

        if($izin){
            $notif = \App\Models\Notif::select('id as token','id','type','notifiable_id','notifiable_type','data','read_at','created_at')
                                ->where('notifiable_id',$user->roles()->first()->id)
                                ->where(function($q) use ($izin){
                                    $q->where('data','like','%"izin":'.$izin[0].'%');
                                    foreach($izin as $key => $value)
                                    {
                                        $q->orWhere('data','like','%"izin":'.$value.'%');
                                    }
                                })
                                ->whereNull('read_at')
                                ->limit(6)
                                ->orderBy('created_at','desc')
                                ->get();
            /*$this_notif = [];
            foreach($notif as $row)
            {
                $jenis_izin = $row->data['permohonan']['izin'];
                if (in_array($jenis_izin, $izin)) {
                    array_push($row, $this_notif);
                }
            }
            return $this_notif;*/
            return $notif;
        }else{
            $notif = \App\Models\Notif::select('id as token','id','type','notifiable_id','notifiable_type','data','read_at','created_at')
                        ->where('notifiable_id',$user->roles()->first()->id)
                        ->whereNull('read_at')
                        ->limit(6)
                        ->orderBy('created_at','desc')
                        ->get();
            return $notif;
        }
    }
}

/**
 * @method notif_member
 * @return array
 * @param $izin array
 */
if(!function_exists('notif_member'))
{
    function notif_member()
    {
        $idpendaftar = auth()->user()->id;
        $notif = \App\Models\NotifMember::where("pendaftar",$idpendaftar)
                                        ->whereNull('read_at')
                                        ->limit(6)
                                        ->orderBy('created_at','desc')
                                        ->get();
        return $notif;
    }
}

if(!function_exists("requireData")){
        function requireData($variable,$r)
        {
            $status = true;
            foreach ($variable as $value) {
                if(!$r->has($value))
                {
                    $status = false;
                }else{
                    if($r->{$value} == null && $r->{$value} == '')
                    {
                        $status = false;
                    }
                }
            }
            return $status;
        }
    }

if(!function_exists('pathQR'))
{
    function pathQR($register)
    {
        $path = \Storage::path('qr_register/'.$register->thisFormRegister->url);
        if(!\File::exists($path)) {
            \File::makeDirectory($path, 0775, true, true);
        }
        return $path;
    }
}

if(!function_exists('createDIR'))
{
    function createDIR($path)
    {
        $dir = \Storage::path($path);
        if(!\File::exists($dir)) {
            \File::makeDirectory($dir, 0775, true, true);
        }
        return $dir;
    }
}


if(!function_exists('generateQR'))
{
    function generateQR($register)
    {
        $path = pathQR($register);

        $qrcode_content = str_slug($register->register_number);
        $qrcode_image = str_slug($register->register_number).".png";

        \QrCode::format('png')->size(150)
            ->margin(0)
            ->generate($qrcode_content,$path."/".$qrcode_image);

        return $path."/".$qrcode_image;
    }
}

if(!function_exists('renderMeta'))
{
    function renderMeta($register,$step,$field_name,$type)
    {
       $register_data = \App\Models\RegisterData::where('register',$register->id)
                                                ->where('form_step',$step->id)
                                                ->first();
        $data = json_decode($register_data->data);

        /*<option value="text" hidden>Tipe</option>
                                <option value="title">Judul</option>
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="date">Tanggal</option>
                                <option value="select">Dropdown</option>
                                <option value="radio">Choice</option>
                                <option value="checkbox">Checklis</option>
                                <option value="textarea">Textbox</option>
                                <option value="multitext">Multi Input</option>
                                <option value="file">Upload</option>
                                <option value="address">Alamat Administratif</option>
                                <option value="address_autocomplete">AutoComplete Alamat Administratif </option>*/
        switch ($type) {
            case 'text':
            case 'number':
            case 'select':
            case 'radio':
            case 'textarea':
                return renderText($field_name,$data);
            break;
            case 'date':
                return renderDate($field_name,$data);
            break;
            case 'checkbox':
            case 'multitext':
                return renderArray($field_name,$data);
            break;
            case 'file':
                return renderFile($field_name,$data);
            break;
            case 'address':
            case 'address_autocomplete':
                return renderAddress($field_name,$data);
            break;
            default:
                # code...
                break;
        }
    }
}

if(!function_exists('renderText'))
{
    function renderText($field_name,$data)
    {   
        $value = '';
        foreach($data as $row)
        {
            if($field_name == $row->field_name)
            {
                if(!empty($row->value))
                {
                    $value = $row->value;
                }
            }
        }
        return $value;
    }
}

if(!function_exists('renderArray'))
{
    function renderArray($field_name,$data)
    {   
        $value = '';
        foreach($data as $row)
        {
            if($field_name == $row->field_name)
            {
                if(!empty($row->value))
                {
                    $value = '<ul>';
                    foreach ($row->value as $d => $item) {
                       $value .= '<li>'.$item.'</li>';
                    }
                    $value .= '</ul>';
                }
            }
        }
        return $value;
    }
}

if(!function_exists('renderFile'))
{
    function renderFile($field_name,$data)
    {   
        $value = '';
        foreach($data as $row)
        {
            if($field_name == $row->field_name)
            {
                if(!empty($row->path))
                {
                    $value = "<a href='' class='current-color'><i class='icon ti-download'></i> Download</a>";
                }else{
                    $value = "<i>Belum ada unggahan</i>";
                }
            }
        }
        return $value;
    }
}

if(!function_exists('renderDate'))
{
    function renderDate($field_name,$data)
    {   
        $value = '';
        foreach($data as $row)
        {
            if($field_name == $row->field_name)
            {
                if(!empty($row->value))
                {
                    $value = $row->value;
                }
            }
        }
        return \Carbon\Carbon::parse($value)->format('d F Y');
    }
}

if(!function_exists('renderAddress'))
{
    function renderAddress($field_name,$data)
    {   
        $value = '';
        foreach($data as $row)
        {
            if($field_name == $row->field_name)
            {
                if(!empty($row->value))
                {
                    if(count($row->value) > 1)
                    {
                        $value = $row->value[1];
                    }
                }
            }
        }
        return $value;
    }
}
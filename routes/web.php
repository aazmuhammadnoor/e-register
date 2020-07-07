<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test/{email}','Testingemail@Tes');

Auth::routes();

Route::get('/', 'PublicController@index')->name('home');
Route::get('/register', function () {
    abort('404');
});
Route::post('file/view','Frontend\TempRegisterController@viewFile')->name('file.view');

Route::post('register-info', 'AjaxController@registerInfo')->name('register.info');
Route::get('register/{url}', 'Frontend\RegisterController@index')->name('register');
Route::get('register/{url}/info', 'Frontend\RegisterController@info')->name('register.info');
Route::get('register/{url}/download-bukti','Frontend\RegisterController@downloadBukti')->name('register.download.bukti');
Route::get('register/{url}/my-register', 'Frontend\MyRegisterController@info')->name('my.register');

Route::post('ajax/provinsi', 'AjaxController@getProvinsi')->name('provinsi');
Route::post('ajax/kabupaten', 'AjaxController@getKabupaten')->name('kabupaten');
Route::post('ajax/kelurahan', 'AjaxController@getkelurahan')->name('kelurahan');
Route::post('ajax/kecamatan', 'AjaxController@getkecamatan')->name('kecamatan');
Route::post('ajax/location/{kelurahan}', 'AjaxController@getLocation')->name('location');
Route::post('ajax/this-provinsi', 'AjaxController@thisProvinsi')->name('this.provinsi');
Route::post('/get-address-by-name', 'AjaxController@getAddressByName')->name('get.address.by.name');
Route::post('form-step/{formStep}/detail','Frontend\FormStepController@detail')->name('form.step.detail');
Route::post('file/{url}/{form_step}/upload','Frontend\TempRegisterController@uploadFile')->name('file.upload');
Route::post('file/{url}/{form_step}/remove','Frontend\TempRegisterController@removeFile')->name('file.remove');
Route::post('file/{url}/{form_step}/check','Frontend\TempRegisterController@checkFile')->name('file.check');

Route::post('register/{url}/{form_step}/submit','Frontend\TempRegisterController@submit')->name('register.submit');
Route::post('register/{url}/{form_step}/step-info','Frontend\TempRegisterController@stepInfo')->name('register.step.info');
Route::post('register/{url}/review','Frontend\TempRegisterController@review')->name('register.review');
Route::get('register/{url}/{temp_file}/{token}/preview', 'Frontend\TempRegisterController@previewFile')->name('register.file.view');
Route::post('register/{url}/final','Frontend\RegisterController@submit')->name('register.final');
Route::post('register/{url}/cancel','Frontend\TempRegisterController@cancel')->name('register.cancel');

Route::get('login/post', function () {
    abort('404');
});
Route::get('login/otp', function () {
    abort('404');
});
Route::post('login/post','LoginController@index')->name('login.post');
Route::post('login/check/otp','LoginController@otpCheck')->name('login.otp.check');
Route::get('login/otp/{email}','LoginController@otp')->name('login.otp');
Route::post('login/with-otp','LoginController@loginWithOtp');

Route::get('login/key/{email}','LoginController@password')->name('login.password');
Route::post('login/key','Auth\Registant\LoginController@login')->name('login.post.otp');

Route::group([ 'prefix' => 'mypage'], function(){

    Route::get('/','Frontend\MyPageController@index')->name('mypage');
    Route::get('register/{url}/{register}','Frontend\MyPageController@register')->name('mypage.register');
    Route::get('register/{register}/{register_file}/file','Frontend\MyPageController@file')->name('mypage.register.file');
    Route::get('change-password','Frontend\MyPageController@changePassword')->name('mypage.change.password');
    Route::post('change-password','Frontend\MyPageController@updatePassword')->name('mypage.update.password');

});


Route::get('/email', function () {
    return view('email');
});

Route::get('get-file', function (\Illuminate\Http\Request $r)
{
    $path = \Storage::path($r->file);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('app/pasfoto/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


Route::get('download_public/{filename}', function ($filename)
{
    $path = storage_path('app/download_publik/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('downloads/{filename}', function ($filename)
{
    $path = 'uploads/' . $filename;

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('download_admin/{template}/{filename}', function ($template,$filename)
{
    $path = storage_path('app/' . $template.'/'.$filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('download_file/{filename}', function ($template,$filename)
{
    $path = storage_path('app/'.$filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});



Route::get('admin/dashboard/list/{posisi}','HomeController@Lists');
Route::get('admin/dashboard/view/{per}','HomeController@DoView');

/* Anggota */
Route::get('anggota/daftar','Auth\Anggota\RegisterController@showRegistrationForm');
Route::post('anggota/daftar','Auth\Anggota\RegisterController@register');
Route::get('anggota/aktivasi/{kode}','Auth\Anggota\RegisterController@activation');
Route::get('login','Auth\Anggota\LoginController@showLoginForm');
Route::post('login','Auth\Anggota\LoginController@login');
Route::get('logout','Auth\Anggota\LoginController@logout');
Route::get('anggota','Anggota\HomeController@index');

//Profile Data Member
Route::get('profile/ktp/{mode?}','Anggota\ProfileController@Ktp');
Route::post('profile/ktp/{mode?}','Anggota\ProfileController@UpdateKtp');
Route::get('profile/ktp/data/kabupaten/{provinsi}','Anggota\ProfileController@getKabupaten');
Route::get('profile/ktp/data/kecamatan/{kabupaten}','Anggota\ProfileController@getKecamatan');
Route::get('profile/ktp/data/kelurahan/{kecamatan}','Anggota\ProfileController@getKelurahan');

//Profile Profesi
Route::get('profile/profesi','Anggota\ProfileController@Profesi');
//Route::post('profile/profesi','Anggota\ProfileController@SaveProfesi');
Route::get('profile/profesi/add','Anggota\ProfileController@AddProfesi');
Route::post('profile/profesi/add','Anggota\ProfileController@SaveProfesi');
Route::get('profile/profesi/{profesi}/edit','Anggota\ProfileController@EditProfesi');
Route::post('profile/profesi/{profesi}/edit','Anggota\ProfileController@SaveProfesi');
Route::get('profile/profesi/{profesi}/delete','Anggota\ProfileController@DeleteProfesi');

//Profile Perusahaan
Route::get('profile/perusahaan','Anggota\ProfileController@Perusahaan');
Route::get('profile/perusahaan/add','Anggota\ProfileController@AddPerusahaan');
Route::post('profile/perusahaan/add','Anggota\ProfileController@SavePerusahaan');
Route::get('profile/perusahaan/{perusahaan}/edit','Anggota\ProfileController@EditPerusahaan');
Route::post('profile/perusahaan/{perusahaan}/edit','Anggota\ProfileController@SavePerusahaan');
Route::get('profile/perusahaan/{perusahaan}/delete','Anggota\ProfileController@DeletePerusahaan');

//Profile Pembangunan
Route::get('profile/pembangunan','Anggota\ProfileController@Pembangunan');
Route::get('profile/pembangunan/add','Anggota\ProfileController@AddPembangunan');
Route::post('profile/pembangunan/add','Anggota\ProfileController@SavePembangunan');
Route::get('profile/pembangunan/{pembangunan}/edit','Anggota\ProfileController@EditPembangunan');
Route::post('profile/pembangunan/{pembangunan}/edit','Anggota\ProfileController@SavePembangunan');
Route::get('profile/pembangunan/{pembangunan}/delete','Anggota\ProfileController@DeletePembangunan');

//Profile Ketenagakerjaan
Route::get('profile/ketenagakerjaan','Anggota\ProfileController@Ketenagakerjaan');
Route::get('profile/ketenagakerjaan/add','Anggota\ProfileController@AddKetenagakerjaan');
Route::post('profile/ketenagakerjaan/add','Anggota\ProfileController@SaveKetenagakerjaan');
Route::get('profile/ketenagakerjaan/{ketenagakerjaan}/edit','Anggota\ProfileController@EditKetenagakerjaan');
Route::post('profile/ketenagakerjaan/{ketenagakerjaan}/edit','Anggota\ProfileController@SaveKetenagakerjaan');
Route::get('profile/ketenagakerjaan/{ketenagakerjaan}/delete','Anggota\ProfileController@DeleteKetenagakerjaan');

//Profile Lingkungan
Route::get('profile/lingkungan','Anggota\ProfileController@Lingkungan');
Route::get('profile/lingkungan/add','Anggota\ProfileController@AddLingkungan');
Route::post('profile/lingkungan/add','Anggota\ProfileController@SaveLingkungan');
Route::get('profile/lingkungan/{lingkungan}/edit','Anggota\ProfileController@EditLingkungan');
Route::post('profile/lingkungan/{lingkungan}/edit','Anggota\ProfileController@SaveLingkungan');
Route::get('profile/lingkungan/{lingkungan}/delete','Anggota\ProfileController@DeleteLingkungan');

//Profile Reklame
Route::get('profile/reklame','Anggota\ProfileController@Reklame');
Route::get('profile/reklame/add','Anggota\ProfileController@AddReklame');
Route::post('profile/reklame/add','Anggota\ProfileController@SaveReklame');
Route::get('profile/reklame/{reklame}/edit','Anggota\ProfileController@EditReklame');
Route::post('profile/reklame/{reklame}/edit','Anggota\ProfileController@SaveReklame');
Route::get('profile/reklame/{reklame}/delete','Anggota\ProfileController@DeleteReklame');

//Profile Transportasi
Route::get('profile/transportasi','Anggota\ProfileController@Transportasi');
Route::get('profile/transportasi/add','Anggota\ProfileController@AddTransportasi');
Route::post('profile/transportasi/add','Anggota\ProfileController@SaveTransportasi');
Route::get('profile/transportasi/{transportasi}/edit','Anggota\ProfileController@EditTransportasi');
Route::post('profile/transportasi/{transportasi}/edit','Anggota\ProfileController@SaveTransportasi');
Route::get('profile/transportasi/{transportasi}/delete','Anggota\ProfileController@DeleteTransportasi');

//Permohonan Member
Route::get('permohonan','Anggota\PermohonanController@Home');
Route::get('permohonan/add','Anggota\PermohonanController@AddPermohonan');
Route::get('permohonan/add/{filter}','Anggota\PermohonanController@FilterPermohonan');
Route::get('permohonan/proses/{izin}/{token}','Anggota\PermohonanController@ProsesPermohonan');
Route::post('permohonan/proses/{izin}/{token}','Anggota\PermohonanController@SaveProsesPermohonan');
Route::get('permohonan/cancel-proses/{token}','Anggota\PermohonanController@CancelProsesPermohonan');
Route::get('permohonan/persyaratan/{izin}/{token}','Anggota\PermohonanController@ProsesUploadDokumen');
Route::post('permohonan/persyaratan/{izin}/{token}','Anggota\PermohonanController@SaveProsesUploadDokumen');
Route::get('permohonan/review/{token}','Anggota\PermohonanController@ReviewPermohonan');
Route::get('permohonan/review_selesai/{token}','Anggota\PermohonanController@ReviewSelesai');
Route::get('permohonan/selesai/{token}','Anggota\PermohonanController@ProsesSelesai');
Route::get('permohonan/download/{per}','Anggota\PermohonanController@Download');
Route::get('permohonan/cetak-ulang-bukti-pendaftaran','Anggota\PermohonanController@CetakUlangBuktiPendaftaran');
Route::get('permohonan/history','Anggota\PermohonanController@History');
Route::get('permohonan/pelengkapan/{per}','Anggota\PermohonanController@PelengkapanUploadDokumen');
Route::post('permohonan/pelengkapan/{per}','Anggota\PermohonanController@SavePelengkapanUploadDokumen');
Route::get('permohonan/perbaikan/{per}','Anggota\PermohonanController@PerbaikanUploadDokumen');
Route::post('permohonan/perbaikan/{per}','Anggota\PermohonanController@SavePerbaikanUploadDokumen');
Route::get('permohonan/pembayaran/{per}','Anggota\PermohonanController@Pembayaran');
Route::post('permohonan/pembayaran/{per}','Anggota\PermohonanController@SavePembayaran');
Route::get('permohonan/pembayaran/download-slip/{per}','Anggota\PermohonanController@PrintSPM');
Route::get('permohonan/detail/{per}','Anggota\PermohonanController@detailPermohonan');
Route::get('permohonan/download_sk/{per}','Anggota\PermohonanController@downloadSK');
Route::get('permohonan/download_skrd/{per}','Anggota\PermohonanController@downloadSKRD');
Route::get('permohonan/download_sk_pencabutan/{pen}','Anggota\PermohonanController@downloadSKPencabutan');
Route::get('permohonan/batal/{per}','Anggota\PermohonanController@batalPermohonan');
Route::post('permohonan/batal/{per}','Anggota\PermohonanController@submitBatal');
//Route::get('admin/proses/pengambilan/sk/{per}','Admin\Proses\PengambilanController@downloadSK');

Route::get('permohonan/download/file-persyaratan/{base64}','Anggota\DownloadController@DownloadFilePersyaratan');
Route::get('permohonan/download/file-formulir/{base64}','Anggota\DownloadController@DownloadFileFormulir');

Route::get('pencabutan','Anggota\PencabutanController@Home');
Route::get('pencabutan/add','Anggota\PencabutanController@AddPencabutan');
Route::get('pencabutan/proses/{per}','Anggota\PencabutanController@ProsesPencabutan');
Route::post('pencabutan/proses/{per}','Anggota\PencabutanController@SaveProsesPencabutan');
Route::get('pencabutan/detail/{pencabutan}','Anggota\PencabutanController@DetailPencabutan');


/* Admin */
Route::group([ 'prefix' => 'admin'], function(){

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm');
    Route::post('/login', 'Auth\Admin\LoginController@login');
    Route::get('/logout', 'Auth\Admin\LoginController@logout');

    Route::get('config/identitas/{act}','IdentitasController@DefaultIdentitas');
    Route::post('config/identitas','IdentitasController@UpdateIdentitas');
    Route::post('config/ttdperizinan','IdentitasController@UpdateTtdperizinan');
    Route::post('config/stdnjop','IdentitasController@UpdateStdnjop');

    Route::get('config/permissions','PermissionController@HomePermission');
    Route::get('config/permissions/search/{keyword?}','PermissionController@SearchPermission');
    Route::get('config/permissions/add','PermissionController@AddPermission');
    Route::post('config/permissions/add','PermissionController@SavePermission');
    Route::get('config/permissions/{permissions}/edit','PermissionController@EditPermission');
    Route::post('config/permissions/{permissions}/edit','PermissionController@UpdatePermission');
    Route::get('config/permissions/{permissions}/delete','PermissionController@DeletePermission');

    Route::get('config/roles/','RoleController@home');
    Route::get('config/roles/search/{keyword}','RoleController@CariRole');
    Route::get('config/roles/add','RoleController@createRole');
    Route::post('config/roles/addnew','RoleController@storeRole');
    Route::get('config/roles/{role}/edit','RoleController@editRole');
    Route::post('config/roles/{role}/edit','RoleController@updateRole');
    Route::get('config/roles/{role}/delete','RoleController@destroyRole');

    Route::get('config/users','UserController@HomeUser');
    Route::get('config/users/search/{keyword}','UserController@SearchUser');
    Route::get('config/users/add','UserController@AddUser');
    Route::post('config/users/add','UserController@SaveUser');
    Route::get('config/users/{user}/edit','UserController@EditUser');
    Route::post('config/users/{user}/edit','UserController@UpdateUser');
    Route::get('config/users/{user}/delete','UserController@DeleteUsers');
    Route::get('config/users/{user}/show','UserController@ProfileUser');
    Route::post('config/users/profile','UserController@EditProfileUser');
    Route::get('config/users/{kategori}/TimTeknis','UserController@TimTeknis');


    Route::get('config/menu','MenuController@HomeMenu');
    Route::get('config/menu/search/{keyword}','MenuController@SearchMenu');
    Route::get('config/menu/add','MenuController@AddMenu');
    Route::get('ajax/onload','AjaxController@send_status');
    Route::post('config/menu/add','MenuController@SaveMenu');
    Route::get('config/menu/{menu}/edit','MenuController@EditMenu');
    Route::post('config/menu/{menu}/edit','MenuController@UpdateMenu');
    Route::get('config/menu/{menu}/delete','MenuController@DeleteMenu');
    Route::get('config/menu/sort','MenuController@sort');
    Route::post('config/menu/sort','MenuController@updateSort');

    Route::get('config/log','LogController@HomeDefault');
    Route::get('config/log/{log}/detail','LogController@DetailLog');
    Route::get('config/log/{log}/delete','LogController@DeleteLog');
    Route::any('config/log/pencarian','LogController@PencarianLog');
    Route::get('config/log/truncate','LogController@TruncateLog');

    Route::get('form-register','FormRegisterController@lists')->name('admin.form.register');
    Route::get('form-register/add','FormRegisterController@add')->name('admin.form.register.add');
    Route::post('form-register/add','FormRegisterController@insert')->name('admin.form.register.insert');
    Route::get('form-register/{data}/edit','FormRegisterController@edit')->name('admin.form.register.edit');
    Route::post('form-register/{data}/edit','FormRegisterController@update')->name('admin.form.register.update');
    Route::get('form-register/{data}/delete','FormRegisterController@delete')->name('admin.form.register.delete');
    Route::get('form-register/{data}/download','FormRegisterController@download')->name('admin.download.template.register');

    Route::get('form-register/{data}/up','FormRegisterController@up')->name('admin.form.register.up');
    Route::get('form-register/{data}/down','FormRegisterController@down')->name('admin.form.register.down');
    Route::get('form-register/{data}/show','FormRegisterController@show')->name('admin.form.register.show');
    Route::get('form-register/{url}/preview','FormRegisterController@preview')->name('admin.form.register.preview');

    Route::post('form-register/{formRegister}/add-step','FormStepController@addStep')->name('admin.form.register.add.step');
    Route::post('form-register/{formRegister}/edit-step','FormStepController@editStep')->name('admin.form.register.edit.step');
    Route::post('form-register/{formRegister}/lists-step','FormStepController@listsStep')->name('admin.form.register.lists.step');
    Route::post('form-register/{formRegister}/variables','FormRegisterController@variables')->name('admin.form.register.variables');

    Route::post('form-step/{formStep}/detail','FormStepController@detail')->name('admin.form.step.detail');
    Route::post('form-step/{formStep}/delete','FormStepController@delete')->name('admin.form.step.delete');
    Route::post('form-step/{formStep}/update-meta','FormStepController@updateMeta')->name('admin.form.step.update.meta');
    Route::post('form-step/{formStep}/order','FormStepController@orderStep')->name('admin.form.step.order');

    Route::get('registrasi','RegisterController@index')->name('admin.register');
    Route::get('registrasi/{register}/detail','RegisterController@detail')->name('admin.register.detail');
    Route::post('registrasi/{form_register}/lists','RegisterController@lists')->name('admin.register.lists');
    Route::get('registrasi/{register}/{register_file}/file','RegisterController@file')->name('admin.register.file');
    Route::post('registrasi/{register}/print','RegisterController@print')->name('admin.register.print');


});



Route::get('admin/tutorial/','HomeController@tutorial');
Route::get('admin/tutorial/search/{keyword}','HomeController@cariTutorial');
Route::get('admin/tutorial/{tutorial}/view','HomeController@detailTutorial');


Route::get('admin/pendaftar/','PendaftarController@index');
Route::get('admin/pendaftar/search/{keyword}','PendaftarController@cari');
Route::get('admin/pendaftar/edit/{pendaftar}','PendaftarController@edit');
Route::post('admin/pendaftar/edit/{pendaftar}','PendaftarController@update');
Route::get('admin/pendaftar/{pendaftar}/delete','PendaftarController@delete');

Route::get('referensi/persyaratan','Referensi\PersyaratanController@HomePersyaratan');
Route::get('referensi/persyaratan/search/{keyword?}','Referensi\PersyaratanController@Pencarian');
Route::get('referensi/persyaratan/add','Referensi\PersyaratanController@AddSyarat');
Route::post('referensi/persyaratan/add','Referensi\PersyaratanController@SaveSyarat');
Route::get('referensi/persyaratan/{syarat}/edit','Referensi\PersyaratanController@EditSyarat');
Route::post('referensi/persyaratan/{syarat}/edit','Referensi\PersyaratanController@UpdateSyarat');
Route::get('referensi/persyaratan/{syarat}/delete','Referensi\PersyaratanController@DeleteSyarat');


Route::get('referensi/kategori-dinas','Admin\Referensi\KategoriDinasController@Home');
Route::get('referensi/kategori-dinas/search/{keyword?}','Admin\Referensi\KategoriDinasController@Pencarian');
Route::get('referensi/kategori-dinas/add','Admin\Referensi\KategoriDinasController@AddKategoriDinas');
Route::post('referensi/kategori-dinas/add','Admin\Referensi\KategoriDinasController@SaveKategoriDinas');
Route::get('referensi/kategori-dinas/{kat}/edit','Admin\Referensi\KategoriDinasController@EditKategoriDinas');
Route::post('referensi/kategori-dinas/{kat}/edit','Admin\Referensi\KategoriDinasController@UpdateKategoriDinas');
Route::get('referensi/kategori-dinas/{kat}/delete','Admin\Referensi\KategoriDinasController@DeleteKategoriDinas');
Route::get('ajax/seksi-izin/{bid}/{auto?}','AjaxController@AjaxSeksiIzin');


Route::get('referensi/jenis-izin/{kat}','Admin\Referensi\JenisIzinController@Home');
Route::get('referensi/jenis-izin/search/{keyword?}','Admin\Referensi\JenisIzinController@Pencarian');
Route::get('referensi/jenis-izin/{kat}/add','Admin\Referensi\JenisIzinController@AddJenisIzin');
Route::post('referensi/jenis-izin/{kat}/add','Admin\Referensi\JenisIzinController@SaveJenisIzin');
Route::get('referensi/jenis-izin/{kat}/{jen}/edit','Admin\Referensi\JenisIzinController@EditJenisIzin');
Route::post('referensi/jenis-izin/{kat}/{jen}/edit','Admin\Referensi\JenisIzinController@UpdateJenisIzin');
Route::get('referensi/jenis-izin/{kat}/{jen}/delete','Admin\Referensi\JenisIzinController@DeleteJenisIzin');
Route::get('referensi/sub-jenis-izin/{kat}/{jen}/add','Admin\Referensi\JenisIzinController@AddSubJenisIzin');
Route::post('referensi/sub-jenis-izin/{kat}/{jen}/add','Admin\Referensi\JenisIzinController@SaveSubJenisIzin');
Route::get('referensi/sub-jenis-izin/{kat}/{jen}/edit','Admin\Referensi\JenisIzinController@EditSubJenisIzin');
Route::post('referensi/sub-jenis-izin/{kat}/{jen}/edit','Admin\Referensi\JenisIzinController@UpdateSubJenisIzin');
Route::get('referensi/sub-jenis-izin/{kat}/{jen}/delete','Admin\Referensi\JenisIzinController@DeleteSubJenisIzin');


Route::get('referensi/jenis-permohonan-izin/{kat}/{jen}','Admin\Referensi\JenisPermohonanIzinController@Home');
Route::get('referensi/jenis-permohonan-izin/search/{keyword?}','Admin\Referensi\JenisPermohonanIzinController@Pencarian');
Route::get('referensi/jenis-permohonan-izin/{kat}/{jen}/add','Admin\Referensi\JenisPermohonanIzinController@AddJenisPermohonanIzin');
Route::post('referensi/jenis-permohonan-izin/{kat}/{jen}/add','Admin\Referensi\JenisPermohonanIzinController@SaveJenisPermohonanIzin');
Route::get('referensi/jenis-permohonan-izin/{kat}/{jen}/{jenP}/edit','Admin\Referensi\JenisPermohonanIzinController@EditJenisPermohonanIzin');
Route::post('referensi/jenis-permohonan-izin/{kat}/{jen}/{jenP}/edit','Admin\Referensi\JenisPermohonanIzinController@UpdateJenisPermohonanIzin');
Route::get('referensi/jenis-permohonan-izin/{kat}/{jen}/{jenP}/delete','Admin\Referensi\JenisPermohonanIzinController@DeleteJenisPermohonanIzin');
Route::get('referensi/jenis-permohonan-izin/getAjax','Admin\Referensi\JenisPermohonanIzinController@getAjax');


Route::get('referensi/fungsi-bangunan/','Referensi\FungsiBangunanController@FungsiBangunan');
Route::get('referensi/fungsi-bangunan/search/{keyword?}','Referensi\FungsiBangunanController@CariFungsiBangunan');
Route::get('referensi/fungsi-bangunan/add','Referensi\FungsiBangunanController@AddFungsiBangunan');
Route::post('referensi/fungsi-bangunan/add','Referensi\FungsiBangunanController@SaveFungsiBangunan');
Route::get('referensi/fungsi-bangunan/{fn}/edit','Referensi\FungsiBangunanController@EditFungsiBangunan');
Route::post('referensi/fungsi-bangunan/{fn}/edit','Referensi\FungsiBangunanController@UpdateFungsiBangunan');
Route::get('referensi/fungsi-bangunan/{fn}/delete','Referensi\FungsiBangunanController@DeleteFungsiBangunan');

Route::get('referensi/fungsi-bangunan/kegunaan/{fn}','Referensi\FungsiBangunanController@Kegunaan');
Route::get('referensi/fungsi-bangunan/kegunaan-add/{fn}','Referensi\FungsiBangunanController@AddKegunaan');
Route::post('referensi/fungsi-bangunan/kegunaan-add/{fn}','Referensi\FungsiBangunanController@SaveKegunaan');
Route::get('referensi/fungsi-bangunan/kegunaan-edit/{fn}/{gn}','Referensi\FungsiBangunanController@EditKegunaan');
Route::post('referensi/fungsi-bangunan/kegunaan-edit/{fn}/{gn}','Referensi\FungsiBangunanController@UpdateKegunaan');
Route::get('referensi/fungsi-bangunan/kegunaan-delete/{fn}/{gn}','Referensi\FungsiBangunanController@DeleteKegunaan');

Route::get('referensi/bahan-konstruksi/','Referensi\BahanKonstruksiController@Konstruksi');
Route::get('referensi/bahan-konstruksi/search/{keyword?}','Referensi\BahanKonstruksiController@CariKonstruksi');
Route::get('referensi/bahan-konstruksi/add','Referensi\BahanKonstruksiController@AddKonstruksi');
Route::post('referensi/bahan-konstruksi/add','Referensi\BahanKonstruksiController@SaveKonstruksi');
Route::get('referensi/bahan-konstruksi/{fn}/edit','Referensi\BahanKonstruksiController@EditKonstruksi');
Route::post('referensi/bahan-konstruksi/{fn}/edit','Referensi\BahanKonstruksiController@UpdateKonstruksi');
Route::get('referensi/bahan-konstruksi/{fn}/delete','Referensi\BahanKonstruksiController@DeleteKonstruksi');

Route::get('referensi/bahan-konstruksi/bahan/{fn}','Referensi\BahanKonstruksiController@BahanKonstruksi');
Route::get('referensi/bahan-konstruksi/bahan-add/{fn}','Referensi\BahanKonstruksiController@AddBahan');
Route::post('referensi/bahan-konstruksi/bahan-add/{fn}','Referensi\BahanKonstruksiController@SaveBahan');
Route::get('referensi/bahan-konstruksi/bahan-edit/{fn}/{gn}','Referensi\BahanKonstruksiController@EditBahan');
Route::post('referensi/bahan-konstruksi/bahan-edit/{fn}/{gn}','Referensi\BahanKonstruksiController@UpdateBahan');
Route::get('referensi/bahan-konstruksi/bahan-delete/{fn}/{gn}','Referensi\BahanKonstruksiController@DeleteBahan');

//Provinsi
Route::get('referensi/provinsi','Referensi\DaerahAdministrasiController@HomeProvinsi');
Route::get('referensi/provinsi/search/{keyword?}','Referensi\DaerahAdministrasiController@PencarianProvinsi');
Route::get('referensi/provinsi/add','Referensi\DaerahAdministrasiController@AddProvinsi');
Route::post('referensi/provinsi/add','Referensi\DaerahAdministrasiController@SaveProvinsi');
Route::get('referensi/provinsi/{prov}/edit','Referensi\DaerahAdministrasiController@EditProvinsi');
Route::post('referensi/provinsi/{prov}/edit','Referensi\DaerahAdministrasiController@UpdateProvinsi');
Route::get('referensi/provinsi/{prov}/delete','Referensi\DaerahAdministrasiController@DeleteProvinsi');

//Kabupaten
Route::get('referensi/kabupaten/{prov}','Referensi\DaerahAdministrasiController@HomeKabupaten');
Route::get('referensi/kabupaten/{prov}/search/{keyword?}','Referensi\DaerahAdministrasiController@PencarianKabupaten');
Route::get('referensi/kabupaten/{prov}/add','Referensi\DaerahAdministrasiController@AddKabupaten');
Route::post('referensi/kabupaten/{prov}/add','Referensi\DaerahAdministrasiController@SaveKabupaten');
Route::get('referensi/kabupaten/{prov}/{kab}/edit','Referensi\DaerahAdministrasiController@EditKabupaten');
Route::post('referensi/kabupaten/{prov}/{kab}/edit','Referensi\DaerahAdministrasiController@UpdateKabupaten');
Route::get('referensi/kabupaten/{prov}/{kab}/delete','Referensi\DaerahAdministrasiController@DeleteKabupaten');

//Kecamatan
Route::get('referensi/kecamatan/{prov}/{kab}','Referensi\DaerahAdministrasiController@HomeKecamatan');
Route::get('referensi/kecamatan/{prov}/{kab}/search/{keyword?}','Referensi\DaerahAdministrasiController@PencarianKecamatan');
Route::get('referensi/kecamatan/{prov}/{kab}/add','Referensi\DaerahAdministrasiController@AddKecamatan');
Route::post('referensi/kecamatan/{prov}/{kab}/add','Referensi\DaerahAdministrasiController@SaveKecamatan');
Route::get('referensi/kecamatan/{prov}/{kab}/{kec}/edit','Referensi\DaerahAdministrasiController@EditKecamatan');
Route::post('referensi/kecamatan/{prov}/{kab}/{kec}/edit','Referensi\DaerahAdministrasiController@UpdateKecamatan');
Route::get('referensi/kecamatan/{prov}/{kab}/{kec}/delete','Referensi\DaerahAdministrasiController@DeleteKecamatan');

//Kelurahan
Route::get('referensi/kelurahan/{prov}/{kab}/{kec}','Referensi\DaerahAdministrasiController@HomeKelurahan');
Route::get('referensi/kelurahan/{prov}/{kab}/{kec}/search/{keyword?}','Referensi\DaerahAdministrasiController@PencarianKelurahan');
Route::get('referensi/kelurahan/{prov}/{kab}/{kec}/add','Referensi\DaerahAdministrasiController@AddKelurahan');
Route::post('referensi/kelurahan/{prov}/{kab}/{kec}/add','Referensi\DaerahAdministrasiController@SaveKelurahan');
Route::get('referensi/kelurahan/{prov}/{kab}/{kec}/{kel}/edit','Referensi\DaerahAdministrasiController@EditKelurahan');
Route::post('referensi/kelurahan/{prov}/{kab}/{kec}/{kel}/edit','Referensi\DaerahAdministrasiController@UpdateKelurahan');
Route::get('referensi/kelurahan/{prov}/{kab}/{kec}/{kel}/delete','Referensi\DaerahAdministrasiController@DeleteKelurahan');

//Wilayah

Route::get('wilayah/provinsi/{prov}/getAjax','Referensi\WilayahController@getAjaxProvinsi');
Route::get('wilayah/kabupaten/{kab}/getAjax','Referensi\WilayahController@getAjaxKabupaten');
Route::get('wilayah/kecamatan/{kec}/getAjax','Referensi\WilayahController@getAjaxKecamatan');
Route::get('wilayah/kelurahan/{kel}/getAjax','Referensi\WilayahController@getAjaxKelurahan');

Route::get('wilayah/kab_by_prov/{prov}/getAjax','Referensi\WilayahController@getByProvinsi');
Route::get('wilayah/kec_by_kab/{kab}/getAjax','Referensi\WilayahController@getByKabupaten');
Route::get('wilayah/kel_by_kec/{kec}/getAjax','Referensi\WilayahController@getByKecamatan');

/*jenis reklame*/
Route::get('referensi/jenis-reklame','Referensi\JenisReklameController@Home');
Route::get('referensi/jenis-reklame/add','Referensi\JenisReklameController@Add');
Route::post('referensi/jenis-reklame/add','Referensi\JenisReklameController@Save');
Route::get('referensi/jenis-reklame/search/{keyword?}','Referensi\JenisReklameController@Search');
Route::get('referensi/jenis-reklame/{data}/edit','Referensi\JenisReklameController@Edit');
Route::post('referensi/jenis-reklame/{data}/edit','Referensi\JenisReklameController@Update');
Route::get('referensi/jenis-reklame/{data}/delete','Referensi\JenisReklameController@Delete');

/*status penggunaan*/
Route::get('referensi/status-penggunaan','Referensi\StatusPenggunaanController@Home');
Route::get('referensi/status-penggunaan/add','Referensi\StatusPenggunaanController@Add');
Route::post('referensi/status-penggunaan/add','Referensi\StatusPenggunaanController@Save');
Route::get('referensi/status-penggunaan/search/{keyword?}','Referensi\StatusPenggunaanController@Search');
Route::get('referensi/status-penggunaan/{data}/edit','Referensi\StatusPenggunaanController@Edit');
Route::post('referensi/status-penggunaan/{data}/edit','Referensi\StatusPenggunaanController@Update');
Route::get('referensi/status-penggunaan/{data}/delete','Referensi\StatusPenggunaanController@Delete');

/*kondisi tanah*/
Route::get('referensi/kondisi-tanah','Referensi\KondisiTanahController@Home');
Route::get('referensi/kondisi-tanah/add','Referensi\KondisiTanahController@Add');
Route::post('referensi/kondisi-tanah/add','Referensi\KondisiTanahController@Save');
Route::get('referensi/kondisi-tanah/search/{keyword?}','Referensi\KondisiTanahController@Search');
Route::get('referensi/kondisi-tanah/{data}/edit','Referensi\KondisiTanahController@Edit');
Route::post('referensi/kondisi-tanah/{data}/edit','Referensi\KondisiTanahController@Update');
Route::get('referensi/kondisi-tanah/{data}/delete','Referensi\KondisiTanahController@Delete');

/* Klasifikasi Usaha */
Route::get('referensi/klasifikasi-usaha','Referensi\KbliController@Home');
Route::any('referensi/klasifikasi-usaha/data','Referensi\KbliController@DataKBLI');
Route::any('referensi/klasifikasi-usaha/sub-data','Referensi\KbliController@SubDataKBLI');
Route::get('referensi/klasifikasi-usaha/edit/{kbli}','Referensi\KbliController@EditKBLI');
Route::get('referensi/klasifikasi-usaha/delete/{kbli}','Referensi\KbliController@DeleteKBLI');
Route::post('referensi/klasifikasi-usaha/edit/{kbli}','Referensi\KbliController@SaveEditKBLI');
Route::get('referensi/klasifikasi-usaha/add','Referensi\KbliController@AddKBLI');
Route::post('referensi/klasifikasi-usaha-ajax/gol-pokok','Referensi\KbliController@AjaxGolPokokKBLI');
Route::post('referensi/klasifikasi-usaha-ajax/sub-golongan','Referensi\KbliController@AjaxSubGolonganKBLI');
Route::post('referensi/klasifikasi-usaha-ajax/sub-golongan-sub','Referensi\KbliController@AjaxSubGolonganSubKBLI');
Route::post('referensi/klasifikasi-usaha/add','Referensi\KbliController@SaveAddKBLI');

/* retribusi parent null */
Route::get('referensi/retribusi','Referensi\RetribusiController@Home');
Route::get('referensi/retribusi/{kategori}/edit','Referensi\RetribusiController@Edit');
Route::post('referensi/retribusi/{kategori}/edit','Referensi\RetribusiController@Update');
Route::get('referensi/retribusi/search/{keyword?}','Referensi\RetribusiController@Search');


Route::get('admin/pengumuman','Referensi\PengumumanController@Home');
Route::get('admin/pengumuman/add','Referensi\PengumumanController@AddNew');
Route::post('admin/pengumuman/add','Referensi\PengumumanController@SaveNew');
Route::get('admin/pengumuman/{id}/edit','Referensi\PengumumanController@Edit');
Route::post('admin/pengumuman/{id}/edit','Referensi\PengumumanController@SaveEdit');
Route::get('admin/pengumuman/{id}/delete','Referensi\PengumumanController@Delete');

/* retribusi child parent */
Route::get('referensi/retribusi-item/{kategori}','Referensi\RetribusiController@HomeItem');
Route::get('referensi/retribusi-item/{kategori}/edit','Referensi\RetribusiController@EditItem');
Route::post('referensi/retribusi-item/{kategori}/edit','Referensi\RetribusiController@UpdateItem');
Route::get('referensi/retribusi-item/search/{kategori}/{keyword?}','Referensi\RetribusiController@SearchItem');

Route::get('testing','Testing\WorkflowCont@Home');
Route::post('testing/pendaftaran','Testing\WorkflowCont@SubmitForm');
Route::get('testing/persyaratan/{token}/{jenis_izin}','Testing\WorkflowCont@Persyaratan');
Route::post('testing/persyaratan/{token}/{jenis_izin}','Testing\WorkflowCont@SubmitFormPersyaratan');

Route::get('perizinan/pendaftaran','Proses\ProsesController@Pendaftaran');
Route::get('perizinan/pendaftaran/online','Proses\ProsesController@PendaftaranOnline');
Route::get('perizinan/pendaftaran/list','Proses\ProsesController@PendaftaranList');
Route::get('perizinan/pendaftaran/proses/{izin}/{token}','Proses\ProsesController@ProsesPendaftaran');
Route::get('perizinan/pendaftaran/{izin}/syarat','Proses\ProsesController@SyaratPendaftaran');
Route::post('perizinan/pendaftaran/{izin}/{token}','Proses\ProsesController@SavePendaftaran');
Route::get('perizinan/pendaftaran/persyaratan/{izin}/{token}','Proses\ProsesController@MelengkapiPersyaratan');
Route::post('perizinan/pendaftaran/persyaratan/{izin}/{token}','Proses\ProsesController@SubmitPersyaratan');
Route::get('perizinan/perndaftaran/view/{per}','Proses\ProsesController@ViewPendaftaran');
Route::get('perizinan/pendaftaran/search/{keyword}','Proses\ProsesController@PencarianPendaftaran');
Route::post('perizinan/online/pencarian','Proses\ProsesController@PencarianPendaftaranOnline');
Route::get('perizinan/pendaftaran/print/{per}','Proses\ProsesController@CetakBuktiDaftar');
Route::get('perizinan/pendaftaran/filter','Proses\ProsesController@FilterPendaftaran');
Route::post('perizinan/pendaftaran/filter','Proses\ProsesController@DoFilterPendaftaran');
Route::get('perizinan/download/persyaratan/{base64}','Proses\ProsesController@DownloadPersyaratan');
Route::get('ajax/kelurahan/{kec}/{auto?}','AjaxController@AjaxKelurahan');
Route::get('ajax/padukuhan/{kel}/{auto?}','AjaxController@AjaxPadukuhan');
Route::get('ajax/geojson/{mode}/{id}','AjaxController@creategeoJsonAjax');
Route::get('perizinan/pendaftaran/batal/{per}','Proses\ProsesController@BatalkanPendaftaran');
Route::get('perizinan/pendaftaran/cancel-proses/{token}','Proses\ProsesController@CancelProsesPendaftaran');

Route::get('perizinan/pendaftaran/edit/{per}','Proses\ProsesController@ProsesPerubahanDataPendaftaran');
Route::post('perizinan/pendaftaran/edit/{izin}/{token}/{per}','Proses\ProsesController@SaveProsesPerubahanDataPendaftaran');
Route::get('perizinan/pendaftaran/hapus/{per}','Proses\ProsesController@HapusPermohonan');
Route::post('perizinan/pendaftaran/submit-teknis','Proses\ProsesController@SubmitPendaftaranKeBidangTeknis');

Route::get('perizinan/pendaftaran/surat-pengantar','Proses\ProsesController@CetakSuratPengantar');
Route::get('verifikasi/list','Proses\Verifikasi@ListPermohonan');
Route::get('verifikasi/view/{per}','Proses\Verifikasi@ViewVerifikasi');
Route::post('verifikasi/proses/{per}','Proses\Verifikasi@ProsesVerifikasi');

Route::post('ajax/periksa-nik','AjaxController@PeriksaNIK');
Route::post('ajax/cek-sertifikat','AjaxController@CekSertifikat');

Route::get('/sertifikat/add/{nik}','Proses\Sertifikat@AddNew');
Route::post('/sertifikat/add/{nik}','Proses\Sertifikat@AddNewSession');
Route::get('/sertifikat/sessi/{index}/{nik}','Proses\Sertifikat@DeleteSession');

Route::get('konsultasi','Konsultasi\KonsultasiController@index');
Route::get('konsultasi/kategori/{jenis}','Konsultasi\KonsultasiController@kategori');
Route::get('konsultasi/izin/{jenis}','Konsultasi\KonsultasiController@izin');
Route::get('konsultasi/kelurahan/{kec}','Konsultasi\KonsultasiController@AjaxKelurahan');
Route::get('konsultasi/padukuhan/{kel}','Konsultasi\KonsultasiController@AjaxPadukuhan');
Route::post('konsultasi/map','Konsultasi\KonsultasiController@ShowMap');
Route::post('konsultasi/add','Konsultasi\KonsultasiController@Add');
Route::get('konsultasi/search/{keyword?}','Konsultasi\KonsultasiController@Search');
Route::get('konsultasi/delete/{data}','Konsultasi\KonsultasiController@Delete');
Route::get('konsultasi/view/{data}','Konsultasi\KonsultasiController@View');
Route::get('konsultasi/print/{data}','Konsultasi\KonsultasiController@Cetak');
Route::get('konsultasi/edit/{data}','Konsultasi\KonsultasiController@Edit');
Route::post('konsultasi/edit/{data}','Konsultasi\KonsultasiController@Update');

/** Testing */
Route::get('testing','Testing@DefaultTesting');
/** End Testing */

Route::get('verifikasi/view-peta/{koordinat}','Proses\Verifikasi@ViewPeta');
Route::get('verifikasi/filter','Proses\Verifikasi@FilterData');
Route::post('verifikasi/filter','Proses\Verifikasi@DoFilterData');
Route::get('verifikasi/persyaratan/{syarat}/download','Proses\Verifikasi@DownloadfilePersyaratan');
Route::get('verifikasi/surat-kekurangan/{per}','Proses\Verifikasi@DownloadSuratKekurangan');
Route::get('verifikasi/surat-penolakan/{per}','Proses\Verifikasi@DownloadSuratPenolakan');

/** Proses Tinjau Lapangan */
Route::get('perizinan/tinjau','Proses\Tinjau@Home');
Route::get('perizinan/tinjau/{per}/view','Proses\Tinjau@ViewPermohonan');
Route::post('perizinan/tinjau/{per}/view','Proses\Tinjau@UpdateHasilTinjau');
Route::get('perizinan/tinjau/{per}/hasil-rapat','Proses\Tinjau@ViewPermohonanRapat');
Route::post('perizinan/tinjau/{per}/hasil-rapat','Proses\Tinjau@UpdatePermohonanHasilRapat');
Route::get('perizinan/tinjau/filter','Proses\Tinjau@FilterData');
Route::post('perizinan/tinjau/filter','Proses\Tinjau@DoFilterData');
Route::get('perizinan/tinjau/{per}/download-formulir-tinjau/{ispdf?}','Proses\Tinjau@DownloadFormulirTinjau');
Route::get('perizinan/tinjau/{per}/print-hasil-tinjau/{ispdf?}','Proses\Tinjau@PrintHasilTinjau');
Route::get('perizinan/tinjau/{per}/print-berita-acara/{ispdf?}','Proses\Tinjau@DownloadBeritaAcara');
Route::get('perizinan/tinjau/{per}/berita-acara/{ispdf?}','Proses\Tinjau@DownloadBeritaAcaraRapat');
Route::post('perizinan/tinjau/upload-berita-acara/{per}','Proses\Tinjau@UploadBeritaAcaraTinjau');
Route::post('perizinan/tinjau/upload-berita-acara-rapat/{per}','Proses\Tinjau@UploadBeritaAcaraRapatTinjau');

/** Ditolak */
Route::get('perizinan/ditolak','Proses\Ditolak@Home');
Route::get('perizinan/ditolak/{per}/view','Proses\Ditolak@ViewPermohonan');
Route::get('perizinan/ditolak/{per}/cetak-surat','Proses\Ditolak@CetakSuratPenolakan');
Route::get('perizinan/ditolak/filter','Proses\Ditolak@FilterData');
Route::post('perizinan/ditolak/filter','Proses\Ditolak@DoFilterData');

/** Draft */
Route::get('perizinan/draft','Proses\Draft@Home');
Route::get('perizinan/draft/{per}/view','Proses\Draft@ViewPermohonan');
Route::get('perizinan/draft/{per}/cetak-draft','Proses\Draft@CetakDraftKeputusan');
Route::get('perizinan/draft/filter','Proses\Draft@FilterData');
Route::post('perizinan/draft/filter','Proses\Draft@DoFilterData');
Route::get('perizinan/draft/{per}/proses-legalisasi','Proses\Draft@KirimKeProsesLegalisasi');
Route::get('perizinan/draft/edit/{per}','Proses\Draft@ProsesPerubahanDataPendaftaran');
Route::post('perizinan/draft/edit/{izin}/{token}/{per}','Proses\Draft@SaveProsesPerubahanDataPendaftaran');

/** Retribusi */
Route::get('perizinan/pembayaran','Proses\Retribusi@Home');
Route::get('perizinan/pembayaran/{per}/view','Proses\Retribusi@ViewPermohonan');
Route::get('perizinan/pembayaran/filter','Proses\Retribusi@FilterData');
Route::post('perizinan/pembayaran/filter','Proses\Retribusi@DoFilterData');
Route::get('perizinan/pembayaran/{per}/proses','Proses\Retribusi@HitungRetribusi');
Route::post('perizinan/pembayaran/{per}/proses','Proses\Retribusi@SaveHitungRetribusi');
Route::get('perizinan/pembayaran/{per}/cetak-retribusi/{ispdf?}','Proses\Retribusi@CetakRetribusi');
Route::get('perizinan/pembayaran/{per}/cetak-skrd/{ispdf?}','Proses\Retribusi@CetakSKRD');
Route::get('perizinan/pembayaran/{per}/cetak-denda','Proses\Retribusi@CetakDenda');
Route::get('perizinan/pembayaran/penetapan-skrd/{retribusi}','Proses\Retribusi@TetapkanTanggalSKRD');
Route::get('perizinan/pembayaran/{per}/sudah-bayar','Proses\Retribusi@SudahBayar');
Route::get('perizinan/pembayaran/{per}/ke-draft','Proses\Retribusi@LoncatProsesKeDraft');
/** Legalisasi */
Route::get('perizinan/legalisasi','Proses\Legalisasi@Home');
Route::get('perizinan/legalisasi/{per}/view','Proses\Legalisasi@ViewPermohonan');
Route::get('perizinan/legalisasi/filter','Proses\Legalisasi@FilterData');
Route::post('perizinan/legalisasi/filter','Proses\Legalisasi@DoFilterData');
Route::get('perizinan/legalisasi/{per}/selesai','Proses\Legalisasi@LegalisasiSelesai');

/** Pengambilan */
Route::get('perizinan/pengambilan','Proses\Pengambilan@Home');
Route::get('perizinan/pengambilan/filter','Proses\Pengambilan@FilterData');
Route::post('perizinan/pengambilan/filter','Proses\Pengambilan@DoFilterData');
Route::get('perizinan/pengambilan/{per}/diambil','Proses\Pengambilan@Diambil');
Route::post('perizinan/pengambilan-surat-izin/{per}','Proses\Pengambilan@PengambilanSuratIzin');

/** Timeline */
Route::get('perizinan/timeline/{per}/view','Proses\Timeline@ViewTimeline');
Route::get('perizinan/timeline/{per}/cetak','Proses\Timeline@Cetak');

/** Semua Permohonan */
Route::get('perizinan/semua-permohonan','Proses\Master_Permohonan@Home');
Route::get('perizinan/semua-permohonan/filter','Proses\Master_Permohonan@FilterData');
Route::post('perizinan/semua-permohonan/filter','Proses\Master_Permohonan@DoFilterData');

/** Public */
Route::get('publik/pendaftaran','Publik\Pendaftaran@Home');
Route::get('publik/pendaftaran/proses/{izin}/{token}','Publik\Pendaftaran@ProsesPendaftaran');
Route::post('publik/pendaftaran/proses/{izin}/{token}','Publik\Pendaftaran@SaveProsesPendaftaran');
Route::get('publik/pendaftaran/persyaratan/{izin}/{token}','Publik\Pendaftaran@ProsesUploadDokumen');
Route::post('publik/pendaftaran/persyaratan/{izin}/{token}','Publik\Pendaftaran@SaveProsesUploadDokumen');
Route::get('public/pendaftaran/selesai/{token}','Publik\Pendaftaran@ProsesSelesai');
Route::get('publik/pendaftaran/download/{per}','Publik\Pendaftaran@Download');
Route::get('publik/pendaftaran/cetak-ulang-bukti-pendaftaran','Publik\Pendaftaran@CetakUlangBuktiPendaftaran');

Route::get('publik/status','Publik\Status@Home');
Route::post('publik/status','Publik\Status@CekStatusPerizinan');

Route::get('publik/pengaduan','Publik\Pengaduan@Home');
Route::post('publik/pengaduan/form','Publik\Pengaduan@SimpanAduan');
Route::get('publik/pengaduan/list-aduan','Publik\Pengaduan@ListAduan');

Route::get('pengaduan','Aduan\Pengaduan@Home');
Route::get('pengaduan/{aduan}/view','Aduan\Pengaduan@ViewPengaduan');
Route::post('pengaduan/{aduan}/view','Aduan\Pengaduan@UpdatePengaduan');
Route::get('pengaduan/{aduan}/delete','Aduan\Pengaduan@DeletePengaduan');

Route::get('publik/statistik','Publik\Statistik@Home');

Route::get('peta-sebaran-perizinan','Peta\Sebaran@Home');
Route::get('peta-sebaran-koordinat','Peta\Sebaran@GetMarker');

Route::get('publik/simulasi','Publik\Simulasi@Home');
Route::get('publik/simulasi/gedung','Publik\Simulasi@Gedung');
Route::post('publik/simulasi/gedung','Publik\Simulasi@HitungGedung');
Route::get('publik/simulasi/non-gedung','Publik\Simulasi@NonGedung');
Route::post('publik/simulasi/non-gedung','Publik\Simulasi@HitungNonGedung');
Route::get('download-formulir/{izin}','Publik\Pendaftaran@DownloadFormulir');

Route::get('publik/bantuan', 'Publik\TutorialController@index')->name('tutorial');
Route::get('publik/syarat', 'Publik\TutorialController@syarat')->name('bantuan.syarat');
Route::get('publik/bantuan/syarat/{filter}', 'Publik\TutorialController@syarat')->name('bantuan.syarat');
Route::get('publik/bantuan/{tutorial}/detail', 'Publik\TutorialController@detail')->name('bantuan.tutorial');

Route::get('publik/cek_pendaftaran/{keyword}', 'Publik\Pendaftaran@cek')->name('cek.pendaftaran');
Route::get('publik/cek_pendaftaran/hallo/{keyword}', 'Publik\Pendaftaran@cek_hallo')->name('cek.pendaftaran');


/* Admin */
Route::get('admin/download/file-persyaratan/{syarat}','Admin\Proses\DownloadController@DownloadFilePersyaratan');

Route::get('admin/proses/semua-permohonan','Admin\Proses\SemuaPermohonanController@Home');
Route::get('admin/proses/semua-permohonan/filter','Admin\Proses\SemuaPermohonanController@Filter');
Route::post('admin/proses/semua-permohonan/filter','Admin\Proses\SemuaPermohonanController@DoFilter');
Route::get('admin/proses/semua-permohonan/search/{keyword}','Admin\Proses\SemuaPermohonanController@Search');
Route::get('admin/proses/semua-permohonan/view/{per}','Admin\Proses\SemuaPermohonanController@View');
Route::get('admin/proses/semua-permohonan/timeline/{per}','Admin\Proses\SemuaPermohonanController@Timeline');

Route::get('admin/proses/permohonan','Admin\Proses\PermohonanController@Home');
Route::get('admin/proses/permohonan/filter','Admin\Proses\PermohonanController@Filter');
Route::post('admin/proses/permohonan/filter','Admin\Proses\PermohonanController@DoFilter');
Route::get('admin/proses/permohonan/search/{keyword}','Admin\Proses\PermohonanController@Search');
Route::get('admin/proses/permohonan/view/{per}','Admin\Proses\PermohonanController@View');
Route::get('admin/proses/permohonan/timeline/{per}','Admin\Proses\PermohonanController@Timeline');
Route::get('admin/proses/permohonan/edit/{per}','Admin\Proses\PermohonanController@edit');
Route::post('admin/proses/permohonan/edit/{per}','Admin\Proses\PermohonanController@update');
Route::get('admin/proses/permohonan/posisi/{per}','Admin\Proses\PermohonanController@posisi');
Route::post('admin/proses/permohonan/posisi/{per}','Admin\Proses\PermohonanController@updatePosisi');
Route::get('admin/proses/permohonan/detail/{per}','Admin\Proses\PermohonanController@detail');

Route::get('admin/proses/pendaftaran','Admin\Proses\PendaftaranController@Home');
Route::get('admin/proses/pendaftaran/filter','Admin\Proses\PendaftaranController@Filter');
Route::post('admin/proses/pendaftaran/filter','Admin\Proses\PendaftaranController@DoFilter');
Route::get('admin/proses/pendaftaran/search/{keyword}','Admin\Proses\PendaftaranController@Search');
Route::get('admin/proses/pendaftaran/list/{kat}','Admin\Proses\PendaftaranController@Lists');
Route::get('admin/proses/pendaftaran/view/{per}','Admin\Proses\PendaftaranController@View');
Route::get('admin/proses/pendaftaran/edit/{per}','Admin\Proses\PendaftaranController@Edit');
Route::post('admin/proses/pendaftaran/edit/{per}','Admin\Proses\PendaftaranController@DoSubmit');
Route::get('admin/proses/pendaftaran/tolak/{per}','Admin\Proses\PendaftaranController@tolak');

Route::get('admin/proses/kasi/approval-berkas','Admin\Proses\KasiController@ApprovalBerkasHome');
Route::get('admin/proses/kasi/approval-berkas/filter','Admin\Proses\KasiController@ApprovalBerkasFilter');
Route::post('admin/proses/kasi/approval-berkas/filter','Admin\Proses\KasiController@ApprovalBerkasDoFilter');
Route::get('admin/proses/kasi/approval-berkas/search/{keyword}','Admin\Proses\KasiController@ApprovalBerkasSearch');
Route::get('admin/proses/kasi/approval-berkas/list/{kat}','Admin\Proses\KasiController@ApprovalBerkasList');

Route::get('admin/proses/kasi/approval-berkas/edit/{per}','Admin\Proses\KasiController@ApprovalBerkasEdit');
Route::post('admin/proses/kasi/approval-berkas/edit/{per}','Admin\Proses\KasiController@ApprovalBerkasDoSubmit');

Route::get('admin/proses/korlap','Admin\Proses\KorlapController@Home');
Route::get('admin/proses/korlap/filter','Admin\Proses\KorlapController@Filter');
Route::post('admin/proses/korlap/filter','Admin\Proses\KorlapController@DoFilter');
Route::get('admin/proses/korlap/search/{keyword}','Admin\Proses\KorlapController@Search');
Route::get('admin/proses/korlap/list/{kat}','Admin\Proses\KorlapController@Lists');
Route::get('admin/proses/korlap/edit/{per}','Admin\Proses\KorlapController@Edit');
Route::post('admin/proses/korlap/edit/{per}','Admin\Proses\KorlapController@DoSubmit');
Route::get('admin/proses/korlap/delete/{svy}/{per}','Admin\Proses\KorlapController@Delete');
Route::get('admin/proses/korlap/submit/{per}','Admin\Proses\KorlapController@DoSubmitTimTeknis');
Route::get('admin/proses/korlap/tolak/{per}','Admin\Proses\KorlapController@tolak');

Route::get('admin/proses/tim-teknis','Admin\Proses\TimTeknisController@Home');
Route::get('admin/proses/tim-teknis/filter','Admin\Proses\TimTeknisController@Filter');
Route::post('admin/proses/tim-teknis/filter','Admin\Proses\TimTeknisController@DoFilter');
Route::get('admin/proses/tim-teknis/search/{keyword}','Admin\Proses\TimTeknisController@Search');
Route::get('admin/proses/tim-teknis/list/{kat}','Admin\Proses\TimTeknisController@Lists');
Route::get('admin/proses/tim-teknis/edit/{per}','Admin\Proses\TimTeknisController@Edit');
Route::post('admin/proses/tim-teknis/edit/{per}','Admin\Proses\TimTeknisController@DoSubmit');
Route::post('admin/proses/tim-teknis/upload/{per}','Admin\Proses\TimTeknisController@DoUpload');
Route::get('admin/proses/tim-teknis/delete/{hsv}/{per}','Admin\Proses\TimTeknisController@Delete');
Route::get('admin/proses/tim-teknis/submit/{per}','Admin\Proses\TimTeknisController@DoSubmitKorlap');
Route::get('admin/proses/tim-teknis/hasil_survey/{per}','Admin\Proses\TimTeknisController@hasilSurvey');
Route::post('admin/proses/tim-teknis/addTim/{per}','Admin\Proses\TimTeknisController@addTimSurvey');
Route::post('admin/proses/tim-teknis/removeTim/{per}','Admin\Proses\TimTeknisController@removeTimSurvey');
Route::get('tim-teknis/download/hasil-survey/{syarat}','Admin\Proses\DownloadController@DownloadHasilSurvey');
Route::post('admin/proses/tim-teknis/hasil_survey/{per}','Admin\Proses\TimTeknisController@DoSelesaiSurvey');

Route::get('admin/proses/korlap/bap','Admin\Proses\KorlapController@BapHome');
Route::get('admin/proses/korlap/bap/filter','Admin\Proses\KorlapController@BapFilter');
Route::post('admin/proses/korlap/bap/filter','Admin\Proses\KorlapController@BapDoFilter');
Route::get('admin/proses/korlap/bap/search/{keyword}','Admin\Proses\KorlapController@BapSearch');
Route::get('admin/proses/korlap/bap/list/{kat}','Admin\Proses\KorlapController@BapList');
Route::get('admin/proses/korlap/bap/edit/{per}','Admin\Proses\KorlapController@BapEdit');
Route::post('admin/proses/korlap/bap/edit/{per}','Admin\Proses\KorlapController@BapDoSubmit');
Route::get('admin/proses/korlap/bap/delete/{svy}/{per}','Admin\Proses\KorlapController@BapDelete');
Route::get('admin/proses/korlap/bap/submit/{per}','Admin\Proses\KorlapController@BapDoSubmitTimTeknis');

Route::get('admin/proses/cetak-sk','Admin\Proses\CetakSkController@Home');
Route::get('admin/proses/cetak-sk/filter','Admin\Proses\CetakSkController@Filter');
Route::post('admin/proses/cetak-sk/filter','Admin\Proses\CetakSkController@DoFilter');
Route::get('admin/proses/cetak-sk/search/{keyword}','Admin\Proses\CetakSkController@Search');
Route::get('admin/proses/cetak-sk/list/{kat}','Admin\Proses\CetakSkController@Lists');
Route::get('admin/proses/cetak-sk/edit/{per}','Admin\Proses\CetakSkController@Edit');
Route::post('admin/proses/cetak-sk/edit/{per}','Admin\Proses\CetakSkController@SaveDraft');
Route::get('admin/proses/cetak-sk/draft/{per}','Admin\Proses\CetakSkController@CetakDraft');
Route::get('admin/proses/cetak-sk/submit/{per}','Admin\Proses\CetakSkController@DoSubmit');

Route::get('admin/proses/cetak-spm','Admin\Proses\CetakSPMController@Home');
Route::get('admin/proses/cetak-spm/filter','Admin\Proses\CetakSPMController@Filter');
Route::post('admin/proses/cetak-spm/filter','Admin\Proses\CetakSPMController@DoFilter');
Route::get('admin/proses/cetak-spm/search/{keyword}','Admin\Proses\CetakSPMController@Search');
Route::get('admin/proses/cetak-spm/list/{kat}','Admin\Proses\CetakSPMController@Lists');
Route::get('admin/proses/cetak-spm/edit/{per}','Admin\Proses\CetakSPMController@Edit');
Route::post('admin/proses/cetak-spm/edit/{per}','Admin\Proses\CetakSPMController@DoSubmit');
Route::post('admin/proses/cetak-spm/save-spm/{per}','Admin\Proses\CetakSPMController@SaveSPM');
Route::get('admin/proses/cetak-spm/print/{per}','Admin\Proses\CetakSPMController@PrintSPM');

Route::get('admin/proses/bendahara','Admin\Proses\BendaharaController@Home');
Route::get('admin/proses/bendahara/filter','Admin\Proses\BendaharaController@Filter');
Route::post('admin/proses/bendahara/filter','Admin\Proses\BendaharaController@DoFilter');
Route::get('admin/proses/bendahara/search/{keyword}','Admin\Proses\BendaharaController@Search');
Route::get('admin/proses/bendahara/list/{kat}','Admin\Proses\BendaharaController@Lists');
Route::get('admin/proses/bendahara/edit/{per}','Admin\Proses\BendaharaController@Edit');
Route::post('admin/proses/bendahara/edit/{per}','Admin\Proses\BendaharaController@DoSubmit');

Route::get('admin/proses/skrd','Admin\Proses\SkrdController@Home');
Route::get('admin/proses/skrd/filter','Admin\Proses\SkrdController@Filter');
Route::post('admin/proses/skrd/filter','Admin\Proses\SkrdController@DoFilter');
Route::get('admin/proses/skrd/search/{keyword}','Admin\Proses\SkrdController@Search');
Route::get('admin/proses/skrd/list/{kat}','Admin\Proses\SkrdController@Lists');
Route::get('admin/proses/skrd/edit/{per}','Admin\Proses\SkrdController@Edit');
Route::post('admin/proses/skrd/edit/{per}','Admin\Proses\SkrdController@SaveDraft');
Route::get('admin/proses/skrd/draft/{per}','Admin\Proses\SkrdController@CetakDraft');
Route::get('admin/proses/skrd/skedit/{per}','Admin\Proses\SkrdController@EditSK');
Route::post('admin/proses/skrd/skedit/{per}','Admin\Proses\SkrdController@SaveDraftSK');
Route::get('admin/proses/skrd/skdraft/{per}','Admin\Proses\SkrdController@CetakDraftSK');
Route::get('admin/proses/skrd/submit/{per}','Admin\Proses\SkrdController@DoSubmit');
Route::get('admin/proses/skrd/cetak/{per}','Admin\Proses\SkrdController@CetakSKRD');
Route::get('admin/proses/skrd/cetaksk/{per}','Admin\Proses\SkrdController@CetakSKbySKRD');

Route::get('admin/proses/kasi/draft','Admin\Proses\KasiController@DraftHome');
Route::get('admin/proses/kasi/draft/filter','Admin\Proses\KasiController@DraftFilter');
Route::post('admin/proses/kasi/draft/filter','Admin\Proses\KasiController@DraftDoFilter');
Route::get('admin/proses/kasi/draft/search/{keyword}','Admin\Proses\KasiController@DraftSearch');
Route::get('admin/proses/kasi/draft/list/{kat}','Admin\Proses\KasiController@DraftList');
Route::get('admin/proses/kasi/draft/edit/{per}','Admin\Proses\KasiController@DraftEdit');
Route::post('admin/proses/kasi/draft/edit/{per}','Admin\Proses\KasiController@DraftDoSubmit');
Route::get('admin/proses/kasi/draft/cetak/{per}','Admin\Proses\KasiController@CetakDraft');

Route::get('admin/proses/kabid','Admin\Proses\KabidController@Home');
Route::get('admin/proses/kabid/filter','Admin\Proses\KabidController@Filter');
Route::post('admin/proses/kabid/filter','Admin\Proses\KabidController@DoFilter');
Route::get('admin/proses/kabid/search/{keyword}','Admin\Proses\KabidController@Search');
Route::get('admin/proses/kabid/list/{kat}','Admin\Proses\KabidController@Lists');
Route::get('admin/proses/kabid/edit/{per}','Admin\Proses\KabidController@Edit');
Route::post('admin/proses/kabid/edit/{per}','Admin\Proses\KabidController@DoSubmit');
Route::get('admin/proses/kabid/draft/{per}','Admin\Proses\KabidController@CetakDraft');

Route::get('admin/proses/kadin','Admin\Proses\KadinController@Home');
Route::get('admin/proses/kadin/filter','Admin\Proses\KadinController@Filter');
Route::post('admin/proses/kadin/filter','Admin\Proses\KadinController@DoFilter');
Route::get('admin/proses/kadin/search/{keyword}','Admin\Proses\KadinController@Search');
Route::get('admin/proses/kadin/list/{kat}','Admin\Proses\KadinController@Lists');
Route::get('admin/proses/kadin/edit/{per}','Admin\Proses\KadinController@Edit');
Route::post('admin/proses/kadin/edit/{per}','Admin\Proses\KadinController@DoSubmit');
Route::get('admin/proses/kadin/draft/{per}','Admin\Proses\KadinController@CetakDraft');
Route::get('admin/proses/kadin/sk/{per}','Admin\Proses\PengambilanController@downloadSK');
Route::get('admin/proses/kadin/arsip-sk','Admin\Proses\KadinController@ArsipSK');

Route::get('admin/proses/pengambilan','Admin\Proses\PengambilanController@Home');
Route::get('admin/proses/pengambilan/filter','Admin\Proses\PengambilanController@Filter');
Route::post('admin/proses/pengambilan/filter','Admin\Proses\PengambilanController@DoFilter');
Route::get('admin/proses/pengambilan/search/{keyword}','Admin\Proses\PengambilanController@Search');
Route::get('admin/proses/pengambilan/list/{kat}','Admin\Proses\PengambilanController@Lists');
Route::get('admin/proses/pengambilan/notif/{per}','Admin\Proses\PengambilanController@Notif');
Route::get('admin/proses/pengambilan/edit/{per}','Admin\Proses\PengambilanController@Edit');
Route::post('admin/proses/pengambilan/edit/{per}','Admin\Proses\PengambilanController@DoSubmit');
Route::get('admin/proses/pengambilan/draft/{per}','Admin\Proses\PengambilanController@CetakDraft');
Route::get('admin/proses/pengambilan/sk/{per}','Admin\Proses\PengambilanController@downloadSK');

Route::get('admin/proses/arsip','Admin\Proses\ArsipController@Home');
Route::get('admin/proses/arsip/filter','Admin\Proses\ArsipController@Filter');
Route::post('admin/proses/arsip/filter','Admin\Proses\ArsipController@DoFilter');
Route::get('admin/proses/arsip/search/{keyword}','Admin\Proses\ArsipController@Search');
Route::get('admin/proses/arsip/list/{kat}','Admin\Proses\ArsipController@Lists');
Route::get('admin/proses/arsip/edit/{per}','Admin\Proses\ArsipController@Edit');
Route::post('admin/proses/arsip/edit/{per}','Admin\Proses\ArsipController@DoSubmit');
Route::get('admin/proses/arsip/draft/{per}','Admin\Proses\ArsipController@CetakDraft');
Route::get('admin/proses/arsip/selesai','Admin\Proses\ArsipController@selesai');

Route::get('admin/proses/download-scan-sk/{scan}','Admin\Proses\ArsipController@downloadScanSk');
Route::get('admin/proses/download-skrd/{per}','Admin\Proses\DownloadController@downloadSKRD');
Route::get('admin/proses/download-sk/{per}','Admin\Proses\DownloadController@downloadSK');

Route::get('admin/pencabutan','Admin\Pencabutan\HomeController@lists');
Route::post('admin/pencabutan','Admin\Pencabutan\HomeController@lists');

Route::get('admin/pencabutan/{pen}/detail','Admin\Pencabutan\HomeController@detail')->name('admin.pencabutan.detail');
Route::get('admin/pencabutan/{pen}/{posisi}/detail','Admin\Pencabutan\InboxController@detail')->name('admin.pencabutan.info.detail');

Route::get('admin/pencabutan/{posisi}/inbox','Admin\Pencabutan\InboxController@lists');
Route::post('admin/pencabutan/{posisi}/inbox','Admin\Pencabutan\InboxController@lists');

Route::get('admin/pencabutan/{posisi}/outbox','Admin\Pencabutan\OutboxController@lists');
Route::post('admin/pencabutan/{posisi}/outbox','Admin\Pencabutan\OutboxController@lists');

Route::get('admin/pencabutan/{posisi}/rekap','Admin\Pencabutan\RekapController@lists');
Route::post('admin/pencabutan/{posisi}/rekap','Admin\Pencabutan\RekapController@lists');

Route::get('admin/pencabutan/rekap/{posisi}/user','Admin\Pencabutan\RekapController@RekapUser');
Route::post('admin/pencabutan/rekap/{posisi}/user','Admin\Pencabutan\RekapController@RekapUser');

Route::get('admin/pencabutan/rekap/{posisi}/izin','Admin\Pencabutan\RekapController@RekapIzin');
Route::post('admin/pencabutan/rekap/{posisi}/izin','Admin\Pencabutan\RekapController@RekapIzin');


Route::get('admin/pencabutan/download/lampiran/{base64}','Admin\Pencabutan\DownloadController@DownloadFilePersyaratan');
Route::get('admin/pencabutan/download-sk/{pen}','Admin\Pencabutan\DownloadController@downloadSKPencabutan');

Route::get('admin/pencabutan/pendaftaran','Admin\Pencabutan\PendaftaranController@Home');
Route::get('admin/pencabutan/pendaftaran/lists/{kat}','Admin\Pencabutan\PendaftaranController@Lists');
Route::get('admin/pencabutan/pendaftaran/filter','Admin\Pencabutan\PendaftaranController@Filter');
Route::post('admin/pencabutan/pendaftaran/filter','Admin\Pencabutan\PendaftaranController@DoFilter');
Route::get('admin/pencabutan/pendaftaran/search/{keyword}','Admin\Pencabutan\PendaftaranController@Search');
Route::get('admin/pencabutan/pendaftaran/view/{pen}','Admin\Pencabutan\PendaftaranController@View');
Route::get('admin/pencabutan/pendaftaran/edit/{pen}','Admin\Pencabutan\PendaftaranController@Edit');
Route::post('admin/pencabutan/pendaftaran/edit/{pen}','Admin\Pencabutan\PendaftaranController@DoSubmit');

Route::get('admin/pencabutan/kasi','Admin\Pencabutan\KasiController@Home');
Route::get('admin/pencabutan/kasi/filter','Admin\Pencabutan\KasiController@Filter');
Route::post('admin/pencabutan/kasi/filter','Admin\Pencabutan\KasiController@DoFilter');
Route::get('admin/pencabutan/kasi/search/{keyword}','Admin\Pencabutan\KasiController@Search');
Route::get('admin/pencabutan/kasi/view/{pen}','Admin\Pencabutan\KasiController@View');
Route::get('admin/pencabutan/kasi/edit/{pen}','Admin\Pencabutan\KasiController@Edit');
Route::post('admin/pencabutan/kasi/edit/{pen}','Admin\Pencabutan\KasiController@SaveDraft');
Route::get('admin/pencabutan/kasi/draft/{pen}','Admin\Pencabutan\KasiController@CetakDraft');
Route::get('admin/pencabutan/kasi/submit/{pen}','Admin\Pencabutan\KasiController@DoSubmit');
Route::get('admin/pencabutan/kasi/lists/{kat}','Admin\Pencabutan\KasiController@Lists');
Route::get('admin/pencabutan/kasi/cetak/{pen}','Admin\Pencabutan\KasiController@cetak');

Route::get('admin/pencabutan/kabid','Admin\Pencabutan\KabidController@Home');
Route::get('admin/pencabutan/kabid/filter','Admin\Pencabutan\KabidController@Filter');
Route::post('admin/pencabutan/kabid/filter','Admin\Pencabutan\KabidController@DoFilter');
Route::get('admin/pencabutan/kabid/search/{keyword}','Admin\Pencabutan\KabidController@Search');
Route::get('admin/pencabutan/kabid/view/{pen}','Admin\Pencabutan\KabidController@View');
Route::get('admin/pencabutan/kabid/edit/{pen}','Admin\Pencabutan\KabidController@Edit');
Route::post('admin/pencabutan/kabid/edit/{pen}','Admin\Pencabutan\KabidController@DoSubmit');
Route::get('admin/pencabutan/kabid/lists/{kat}','Admin\Pencabutan\KabidController@Lists');
Route::get('admin/pencabutan/kabid/cetak/{pen}','Admin\Pencabutan\KabidController@CetakDraft');

Route::get('admin/pencabutan/kadin','Admin\Pencabutan\KadinController@Home');
Route::get('admin/pencabutan/kadin/filter','Admin\Pencabutan\KadinController@Filter');
Route::post('admin/pencabutan/kadin/filter','Admin\Pencabutan\KadinController@DoFilter');
Route::get('admin/pencabutan/kadin/search/{keyword}','Admin\Pencabutan\KadinController@Search');
Route::get('admin/pencabutan/kadin/view/{pen}','Admin\Pencabutan\KadinController@View');
Route::get('admin/pencabutan/kadin/edit/{pen}','Admin\Pencabutan\KadinController@Edit');
Route::post('admin/pencabutan/kadin/edit/{pen}','Admin\Pencabutan\KadinController@DoSubmit');
Route::get('admin/pencabutan/kadin/draft/{pen}','Admin\Pencabutan\KadinController@CetakDraft');
Route::get('admin/pencabutan/kadin/lists/{kat}','Admin\Pencabutan\KadinController@Lists');
Route::get('admin/pencabutan/kadin/cetak/{pen}','Admin\Pencabutan\KadinController@CetakDraft');

Route::get('admin/pencabutan/pengambilan','Admin\Pencabutan\PengambilanController@Home');
Route::get('admin/pencabutan/pengambilan/filter','Admin\Pencabutan\PengambilanController@Filter');
Route::post('admin/pencabutan/pengambilan/filter','Admin\Pencabutan\PengambilanController@DoFilter');
Route::get('admin/pencabutan/pengambilan/search/{keyword}','Admin\Pencabutan\PengambilanController@Search');
Route::get('admin/pencabutan/pengambilan/notif/{pen}','Admin\Pencabutan\PengambilanController@Notif');
Route::get('admin/pencabutan/pengambilan/edit/{pen}','Admin\Pencabutan\PengambilanController@Edit');
Route::post('admin/pencabutan/pengambilan/edit/{pen}','Admin\Pencabutan\PengambilanController@DoSubmit');
Route::get('admin/pencabutan/pengambilan/draft/{pen}','Admin\Pencabutan\PengambilanController@CetakDraft');
Route::get('admin/pencabutan/pengambilan/lists/{kat}','Admin\Pencabutan\PengambilanController@Lists');

Route::get('admin/pencabutan/arsip','Admin\Pencabutan\ArsipController@Home');
Route::get('admin/pencabutan/arsip/filter','Admin\Pencabutan\ArsipController@Filter');
Route::post('admin/pencabutan/arsip/filter','Admin\Pencabutan\ArsipController@DoFilter');
Route::get('admin/pencabutan/arsip/search/{keyword}','Admin\Pencabutan\ArsipController@Search');
Route::get('admin/pencabutan/arsip/edit/{pen}','Admin\Pencabutan\ArsipController@Edit');
Route::post('admin/pencabutan/arsip/edit/{pen}','Admin\Pencabutan\ArsipController@DoSubmit');
Route::get('admin/pencabutan/arsip/draft/{pen}','Admin\Pencabutan\ArsipController@CetakDraft');
Route::get('admin/pencabutan/arsip/lists/{kat}','Admin\Pencabutan\ArsipController@Lists');

Route::get('admin/pencabutan/selesai','Admin\Pencabutan\HomeController@selesai');
Route::get('admin/pencabutan/{pen}/selesai','Admin\Pencabutan\HomeController@detail')->name('admin.pencabutan.selesai');

/*info dan inbox pendaftaran*/
Route::get('admin/inbox/{posisi}','Admin\Proses\InboxController@Lists');
Route::post('admin/inbox/{posisi}','Admin\Proses\InboxController@Lists');

Route::get('admin/outbox/{posisi}','Admin\Proses\OutboxController@Lists');
Route::post('admin/outbox/{posisi}','Admin\Proses\OutboxController@Lists');

Route::get('admin/rekap/{posisi}/user','Admin\Proses\RekapController@RekapUser');
Route::post('admin/rekap/{posisi}/user','Admin\Proses\RekapController@RekapUser');

Route::get('admin/rekap/{posisi}/izin','Admin\Proses\RekapController@RekapIzin');
Route::post('admin/rekap/{posisi}/izin','Admin\Proses\RekapController@RekapIzin');






Route::get('admin/info/{per}/{posisi}/detail','Admin\Proses\InboxController@view')->name('admin.info.detail');
Route::get('admin/info/{per}/{posisi}/cetak','Admin\Proses\InboxController@cetak')->name('admin.info.cetak');

Route::get('admin/proses/info-pendaftaran','Admin\Proses\InfoPendaftaranController@Home');
Route::get('admin/proses/inbox-pendaftaran/list/{kat}','Admin\Proses\InfoPendaftaranController@InboxList');
Route::get('admin/proses/outbox-pendaftaran/list/{kat}','Admin\Proses\InfoPendaftaranController@OutboxList');
Route::get('admin/proses/info-pendaftaran/view/{per}','Admin\Proses\InfoPendaftaranController@DoView');

Route::get('admin/proses/info-approval-berkas','Admin\Proses\InfoKasiController@ApprovalBerkasHome');
Route::get('admin/proses/inbox-approval-berkas/list/{kat}','Admin\Proses\InfoKasiController@ApprovalBerkasInboxList');
Route::get('admin/proses/outbox-approval-berkas/list/{kat}','Admin\Proses\InfoKasiController@ApprovalBerkasOutboxList');
Route::get('admin/proses/info-approval-berkas/view/{per}','Admin\Proses\InfoKasiController@DoView');

Route::get('admin/proses/info-approval-sk','Admin\Proses\InfoKasiController@ApprovalSKHome');
Route::get('admin/proses/inbox-approval-sk/list/{kat}','Admin\Proses\InfoKasiController@ApprovalSKInboxList');
Route::get('admin/proses/outbox-approval-sk/list/{kat}','Admin\Proses\InfoKasiController@ApprovalSKOutboxList');
Route::get('admin/proses/info-approval-sk/view/{per}','Admin\Proses\InfoKasiController@DoView');

Route::get('admin/proses/info-korlap','Admin\Proses\InfoKorlapController@Home');
Route::get('admin/proses/inbox-korlap/list/{kat}','Admin\Proses\InfoKorlapController@InboxList');
Route::get('admin/proses/outbox-korlap/list/{kat}','Admin\Proses\InfoKorlapController@OutboxList');
Route::get('admin/proses/info-korlap/view/{per}','Admin\Proses\InfoKorlapController@DoView');

Route::get('admin/proses/info-korlap-bap','Admin\Proses\InfoKorlapController@BapHome');
Route::get('admin/proses/inbox-korlap-bap/list/{kat}','Admin\Proses\InfoKorlapController@BapInboxList');
Route::get('admin/proses/outbox-korlap-bap/list/{kat}','Admin\Proses\InfoKorlapController@BapOutboxList');
Route::get('admin/proses/info-korlap-bap/view/{per}','Admin\Proses\InfoKorlapController@BapDoView');

Route::get('admin/proses/info-tim-teknis','Admin\Proses\InfoTimTeknisController@Home');
Route::get('admin/proses/inbox-tim-teknis/list/{kat}','Admin\Proses\InfoTimTeknisController@InboxList');
Route::get('admin/proses/outbox-tim-teknis/list/{kat}','Admin\Proses\InfoTimTeknisController@OutboxList');
Route::get('admin/proses/info-tim-teknis/view/{per}','Admin\Proses\InfoTimTeknisController@DoView');

Route::get('admin/proses/info-cetak-sk','Admin\Proses\InfoCetakSKController@Home');
Route::get('admin/proses/inbox-cetak-sk/list/{kat}','Admin\Proses\InfoCetakSKController@InboxList');
Route::get('admin/proses/outbox-cetak-sk/list/{kat}','Admin\Proses\InfoCetakSKController@OutboxList');
Route::get('admin/proses/info-cetak-sk/view/{per}','Admin\Proses\InfoCetakSKController@DoView');

Route::get('admin/proses/info-cetak-spm','Admin\Proses\InfoCetakSPMController@Home');
Route::get('admin/proses/inbox-cetak-spm/list/{kat}','Admin\Proses\InfoCetakSPMController@InboxList');
Route::get('admin/proses/outbox-cetak-spm/list/{kat}','Admin\Proses\InfoCetakSPMController@OutboxList');
Route::get('admin/proses/info-cetak-spm/view/{per}','Admin\Proses\InfoCetakSPMController@DoView');

Route::get('admin/proses/info-bendahara','Admin\Proses\InfoBendaharaController@Home');
Route::get('admin/proses/inbox-bendahara/list/{kat}','Admin\Proses\InfoBendaharaController@InboxList');
Route::get('admin/proses/outbox-bendahara/list/{kat}','Admin\Proses\InfoBendaharaController@OutboxList');
Route::get('admin/proses/info-bendahara/view/{per}','Admin\Proses\InfoBendaharaController@DoView');

Route::get('admin/proses/info-skrd','Admin\Proses\InfoSkrdController@Home');
Route::get('admin/proses/inbox-skrd/list/{kat}','Admin\Proses\InfoSkrdController@InboxList');
Route::get('admin/proses/outbox-skrd/list/{kat}','Admin\Proses\InfoSkrdController@OutboxList');
Route::get('admin/proses/info-skrd/view/{per}','Admin\Proses\InfoSkrdController@DoView');

Route::get('admin/proses/info-kabid','Admin\Proses\InfoKabidController@Home');
Route::get('admin/proses/inbox-kabid/list/{kat}','Admin\Proses\InfoKabidController@InboxList');
Route::get('admin/proses/outbox-kabid/list/{kat}','Admin\Proses\InfoKabidController@OutboxList');
Route::get('admin/proses/info-kabid/view/{per}','Admin\Proses\InfoKabidController@DoView');

Route::get('admin/proses/info-kadin','Admin\Proses\InfoKadinController@Home');
Route::get('admin/proses/inbox-kadin/list/{kat}','Admin\Proses\InfoKadinController@InboxList');
Route::get('admin/proses/outbox-kadin/list/{kat}','Admin\Proses\InfoKadinController@OutboxList');
Route::get('admin/proses/info-kadin/view/{per}','Admin\Proses\InfoKadinController@DoView');

Route::get('admin/proses/info-pengambilan','Admin\Proses\InfoPengambilanController@Home');
Route::get('admin/proses/inbox-pengambilan/list/{kat}','Admin\Proses\InfoPengambilanController@InboxList');
Route::get('admin/proses/outbox-pengambilan/list/{kat}','Admin\Proses\InfoPengambilanController@OutboxList');
Route::get('admin/proses/info-pengambilan/view/{per}','Admin\Proses\InfoPengambilanController@DoView');

Route::get('admin/laporan/rekapitulasi','Admin\Laporan\RekapitulasiController@Home');
Route::post('admin/laporan/rekapitulasi','Admin\Laporan\RekapitulasiController@DoSearch');
Route::get('admin/laporan/rekapitulasi/kat/{kat}','Admin\Laporan\RekapitulasiController@DoList');
Route::get('admin/laporan/rekapitulasi/kat/excel/{kat}','Admin\Laporan\RekapitulasiController@DoExcel');
Route::get('admin/laporan/rekapitulasi/total','Admin\Laporan\RekapitulasiController@DoTotalList');
Route::get('admin/laporan/rekapitulasi/total/excel','Admin\Laporan\RekapitulasiController@DoTotalExcel');
Route::get('admin/laporan/rekapitulasi/detail/{per}','Admin\Laporan\RekapitulasiController@DoView');

Route::get('admin/laporan/per-posisi','Admin\Laporan\PerPosisiController@Home');
Route::post('admin/laporan/per-posisi','Admin\Laporan\PerPosisiController@DoSearch');
Route::get('admin/laporan/per-posisi/kat/{kat}/{pos}','Admin\Laporan\PerPosisiController@DoList');
Route::get('admin/laporan/per-posisi/kat/excel/{kat}/{pos}','Admin\Laporan\PerPosisiController@DoExcel');
Route::get('admin/laporan/per-posisi/total/{pos}','Admin\Laporan\PerPosisiController@DoTotalList');
Route::get('admin/laporan/per-posisi/total/excel/{pos}','Admin\Laporan\PerPosisiController@DoTotalExcel');
Route::get('admin/laporan/per-posisi/{per}','Admin\Laporan\PerPosisiController@DoView');

Route::get('admin/laporan/per-wilayah','Admin\Laporan\PerWilayahController@Home');
Route::post('admin/laporan/per-wilayah','Admin\Laporan\PerWilayahController@DoSearch');
Route::get('admin/laporan/per-wilayah/kat/{kat}/{kec}','Admin\Laporan\PerWilayahController@DoList');
Route::get('admin/laporan/per-wilayah/kat/excel/{kat}/{kec}','Admin\Laporan\PerWilayahController@DoExcel');
Route::get('admin/laporan/per-wilayah/total/{kec}','Admin\Laporan\PerWilayahController@DoTotalList');
Route::get('admin/laporan/per-wilayah/total/excel/{kec}','Admin\Laporan\PerWilayahController@DoTotalExcel');
Route::get('admin/laporan/per-wilayah/{per}','Admin\Laporan\PerWilayahController@DoView');

Route::get('admin/laporan/wilayah','Admin\Laporan\PerWilayahController@Index');
Route::post('admin/laporan/wilayah','Admin\Laporan\PerWilayahController@Index');

Route::get('admin/laporan/posisi','Admin\Laporan\PerPosisiController@Index');
Route::post('admin/laporan/posisi','Admin\Laporan\PerPosisiController@Index');

Route::get('admin/laporan/member','Admin\Laporan\MemberController@Index');
Route::post('admin/laporan/member','Admin\Laporan\MemberController@Index');

Route::get('admin/laporan/permohonan','Admin\Laporan\PermohonanController@Index');
Route::post('admin/laporan/permohonan','Admin\Laporan\PermohonanController@Index');

Route::get('admin/laporan/status','Admin\Laporan\StatusController@Home');
Route::post('admin/laporan/status','Admin\Laporan\StatusController@DoSearch');
Route::get('admin/laporan/status/kat/{kat}/{stat}','Admin\Laporan\StatusController@DoList');
Route::get('admin/laporan/status/kat/excel/{kat}/{stat}','Admin\Laporan\StatusController@DoExcel');
Route::get('admin/laporan/status/total/{stat}','Admin\Laporan\StatusController@DoTotalList');
Route::get('admin/laporan/status/total/excel/{stat}','Admin\Laporan\StatusController@DoTotalExcel');
Route::get('admin/laporan/status/{per}','Admin\Laporan\StatusController@DoView');

Route::get('admin/laporan/per-jenis','Admin\Laporan\PerJenisController@Home');
Route::post('admin/laporan/per-jenis','Admin\Laporan\PerJenisController@DoSearch');
Route::get('admin/laporan/per-jenis/excel/{jenis}','Admin\Laporan\PerJenisController@DoExcel');
Route::get('admin/laporan/per-jenis/{per}','Admin\Laporan\PerJenisController@DoView');

Route::get('admin/laporan/retribusi','Admin\Laporan\RetribusiController@Home');
Route::post('admin/laporan/retribusi','Admin\Laporan\RetribusiController@DoSearch');


/* Notifikasi */
Route::get('baca-notifikasi/{notif}', function($notif){
	$notif = \App\Models\Notif::where('id', $notif)->first();
	$notif->read_at = date('Y-m-d H:i:s');
	$notif->Save();
});

Route::post('pusher/auth','Puss@AuthPusher');
Route::get('kbli','AjaxController@Kbli');
Route::post('kbli','AjaxController@KbliCari');

Route::get('pengumuman/view/{id}','AjaxController@Pengumuman');
Route::get('publik/syarat/{id}','AjaxController@SyaratPerizinan');
Route::get('permohonan/syarat/{id}','AjaxController@SyaratPerizinan');

Route::get('laporan/masuk-keluar','Laporan\LaporanController@RekapKaluarMasukIzin');
Route::post('laporan/masuk-keluar','Laporan\LaporanController@ViewRekapKeluarMasukIzin');

Route::get('laporan/gabungan-tahunan','Laporan\LaporanController@GabunganTahunan');
Route::post('laporan/gabungan-tahunan','Laporan\LaporanController@ViewGabunganTahunan');

Route::get('laporan/rekap-permohonan','Laporan\LaporanController@RekapitulasiPermohonan');
Route::post('laporan/rekap-permohonan','Laporan\LaporanController@ViewRekapitulasiPermohonan');

Route::get('laporan/grafik-masuk-keluar','Laporan\GrafikController@MasukKeluar');
Route::post('laporan/grafik-masuk-keluar','Laporan\GrafikController@ViewMasukKeluar');

Route::get('laporan/status','Laporan\LaporanController@Status');
Route::post('laporan/status','Laporan\LaporanController@ViewStatus');

Route::get('perizinan/surat/{per}/view','Proses\Master_Permohonan@ViewSurat');
Route::get('perizinan/download-surat/{surat}','Proses\Master_Permohonan@DownloadSurat');


Route::get('laporan/rekapitulasi-izin','Laporan\LaporanController@RekapitulasiIzin');
Route::post('laporan/rekapitulasi-izin','Laporan\LaporanController@ViewRekapitulasiIzin');

/* Data Lama*/
Route::get('perizinan/data-lama/edit/{per}','Lama\DataLamaController@EditDataLama');
Route::post('perizinan/data-lama/edit/{per}','Lama\DataLamaController@SaveEditDataLama');

Route::get('perizinan/pendaftaran/cek_status/{per}', 'Proses\ProsesController@CekStatus');

/* Route Dinas Terkait Dan Master Perizinan Yang Sudah Selesai */
Route::get('dinas/data-perizinan','Data\PerizinanFinal@listDataPerizinan');
Route::get('dinas/data-perizinan/filter','Data\PerizinanFinal@FilterData');
Route::post('dinas/data-perizinan/filter','Data\PerizinanFinal@DoFilterData');

Route::get('tes-bssn','Testing@TestingBSSN');

//Laporan Rekapitulasi Member
Route::get('laporan/rekapitulasi-member','Laporan\LaporanMemberController@Rekapitulasi');
Route::post('laporan/rekapitulasi-member','Laporan\LaporanMemberController@ViewRekapitulasi');
Route::get('laporan/detail-rekap-member/{profile}/{member}','Laporan\LaporanMemberController@DetailRekapitulasi');

//Laporan Data Profil Mamber
Route::get('laporan/profile-member','Laporan\LaporanMemberController@ProfileMember');
Route::post('laporan/profile-member','Laporan\LaporanMemberController@ViewProfileMember');

//Kategori Sarana Kesehatan
Route::get('referensi/kategori-sarana-kesehatan','Referensi\KategoriSaranaKesehatanController@index');
Route::get('referensi/kategori-sarana-kesehatan/search/{keyword?}','Referensi\KategoriSaranaKesehatanController@Pencarian');
Route::get('referensi/kategori-sarana-kesehatan/add','Referensi\KategoriSaranaKesehatanController@Add');
Route::post('referensi/kategori-sarana-kesehatan/add','Referensi\KategoriSaranaKesehatanController@Save');
Route::get('referensi/kategori-sarana-kesehatan/{kategori}/edit','Referensi\KategoriSaranaKesehatanController@Edit');
Route::post('referensi/kategori-sarana-kesehatan/{kategori}/edit','Referensi\KategoriSaranaKesehatanController@Update');
Route::get('referensi/kategori-sarana-kesehatan/{kategori}/delete','Referensi\KategoriSaranaKesehatanController@Delete');

//Type Sarana Kesehatan
Route::get('referensi/type-sarana-kesehatan','Referensi\TypeSaranaKesehatanController@index');
Route::get('referensi/type-sarana-kesehatan/search/{keyword?}','Referensi\TypeSaranaKesehatanController@Pencarian');
Route::get('referensi/type-sarana-kesehatan/add','Referensi\TypeSaranaKesehatanController@Add');
Route::post('referensi/type-sarana-kesehatan/add','Referensi\TypeSaranaKesehatanController@Save');
Route::get('referensi/type-sarana-kesehatan/{type}/edit','Referensi\TypeSaranaKesehatanController@Edit');
Route::post('referensi/type-sarana-kesehatan/{type}/edit','Referensi\TypeSaranaKesehatanController@Update');
Route::get('referensi/type-sarana-kesehatan/{type}/delete','Referensi\TypeSaranaKesehatanController@Delete');

//Sarana Kesehatan
Route::get('referensi/sarana-kesehatan','Referensi\SaranaKesehatanController@index');
Route::get('referensi/sarana-kesehatan/search/{keyword?}','Referensi\SaranaKesehatanController@Pencarian');
Route::get('referensi/sarana-kesehatan/add','Referensi\SaranaKesehatanController@Add');
Route::post('referensi/sarana-kesehatan/add','Referensi\SaranaKesehatanController@Save');
Route::get('referensi/sarana-kesehatan/{sarkes}/edit','Referensi\SaranaKesehatanController@Edit');
Route::post('referensi/sarana-kesehatan/{sarkes}/edit','Referensi\SaranaKesehatanController@Update');
Route::get('referensi/sarana-kesehatan/{sarkes}/delete','Referensi\SaranaKesehatanController@Delete');
Route::get('referensi/sarana-kesehatan/kelurahan/{kec}','Referensi\SaranaKesehatanController@getKelurahan');
Route::get('referensi/sarana-kesehatan/kelurahan/ubah/{kec}','Referensi\SaranaKesehatanController@getKelurahanEdit');

//Agama
Route::get('referensi/agama','Referensi\AgamaController@index');
Route::get('referensi/agama/search/{keyword?}','Referensi\AgamaController@Pencarian');
Route::get('referensi/agama/add','Referensi\AgamaController@Add');
Route::post('referensi/agama/add','Referensi\AgamaController@Save');
Route::get('referensi/agama/{agama}/edit','Referensi\AgamaController@Edit');
Route::post('referensi/agama/{agama}/edit','Referensi\AgamaController@Update');
Route::get('referensi/agama/{agama}/delete','Referensi\AgamaController@Delete');

//laporan kki
Route::get('admin/laporan/kki/profile','Admin\Laporan\KkiController@profile');
Route::post('admin/laporan/kki/profile','Admin\Laporan\KkiController@profile');

Route::get('admin/laporan/kki/permohonan','Admin\Laporan\KkiController@permohonan');
Route::post('admin/laporan/kki/permohonan','Admin\Laporan\KkiController@permohonan');

Route::get('admin/laporan/kki/sk','Admin\Laporan\KkiController@sk');
Route::post('admin/laporan/kki/sk','Admin\Laporan\KkiController@sk');

Route::get('admin/proses/permohonan/timeline/{per}/cetak','Admin\Proses\PermohonanController@CetakTimeline');

Route::post('ajax/get-izin-by-kategori','AjaxController@izinByKategori');

//laporan ktki
Route::get('admin/laporan/ktki/profile','Admin\Laporan\KtkiController@profile');
Route::post('admin/laporan/ktki/profile','Admin\Laporan\KtkiController@profile');

Route::get('admin/laporan/ktki/permohonan','Admin\Laporan\KtkiController@permohonan');
Route::post('admin/laporan/ktki/permohonan','Admin\Laporan\KtkiController@permohonan');

Route::get('admin/laporan/ktki/sk','Admin\Laporan\KtkiController@sk');
Route::post('admin/laporan/ktki/sk','Admin\Laporan\KtkiController@sk');


Route::get('gettoken','TestPajakController@GetToken');
Route::get('getdata','TestPajakController@GetNpwp');


Route::get('getdatatoken','Pajak\PajakController@authgettoken');
Route::get('pajakview','Pajak\PajakViewController@index');
Route::post('pajakview/update','Pajak\PajakViewController@udpate');
Route::get('pajakview/npwp','Pajak\PajakViewController@npwp');
Route::post('pajakview/getnpwp/','Pajak\PajakViewController@getnpwp');
Route::get('ceknpwp/{npwp}','Pajak\PajakController@GetNpwp');
Route::get('anggota/aktivasi_ulang','EmailController@aktivasiUlang');
Route::post('anggota/aktivasi_ulang','EmailController@sendActivation')->name('anggota.aktivasi.ulang');

// Lupa Password Anggota
Route::get('password/reset', 'Auth\Anggota\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'Auth\Anggota\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\Anggota\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/reset', 'Auth\Anggota\ResetPasswordController@reset');

//email notifikasi
Route::get('anggota/permohonan_baru/{permohonan}/email', 'Anggota\PermohonanController@sendEmailPermohonan')->name('anggota.permohonan.email');

// DJP Pusat
Route::get('api/npwp/{npwp}','Api\DjpController@GetNpwp');
Route::get('api/getdatatoken','Api\DjpController@authgettoken');

// Route::get('ceknpwp/{npwp}','Api\DjpController@GetNpwp');
Route::get('ceknpwp/{npwp}','Pajak\PajakController@getnpwp');
// Route::get('getdatatoken','Api\DjpController@authgettoken');
Route::get('getdatatoken','Pajak\PajakController@authgettoken');


// Dukcapil
Route::get('api/nik/{nik}','Api\CapilController@GetNik');

//notifikasi admin
Route::get('admin/all-notif','Admin\Proses\NotifikasiController@index');

//notifikasi anggota
Route::get('anggota/notifikasi','Anggota\NotifikasiController@index');
Route::post('anggota/notifikasi/read','Anggota\NotifikasiController@read');

//chat admin
Route::get('admin/chat','Admin\ChatController@index');

//laporan jenis perusahaan
Route::get('admin/laporan/jenis-usaha','Admin\Laporan\JenisUsahaController@index');
Route::post('admin/laporan/jenis-usaha','Admin\Laporan\JenisUsahaController@index');

//laporan user
Route::get('admin/laporan/user','Admin\Laporan\UserController@index');
Route::post('admin/laporan/user','Admin\Laporan\UserController@index');

//ubah password user
Route::get('admin/update-password','Admin\PasswordController@index')->name('admin.edit.password');
Route::post('admin/update-password','Admin\PasswordController@update')->name('admin.update.password');

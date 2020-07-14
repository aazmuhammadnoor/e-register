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

    Route::get('register/{url}/revisi/{register}','Frontend\MyPageController@revisi')->name('mypage.register.edit');
    Route::post('register/{url}/revisi/{register}','Frontend\MyPageController@update')->name('mypage.register.update');

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

Route::get('login','Auth\Anggota\LoginController@showLoginForm');
Route::post('login','Auth\Anggota\LoginController@login');
Route::get('logout','Auth\Anggota\LoginController@logout');


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

    Route::post('registrasi/{register}/status','RegisterController@status')->name('admin.register.status');


});

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

//ubah password user
Route::get('admin/update-password','Admin\PasswordController@index')->name('admin.edit.password');
Route::post('admin/update-password','Admin\PasswordController@update')->name('admin.update.password');

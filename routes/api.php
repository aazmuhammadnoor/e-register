<?php

//Kadin
Route::post('user','Api\Userauth@Auth');
Route::post('kategori','Api\Ijin@KategoriIzin');
Route::post('list-izin','Api\Ijin@ListIjin');
Route::post('arsip-izin','Api\Ijin@arsip');
Route::post('view-izin','Api\Ijin@detailPermohonan');
Route::get('cetak-draft/{per}','Api\Ijin@CetakDraft');
Route::post('ttd-ijin/{per}','Api\Ijin@DoSubmit');

//Umum
Route::post('dashboard','Api\Ijin@Dashboard');
Route::get('view-pdf/{per}','Api\Ijin@generatePDF');

// Kasi
Route::get('kasi/dashboard/{user}/{status}','Api\Kasi@Dashboard');
Route::get('kasi/approval/{user}/{kat}/{status}','Api\Kasi@Listdata');
Route::get('kasi/view-approval/{id}/{mode}','Api\Kasi@ViewIjin');
Route::post('kasi/proses/berkas/{user}/{per}','Api\Kasi@ApprovalBerkasDoSubmit');
Route::post('kasi/proses/draft/{user}/{per}','Api\Kasi@DraftDoSubmit');
Route::get('kasi/arsip/{user}','Api\Kasi@arsip');

// Kabid
Route::get('kabid/dashboard/{user}','Api\Kabid@Dashboard');
Route::get('kabid/approval/{user}/{kat}','Api\Kabid@Listdata');
Route::get('kabid/view-approval/{id}','Api\Kabid@ViewIjin');
Route::post('kabid/proses/{user}/{per}','Api\Kabid@ApprovalBerkasDoSubmit');
Route::get('kabid/arsip/{user}','Api\Kabid@arsip');

// KKI API Request
Route::post('kki-dokter','Api\KkiController@DokterList');
Route::post('cekStr','Api\CekStr@getStr');
Route::get('kki/get-key','Api\newKKIController@getKey');

// KTKI API
Route::get('ktki/get-key','Api\KtkiController@getKey');
Route::post('ktki/get-data','Api\KtkiController@getData');
/*Route::get('ktki/decrypt/{val}','Api\KtkiController@decrypt');
Route::get('ktki/encrypt','Api\KtkiController@encrypt');*/

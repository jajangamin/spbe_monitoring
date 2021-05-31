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

Route::get('/', function () {
//    return view('frontend/landing/welcome');
    return view('backend/auth/login');
})->name('/');

Auth::routes();

Route::group([
    'namespace' => 'Backend',
    'prefix' => 'backend',
    'as' => 'backend.',
    'middleware' => 'auth',
        ], function () {

    Route::get('home', 'HomeController@index')->name('home');

    /**
     * Change Password Modul Routes
     * route('backend.change-password.*')
     */
    Route::group(['as' => 'change-password.'], function () {
        Route::get('change-password', 'ChangePasswordController@index')->name('index');
        Route::post('change-password/change', 'ChangePasswordController@change')->name('change');
    });

    /**
     * Profile Modul Routes
     * route('backend.profile.*')
     */
    Route::group(['as' => 'profile.'], function () {
        Route::get('profile', 'ProfileController@index')->name('index');
        Route::post('profile/update', 'ProfileController@update')->name('update');
    });

    /**
     * User Modul Routes
     * route('backend.user.*')
     */
    Route::group(['as' => 'user.'], function () {
        Route::get('user', 'UserController@index')->name('index');
        Route::post('user/toggle', 'UserController@toggle')->name('toggle');
        Route::get('user/create', 'UserController@create')->name('create');
        Route::post('user/store', 'UserController@store')->name('store');
        Route::get('user/edit/{id}', 'UserController@edit')->name('edit');
        Route::post('user/update/{id}', 'UserController@update')->name('update');
        Route::post('user/delete', 'UserController@delete')->name('deleteuser');
    });

     /**
     * Menus Modul Routes
     * route('backend.keluarga.*')
     */
    Route::group(['as' => 'keluarga.'], function () {
        Route::get('keluarga/{id}', 'KeluargaController@index')->name('index');
        Route::post('keluarga/toggle', 'KeluargaController@toggle')->name('toggle');
        Route::get('keluarga/create/{id}', 'KeluargaController@create')->name('create');
        Route::post('keluarga/store', 'KeluargaController@store')->name('store');
        Route::get('keluarga/edit/{id}', 'KeluargaController@edit')->name('edit');
        Route::post('keluarga/update/{id}', 'KeluargaController@update')->name('update');
        Route::post('keluarga/delete', 'KeluargaController@delete')->name('deletekeluarga');
    });

    /**
     * Visitor Modul Routes
     * route('backend.visitor.*')
     */
    Route::group(['as' => 'visitor.'], function () {
        Route::get('visitor', 'VisitorController@index')->name('index');
    });

    /**
     * Roles Modul Routes
     * route('backend.role.*')
     */
    Route::group(['as' => 'role.'], function () {
        Route::get('role', 'RoleController@index')->name('index');
        Route::post('role/toggle', 'RoleController@toggle')->name('toggle');
        Route::get('role/create', 'RoleController@create')->name('create');
        Route::post('role/store', 'RoleController@store')->name('store');
        Route::get('role/edit/{id}', 'RoleController@edit')->name('edit');
        Route::post('role/update/{id}', 'RoleController@update')->name('update');
        Route::post('role/delete','RoleController@delete')->name('deleterole');
    });

    /**
     * Menus Modul Routes
     * route('backend.menu.*')
     */
    Route::group(['as' => 'menu.'], function () {
        Route::get('menu', 'MenuController@index')->name('index');
        Route::post('menu/toggle', 'MenuController@toggle')->name('toggle');
        Route::get('menu/create', 'MenuController@create')->name('create');
        Route::post('menu/store', 'MenuController@store')->name('store');
        Route::get('menu/edit/{id}', 'MenuController@edit')->name('edit');
        Route::post('menu/update/{id}', 'MenuController@update')->name('update');
        Route::post('menu/delete', 'MenuController@delete')->name('delete');
    });

    /**
     * Access Control Modul Routes
     * route('backend.accesscontrol.*')
     */
    Route::group(['as' => 'accesscontrol.'], function () {
        Route::get('accesscontrol', 'AccessControlController@index')->name('index');
        Route::post('accesscontrol/search', 'AccessControlController@search')->name('search');
        Route::post('accesscontrol/update', 'AccessControlController@update')->name('update');
    });

    /**
     * Company Modul Routes
     * route('backend..*')
     */
    Route::group(['as' => 'company.'], function () {
        Route::get('company', 'CompanyController@index')->name('index');
        Route::post('company/toggle', 'CompanyController@toggle')->name('toggle');
        Route::get('company/create', 'CompanyController@create')->name('create');
        Route::post('company/store', 'CompanyController@store')->name('store');
        Route::get('company/edit/{id}', 'CompanyController@edit')->name('edit');
        Route::post('company/update/{id}', 'CompanyController@update')->name('update');
    });

    /**
     * Unit / Department Modul Routes
     * route('backend.department.*')
     */
    Route::group(['as' => 'department.'], function () {
        Route::get('department', 'DepartmentController@index')->name('index');
        Route::post('department/toggle', 'DepartmentController@toggle')->name('toggle');
        Route::get('department/create', 'DepartmentController@create')->name('create');
        Route::post('department/store', 'DepartmentController@store')->name('store');
        Route::get('department/edit/{id}', 'DepartmentController@edit')->name('edit');
        Route::post('department/update/{id}', 'DepartmentController@update')->name('update');
    });

    /**
     * Bill Modul Routes
     * route('backend.bill.*')
     */
    Route::group(['as' => 'bill.'], function () {
        Route::get('bill', 'BillController@index')->name('index');
        // Route::post('customer/toggle', 'CustomerController@toggle')->name('toggle');
        // Route::get('customer/create', 'CustomerController@create')->name('create');
        // Route::post('customer/store', 'CustomerController@store')->name('store');
        // Route::get('customer/edit/{id}', 'CustomerController@edit')->name('edit');
        // Route::post('customer/update/{id}', 'CustomerController@update')->name('update');
    });

    /**
     * Jadwal Modul Routes
     * route('backend.jadwal.*')
     */
    Route::group(['as' => 'jadwal.'], function () {
        Route::get('jadwal/konfirmasi', 'JadwalController@konfirmasi')->name('konfirmasi');
        Route::post('jadwal/konfirmasi', 'JadwalController@konfirmasiUlang')->name('konfirmasiulang');
        Route::get('jadwal/transaksi', 'JadwalController@transaksi')->name('transaksi');
        Route::post('jadwal/transaksi', 'JadwalController@transaksiBatal')->name('transaksibatal');
        Route::get('jadwal/transaksi/listpasien', 'JadwalController@transaksiPasien')->name('listpasien');

        Route::get('jadwal', 'JadwalController@transaksiSemua')->name('transaksisemua');
        Route::get('jadwal/transaksi/listpasiensemua', 'JadwalController@transaksiPasienSemua')->name('listpasiensemua');
        Route::get('jadwal/transaksi/showpasien', 'JadwalController@showPasien')->name('showpasien');

        Route::get('jadwal/transaksi/formnotifikasi', 'JadwalController@formNotifikasi')->name('formnotifikasi');
        Route::post('jadwal/transaksi/kirimnotifikasi', 'JadwalController@kirimNotifikasi')->name('kirimnotifikasi');
    });

    /**
     * Master Data Modul Routes
     * route('backend.master.*')
     */
    Route::group(['as' => 'master.'], function () {
        Route::get('master/poliklinik', 'MasterPoliklinikController@index')->name('polilist');
        Route::get('master/poliklinik/create', 'MasterPoliklinikController@createView')->name('policreateview');
        Route::post('master/poliklinik/create', 'MasterPoliklinikController@create')->name('policreate');
        Route::get('master/poliklinik/edit', 'MasterPoliklinikController@editView')->name('polieditview');
        Route::post('master/poliklinik/edit', 'MasterPoliklinikController@edit')->name('poliedit');
        Route::post('master/poliklinik/delete', 'MasterPoliklinikController@delete')->name('polidelete');

        Route::get('master/jadwal', 'MasterJadwalController@index')->name('jadwallist');
        Route::get('master/jadwal/create', 'MasterJadwalController@createView')->name('jadwalcreateview');
        Route::post('master/jadwal/create', 'MasterJadwalController@create')->name('jadwalcreate');
        Route::get('master/jadwal/edit', 'MasterJadwalController@editView')->name('jadwaleditview');
        Route::post('master/jadwal/edit', 'MasterJadwalController@edit')->name('jadwaledit');
        Route::post('master/jadwal/delete', 'MasterJadwalController@delete')->name('jadwaldelete');

        Route::get('master/dokter', 'MasterDokterController@index')->name('dokterlist');
        Route::get('master/dokter/create', 'MasterDokterController@createView')->name('doktercreateview');
        Route::post('master/dokter/create', 'MasterDokterController@create')->name('doktercreate');
        Route::get('master/dokter/edit', 'MasterDokterController@editView')->name('doktereditview');
        Route::post('master/dokter/edit', 'MasterDokterController@edit')->name('dokteredit');
        Route::post('master/dokter/delete', 'MasterDokterController@delete')->name('dokterdelete');

        Route::get('master/rawat', 'MasterRawatController@index')->name('rawatlist');
        Route::get('master/rawat/create', 'MasterRawatController@createView')->name('rawatcreateview');
        Route::post('master/rawat/create', 'MasterRawatController@create')->name('rawatcreate');
        Route::get('master/rawat/edit', 'MasterRawatController@editView')->name('rawateditview');
        Route::post('master/rawat/edit', 'MasterRawatController@edit')->name('rawatedit');
        Route::post('master/rawat/delete','MasterRawatController@delete')->name('rawatdelete');

        Route::get('master/lab', 'MasterLabController@index')->name('lablist');
        Route::get('master/lab/create', 'MasterLabController@createView')->name('labcreateview');
        Route::post('master/lab/create', 'MasterLabController@create')->name('labcreate');
        Route::get('master/lab/edit', 'MasterLabController@editView')->name('labeditview');
        Route::post('master/lab/edit', 'MasterLabController@edit')->name('labedit');
        Route::post('master/lab/delete', 'MasterLabController@delete')->name('labdelete');

        Route::get('master/jadwallab', 'MasterJadwalLabController@index')->name('jadwallablist');
        Route::get('master/jadwallab/create', 'MasterJadwalLabController@createView')->name('jadwallabcreateview');
        Route::post('master/jadwallab/create', 'MasterJadwalLabController@create')->name('jadwallabcreate');
        Route::get('master/jadwallab/edit', 'MasterJadwalLabController@editView')->name('jadwallabeditview');
        Route::post('master/jadwallab/edit', 'MasterJadwalLabController@edit')->name('jadwallabedit');
        Route::post('master/jadwallab/delete', 'MasterJadwalLabController@delete')->name('jadwallabdelete');

        Route::get('master/kategori', 'MasterKategoriController@index')->name('kategorilist');
        Route::get('master/kategori/create', 'MasterKategoriController@createView')->name('kategoricreateview');
        Route::post('master/kategori/create', 'MasterKategoriController@create')->name('kategoricreate');
        Route::get('master/kategori/edit', 'MasterKategoriController@editView')->name('kategorieditview');
        Route::post('master/kategori/edit', 'MasterKategoriController@edit')->name('kategoriedit');
        Route::post('master/kategori/delete', 'MasterKategoriController@delete')->name('kategoridelete');

        Route::get('master/jenis', 'MasterJenisController@index')->name('jenislist');
        Route::get('master/jenis/create', 'MasterJenisController@createView')->name('jeniscreateview');
        Route::post('master/jenis/create', 'MasterJenisController@create')->name('jeniscreate');
        Route::get('master/jenis/edit', 'MasterJenisController@editView')->name('jeniseditview');
        Route::post('master/jenis/edit', 'MasterJenisController@edit')->name('jenisedit');
        Route::post('master/jenis/delete', 'MasterJenisController@delete')->name('jenisdelete');

        Route::get('master/unit', 'MasterUnitController@index')->name('unitlist');
        Route::get('master/unit/create', 'MasterUnitController@createView')->name('unitcreateview');
        Route::post('master/unit/create', 'MasterUnitController@create')->name('unitcreate');
        Route::get('master/unit/edit', 'MasterUnitController@editView')->name('uniteditview');
        Route::post('master/unit/edit', 'MasterUnitController@edit')->name('unitedit');
        Route::post('master/unit/delete', 'MasterUnitController@delete')->name('unitdelete');

        Route::get('master/aplikasi', 'MasterAplikasiController@index')->name('aplikasilist');
        Route::get('master/aplikasi/create', 'MasterAplikasiController@createView')->name('aplikasicreateview');
        Route::post('master/aplikasi/create', 'MasterAplikasiController@create')->name('aplikasicreate');
        Route::get('master/aplikasi/edit', 'MasterAplikasiController@editView')->name('aplikasieditview');
        Route::post('master/aplikasi/edit', 'MasterAplikasiController@edit')->name('aplikasiedit');
        Route::post('master/aplikasi/delete', 'MasterAplikasiController@delete')->name('aplikasidelete');
    });

    Route::group(['as' => 'monitoringaplikasi.'], function () {
        Route::get('monitoringaplikasi', 'MonitoringaplikasiController@index')->name('index');
//        Route::post('department/toggle', 'MonitoringaplikasiController@toggle')->name('toggle');
        Route::get('monitoringaplikasi/create', 'MonitoringaplikasiController@create')->name('create');
        Route::post('monitoringaplikasi/store', 'MonitoringaplikasiController@store')->name('store');
        Route::get('monitoringaplikasi/edit/{id}', 'MonitoringaplikasiController@edit')->name('edit');
        Route::post('monitoringaplikasi/update/{id}', 'MonitoringaplikasiController@update')->name('update');
        Route::get('monitoringaplikasi/ubahstatus', 'MonitoringaplikasiController@ubahstatus')->name('ubahstatus');
        Route::get('monitoringaplikasi/kirimstatus', 'MonitoringaplikasiController@kirimstatus')->name('kirimstatus');
        Route::post('monitoringaplikasi/kirimstatus', 'MonitoringaplikasiController@kirimstatus')->name('kirimstatus');
        Route::get('monitoringaplikasi/create', 'MonitoringaplikasiController@createView')->name('aplikasicreateview');
        Route::post('monitoringaplikasi/create', 'MonitoringaplikasiController@create')->name('create');
    });

    /**
     * Setting Modul Routes
     * route('backend.berita.*')
     */
    Route::group(['as' => 'berita.'], function () {
        Route::get('berita', 'BeritaController@index')->name('index');
        Route::get('berita/edit/{id}', 'BeritaController@edit')->name('edit');
        Route::post('berita/update/{id}', 'BeritaController@update')->name('update');
        Route::get('berita/create', 'BeritaController@create')->name('create');
        Route::post('berita/store', 'BeritaController@store')->name('store');
        Route::post('berita/delete','BeritaController@delete')->name('deleteberita');
    });

    /**
     * Setting Modul Routes
     * route('backend.jaringan.*')
     */
    Route::group(['as' => 'jaringan.'], function () {
        Route::get('jaringan', 'JaringanController@index')->name('index');
        Route::get('jaringan/detail', 'JaringanController@detail')->name('detail');
        Route::get('jaringan/create', 'jaringanController@createView')->name('jaringancreateview');
        Route::post('jaringan/create', 'jaringanController@create')->name('jaringancreate');
        Route::get('jaringan/edit', 'jaringanController@editView')->name('jaringaneditview');
        Route::post('jaringan/edit', 'jaringanController@edit')->name('jaringanedit');
        Route::post('jaringan/delete', 'jaringanController@delete')->name('jaringandelete');

    });

    Route::group(['as' => 'monitoringjaringan.'], function () {
        Route::get('monitoringjaringan', 'MonitoringjaringanController@index')->name('index');
        Route::get('monitoringjaringan/create', 'MonitoringjaringanController@create')->name('create');
        Route::post('monitoringjaringan/store', 'MonitoringjaringanController@store')->name('store');
        Route::get('monitoringjaringan/edit/{id}', 'MonitoringjaringanController@edit')->name('edit');
        Route::post('monitoringjaringan/update/{id}', 'MonitoringjaringanController@update')->name('update');
        Route::get('monitoringjaringan/ubahstatus', 'MonitoringjaringanController@ubahstatus')->name('ubahstatus');
        Route::get('monitoringjaringan/kirimstatus', 'MonitoringjaringanController@kirimstatus')->name('kirimstatus');
        Route::post('monitoringjaringan/kirimstatus', 'MonitoringjaringanController@kirimstatus')->name('kirimstatus');
        Route::get('monitoringjaringan/create', 'MonitoringjaringanController@createView')->name('jaringancreateview');
        Route::post('monitoringjaringan/create', 'MonitoringjaringanController@create')->name('create');
    });

    Route::group(['as' => 'monitoringserver.'], function () {
        Route::get('monitoringserver', 'MonitoringServerController@index')->name('index');
        Route::get('monitoringserver/create', 'MonitoringServerController@create')->name('create');
        Route::post('monitoringserver/store', 'MonitoringServerController@store')->name('store');
        Route::get('monitoringserver/edit/{id}', 'MonitoringServerController@edit')->name('edit');
        Route::post('monitoringserver/update/{id}', 'MonitoringServerController@update')->name('update');
        Route::get('monitoringserver/ubahstatus', 'MonitoringServerController@ubahstatus')->name('ubahstatus');
        Route::get('monitoringserver/kirimstatus', 'MonitoringServerController@kirimstatus')->name('kirimstatus');
        Route::post('monitoringserver/kirimstatus', 'MonitoringServerController@kirimstatus')->name('kirimstatus');
        Route::get('monitoringserver/create', 'MonitoringServerController@createView')->name('servercreateview');
        Route::post('monitoringserver/create', 'MonitoringserverController@create')->name('create');
    });


    /**
     * Setting Modul Routes
     * route('backend.berita.*')
     */
    Route::group(['as' => 'kuota.'], function () {
        Route::get('kuota', 'KuotaController@index')->name('index');
        Route::get('kuota/edit', 'KuotaController@edit')->name('edit');
        Route::post('kuota/update', 'KuotaController@update')->name('update');
        Route::get('kuota/create', 'KuotaController@create')->name('create');
        Route::post('kuota/jadwal', 'KuotaController@jadwal')->name('jadwal');
        Route::post('kuota/store', 'KuotaController@store')->name('store');
    });

    /**
     * Setting Modul Routes
     * route('backend.setting.*')
     */
    Route::group(['as' => 'setting.'], function () {
        Route::get('setting', 'SettingController@index')->name('setting');
        Route::post('setting/edit', 'SettingController@edit')->name('settingedit');
    });

});

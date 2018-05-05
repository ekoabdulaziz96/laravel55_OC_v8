<?php


Route::get('api/contact', 'ContactController@apiContact')->name('api.contact');

Route::get('/exportpdf', 'ContactController@exportPDF')->name('contact.exportPDF');

Route::get('/exportexcel', 'ContactController@exportExcel')->name('contact.exportExcel');
Route::post('/importexcel', 'ContactController@importExcel')->name('contact.importExcel');

Route::get('/pdf', function(){
    $pdf = PDF::loadHTML('<h1>Test</h1>');
    return $pdf->stream();
});
// Route::resource('contact','ContactController');
// Route::get('api.contact','ContactController@apiContact')->name('api.contact');

Route::get('auth/activate','Auth\ActivationController@activate')->name('auth.activate');
Route::get('auth/activate/resend','Auth\ActivationResendController@showResendForm')->name('auth.activate.resend');
Route::post('auth/activate/resend','Auth\ActivationResendController@resend');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'HomeController@logoutUser')->name('user.logout');


Route::get('/', function () {
    return view('auth/login');
})->name('log');

Route::get('/form', function () {
    return view('layouts/form');
});
Auth::routes();
Route::resource('contact', 'ContactController', [
  'except' => ['create']
]);
Route::get('api/contact', 'ContactController@apiContact')->name('api.contact');




// ------------------------------------------------------------------
// Route Admin
Route::get('/admin', function () {
    return view('admin/index');
})->name('admin');

Route::resource('admin/status', 'StatusController', [
  'except' => ['create'],
  // 'names' => ['index' => 'admin.index'],
]);
Route::get('api/status', 'StatusController@apiStatus')->name('api.status');

Route::resource('admin/kategori', 'KategoriController', [
  'except' => ['create'],
]);
Route::get('api/kategori', 'KategoriController@apiKategori')->name('api.kategori');

//admin
  // ----------------------------------------------------------------------
  //form
  Route::resource('admin/form', 'FormController',[
    // 'except' => ['create'],
    'names' => ['index' => 'admin.form']
  ]);
  Route::get('api/form/{status}', 'FormController@apiForm')->name('api.form');
  Route::get('admin/form-ft-admin', 'FormController@formFtAdmin')->name('admin.form-ft-admin');
  Route::get('admin/form-ft-sponsorship', 'FormController@formFtSponsorship')->name('admin.form-ft-sponsorship');
  Route::get('admin/form-ka-cabang', 'FormController@formKaCabang')->name('admin.form-ka-cabang');
  Route::get('admin/form-manager', 'FormController@formManager')->name('admin.form-manager');
  Route::get('admin/form-ex-manager', 'FormController@formExManager')->name('admin.form-ex-manager');

//cabang
  Route::resource('admin/cabang', 'CabangController',[
    // 'except' => ['create'],
    'names' => ['index' => 'admin.cabang']
  ]);
  Route::get('api/cabang', 'CabangController@apiCabang')->name('api.cabang');

//user
  Route::resource('admin/user', 'UserController',[
    // 'except' => ['create'],
    'names' => ['index' => 'admin.user']
  ]);
  Route::get('api/user', 'UserController@apiUser')->name('api.user');
  Route::get('admin/user/cabang/{slug}', 'UserController@cabang')->name('admin.user.cabang');
  Route::get('admin/user/foto/{id}', 'UserController@foto')->name('admin.user.foto');
  Route::get('admin/user/password/{id}', 'UserController@password')->name('admin.user.password');

//ft-admin
  // -----------------------------------------------------------------------
  //laporan
  Route::resource('ft-admin/laporan', 'FtAdminController',[
    // 'except' => ['create'],
    'names' => ['index' => 'ft-admin.laporan']
  ]);
  Route::get('api/ft-admin/laporan/{status_laporan}', 'FtAdminController@apiLaporan')->name('api.ft-admin.laporan');
  Route::get('ft-admin/laporan-baru', 'FtAdminController@laporanBaru')->name('ft-admin.laporan.baru');
  Route::get('ft-admin/laporan-proses', 'FtAdminController@laporanProses')->name('ft-admin.laporan.proses');
  Route::get('ft-admin/laporan-perbaikan', 'FtAdminController@laporanPerbaikan')->name('ft-admin.laporan.perbaikan');
  Route::get('ft-admin/laporan-disetujui', 'FtAdminController@laporanDisetujui')->name('ft-admin.laporan.disetujui');
  Route::get('ft-admin/cek/cek', 'FtAdminController@cek')->name('cek');


  // -----------------------------------------------------------------------
  Route::get('admin/adminUser','UsersController@index')->name('adminUser');
  Route::POST('admin/addAdminUser','UsersController@addAdminUser')->name('addAdminUser');
  Route::POST('admin/editAdminUser','UsersController@editAdminUser')->name('editAdminUser');;
  Route::POST('admin/deleteAdminUser','UsersController@deleteAdminUser')->name('deleteAdminUser');;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Form;
use App\Pilihan;
use App\User;
use App\FtAdmin;
use Carbon\Carbon;
  Route::get('/cek', function () {
    // Schema::table('kategori', function (Blueprint $table) {
    //     $table->string('emaill',50);
    // });
        // $input['nama']='c';
        // $input['urutan']=1;
        // $input['tipe']='c';
        // $input['status']='c';
        // $input['slug'] = str_slug('c', '-');
        //     $forms = Form::create($input);
            // $forms = Form::findOrFail(39);

            // // $textarea = ["row"=> 5];
            // $forms->setTextArea()->where('form_id' ,39)->update(['row' => 51]);
            // return 'cek';
    // $count = Pilihan::where('form_id',3)->count();
    // $pilihan = Pilihan::where('form_id',3)->get();
    // $pilihan['count'] = $count;

    // return $pilihan;

    // return substr('keteranganc nama',0,10);
    // return  Form::where('nama','keterangan '.'asd')->get();

     // $input['nama']='c';
     //    $input['urutan']=1;
     //    $input['tipe']='c';
     //    $input['status']='c';
     //    $input['view']='c';
     //    $input['slug'] = str_slug('c', '-');
     //     $forms = Form::create($input);
     //     return 'success';

     // $forms = Form::findOrFail(18);
     // return $forms->setTextArea()->count();

    // Schema::table('ft-admin', function (Blueprint $table) {
    //     $table->renameColumn('1','12');
    // });

//     Schema::table('ft_admin', function($table)
// { $s = 12;
//     $table->renameColumn("12",'123sss');
// });
//     return 'success';
    // unlink(public_path('/upload/foto/d.jpg'));
    // return 'sukses';

    // $cek  = FtAdmin::findOrFail(1);
    // $create = strtotime($cek->create);
    // $expired = strtotime($cek->expired) - strtotime($cek->create);

    // $cr= date('Y-m-d',$create);
    // // return $cek->create.'|'.$create.'|'.$cr;
    // return date('d',$expired);

    //  $forms = Form::findOrFail(14);
    // $textarea = $forms->setTextArea->first();
    // return $textarea->row;
    // $a = Carbon::now()->addDays(7) ;
    // $b = Carbon::now();
    // return  $a->diffInDays($b).$a.$b;

            $input['expired_at'] = Carbon::now()->addDays(7);
            $input['status_laporan'] = "baru";

            $user = User::findOrFail(2);
            $user->ftAdmin()->create($input);
            return 'cek';

});

Route::get('/coba', function () {
    return view('admin.coba');
})->name('coba');

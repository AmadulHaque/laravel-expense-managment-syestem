<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TransactionController;


Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/register', function () {
    // return redirect('/login');
// });


 Route::middleware('auth')->group(function(){
  Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard','adminDashboard')->name('dashboard');
    Route::get('/admin/logout', 'adminLogout')->name('admin.logout');
    Route::get('/admin/profile', 'adminProfile')->name('admin.profile');
    Route::post('/admin/profile/update', 'AdminProfileUpdate')->name('admin.profile.update');
    //
    Route::get('/admin/change/password', 'AdminChangePassword')->name('admin.change.password');
    Route::post('/admin/update/password', 'AdminUpdatePassword')->name('update.password');
  });


  Route::controller(UserController::class)->group(function () {
    Route::get('/users','userAll')->name('userAll');
    Route::post('/user/store','userStore')->name('userStore');
    Route::get('/user/edit/{id}','userEdit')->name('userEdit');
    Route::post('/user/update','userUpdate')->name('userUpdate');
    Route::get('/user/remove/{id}','userRemove')->name('userRemove');


    Route::get('/user/role/manage','roleMnage')->name('roleMnage');
    Route::get('/add/role/permission','AddRolePermission')->name('AddRolePermission');
    Route::get('/edit/role/permission/{id}','EditRolePermission')->name('EditRolePermission');
    Route::post('/user/role/store','roleStore')->name('roleStore');
    Route::post('/user/role/update/{id}','UpdateRolePermission')->name('UpdateRolePermission');
    Route::get('/role/permission/remove/{id}','RemoveRolePermission')->name('RemoveRolePermission');

  });

  Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories','CategoryAll')->name('CategoryAll');
    Route::post('/categorie/store','CategoryStore')->name('CategoryStore');
    Route::get('/categorie/edit/{id}','CategoryEdit')->name('CategoryEdit');
    Route::post('/categorie/update','CategoryUpdate')->name('CategoryUpdate');
    Route::get('/categorie/remove/{id}','CategoryRemove')->name('CategoryRemove');
  });


  Route::controller(TransactionController::class)->group(function () {
    Route::get('/transactions','TransactionAll')->name('TransactionAll');
    Route::post('/transactions/store','TransactionStore')->name('TransactionStore');
    Route::get('/transactions/edit/{id}','TransactionEdit')->name('TransactionEdit');
    Route::post('/transactions/update','TransactionUpdate')->name('TransactionUpdate');
    Route::get('/transactions/remove/{id}','TransactionRemove')->name('TransactionRemove');
  });


  Route::controller(PurchaseController::class)->group(function () {
    Route::get('/purchases','purchasesAll')->name('purchasesAll');
    Route::post('/purchases/store','purchasestore')->name('purchasestore');
    Route::get('/purchases/edit/{id}','purchasesEdit')->name('purchasesEdit');
    Route::post('/purchases/update','purchasesUpdate')->name('purchasesUpdate');
    Route::get('/purchases/remove/{id}','purchasesRemove')->name('purchasesRemove');
  });

  // settings All Route
  Route::controller(SettingController::class)->group(function () {
      Route::get('/settings', 'GetSetting')->name('GetSetting');
      Route::post('/setting/update', 'updateSetting')->name('updateSetting');
      //////////
      Route::get('/setting/header_bg', 'SettingHeader')->name('SettingHeader');
      Route::get('/setting/sideber_bg', 'SettingSideber')->name('SettingSideber');
  });
}); // End Group Middleware






require __DIR__.'/auth.php';

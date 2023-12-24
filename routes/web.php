<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
App::setLocale('ar');

Route::get('/login', function () {
    return view('public.auth.login');
})->name('login');

Route::get('/', function () {
    return view('public.auth.login');
})->name('home');

Route::post('/login', [\App\Http\Controllers\Public\AuthController::class, 'login_action'])->name('login.action');

// this to show QR for users & download it
Route::get('/visitor/{id}', [\App\Http\Controllers\Public\GuestsController::class, 'show_user_details'])->name('visitor.action');

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function () {

    // QR 
    Route::get('/qr/list', [\App\Http\Controllers\Admin\QrCodesController::class, 'list'])->name('admin.qr.list');
    Route::get('/qr/select_type', [\App\Http\Controllers\Admin\QrCodesController::class, 'select_type'])->name('admin.qr.select_type');    
    Route::get('/qr/create/{type?}', [\App\Http\Controllers\Admin\QrCodesController::class, 'create'])->name('admin.qr.create');
    Route::post('/qr/create/action', [\App\Http\Controllers\Admin\QrCodesController::class, 'create_action'])->name('admin.qr.create.action');
    Route::get('/qr/show/{id}', [\App\Http\Controllers\Admin\QrCodesController::class, 'show'])->name('admin.qr.show');
    Route::get('/qr/edit/{id}', [\App\Http\Controllers\Admin\QrCodesController::class, 'edit'])->name('admin.qr.edit');
    Route::post('/qr/edit/{id}/action', [\App\Http\Controllers\Admin\QrCodesController::class, 'edit_action'])->name('admin.qr.edit.action');
    Route::delete('/qr/delete/{qr_code}', [\App\Http\Controllers\Admin\QrCodesController::class, 'delete'])->name('admin.qr.delete');
    
    Route::get('/qr/download/{id}', [\App\Http\Controllers\Shared\QrContoller::class, 'generateQrPublic'])->name('admin.qr.download');

    // guests 
    Route::get('/guest/list', [\App\Http\Controllers\Admin\GuestsController::class, 'list'])->name('admin.guest.list');
    Route::get('/guest/create', [\App\Http\Controllers\Admin\GuestsController::class, 'create'])->name('admin.guest.create');
    Route::post('/guest/create/action', [\App\Http\Controllers\Admin\GuestsController::class, 'create_action'])->name('admin.guest.create.action');
    Route::get('/guest/edit/{user}', [\App\Http\Controllers\Admin\GuestsController::class, 'edit'])->name('admin.guest.edit');
    Route::post('/guest/edit/{user}/action', [\App\Http\Controllers\Admin\GuestsController::class, 'edit_action'])->name('admin.guest.edit.action');
    Route::delete('/guest/delete/{user}', [\App\Http\Controllers\Admin\GuestsController::class, 'delete'])->name('admin.guest.delete');
    
    // Upload XLSX
    Route::get('/guest/upload', [\App\Http\Controllers\Admin\GuestsController::class, 'upload'])->name('admin.guest.upload');
    Route::post('/guest/upload/action', [\App\Http\Controllers\Admin\GuestsController::class, 'upload_action'])->name('admin.guest.upload.action');
    
    // geneate QR
    Route::post('/generate/qr', [\App\Http\Controllers\Shared\QrContoller::class, 'generateQrCode'])->name('admin.qr.generate');

    // generate CSV file
    Route::get('/export-csv', [\App\Http\Controllers\Admin\ExportController::class, 'exportToCSV'])->name('admin.export.csv');
    Route::get('/export-csv/attends', [\App\Http\Controllers\Admin\ExportController::class, 'exportAttendsToCSV'])->name('admin.export.attends.csv');

    // visits
    Route::get('/guest/visits', [\App\Http\Controllers\Admin\GuestsController::class, 'visits'])->name('admin.guest.visits');
    
    // check visits
    Route::get('/guest/check/visit/{id}', [\App\Http\Controllers\Admin\GuestsController::class, 'check'])->name('admin.guest.visits.check');
    Route::post('/guest/check/visit/confirm/{id}', [\App\Http\Controllers\Admin\GuestsController::class, 'confirm'])->name('admin.guest.visits.confirm');

    // profile settings
    Route::get('/profile', [\App\Http\Controllers\Shared\SettingsController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/update', [\App\Http\Controllers\Shared\SettingsController::class, 'update_profile'])->name('admin.profile.update');
         
    // password
    Route::get('/password', [\App\Http\Controllers\Shared\SettingsController::class, 'password'])->name('admin.password');
    Route::post('/password/update', [\App\Http\Controllers\Shared\SettingsController::class, 'update_password'])->name('admin.password.update');
    
    // Logout
    Route::get('/logout', [\App\Http\Controllers\Public\AuthController::class, 'logout'])->name('admin.logout');

});
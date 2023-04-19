<?php

use App\Http\Controllers\SimbeyeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/user', function () {
//     return view('simbeye.user-dashboard');
// })->name('user');

// Route::get('/rfid', function () {
//     return view('simbeye.admin-dashboard');
// })->name('rfid');

// Route::get('/rfid/add',[SimbeyeController::class,'rfidAdd'])->name('rfid-add');
// Route::get('/rfid/{id}',[SimbeyeController::class,'rfidView'])->name('rfid-view');
Route::get('/rfid/user', function () {
    return view('simbeye.user-dashboard');
})->name('user');

Route::get('/rfids',[SimbeyeController::class,'dashboard'])->name('rfid');
Route::get('/rfids/management',[SimbeyeController::class,'management'])->name('manage');
Route::get('/rfids/report',[SimbeyeController::class,'report'])->name('report');
Route::get('/rfids/report/download/{payload}',[SimbeyeController::class,'downloadPdf'])->name('download-report');

Route::get('/rfids/add',[SimbeyeController::class,'rfidAdd'])->name('rfid-add');
Route::get('/rfids/{id}',[SimbeyeController::class,'rfidView'])->name('rfid-view');

Route::get('down', [SimbeyeController::class, 'simbeyePdf']);

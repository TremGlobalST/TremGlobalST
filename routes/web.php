<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\MeetController as AdminMeetController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {
   Route::get('/', [AdminHomeController::class, 'index'])->name('admin_login');

   Route::group(['prefix' => '/rooms'], function () {
       Route::get('/list', [AdminRoomController::class, 'listing'])->name('rooms');
       Route::get('/add', [AdminRoomController::class, 'add'])->name('room_add');
       Route::post('/save', [AdminRoomController::class, 'save'])->name('room_save');
       Route::get('/edit/{id}', [AdminRoomController::class, 'edit'])->name('room_edit');
       Route::post('/update/{room}', [AdminRoomController::class, 'update'])->name('room_update');
       Route::get('/{room}', [AdminRoomController::class, 'detail'])->name('room');
   });

   Route::group(['prefix' => '/meets'], function () {
       Route::get('/add', [AdminMeetController::class, 'add'])->name('meet_add');
       Route::post('/save', [AdminMeetController::class, 'save'])->name('meet_save');
       Route::get('/listing', [AdminMeetController::class, 'listing'])->name('meets');
       Route::get('/edit/{meet}', [AdminMeetController::class, 'edit'])->name('meet_edit');
       Route::post('/update/{meet}', [AdminMeetController::class, 'update'])->name('meet_update');
       Route::get('/{meet}', [AdminMeetController::class, 'detail'])->name('meet');
   });
});

require __DIR__.'/auth.php';

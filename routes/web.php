<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\MeetController as AdminMeetController;
use App\Http\Controllers\Admin\TvScreenController as AdminTvScreenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TvScreenController;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/room/{slug}', [RoomController::class, 'room'])->name('room');
Route::post('/api/room/{id}/meet', [RoomController::class, 'meet']);
Route::get('/sunum', function() {
    return View('sunum');
});
Route::get('/tv-screen', [TvScreenController::class, 'index'])->name('tv_screen');

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {
   Route::get('/', [AdminHomeController::class, 'index'])->name('admin');

   Route::get('/tv-screen', [AdminTvScreenController::class, 'index'])->name('video_add');
   Route::post('/tv-screen', [AdminTvScreenController::class, 'save'])->name('video_save');

   Route::group(['prefix' => '/rooms'], function () {
       Route::get('/listing', [AdminRoomController::class, 'listing'])->name('rooms');
       Route::get('/add', [AdminRoomController::class, 'add'])->name('room_add');
       Route::post('/save', [AdminRoomController::class, 'save'])->name('room_save');
       Route::get('/edit/{id}', [AdminRoomController::class, 'edit'])->name('room_edit');
       Route::post('/update/{room}', [AdminRoomController::class, 'update'])->name('room_update');
       Route::get('/delete/{id}', [AdminRoomController::class,'delete'])->name('room_delete');
   });

   Route::group(['prefix' => '/meets'], function () {
       Route::get('/add', [AdminMeetController::class, 'add'])->name('meet_add');
       Route::post('/save', [AdminMeetController::class, 'save'])->name('meet_save');
       Route::get('/listing', [AdminMeetController::class, 'listing'])->name('meets');
       Route::get('/edit/{meet}', [AdminMeetController::class, 'edit'])->name('meet_edit');
       Route::post('/update/{meet}', [AdminMeetController::class, 'update'])->name('meet_update');
   });
});

require __DIR__.'/auth.php';

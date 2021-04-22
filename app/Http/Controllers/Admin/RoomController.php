<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;


class RoomController extends Controller
{
    public function listing()
    {
        Room::create([
            'title' => 'deneme odası',
        ]);
        return View('admin.room.listing');
    }

    public function detail(Room $room)
    {
        dd($room);
    }
}

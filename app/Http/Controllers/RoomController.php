<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Meet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function room($slug)
    {
        $room = Room::where('slug', $slug)->first();
        return View('room', ['room' => $room]);
    }

    public function meet($id)
    {
        $meet = Meet::where('room_id', $id)
            ->where('end_date', '>', new \DateTime('now'))
            ->where('start_date', '<', new \DateTime('tomorrow'))
            ->first();
        return json_encode($meet);
    }
}

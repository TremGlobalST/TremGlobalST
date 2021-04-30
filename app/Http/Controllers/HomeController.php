<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $rooms = Room::with('meets')->get();

        $roomCollections= [];

        foreach ($rooms as $room) {
            if ($room->meets) {
                foreach ($room->meets as $meet) {
                    array_push($roomCollections, [
                        'title'             => $meet->title . ' - Oda: ' . $room->title,
                        'start'             => $meet->start_date,
                        'end'               => $meet->end_date,
                        'backgroundColor'   => $room->theme,
                        'borderColor'       => $room->theme,
                    ]);
                }
            }
        }

        return View('home', ['rooms' => $rooms, 'events' => $roomCollections]);
    }
}

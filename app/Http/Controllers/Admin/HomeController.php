<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class HomeController extends Controller
{
    public function index()
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
                        'backgroundColor'   => '#f56954',
                        'borderColor'       => '#f56954',
                    ]);
                }
            }
        }

        return View('admin.home', ['events' => $roomCollections]);
    }
}

<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use App\Models\Room;
use Illuminate\Http\Request;


class MeetController extends Controller
{
    public function listing()
    {
        $meets = Meet::orderBy('id', 'desc')->get();
        return View('admin.meet.listing', ['meets' => $meets]);
    }

    public function add()
    {
        $rooms = Room::with('meets')->get();

        $roomCollections= [];

        foreach ($rooms as $room) {
            if ($room->meets) {
                foreach ($room->meets as $item) {
                    array_push($roomCollections, [
                        'title'             => $item->title . ' - Oda: ' . $room->title,
                        'start'             => $item->start_date,
                        'end'               => $item->end_date,
                        'backgroundColor'   => $room->theme,
                        'borderColor'       => $room->theme,
                    ]);
                }
            }
        }

        return View('admin.meet.add', ['rooms' => $rooms, 'events' => $roomCollections]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'room' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $meets = Room::findOrFail($request->input('room'))->meets()->where('status', 'active')->get();

        if (count($meets) > 0) {
            $checkMeet = false;
            foreach ($meets as $item) {
                if ((strtotime($request->input('start_date')) >= strtotime($item->start_date) &&
                    strtotime($request->input('start_date')) <= strtotime($item->end_date)) ||
                    (strtotime($request->input('end_date')) >= strtotime($item->start_date) &&
                        strtotime($request->input('end_date')) <= strtotime($item->end_date))) {
                    $checkMeet = true;
                }
            }
            if ($checkMeet) {
                return back()->withInput()->with('error', 'Toplant?? Kaydedilemedi! Bu saatler i??erisinde odaya toplant?? set edilmi??tir.');
            } else {
                if ($this->_save($request)) {
                    return back()->withInput()->with('success', 'Toplant?? Kaydedildi');
                } else {
                    return back()->withInput()->with('error', 'Toplant?? Kaydedilemedi');
                }
            }
        } else {
            if ($this->_save($request)) {
                return back()->withInput()->with('success', 'Toplant?? Kaydedildi');
            } else {
                return back()->withInput()->with('error', 'Toplant?? Kaydedilemedi');
            }
        }
    }

    public function update(Meet $meet, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'room' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $meets = Room::findOrFail($request->input('room'))->meets()->where('status', 'active')->where('id', '<>', $meet->id)->get();

        if (count($meets) > 0) {
            $checkMeet = false;
            foreach ($meets as $item) {
                if ((strtotime($request->input('start_date')) >= strtotime($item->start_date) &&
                        strtotime($request->input('start_date')) <= strtotime($item->end_date)) ||
                    (strtotime($request->input('end_date')) >= strtotime($item->start_date) &&
                        strtotime($request->input('end_date')) <= strtotime($item->end_date))) {
                    $checkMeet = true;
                }
            }
            if ($checkMeet) {
                return back()->withInput()->with('error', 'Toplant?? G??ncellenemedi! Bu saatler i??erisinde salona toplant?? set edilmi??tir.');
            } else {
                if ($this->_update($meet, $request)) {
                    return back()->withInput()->with('success', 'Toplant?? G??ncellendi');
                } else {
                    return back()->withInput()->with('error', 'Toplant?? G??ncellenemedi');
                }
            }
        } else {
            if ($this->_update($meet, $request)) {
                return back()->withInput()->with('success', 'Toplant?? G??ncellendi');
            } else {
                return back()->withInput()->with('error', 'Toplant?? G??ncellenemedi');
            }
        }
    }

    private function _save(Request $request): bool
    {
        $meet = Meet::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'room_id' => $request->input('room'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ]);


        return (bool) $meet;
    }

    public function edit(Meet $meet)
    {
        $rooms = Room::with('meets')->get();

        $roomCollections= [];

        foreach ($rooms as $room) {
            if ($room->meets) {
                foreach ($room->meets as $item) {
                    array_push($roomCollections, [
                        'title'             => $item->title . ' - Oda: ' . $room->title,
                        'start'             => $item->start_date,
                        'end'               => $item->end_date,
                        'backgroundColor'   => $room->theme,
                        'borderColor'       => $room->theme,
                    ]);
                }
            }
        }

        return View('admin.meet.edit', ['meet' => $meet, 'rooms' => $rooms, 'events' => $roomCollections]);
    }

    private function _update(Meet $meet, Request $request): bool
    {
        $meet->title = $request->input('title');
        $meet->status = $request->input('status');
        $meet->description = $request->input('description');
        $meet->room_id = $request->input('room');
        $meet->start_date = $request->input('start_date');
        $meet->end_date = $request->input('end_date');
        $updated = $meet->save();


        return (bool) $updated;
    }
}

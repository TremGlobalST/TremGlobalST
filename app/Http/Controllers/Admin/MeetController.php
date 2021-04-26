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
        return View('admin.meet.add', ['rooms' => $rooms]);
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
            foreach ($meets as $meet) {
                if ((strtotime($request->input('start_date')) >= strtotime($meet->start_date) &&
                    strtotime($request->input('start_date')) <= strtotime($meet->end_date)) ||
                    (strtotime($request->input('end_date')) >= strtotime($meet->start_date) &&
                        strtotime($request->input('end_date')) <= strtotime($meet->end_date))) {
                    $checkMeet = true;
                }
            }
            if ($checkMeet) {
                return back()->withInput()->with('error', 'Toplantı Kaydedilemedi! Bu saatler içerisinde ododaaya toplantı set edilmiştir.');
            } else {
                if ($this->_save($request)) {
                    return back()->withInput()->with('success', 'Toplantı Kaydedildi');
                } else {
                    return back()->withInput()->with('error', 'Toplantı Kaydedilemedi');
                }
            }
        } else {
            if ($this->_save($request)) {
                return back()->withInput()->with('success', 'Toplantı Kaydedildi');
            } else {
                return back()->withInput()->with('error', 'Toplantı Kaydedilemedi');
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
                return back()->withInput()->with('error', 'Toplantı Güncellenemedi! Bu saatler içerisinde salona toplantı set edilmiştir.');
            } else {
                if ($this->_update($meet, $request)) {
                    return back()->withInput()->with('success', 'Toplantı Güncellendi');
                } else {
                    return back()->withInput()->with('error', 'Toplantı Güncellenemedi');
                }
            }
        } else {
            if ($this->_update($meet, $request)) {
                return back()->withInput()->with('success', 'Toplantı Güncellendi');
            } else {
                return back()->withInput()->with('error', 'Toplantı Güncellenemedi');
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
        return View('admin.meet.edit', ['meet' => $meet, 'rooms' => $rooms]);
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

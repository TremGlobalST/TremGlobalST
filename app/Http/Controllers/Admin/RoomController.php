<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Meet;
use Illuminate\Http\Request;


class RoomController extends Controller
{
    public function add()
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
        return View('admin.room.add', ['events' => $roomCollections]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'title'         => 'required',
        ]);

        $room = Room::create([
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'theme'         => $request->input('theme'),
        ]);

        if ($room) {
            return back()->withInput()->with('success', 'Oda Kaydedildi');
        } else {
            return back()->withInput()->with('error', 'Oda Kaydedilirken Hata oluştu!');
        }
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $roomCollections= [];
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

        return View('admin.room.edit', ['room' => $room, 'events' => $roomCollections]);
    }

    public function update(Room $room, Request $request)
    {
        $request->validate([
            'title'         => 'required',
        ]);

        $room->title = $request->input('title');
        $room->description = $request->input('description');
        $room->theme = $request->input('theme');

        $save = $room->save();

        if ($save) {
            return back()->withInput()->with('success', 'Oda Bilgileri Güncellendi.');
        } else {
            return back()->withInput()->with('error', 'Oda Bilgileri Güncellenirken Bir Hata Oluştu!');
        }
    }

    public function delete($id)
    {
        $room = Room::findOrFail($id);

        if ($room->delete()) {
            return back()->with('success', 'Oda Silindi!');
        } else {
            return back()->with('error', 'Oda Silinemedi');
        }
    }

    public function listing()
    {
        $rooms = Room::with('meets')->orderBy('id', 'DESC')->get();
        return View('admin.room.listing', ['rooms' => $rooms]);
    }
}

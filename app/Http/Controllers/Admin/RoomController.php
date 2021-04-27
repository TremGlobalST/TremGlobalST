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
        return View('admin.room.add');
    }

    public function save(Request $request)
    {
        $request->validate([
            'title'         => 'required',
        ]);

        $room = Room::create([
            'title' => $request->input('title'),
            'description'   => $request->input('description'),
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
        return View('admin.room.edit', ['room' => $room]);
    }

    public function update(Room $room, Request $request)
    {
        $request->validate([
            'title'         => 'required',
        ]);

        $room->title = $request->input('title');
        $room->description = $request->input('description');

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

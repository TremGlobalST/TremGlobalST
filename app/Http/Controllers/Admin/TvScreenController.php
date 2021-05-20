<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TvScreen;

class TvScreenController extends Controller
{
    public function index()
    {
        $tv = TvScreen::first();
        return View('admin.tv_screen', ['tv' => $tv]);
    }

    public function save(Request $request)
    {
        $request->validate(['code' => 'required']);

        $tv = TvScreen::first();
        $tv->code = $request->input('code');
        
        if ($tv->save()) {
            return back()->withInput()->with('success', 'Ekran Kaydedildi');
        } else {
            return back()->withInput()->with('error', 'Ekran Kaydedilirken Hata oluştu!');
        }
    }
}
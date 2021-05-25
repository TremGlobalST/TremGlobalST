<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Welcome;

class WelcomeController extends Controller
{
    public function index()
    {
        $welcome = Welcome::first();
        return View('admin.welcome', ['welcome' => $welcome]);
    }

    public function save(Request $request)
    {
        $welcome = Welcome::first();
        $welcome->header_image = $request->input('header_image');
        $welcome->code = $request->input('code');
        $welcome->welcome_text = $request->input('welcome_text');
        $welcome->welcome_sub_text = $request->input('welcome_sub_text');
        
        if ($welcome->save()) {
            return back()->withInput()->with('success', 'Ekran Kaydedildi');
        } else {
            return back()->withInput()->with('error', 'Ekran Kaydedilirken Hata oluştu!');
        }
    }
}

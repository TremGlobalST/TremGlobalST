<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TvScreen;

class TvScreenController extends Controller
{
    public function index()
    {
        $tv = TvScreen::first();
        return View('tv_screen', ['tv' => $tv]);
    }
}

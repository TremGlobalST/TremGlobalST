<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Welcome;

class WelcomeController extends Controller
{
    public function index()
    {
        $welcome = Welcome::where('corporate', 'tremglobal')->first();
        return View('welcome', ['welcome' => $welcome]);
    }

    public function indexTremTurkey()
    {
        $welcome = Welcome::where('corporate', 'tremturkey')->first();
        return View('welcome_tremturkey', ['welcome' => $welcome]);
    }

    public function staticImage()
    {
        return View('static');
    }
}

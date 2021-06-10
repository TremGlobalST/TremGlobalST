<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Welcome;

class WelcomeController extends Controller
{
    public function index()
    {
        $welcome = Welcome::first();
        return View('welcome', ['welcome' => $welcome]);
    }

    public function staticImage()
    {
        return View('static');
    }
}

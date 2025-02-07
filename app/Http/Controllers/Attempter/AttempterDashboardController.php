<?php

namespace App\Http\Controllers\Attempter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttempterDashboardController extends Controller
{
    public function index(){
        return view('attempter.dashboard');
    }
}

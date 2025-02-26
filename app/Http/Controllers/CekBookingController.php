<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekBookingController extends Controller
{
    //
    public function index()
    {
        return view('pages.check-booking.index');
    }
}

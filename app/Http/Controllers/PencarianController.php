<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    //
    public function index()
    {
        $kategori = Kategori::orderBy('kategori', 'asc')->get();
        $lokasi = Lokasi::orderBy('slug', 'asc')->get();

        return view('pages.pencarian.index', compact('kategori', 'lokasi'));
    }
}

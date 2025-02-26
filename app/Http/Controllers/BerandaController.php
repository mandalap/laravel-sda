<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kelompok;
use App\Models\Lokasi;
use App\Models\Project;

class BerandaController extends Controller
{
    //
    public function beranda()
    {
        $kelompoks = Kelompok::all();
        $kota = Lokasi::all();
        $kategories = Kategori::orderBy('kategori', 'desc')->get();

        $projects = Project::where('status', 'tampil')
                ->where('is_approved', 'Diterima')
                ->whereHas('project_product', function($query) {
                    $query->where('status', 'Tersedia');
                })->get();

        $cities = Lokasi::limit(6)->inRandomOrder()->get();

        $kavling = Project::where('status', 'tampil')
            ->where('is_approved', 'Diterima')
            ->whereHas('project_product', function($query) {
                    $query->where('status', 'Tersedia');
                })
            ->whereHas('kategori', function($query) {
                $query->where('slug', 'tanah-kavling');  // Pastikan kolom kategori sesuai
                })
            ->get();

        $rumah = Project::where('status', 'tampil')
            ->where('is_approved', 'Diterima')
            ->whereHas('project_product', function($query) {
            $query->where('status', 'Tersedia');
            })
            ->whereHas('kategori', function($query) {
                $query->where('slug', 'rumah');  // Pastikan kolom kategori sesuai
                })
            ->get();

        return view('pages.beranda.index', compact(
            'projects',
            'cities',
            'kavling',
            'rumah',
            'kategories',
            'kelompoks',
            'kota',
        ));
    }
}

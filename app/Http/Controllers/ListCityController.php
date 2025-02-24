<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Project;
use Illuminate\Http\Request;

class ListCityController extends Controller
{
    //
    public function tanahkota(){
        $totalcities = Lokasi::count();
        $cities = Lokasi::with('regency')
            ->join('regencies', 'lokasi.regency_id', '=', 'regencies.id') // Bergabung dengan tabel regencies
            ->join('projects', 'lokasi.id', '=', 'projects.lokasi_id') // Bergabung dengan tabel projects
            ->join('kategori', 'projects.kategori_id', '=', 'kategori.id') // Bergabung dengan tabel categories
            ->where('kategori.kategori', 'tanah kavling') // Menambahkan kondisi untuk kategori
            ->orderBy('regencies.name', 'asc') // Urutkan berdasarkan nama dari tabel regencies
            ->select('lokasi.*', 'regencies.name as regency_name') // Memilih kolom dari tabel lokasi dan nama dari tabel regencies
            ->distinct() // Menghindari duplikasi lokasi jika ada lebih dari satu proyek
            ->get();
        return view("pages.city.tanah", compact('cities', 'totalcities'));
    }

    public function detailtanakota($slug){
        $city = Lokasi::where('slug', $slug)->firstOrFail();
        $projects = Project::where('lokasi_id', $city->id)->get();

        return view("pages.city.detail", compact('city', 'projects'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kelompok;
use App\Models\Lokasi;
use App\Models\Project;
use Illuminate\Http\Request;

class ListCityController extends Controller
{
    //
    public function kategori($slug){
        $kategori = Kategori::where('slug', $slug)->firstOrFail();

        $totalcities = Lokasi::count();

        $cities = Lokasi::with('regency')
            ->join('regencies', 'lokasi.regency_id', '=', 'regencies.id') // Bergabung dengan tabel regencies
            ->join('projects', 'lokasi.id', '=', 'projects.lokasi_id') // Bergabung dengan tabel projects
            ->join('kategori', 'projects.kategori_id', '=', 'kategori.id') // Bergabung dengan tabel categories
            ->where('kategori.kategori', $kategori->kategori) // Menambahkan kondisi untuk kategori
            ->where('projects.is_approved', 'Diterima')
            ->where('projects.status', 'tampil')
            ->orderBy('regencies.name', 'asc') // Urutkan berdasarkan nama dari tabel regencies
            ->select('lokasi.*', 'regencies.name as regency_name') // Memilih kolom dari tabel lokasi dan nama dari tabel regencies
            ->distinct() // Menghindari duplikasi lokasi jika ada lebih dari satu proyek
            ->get();

        return view("pages.city.kategori", compact('cities', 'totalcities', 'kategori'));
    }

    public function detailkategori($kategori, $slug){
        $kategori = Kategori::where('slug', $kategori)->firstOrFail();
        $city = Lokasi::where('slug', $slug)->firstOrFail();
        $projects = Project::where('lokasi_id', $city->id)
                ->where('is_approved', 'Diterima')
                ->where('status', 'tampil')
                ->get();
        return view("pages.city.detail", compact('city', 'projects', 'kategori'));
    }

    public function lihat(Request $request)
    {
        $slug = $request->query('propertiType');
        $kelompok = Kelompok::where('slug', $slug)->firstOrFail();
        $projects = Project::where('kelompok_id', $kelompok->id)
                ->where('is_approved', 'Diterima')
                ->where('status', 'tampil')
                ->get();
        $projectCount = $projects->count();
        return view("pages.lihatsemua.index", compact('projects', 'kelompok', 'projectCount'));
    }

    public function lihatkota(Request $request)
    {
        $totalcities = Lokasi::count();

        $cities = Lokasi::with('regency')
            ->join('regencies', 'lokasi.regency_id', '=', 'regencies.id') // Bergabung dengan tabel regencies
            ->join('projects', 'lokasi.id', '=', 'projects.lokasi_id') // Bergabung dengan tabel projects
            ->where('projects.is_approved', 'Diterima')
            ->where('projects.status', 'tampil')
            ->orderBy('regencies.name', 'asc') // Urutkan berdasarkan nama dari tabel regencies
            ->select('lokasi.*', 'regencies.name as regency_name') // Memilih kolom dari tabel lokasi dan nama dari tabel regencies
            ->distinct() // Menghindari duplikasi lokasi jika ada lebih dari satu proyek
            ->get();

        return view("pages.city.kota", compact('cities', 'totalcities'));
    }

    public function properti(Request $request)
    {
        $slug = $request->query('citiesType');
        $city = Lokasi::where('slug', $slug)->firstOrFail();
        $projects = Project::where('lokasi_id', $city->id)
                ->where('is_approved', 'Diterima')
                ->where('status', 'tampil')
                ->get();

        $projectCount = $projects->count();
        return view("pages.city.properti", compact('projects', 'city', 'projectCount'));
    }

}

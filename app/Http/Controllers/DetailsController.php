<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectFasilitas;
use App\Models\ProjectPhoto;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    //
    public function index($jenis, $kategori, $project)
    {

        $jenis = Jenis::where('slug', $jenis)->firstOrFail();

        $kategori = Kategori::where('slug', $kategori)->firstOrFail();

        $project = Project::where("slug", $project)->firstOrFail();
        $facilities = ProjectFasilitas::where('project_id', $project->id)->get();
        $photos = ProjectPhoto::where('project_id', $project->id)->get();

        return view("pages.details.index", compact('project', 'photos', 'facilities', 'kategori'));
    }

    public function custinfo($jenis, $kategori, $project)
    {
        $jenis = Jenis::where('slug', $jenis)->firstOrFail();
        $kategori = Kategori::where('slug', $kategori)->firstOrFail();
        $project = Project::where("slug", $project)->firstOrFail();
        $products = Product::where('project_id', $project->id)->get();
        return view("pages.details.cust-info", compact('project', 'products', 'kategori'));
    }

    public function checkout(Request $request, $project)
    {
        // Mengambil input dari request
        $nama = $request->input('nama');
        $email = $request->input('email');
        $telepon = $request->input('telepon');

        // Mencari project berdasarkan slug
        $project = Project::where("slug", $project)->firstOrFail();

        // Mencari product berdasarkan slug yang diambil dari request
        $product = Product::where("slug", $request->input('product'))->firstOrFail();

        // Mengambil nilai dari input tersembunyi
        $kodeProduct = $request->input('code_product'); // Mengambil nilai dari input tersembunyi

        // Lakukan sesuatu dengan $project, $product, dan $kodeProduct

        // Mengembalikan view dengan data yang diperlukan
        return view("pages.details.checkout", compact('project', 'product', 'nama', 'email', 'telepon'));
    }
}

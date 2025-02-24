<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectFasilitas;
use App\Models\ProjectPhoto;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    //
    public function index($slug)
    {
        $project = Project::where("slug", $slug)->firstOrFail();
        $facilities = ProjectFasilitas::where('project_id', $project->id)->get();
        $photos = ProjectPhoto::where('project_id', $project->id)->get();

        return view("pages.details.index", compact('project', 'photos', 'facilities'));
    }

    public function custinfo($slug)
    {
        $project = Project::where("slug", $slug)->firstOrFail();
        $products = Product::where('project_id', $project->id)->get();
        return view("pages.details.cust-info", compact('project', 'products'));
    }

    public function checkout($slug, Request $request)
    {
        $project = Project::where("slug", $slug)->firstOrFail();
        $product = Product::where("slug", $request->product)->firstOrFail();

        return view("pages.details.checkout", compact('project', 'product'));
    }
}

<?php

namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use App\Models\Brand;

class AboutUsController extends Controller
{
    public function index()
    {
        $brands = Brand::select('name')->get();

        return view('site.about_us', compact('brands'));
    }
}
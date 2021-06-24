<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Shop;

class HomeController
{
    public function index()
    {
        $categories = Category::all();

        $shops = Shop::with(['categories', 'days'])
                        ->searchResults() ->orderBy('id', 'desc')
                        ->paginate(9);

        $mapShops = $shops->makeHidden(['active', 'created_at', 'updated_at', 'deleted_at', 'created_by_id', 'photos', 'media']);
        $latitude = $shops->count() && (request()->filled('category') || request()->filled('search')) ? $shops->average('latitude') : 16.7744705798;
        $longitude = $shops->count() && (request()->filled('category') || request()->filled('search')) ? $shops->average('longitude') : 96.1587319683;
        return view('admin.home', compact('categories', 'shops', 'mapShops', 'latitude', 'longitude'));
    }
}

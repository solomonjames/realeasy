<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingIndex;
use App\Models\Listing;

class ListingsController extends Controller
{
    public function index(ListingIndex $request)
    {
        $filters = $request->validated();
        $orderBy = $filters['orderBy'] ?? 'price';

        $listings = Listing::withoutIgnored()->orderBy($orderBy, 'DESC')->get();

        return view('listings.index', compact('listings', 'filters', 'orderBy'));
    }
}

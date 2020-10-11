<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
    public function index(Request $request)
    {
        $listings = Listing::withoutIgnored()->orderBy('created_at', 'DESC')->get();

        return view('listings.index', compact('listings'));
    }
}

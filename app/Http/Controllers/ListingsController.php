<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
    public function index(Request $request)
    {
        $listings = Listing::all();

        return view('listings.index', compact('listings'));
    }
}

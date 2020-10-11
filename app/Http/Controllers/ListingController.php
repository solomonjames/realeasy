<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingIndex;
use App\Http\Requests\ListingUpdate;
use App\Models\Listing;

class ListingController extends Controller
{
    public function index(ListingIndex $request)
    {
        $filters = $request->validated();
        $orderBy = $filters['orderBy'] ?? 'price';

        $listings = Listing::withoutIgnored()->orderBy($orderBy, 'DESC')->get();

        return view('listings.index', compact('listings', 'filters', 'orderBy'));
    }

    public function update(ListingUpdate $request, string $id)
    {
        $listing = Listing::findOrFail($id);
        $values = $request->validated();

        $listing->ignore = $values['ignore'];
        $listing->save();

        return response('', 200);
    }
}

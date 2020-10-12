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
        $saved = $filters['saved'] ?? false;

        $listings = Listing::withoutIgnored()
            ->where('saved', $saved)
            ->orderBy($orderBy, 'DESC')
            ->get();

        return view('listings.index', compact('listings', 'filters', 'orderBy', 'saved'));
    }

    public function update(ListingUpdate $request, string $id)
    {
        $listing = Listing::findOrFail($id);
        $values = $request->validated();

        $listing->saved = $values['saved'] ?? $listing->saved;
        $listing->ignore = $values['ignore'] ?? $listing->ignore;
        $listing->save();

        return response('', 200);
    }
}

@extends('layout')

@section('content')
<div class="col-12">
    <form class="form-inline">
        <label class="mr-sm-2" for="selectOrderBy">Order by</label>
        <select id="selectOrderBy" name="orderBy" class="custom-select my-1 mr-sm-2">
            <option value="price" {{ $orderBy === 'price' ? 'selected' : '' }}>Price</option>
            <option value="created_at" {{ $orderBy === 'created_at' ? 'selected' : '' }}>Date added</option>
        </select>

        <button type="submit" class="btn btn-primary my-1">Apply</button>
    </form>
</div>
@foreach($listings as $listing)
<div class="col-md-4" id="listing-{{ $listing->id }}">
    <div class="card mb-4 shadow-sm">
        <a href="{{ $listing->link }}" target="_blank"><img class="card-img-top" src="{{ $listing->media->first() }}" /></a>
        <div class="card-body">
            <h5 class="card-title">{{ $listing->address_street }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $listing->source }}</h6>
            <p class="card-text">
                @if($listing->source === 'corcoran')
                {!! $listing->sink['highlightedText'] !!}
                @endif
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary ignore-button">Ignore</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary save-button">Save</button>
                </div>
                <small class="text-muted">Price: ${{ $listing->price }}</small>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Bedrooms:</strong> {{ $listing->sink['bedrooms'] }}</li>
                <li class="list-group-item"><strong>Bathrooms:</strong> {{ $listing->sink['bathrooms'] }}</li>
                <li class="list-group-item"><strong>Neighborhood:</strong> {{ $listing->sink['neighborhoodName'] }}</li>
            </ul>

            <div class="card-footer text-muted">Added {{ $listing->created_at->fromNow() }}</div>
        </div>
    </div>
</div>
@endforeach
@endsection

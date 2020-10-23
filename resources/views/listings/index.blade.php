@extends('layout')

@section('content')
<div class="col-12">
    <div id="searcher"></div>
</div>
@foreach($listings as $listing)
<div class="col-md-4" id="listing-{{ $listing->id }}">
    <div class="card mb-4 shadow-sm">
        <a href="{{ $listing->link }}" target="_blank"><img class="card-img-top" src="{{ $listing->media->first() }}" /></a>

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary ignore-button bg-danger text-white">Ignore</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary save-button bg-primary text-white">Save</button>
                </div>
                <small class="text-muted"><a href="{{ $listing->link }}" target="_blank">{{ $listing->source }}</a></small>
            </div>
        </div>

        <div class="card-body">
            <h5 class="card-title">{{ $listing->address_street }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">${{ $listing->price }}</h6>
            <p class="card-text">
                @if($listing->source === 'corcoran')
                {!! $listing->sink['highlightedText'] !!}
                @endif

                @if($listing->source === 'compass')
                <p>Amenities: {{ implode(', ', $listing->sink['detailedInfo']['amenities']) }}</p>
                <p>Outdoor: {{ implode(', ', $listing->sink['detailedInfo']['outdoorSpace']) }}</p>
                @endif
            </p>
        </div>

        <div class="card-body">
            <a target="_blank" href="https://www.google.com/maps?q={{ $listing->address }}" class="card-link">Google Maps</a>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">{{ $listing->source }}</small>
            </div>
        </div>

        <div class="card-body">
            <ul class="list-group list-group-flush">
                @if($listing->listed_on)
                <li class="list-group-item"><strong>Listed:</strong> {{ $listing->listed_on->fromNow() }} on {{ $listing->listed_on }}</li>
                @endif
                @if($listing->source === 'corcoran')
                <li class="list-group-item"><strong>Bedrooms:</strong> {{ $listing->sink['bedrooms'] ?? '' }}</li>
                <li class="list-group-item"><strong>Bathrooms:</strong> {{ $listing->sink['bathrooms'] ?? '' }}</li>
                <li class="list-group-item"><strong>Neighborhood:</strong> {{ $listing->sink['neighborhoodName'] ?? '' }}</li>
                @endif

                @if($listing->source === 'compass')
                <li class="list-group-item"><strong>Bedrooms:</strong> {{ $listing->sink['size']['bedrooms'] ?? '' }}</li>
                <li class="list-group-item"><strong>Bathrooms:</strong> {{ $listing->sink['size']['bathrooms'] ?? '' }}</li>
                <li class="list-group-item"><strong>Neighborhood:</strong> {{ $listing->sink['location']['neighborhood'] ?? '' }}</li>
                @endif
            </ul>

            <div class="card-footer text-muted">Added {{ $listing->created_at->fromNow() }}</div>
        </div>
    </div>
</div>
@endforeach
@endsection

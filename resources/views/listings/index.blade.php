@extends('layout')

@section('content')
<div class="top-properties-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline">
                    <label class="mr-sm-2" for="selectOrderBy">Order by</label>
                    <select id="selectOrderBy" name="orderBy" class="custom-select my-1 mr-sm-2">
                        <option value="price" {{ $orderBy === 'price' ? 'selected' : '' }}>Price</option>
                        <option value="created_at" {{ $orderBy === 'created_at' ? 'selected' : '' }}>Date Created</option>
                    </select>

                    <button type="submit" class="btn btn-primary my-1">Apply</button>
                </form>
            </div>
        </div>
        <div class="top-properties-carousel owl-carousel">
        @foreach($listings as $listing)
        <div class="single-top-properties" id="listing-{{ $listing->id }}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="stp-pic">
                        <a href="{{ $listing->link }}" target="_blank"><img src="{{ $listing->media->first() }}" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="stp-text">
                        {{-- <div class="s-text">For Sale</div> --}}
                        <h2>{{ $listing->address_street }}</h2>
                        <div class="room-price">
                            <span>Price:</span>
                            <h4>${{ $listing->price }}</h4>
                        </div>
                        <div class="properties-location"><i class="icon_pin"></i> {{ $listing->address }}</div>

                        @if($listing->source === 'corcoran')
                        <p>{!! $listing->sink['highlightedText'] !!}</p>
                        @endif

                        <button type="button" class="btn btn-secondary ignore-button">Ignore</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>
</div>
@endsection

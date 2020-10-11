@extends('layout')

@section('content')
<div class="top-properties-section spad">
    <div class="container">
        @foreach($listings as $listing)
        <div class="single-top-properties">
            <div class="row">
                <div class="col-lg-6">
                    <div class="stp-pic">
                        <img src="{{ $listing->media->first() }}" alt="" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="stp-text">
                        <div class="s-text">For Sale</div>
                        <h2>{{ $listing->address }}</h2>
                        <div class="room-price">
                            <span>Start From:</span>
                            <h4>${{ $listing->price }}</h4>
                        </div>
                        <div class="properties-location"><i class="icon_pin"></i> 9721 Glen Creek Ave. Ballston Spa, NY</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <ul class="room-features">
                            <li>
                                <i class="fa fa-arrows"></i>
                                <p>5201 sqft</p>
                            </li>
                            <li>
                                <i class="fa fa-bed"></i>
                                <p>8 Bed Room</p>
                            </li>
                            <li>
                                <i class="fa fa-bath"></i>
                                <p>7 Baths Bed</p>
                            </li>
                            <li>
                                <i class="fa fa-car"></i>
                                <p>1 Garage</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

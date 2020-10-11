@extends('layout')

@section('content')
<div class="top-properties-section spad">
    <div class="container">
        <div class="top-properties-carousel owl-carousel">
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

                        <ul class="room-features">
{{--                            <li>--}}
{{--                                <i class="fa fa-arrows"></i>--}}
{{--                                <p>5201 sqft</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <i class="fa fa-bed"></i>--}}
{{--                                <p></p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <i class="fa fa-bath"></i>--}}
{{--                                <p></p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <i class="fa fa-car"></i>--}}
{{--                                <p>1 Garage</p>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>
</div>
@endsection

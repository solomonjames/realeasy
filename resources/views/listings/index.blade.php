@extends('layout')

@section('content')
<table class="table-auto">
    <thead>
        <tr>
            <th>Address</th>
            <th>Price</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
    @foreach($listings as $listing)
        <tr{{ $loop->odd ? 'class="bg-gray-100"' : '' }}>
            <td>{{ $listing->address }}</td>
            <td>{{ $listing->price }}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

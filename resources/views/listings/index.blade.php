<ul>
@foreach($listings as $listing)
    <li>Address: {{ $listing->address }}</li>
    <li>Price: {{ $listing->price }}</li>
@endforeach
</ul>

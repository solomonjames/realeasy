<?php

namespace App\Realtors\Compass;

use App\Models\Listing;
use App\Realtors\RealtorClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;

class CompassClient implements RealtorClient
{
    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::withOptions(['base_uri' => 'https://www.compass.com/']);
    }

    public function listings(): Collection
    {
        $params = [
            'searchResultId' => Uuid::uuid4(),
            'purpose' => 'search',
        ];

        $response = $this->client->asJson()->post(
            'for-rent/cobble-hill-brooklyn-ny/price.max=7k/has-outdoor/keywords=pet/locations=21455,21489,21532,21447,21452,21555,21556/',
            $params
        );

        if (! $response->ok()) {
            return collect();
        }

        $result = $response->json();

        $results = collect($result['lolResults']['data'] ?? []);

        return $results->map(fn($item) => $item['listing']);
    }

    public function dataToModel(array $data): Listing
    {
        $location = $data['location'];
        $price = $data['price'];

        $m = new Listing;

        $m->address = sprintf('%s, Brooklyn, NY %s', $location['prettyAddress'], $location['zipCode']);
        $m->source = 'compass';
        $m->price = $price['listed'];
        $m->media = collect($data['media'] ?? [])->map(fn($item) => $item['originalUrl']);
        $m->sink = $data;

        return $m;
    }
}

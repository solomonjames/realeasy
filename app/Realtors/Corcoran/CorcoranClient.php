<?php

namespace App\Realtors\Corcoran;

use App\Models\Listing;
use App\Realtors\RealtorClient;
use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class CorcoranClient implements RealtorClient
{
    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::withOptions(['base_uri' => 'https://legacy.corcoran.com/api/']);
    }

    public function listings(): Collection
    {
        $params = [
            'page' => 1,
            'pageSize' => 1000,
            'transactionTypes' => ['for-rent'],
            'regionIds' => ['1'],
            'sortBy' => ['recommended+desc'],
            'neighborhoods' => [
                'Crown Heights',
                'Cobble Hill',
                'Brooklyn Heights',
                'Gowanus',
                'Clinton Hill',
                'Park Slope',
                'Fort Greene',
                'Prospect Heights',
                'Carroll Gardens',
            ],
            'address' => [],
            'agentNames' => [],
            'dateTimeOffset' => '-4:0:00',
            'keywordSearch' => 'dishwasher,private-outdoor-space',
            'openHouseDays' => [],
            'zipcodes' => [],
            'citiesOrBoroughs' => [],
            'advertiseNoFee' => null,
            'priceMax' => 5500,
        ];

        $response = $this->client->post('search/listings', $params);

        if (! $response->ok()) {
            return collect();
        }

        $result = $response->json();

        return collect($result['items']);
    }

    public function dataToModel(array $data): Listing
    {
        $m = new Listing;

        $m->address = sprintf('%s, %s, Brooklyn, NY %s', $data['address1'], $data['address2'] ?? '', $data['zipCode']);
        $m->source = 'corcoran';
        $m->price = $data['price'];
        $m->listed_on = isset($data['listedDate']) ? Carbon::parse($data['listedDate']) : null;
        $m->media = collect($data['media'] ?? [])->pluck('url')->all();
        $m->sink = $data;

        return $m;
    }
}

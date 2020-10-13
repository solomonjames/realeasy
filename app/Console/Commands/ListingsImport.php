<?php

namespace App\Console\Commands;

use App\Models\Listing;
use App\Realtors\Compass\CompassClient;
use App\Realtors\Corcoran\CorcoranClient;
use App\Realtors\RealtorClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ListingsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listings:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import listings from all known sources';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $realtors = [
            app(CorcoranClient::class),
            app(CompassClient::class),
        ];

        foreach ($realtors as $realtor) {
            $this->handleRealtor($realtor);
        }

        return 0;
    }

    public function handleRealtor(RealtorClient $realtor)
    {
        $items = $realtor->listings();

        $newItems = $items->map(fn($item, $key) => $realtor->dataToModel($item));

        $savedItems = 0;
        $newItems->each(static function ($item) use ($savedItems) {
            if (Listing::address($item->address)->first()) {
                return;
            }

            $item->save();
            $savedItems++;
        });

        Log::info(sprintf('Import(%s) finished with %s new items.', get_class($realtor), $savedItems));
    }
}

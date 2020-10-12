<?php

namespace App\Console\Commands;

use App\Models\Listing;
use App\Realtors\Corcoran\CorcoranClient;
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
        $corcoran = app(CorcoranClient::class);

        $items = $corcoran->listings();

        $newItems = $items->map(fn($item, $key) => $corcoran->dataToModel($item));

        $savedItems = 0;
        $newItems->each(static function ($item) use ($savedItems) {
            if (Listing::address($item->address)->first()) {
                return;
            }

            $item->save();
            $savedItems++;
        });

        Log::info(sprintf('Import finished with %s new items.', $savedItems));

        return 0;
    }
}

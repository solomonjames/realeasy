<?php

namespace App\Realtors;

use App\Models\Listing;
use Illuminate\Support\Collection;

interface RealtorClient
{
    public function listings(): Collection;

    public function dataToModel(array $data): Listing;
}

<?php

use Carbon\Carbon;

if (! function_exists('carbon')) {
    function carbon(string $date) {
        return Carbon::parse($date);
    }
}

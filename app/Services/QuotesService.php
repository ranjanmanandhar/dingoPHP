<?php

namespace App\Services;

use App\Models\Quote;

class QuotesService
{
    public function __construct() {}

    public function storeQuotes($quotes, $carId)
    {
        foreach ($quotes as $quote) {
            $quotes = Quote::firstOrCreate([
                'car_id' => $carId,
                'price' => $quote->price,
                'repairer' => $quote->repairer,
                'overview_of_work' => $quote->overviewOfWork,
            ]);
        }
        return $quotes;
    }
}

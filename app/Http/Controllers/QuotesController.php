<?php

namespace App\Http\Controllers;

use App\Services\DinggoService;
use App\Services\QuotesService;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    protected $dinggoService;
    protected $quotesService;

    public function __construct(DinggoService $dinggoService, QuotesService $quotesService)
    {
        $this->dinggoService = $dinggoService;
        $this->quotesService = $quotesService;
    }

    public function syncCarQuotes(Request $request)
    {
        $carData = $request->all();

        $quotes = $this->dinggoService->getQuote($carData['license_plate'], $carData['state']['state_code'] ?? null);

        if (isset($quotes->success) && $quotes->success === 'ok') {
            $storedQuotes = $this->quotesService->storeQuotes($quotes->quotes, $carData['id']);

            return response()->json([
                'message' => 'Quotes synced successfully',
                'data' => $storedQuotes
            ], 200);
        } else {

            return response()->json([
                'error' => 'Failed to retrieve quotes',
                'details' => $quotes
            ], 400);
        }
    }
}

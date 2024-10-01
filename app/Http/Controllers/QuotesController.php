<?php

namespace App\Http\Controllers;

use App\Services\DinggoService;
use App\Services\QuotesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::info('Syncing car quotes for license plate: ' . $carData['license_plate']);

        $quotes = $this->dinggoService->getQuote($carData['license_plate'], $carData['state']['state_code'] ?? null);

        if (isset($quotes->success) && $quotes->success === 'ok') {
            Log::info('Quotes retrieved successfully', ['license_plate' => $carData['license_plate'], 'quotes_count' => count($quotes->quotes)]);
            $storedQuotes = $this->quotesService->storeQuotes($quotes->quotes, $carData['id']);

            return response()->json([
                'message' => 'Quotes synced successfully',
                'data' => $storedQuotes
            ], 200);
        } else {
            Log::error('Failed to retrieve quotes', ['license_plate' => $carData['license_plate'], 'details' => $quotes]);
            return response()->json([
                'error' => 'Failed to retrieve quotes',
                'details' => $quotes
            ], 400);
        }
    }
}

<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class DinggoService
{
    protected $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getCarsDetails()
    {
        try {
            $base_url = Config::get('api.dinggo_test_url');
            Log::info('Fetching car details from Dinggo API', ['url' => $base_url . 'cars']);

            $request = $this->httpClient->request('POST', $base_url . 'cars', [
                'json' => [
                    'username' => env('USERNAME'),
                    'key' => env('KEY')
                ]
            ]);

            $response = $request->getBody()->getContents();
            Log::info('Car details fetched successfully', ['response' => json_decode($response)]);
            return json_decode($response);
        } catch (RequestException $exception) {
            Log::error('Request failed for car details', [
                'error' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);
            throw $exception;
        } catch (\Exception $exception) {
            Log::error('An unexpected error occurred while fetching car details', [
                'error' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);
            throw $exception;
        }
    }

    public function getQuote($licensePlate, $licenseState)
    {
        try {
            $base_url = Config::get('api.dinggo_test_url');
            Log::info('Fetching quote from Dinggo API', [
                'url' => $base_url . 'quotes',
                'licensePlate' => $licensePlate,
                'licenseState' => $licenseState
            ]);

            $request = $this->httpClient->request('POST', $base_url . 'quotes', [
                'json' => [
                    'username' => env('USERNAME'),
                    'key' => env('KEY'),
                    'licensePlate' => $licensePlate,
                    'licenseState' => $licenseState
                ]
            ]);

            $response = $request->getBody()->getContents();
            Log::info('Quote fetched successfully', ['response' => json_decode($response)]);
            return json_decode($response);
        } catch (RequestException $exception) {
            Log::error('Request failed for quote', [
                'error' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'licensePlate' => $licensePlate,
                'licenseState' => $licenseState
            ]);
            throw $exception;
        } catch (\Exception $exception) {
            Log::error('An unexpected error occurred while fetching quote', [
                'error' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'licensePlate' => $licensePlate,
                'licenseState' => $licenseState
            ]);
            throw $exception;
        }
    }
}

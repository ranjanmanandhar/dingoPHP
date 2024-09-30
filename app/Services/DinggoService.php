<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Config;

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
            $request = $this->httpClient->request('POST', $base_url . 'cars', [
                'json' => [
                    'username' => env('USERNAME'),
                    'key' => env('KEY')
                ]
            ]);

            $response = $request->getBody()->getContents();
            return json_decode($response);
        } catch (RequestException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function getQuote($licensePlate, $licenseState)
    {
        try {
            $base_url = Config::get('api.dinggo_test_url');
            $request = $this->httpClient->request('POST', $base_url . 'quotes', [
                'json' => [
                    'username' => env('USERNAME'),
                    'key' => env('KEY'),
                    'licensePlate' => $licensePlate,
                    'licenseState' => $licenseState
                ]
            ]);

            $response = $request->getBody()->getContents();
            return json_decode($response);
        } catch (RequestException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\CarService;
use App\Services\DinggoService;
use Illuminate\Support\Facades\Log;

class CarsController extends Controller
{
    protected $dinggoService;
    protected $carService;

    public function __construct(DinggoService $dinggoService, CarService $carService)
    {
        $this->dinggoService = $dinggoService;
        $this->carService = $carService;
    }

    public function index()
    {
        Log::info('Fetching all cars');
        $cars = $this->carService->getAllCars();
        return view('cars', compact('cars'));
    }

    public function getCarDetails($id)
    {
        Log::info('Fetching car details for car ID: ' . $id);
        $cardetails =  $this->carService->getCarById($id);
        return view('cardetail', compact('cardetails'));
    }

    public function storeCars()
    {
        Log::info('Storing cars details from Dinggo service');
        $carDetails = $this->dinggoService->getCarsDetails();

        if (isset($carDetails->success) && $carDetails->success === 'ok') {
            $storedCars = $this->carService->storeCars($carDetails->cars);
            Log::info('Cars stored successfully');
            return response()->json([
                'message' => 'Cars stored successfully',
                'data' => $storedCars
            ], 200);
        } else {
            Log::error('Failed to fetch car details', ['details' => $carDetails]);
            return response()->json([
                'error' => 'Failed to fetch car details.',
                'details' => $carDetails
            ], 400);
        }
    }

    public function deleteAllCarsDetails()
    {
        Log::info('Deleting all car details');
        return $this->carService->deleteAllCarsDetails();
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\CarService;
use App\Services\DinggoService;

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
        $cars = $this->carService->getAllCars();
        return view('cars', compact('cars'));
    }

    public function getCarDetails($id)
    {
        $cardetails =  $this->carService->getCarById($id);
        return view('cardetail', compact('cardetails'));
    }

    public function storeCars()
    {
        $carDetails = $this->dinggoService->getCarsDetails();

        if (isset($carDetails->success) && $carDetails->success === 'ok') {
            $storedCars = $this->carService->storeCars($carDetails->cars);
            return response()->json([
                'message' => 'Cars stored successfully',
                'data' => $storedCars
            ], 200);
        } else {
            return response()->json([
                'error' => 'Failed to fetch car details.',
                'details' => $carDetails
            ], 400);
        }
    }
}

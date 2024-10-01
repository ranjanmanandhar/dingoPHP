<?php

namespace App\Services;

use App\Models\Cars;
use App\Models\CarsMake;
use App\Models\Models as CarModel;
use App\Models\Quote;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarService
{
    public function __construct() {}

    public function getAllCars()
    {
        return Cars::with('state', 'make', 'model')->get();
    }

    public function getCarById($id)
    {
        return Cars::with('state', 'make', 'model', 'quote')->findOrFail($id);
    }

    public function storeCars($cars)
    {
        foreach ($cars as $car) {
            $state = State::where('state_code', $car->licenseState)->first();

            if (!$state) {
                Log::warning('State not found for state code: ' . $car->licenseState);
                continue;
            }

            $carMake = CarsMake::firstOrCreate(['name' => $car->make]);
            $model = CarModel::firstOrCreate(['name' => $car->model, 'make_id' => $carMake->id]);
            Cars::firstOrCreate(
                [
                    'license_plate' => $car->licensePlate
                ],
                [
                    'state_id' => $state->id,
                    'vin' => $car->vin,
                    'year' => $car->year,
                    'colour' => $car->colour,
                    'make_id' => $carMake->id,
                    'model_id' => $model->id,
                ]
            );
        }
        Log::info('Cars stored successfully.');
        return response()->json(['message' => 'Cars stored successfully.'], 201);
    }


    public function deleteAllCarsDetails()
    {
        Log::info('Attempting to delete all car details.');
        try {
            DB::transaction(function () {
                CarModel::query()->delete();
                Cars::query()->delete();
                CarsMake::query()->delete();
                Quote::query()->delete();
            });
            Log::info('All car details deleted successfully.');
            return response()->json(['message' => 'All car details deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting car details: ' . $e->getMessage());
            return response()->json(['message' => 'Error deleting car details.'], 500);
        }
    }
}

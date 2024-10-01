<?php

namespace Tests\Unit;

use App\Services\CarService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_store_cars(): void
    {
        $carService = new CarService();

        $data = [
            (object) [
                'licensePlate' => 'AN4-3452',
                'licenseState' => 'NSW',
                'vin' => 'ABC1234567890',
                'year' => 2002,
                'colour' => 'pink',
                'make' => 'test',
                'model' => 'teste',
            ],
        ];

        $response = $carService->storeCars($data);

        $this->assertEquals(200, $response->getStatusCode(), 'Expected a 200 response status code.');
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return CarResource::collection(Car::with('owner')->paginate(3));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {

        $data = $request->validated();

        $car = Car::create($data);

        return CarResource::make($car)
            ->response()
            ->setStatusCode(201);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        
        return new CarResource($car);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        return ["message" => "updated yay!"];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        return ["message" => "deleted yay!"];

    }
}

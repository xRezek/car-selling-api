<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Maker;
use App\Models\FuelType;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // FuelType::create([

        //     'name' => 'hybrid'

        // ]);

        // $car = Car::find(1);
        // $car->price = 15000;
        // $car->save();

        dd(Car::where('price', '>', 20000)->get(),
           Maker::whereName('Toyota')->get()

        
    );


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

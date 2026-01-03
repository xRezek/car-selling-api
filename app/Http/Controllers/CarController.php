<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\City;
use App\Models\Maker;
use App\Models\User;
use App\Models\Model;
use App\Models\Voivodeship;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(

            City::factory(16)
                ->make()

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

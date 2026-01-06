<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ["message" => "index yay!"];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        return ["message" => "stored yay!"];
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        return ["message" => "filtered yay!"];

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

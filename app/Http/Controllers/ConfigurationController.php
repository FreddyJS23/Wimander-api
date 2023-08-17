<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Http\Requests\StoreConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use App\Http\Resources\ConfigurationResource;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configuration = Configuration::firstWhere('user_id',Auth::id());
        if ($configuration)   return  response()->json(['status' => true, 'configs' => new ConfigurationResource($configuration)], 200);
        else   return  response()->json(['status' => false, 'error' => 'Data not found'], 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConfigurationRequest $request)
    {
       $configuration=Configuration::updateOrCreate(['user_id'=>Auth::id()],['amount'=>$request->amount]);
        return  response()->json(['status' => true, 'configs' => new ConfigurationResource($configuration)], 200);
    }

    /**
     * Display the specified resource.
     */
    // public function show()
    // {
       
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateConfigurationRequest $request, Configuration $configuration)
    // {
       
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Configuration $configuration)
    // {
    //     //
    // }
}

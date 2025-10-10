<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $vehicles = Vehicle::all();

        return successResponseHandler('Vehicles fetched', $vehicles);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validateData($request);
        if ($validator->status) {

            $vehicle = Vehicle::create($request->all());
            return successResponseHandler('Vehicle created', $vehicle);
        }
        else{
            return errorValidationResponseHandler('Validation Error', $validator->errors);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($reg)
    {
        $vehicle = Vehicle::with('crimes','crimes.crime','crimes.offender')->whereRegistrationNumber($reg)->first();
        if ($vehicle) {
            return successResponseHandler('Vehicle fetched', $vehicle);
        }else{
            return notFoundResponseHandler('Vehicle Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    function validateData($request)
    {
        $rules=[
            'make'=>'required',
            'model'=>'required',
            'color'=>'required',
            'registration_number'=>'required|unique:vehicles,registration_number',
        ];

        $customMessages = [
            'make.required'=>'Make field is required',
            'model.required'=>'Model field is required',
            'color.required'=>'Color field is required',
            'registration_number.required'=>'Registration Number field is required',
            'registration_number.unique'=>'Registration Number already exists',
        ];

        $validator=Validator::make($request->all(),$rules,$customMessages);

        if ($validator->fails()) {
            $validation = json_decode(json_encode(['status' => false, 'errors' => $validator->errors()]), false);
        } else {
            $validation = json_decode(json_encode(['status' => true]), false);
        }
        return $validation;

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Phones;
use App\Http\Requests\StorePhonesRequest;
use App\Http\Requests\UpdatePhonesRequest;

class PhonesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phones = Phones::all();
        return response()->json(['phones' => $phones]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhonesRequest $request)
    {
        $phone = Phones::create($request->validated());
        return response()->json(['phone' => $phone], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Phones $phones)
    {
        return response()->json(['phone' => $phones]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhonesRequest $request, Phones $phones)
    {
        $phones->update($request->validated());
        return response()->json(['phone' => $phones]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phones $phones)
    {
        $phones->delete();
        return response()->json(null, 204);
    }
}

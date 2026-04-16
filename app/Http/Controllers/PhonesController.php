<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Http\Requests\StorePhoneRequest;
use App\Http\Requests\UpdatePhoneRequest;

class PhonesController extends Controller
{
    public function index()
    {
        return response()->json(Phone::with('categoria')->get());
    }

    public function store(StorePhoneRequest $request)
    {
        $phone = Phone::create($request->validated());
        return response()->json($phone, 201);
    }

    public function show(Phone $phone)
    {
        return response()->json($phone->load('categoria'));
    }

    public function update(UpdatePhoneRequest $request, Phone $phone)
    {
        $phone->update($request->validated());
        return response()->json($phone);
    }

    public function destroy(Phone $phone)
    {
        $phone->delete();
        return response()->json(null, 204);
    }
}
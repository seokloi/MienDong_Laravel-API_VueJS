<?php
namespace App\Http\Controllers;

use App\Http\Resources\QuayResource;
use App\Http\Resources\QuayCollection;
use Illuminate\Http\Request;
use App\quay;


class QuayController extends Controller
{
    public function index()
    {
        return QuayResource::collection(quay::all());
    }

    public function show($id)
    {
        return new QuayResource(quay::findOrFail($id));
    }

    public function store(Request $request)
    {
        $quay = quay::create($request->all());

        return response()->json($quay, 201);
    }

    public function update(Request $request, quay $quay)
    {
        $quay->update($request->all());

        return response()->json($quay, 200);
    }

    public function delete(quay $quay)
    {
        $quay->delete();

        return response()->json(null, 204);
    }
}

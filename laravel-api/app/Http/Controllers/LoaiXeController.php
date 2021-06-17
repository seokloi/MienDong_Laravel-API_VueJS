<?php
namespace App\Http\Controllers;

use App\Http\Resources\LoaiXeResource;
use App\Http\Resources\LoaiXeCollection;
use Illuminate\Http\Request;
use App\loaixe;


class LoaiXeController extends Controller
{
    public function index()
    {
        return LoaiXeResource::collection(loaixe::all());
    }

    public function show($id)
    {
        return new LoaiXeResource(loaixe::findOrFail($id));
    }

    public function store(Request $request)
    {
        $loaixe = loaixe::create($request->all());

        return response()->json($loaixe, 201);
    }

    public function update(Request $request, loaixe $loaixe)
    {
        $loaixe->update($request->all());

        return response()->json($loaixe, 200);
    }

    public function delete(loaixe $loaixe)
    {
        $loaixe->delete();

        return response()->json(null, 204);
    }
}

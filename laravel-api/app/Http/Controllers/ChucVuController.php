<?php
namespace App\Http\Controllers;

use App\Http\Resources\ChucVuResource;
use App\Http\Resources\ChucVuCollection;
use Illuminate\Http\Request;
use App\chucvu;


class ChucVuController extends Controller
{
    public function index()
    {
        return ChucVuResource::collection(chucvu::all());
    }

    public function show($id)
    {
        return new ChucVuResource(chucvu::findOrFail($id));
    }

    public function store(Request $request)
    {
        $chucvu = chucvu::create($request->all());

        return response()->json($chucvu, 201);
    }

    public function update(Request $request, chucvu $chucvu)
    {
        $chucvu->update($request->all());

        return response()->json($chucvu, 200);
    }

    public function delete(chucvu $chucvu)
    {
        $chucvu->delete();

        return response()->json(null, 204);
    }
}

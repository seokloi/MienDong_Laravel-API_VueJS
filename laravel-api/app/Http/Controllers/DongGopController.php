<?php
namespace App\Http\Controllers;

use App\Http\Resources\DongGopResource;
use App\Http\Resources\DongGopCollection;
use Illuminate\Http\Request;
use App\donggop;


class DongGopController extends Controller
{
    public function index()
    {
        return DongGopResource::collection(donggop::orderBy('created_at', 'desc')->paginate(10));
    }

    public function show($id)
    {
        return new DongGopResource(donggop::findOrFail($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'sdt' => 'required',
            'noidung' => 'required',
        ]);
        $product = donggop::create([
            'name'    => $request->input('name'),
            'email'  => $request->input('email'),
            'sdt'  => $request->input('sdt'),
            'noidung'  => $request->input('noidung'),
        ]);
        return response()->json($product, 201);
    }

    public function update(Request $request, donggop $donggop)
    {
        $donggop->update($request->all());

        return response()->json($donggop, 200);
    }

    public function delete(donggop $donggop)
    {
        $donggop->delete();

        return response()->json(null, 204);
    }
}

<?php
namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogCollection;
use Illuminate\Http\Request;
use App\blog;


class BlogController extends Controller
{
    public function index()
    {
        return BlogResource::collection(blog::orderBy('created_at', 'desc')->paginate(4));
    }

    public function show($id)
    {
        return new BlogResource(blog::findOrFail($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Ten' => 'required',
            'NoiDung' => 'required',
            'NoiDungTomTat' => 'required',
        ]);
        $product = blog::create([
            'Ten'    => $request->input('Ten'),
            'NoiDung'  => $request->input('NoiDung'),
            'NoiDungTomTat'  => $request->input('NoiDungTomTat'),
        ]);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Ten' => 'required',
            'NoiDung' => 'required',
            'NoiDungTomTat' => 'required',
        ]);

        $product = blog::find($id);

        $product->Ten = $request->input('Ten');
        $product->NoiDung = $request->input('NoiDung');
        $product->NoiDungTomTat = $request->input('NoiDungTomTat');
    
        $product->save();

        return response()->json($product, 201);
    }

    public function delete($id)
    {
        $product = blog::find($id);
        $product->delete();
        return response(['result' => 'success'], 200);
    }
}

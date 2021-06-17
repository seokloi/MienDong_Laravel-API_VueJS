<?php
namespace App\Http\Controllers;

use App\Http\Resources\ChuXe_BenXeResource;
use App\Http\Resources\ChuXe_BenXeCollection;
use Illuminate\Http\Request;
use App\chuxe_benxe;


class ChuXe_BenXeController extends Controller
{
    public function index()
    {
        if(isset($_REQUEST['id_ChuXe']))
        {
            $chuxe_benxe = chuxe_benxe::where('id_ChuXe',$_REQUEST['id_ChuXe'])->orderBy('id_ChuXe', 'asc')->orderBy('id_BenXe', 'asc')->paginate(10);
            return ChuXe_BenXeResource::collection($chuxe_benxe);
        }
        else
        {
            return ChuXe_BenXeResource::collection(chuxe_benxe::orderBy('id_ChuXe', 'asc')->orderBy('id_BenXe', 'asc')->get());
        }
    }

    public function show($id)
    {
        return new ChuXe_BenXeResource(hoadon::findOrFail($id));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
                'id_ChuXe' => 'required|integer|gt:0',
                'id_BenXe' => 'required|integer|gt:0',
        ]);
        $product = chuxe_benxe::create([
              'id_BenXe'     => $request->input('id_BenXe'),
              'id_ChuXe'     => $request->input('id_ChuXe'),
        ]);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_BenXe' => 'required|integer|gt:0',
        ]);

        $product = chuxe_benxe::find($id);

        $product->id_BenXe = $request->input('id_BenXe');
    
        $product->save();

        return response()->json($product, 201);
    }

    public function delete($id)
    {
        $product = chuxe_benxe::find($id);
        $product->delete();
        return response(['result' => 'success'], 200);
    }
}

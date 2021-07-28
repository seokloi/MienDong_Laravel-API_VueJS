<?php
namespace App\Http\Controllers;

use App\Http\Resources\XeResource;
use App\Http\Resources\XeCollection;
use Illuminate\Http\Request;
use App\xe;
use App\User;
use App\chuxe;


class XeController extends Controller
{
    public function index()
    {
        if(isset($_REQUEST['id_User']) && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 3)
        {
            $user = user::findOrFail($_REQUEST['id_User']);
            $xe = xe::where('id_ChuXe',$user->chuxe->id)->orderBy('id_ChuXe', 'asc')->orderBy('id_Loai', 'asc')->paginate(10);
            return XeResource::collection($xe);
        }
        else
        {
            return XeResource::collection(xe::orderBy('id_ChuXe', 'asc')->orderBy('id_Loai', 'asc')->get());
        }
    }

    public function show($id)
    {
        return new XeResource(xe::findOrFail($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'BienSo' => 'required',
                'id_Loai' => 'required|integer|gt:0',
                'id_User' => 'required',
        ]);
        $user = user::findOrFail($request->input('id_User'));
        $product = xe::create([
                'BienSo'     => $request->input('BienSo'),
                'id_Loai'  => $request->input('id_Loai'),
                'id_ChuXe' => $user->chuxe->id,
        ]);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
                'BienSo' => 'required',
                'id_Loai' => 'required|integer|gt:0',
        ]);

        $product = xe::find($id);

        $product->BienSo = $request->input('BienSo');
        $product->id_Loai = $request->input('id_Loai');
    
        $product->save();

        return response()->json($product, 201);
    }

    public function delete($id)
    {
        $product = xe::find($id);
        $product->delete();
        return response(['result' => 'success'], 200);
    }
}

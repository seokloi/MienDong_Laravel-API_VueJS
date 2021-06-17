<?php
namespace App\Http\Controllers;

use App\Http\Resources\BenXeResource;
use App\Http\Resources\BenXeCollection;
use Illuminate\Http\Request;
use App\benxe;
use App\User;
use App\chuxe;
use App\xe;
use App\chuyenxe;
use App\chuxe_benxe;

class BenXeController extends Controller
{
    public function index()
    {
        if(isset($_REQUEST['id_User']) && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 2 && isset($_REQUEST['id_Tuyen']) && isset($_REQUEST['id_ChuXe']))
        {
            $user = user::findOrFail($_REQUEST['id_User']);

            $chuxe = chuxe::select('id as id_ChuXe')
            ->where('id',$_REQUEST['id_ChuXe'])
            ->where('id_Quay',$user->nhanvien->id_Quay);

            $xe = xe::select('id as id_Xe')
            ->joinSub($chuxe, 'chuxes', function ($join) {
                $join->on('xes.id_ChuXe', '=', 'chuxes.id_ChuXe');
            })
            ->distinct();

            $chuyenxe = chuyenxe::select('id_BenXe')
            ->where('Hidden', '==' , 0)
            ->joinSub($xe, 'xes', function ($join) {
                $join->on('chuyenxes.id_Xe', '=', 'xes.id_Xe');
            })
            ->distinct();

            $benxe = benxe::joinSub($chuyenxe, 'chuyenxes', function ($join) {
                $join->on('benxes.id', '=', 'chuyenxes.id_BenXe');
            })
            ->distinct()
            ->where('id_Tuyen',$_REQUEST['id_Tuyen'])
            ->orderBy('id_Tuyen', 'asc')
            ->orderBy('Ten', 'asc')
            ->paginate(10);

            return BenXeResource::collection($benxe);
        }
        else if(isset($_REQUEST['id_User']) && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 3)
        {
            $user = user::findOrFail($_REQUEST['id_User']);

            $chuxe_benxe = chuxe_benxe::select('id_BenXe as id_BenXe')
            ->where('id_ChuXe',$user->chuxe->id)
            ->distinct();

            $benxe = benxe::joinSub($chuxe_benxe, 'chuxe_benxes', function ($join) {
                $join->on('benxes.id', '=', 'chuxe_benxes.id_BenXe');
            })
            ->distinct()
            ->orderBy('id_Tuyen', 'asc')
            ->orderBy('Ten', 'asc')
            ->paginate(10);

            return BenXeResource::collection($benxe);
        }
        else if(isset($_REQUEST['id_Tuyen']))
        {
            $benxe = benxe::where('id_Tuyen',$_REQUEST['id_Tuyen'])->orderBy('id_Tuyen', 'asc')->orderBy('Ten', 'asc')->paginate(10);
            return BenXeResource::collection($benxe);
        }
        else
        {
            return BenXeResource::collection(benxe::orderBy('id_Tuyen', 'asc')->orderBy('Ten', 'asc')->get());
        }
    }

    public function show($id)
    {
        return new BenXeResource(benxe::findOrFail($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Ten' => 'required',
            'id_Tuyen' => 'required|integer|gt:0',
        ]);
        $product = benxe::create([
            'Ten'    => $request->input('Ten'),
            'id_Tuyen'  => $request->input('id_Tuyen'),
        ]);
        return response()->json($product, 201);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Ten' => 'required',
            'id_Tuyen' => 'required|integer|gt:0',
        ]);

        $product = benxe::find($id);

        $product->Ten = $request->input('Ten');
        $product->id_Tuyen = $request->input('id_Tuyen');
    
        $product->save();

        return response()->json($product, 201);
    }

    public function delete($id)
    {
        $product = benxe::find($id);
        $product->delete();
        return response(['result' => 'success'], 200);
    }
}

<?php
namespace App\Http\Controllers;

use App\Http\Resources\ChuXeResource;
use App\Http\Resources\ChuXeCollection;
use Illuminate\Http\Request;
use App\chuxe;
use App\xe;
use App\chuyenxe;
use App\User;


class ChuXeController extends Controller
{
    public function show($id)
    {
        $chuxe = chuxe::where('id_User',$id)->first();
        return new ChuXeResource($chuxe);
    }

    public function index()
    {
        if(isset($_REQUEST['id_User']) && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 2)
        {
            $user = user::findOrFail($_REQUEST['id_User']);
            $chuxe = chuxe::where('id_Quay',$user->nhanvien->id_Quay)->orderBy('Ten', 'asc')->paginate(10);
            return ChuXeResource::collection($chuxe);
        }
        else if(isset($_REQUEST['id_BenXe']))
        {
            $chuyenxe = chuyenxe::select('id_Xe')
            ->distinct()
            ->where('id_BenXe',$_REQUEST['id_BenXe'])
            ->where('Printed', '<>' , 0)
            ->where('Hidden', '==' , 0);

            $xe = xe::select('id_ChuXe')
            ->joinSub($chuyenxe, 'chuyenxes', function ($join) {
                $join->on('xes.id', '=', 'chuyenxes.id_Xe');
            })
            ->distinct();

            $chuxe = chuxe::joinSub($xe, 'xes', function ($join) {
                $join->on('chuxes.id', '=', 'xes.id_ChuXe');
            })
            ->distinct()
            ->get();
            return ChuXeResource::collection($chuxe);
        }
        else
        {
            return ChuXeResource::collection(chuxe::orderBy('Ten', 'asc')->paginate(10));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Ten' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'DiaChi' => 'required',
            'SDT' => 'required',
            'id_Quay' => 'required|integer|gt:0',
        ]);
        $user = User::create([
            'name' => $request->input('Ten'),
            'email'     => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'id_ChucVu'     => 3,
        ]);
        $product = chuxe::create([
            'Ten'     => $request->input('Ten'),
            'DiaChi'  => $request->input('DiaChi'),
            'SDT'     => $request->input('SDT'),
            'id_User' => $user->id,
            'id_Quay'  => $request->input('id_Quay'),
        ]);
        return response()->json($product, 201);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Ten' => 'required',
            'DiaChi' => 'required',
            'SDT' => 'required',
            'id_Quay' => 'required|integer|gt:0',
        ]);

        $product = chuxe::find($id);

        $product->Ten = $request->input('Ten');
        $product->DiaChi = $request->input('DiaChi');
        $product->SDT = $request->input('SDT');
        $product->id_Quay = $request->input('id_Quay');
    
        $product->save();

        $user = User::find($product->id_User);
        $user->name = $request->input('Ten');
        if($request->input('password'))
        {
            $user->password = bcrypt($request->input('password'));
        }

        return response()->json($product, 201);
    }

    public function delete($id)
    {
        $product = chuxe::find($id);
        $user = User::find($product->id_User);
        $user->delete();
        $product->delete();
        return response(['result' => 'success'], 200);
    }
}

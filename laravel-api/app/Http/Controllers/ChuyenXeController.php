<?php
namespace App\Http\Controllers;

use App\Http\Resources\ChuyenXeResource;
use App\Http\Resources\ChuyenXeCollection;
use Illuminate\Http\Request;
use App\nv_banve;
use App\User;
use App\chuxe;
use App\xe;
use App\chuyenxe;
use DB;

class ChuyenXeController extends Controller
{
    public function index()
    {
        if(isset($_REQUEST['id_User']) && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 2 && isset($_REQUEST['id_BenXe']) && isset($_REQUEST['id_ChuXe']))
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

            $chuyenxe = chuyenxe::where('DayInMonth', NULL)
            ->where('Hidden', '==' , 0)
            ->joinSub($xe, 'xes', function ($join) {
                $join->on('chuyenxes.id_Xe', '=', 'xes.id_Xe');
            })
            ->distinct()
            ->where('id_BenXe',$_REQUEST['id_BenXe'])
            ->where('Printed', '<>' , 0)
            ->where('Hidden', '==' , 0)
            ->orderBy('id_BenXe', 'asc')
            ->orderBy('Ngay', 'asc')
            ->orderBy('Gio', 'asc')
            ->orderBy('GiaVe', 'asc')
            ->paginate(10);

            return ChuyenXeResource::collection($chuyenxe);
        }
        else if(isset($_REQUEST['id_User'])  && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 3 && isset($_REQUEST['month']))
        {
            $user = user::findOrFail($_REQUEST['id_User']);
            $xe = xe::select('id as id_Xe')
            ->where('id_ChuXe',$user->chuxe->id);

            $chuyenxe = chuyenxe::where('Ngay', NULL)
            ->joinSub($xe, 'xes', function ($join) {
                $join->on('chuyenxes.id_Xe', '=', 'xes.id_Xe');
            })
            ->orderBy('DayInMonth', 'asc')
            ->orderBy('id_BenXe', 'asc')
            ->orderBy('Gio', 'asc')
            ->orderBy('GiaVe', 'asc')
            ->paginate(10);
            return ChuyenXeResource::collection($chuyenxe);
        }
        else if(isset($_REQUEST['id_User'])  && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 3 && isset($_REQUEST['HoaDon']))
        {
            $user = user::findOrFail($_REQUEST['id_User']);
            $xe = xe::select('id as id_Xe')
            ->where('id_ChuXe',$user->chuxe->id);

            $chuyenxe = chuyenxe::where('Hidden', 1)
            ->where('Printed', 1)
            ->joinSub($xe, 'xes', function ($join) {
                $join->on('chuyenxes.id_Xe', '=', 'xes.id_Xe');
            })
            ->orderBy('Ngay', 'asc')
            ->orderBy('id_BenXe', 'asc')
            ->orderBy('Gio', 'asc')
            ->orderBy('GiaVe', 'asc')
            ->paginate(10);
            return ChuyenXeResource::collection($chuyenxe);
        }
        else if(isset($_REQUEST['id_User'])  && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 3)
        {
            $user = user::findOrFail($_REQUEST['id_User']);
            $xe = xe::select('id as id_Xe')
            ->where('id_ChuXe',$user->chuxe->id);

            $chuyenxe = chuyenxe::where('DayInMonth', NULL)
            ->where('Hidden', '==' , 0)
            ->joinSub($xe, 'xes', function ($join) {
                $join->on('chuyenxes.id_Xe', '=', 'xes.id_Xe');
            })
            ->orderBy('Ngay', 'asc')
            ->orderBy('id_BenXe', 'asc')
            ->orderBy('Gio', 'asc')
            ->orderBy('GiaVe', 'asc')
            ->paginate(10);
            return ChuyenXeResource::collection($chuyenxe);
        }
        else if(isset($_REQUEST['id_BenXe']) && isset($_REQUEST['Ngay']))
        {
            $chuyenxe = chuyenxe::where('DayInMonth', NULL)
            ->where('id_BenXe',$_REQUEST['id_BenXe'])
            ->where('Printed', '<>' , 0)
            ->where('Hidden', '==' , 0)
            ->where('Ngay', $_REQUEST['Ngay'])
            ->orderBy('id_BenXe', 'asc')
            ->orderBy('Ngay', 'asc')
            ->orderBy('Gio', 'asc')
            ->orderBy('GiaVe', 'asc')
            ->get();
            return ChuyenXeResource::collection($chuyenxe);
        }
        else if(isset($_REQUEST['id_BenXe']))
        {
            $chuyenxe = chuyenxe::where('DayInMonth', NULL)
            ->where('id_BenXe',$_REQUEST['id_BenXe'])
            ->where('Printed', '<>' , 0)
            ->where('Hidden', '==' , 0)
            ->orderBy('id_BenXe', 'asc')
            ->orderBy('Ngay', 'asc')
            ->orderBy('Gio', 'asc')
            ->orderBy('GiaVe', 'asc')
            ->get();
            return ChuyenXeResource::collection($chuyenxe);
        }
        else
        {
            return ChuyenXeResource::collection(chuyenxe::where('DayInMonth', NULL)->where('Hidden', '==' , 0)->orderBy('id_BenXe', 'asc')->orderBy('Ngay', 'asc')->orderBy('Gio', 'asc')->orderBy('GiaVe', 'asc')->get());
        }
    }

    public function show($id)
    {
        return new ChuyenXeResource(chuyenxe::findOrFail($id));
    }

    public function store(Request $request)
    {
        if($request->input('month') == true)
        {
            $this->validate($request, [
                'id_Xe' => 'required|integer|gt:0',
                'id_BenXe' => 'required|integer|gt:0',
                'DayInMonth' => 'required|between:0,32',
                'Gio' => 'required',
                'GiaVe' => 'required|integer|gt:0',
            ]);
            $product = chuyenxe::create([
                'id_Xe'     => $request->input('id_Xe'),
                'id_BenXe'     => $request->input('id_BenXe'),
                'DayInMonth'     => $request->input('DayInMonth'),
                'Gio'     => $request->input('Gio'),
                'GiaVe'     => $request->input('GiaVe'),
            ]);
            return response()->json($product, 201);
        }
        else {
            $this->validate($request, [
                'id_Xe' => 'required|integer|gt:0',
                'id_BenXe' => 'required|integer|gt:0',
                'Ngay' => 'required|after_or_equal:now',
                'Gio' => 'required',
                'GiaVe' => 'required|integer|gt:0',
            ]);
            $product = chuyenxe::create([
                'id_Xe'     => $request->input('id_Xe'),
                'id_BenXe'     => $request->input('id_BenXe'),
                'Ngay'     => $request->input('Ngay'),
                'Gio'     => $request->input('Gio'),
                'GiaVe'     => $request->input('GiaVe'),
            ]);
            return response()->json($product, 201);
        }
    }

    public function update(Request $request, $id)
    {
        if($request->input('PBill') == true)
        {
            $product = chuyenxe::find($id);

            $product->Hidden = 1;
    
            $product->save();

            return response()->json($product, 201);
        }
        else if($request->input('month') == true)
        {
            $this->validate($request, [
                'id_Xe' => 'required|integer|gt:0',
                'id_BenXe' => 'required|integer|gt:0',
                'DayInMonth' => 'required',
                'Gio' => 'required',
                'GiaVe' => 'required|integer|gt:0',
            ]);

            $product = chuyenxe::find($id);

            $product->id_Xe = $request->input('id_Xe');
            $product->id_BenXe = $request->input('id_BenXe');
            $product->DayInMonth = $request->input('DayInMonth');
            $product->Gio = $request->input('Gio');
            $product->GiaVe = $request->input('GiaVe');
    
            $product->save();

            return response()->json($product, 201);
        }
        else
        {
            $this->validate($request, [
                'id_Xe' => 'required|integer|gt:0',
                'id_BenXe' => 'required|integer|gt:0',
                'Ngay' => 'required|after_or_equal:now',
                'Gio' => 'required',
                'GiaVe' => 'required|integer|gt:0',
            ]);

            $product = chuyenxe::find($id);

            $product->id_Xe = $request->input('id_Xe');
            $product->id_BenXe = $request->input('id_BenXe');
            $product->Ngay = $request->input('Ngay');
            $product->Gio = $request->input('Gio');
            $product->GiaVe = $request->input('GiaVe');
    
            $product->save();

            return response()->json($product, 201);
        }
    }

    public function delete($id)
    {
        $product = chuyenxe::find($id);
        $product->delete();
        return response(['result' => 'success'], 200);
    }
}

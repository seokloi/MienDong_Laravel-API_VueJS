<?php
namespace App\Http\Controllers;

use App\Http\Resources\TuyenResource;
use App\Http\Resources\TuyenCollection;
use Illuminate\Http\Request;
use App\chuxe;
use App\xe;
use App\chuyenxe;
use App\benxe;
use App\tuyen;
use App\User;

class TuyenController extends Controller
{
    public function index()
    {
        if(isset($_REQUEST['id_User']) && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 2 && isset($_REQUEST['id_ChuXe']))
        {
            $user = user::findOrFail($_REQUEST['id_User']);

            $chuxe = chuxe::select('id as id_ChuXe')
            ->where('id',$_REQUEST['id_ChuXe'])
            ->where('id_Quay',$user->nhanvien->id_Quay);

            $xe = xe::select('id as id_Xe')
            ->joinSub($chuxe, 'chuxes', function ($join) {
                $join->on('xes.id_ChuXe', '=', 'chuxes.id_ChuXe');
            });

            $chuyenxe = chuyenxe::select('id_BenXe')
            ->where('Hidden', '==' , 0)
            ->joinSub($xe, 'xes', function ($join) {
                $join->on('chuyenxes.id_Xe', '=', 'xes.id_Xe');
            })
            ->distinct();

            $benxe = benxe::select('id_Tuyen')
            ->joinSub($chuyenxe, 'chuyenxes', function ($join) {
                $join->on('benxes.id', '=', 'chuyenxes.id_BenXe');
            })
            ->distinct();

            $tuyen = tuyen::joinSub($benxe, 'benxes', function ($join) {
                $join->on('tuyens.id', '=', 'benxes.id_Tuyen');
            })
            ->distinct()
            ->orderBy('DiaDiem1', 'asc')
            ->orderBy('DiaDiem2', 'asc')
            ->orderBy('DoDai', 'asc')
            ->paginate(10);

            return TuyenResource::collection($tuyen);
        }
        else if(isset($_REQUEST['Tuyen1']))
        {
            $tuyen = tuyen::where('DiaDiem1','Bến xe Miền Đông')->orderBy('DiaDiem2', 'asc')->get();
            return TuyenResource::collection($tuyen);
        }
        else if(isset($_REQUEST['Tuyen2']))
        {
            $tuyen = tuyen::where('DiaDiem2','Bến xe Miền Đông')->orderBy('DiaDiem1', 'asc')->get();
            return TuyenResource::collection($tuyen);
        }
        else
        {
            return TuyenResource::collection(tuyen::orderBy('DiaDiem1', 'asc')->orderBy('DoDai', 'asc')->paginate(60));
        }
    }

    public function show($id)
    {
        return new TuyenResource(tuyen::findOrFail($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'DiaDiem1' => 'required',
            'DiaDiem2' => 'required|different:DiaDiem1',
            'DoDai' => 'required|integer|gt:0',
        ]);
        $product = tuyen::create([
            'DiaDiem1'     => $request->input('DiaDiem1'),
            'DiaDiem2'     => $request->input('DiaDiem2'),
            'DoDai'    => $request->input('DoDai'),
        ]);
        return response()->json($product, 201);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'DiaDiem1' => 'required',
            'DiaDiem2' => 'required|different:DiaDiem1',
            'DoDai' => 'required|integer|gt:0',
        ]);

        $product = tuyen::find($id);

        $product->DiaDiem1 = $request->input('DiaDiem1');
        $product->DiaDiem2 = $request->input('DiaDiem2');
        $product->DoDai = $request->input('DoDai');
    
        $product->save();

        return response()->json($product, 201);
    }

    public function delete($id)
    {
        $product = tuyen::find($id);
        $product->delete();
        return response(['result' => 'success'], 200);
    }
}

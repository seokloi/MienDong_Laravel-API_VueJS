<?php
namespace App\Http\Controllers;

use App\Http\Resources\NhanVienResource;
use App\Http\Resources\NhanVienCollection;
use Illuminate\Http\Request;
use App\nhanvien;
use App\User;


class NhanVienController extends Controller
{
    public function index()
    {
        return NhanVienResource::collection(nhanvien::orderBy('id_Quay', 'asc')->orderBy('Ten', 'asc')->paginate(10));
    }

    public function show($id)
    {
        $nhanvien = nhanvien::where('id_User',$id)->first();
        return new NhanVienResource($nhanvien);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'Ten' => 'required',
                'email' => 'required|email|unique:users,email',
                'NgaySinh' => 'required|before_or_equal:now',
                'DiaChi' => 'required',
                'SDT' => 'required',
                'NgayBatDauHopDong' => 'required|before_or_equal:now|after:NgaySinh',
                'password' => 'required',
                'id_Quay' => 'required|integer|gt:0',
        ]);
        $user = User::create([
                'name' => $request->input('Ten'),
                'email'     => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'id_ChucVu'     => 2,
        ]);
        $product = nhanvien::create([
                'Ten'     => $request->input('Ten'),
                'NgaySinh'     => $request->input('NgaySinh'),
                'DiaChi'     => $request->input('DiaChi'),
                'SDT'     => $request->input('SDT'),
                'NgayBatDauHopDong'     => $request->input('NgayBatDauHopDong'),
                'id_Quay'     => $request->input('id_Quay'),
                'id_User'     => $user->id,
        ]);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
                'Ten' => 'required',
                'NgaySinh' => 'required|before_or_equal:now',
                'DiaChi' => 'required',
                'SDT' => 'required',
                'id_Quay' => 'required|integer|gt:0',
        ]);

        $product = nhanvien::find($id);

        $product->Ten = $request->input('Ten');
        $product->NgaySinh = $request->input('NgaySinh');
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
        $product = nhanvien::find($id);
        $user = User::find($product->id_User);
        $product->delete();
        $user->delete();
        return response(['result' => 'success'], 200);
    }
}

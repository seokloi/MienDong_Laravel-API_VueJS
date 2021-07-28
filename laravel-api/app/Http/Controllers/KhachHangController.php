<?php
namespace App\Http\Controllers;

use App\Http\Resources\KhachHangResource;
use App\Http\Resources\KhachHangCollection;
use Illuminate\Http\Request;
use App\khachhang;
use App\User;

class KhachHangController extends Controller
{
    public function index()
    {
        return KhachHangResource::collection(khachhang::orderBy('id_Loai', 'asc')->orderBy('Ten', 'asc')->paginate(10));
    }

    public function show($id)
    {
        $user = user::findOrFail($id);
        return new KhachHangResource(khachhang::findOrFail($user->khachhang->id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'Ten' => 'required',
                'email' => 'required|email|unique:users,email',
                'NgaySinh' => 'required|before_or_equal:now',
                'DiaChi' => 'required',
                'SDT' => 'required',
                'password' => 'required',
        ]);
        $user = User::create([
                'name' => $request->input('Ten'),
                'email'     => $request->input('email'),
                'password'     => bcrypt($request->input('password')),
                'id_ChucVu'     => 4,
        ]);
        $product = khachhang::create([
                'Ten'     => $request->input('Ten'),
                'NgaySinh'     => $request->input('NgaySinh'),
                'DiaChi'     => $request->input('DiaChi'),
                'SDT'     => $request->input('SDT'),
                'SoLanMua'     => 0,
                'id_Loai'     => 1,
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
        ]);

        $product = khachhang::find($id);

        $product->Ten = $request->input('Ten');
        $product->NgaySinh = $request->input('NgaySinh');
        $product->DiaChi = $request->input('DiaChi');
        $product->SDT = $request->input('SDT');
    
        $product->save();

        $user = User::find($product->id_User);
        $user->name = $request->input('Ten');
        if($request->input('password'))
        {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return response()->json($product, 201);
    }

    public function delete($id)
    {
        $product = khachhang::find($id);
        $user = User::find($product->id_User);
        $product->delete();
        $user->delete();
        return response(['result' => 'success'], 200);
    }
}

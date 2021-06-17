<?php
namespace App\Http\Controllers;

use App\Http\Resources\LoaiKhachHangResource;
use App\Http\Resources\LoaiKhachHangCollection;
use Illuminate\Http\Request;
use App\loaikhachhang;


class LoaiKhachHangController extends Controller
{
    public function index()
    {
        return LoaiKhachHangResource::collection(loaikhachhang::all());
    }

    public function show($id)
    {
        return new LoaiKhachHangResource(loaikhachhang::findOrFail($id));
    }

    public function store(Request $request)
    {
        $loaikhachhang = loaikhachhang::create($request->all());

        return response()->json($loaikhachhang, 201);
    }

    public function update(Request $request, loaikhachhang $loaikhachhang)
    {
        $luong->update($request->all());

        return response()->json(@loaikhachhang, 200);
    }

    public function delete(loaikhachhang $loaikhachhang)
    {
        $luong->delete();

        return response()->json(null, 204);
    }
}

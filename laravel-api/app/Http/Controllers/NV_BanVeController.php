<?php
namespace App\Http\Controllers;

use App\Http\Resources\NV_BanVeResource;
use App\Http\Resources\NV_BanVeCollection;
use Illuminate\Http\Request;
use App\nv_banve;
use App\chuyenxe;
use App\chuxe;
use App\xe;
use App\User;
use App\khachhang;
use Illuminate\Support\Str;

class NV_BanVeController extends Controller
{
    public function index()
    {
        if(isset($_REQUEST['id_User']) && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 3 && isset($_REQUEST['id_Chuyen']) && isset($_REQUEST['Full']))
        {
            $user = user::findOrFail($_REQUEST['id_User']);

            $chuxe = chuxe::select('id as id_ChuXe')
            ->where('id',$user->chuxe->id);

            $xe = xe::select('id as id_Xe')
            ->joinSub($chuxe, 'chuxes', function ($join) {
                $join->on('xes.id_ChuXe', '=', 'chuxes.id_ChuXe');
            });

            $chuyenxe = chuyenxe::select('id as id_Chuyen')
            ->joinSub($xe, 'xes', function ($join) {
                $join->on('chuyenxes.id_Xe', '=', 'xes.id_Xe');
            })
            ->distinct();

            $ve = nv_banve::joinSub($chuyenxe, 'chuyenxes', function ($join) {
                $join->on('nv_banves.id_Chuyen', '=', 'chuyenxes.id_Chuyen');
            })
            ->distinct()
            ->where('nv_banves.id_Chuyen',$_REQUEST['id_Chuyen'])
            ->orderBy('nv_banves.id_Chuyen', 'asc')
            ->orderBy('id', 'asc')
            ->get();

            return NV_BanVeResource::collection($ve);
        }
        if(isset($_REQUEST['id_User']) && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 3 && isset($_REQUEST['id_Chuyen']))
        {
            $user = user::findOrFail($_REQUEST['id_User']);

            $chuxe = chuxe::select('id as id_ChuXe')
            ->where('id',$user->chuxe->id);

            $xe = xe::select('id as id_Xe')
            ->joinSub($chuxe, 'chuxes', function ($join) {
                $join->on('xes.id_ChuXe', '=', 'chuxes.id_ChuXe');
            });

            $chuyenxe = chuyenxe::select('id as id_Chuyen')
            ->joinSub($xe, 'xes', function ($join) {
                $join->on('chuyenxes.id_Xe', '=', 'xes.id_Xe');
            })
            ->distinct();

            $soluongve = nv_banve::where('id_Chuyen',$_REQUEST['id_Chuyen'])->count();

            $ve = nv_banve::joinSub($chuyenxe, 'chuyenxes', function ($join) {
                $join->on('nv_banves.id_Chuyen', '=', 'chuyenxes.id_Chuyen');
            })
            ->distinct()
            ->where('nv_banves.id_Chuyen',$_REQUEST['id_Chuyen'])
            ->orderBy('nv_banves.id_Chuyen', 'asc')
            ->orderBy('id', 'asc')
            ->paginate($soluongve/2);

            return NV_BanVeResource::collection($ve);
        }
        else if(isset($_REQUEST['id_User']) && user::findOrFail($_REQUEST['id_User'])->id_ChucVu == 2 && isset($_REQUEST['id_Chuyen']) && isset($_REQUEST['id_ChuXe']))
        {
            $user = user::findOrFail($_REQUEST['id_User']);

            $chuxe = chuxe::select('id as id_ChuXe')
            ->where('id',$_REQUEST['id_ChuXe'])
            ->where('id_Quay',$user->nhanvien->id_Quay);

            $xe = xe::select('id as id_Xe')
            ->joinSub($chuxe, 'chuxes', function ($join) {
                $join->on('xes.id_ChuXe', '=', 'chuxes.id_ChuXe');
            });

            $chuyenxe = chuyenxe::select('id as id_Chuyen')
            ->where('Hidden', '==' , 0)
            ->joinSub($xe, 'xes', function ($join) {
                $join->on('chuyenxes.id_Xe', '=', 'xes.id_Xe');
            })
            ->distinct();

            $soluongve = nv_banve::where('id_Chuyen',$_REQUEST['id_Chuyen'])->count();

            $ve = nv_banve::joinSub($chuyenxe, 'chuyenxes', function ($join) {
                $join->on('nv_banves.id_Chuyen', '=', 'chuyenxes.id_Chuyen');
            })
            ->distinct()
            ->where('nv_banves.id_Chuyen',$_REQUEST['id_Chuyen'])
            ->orderBy('nv_banves.id_Chuyen', 'asc')
            ->orderBy('id', 'asc')
            ->paginate($soluongve/2);

            return NV_BanVeResource::collection($ve);
        }
        else if(isset($_REQUEST['id_Chuyen']))
        {
            $ve = nv_banve::where('id_Chuyen',$_REQUEST['id_Chuyen'])->orderBy('id_Chuyen', 'asc')->orderBy('id', 'asc')->get();
            return NV_BanVeResource::collection($ve);
        }
        else if(isset($_REQUEST['id_User']))
        {
            $user = user::findOrFail($_REQUEST['id_User']);
            $ve = nv_banve::where('id_KhachHang',$user->khachhang->id)->orderBy('id_Chuyen', 'asc')->orderBy('id', 'asc')->paginate(10);
            return NV_BanVeResource::collection($ve);
        }
        else
        {
            return NV_BanVeResource::collection(nv_banve::orderBy('id_Chuyen', 'asc')->orderBy('Ghe', 'asc')->get());
        }
    }

    public function show($id)
    {
        return new NV_BanVeResource(nv_banve::findOrFail($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'id_Chuyen' => 'required|integer|gt:0',
        ]);
        $Loai = chuyenxe::find($request->input('id_Chuyen'))->xe->id_Loai;
        if($Loai == 1)
        {
            $TenGhes = array('A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11','A12','B1','B2','B3','B4','B5','B6','B7','B8','B9','B10','B11','B12');
        }
        else if($Loai == 2)
        {
            $TenGhes = array('A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11','A12','A13','A14','A15','A15','A17','B1','B2','B3','B4','B5','B6','B7','B8','B9','B10','B11','B12','B13','B14','B15','B16','B17');
        }
        else
        {
            return 0;
        }
        foreach($TenGhes as $item)
        {
            $product = nv_banve::create([
                    'id_Chuyen'     => $request->input('id_Chuyen'),
                    'Ghe'  => $item,
            ]);
        }
        $product2 = chuyenxe::find($request->input('id_Chuyen'));
        $product2->Printed = 1;
        $product2->save();
        return response()->json($product, 201);
        
    }

    public function update(Request $request, $id)
    {
        //Nhan Vien Ban Ve
        if($request->input('id_User'))
        {
            $this->validate($request, [
                'id_User' => 'required',
                'TenKhachHang' => 'required',
                'SDT' => 'required',
                'TienCoc' => 'required|integer|gte:0',
            ]);
            $product = nv_banve::find($id);
            $user = user::findOrFail($request->input('id_User'));
            if(isset($user->nhanvien->id))
            {
                $product->id_NhanVien = $user->nhanvien->id;
            }
            $product->id_KhachHang = null;
            $product->TenKhachHang = $request->input('TenKhachHang');
            $product->SDT = $request->input('SDT');
            $product->Code = Str::random(6);
            $product->TienCoc = $request->input('TienCoc');
            $product->save();
        }
        //Mua ve co dang nhap
        else if($request->input('email'))
        {
            $this->validate($request, [
                'email' => 'required',
                'TenKhachHang' => 'required',
                'EmailNhap' => 'required',
                'SDT' => 'required',
                'GiaVe' => 'required',
                'TienCoc' => 'required|integer|gte:0',
                'option_payment' => 'required',
            ]);
            $user = user::where('email', $request->input('email'))->first();

            $khachhang = khachhang::find($user->khachhang->id);
            $khachhang->SoLanMua = $user->khachhang->SoLanMua + 1;
            if($khachhang->SoLanMua < 10)
            {
                $khachhang->id_Loai = 1;
            }else if ($khachhang->SoLanMua < 20)
            {
                $khachhang->id_Loai = 2;
            }else
            {
                $khachhang->id_Loai = 3;
            }
            $khachhang->save();

            $product = nv_banve::find($id);
            $product->TenKhachHang = $request->input('TenKhachHang');
            $product->SDT = $request->input('SDT');
            $product->Email = $request->input('EmailNhap');
            $product->id_KhachHang = $user->khachhang->id;
            $product->Code = Str::random(6);
            $product->paymenting = 1;

            $message = '<table style="background-color:white; color: black" width="700px">
                            <tr style="color:blue">
                                <td style="text-align:center">C??NG TY TNHH M???T TH??NH VI??N<br/> B???N XE MI???N ????NG</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr style="color:blue">
                                <td style="text-align:center">292 ??inh B??? L??nh, P.26, Q.B??nh Th???nh<br/>??i???n tho???i: 35116858 - Fax: 38992094<br/>M?? s??? thu???: 0301092597</td>
                                <td style="text-align:center">S??? v?? 0'.$request->input('CountVe').'</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:center; color:red"><h4>PHI???U ?????T CH???</h4></td>
                            </tr>
                            <tr>
                                <td></td>';

            if($request->input('option_payment') == 'Cash')
            {
                $product->TienCoc = 0;
                $message .= '<td>(Ch??a thanh to??n)</td>';
            }
            else
            {
                $product->TienCoc = $request->input('TienCoc');
                $message .= '<td>(???? thanh to??n)</td>';
            }

            $product->save();
            $message .= '
                                <td>VX260002 0620201114</td>
                            </tr>
                            <tr>
                                <td colspan="3">????n v??? v??n t???i: '.$product->chuyenxe->xe->chuxe->Ten.'</td>
                            </tr>
                            <tr>
                                <td>
                                    S??? Xe: '.$product->chuyenxe->xe->BienSo.' <br/>
                                    Lo???i Xe: '.$product->chuyenxe->xe->loaixe->Ten.' - '.$product->chuyenxe->xe->loaixe->SoGhe.' Gh???<br/>
                                    Ng??y ??i: '.$product->chuyenxe->Ngay.' <br/>
                                    Gi?? V??: '.$product->chuyenxe->GiaVe.' <br/>
                                    ?????a ??i???m ??i: '.$product->chuyenxe->benxe->tuyen->DiaDiem1.'
                                </td>
                                <td>
                                    S??? Gh???: '.$product->Ghe.' <br/> <br/>
                                    Gi??? ??i: '.$product->chuyenxe->Gio.' <br/> <br/>
                                    ?????a ??i???m Tr???: '.$product->chuyenxe->benxe->tuyen->DiaDiem1.'
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>(Bao g???m thu??? GTVT v?? BHHK)</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                +Thanh to??n t???i thi???u 90% ti???n v?? cho h??nh kh??ch ???? mua v?? nh??ng t??? ch???i chuy???n ??i tr?????c ki xe kh???i h??nh ??t nh???t 02 gi??? ?????i v???i tuy???n c??? ?????nh c?? c??? ly t??? 300km tr??? xu???ng v?? ??t nh???t 04 gi??? ?????i v???i tuy???n c??? ?????nh c?? c??? ly tr??n 300km.
                                <br/>+Thanh to??n t???i thi???u 70% ti???n v?? cho h??nh kh??ch ???? mua v?? nh??ng t??? ch???i chuy???n ??i tr?????c khi xe kh???i h??nh ??t nh???t 01 gi??? ?????i v???i tuy???n c??? ?????nh c?? c??? ly t??? 300km tr??? xu???ng v?? ??t nh???t 02 gi??? ?????i v???i tuy???n c??? ?????nh c?? c??? ly tr??n 300km.
                                </td>
                            </tr>
                        </table>';
            $to      = "trannguyenloi99@gmail.com";
            $subject = "Th??ng tin v?? B???n Xe Mi???n ????ng";
            $header  =  "From:miendong@d2439.tino.org \r\n";
            
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $success = mail ($to,$subject,$message,$header);
        }
        //Mua ve khong dang nhap
        else
        {
            $this->validate($request, [
                'TenKhachHang' => 'required',
                'EmailNhap' => 'required',
                'SDT' => 'required',
                'GiaVe' => 'required',
                'TienCoc' => 'required|integer|gte:0',
            ]);
            $product = nv_banve::find($id);
            $product->TenKhachHang = $request->input('TenKhachHang');
            $product->SDT = $request->input('SDT');
            $product->Email = $request->input('EmailNhap');
            $product->Code = Str::random(6);
            $product->paymenting = 1;

            $message = '<table style="background-color:white; color: black" width="700px">
                            <tr style="color:blue">
                                <td style="text-align:center">C??NG TY TNHH M???T TH??NH VI??N<br/> B???N XE MI???N ????NG</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr style="color:blue">
                                <td style="text-align:center">292 ??inh B??? L??nh, P.26, Q.B??nh Th???nh<br/>??i???n tho???i: 35116858 - Fax: 38992094<br/>M?? s??? thu???: 0301092597</td>
                                <td style="text-align:center">S??? v?? 0'.$request->input('CountVe').'</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:center; color:red"><h4>PHI???U ?????T CH???</h4></td>
                            </tr>
                            <tr>
                                <td></td>';

            if($request->input('option_payment') == 'Cash')
            {
                $product->TienCoc = 0;
                $message .= '<td>(Ch??a thanh to??n)</td>';
            }
            else
            {
                $product->TienCoc = $request->input('TienCoc');
                $message .= '<td>(???? thanh to??n)</td>';
            }

            $product->save();
            $message .= '
                                <td>VX260002 0620201114</td>
                            </tr>
                            <tr>
                                <td colspan="3">????n v??? v??n t???i: '.$product->chuyenxe->xe->chuxe->Ten.'</td>
                            </tr>
                            <tr>
                                <td>
                                    S??? Xe: '.$product->chuyenxe->xe->BienSo.' <br/>
                                    Lo???i Xe: '.$product->chuyenxe->xe->loaixe->Ten.' - '.$product->chuyenxe->xe->loaixe->SoGhe.' Gh???<br/>
                                    Ng??y ??i: '.$product->chuyenxe->Ngay.' <br/>
                                    Gi?? V??: '.$product->chuyenxe->GiaVe.' <br/>
                                    ?????a ??i???m ??i: '.$product->chuyenxe->benxe->tuyen->DiaDiem1.'
                                </td>
                                <td>
                                    S??? Gh???: '.$product->Ghe.' <br/> <br/>
                                    Gi??? ??i: '.$product->chuyenxe->Gio.' <br/> <br/>
                                    ?????a ??i???m Tr???: '.$product->chuyenxe->benxe->tuyen->DiaDiem1.'
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>(Bao g???m thu??? GTVT v?? BHHK)</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                +Thanh to??n t???i thi???u 90% ti???n v?? cho h??nh kh??ch ???? mua v?? nh??ng t??? ch???i chuy???n ??i tr?????c ki xe kh???i h??nh ??t nh???t 02 gi??? ?????i v???i tuy???n c??? ?????nh c?? c??? ly t??? 300km tr??? xu???ng v?? ??t nh???t 04 gi??? ?????i v???i tuy???n c??? ?????nh c?? c??? ly tr??n 300km.
                                <br/>+Thanh to??n t???i thi???u 70% ti???n v?? cho h??nh kh??ch ???? mua v?? nh??ng t??? ch???i chuy???n ??i tr?????c khi xe kh???i h??nh ??t nh???t 01 gi??? ?????i v???i tuy???n c??? ?????nh c?? c??? ly t??? 300km tr??? xu???ng v?? ??t nh???t 02 gi??? ?????i v???i tuy???n c??? ?????nh c?? c??? ly tr??n 300km.
                                </td>
                            </tr>
                        </table>';
            $to      = "trannguyenloi99@gmail.com";
            $subject = "Th??ng tin v?? B???n Xe Mi???n ????ng";
            $header  =  "From:miendong@d2439.tino.org \r\n";
            
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $success = mail ($to,$subject,$message,$header);
        }

        return response()->json($product, 201);
    }

    public function delete($id)
    {
        $product = nv_banve::find($id);

        $product->id_NhanVien = null;
        $product->id_KhachHang = null;
        $product->TenKhachHang = null;
        $product->SDT = null;
        $product->Email = null;
        $product->Code = null;
        $product->TienCoc = 0;
        $product->paymenting = 0;

        $product->save();

        return response(['result' => 'success'], 200);
    }
}

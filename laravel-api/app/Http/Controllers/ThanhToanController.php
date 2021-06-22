<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NL_Checkoutv3;
use App\nv_banve;

class ThanhToanController extends Controller
{
    public function Checkout(Request $request)
    {
        $this->validate($request, [
            'id_Chuyen' => 'required',
            'buyer_fullname' => 'required',
            'buyer_email' => 'required',
            'buyer_mobile' => 'required',
            'total_amount' => 'required',
            'option_payment' => 'required',
        ]);
        
        // $nlcheckout= new NL_CheckOutV3('65115','7f736e67823b7280fa311cdfaa16c1d0','trannguyenloi99@gmail.com','https://www.nganluong.vn/checkout.api.nganluong.post.php');
        // $nlcheckout= new NL_CheckOutV3('65102','7a0d37956e8fb395be2187af16f3365e','trannguyenloi99@gmail.com','https://www.nganluong.vn/checkout.api.nganluong.post.php');
        $nlcheckout= new NL_CheckOutV3('36680','matkhauketnoi','trannguyenloi99@gmail.com','https://www.nganluong.vn/checkout.api.nganluong.post.php');
        $total_amount = $request->input('total_amount');
        
        $array_items[0]= array('item_name1' => 'Product name',
                        'item_quantity1' => 1,
                        'item_amount1' => $total_amount,
                        'item_url1' => 'http://nganluong.vn/');
                        
        // $array_items=array();				 
        $payment_method = $request->input('option_payment');
        $bank_code = $request->input('bankcode');
        $order_code ="MDS_".$request->input('id_Chuyen')."_".$request->input('buyer_email')."_".$request->input('buyer_mobile')."_".time();
        
        $payment_type = '';
        $discount_amount = 0;
        $order_description = 'Thanh toán Ngân Lượng tại MienDongStation';
        $tax_amount = 0;
        $fee_shipping = 0;
        $return_url = 'http://localhost:8080/user-payment-success';
        $cancel_url = 'http://localhost:8080/user-payment-fail';
        
        $buyer_fullname = $request->input('buyer_fullname');
        $buyer_email = $request->input('buyer_email');
        $buyer_mobile = $request->input('buyer_mobile');

        $buyer_address ='';

        if($payment_method !='' && $buyer_email !="" && $buyer_mobile !="" && $buyer_fullname !="" && filter_var( $buyer_email, FILTER_VALIDATE_EMAIL )  ){
            if($payment_method =="NL"){
                $nl_result= $nlcheckout->NLCheckout($order_code,$total_amount,$payment_type,$order_description,$tax_amount,
                                                    $fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile, 
                                                    $buyer_address,$array_items);
                                                    
            }elseif($payment_method =="ATM_ONLINE" && $bank_code !='' ){
                $nl_result= $nlcheckout->BankCheckout($order_code,$total_amount,$bank_code,$payment_type,$order_description,$tax_amount,
                                                      $fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile, 
                                                      $buyer_address,$array_items) ;
            }
            //var_dump($nl_result); die;
            if ($nl_result->error_code =='00'){
                
            //Cập nhât order với token  $nl_result->token để sử dụng check hoàn thành sau này
            }
            return response()->json($nl_result, 201);
        }
    }

    public function Result()
    {
        if(isset($_REQUEST['ids']))
        {
            $ids = $_REQUEST['ids'];
            foreach($ids as $id )
            {
                $product = nv_banve::find($id);
                if($product->paymenting == 1)
                {
                    return response()->json('fail', 201);
                }
            }
            foreach($ids as $id )
            {
                $product = nv_banve::find($id);
                $product->paymenting = 1;
                $product->save();
                return response()->json('true', 201);
            }
        }
        else
        {
            //$nlcheckout= new NL_CheckOutV3('65102','7a0d37956e8fb395be2187af16f3365e','trannguyenloi99@gmail.com','https://www.nganluong.vn/checkout.api.nganluong.post.php');
            $nlcheckout= new NL_CheckOutV3('36680','matkhauketnoi','demo@nganluong.vn','https://www.nganluong.vn/checkout.api.nganluong.post.php');
            $nl_result = $nlcheckout->GetTransactionDetail($_REQUEST['token']);
            
            if($nl_result){
                $nl_errorcode           = (string)$nl_result->error_code;
                $nl_transaction_status  = (string)$nl_result->transaction_status;
                if($nl_errorcode == '00') {
                    if($nl_transaction_status == '00') {
                        return response()->json('Đơn hàng đã thanh toán thành công. Hãy xác nhận thanh toán để hoàn tất.', 201);
                    }
                }else{
                    return response()->json($nlcheckout->GetErrorMessage($nl_errorcode), 201);
                }
            }
        }
    }
}
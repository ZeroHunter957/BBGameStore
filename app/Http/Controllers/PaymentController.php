<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momoPayment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $requestId = time() . "";
        $bankCode = "SML";
        $amount = $_POST['total_momo'];
        $orderId = time() . "";
        $orderInfo = "Thanh toán qua MoMo";
        $returnUrl = "http://localhost:8000/user/payment/result";
        $notifyurl = "http://localhost:8000/atm/ipn_momo.php";
        $extraData = "";
        $requestType = "payWithMoMoATM";
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        // Lưu ý: link notifyUrl không phải là dạng localhost
        //before sign HMAC SHA256 signature

        // echo $serectkey;die;
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        // dd($signature);

        $data =  array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        // dd($result);

        error_log(print_r($jsonResult, true));
        dump($request->input('total_momo'));
        return redirect()->to($jsonResult['payUrl']);
    }

    public function handlePaymentResult(Request $request)
    {
        $orderId = $request->query('orderId');
        $amount = $request->query('amount');
        $message = $request->query('message');
        $errorCode = $request->query('errorCode');
        $transId = $request->query('transId');
        $payType = $request->query('payType');

        // Kiểm tra nếu thanh toán thành công
        if ($errorCode == 0) {      
            // Xóa giỏ hàng của user sau khi thanh toán thành công
            Cart::where('user_id', session()->get('accountLogin'))->delete();

            return view('invoice.payment-result', [
                'status' => 'success',
                'message' => 'Thanh toán thành công!',
                'payType' => $payType,
                'order_id' => $orderId,
                'amount' => $amount,
            ]);
        } else {
            return view('invoice.payment-result', [
                'status' => 'error',
                'message' => 'Thanh toán thất bại. Vui lòng thử lại!',
                'order_id' => $orderId,
                'amount' => $amount,
            ]);
        }
    }
}

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

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $_POST['total_momo'];
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/user/payment/result";
        $ipnUrl = "http://127.0.0.1:8000/user/payment/result";
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in thereA
        dump($jsonResult);
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
            Invoice::create([[
                'account_id' => session()->get('accountLogin'),
                'odder_code' => $orderId,
                'payment_method' => '',
                'transaction_id' => $transId,
                'status' => 'success',
                'games' => Cart::where('account_id', session('accountLogin'))->where('product_type', 'game'),
                'accessories' => Cart::where('account_id', session('accountLogin'))->where('product_type', 'accessory'),
            ]]);
            Cart::where('account_id', session()->get('accountLogin'))->delete();

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


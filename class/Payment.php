<?php

class Payment
{
    private static $merchant_id, $amount, $callback_url, $description, $metadata, $RefId;

    public static function setter($data, $description = null)
    {
        self::$merchant_id = get_option('_zarinpal_merchant_id');
        self::$amount = $data['price'] * 10;
        self::$callback_url = 'vip-payment-result';
        self::$description = $description;
        self::$metadata = [
            'email' => $data['email'],
            'mobile' => '09129247303',
        ];
    }


    public static function getRefId()
    {
        //get ref id for display in payment result page
        return self::$RefId;
    }

    public static function gateway()
    {
        $data = array("merchant_id" => self::$merchant_id,
            "amount" => self::$amount,
            "callback_url" => site_url(self::$callback_url),
            "description" => self::$description,
            "metadata" => ["email" => self::$metadata['email'], "mobile" => self::$metadata['mobile']],
        );
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // it just uses for test in local server
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true, JSON_PRETTY_PRINT);
        curl_close($ch);


        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if (empty($result['errors'])) {
                if ($result['data']['code'] == 100) {
                    header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
                }
            } else {
                echo 'Error Code: ' . $result['errors']['code'];
                echo 'message: ' . $result['errors']['message'];

            }
        }


    }

    public static function payment_result()
    {
        $Authority = $_GET['Authority'];
        $data = array("merchant_id" => self::$merchant_id, "authority" => $Authority, "amount" => self::$amount);
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // it just uses for test in local server
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['data']['code'] == 100) {
//                echo 'Transaction success. RefID:' . $result['data']['ref_id'];

                self::$RefId = $result['data']['ref_id']; //set ref id after successful payment as a static property

                // update transaction table after successful payment
                $order_number = Session::get('user_plan_data')['order_number']; //get order number from session
                $transaction = new Transaction();
                $transaction->update(self::$RefId, $order_number); //update transaction table

                // add user as vip user
                $plan_type = Session::get('user_plan_data')['plan_type'];
                User::add_vip_user($plan_type);


            } else {
                echo 'code: ' . $result['errors']['code'];
                echo 'message: ' . $result['errors']['message'];
            }
        }
    }


}


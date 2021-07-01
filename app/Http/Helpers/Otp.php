<?php
namespace App\Http\Helpers;

use DB;
use App\Models\SmsConfig;

class Otp
{
    public static function sendOtp($user)
    {
        $digits = 5;
        $otp = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $user->update(['otp' => $otp]);
        $smsConfig = SmsConfig::whereType('toplusms')->first();

        if(!empty($smsConfig) && $smsConfig->status == 'Active'){
            $smsConfig = json_decode($smsConfig->credentials);
            $curl = curl_init();
            $params = [
                'api_id' => $smsConfig->id,
                'api_key' => $smsConfig->Key,
                'sender' => $smsConfig->default_toplusms_sender,
                'message_type' => 'normal',
                'message' => 'PayMoney OTP is '. $otp,
                'phones' => [
                    $user->formattedPhone
                ]
            ];

            $curl_options = [
                CURLOPT_URL => 'https://api.toplusmspaketleri.com/api/v1/1toN',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($params),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ]
            ];

            curl_setopt_array($curl, $curl_options);
            $response = curl_exec($curl);
            curl_close($curl);

            if(json_decode($response)->status == 'success'){
                return true;
            }
        }

        return false;
    }
}

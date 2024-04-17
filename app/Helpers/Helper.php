<?php

namespace App\Helpers;

use App\Models\OtpToken;
use Brian2694\Toastr\Facades\Toastr;

class Helper
{
    /**
     * Generate a random OTP (One-Time Password) of specified length.
     *
     * @param int $length The length of the OTP (default: 6)
     * @return string The generated OTP
     */
    public static function generateOtp($data)
    {
        $email = $data->email;
        do {
            $otp = strval(random_int(100000, 999999));
            $checkOtp = OtpToken::where('otp', $otp)->first();
        } while ($checkOtp);
        $otpToken = new OtpToken();
        $otpToken->email = $email;
        $otpToken->otp = $otp;
        $otpToken->expires_at = now()->addMinutes(2);
        $otpToken->save();
        return $otp;
    }

    public static function toastrSuccess($message)
    {
        return Toastr::success($message, 'Success', ["positionClass" => "toast-top-right", "progressBar" => true, "timeOut" => "3000"]);
    }

    public static function toastrError($message)
    {
        return Toastr::error($message, 'Error', ["positionClass" => "toast-top-right", "progressBar" => true, "timeOut" => "3000"]);
    }
}

<?php

namespace App\Helpers;

use App\Models\OtpToken;

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
}

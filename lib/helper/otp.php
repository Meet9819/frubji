<?php

namespace SMSModule;

require_once "session.php";

class OTPHelper
{
    // generate new otp
    // returns number
    public static function generate_otp($mobile)
    {
        try {
            // count retries
            $retry = 0;

            $otp_data = SessionHelper::get_session_key(OTP_KEY);

            // if otp is already generated for mobile no., then increment retry by 1
            if (!empty($otp_data)) {
                // reset retry count, if retry timeout is over or mobile number is different
                $retry = ((($otp_data["created"] + OTP_RETRY_TIMEOUT) > time()) && ($otp_data["mobile"] == $mobile)) ? ++$otp_data["retry"] : 1;
            }

            // check retries
            if ($retry > OTP_MAX_RETRY) {
                throw new \Exception("Number of retries maxed out. Please try again after sometime or use another mobile no.");
            }

            $otp = rand(OTP_MIN_VAL, OTP_MAX_VAL);

            $otp_data = array(
                "mobile" => $mobile,
                "otp" => $otp,
                "created" => time(),
                "retry" => $retry,
            );

            // set otp to session
            SessionHelper::set_session_key(OTP_KEY, $otp_data);

            return $otp;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // compare otp received with stored in session
    // returns boolean
    public static function verify_otp($otp)
    {
        try {
            $otp_verified = false;

            $otp_data = SessionHelper::get_session_key(OTP_KEY);

            if (empty($otp_data)) {
                return $otp_verified;
            }

            $otp_verified = (isset($otp_data["otp"]) && ($otp_data["otp"] == $otp) && (($otp_data["created"] + OTP_TIMEOUT) > time()));

            if ($otp_verified) {
                SessionHelper::remove_session_key(OTP_KEY);
            }

            return $otp_verified;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

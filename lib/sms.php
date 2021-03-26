<?php

namespace SMSModule;

require_once "helper/otp.php";

// site config
const SITE_NAME = "frubji.com";

// sms gateway config
const SMS_GATEWAY_URL = "http://makemysms.in/api/sendsms.php";
const SMS_USER = "frubji";
const SMS_PSSWD = "Frubji@123";

// sms basic config
const SMS_SENDER_ID = "FRUBJI";
const SMS_PRODUCT_TYPE = "1";

// timeout in seconds
const OTP_TIMEOUT = 300;
const OTP_RETRY_TIMEOUT = 3600;

// otp generation range
const OTP_MIN_VAL = 100000;
const OTP_MAX_VAL = 999999;
const OTP_MAX_RETRY = 3;

// otp session key
const OTP_KEY = "OTP";

interface ISMS
{
    public function set_sms_url();
    public function send_sms();
}

interface IOTP
{
    public static function verify_otp($otp);
}

abstract class SMS implements ISMS
{
    protected $mobile = null;

    protected $sms_url = null;

    // curl options
    private static $CURL_OPTS = array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_FOLLOWLOCATION => 0,
        CURLOPT_ENCODING => "",
        CURLOPT_USERAGENT => SITE_NAME,
        CURLOPT_AUTOREFERER => 1,
        CURLOPT_CONNECTTIMEOUT => 120,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_MAXREDIRS => 10,
    );

    public function __construct($mobile)
    {
        $this->mobile = $mobile;
        $this->set_sms_url();
    }

    /*
     * Set sms url, implement in derived class
     * returns void
     */
    abstract public function set_sms_url();

    /*
     * send SMS to set sms url
     * returns assoc array containing response status code, headers, body and error (if any)
     */
    public function send_sms()
    {
        try {
            $curl_handle = curl_init($this->sms_url);

            curl_setopt_array($curl_handle, SMS::$CURL_OPTS);

            $response = curl_exec($curl_handle);
            $errmsg = curl_error($curl_handle);
            $http_status_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
            $header = curl_getinfo($curl_handle);

            curl_close($curl_handle);

            return array(
                "statuscode" => $http_status_code,
                "header" => $header,
                "body" => json_decode($response, true),
                "error" => $errmsg,
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

class OTPSMS extends SMS implements IOTP
{
    // implemented base class method abstraction
    public function set_sms_url()
    {
        try {
            #region set SMS body
            // generate OTP
            $otp = OTPHelper::generate_otp($this->mobile);

            $sms_content = "Your verification OTP is {$otp}. Please enter your OTP on registration page and continue with registration.";

            // trim sms body
            $sms_content = substr($sms_content, 0, 139);

            $sms_content = urlencode($sms_content);
            #endregion

            #region set send SMS url
            $credentials = "username=" . SMS_USER . "&password=" . SMS_PSSWD;

            $data = "&sender=" . SMS_SENDER_ID . "&mobile={$this->mobile}&type=1&product=" . SMS_PRODUCT_TYPE . "&message={$sms_content}";

            $this->sms_url = SMS_GATEWAY_URL . "?{$credentials}{$data}";
            #endregion
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function verify_otp($otp)
    {
        try {
            return OTPHelper::verify_otp($otp);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

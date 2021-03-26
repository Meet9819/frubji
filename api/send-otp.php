<?php

namespace api\otp\generate;

require_once "../lib/sms.php";

$mobile = $_GET["mobile"] ?? null;

if (empty($mobile)) {
    http_response_code(400);
    echo json_encode(array(
        "status" => false,
        "message" => "Mobile no. required",
    ));
    return;
} else if (empty(preg_match('/^[7-9]{1}[0-9]{9}+$/', $mobile))) {
    http_response_code(400);
    echo json_encode(array(
        "status" => false,
        "message" => "Mobile no. invalid",
    ));
    return;
} else {
    try {
        $otp_status = new \SMSModule\OTPSMS($mobile);

        $response = $otp_status->send_sms();

        if (!empty($response["body"]["code"]) && ($response["body"]["code"] == 201)) {
            http_response_code(200);
            echo json_encode(array(
                "status" => true,
                "message" => "OTP generated successfully",
            ));
            return;
        } else {
            throw new Exception("Some internal server error occured");
        }
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(array(
            "status" => false,
            "message" => $th->getMessage(),
        ));
        return;
    }
}

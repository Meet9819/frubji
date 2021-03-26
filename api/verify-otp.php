<?php

namespace api\otp\generate;

require_once "../lib/sms.php";

$otp = $_GET["otp"] ?? null;

if (empty($otp)) {
    http_response_code(400);
    echo json_encode(array(
        "status" => false,
        "message" => "OTP not received",
    ));
    return;
} else if (strlen($otp) != 6) {
    http_response_code(400);
    echo json_encode(array(
        "status" => false,
        "message" => "OTP should be 6 digits long",
    ));
    return;
} else {
    try {
        $verified = \SMSModule\OTPSMS::verify_otp((int) $otp);

        http_response_code(200);
        echo json_encode(array(
            "status" => true,
            "verified" => $verified,
        ));
        return;
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(array(
            "status" => false,
            "message" => $th->getMessage(),
        ));
        return;
    }
}

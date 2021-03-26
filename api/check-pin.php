<?php

require_once "../lib/branch.php";
require_once '../db.php';

if (empty($_SESSION)) {
    session_start();
}

try {
    $pin = $_GET["pin"] ?? "";

    if (empty($pin)) {
        http_response_code(400);
        echo json_encode(array(
            "status" => false,
            "message" => "Please enter pincode",
        ));
        return;
    }

    try {
        $data = Branch\BranchDetails::get_branch_details_pincode($pin, $con);

        if (empty($data) || empty($data['pincode'])) {
            // get price master by pincode
            $_SESSION["branch"] = array();

            http_response_code(200);
            echo json_encode(array(
                "status" => false,
                "message" => "Sorry, We Don't Deliver in Your Area",
            ));
        } else {
            // get price master by pincode
            $_SESSION["branch"] = $data;

            http_response_code(200);
            echo json_encode(array(
                "status" => true,
                "message" => "We Deliver in Your Area",
            ));
        }
    } catch (\Throwable $th) {
        throw $th;
    } finally {
        mysqli_close($con);
    }

    return;
} catch (\Throwable $th) {
    http_response_code(500);
    echo json_encode(array(
        "status" => false,
        "message" => "Internal server error",
    ));
    return;
}

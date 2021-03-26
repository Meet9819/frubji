<?php
include "../db.php";

$type = empty($_GET["type"]) ? null : $_GET["type"];
$id = empty($_GET["id"]) ? null : $_GET["id"];

if (is_null($type) || is_null($id)) {
    http_response_code(400);
    echo json_encode(array(
        "status" => false,
    ));
} else if ($type == "address") {
    $query = "DELETE FROM `employee_address` WHERE `id` = " . $id;
    $req = mysqli_query($con, $query);
    if ($req) {
        http_response_code(200);
        echo json_encode(array(
            "status" => true,
        ));
    } else {
        http_response_code(500);
        echo json_encode(array(
            "status" => false,
        ));
    }
} 


 else {
    http_response_code(400);
    echo json_encode(array(
        "status" => false,
    ));
}

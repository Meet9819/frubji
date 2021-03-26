<?php

require_once '../class.user.php';
require_once '../db.php';

try {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $user_home = new USER();

    if (!$user_home->is_logged_in()) {
        http_response_code(401);
        echo json_encode(array(
            "status" => false,
            "message" => "Unauthorized",
        ));
        return;
    }

    $product = (int) $_GET["product"];
    $variant = (int) $_GET["variant"];

    if (empty($product) || empty($variant)) {
        http_response_code(400);
        echo json_encode(array(
            "status" => false,
            "message" => "Invalid product and variant",
        ));
        return;
    }

    $userID = $_SESSION["userSession"];

    $wishlist_exists_query = "SELECT COUNT(1) AS `exists` FROM `wishlist` WHERE `product_id` = {$product} AND `user_id` = {$userID}";
    $result = mysqli_query($con, $wishlist_exists_query);

    $output = mysqli_fetch_assoc($result);

    if ($output['exists']) {
        http_response_code(400);
        echo json_encode(array(
            "status" => false,
            "message" => "Product already wishlisted",
        ));
        return;
    }

    $wishlist_query = "INSERT INTO `wishlist`(`user_id`, `product_id`, `variant_id`) VALUES ($userID, $product, $variant)";
    $result = mysqli_query($con, $wishlist_query);

    http_response_code(201);
    echo json_encode(array(
        "status" => true,
        "message" => "Product wishlisted",
    ));
    return;
} catch (\Throwable $th) {
    http_response_code(500);
    echo json_encode(array(
        "status" => false,
        "message" => "Product already wishlisted",
    ));
    return;
}

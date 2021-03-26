<?php

include 'Cart.php';
$cart = new Cart;

require_once "db.php";
//
$DB_HOST = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'frubji';

try {
    $db = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}", $DB_USERNAME, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userID = (int) trim($_POST['userID']);
    $lastname = trim($_POST['lastname']);
    $state = trim($_POST['state']);
    $pincode = (int) trim($_POST['pincode']);
    $address = trim($_POST['address']);

    if (!isset($errMSG)) {
        $stmt = $db->prepare("UPDATE
                `tbl_users`
            SET
                `lastname` = :lastname,
                `state` = :state,
                `address` = :address,
                `pincode` = :pincode

            WHERE
                `userID` = :userID");

        $stmt->bindParam(':pincode', $pincode);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':address', $address);

        if (!$stmt->execute()) {
            $errMSG = "Failed to save shipping details! Please try again";
            return;
        }
    }
    ?>
    <script>
        alert('Shipping details saved successfully! Processing order please wait!');
    </script>
    <?php
$representativeid = $con->real_escape_string($_POST['representativeid']);
    $representativecommission = $con->real_escape_string($_POST['representativecommission']);
    $name = $con->real_escape_string($_POST['name']);
    $email = $con->real_escape_string($_POST['email']);
    $phone = $con->real_escape_string($_POST['phone']);
    $product_name = $con->real_escape_string($_POST['product_name']);
    $product_price = $con->real_escape_string($_POST['product_price']);
    $address = $con->real_escape_string($_POST['address']);
    $productcode = $con->real_escape_string($_POST['productcode']);
    $billno = $con->real_escape_string($_POST['billno']);
    $created = $con->real_escape_string($_POST['created']);
    $datee = $con->real_escape_string($_POST['datee']);

    $stmt = $db->prepare("INSERT INTO `payment`
        (`representativeid` , `representativecommission`, `name`, `email`, `phone`, `product_name`, `product_price`, `address`, `productcode`, `billno`, `created`, `modeofpayment`, `datee`)
        VALUES(:representativeid, :representativecommission, :payee_name, :payee_email, :payee_mobile, :product, :price, :address, :code, :bill_no, :created, :mode, :datee)");

    if ($stmt->execute(array(
        ":representativeid" => $representativeid,
        ":representativecommission" => $representativecommission,
        ":payee_name" => $name,
        ":payee_email" => $email,
        ":payee_mobile" => $phone,
        ":product" => $product_name,
        ":price" => $product_price,
        ":address" => $address,
        ":code" => $productcode,
        ":bill_no" => $billno,
        ":created" => $created,
        ":mode" => "COD",
        ":datee" => $datee,
    ))) {

        //thankyou.php?payment_id=MOJO0725G05A74708182&payment_status=Credit&payment_request_id=cec24aab382041629a9a9c8d01e9ada1

        $cart->destroy();
        header("Location: thankyoucod.php?payment_status=Success&mode=COD&payment_id=$billno&payment_request_id=COD$billno&emailidofbuyer=$email");
    } else {
        header("Location: razorpay/thankyou.php?payment_status=Failed&mode=COD");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

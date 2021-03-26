<?php

require_once 'Razorpay.php';
require_once "db.php";

use Razorpay\Api\Api;

session_start();

$DB_HOST = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'frubji';

$RAZORPAY_API_KEY = "rzp_test_IBYF6BLbafNp1O";
$RAZORPAY_API_SECRET = "7aa8lve68XwZnZ40EmxD3yya";

try {
    $db = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}", $DB_USERNAME, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$userID = $_POST['userID'];
$lastname = $_POST['lastname'];
$state = $_POST['state'];
$pincode = trim($_POST['pincode']);
$address = trim($_POST['address']);
$country = trim($_POST['country']);

$shiptostate = $_POST['shiptostate'] ?? $state;
$shiptopincode = $_POST['shiptopincode'] ?? $pincode;
$shiptocountry = $_POST['shiptocountry'] ?? $country;
$shiptoaddress = $_POST['shiptoaddress'] ?? "{$address} {$shiptostate}-{$shiptopincode}";

if (!isset($errMSG)) {
    $stmt = $db->prepare('UPDATE
        tbl_users
      SET
        lastname=:lastname,
        state=:state,
        address=:address,
        pincode=:pincode,
        country=:country,
        shiptoaddress=:shiptoaddress,
        shiptostate=:shiptostate,
        shiptopincode=:shiptopincode,
        shiptocountry=:shiptocountry
      WHERE userID=:userID');

    $stmt->bindParam(':pincode', $pincode);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':country', $country);

    $stmt->bindParam(':shiptoaddress', $shiptoaddress);
    $stmt->bindParam(':shiptostate', $shiptostate);
    $stmt->bindParam(':shiptopincode', $shiptopincode);
    $stmt->bindParam(':shiptocountry', $shiptocountry);

    if (!$stmt->execute()) {
        $errMSG = "Sorry Data Could Not Updated !";
        print($errMSG);
        exit();
    }
}

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
$frubji_reference_id = uniqid("FRUBJI-PAYMENT-{$billno}");

$result = mysqli_query($con, "INSERT INTO payment (name,email,phone,product_name,product_price,address,productcode,billno,created,modeofpayment,datee, reference_no) VALUES('$name','$email','$phone','$product_name','$product_price','$address','$productcode','$billno','$created','Online Payment','$datee', '$frubji_reference_id')");

$product_name = $_POST["product_name"];
$price = $_POST["product_price"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$billno = $_POST['billno'];

try {
    $api = new Api($RAZORPAY_API_KEY, $RAZORPAY_API_SECRET);

    $invoice_data = array(
        'type' => 'link',
        'amount' => $price * 100,
        'description' => "Payment for FRUBJI, Bill No. {$billno}, Total Bill: {$price}",
        'customer' => array(
            'name' => trim($name),
            'email' => trim($email),
            'contact' => trim($phone),
        ),
        'currency' => 'INR',
        'receipt' => $frubji_reference_id,
        'reminder_enable' => true,
        'expire_by' => time() + (1 * 60 * 60),
        'callback_url' => 'http://localhost/frubji/razorpay/thankyou.php',
        'callback_method' => 'get',
    );

    $payment_url_response = $api->invoice->create($invoice_data);

    if (!empty($payment_url_response->status) && ($payment_url_response->status == "issued")) {
        $payment_id = $payment_url_response->id;
        $payment_url = $payment_url_response->short_url;
        $payment_ref = $payment_url_response->receipt;
        $invoice_id = $payment_url_response->invoice_number;
        $payment_order_id = $payment_url_response->order_id;

        $result = mysqli_query($con, "UPDATE payment SET razor_invoice_id = '{$invoice_id}', razor_order_id = '{$payment_order_id}' WHERE reference_no = '{$payment_ref}'");

        $_SESSION["razorpay_invoice_id"] = $payment_id;
        $_SESSION["razorpay_order_id"] = $payment_order_id;

        header("Location: {$payment_url}");
    } else {
        print('error');
    }
} catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}

<?php

include "db.php";

$DB_HOST = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'frubji';

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

    if ($stmt->execute()) {
        ?>
                            <script>
                               alert('Successfully Updated ...');
                              //  window.location.href = 'checkout.php';
                            </script>
                            <?php
} else {
        $errMSG = "Sorry Data Could Not Updated !";
    }
}

include "db.php";

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

$result = mysqli_query($con, "INSERT INTO payment (name,email,phone,product_name,product_price,address,productcode,billno,created,modeofpayment,datee) VALUES('$name','$email','$phone','$product_name','$product_price','$address','$productcode','$billno','$created','Online Payment','$datee')");

?>
                <script>
                alert('Thank You ...');

              //  window.location.href='thankyou.php';
                </script>


      <?php
$product_name = $_POST["product_name"];
$price = $_POST["product_price"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];

$billno = $_POST['billno'];

include 'src/instamojo.php';

// testing                                Private API Key                     Private Auth Token
//$api = new Instamojo\Instamojo('test_a66097619a655b9655e4457e2c1', 'test_bdd7fed870ff4c7ba2b92af3938','https://test.instamojo.com/api/1.1/');

$api = new Instamojo\Instamojo('rzp_test_IBYF6BLbafNp1O', '7aa8lve68XwZnZ40EmxD3yya', 'https://test.instamojo.com/api/1.1/');

try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => "Payment for FRUBJI, Bill No. {$billno}",
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://frubji.in/instamojo/thankyou.php",
        "webhook" => "http://frubji.in/instamojo/webhook.php",
    ));
    //print_r($response);

    $pay_ulr = $response['longurl'];

    //Redirect($response['longurl'],302); //Go to Payment page

    // $cart->destroy();

    header("Location: {$pay_ulr}");
    exit();

} catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
?>

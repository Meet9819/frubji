<?php
include"db.php";
// INSERT
if(isset($_POST['save']))
{

$paymentid = $con->real_escape_string($_POST['paymentid']);
$email = $con->real_escape_string($_POST['email']);

$result = mysqli_query($con,"UPDATE payment SET paymentid='$paymentid' WHERE email='$email'");
   
   
                ?>
                <script>
                alert('Will Contact you soon ...');
                 window.location.href='../index.php';
                </script>
                <?php
}
?>

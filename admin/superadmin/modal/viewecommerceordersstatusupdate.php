     <?php 
	   include "../conn.php";



	 $_POST['status'];
	 $_GET["order_id"];

	   $updatestatus = "UPDATE ecommerce_order_payment_details SET status = '".$_POST['status']."'
	    WHERE order_id= '" . $_GET["order_id"] . "' "; 



	   $query = mysqli_query($conn, $updatestatus) or die(mysqli_error($conn));

	    

	  header('location:../ecommerceorders.php');

	?> 
               
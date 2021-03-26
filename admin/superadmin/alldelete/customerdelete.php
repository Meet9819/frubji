

                    <?php
  include('../conn.php');
  $id=$_GET['id'];
     mysqli_query($conn,"delete from customer where id='$id'");
     mysqli_query($conn,"delete from customer_bank where customerid='$id'");
	 mysqli_query($conn,"delete from customer_telephone where customerid='$id'");
     mysqli_query($conn,"delete from customerimages where idd='$id'");
        header('location:../customermaster.php');

?> 
               
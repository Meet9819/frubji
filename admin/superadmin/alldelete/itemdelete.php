
<?php
  include('../conn.php');
  $id=$_GET['id'];
  mysqli_query($conn,"delete from   products where id='$id'");
  mysqli_query($conn,"delete from productprice where productid='$id'");
  mysqli_query($conn,"delete from   productimages where idd='$id'");
     header('location:../itemmaster.php');
?> 
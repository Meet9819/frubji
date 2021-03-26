     <?php 
	   include "../conn.php";



 
echo $_POST['id'];
echo $_POST['password'];
echo $_POST['username'];

  $leadstatus = "UPDATE employee SET username='".$_POST['username']."', password ='".$_POST['password']."'  WHERE id='" . $_POST["id"] . "'";
	  $query = mysqli_query($conn, $leadstatus) or die(mysqli_error($conn));

	

	   header('location:../profile.php');

	?> 
              
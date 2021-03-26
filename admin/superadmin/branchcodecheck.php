<?php  
//check.php  
$connect = mysqli_connect("localhost","root","","frubji"); 
if(isset($_POST["user_name"]))
{
 $username = mysqli_real_escape_string($connect, $_POST["user_name"]);
 $query = "SELECT branchcode FROM branch WHERE branchcode = '".$username."'"; 

 $result = mysqli_query($connect, $query);
 echo mysqli_num_rows($result);
}
?>
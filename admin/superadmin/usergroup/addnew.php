<?php
include ("../db.php");

if(isset($_POST["submit"]))
  { 
     


  $role_rolecode=$_POST['role_rolecode'];
  


        //header 
        $insert = "INSERT INTO role( role_rolecode) VALUES ( '$role_rolecode')";

       $query =  mysqli_query($con,$insert) or die(mysqli_error($con));
     


   
  header('location:../usergroup.php');

}

?>
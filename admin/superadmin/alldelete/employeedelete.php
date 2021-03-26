 <?php
  include('../conn.php');
  $id=$_GET['id'];
  mysqli_query($conn,"delete from employee where id='$id'");
  mysqli_query($conn,"delete from employee_bank where employeeid='$id'");
  mysqli_query($conn,"delete from employee_address where employeeid='$id'");
  mysqli_query($conn,"delete from employee_telephone where employeeid='$id'");
  mysqli_query($conn,"delete from employee_allocation where employeeid='$id'");
  mysqli_query($conn,"delete from employee_spouse where employeeid='$id'");
  mysqli_query($conn,"delete from employee_salary where employeeid='$id'");
  mysqli_query($conn,"delete from employeeimages where idd='$id'");
        header('location:../employeemaster.php');
?> 
    
<?php
include('../db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO stockdeduction (branch, productid, type, qty, image,datee) 
			VALUES (:branch, :productid, :type, :qty, :image, :datee)
		");
		$result = $statement->execute(
			array(
				':branch'	=>	$_POST["branch"],
				':productid'	=>	$_POST["productid"],
				':type'	=>	$_POST["type"],
				':qty'	=>	$_POST["qty"],
				':image'		=>	$image,
				':datee'	=>	$_POST["datee"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE stockdeduction 
			SET branch = :branch, productid = :productid, type = :type, qty = :qty, image = :image  , datee = :datee
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':branch'	=>	$_POST["branch"],
				':productid'	=>	$_POST["productid"],
				':type'	=>	$_POST["type"],
				':qty'	=>	$_POST["qty"],
				':image'		=>	$image,
				':datee'	=>	$_POST["datee"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>
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
			INSERT INTO channelpartner (name, address, mobile, email, image, percentage, bankaccountno, bankifsccode) 
			VALUES (:name, :address, :mobile, :email, :image, :percentage, :bankaccountno, :bankifsccode)
		");
		$result = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':address'	=>	$_POST["address"],
				':mobile'	=>	$_POST["mobile"],
				':email'	=>	$_POST["email"],
				':percentage'	=>	$_POST["percentage"],
				':bankaccountno'	=>	$_POST["bankaccountno"],
				':bankifsccode'	=>	$_POST["bankifsccode"],
				':image'		=>	$image
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
			"UPDATE channelpartner 
			SET name = :name, address = :address, mobile = :mobile, email = :email, image = :image,  percentage = :percentage, bankaccountno = :bankaccountno, bankifsccode = :bankifsccode   
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':address'	=>	$_POST["address"],
				':mobile'	=>	$_POST["mobile"],
				':email'	=>	$_POST["email"],
				':percentage'	=>	$_POST["percentage"],
				':bankaccountno'	=>	$_POST["bankaccountno"],
				':bankifsccode'	=>	$_POST["bankifsccode"],
				':image'		=>	$image,
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
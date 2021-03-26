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
			INSERT INTO farmers (name, address, mobile, email, image,bankname,branchname,accountno,ifsccode) 
			VALUES (:name, :address, :mobile, :email, :image,:bankname,:branchname,:accountno,:ifsccode)
		");
		$result = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':address'	=>	$_POST["address"],
				':mobile'	=>	$_POST["mobile"],
				':email'	=>	$_POST["email"],
				':image'		=>	$image,
				':bankname'	=>	$_POST["bankname"],
				':branchname'	=>	$_POST["branchname"],
				':accountno'	=>	$_POST["accountno"],
				':ifsccode'	=>	$_POST["ifsccode"],
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
			"UPDATE farmers 
			SET name = :name, address = :address, mobile = :mobile, email = :email, image = :image , bankname=:bankname,branchname=:branchname,accountno=:accountno,ifsccode=:ifsccode 
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':address'	=>	$_POST["address"],
				':mobile'	=>	$_POST["mobile"],
				':email'	=>	$_POST["email"],
				':image'		=>	$image,
				':bankname'	=>	$_POST["bankname"],
				':branchname'	=>	$_POST["branchname"],
				':accountno'	=>	$_POST["accountno"],
				':ifsccode'	=>	$_POST["ifsccode"],
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
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
			INSERT INTO ecommerceadveritse (title, shortdescription,price, buttonname, link, image, sequence) 
			VALUES (:title, :shortdescription, :price,:buttonname,:link, :image, :sequence)
		");
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':shortdescription'	=>	$_POST["shortdescription"],
				':price'	=>	$_POST["price"],
				':buttonname'	=>	$_POST["buttonname"],
				':link'	=>	$_POST["link"],
				':sequence'	=>	$_POST["sequence"],
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
			"UPDATE ecommerceadveritse 
			SET title = :title, shortdescription = :shortdescription,price= :price, buttonname =:buttonname, link = :link, image = :image, sequence =:sequence  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':shortdescription'	=>	$_POST["shortdescription"],
				':price'	=>	$_POST["price"],
				':buttonname'	=>	$_POST["buttonname"],
				':link'	=>	$_POST["link"],
				':sequence'	=>	$_POST["sequence"],
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
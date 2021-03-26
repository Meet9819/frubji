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
			INSERT INTO manufacture (title, image, etitle, allowonecommerce, shortname) 
			VALUES (:title, :image, :etitle, :allowonecommerce,:shortname)
		");
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':etitle'	=>	$_POST["etitle"],
				':shortname'	=>	$_POST["shortname"],
				':allowonecommerce'	=>	$_POST["allowonecommerce"],
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
			"UPDATE manufacture 
			SET title = :title, image = :image , etitle =:etitle, allowonecommerce =:allowonecommerce, shortname =:shortname
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':etitle'	=>	$_POST["etitle"],
				':allowonecommerce'	=>	$_POST["allowonecommerce"],
				':shortname'	=>	$_POST["shortname"],
			
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
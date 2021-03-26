<?php

include('db.php');
include("function.php");

if(isset($_POST["id"]))
{
	
	$statement = $connection->prepare(
		"DELETE FROM ecommercecategory WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["id"]
		)
	);

	$statement = $connection->prepare(
		"DELETE FROM ecommercecategory_products WHERE ecommercecategoryid = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>
<?php

include "../levelscrud/db.php";
include("staticpagesfunction.php");

if(isset($_POST["id"]))
{
	
	$statement = $connection->prepare(
		"DELETE FROM e_staticpages WHERE id = :id"
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
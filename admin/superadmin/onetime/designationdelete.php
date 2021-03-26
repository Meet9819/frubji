<?php
include "../levelscrud/db.php";
include("designationfunction.php");
if(isset($_POST["id"]))
{	
	$statement = $connection->prepare(
		"DELETE FROM designation WHERE id = :id"
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
<?php

include "../levelscrud/db.php";
include("faqfunction.php");

if(isset($_POST["id"]))
{
	
	$statement = $connection->prepare(
		"DELETE FROM faq WHERE id = :id"
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
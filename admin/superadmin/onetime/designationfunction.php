<?php
function get_total_all_records()
{
include "../levelscrud/db.php";
	$statement = $connection->prepare("SELECT * FROM designation");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
?>
<?php 
if (!isset($_SESSION)) {
    session_start();
}
include "../levelscrud/db.php";
include('faqfunction.php');
require_once "../functions.php";
$query = '';
$output = array(); 


$edit_access = authorize($_SESSION['access']['ECOMMERCE']['FAQ']['edit']);
$delete_access = authorize($_SESSION['access']['ECOMMERCE']['FAQ']['delete']);



$query .= "SELECT * from faq";


$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();$tmpCount = 1;
foreach($result as $row)
{
	
	$sub_array = array();
$sub_array[] = $tmpCount++;

		$sub_array[] = $row["question"];
		$sub_array[] = $row["answer"];		

 
  if ($edit_access) {
        $sub_array[] = '<button type="button" name="update" id="' . $row["id"] . '" class="btn btn-success btn-xs update">Edit</button>';
    } else {
        $sub_array[] = '';
    }

    if ($delete_access) {
        $sub_array[] = '<button type="button" name="delete" id="' . $row["id"] . '" class="btn btn-danger btn-xs delete">Delete</button>';
    } else {
        $sub_array[] = '';
    }
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>
<?php 
if (!isset($_SESSION)) {
    session_start();
}
include "../levelscrud/db.php";
include('staticpagesfunction.php');
require_once "../functions.php";
$query = '';
$output = array();


$edit_access = authorize($_SESSION['access']['ECOMMERCE']['STATICPAGES']['edit']);
$delete_access = authorize($_SESSION['access']['ECOMMERCE']['STATICPAGES']['delete']);


$query .= "SELECT * FROM e_staticpages ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE title LIKE "%'.$_POST["search"]["value"].'%" ';
	
}

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();$tmpCount = 1;
foreach($result as $row)
{
	
	$sub_array = array();


        $sub_array[] = $tmpCount++;
		$sub_array[] = $row["title"];


 
  if ($edit_access) {
        $sub_array[] = '<a href="staticpagesedit.php?q='.$row['id'].'" type="button" name="update" id="' . $row["id"] . '" class="btn btn-success btn-xs update">Edit</a>';
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
	
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>
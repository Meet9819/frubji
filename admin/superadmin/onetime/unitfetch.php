<?php

if (!isset($_SESSION)) {
    session_start();
}
include "../levelscrud/db.php";
include('unitfunction.php');
require_once "../functions.php";

$query = '';
$output = array(); 

$edit_access = authorize($_SESSION['access']['MASTER']['UNIT']['edit']);
$delete_access = authorize($_SESSION['access']['MASTER']['UNIT']['delete']);


$query .= "SELECT * FROM unit ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE unit LIKE "%'.$_POST["search"]["value"].'%" ';
	
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
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
		$sub_array[] = $row["unit"];


   

 
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
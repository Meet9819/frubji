<?php
include('../db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT se.id,se.branch,b.branchname_english, se.image,se.type,se.productid,p.name,se.qty,se.datee FROM stockdeduction se, branch b, products p where se.branch = b.id and se.productid = p.id ";

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="ecommerce/stockdeductionimages/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $image;
	$sub_array[] = $row["branchname_english"];
	$sub_array[] = $row["type"];
	$sub_array[] = $row["name"];
	$sub_array[] = $row["qty"];
	$sub_array[] = $row["datee"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-success btn-xs update">Edit</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
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
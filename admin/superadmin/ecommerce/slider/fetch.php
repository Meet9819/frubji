<?php
include('../db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM slider ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE title LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR shortdescription LIKE "%'.$_POST["search"]["value"].'%" ';
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
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="ecommerce/sliderimages/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $row["sequence"];
	$sub_array[] = $image;
	$sub_array[] = $row["title"];
	$sub_array[] = $row["shortdescription"];
	$sub_array[] = $row["price"];
	$sub_array[] = $row["buttonname"];
	
   if ($row['status'] == '1') {
        $sub_array[] = '<span data="'.$row['id'].'" class="status_checks btn-sm label label-success "> Active</span>';
    } else {
        $sub_array[] = '<span data="'.$row['id'].'" class="status_checks btn-sm label label-danger "> Inactive</span>';
    }

	
	
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
<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM ecommercecategory ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE title LIKE "%'.$_POST["search"]["value"].'%" ';
	
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
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

	$sub_array[] = $row["type"];   
	$sub_array[] = $row["title"];  
	$sub_array[] = $row["startdate"];  
	$sub_array[] = $row["enddate"];  




$sub_array[] =   $row["status"];


	$sub_array[] = $row["sequence"];




	$sub_array[] = '<a href="ecommercecategoryitems.php?add='.$row["id"].'"><span  class="btn-sm label label-info">  Add Items </span> </a>
					';

	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-default  btn-icon-anim  btn-square update"><i class="fa fa-pencil"></i></button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger  btn-icon-anim  btn-square delete"><i class="fa fa-trash"></i></button>'; 
		
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
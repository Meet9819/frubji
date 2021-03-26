<?php include "db.php"; ?>

<?php
$columns = array('type', 'subject', 'email', 'password');

$query = "SELECT * FROM e_emailsetting ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE type LIKE "%'.$_POST["search"]["value"].'%" 
 OR email LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="type" style="padding: 5px">' . $row["type"] . '</div>';
 $sub_array[] = '<div  contenteditable class="update" data-id="'.$row["id"].'" data-column="subject" style="padding: 5px">' . $row["subject"] . '</div>';
 $sub_array[] = '<div  contenteditable class="update" data-id="'.$row["id"].'" data-column="email">' . $row["email"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="password">' . $row["password"] . '</div>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM e_emailsetting";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>

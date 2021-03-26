<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["companyid"])) {
	$query ="SELECT * FROM branch WHERE company_shortname = '" . $_POST["companyid"] . "'";
	$results = $db_handle->runQuery($query);
	?>
	<option value="">Select Co.</option>
	<?php
	foreach($results as $branch) {
	?>
	<option value="<?php echo $branch["branchcode"]; ?>"><?php echo $branch["branchcode"]; ?></option>
	<?php
	}
}
?>
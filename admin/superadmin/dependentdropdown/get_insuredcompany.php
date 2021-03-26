<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["insurance_id"])) {
	$query ="SELECT * FROM insurancepatientscompany WHERE insuranceid = '" . $_POST["insurance_id"] . "'";
	$results = $db_handle->runQuery($query);
?>
	<option value="">Select Insured Company</option>
<?php
	foreach($results as $insuredcompany) {
?>
	<option value="<?php echo $insuredcompany["id"]; ?>"><?php echo $insuredcompany["patientcompanyname"]; ?></option>
<?php
	}
}
?>
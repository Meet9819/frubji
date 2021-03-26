<?php include "allcss.php";?>
<?php include "header.php";?>

<?php
$current_role = isset($_GET['add']) ? trim($_GET['add']) : "";
?>

        <div class="page-wrapper">
            <div class="container-fluid">

                <div class="row heading-bg">
                    <div class="col-md-3 ">
                        <h5 class="txt-dark">User Roles</h5>
                    </div>

                    <div class="col-md-9">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="usergroup.php"><span>Master</span></a></li>
                            <li><a href="usergroup.php"><span>Process Control</span></a></li>

                            <li class="active"><span>User Rights </span></li>

                        </ol>
                    </div>

                </div>






<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Add Roles</h4>
                </div>
            </div>
            <div class="panel-body">

                    <div class="form-group row">
                        <label for="role_name" class="col-xs-3 col-form-label">Select Group Name <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                             <select id="groupNameDropdown" name="role_name" class="form-control select2" data-placeholder="Choose a Group Name" tabindex="0">
                                <option  value="<?php echo $current_role; ?>"><?php echo $current_role; ?></option>

                                <?php
                                include "db.php";
                                $result = mysqli_query($con, "SELECT * FROM `role` ORDER BY `role_rolecode` DESC");
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . trim($row['role_rolecode']) . '">' . trim($row['role_rolecode']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <h6>Role Name: <?php echo $current_role ?></h6>

                    <form id="example-advanced-form" action="usergroupaddinsert.php" method="post" enctype="multipart/form-data" >
                        <input name="role_code" value="<?php echo $current_role; ?>" hidden="true"/>
                        <table id="datatable" data-toggle="table" >
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Menu Title</th>
                                <th>Create</th>
                                <th>Read</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Approve</th>
                            </tr>
                        </thead>

                        <tbody>

<?php
include 'conn.php';
$role_modules_query = "SELECT
`module`.`mod_modulecode` AS `module`,
`rights`.`create`,
`rights`.`edit`,
`rights`.`delete`,
`rights`.`read`,
`rights`.`approval`
FROM
`module_temp` `module`
LEFT JOIN (
SELECT
    `rr_create` AS `create`,
    `rr_edit` AS `edit`,
    `rr_delete` AS `delete`,
    `rr_view` AS `read`,
    `rr_approval` AS `approval`,
    `rr_modulecode` AS `module`
FROM
    `role_rights`
WHERE
    `rr_rolecode` = '{$current_role}'
) `rights`
ON
`module`.`mod_modulecode` = `rights`.`module`
";

$res = mysqli_query($conn, $role_modules_query);
$tmpCount = 1;
while ($row = mysqli_fetch_array($res)) {
    $module = isset($row["module"]) ? trim($row["module"]) : "";
    $createRight = isset($row["create"]) ? strtoupper(trim($row["create"])) : "NO";
    $readRight = isset($row["read"]) ? strtoupper(trim($row["read"])) : "NO";
    $editRight = isset($row["edit"]) ? strtoupper(trim($row["edit"])) : "NO";
    $deleteRight = isset($row["delete"]) ? strtoupper(trim($row["delete"])) : "NO";
    $approvalRight = isset($row["approval"]) ? strtoupper(trim($row["approval"])) : "NO";
    ?>

<tr>
    <td>
        <?php echo $tmpCount++; ?>
        <!-- <input type="text" name="count" value="<?php //echo $tmpCount++; ?>"> -->
        <!-- <input type="text" name="rr_modulecode" value="<?php //echo $_GET['add'] ?>"> -->
    </td>
    <td> 

       


        <input type="text" name="module_codes[]" value="<?php echo $module; ?>" hidden="true" />
        <?php echo $module; ?>
    </td>




    <td> 

       <!-- <div class="checkbox checkbox-primary">
                                                        <input id="checkbox2" type="checkbox" checked="">
                                                        <label for="checkbox2">
                                                            Primary
                                                        </label>
                                                    </div> -->


        <input type="hidden" name="create[]" <?php echo "value=\"$createRight\"";if ($createRight == "YES") {
                                                                                                                echo " disabled=\"true\"";
                                                                                                            }
                                                                                                            ?> />
        <input type="checkbox" name="create[]" <?php if ($createRight == "YES") {
                                                                                    echo "checked";
                                                                                }
             ?> value="<?php echo $createRight; ?>" onclick="setCheckBoxVal(this)" />
    </td>



    <td>
        <input type="hidden" name="read[]" <?php echo "value=\"$readRight\"";if ($readRight == "YES") {
        echo " disabled=\"true\"";
    }
    ?> />
        <input type="checkbox" name="read[]" <?php if ($readRight == "YES") {
        echo "checked";
    }
    ?> value="<?php echo $readRight; ?>" onclick="setCheckBoxVal(this)"/>
    </td>
    <td>
        <input type="hidden" name="edit[]" <?php echo "value=\"$editRight\"";if ($editRight == "YES") {
        echo " disabled=\"true\"";
    }
    ?> />
        <input type="checkbox" name="edit[]" <?php if ($editRight == "YES") {
        echo "checked";
    }
    ?> value="<?php echo $editRight; ?>" onclick="setCheckBoxVal(this)"/>
    </td>
    <td>
        <input type="hidden" name="delete[]" <?php echo "value=\"$deleteRight\"";if ($deleteRight == "YES") {
        echo " disabled=\"true\"";
    }
    ?> />
        <input type="checkbox" name="delete[]" <?php if ($deleteRight == "YES") {
        echo "checked";
    }
    ?> value="<?php echo $deleteRight; ?>" onclick="setCheckBoxVal(this)"/>
    </td>
    <td>
        <input type="hidden" name="approval[]" <?php echo "value=\"$approvalRight\"";if ($approvalRight == "YES") {
        echo " disabled=\"true\"";
    }
    ?> />
        <input type="checkbox" name="approval[]" <?php if ($approvalRight == "YES") {
        echo "checked";
    }
    ?> value="<?php echo $approvalRight; ?>" onclick="setCheckBoxVal(this)"/>
    </td>
</tr>
<?php }?>



</tbody>
</table>



                    <div class="form-group text-right">
                       <button type="submit" class="btn btn-primary w-md m-b-5 btn-rounded" />Save</button>
                    </div>


            </div>
            </form>        </div>
    </div>
</div>







                    </div>
                </div>

        <!-- /Main Content -->
<?php include "allscript.php";?>
<script>
    $('#groupNameDropdown').change(function()   {
        location.href = location.origin +'/frubji/admin/superadmin/usergroupadd.php?add=' + $(this).val();
    });

    function setCheckBoxVal(currField)  {
        $(currField).prev().prop('disabled', !$(currField).prev().prop('disabled'));
        currField.value = currField.value == "YES" ? "NO": "YES";
    }
</script>

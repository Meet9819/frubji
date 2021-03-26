<?php
include 'conn.php';

try {
    $db_op = 0;

    error_reporting(0);

    // get all role data
    $role_code = isset($_POST["role_code"]) ? trim($_POST["role_code"]) : null;

    if (is_null($role_code)) {
        echo "<script> alert('module name empty!'); location.href = usergroup.php'; </script>";
        return (0);
    }

    // $role_data_query = "SELECT `rr_modulecode` AS `module`, `rr_create` AS `create`, `rr_edit` AS `edit`, `rr_delete` AS `delete`, `rr_view` AS `view`, `rr_approval` AS `approval` FROM `role_rights` WHERE `rr_rolecode`='{$role_code}'";
    $role_data_query = "SELECT `rr_modulecode` AS `module` FROM `role_rights` WHERE `rr_rolecode`='{$role_code}'";
    $role_data_query_result = mysqli_query($conn, $role_data_query);

    $role_data = array();

    if (mysqli_num_rows($role_data_query_result) > 0) {
        while ($row = mysqli_fetch_assoc($role_data_query_result)) {
            $module = trim($row["module"]);
            // $create = isset($row["create"]) ? trim($row["create"]) : "NO";
            // $edit = isset($row["edit"]) ? trim($row["edit"]) : "NO";
            // $delete = isset($row["delete"]) ? trim($row["delete"]) : "NO";
            // $view = isset($row["view"]) ? trim($row["view"]) : "NO";
            // $approval = isset($row["approval"]) ? trim($row["approval"]) : "NO";

            if (!array_key_exists($module, $role_data)) {
                array_push($role_data, $module);
                $role_data[$module] = "";
            }

            // $role_data[$module]["CREATE"] = $create;
            // $role_data[$module]["EDIT"] = $edit;
            // $role_data[$module]["DELETE"] = $delete;
            // $role_data[$module]["VIEW"] = $view;
            // $role_data[$module]["APPROVAL"] = $approval;
        }
    }

    for ($count = 0; $count < count($_POST["module_codes"]); $count++) {
        $moduleCode = trim($_POST["module_codes"][$count]);
        $createRight = empty($_POST["create"][$count]) ? "NO" : $_POST["create"][$count];
        $readRight = empty($_POST["read"][$count]) ? "NO" : $_POST["read"][$count];
        $editRight = empty($_POST["edit"][$count]) ? "NO" : $_POST["edit"][$count];
        $deleteRight = empty($_POST["delete"][$count]) ? "NO" : $_POST["delete"][$count];
        $approvalRight = empty($_POST["approval"][$count]) ? "NO" : $_POST["approval"][$count];

        $query = "";

        if (array_key_exists($moduleCode, $role_data)) {
            if (($createRight == "NO") && ($readRight == "NO") && ($editRight == "NO") && ($deleteRight == "NO") && ($approvalRight == "NO")) {
                $query = "DELETE FROM `role_rights` WHERE `rr_rolecode`='{$role_code}' AND `rr_modulecode`='{$moduleCode}';";
            } else {
                $query = "UPDATE `role_rights` SET `rr_create`='{$createRight}',`rr_edit`='{$editRight}',`rr_delete`='{$deleteRight}',`rr_view`='{$readRight}',`rr_approval`='{$approvalRight}' WHERE `rr_rolecode`='{$role_code}' AND `rr_modulecode`='{$moduleCode}';";
            }
        } else {
            if (($createRight == "YES") || ($readRight == "YES") || ($editRight == "YES") || ($deleteRight == "YES") || ($approvalRight == "YES")) {
                $query = "INSERT INTO `role_rights`(`rr_rolecode`, `rr_modulecode`, `rr_create`, `rr_edit`, `rr_delete`, `rr_view`, `rr_approval`) VALUES ('{$role_code}', '{$moduleCode}', '{$createRight}', '{$editRight}', '{$deleteRight}', '{$readRight}', '{$approvalRight}');";

                array_push($role_data, $moduleCode);
                $role_data[$moduleCode] = "";
            } else {
                continue;
            }
        }

        $db_op++;
        if (mysqli_query($conn, $query)) {
            $db_op--;
        }
    }

    header("Location: usergroupadd.php?add=" . $role_code);
} catch (Exception $ex) {
    print_r($ex);
}

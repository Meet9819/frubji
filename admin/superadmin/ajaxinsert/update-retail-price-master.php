<?php

include '../conn.php';

$exists_query = "SELECT COUNT(*) AS `count` FROM `productsretailprice` WHERE `productid` = ? AND `variantid` = ? AND `branchid` = ?";
$update_query = "UPDATE `productsretailprice` SET `price` = ? WHERE `productid` = ? AND `variantid` = ? AND `branchid` = ?";
$insert_query = "INSERT INTO `productsretailprice`(`productid`, `variantid`, `branchid`, `price`) VALUES (?, ?, ?, ?)";

try {
    $price_master = file_get_contents('php://input') ?? null;

    if (empty($price_master)) {
        http_response_code(400);
        echo json_encode(array(
            "status" => false,
            "message" => "Invalid update retail price master data!",
        ));
        return;
    }

    $price_master = json_decode($price_master);

    mysqli_begin_transaction($conn);

    foreach ($price_master as $data) {
        $record_exists = false;

        #region check exists
        $exists_stmt = mysqli_prepare($conn, $exists_query);
        mysqli_stmt_bind_param($exists_stmt, "iii", $data->product, $data->variant, $data->branch);

        if (!mysqli_stmt_execute($exists_stmt)) {
            mysqli_rollback($conn);
            throw new \Exception("Error occured while updating retail price master!");
        }

        $result = mysqli_stmt_get_result($exists_stmt);

        $records = mysqli_fetch_row($result);
        $record_exists = $records[0] > 0 ? true : false;
        #endregion

        if ($record_exists) {
            #region try to update record, if exists
            $update_stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($update_stmt, "diii", $data->price, $data->product, $data->variant, $data->branch);

            if (!$update_stmt || !mysqli_execute($update_stmt)) {
                mysqli_rollback($conn);
                throw new \Exception("Error occured while updating retail price master!");
            }
            #endregion
        } else {
            #region insert records, if not exist
            $insert_stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, "iiid", $data->product, $data->variant, $data->branch, $data->price);

            if (!$insert_stmt || !mysqli_execute($insert_stmt)) {
                mysqli_rollback($conn);
                throw new \Exception("Error occured while adding record to retail price master!");
            }
            #endregion
        }
    }

    mysqli_commit($conn);

    mysqli_close($conn);

    http_response_code(200);
    echo json_encode(array(
        "status" => true,
        "message" => "Retail price master updated successfully!",
    ));
    return;
} catch (\Throwable $th) {
    mysqli_close($conn);

    http_response_code(500);
    echo json_encode(array(
        "status" => true,
        "message" => $th->getMessage(),
    ));
    return;
}

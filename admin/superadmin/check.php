<?php
//check.php
$connect = mysqli_connect("localhost","root","","frubji");

if (isset($_POST["user_name"])) {
    $response = array(
        'status' => false,
        'totalRecords' => 0,
        'data' => array(),
    );

    try {
        $username = mysqli_real_escape_string($connect, $_POST["user_name"]);

        $query = "SELECT
            `patientqatarid` AS `QATAR_ID`,
            `patientname` AS `PATIENT`,
            `patientmobile` AS `MOBILE`,
            `qidexpiry` AS `QATAR_ID_EXPIRY`,
            `patientemail` AS `EMAIL`
        FROM
            `insurance_customer`
        WHERE
            `patientname` = '" . $username . "' OR `patientqatarid` = '" . $username . "' OR `patientmobile` = '" . $username . "' OR `whatsappno` = '" . $username . "'
        UNION
        SELECT
            `patientqatarid` AS `QATAR_ID`,
            `patientname` AS `PATIENT`,
            `patientmobile` AS `MOBILE`,
            `qidexpiry` AS `QATAR_ID_EXPIRY`,
            `patientemail` AS `EMAIL`
        FROM
            `walkin_customer`
        WHERE
            `patientname` = '" . $username . "'  OR `patientqatarid` = '" . $username . "' OR `patientmobile` = '" . $username . "' OR `whatsappno` = '" . $username . "'";

        $result = mysqli_query($connect, $query);

        $response['totalRecords'] = mysqli_num_rows($result);

        while ($row = mysqli_fetch_assoc($result)) {
            $qatarID = isset($row['QATAR_ID']) ? trim($row['QATAR_ID']) : '';
            $patient = isset($row['PATIENT']) ? trim($row['PATIENT']) : '';
            $mobile = isset($row['MOBILE']) ? trim($row['MOBILE']) : '';
            $qatarIDExpiry = isset($row['QATAR_ID_EXPIRY']) ? trim($row['QATAR_ID_EXPIRY']) : '';
            $email = isset($row['EMAIL']) ? trim($row['EMAIL']) : '';

            $record = array(
                'qatarID' => $qatarID,
                'patient' => $patient,
                'mobile' => $mobile,
                'QIDexpiry' => $qatarIDExpiry,
                'email' => $email,
                'orderHistory' => array(),
            );

            $pos_query_result = mysqli_query($connect, "SELECT
                `pos`.`order_id`,
                `pos`.`order_no`,
                `pos`.`patientname` AS `PATIENT`,
                `branch`.`branchname_english` AS `BRANCH`,
                `pos`.`order_date`,
                `pos`.`order_total_after_tax` AS `TOTAL`
            FROM
                `pos`
            LEFT JOIN
                `branch`
            ON
                `pos`.`workingin` = `branch`.`branchcode`
            WHERE
                `pos`.`patientname` = '{$patient}'
            ORDER BY `pos`.`order_date` LIMIT 5;");

            if (!empty($pos_query_result)) {
                while ($row = mysqli_fetch_assoc($pos_query_result)) {
                    $order_id = $row['order_id'];

                    $order = array(
                        'id' => $order_id,
                        'invoice' => $row['order_no'],
                        'patient' => $row['PATIENT'],
                        'branch' => $row['BRANCH'],
                        'orderDate' => $row['order_date'],
                        'orderTotal' => $row['TOTAL'],
                        'orderDetails' => array(),
                    );

                    $pos_order_query_result = mysqli_query($connect, "SELECT
                        `itemcode` AS `CODE`,
                        `item_name` AS `NAME`,
                        `units`,
                        `packing`,
                        `order_item_quantity` AS `QUANTITY`,
                        `order_item_price` AS `PRICE`,
                        `order_item_actual_amount` AS `AMOUNT`
                    FROM
                        `positem`
                    WHERE
                        `order_id` = {$order_id};");

                    if (!empty($pos_order_query_result)) {
                        while ($sub_row = mysqli_fetch_assoc($pos_order_query_result)) {
                            $order_details = array(
                                'code' => $sub_row['CODE'],
                                'name' => $sub_row['NAME'],
                                'units' => $sub_row['units'],
                                'pack' => $sub_row['packing'],
                                'quantity' => $sub_row['QUANTITY'],
                                'price' => $sub_row['PRICE'],
                                'amount' => $sub_row['AMOUNT'],
                            );

                            array_push($order['orderDetails'], $order_details);
                        }
                    }

                    array_push($record['orderHistory'], $order);
                }
            }

            array_push($response['data'], $record);
        }

        $response['status'] = true;
        http_response_code(200);
    } catch (\Throwable $th) {
        http_response_code(500);
        //throw $th;
    }
    echo json_encode($response);
}

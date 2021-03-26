<?php

require_once "allcss.php";
require_once "header.php";
require_once "database_connection.php";
require_once "config.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("index.php");
}

// ROLE BASED - START
$status = false;
if (authorize($_SESSION["access"]["SALES"]["POS"]["create"]) ||
    authorize($_SESSION["access"]["SALES"]["POS"]["edit"]) ||
    authorize($_SESSION["access"]["SALES"]["POS"]["view"]) ||
    authorize($_SESSION["access"]["SALES"]["POS"]["delete"]) ||
    authorize($_SESSION["access"]["SALES"]["POS"]["approval"])) {
    $status = true;
}

if ($status === false) {
    die("You dont have the permission to access this page");
}
// ROLE BASED - END

#region queries
$insert_pos_item_record_query = "INSERT INTO `pos_item`
  (`order_id`, `itemcode`, `item_name`, `variant`, `order_item_quantity`, `order_item_price`,
  `order_item_actual_amount`, `order_item_final_amount`)
  VALUES (:order_id, :itemcode, :item_name, :variant, :order_item_quantity,
    :order_item_price, :order_item_actual_amount, :order_item_final_amount)";
  
$insert_pos_record_query = "INSERT INTO `pos`
  (`whichcompany`, `requestorderprifix`, `requestorder_date`, `requestfrom`, `customername`,
  `typeofsale`, `order_total_before_tax`, `order_total_after_tax`, `order_datetime`, `status`,
  `remarks`, `mobile`)
  VALUES (:whichcompany, :requestorderprifix, :requestorder_date, :requestfrom, :customername, :typeofsale,
  :order_total_before_tax, :order_total_after_tax, :order_datetime, :status, :remarks, :mobile)";

$fetch_pos_orders_list_query = "SELECT
    `order_id`,
    `whichcompany`,
    `requestorderprifix`,
    `requestorder_date`,
    `requestfrom`,
    `customername`,
    `order_total_before_tax`,
    `order_total_after_tax`,
    `order_datetime`,
    `remarks`,
    `status`,
    `mobile`
  FROM
    `pos`
  ORDER BY
    `order_id` DESC";

$fetch_pos_order_details_query = "SELECT
    `order_id`,
    `whichcompany`,
    `requestorderprifix`,
    `requestorder_date`,
    `requestfrom`,
    `customername`,
    `order_total_before_tax`,
    `order_total_after_tax`,
    `order_datetime`,
    `typeofsale`,
    `remarks`,
    `status`,
    `mobile`
  FROM
    `pos`
  WHERE
    `order_id` = :id";

$fetch_pos_order_items_query = "SELECT 
    `itemcode`, 
    `item_name`, 
    `variant`, 
    `order_item_quantity`, 
    `order_item_price`,
    `order_item_actual_amount`, 
    `order_item_final_amount`
  FROM 
    `pos_item`
  WHERE 
    `order_id` = :id
  ORDER BY `itemcode` ASC";

$fetch_retail_price_query = "SELECT
    `p`.`id` `product_code`,
    `p`.`name` `product_name`,
    `pv`.`id` `variant_id`,
    CONCAT(`pv`.`qty`, ' ', `pv`.`units`) `variant`,
    `prp`.`price` `price`
  FROM
    `products` `p`
  INNER JOIN
    `productvariant` `pv`
  ON
    `p`.`id` = `pv`.`productid`
  INNER JOIN
    `productsretailprice` `prp`
  ON
    `p`.`id` = `prp`.`productid` AND  `pv`.`id` = `prp`.`variantid`
  WHERE
    `p`.`status` = 1
  AND
    `prp`.`active` = 1
  AND
    `prp`.`branchid` = :branch_id
  ORDER BY
    `p`.`id`, `pv`.`qty` ASC";

$fetch_pos_invoices_query = "SELECT `order_id` FROM `pos` ORDER BY `order_id` DESC LIMIT 1";

$update_pos_record_query = "UPDATE
      `pos`
    SET
      `remarks` = :remarks,
      `customername` = :customername,
      `order_total_before_tax` = :order_total_before_tax,
      `order_total_after_tax` = :order_total_after_tax,
      `typeofsale` =:typeofsale
    WHERE
      `order_id` = :order_id";

$delete_pos_record_query = "DELETE FROM `pos` WHERE `order_id` = :id";

$delete_pos_item_records_query = "DELETE FROM `pos_item` WHERE `order_id` = :id";

$delete_logs_query = "DELETE FROM `alllogs` WHERE `idd` = :id AND `whichtable` = 'BRANCH_REQUEST_ORDER'";
#endregion

$order_id = !empty($_POST["order_id"]) ? (int) $_POST["order_id"] : 0;

$pos_orders_list = array();
$pos_orders = array();
$pos_order_details = array();
$pos_invoice_details = array();
$new_order_no = 0;

try {
    #region Fetch product master
    if (isset($_GET["add"]) || isset($_GET["update"])) {
      $fetch_retail_price_query_statement = $connect->prepare($fetch_retail_price_query);
      $fetch_retail_price_query_statement->execute(array(
          "branch_id" => $workingin,
      ));

      $product_code_prices = array();

      foreach ($fetch_retail_price_query_statement->fetchAll() as $data) {
        $code = (int) $data["product_code"];
        $name = trim($data["product_name"]);
        $variant_id = (int) $data["variant_id"];
        $variant = trim($data["variant"]);
        $price = (float) $data["price"];
        $variant_arr = array(
            "variant_id" => $variant_id,
            "variant" => $variant,
            "price" => $price,
        );

        if (!array_key_exists($code, $product_code_prices)) {
            $product_code_prices[$code] = array(
                "code" => $code,
                "name" => $name,
                "variants" => array(),
            );
        }

        array_push($product_code_prices[$code]["variants"], $variant_arr);
      }
    }
    #endregion

    #region Fetch POS orders
    if (empty($_GET["update"]) && empty($_GET["add"]) && empty($_GET["delete"])) {
        $pos_orders_list = $connect->query($fetch_pos_orders_list_query);
    }
    #endregion

    #region Fetch POS order by id
    if (!empty($_GET["update"]) && !empty($_GET["id"])) {
      $pos_order_id = (int) $_GET["id"];

      $fetch_pos_order_details_query_statement = $connect->prepare($fetch_pos_order_details_query);
      $fetch_pos_order_details_query_statement->execute(array(
          "id" => $pos_order_id,
      ));

      foreach ($fetch_pos_order_details_query_statement->fetchAll() as $data) {
        $pos_order_details["order_id"] = (int) $data["order_id"];
        $pos_order_details["company"] = trim($data["whichcompany"]);
        $pos_order_details["order_prefix"] = trim($data["requestorderprifix"]);
        $pos_order_details["order_date"] = trim($data["requestorder_date"]);
        $pos_order_details["requestfrom"] = trim($data["requestfrom"]);
        $pos_order_details["customer_name"] = trim($data["customername"]);
        $pos_order_details["customer_mobile"] = trim($data["mobile"]);
        $pos_order_details["total_before_tax"] = (float) $data["order_total_before_tax"];
        $pos_order_details["total_after_tax"] = (float) $data["order_total_after_tax"];
        $pos_order_details["remarks"] = trim($data["remarks"]);
        $pos_order_details["typeofsale"] = trim($data["typeofsale"]);
        $pos_order_details["status"] = (int) $data["status"];
        $pos_order_details["products"] = array();
        // `order_datetime`,
      }

      if (!empty($pos_order_details["order_id"])) {
        $fetch_pos_order_items_query_statement = $connect->prepare($fetch_pos_order_items_query);
        $fetch_pos_order_items_query_statement->execute(array(
            "id" => $pos_order_id,
        ));

        foreach ($fetch_pos_order_items_query_statement->fetchAll() as $data) {
          array_push($pos_order_details["products"], array(
            "itemcode" => $data["itemcode"],
            "item_name" => $data["item_name"],
            "variant" => $data["variant"],
            "order_item_quantity" => $data["order_item_quantity"],
            "order_item_price" => $data["order_item_price"],
            "order_item_actual_amount" => $data["order_item_actual_amount"],
            "order_item_final_amount" => $data["order_item_final_amount"],
          ));
        }
      }
    }
    #endregion

    #region Fetch new order no.
    if (!empty($_GET["add"])) {
        $result = mysqli_query($con, $fetch_pos_invoices_query);
        while ($data = mysqli_fetch_array($result)) {
            $new_order_no = $data['order_id'] + 1;
        }
    }
    #endregion

    #region Fetch company and branch list
    if (isset($_GET["update"])) {
        $company_list = array();
        $branch_list = array();

        $company_list_query = "SELECT `id`, `companyname_english` `name` FROM `company`";
        $branch_list_query = "SELECT `id`, `branchname_english` `name` FROM `branch`";

        foreach ($connect->query($company_list_query) as $data) {
            $company_list[$data["id"]] = $data["name"];
        }

        foreach ($connect->query($branch_list_query) as $data) {
            $branch_list[$data["id"]] = $data["name"];
        }
    }
    #endregion

    #region Create POS order
    if (!empty($_POST["create-pos-order"])) {
        $order_total_before_tax = 0;
        $order_total_after_tax = 0;

        for ($count = 0; $count < $_POST["total_items"]; $count++) {
            $order_total_before_tax += floatval(trim($_POST["itemactualamount"][$count]));
            $order_total_after_tax += floatval(trim($_POST["itemfinalamount"][$count]));
        }

        #region Add POS record
        $insert_pos_record_query_statement = $connect->prepare($insert_pos_record_query);
        $insert_pos_record_query_statement->execute(array(
            ':whichcompany' => trim($_POST["company"]),
            ':requestorderprifix' => trim($_POST["order-prefix"]),
            ':requestorder_date' => trim($_POST["order-date"]),
            ':requestfrom' => trim($_POST["request-from"]),
            ':customername' => trim($_POST["customer-name"]),
            ':typeofsale' => trim($_POST["type-of-sale"]),
            ':order_total_before_tax' => $order_total_before_tax,
            ':order_total_after_tax' => $order_total_after_tax,
            ':order_datetime' => $currentTime,
            ':status' => 1,
            ':remarks' => trim($_POST["remarks"]),
            ':mobile' => trim($_POST["customer-mobile"]),
        ));
        #endregion

        $order_id = (int) $connect->lastInsertId();

        #region Add POS item records
        $insert_pos_item_record_query_statement = $connect->prepare($insert_pos_item_record_query);

        for ($count = 0; $count < $_POST["total_items"]; $count++) {
            $insert_pos_item_record_query_statement->execute(array(
                ':order_id' => $order_id,
                ':itemcode' => trim($_POST["itemcode"][$count]),
                ':item_name' => trim($_POST["itemname"][$count]),
                ':variant' => trim($_POST["itemvariant"][$count]),
                ':order_item_quantity' => trim($_POST["itemquantity"][$count]),
                ':order_item_price' => trim($_POST["itemprice"][$count]),
                ':order_item_actual_amount' => trim($_POST["itemactualamount"][$count]),
                ':order_item_final_amount' => trim($_POST["itemfinalamount"][$count]),
            ));
        }
        #endregion
        ?>
        <script>
          alert('New POS created successfully!');
          window.location.href='pos.php';
        </script>
        <?php
}
    #endregion

    #region Update POS order
    if (!empty($_POST["update-pos-order"]) && !empty($order_id)) {
        #region Delete existing POS order items
        $statement = $connect->prepare($delete_pos_item_records_query);
        $statement->execute(array(
            ':order_id' => $order_id,
        ));
        #endregion

        $statement = $connect->prepare("DELETE FROM pos_item WHERE order_id = :order_id");
        $statement->execute(
             array(
                 ':order_id' => $order_id,
             )
         );

        $order_total_before_tax = 0;
        $order_total_after_tax = 0;

        for ($count = 0; $count < $_POST["total_items"]; $count++) {
            $order_total_before_tax += floatval(trim($_POST["itemactualamount"][$count]));
            $order_total_after_tax += floatval(trim($_POST["itemfinalamount"][$count]));
        }

        #region Add updated POS item records
        $insert_pos_item_record_query_statement = $connect->prepare($insert_pos_item_record_query);

        for ($count = 0; $count < $_POST["total_items"]; $count++) {
            $insert_pos_item_record_query_statement->execute(array(
                ':order_id' => $order_id,
                ':itemcode' => trim($_POST["itemcode"][$count]),
                ':item_name' => trim($_POST["itemname"][$count]),
                ':variant' => trim($_POST["itemvariant"][$count]),
                ':order_item_quantity' => trim($_POST["itemquantity"][$count]),
                ':order_item_price' => trim($_POST["itemprice"][$count]),
                ':order_item_actual_amount' => trim($_POST["itemactualamount"][$count]),
                ':order_item_final_amount' => trim($_POST["itemfinalamount"][$count]),
            ));
        }
        #endregion

        #region Update POS order details
        $update_pos_record_query_statement = $connect->prepare($update_pos_record_query);
        $update_pos_record_query_statement->execute(array(
            ':remarks' => trim($_POST["remarks"]),
            ':customername' => trim($_POST["customer-name"]),
            ':order_total_before_tax' => $order_total_before_tax,
            ':order_total_after_tax' => $order_total_after_tax,
            ':typeofsale' => trim($_POST["type-of-sale"]),
            ':order_id' => $order_id,
        ));
        #endregion
        ?>
    <script>
    alert('POS updated successfully!');
    window.location.href='pos.php';
    </script>
    <?php
    }
    #endregion

    #region Delete POS order
    if (!empty($_GET["delete"]) && !empty($_GET["id"])) {
        $pos_order_id = (int) $_GET["id"];

        // delete POS record
        $delete_pos_record_query_statement = $connect->prepare($delete_pos_record_query);
        $delete_pos_record_query_statement->execute(array(
            ":id" => $pos_order_id,
        ));

        // record POS item records
        $statement = $connect->prepare($delete_pos_item_records_query);
        $statement->execute(array(
            ":id" => $pos_order_id,
        ));

        // delete logs
        $statement = $connect->prepare($delete_logs_query);
        $statement->execute(array(
            ":id" => $pos_order_id,
        ));
        ?>
      <script>
      alert('POS Successfully Deleted !!');
      window.location.href='pos.php';
      </script>
      <?php
    }
    #endregion

} catch (\Throwable $th) {
    //throw $th;
}

?>

<title>co-<?php echo $companyid; ?> |  workingin-<?php echo $workingin; ?> </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="page-wrapper">
  <!-- Title -->
  <div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h5 class="txt-dark">POS</h5>
    </div>
    <!-- Breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li>
          <a href="index.php">Dashboard</a>
        </li>
        <li>
          <a href="purchaseorder.php">
            <span>POS</span>
          </a>
        </li>
        <li>
          <a href="purchaseorder.php">
            <span>Local PO</span>
          </a>
        </li>
        <li class="active">
          <span>POS</span>
        </li>
      </ol>
    </div>
    <!-- /Breadcrumb -->
  </div>
  <!-- /Title -->

  <div class="panel panel-default border-panel card-view">
    <div class="panel-wrapper collapse in">
        <?php
          if (!empty($_GET["add"])) {
            // POS add order
        ?>
          <form id="new-pos-order-form" method="post" enctype="application/x-www-form-urlencoded">
            <div class="table-responsive">
              <div class="row">
                <div class="col-md-2 form-group">
                  Document No <br />
                  <input type="text" name="order-prefix" class="form-control input-sm" value="<?php echo "${branchrequestorder}/${dateeyear}/${new_order_no}"; ?>" readonly />
                </div>
                <div class="col-md-1 form-group">
                  <b>Company</b><br />
                  <input type="text" class="form-control" value="<?php echo $companyname_english ?>" readonly />
                  <input type="hidden" class="form-control" value="<?php echo $companyid; ?>" name="company" readonly />
                </div>
                <div class="col-md-2">
                  <b>Branch </b><br />
                  <input type="text" class="form-control" value="<?php echo $branchname_english; ?>" readonly />
                  <input type="hidden" class="form-control" value="<?php echo $workingin; ?>" name="request-from" readonly />
                </div>
                <div class="col-md-2">
                  <b>Customer Name  </b><br />
                  <input type="text" class="form-control" name="customer-name" id="customer-name" placeholder="Enter customer name" required />
                </div>
                <div class="col-md-2">
                  Customer Mobile No. <br />
                  <input  type="text" name="customer-mobile" id="customer-mobile" class="form-control input-sm" placeholder="Enter customer mobile" maxlength="10" tabindex="0" required />
                </div>
                <div class="col-md-2">
                  <b>Type of Sale </b><br />
                  <select name="type-of-sale" class="form-control">
                    <option value="RETAIL SALE" selected>RETAIL SALE</option>
                    <option value="WASTAGE">WASTAGE</option>
                    <option value="DONATION">DONATION</option>
                    <option value="REPLACEMENT">REPLACEMENT</option>
                  </select>
                </div>
                <div class="col-md-1">
                  Date <br />
                  <input type="text" name="order-date" class="form-control input-sm" placeholder="Select POS Date"  value="<?php echo $fulldatee; ?>" tabindex="-1" readonly />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="min-height: 50vh;">
                    <div class="table-responsive" style="overflow-y: auto;overflow-x: hidden;height: 45%">
                      <table id="invoice-item-table" class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="padding: 10px" width="2%">SrNo.</th>
                            <th style="padding: 10px" width="10%">Product Code</th>
                            <th style="padding: 10px" width="35%">Product Name</th>
                            <th style="padding: 10px" width="7%">Variant</th>
                            <th style="padding: 10px" width="5%">Price</th>
                            <th style="padding: 10px" width="5%">Qty</th>
                            <th style="padding: 10px" width="10%">Total</th>
                            <th width="3%"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <span>1</span>
                            </td>
                            <td class="item_code">
                              <input type="text" name="itemcode[]" list="itemcode_list" class="form-control input-sm datalist-input-code" required />
                              <datalist id="itemcode_list">
                                <?php foreach ($product_code_prices as $code => $data) {?>
                                  <option value="<?php echo $code; ?>"><?php echo $code; ?></option>
                                <?php }?>
                              </datalist>
                            </td>
                            <td class="item_name">
                              <input type="text" name="itemname[]" list="itemname_list" class="form-control input-sm datalist-input-name" required />
                              <datalist id="itemname_list">
                                <?php foreach ($product_code_prices as $code => $data) {?>
                                  <option value="<?php echo $code; ?>"><?php echo $data["name"]; ?></option>
                                <?php }?>
                              </datalist>
                            </td>
                            <td class="item_unit">
                              <select type="text" name="itemvariant[]" class="form-control input-sm item-variant-selection" required>
                                <option value="0">Select an unit</option>
                              </select>
                            </td>
                            <td class="item_price">
                              <input type="text" name="itemprice[]" class="form-control input-sm number_only order_item_price" readonly />
                            </td>
                            <td class="item_qty">
                              <input type="number" name="itemquantity[]" min="1" value="0" class="form-control input-sm order_item_quantity" required />
                            </td>
                            <td class="item_actual_amount">
                              <input type="text" name="itemactualamount[]" class="form-control input-sm order_item_actual_amount" readonly />
                            </td>
                            <td class="item_final_amount">
                              <input type="hidden" name="itemfinalamount[]" class="form-control input-sm order_item_final_amount" readonly />
                              <button type="button" class="btn btn-danger btn-icon-anim btn-circle" title="Click to clear row data" onclick="clearRow(this)">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td>
                              <button type="button" title="Add new product row" name="add_row" id="add_row" class="btn btn-default btn-icon-anim btn-circle">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                              </button>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                </div>
              </div>
              <hr class="light-grey-hr">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-8">
                  <input type="text" name="remarks" class="form-control input-sm remarks" placeholder="Enter the Remarks to be displayed in your POS Document">
                </div>
                <div class="col-md-3" style="color: red;font-weight: bold; font-size: 20px; text-align: right;padding-right: 75px;"> Total :
                  <b><span id="final_total_amt">0.00</span></b>
                  <input type="hidden" name="total_items" id="total_items" value="1" />
                </div>
              </div>
              <div class="row" style="padding: 10px 0;">
                <div class="col-md-12 text-center">
                  <a href="pos.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label">
                    <span class="btn-label">
                      <i class="fa fa-times"></i>
                    </span>
                    <span class="btn-text" title="Click to close new POS screen">Close</span>
                  </a>
                  <input type="submit" name="create-pos-order" title="Click to save POS" class="btn btn-primary btn-rounded" value="Save" />
                </div>
              </div>
            </div>
          </form>
        <?php
          } else if (!empty($_GET["update"])) {
            // POS update order
        ?>
          <form id="update-pos-order-form" method="post" enctype="application/x-www-form-urlencoded">
            <div class="table-responsive">
              <div class="row">
                <div class="col-md-2 form-group">
                  Document No <br />
                  <input type="text" name="order-prefix" class="form-control input-sm" value="<?php echo $pos_order_details["order_prefix"]; ?>" readonly />
                </div>
                <div class="col-md-1 form-group">
                  <b>Company</b><br />
                  <input type="text" class="form-control" value="<?php echo $company_list[$pos_order_details["company"]]; ?>" readonly />
                  <input type="hidden" class="form-control" value="<?php echo $pos_order_details["company"]; ?>" name="company" readonly />
                </div>
                <div class="col-md-2">
                  <b>Branch </b><br />
                  <input type="text" class="form-control" value="<?php echo $branch_list[$pos_order_details["requestfrom"]]; ?>" readonly />
                  <input type="hidden" class="form-control" value="<?php echo $pos_order_details["requestfrom"]; ?>" name="request-from" readonly />
                </div>
                <div class="col-md-2">
                  <b>Customer Name  </b><br />
                  <input type="text" class="form-control" name="customer-name" id="customer-name" placeholder="Enter customer name" value="<?php echo $pos_order_details["customer_name"]; ?>" required />
                </div>
                <div class="col-md-2">
                  Customer Mobile No. <br />
                  <input  type="text" name="customer-mobile" id="customer-mobile" class="form-control input-sm" placeholder="Enter customer mobile" maxlength="10" tabindex="0" value="<?php echo $pos_order_details["customer_mobile"]; ?>" required />
                </div>
                <div class="col-md-2">
                  <b>Type of Sale </b><br />
                  <select name="type-of-sale" class="form-control">
                    <option value="RETAIL SALE" <?php echo ($pos_order_details["typeofsale"] == "RETAIL SALE") ? "selected": ""; ?>>RETAIL SALE</option>
                    <option value="WASTAGE" <?php echo ($pos_order_details["typeofsale"] == "WASTAGE") ? "selected": ""; ?>>WASTAGE</option>
                    <option value="DONATION" <?php echo ($pos_order_details["typeofsale"] == "DONATION") ? "selected": ""; ?>>DONATION</option>
                    <option value="REPLACEMENT" <?php echo ($pos_order_details["typeofsale"] == "REPLACEMENT") ? "selected": ""; ?>>REPLACEMENT</option>
                  </select>
                </div>
                <div class="col-md-1">
                  Date <br />
                  <input type="text" name="order-date" class="form-control input-sm" placeholder="Select POS Date"  value="<?php echo $pos_order_details["order_date"]; ?>" tabindex="-1" readonly />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="min-height: 50vh;">
                    <div class="table-responsive" style="overflow-y: auto;overflow-x: hidden;height: 45%">
                      <table id="invoice-item-table" class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="padding: 10px" width="2%">SrNo.</th>
                            <th style="padding: 10px" width="10%">Product Code</th>
                            <th style="padding: 10px" width="35%">Product Name</th>
                            <th style="padding: 10px" width="7%">Variant</th>
                            <th style="padding: 10px" width="5%">Price</th>
                            <th style="padding: 10px" width="5%">Qty</th>
                            <th style="padding: 10px" width="10%">Total</th>
                            <th width="3%"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $pos_order_total = 0;
                            $data_count = 0;

                            foreach($pos_order_details["products"] as $order_product) {
                              $pos_order_product_code = (int) $order_product["itemcode"];
                              $pos_order_product_variant = (int) $order_product["variant"];
                              $pos_order_product_qty = (int) $order_product["order_item_quantity"];

                              $variants = $product_code_prices[$pos_order_product_code]["variants"];

                              $pos_order_product_price = 0;

                              foreach($variants as $variant)  {
                                if ($pos_order_product_variant == $variant["variant_id"]) {
                                  $pos_order_product_price = $variant["price"];
                                  break;
                                }
                              }

                              $pos_order_product_total = $pos_order_product_price * $pos_order_product_qty;
                              $pos_order_total += $pos_order_product_total;
                          ?>
                          <tr>
                            <td>
                              <span><?php echo ++$data_count; ?></span>
                            </td>
                            <td class="item_code">
                              <input type="text" name="itemcode[]" list="itemcode_list" class="form-control input-sm datalist-input-code" value="<?php echo $pos_order_product_code; ?>" required />
                              <datalist id="itemcode_list">
                                <?php foreach ($product_code_prices as $code => $data) {?>
                                  <option value="<?php echo $code; ?>"><?php echo $code; ?></option>
                                <?php }?>
                              </datalist>
                            </td>
                            <td class="item_name">
                              <input type="text" name="itemname[]" list="itemname_list" class="form-control input-sm datalist-input-name" value="<?php echo $order_product["item_name"]; ?>" required />
                              <datalist id="itemname_list">
                                <?php foreach ($product_code_prices as $code => $data) {?>
                                  <option value="<?php echo $code; ?>"><?php echo $data["name"]; ?></option>
                                <?php }?>
                              </datalist>
                            </td>
                            <td class="item_unit">
                              <select type="text" name="itemvariant[]" class="form-control input-sm item-variant-selection" required>
                                <option value="0">Select an unit</option>
                                <?php
                                    foreach($variants as $variant)  {
                                ?>
                                <option value="<?php echo $variant["variant_id"]; ?>" <?php echo ($pos_order_product_variant == $variant["variant_id"]) ? "selected": ""; ?>><?php echo $variant["variant"]; ?></option>
                                <?php
                                    }
                                ?>
                              </select>
                            </td>
                            <td class="item_price">
                              <input type="text" name="itemprice[]" class="form-control input-sm number_only order_item_price" value="<?php echo $pos_order_product_price; ?>" readonly />
                            </td>
                            <td class="item_qty">
                              <input type="number" name="itemquantity[]" min="1" class="form-control input-sm order_item_quantity" value="<?php echo $pos_order_product_qty; ?>" required />
                            </td>
                            <td class="item_actual_amount">
                              <input type="text" name="itemactualamount[]" class="form-control input-sm order_item_actual_amount" value="<?php echo $pos_order_product_total; ?>" readonly />
                            </td>
                            <td class="item_final_amount">
                              <input type="hidden" name="itemfinalamount[]" class="form-control input-sm order_item_final_amount" value="<?php echo $pos_order_product_total; ?>" readonly />
                              <button type="button" class="btn btn-danger btn-icon-anim btn-circle" title="Click to clear row data">
                                <i class="fa fa-trash <?php echo ($data_count > 1) ? "remove_row" : ""; ?>" aria-hidden="true" <?php echo ($data_count == 1) ? "onclick=\"clearRow(this)\"" : ""; ?>></i>
                              </button>
                            </td>
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td>
                              <button type="button" title="Add new product row" name="add_row" id="add_row" class="btn btn-default btn-icon-anim btn-circle">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                              </button>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                </div>
              </div>
              <hr class="light-grey-hr">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-8">
                  <input type="text" name="remarks" class="form-control input-sm remarks" placeholder="Enter the Remarks to be displayed in your POS Document" value="<?php echo $pos_order_details["remarks"]; ?>">
                </div>
                <div class="col-md-3" style="color: red;font-weight: bold; font-size: 20px; text-align: right;padding-right: 75px;"> Total :
                  <b><span id="final_total_amt"><?php echo number_format($pos_order_total, 2); ?></span></b>
                  <input type="hidden" name="total_items" id="total_items" value="<?php echo count($pos_order_details["products"]); ?>" />
                  <input type="hidden" name="order_id" value="<?php echo $pos_order_details["order_id"]; ?>" />
                </div>
              </div>
              <div class="row" style="padding: 10px 0;">
                <div class="col-md-12 text-center">
                  <a href="pos.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label">
                    <span class="btn-label">
                      <i class="fa fa-times"></i>
                    </span>
                    <span class="btn-text" title="Click to close new POS screen">Close</span>
                  </a>
                  <input type="submit" name="update-pos-order" title="Click to update POS order" class="btn btn-primary btn-rounded" value="Update" />
                </div>
              </div>
            </div>
          </form>
        <?php
          }
          else {
            // POS dashboard
        ?>
          <table id="pos-orders-table" class="table table-bordered table-striped">
            <?php 
              if (authorize($_SESSION["access"]["SALES"]["POS"]["create"]))  {
            ?>
              <div class="text-right">
                <a href="pos.php?add=1" class="btn btn-primary btn-icon right-icon">
                  <i class="fa fa-plus"></i>
                  <span class="btn-text">Create POS</span>
                </a>
              </div><br />
            <?php
              }
            ?>
            <thead>
              <tr>
                <th>Sr.No.</th>
                <th>Request From </th>
                <th>Document No </th>
                <th>Customer Name </th>
                <th>Request Date</th>
                <th>Amount</th>
                <th>Actions</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $data_count = 0;
                foreach ($pos_orders_list as $data) {
              ?>
                <tr>
                  <td><?php echo ++$data_count; ?></td>
                  <td style="padding:10px"><?php echo "${data["requestfrom"]} - ${branchname_english}"; ?></td>
                  <td>
                  <?php echo "${data["whichcompany"]}/${data["requestfrom"]}/${data["requestorderprifix"]}"; ?>
                  </td>
                  <td><?php echo $data["customername"]; ?></td>
                  <td><?php echo date("d-m-Y", strtotime($data['requestorder_date'])); ?>
                  <td><?php echo $data["order_total_after_tax"]; ?></td>
                  <td>
                    <?php
                      if (authorize($_SESSION["access"]["SALES"]["POS"]["view"])) {
                    ?>
                      <a target="_blank" href="printpdf/print_pos.php?pdf=1&id=<?php echo $data["order_id"]; ?>">
                        <i class="fa fa-file-text-o txt-default"> </i>
                      </a>
                    <?php 
                      }
                      if (authorize($_SESSION["access"]["SALES"]["POS"]["edit"])) {
                       
                    ?>
                     &nbsp;&nbsp; <a href="pos.php?update=1&id=<?php echo $data["order_id"]; ?>" class="text-inverse pr-10">
                        <i class="zmdi zmdi-edit txt-success"></i>
                      </a>
                    <?php
                      
                      }
                      if (authorize($_SESSION["access"]["SALES"]["POS"]["delete"])) {
                      if ($data['status'] == 0) {
                    ?>
                      <a href="pos.php?delete=1&id=<?php echo $data["order_id"]; ?>" class="delete">
                        <i class="zmdi zmdi-delete txt-danger pr-10"></i>
                      </a>
                    <?php
                        }
                      }
                    ?>
                    </a>
                  </td>
                  <td>
                    <?php
                     if (authorize($_SESSION["access"]["SALES"]["POS"]["approval"])) {
                    ?>
                      <span data="<?php echo $data['order_id']; ?>" class="status_checks btn-sm label <?php echo ($data['status'] == 1) ? "label-success" : "label-danger"; ?>"><?php echo ($data['status']) ? "Approved" : "Not Approved"; ?></span>
                    <?php
                      }
                    ?>
                  </td>
                </tr>
              <?php
                  }
              ?>
            </tbody>
          </table>
        <?php
          }
        ?>
    </div>
  </div>
</div>

<?php include "allscript.php";?>

<script>
  var supplierBranchData1312343458 = <?php echo json_encode($product_code_prices) ?>;

  var baseURL = window.location.href.split('/');
  baseURL.pop();
  baseURL = baseURL.join('/');

  $('#pos-orders-table').DataTable();

  $('#invoice-item-table').on("input", ".datalist-input-code", function(e) {
    try {
      //validation
      if (!areCustomerDetailsSelected())  {
        return false;
      }

      let currentElement = $(e.target);
      let val = currentElement.val();

      setInvoiceItemDetails(currentElement, val, 1);
    } catch (error) {}
  });

  $('#invoice-item-table').on("input", ".datalist-input-name", function(e) {
    try {
        //validation
        if (!areCustomerDetailsSelected())  {
          return false;
        }

        let currentElement = $(e.target);
        let val = currentElement.val();

        setInvoiceItemDetails(currentElement, val, 2);
    } catch (error) {}
  });

  $('#invoice-item-table').on('change', '.item-variant-selection', function(e) {
    try {
      let currentElement = e.target;
      let variant = Number($(currentElement).val());

      if (!variant) {
        return;
      }

      let parent = $(currentElement).parent().parent();
      let code = $(parent).children(".item_code").children().first().val();

      let price = $(parent).children(".item_price").children(),
        qty = $(parent).children(".item_qty").children().first(),
        actualTotal = $(parent).children(".item_actual_amount").children(),
        finalTotal = $(parent).children(".item_final_amount").children();

      let item_data = supplierBranchData1312343458[code];

      if (!item_data) {
        return;
      }

      let variants = item_data['variants'];

      for (let i = 0; i < variants.length; i++) {
        if (variant === variants[i]['variant_id'])  {
          price.val(variants[i]['price']);
          actualTotal.val(Number(qty.val()) * variants[i]['price']);
          finalTotal.val(Number(qty.val()) * variants[i]['price']);
          break;
        }
      }

      calc_final_total();
    } catch (error) {}
  });

  $('#invoice-item-table').on('change', '.order_item_quantity', function(e) {
    try {
      let currentElement = e.target;
      let qty = Number($(currentElement).val());

      if (!qty) {
        return;
      }

      let parent = $(currentElement).parent().parent();
      let code = $(parent).children(".item_code").children().first().val();

      let price = $(parent).children(".item_price").children(),
        actualTotal = $(parent).children(".item_actual_amount").children(),
        finalTotal = $(parent).children(".item_final_amount").children();


      actualTotal.val(qty * price.val());
      finalTotal.val(qty * price.val());

      calc_final_total();
    } catch (error) {}
  });

  $(document).on('click', '#add_row', function (e) {
    try {
      let qtyStatus = true,
        variantStatus = true;

      $('.order_item_quantity').each(function (index, element) {
        if (Number($(element).val()) < 0) {
          qtyStatus = false;
          return false;
        }
      });

      $('.item-variant-selection').each(function (index, element) {
        if (Number($(element).val()) <= 0) {
          variantStatus = false;
          return false;
        }
      });

      if (!qtyStatus) {
        swal("", "Cannot add new row when qty is invalid!!", "warning");
        return false;
      } else if (!variantStatus) {
        swal("", "Cannot add new row when variant is invalid !!", "warning");
        return false;
      } else {
        addrow();
      }
    } catch (error) {}
  });

  $(document).on('click', '.remove_row', function(e) {
    try {
      let totalCount = Number($('#total_items').val());

      $(e.target).parent().parent().parent().remove();
      $('#total_items').val(--totalCount);

      calc_final_total();
    } catch (error) {}
  });

  $(document).on('click', '.delete', function(e)  {
    try {
      if (!confirm('Do you wish to delete this POS order?')) {
        return false;
      }
    } catch (error) {}
  });

  function setInvoiceItemDetails(currentElement, val, type)  {
    try {
      let item_data = supplierBranchData1312343458[val];
      let parent = $(currentElement).parent().parent();

      let code = $(parent).children(".item_code").children().first(),
        name = $(parent).children(".item_name").children().first(),
        unit = $(parent).children(".item_unit").children('.item-variant-selection'),
        price = $(parent).children(".item_price").children(),
        qty = $(parent).children(".item_qty").children().first(),
        actualTotal = $(parent).children(".item_actual_amount").children(),
        finalTotal = $(parent).children(".item_final_amount").children();

      $(unit).children().slice(1).remove();

      if (!item_data) {
          unit.val(0);
          price.val('');
          qty.val('');
          actualTotal.val('');
          finalTotal.val('');

        if (type == 1)  {
          name.val('');
        } else if (type == 2){
          code.val('');
        }
      } else {
        currentCodeSelection = item_data['code'];
        code.val(item_data['code']);
        name.val(item_data['name']);

        let variants = item_data['variants'];

        let defaultVariant = 0,
          defaultPrice = 0;

        $.each(variants, function(i, variant) {
          defaultVariant = Number(variant['variant_id']);
          defaultPrice = Number(variant['price']);

          $(unit).append($("<option>").attr("value", variant['variant_id']).text(variant['variant']));
        });

        unit.val(defaultVariant);
        qty.val(1);
        price.val(defaultPrice);
        actualTotal.val(defaultPrice);
        finalTotal.val(defaultPrice);
        unit.focus();

        calc_final_total();
      }
    } catch (error) {}
  }

  function addrow() {
    let totalCount = Number($('#total_items').val());
    $('#total_items').val(++totalCount);

    var html_code = `<tr>
      <td>
        <span>${totalCount}</span>
      </td>
      <td class="item_code">
        <input type="text" name="itemcode[]" list="itemcode_list" class="form-control input-sm datalist-input-code" required />
      </td>
      <td class="item_name">
        <input type="text" name="itemname[]" list="itemname_list" class="form-control input-sm datalist-input-name" required />
      </td>
      <td class="item_unit">
        <select type="text" name="itemvariant[]" class="form-control input-sm item-variant-selection" required>
          <option value="0">Select an unit</option>
        </select>
      </td>
      <td class="item_price">
        <input type="text" name="itemprice[]" class="form-control input-sm number_only order_item_price" readonly />
      </td>
      <td class="item_qty">
        <input type="number" name="itemquantity[]" min="1" value="0" class="form-control input-sm number_only order_item_quantity" required />
      </td>
      <td class="item_actual_amount">
        <input type="text" name="itemactualamount[]" class="form-control input-sm order_item_actual_amount" readonly />
      </td>
      <td class="item_final_amount">
        <input type="hidden" name="itemfinalamount[]" class="form-control input-sm order_item_final_amount" readonly />
        <button type="button" class="btn btn-danger btn-icon-anim btn-circle" title="Click to clear row data">
          <i class="fa fa-trash remove_row" aria-hidden="true"></i>
        </button>
      </td>
    </tr>`;

    $('#invoice-item-table').children().eq(1).append(html_code);
  }

  function areCustomerDetailsSelected()  {
    if (!$('#customer-name').val()) {
      swal("", "Please Add POS To","warning");
      $('#customername').focus();
      return false;
    }

    if (!$('#customer-mobile').val()) {
      swal("", "Please Add POS Mobile","warning");
      $('#customer-mobile').focus();
      return false;
    }

    return true;
  }

  function calc_final_total() {
    try {
      let posTotal = 0;

      $('.order_item_final_amount').each(function(index, element) {
        posTotal += Number($(element).val());
      });

      $('#final_total_amt').text(Number(posTotal).toFixed(2));
    } catch (error) { }
  }

  function clearRow(e) {
    $(e).parent().parent().parent().find(':input').each(function(index, element)  {
      $(element).val('');
    });

    $(e).parent().parent().parent().find(':input').each(function(index, element)  {
      $(element).val('');
    });
  }
</script>

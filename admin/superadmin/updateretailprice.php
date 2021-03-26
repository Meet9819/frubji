<?php

require_once "allcss.php";
require_once "header.php";
require_once "config.php";
require_once "conn.php";

#region Update price in database
if (!empty($_POST["submit"])) {
  try {
    $update_retail_price_master_query = "UPDATE 
      `productsretailprice` 
    SET 
      `price` = ?,
      `active` = ?
    WHERE 
      `id` = ?";

    // start transaction
    if (!mysqli_begin_transaction($conn)) {
      throw new \Exception("Failed to begin transaction!");
    }

    $update_retail_price_master_query_stmt = mysqli_prepare($conn, $update_retail_price_master_query);

    if (!$update_retail_price_master_query_stmt) {
      mysqli_rollback($conn);
      throw new \Exception("Error occured while updating retail price master!");
    }

    // process all records
    for ($i = 0; $i < (int) $_POST["total_records"]; $i++) {
      $row_id = (int) $_POST["main_id"][$i];
      $price = (float) $_POST["price"][$i];
      $active = (int) ($_POST["active"][$i] ?? 0);

      mysqli_stmt_bind_param($update_retail_price_master_query_stmt, "iid", $price, $active, $row_id);

      if (!mysqli_execute($update_retail_price_master_query_stmt)) {
        mysqli_rollback($conn);
        throw new \Exception("Error occured while updating retail price master!");
      }
    }

    mysqli_commit($conn); 
  } catch (\Throwable $th) {
    //throw $th;
    // Failed to product update price master!
  }
}
#endregion
?>

<title>Price Master <?php echo $workingin; ?></title>

<!-- ROLE BASED -->
<?php
  if (empty($_SESSION["user_id"])) {
    // not logged in send to login page
    redirect("index.php");
  }

  $status = false;

  if (authorize($_SESSION["access"]["MASTER"]["UPDATEECOMMERCEPRICE"]["create"]) ||
    authorize($_SESSION["access"]["MASTER"]["UPDATEECOMMERCEPRICE"]["edit"]) ||
    authorize($_SESSION["access"]["MASTER"]["UPDATEECOMMERCEPRICE"]["view"]) ||
    authorize($_SESSION["access"]["MASTER"]["UPDATEECOMMERCEPRICE"]["delete"]) ||
    authorize($_SESSION["access"]["MASTER"]["UPDATEECOMMERCEPRICE"]["approval"])) 
  {
    $status = true;
  }

  if ($status === false) {
    echo "You dont have the permission to access this page";
    return;
  }
?>
<!-- ROLE BASED -->

<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Update Retail Price Master</h5>
      </div>
      <!-- Breadcrumb -->
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.php">Dashboard</a>
          </li>
          <li>
            <a href="pricemaster.php">Master</a>
          </li>
          <li>
            <a href="pricemaster.php">Item Setup</a>
          </li>
          <li class="active">Update Retail Price</li>
        </ol>
      </div>
      <!-- Breadcrumb -->
    </div>
    <div class="panel panel-default border-panel card-view">
      <div class="panel-wrapper collapse in">
        <div class="panel-body">
          <form name="retail-price-master-update-form" action="" method="post" enctype="application/x-www-form-urlencoded">
            <div class="table-wrap">
              <table style="width:100%" id="" class="table table-hover display  pb-30" >
                <thead>
                  <tr>
                    <th>Product ID</th>
                    <th style="padding:10px">Main Category</th>
                    <th style="padding:10px">Product</th>
                    <th>Qty - Unit</th>
                    <th>Price</th>
                    <th title="Show/hide variants">Toggle Variants</th>
                    <th>Toggle Active Status</th>
                  </tr>
                </thead>
                <tbody id="product-rows">
                  <?php 
                    #region fetch all products
                    $query = "SELECT
                        `p`.`id` `PID`,
                        `pv`.`id` `VID`,
                        `m`.`menu_name`,
                        `p`.`name`,
                        `prp`.`id` `MAIN_ID`,
                        `prp`.`productid`,
                        `prp`.`variantid`,
                        `prp`.`price`,
                        `pv`.`qty`,
                        `pv`.`units`,
                        `prp`.`active`
                      FROM
                        `productsretailprice` `prp`
                      INNER JOIN
                        `productvariant` `pv`
                      ON
                        `prp`.`variantid` = `pv`.`id`
                      INNER JOIN                  
                        `products` `p`
                      ON 
                        `prp`.`productid` = `p`.`id`
                      INNER JOIN
                        `menu` `m`
                      ON
                        `p`.`maincat` = `m`.`menu_id`
                      WHERE 
                        `prp`.`branchid` = '{$_SESSION["branch"]}'
                      ORDER BY 
                        `p`.`id`, `pv`.`qty` ASC";

                    $result = mysqli_query($conn, $query);
                    $total_records = mysqli_affected_rows($conn);
                    #endregion

                    $counter = 0;

                    if ($result)  {
                      $current_pid = 0;

                      while ($row = mysqli_fetch_array($result)) {

                        // reset counter to 0, if current PID doesn't match previous
                        if ($current_pid != (int) $row['PID']) {
                          $counter = 0;
                        }

                        // increment counter for toggle visibility condition
                        // if counter is greater than 1, hide <tr> else show it
                        ++$counter;
                  ?>
                    <tr <?php echo ($counter > 1) ? "style='display: none;'" : ""; ?> class="<?php echo "product-row-" . (int) $row['PID']; ?>" data-pid="<?php echo (int) $row['PID']; ?>">
                      <td><?php echo $row['PID']; ?></td>
                      <td style="padding:10px">
                        <input type="text" class="form-control category" value="<?php echo $row['menu_name']; ?>" readonly />
                        <input type="hidden" class="form-control" name="main_id[]" value="<?php echo (int) $row['MAIN_ID']; ?>" readonly />
                      </td>
                      <td style="padding:10px">
                        <input type="text" class="form-control product" value="<?php echo $row['name']; ?>" readonly />
                        <input type="hidden" class="form-control" name="product[]" value="<?php echo (int) $row['PID']; ?>" readonly />
                      </td>
                      <td>
                        <input type="text" class="form-control qtyunit" value="<?php echo $row['qty']; ?> <?php echo $row['units']; ?>" readonly />
                        <input type="hidden" class="form-control" name="variant[]" value="<?php echo (int) $row['VID']; ?>" readonly />
                      </td>
                      <td>  
                        <input type="text" class="<?php echo ($counter > 1) ? "form-control price" : "form-control product-row-price price"  ; ?>" name="price[]" value="<?php echo $row['price']; ?>" />
                      </td>
                      <td>
                        <?php 
                          // show toggle checkbox only for smallest qty unit of all products
                          if ($counter <= 1) { 
                        ?>
                        <input type="checkbox" class="toggle-variants" title="Click to show/hide variants" />
                        <?php } ?>
                      </td>
                      <td>
                        <input type="hidden" class="form-control" name="active[]" value="<?php echo $row['active']; ?>" readonly />
                        <input type="checkbox" class="toggle-active-status" value="<?php echo $row['active']; ?>" title="Click to toggle active status of product" <?php echo ((int)$row['active'] == 1) ? "checked" : ""; ?>/>
                      </td>
                    </tr>
                  <?php
                        $current_pid = (int) $row['PID'];
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="row" style="text-align: right;">
              <input type="hidden" name="total_records" value="<?php echo $total_records; ?>" />
              <input type="submit" name="submit" class="btn btn-primary btn-rounded" value="Update Price Master" />
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php require_once "footer.php";?>
  </div>
</div>

<?php include "allscript.php";?>
<script src="../vendors/bower_components/dropify/dist/js/dropify.min.js"></script>
<script src="../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
<script>
  const gmsPerKG = 1000,
    mlPerL = 1000;

  $('.product-row-price').on('change', function() {
    try {
      // get default reference price
      let refPrice = Number($(this).val());

      // get reference qty unit product row
      let qtyUnitRefColParent = $(this).parent().parent().find('.qtyunit');

      if (!qtyUnitRefColParent) {
        throw new Error('Qty Unit column is invalid!');
      }

      let qtyUnitRefCol = $(qtyUnitRefColParent).val();

      let [refQty, refUnit] = qtyUnitRefCol.split(' ');

      // check reference unit and normalize price accordingly
      switch(refUnit.toUpperCase())  {
        case 'KG':
        case 'KGS':
          // normalize price to per gm
          refPrice = normalizePrice(refPrice, refQty, gmsPerKG);
          break;
        case 'L':
        case 'LITRE':
        case 'LITRES':
          // normalize price to per ml
          refPrice = normalizePrice(refPrice, refQty, mlPerL);
          break;
        default:
          break;
      }

      // get product ID of current row
      let productID = getProductID(this);

      // get all product rows on page by productID
      let productRows = getProductRows(productID);

       // process each row and change price according to qty specified
       productRows.each(function(i) {
        // ignore first iteration
        if (!i) {
          return;
        }

        let productRow = productRows[i];

        // get all columns of product row
        let productDataColumns = getProductDataColumns(productRow);

        // get qty unit data column
        let qtyUnitColParent = productDataColumns[3];
        let productRowPriceParent = productDataColumns[4];

        if (!qtyUnitColParent || !productRowPriceParent)  {
          throw new Error('Qty Unit or Product price column is invalid!');
        }

        let qtyUnitCol = $(qtyUnitColParent).children().first().val();

        let [qty, unit] = qtyUnitCol.split(' ');

        let total = 0;

        // check unit and calculate price accordingly
        switch(unit.toUpperCase())  {
          case 'KG':
          case 'KGS':
            // convert price to per gm
            total = reconvertPrice(refPrice, qty, gmsPerKG);
            break;
          case 'L':
          case 'LITRE':
          case 'LITRES':
            // convert price to per ml
            total = reconvertPrice(refPrice, qty, mlPerL);
            break;
          default:
            break;
        }

        // set total as input value
        $(productRowPriceParent).children().first().val(total);
      });
    } catch (error) {}
  });

  $('.toggle-variants').on('click', function()  {
    try {
      // save status of whether checkbox is checked
      let checkboxChecked = $(this).prop('checked');
       
      // get product ID of current row
      let productID = getProductID(this);

      // get all product rows on page by productID
      let productRows = getProductRows(productID);

      // process each row and toggle visibility according to checkbox checked status
      productRows.each(function(i) {
        // ignore first iteration
        if (!i) {
          return;
        }

        if (checkboxChecked)  {
          $(productRows[i]).show();
        } else {
          $(productRows[i]).hide();
        }
      });
    } catch (error) {}
  });

  $('.toggle-active-status').on('click', function(e) {
    try {
      let ref = $(this);
      
      let currentVal = $(ref).prev().val();

      if (currentVal == 1)    {
          $(ref).prev().val(0);
      } else {
          $(ref).prev().val(1);
      }
    } catch (error) {}
  });

  function getProductID(ref)  {
    try {
      // get parent element
      let parent = $(ref).parent().parent();

      if (!parent)  {
        throw new Error('parent row not found!');
      }

      // get productID from parent's data attribute
      return Number($(parent).data('pid'));
    } catch (error) {
      throw error;
    }
  }

  function getProductRows(productID) {
    try {
      if (!productID) {
        throw new Error('product ID required!');
      }

      return $('#product-rows').find(`.product-row-${productID}`);
    } catch (error) {
      throw error;
    }
  }

  function getProductDataColumns(ref)  {
    try {
      return $(ref).children();
    } catch (error) {
      throw error;
    }
  }

  function normalizePrice(price, qty, factor) {
    try {
      return (Number(price) / (Number(qty) * Number(factor)));
    } catch (error) {
      throw error;
    }
  }

  function reconvertPrice(price, qty, factor) {
    try {
      return Number(price) * Number(qty) * Number(factor);
    } catch (error) {
      throw error;
    }
  }
</script>
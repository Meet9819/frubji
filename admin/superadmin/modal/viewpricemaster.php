<div class="modal fade bs-example-modal-lg" id="view<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">View Price Master</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8" style="font-size:19px">
            <?php 
              include('conn.php');
              $view = mysqli_query($conn,"SELECT * from products where id='".$row['id']."'");
              $erow = mysqli_fetch_array($view); 
              $id = $erow['id'];
              echo 'Item Code  - '.$id = $erow['id'];
            ?> 
            <br /><br />
            <?php 
              $rw = $row['id'];
              $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
              echo $code = $Bar->getBarcode($rw, $Bar::TYPE_CODE_128).'<br>';
              echo 'Item Name [en] - '.$erow['name'].'<br>';
            ?>  
          </div> 
          <div class="col-md-4 text-right"> 
            <img width="50%" src="images/employee/photo.jpg" class="img-responsive img-thumbnail" />
          </div>
        </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default border-panel card-view">
                <div class="panel-wrapper collapse in">
                  <h5 class="text-center mb-10">Product Price List</h5>
                  <div class="panel-body update-form-body">
                    <div class="row" style="background-color: #f6f6f6;">
                      <div class="col-md-3 bor">Branch Name  </div>
                      <div class="col-md-5 bor">NOS  </div>
                      <div class="col-md-3 bor">Price </div>
                      <div class="col-md-1"></div>
                    </div>
                    <?php
                      include('database_connection.php');
                      $price_master_query = "SELECT 
                          `pv`.`id` AS `variantid`,
                          `pv`.`productid`,
                          CASE 
                            WHEN (`pp`.`price` IS NULL) THEN 0
                            ELSE `pp`.`price`
                          END AS price, 
                          `pv`.`qty`, 
                          `pv`.`units`
                        FROM 
                          `productvariant` `pv` 
                        LEFT JOIN 
                          `productsprice` `pp` 
                        ON 
                          `pv`.`productid` = `pp`.`productid` AND `pv`.`id` = `pp`.`variantid`
                        WHERE 
                         
                          `pv`.`productid` = :id AND (`pp`.`branchid` = $workingin OR `pp`.`branchid` IS NULL)";

                      $statement = $connect->prepare($price_master_query); 

                      $statement->execute(array(
                        ":id" => $row["id"],
                      )); 
                      $item_result = $statement->fetchAll();
                      $count = 0;
                      foreach($item_result as $sub_row) {
                    ?>
                    <div class="row">
                      <div class="form-group">
                        <div class="col-md-3 bor">
                          <input tabindex="" type="text"  name="branch[]" class="form-control price-branch" value="<?php echo trim($branchname_english); ?>" readonly>
                          <input tabindex="" type="hidden" class="form-control price-branchid" value="<?php echo trim($workingin); ?>" readonly>
                        </div>
                        <div class="col-md-5 bor">
                          <input tabindex="" type="text" name="variant[]" class="form-control price-variants" value="<?php echo "{$sub_row["qty"]} {$sub_row['units']}"; ?>" readonly>
                          <input tabindex="" type="hidden" class="form-control price-variantid" value="<?php echo trim($sub_row['variantid']); ?>" readonly>
                        </div>
                        <div class="col-md-3 bor">
                          <input tabindex="" type="text" name="price[]" class="form-control price-fixprice" value="<?php echo $sub_row["price"]; ?>">
                          <input tabindex="" type="hidden" class="form-control price-productid" value="<?php echo trim($sub_row['productid']); ?>" readonly>
                        </div>
                        <div class="col-md-1">
                          <?php 
                            if ($count == 0)  {
                          ?>
                          <input type="checkbox" title="Toggle price control" name="price-control-toggle" class="price-control-toggle" />
                          <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                    <?php
                        ++$count;
                      }
                    ?>
                    <div class="row" style="text-align: right;">
                      <input type="button" value="Update" name="submit" id="submit" class="btn btn-primary btn-rounded price-form-submit-btn">
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$id = $_GET['edit_id'];

if (is_null($id) or empty($id)) {
    return;
}
?>

<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
</head>
<body> 


    <!-- Main Content -->
    <div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Edit Customer Master
            </h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li>
                <a href="index.php">Dashboard
                </a>
              </li>
              <li>
                <a href="customermaster.php">
                  <span>Master
                  </span>
                </a>
              </li>
              <li>
                <a href="customermaster.php">
                  <span>Customer Setup
                  </span>
                </a>
              </li>
              <li class="active">
                <span> Edit Customer Master
                </span>
              </li>
            </ol>
          </div>
          <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->  
        <!-- Row -->
        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default border-panel card-view">
              <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <form id="example-advanced-form" action="customer_update.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" > 

   
                    <?php
                    include "db.php";
                    $result = mysqli_query($con, "SELECT * FROM customer WHERE id=" . $_GET['edit_id']);
                    $cust = mysqli_fetch_array($result);

                    ?>                       
                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Customer Code
                              </label> 
                              <input type="text" readonly="" name="code" class="form-control"  placeholder="Enter Customer Code" value="<?php echo trim($cust['code']) ?>"  >
                            </div>   

                            <div class="form-group col-md-8">
                              <label  class="control-label mb-10">Customer Name 
                              </label>
                              <input type="text" name="customername" class="form-control"  placeholder="Enter Customer Name " value="<?php echo trim($cust['customername']) ?>"  >
                            </div>  

                          <div class="form-group col-md-12" style="padding: 5px">  </div>

                    <div class="panel panel-default border-panel card-view">
                      <div  class="pills-struct "> 
                        <ul role="tablist" class="nav nav-pills" id="myTabs_6">
                          <li class="active" role="presentation" id="wi">
                            <a aria-expanded="true"  data-toggle="tab" role="tab" id="pad" href="#itemdetails" >Customer Information
                            </a>
                          </li>
                          <li role="presentation" class=""  id="wi">
                            <a  data-toggle="tab" id="pad" role="tab" href="#categorydetails" aria-expanded="false"  >Contact Information
                            </a>
                          </li> 
                          <li role="presentation" class=""  id="wi">
                            <a  data-toggle="tab" id="pad" role="tab" href="#Customerdetails" aria-expanded="false" >Bank Information
                            </a>
                          </li>
                                <li role="presentation" class=""  id="wi">
                                  <a  data-toggle="tab" id="pad" role="tab" href="#branchinformation" aria-expanded="false" >Customer Branch Information
                                  </a>
                                </li>
                       
                        </ul>
                        <div class="tab-content " id="myTabContent_6" >
                          <div  id="itemdetails" class="tab-pane fade active in  mt-30" role="tabpanel">
                        
                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Old Code
                              </label> 
                              <input type="text" name="oldcode" class="form-control"  placeholder="Enter Old Code" value="<?php echo trim($cust['oldcode']) ?>"  >
                            </div>   

                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Customer Name in Arabic
                              </label>
                              <input type="text" name="customername_ar" class="form-control"  placeholder="Enter Customer Name " value="<?php echo trim($cust['customername_ar']) ?>" >
                            </div>  

                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Chq Print Name
                              </label> 
                               <input type="text" name="chqprintname" class="form-control"  placeholder="Enter Chq Print Name " value="<?php echo trim($cust['chqprintname']) ?>"  >
                            </div>
                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Account Head
                              </label>
                              <input type="text" name="accounthead"  class="form-control"  placeholder="Enter Account Head Number " value="<?php echo trim($cust['accounthead']) ?>" >
                            </div>
 
                              <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Status
                              </label>

                               <select name="status" class="form-control select2"  tabindex="0">                            
                                <?php if ($cust['status'] != ''){echo ' <option value="'.trim($cust['status']).'" >  '.($cust['status']).''; }
                                else {echo ' <option value="" > Choose Status';} ?> </option>    
                                <option value="1">Active</option>  
                                <option value="2">Suspend</option>
                              </select>
                            </div>  

                                <div class="form-group col-md-4">
                                  <label  class="control-label mb-10">Quotation Period</label>
                                  <input type="number" name="quotationvalidity"  class="form-control"  placeholder="Enter Quotation Period" value="<?php echo trim($cust['quotationvalidity']) ?>" >
                                </div>

                                     <div class="form-group col-md-12"></div>
                                     <div class="form-group col-md-4">
                                      <label  class="control-label mb-10">Select Customer Group</label>
                                      <select name="customergroup" class="form-control select2" tabindex="0">
                                          <?php if ($cust['customergroup'] != '')
                                          {echo ' <option value="'.trim($cust['customergroup']).'" >  '.($cust['customergroup']).'';}
                                           else{echo ' <option value="" > Choose customergroup';} ?> </option>                                          
                                          <option value="DIRECT">Direct</option>  
                                          <option value="QUOTATION">Quotation</option>
                                        </select>
                                     </div> 

                                      <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Billing On</label>
                                       <select name="billingon" class="form-control select2" tabindex="0">
                                         <?php if ($cust['billingon'] != '')
                                          {echo ' <option value="'.trim($cust['billingon']).'" >  '.($cust['billingon']).'';}
                                           else{echo ' <option value="" > Choose billingon';} ?> </option>  

                                      <option value="CREDIT">Credit</option>  
                                      <option value="CASH">Cash</option>
                                      </select>
                                     </div> 


                                    <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Select Invoice Type</label>
                                       <select name="invoicetype" class="form-control select2"  tabindex="0">
                                         <?php if ($cust['invoicetype'] != '')
                                          {echo ' <option value="'.trim($cust['invoicetype']).'" >  '.($cust['invoicetype']).'';}
                                           else{echo ' <option value="" > Choose invoicetype';} ?> </option>                                            
                                        
                                        <option value="WHOLESALE">Wholesale</option>  
                                        <option value="RETAIL">Retail</option>
                                        <option value="ANY">Any</option>
                                        </select>
                                     </div> 




                                      <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Select Sector</label>
                                        <select name="sector"  class="form-control select2"   tabindex="0">

                                           <?php if ($cust['sector'] != '')
                                          {echo ' <option value="'.trim($cust['sector']).'" >  '.($cust['sector']).'';}
                                           else{echo ' <option value="" > Choose sector';} ?> </option>                                            
                                        <?php
                                        include"db.php";
                                        $result = mysqli_query($con,"SELECT * FROM customer_sector");
                                        while($row = mysqli_fetch_array($result))
                                        {
                                        echo '<option value="'.$row['title'].'">' .$row['title'].'</option>';
                                        } 
                                        ?>
                                        </select>
                                     </div> 


                                      <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Select Category</label>
                                       <select name="category"  class="form-control select2"   tabindex="0">

                                         <?php if ($cust['category'] != '')
                                          {echo ' <option value="'.trim($cust['category']).'" >  '.($cust['category']).'';}
                                           else{echo ' <option value="" > Choose category';} ?> </option>   

                                           
                             
                                      <?php
                                      include"db.php";
                                      $result = mysqli_query($con,"SELECT * FROM customer_category");
                                      while($row = mysqli_fetch_array($result))
                                      {
                                      echo '<option value="'.$row['title'].'">' .$row['title'].'</option>';
                                      } 
                                      ?>
                                      </select>
                                     </div> 

                                      <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Select Invoice Price</label>
                                       <select name="invoiceprice" class="form-control select2"  tabindex="0">
                                        <option value="<?php echo trim($cust['invoiceprice']) ?>" >  <?php echo trim($cust['invoiceprice']) ?>   </option>    
                             
                                        <option value="WHOLESALE">Wholesale</option>  
                                        <option value="RETAIL">Retail</option>
                                        <option value="COST ">Cost</option>
                                      </select>
                                     </div> 
                                    
                               <div class="form-group col-md-4">
                                <label  class="control-label mb-10">Type                           </label>
                             <select name="type" class="form-control select2"   tabindex="0">
                              <option value="<?php echo trim($cust['type']) ?>" >  <?php echo trim($cust['type']) ?>   </option>    
                               <option value="INTERNATIONAL CUSTOMER">Intl. Customer</option>  
                            <option value="LOCAL CUSTOMER">Local Customer</option>
                          </select>
                            </div>   
                            
                             <div class="form-group col-md-4">
                                         <label for="input
                                         Name" class="control-label mb-10">Enter Area</label>
                                          <select name="area"  class="form-control select2"   tabindex="0">
                                          <option value="<?php echo trim($cust['area']) ?>" >  <?php echo trim($cust['area']) ?>   </option>    
                                          <?php
                                          include"db.php";
                                          $result = mysqli_query($con,"SELECT * FROM customer_area");
                                          while($row = mysqli_fetch_array($result))
                                          {
                                          echo '<option value="'.$row['title'].'">' .$row['title'].'</option>';
                                          } 
                                          ?>
                                          </select>

                                     </div>        

                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Location
                              </label>
                              <input type="text"  name="location " class="form-control"  placeholder="Enter Location" value="<?php echo trim($cust['location']) ?>">
                            </div> 
                            <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Address
                              </label>
                              <textarea type="text"  name="address" class="form-control"  placeholder="Enter Address" ><?php echo trim($cust['address']) ?></textarea> 
                         
                            </div>                       
                            

                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Credit Limit
                              </label>
                              <input type="text"  name="creditlimits" class="form-control"  placeholder="Enter Credit Limit" value="<?php echo trim($cust['creditlimits']) ?>" >
                            </div> 
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Credit Days 
                              </label>
                             <input type="number" name="creditdays"  class="form-control"  placeholder="Enter Credit Days  " value="<?php echo trim($cust['creditdays']) ?>" >
                           
                            </div>

                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Grace Limit
                              </label>
                              <input type="text"  name="gracelimit" class="form-control"  placeholder="Enter Grace Limit" value="<?php echo trim($cust['gracelimit']) ?>">
                            </div> 
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Grace Days 
                              </label>
                             <input type="number" name="gracedays"  class="form-control"  placeholder="Enter Grace Days  "  value="<?php echo trim($cust['gracedays']) ?>">
                           
                            </div>
                           
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Telephone
                              </label>
                              <input type="text" name="ctelephone"  class="form-control"  placeholder="Enter Telephone  "  value="<?php echo trim($cust['ctelephone']) ?>"  >
                            </div>   
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Mobile 
                              </label>
                              <input type="text" name="cmobile"  class="form-control"  placeholder="Enter Mobile "  value="<?php echo trim($cust['cmobile']) ?>"  >
                            </div> 
                            
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">FAX
                              </label>
                              <input type="text" name="fax"  class="form-control"  placeholder="Enter FAX"  value="<?php echo trim($cust['fax']) ?>" >
                            </div>
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Email
                              </label>
                              <input type="text" name="cemail"  class="form-control"  placeholder="Enter Email"  value="<?php echo trim($cust['cemail']) ?>" >
                            </div>  

                          </div>
                          <div  id="categorydetails" class="tab-pane fade mt-30" role="tabpanel"> 











                            <div class="col-md-12">
  <div class="row">
    <table  id="customertelephonetable" width="100%">
      <tbody>
        <tr>
          <td>
            <div class="col-md-12">
              <label for="inputName" class="control-label mb-10">Department
              </label> 
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label for="inputName" class="control-label mb-10">Name
              </label> 
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label for="inputName" class="control-label mb-10">Telephone
              </label> 
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label for="inputName" class="control-label mb-10">Mobile
              </label> 
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label for="inputName" class="control-label mb-10">Whats App
              </label> 
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label for="inputName" class="control-label mb-10">Email
              </label> 
            </div>
          </td>
        </tr>
        <?php
          include "db.php";
          $result = mysqli_query($con, "SELECT * FROM customer_telephone WHERE customerid=" . $_GET['edit_id']);
          $totalContact = mysqli_num_rows($result);
          $first_row = true;
          while ($dr_mob = mysqli_fetch_array($result)) {
              ?>
        <tr id='doctortelephone0'>
          <td>
            <!-- new change -->
            <input type="hidden" name="contact_id[]" value="<?php echo $dr_mob['id']; ?>" />



            <div class="form-group col-md-12">
             
            <input type="text" name="department[]" class="form-control" id="inputName" placeholder=" Department" value="<?php echo $dr_mob['department']; ?>" >
            </div>
          </td> 
          <td>
           <div class="form-group col-md-12"> 
            <input type="text" name="name[]" class="form-control" id="inputName" placeholder=" Telephone" value="<?php echo $dr_mob['name']; ?>" >
              </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <input type="text" name="telephone[]" class="form-control" id="inputName" placeholder=" Telephone" value="<?php echo $dr_mob['telephone']; ?>" >
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">                        
              <input type="text" name="mobile[]" class="form-control" id="inputName" placeholder=" Mobile" value="<?php echo $dr_mob['mobile']; ?>">
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <input type="text" name="whatsapp[]" class="form-control" id="inputName" placeholder=" WhatsApp" value="<?php echo $dr_mob['whatsapp']; ?>">
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <input type="text" name="email[]" class="form-control"  placeholder=" Enter Email Id" value="<?php echo $dr_mob['email']; ?>" >
            </div>
          </td>
          <td>
            <?php
              if ($first_row) {
                      echo " 
                      <a id='customer_telephone_type_add'  style='margin-top:-55px' class='btn btn-default btn-icon-anim btn-circle'><i  style='margin-top: 12px;'  class='fa fa-plus' aria-hidden='true'></i></a>";
                      $first_row = false;
                  } else {
                      echo "
              
                          <a style='margin-top:-55px' id='customer_telephone_type_delete' class='btn btn-danger btn-icon-anim btn-circle customer_telephone_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
              ";
                  }
                  ?>
          </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
    <input type="text" class="hiddentextbox" name="customer_telephone_type" id="customer_telephone_type" value="<?php echo $totalContact; ?>" />
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script type="text/javascript">
  $(document).ready(function()  {
    // new change
    $("#customer_telephone_type_add").click(function()  {
      let i = Number($("#customer_telephone_type").val());
  
      $("#customertelephonetable tbody").append(`
        <tr id='doctortelephone${j=++i}'>
          <td>
            <div class='form-group col-md-12'> 
            <input type='text' class='form-control' name='department[]'  placeholder='Department' />
               
            </div>
          </td> 

          <td>
            <div class='form-group col-md-12'>
                <input type='text' class='form-control' name='name[]'  placeholder='name' />
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
  
            <input type='text' class='form-control' name='telephone[]'  placeholder='Telephone' />
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
  
              <input type='text' class='form-control'  name='mobile[]' placeholder='Mobile' />
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
  
              <input type='text' class='form-control' name='whatsapp[]'  placeholder='WhatsApp' />
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
  
              <input type='text' class='form-control' name='email[]' id='inputEmail' placeholder='Enter Email Id' />
            </div>
          </td>
          <td>
  
           <a style='margin-top:-55px' id='customer_telephone_type_delete' class='btn btn-danger btn-icon-anim btn-circle customer_telephone_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
  
          
           </td>
        </tr>`);
      $('#customer_telephone_type').val(i);
    });
    $("#customertelephonetable tbody").on("click", ".customer_telephone_type_delete", function() {
      let telephone_id = $(this).parent().parent().first().children().children().first().val();
  
      if (telephone_id) {
        $.ajax({
          url: window.location.origin + '/family/superadmin/doctor_delete.php?type=telephone&id=' + telephone_id,
          type: "GET",
          success: function(result) {
            window.alert("Contact removed");
            window.setTimeout(function() {
              window.location.href = window.location.href + "#contactinformation";
              window.location.reload(true);
            }, 0);
          }
        });
      } else {
        $(this).parent().parent().remove();
        let i = Number($("#customer_telephone_type").val());
        $('#customer_telephone_type').val(--i);
      }
    });
  });
</script>



                           

                 


                 </div> 
                    <div  id="Customerdetails" class="tab-pane fade mt-30" role="tabpanel">
                      <div class="col-md-12">
                            <div class="row">
                                 <table  id="employeebanktable" width="100%">
                                        <tbody> 
                                          <tr>
                                                <td width="20%"> 
                                                <div class="col-md-12">
                                                  <label class="control-label mb-10">Bank Name
                                                  </label> 
                                                  
                                                  </div>
                                              </td>
                                                   <td width="20%"> 
                                                  
                                                  <div class="col-md-12">
                                                    <label class="control-label mb-10">Branch
                                                    </label> 

                                                  </div>
                                                </td>
                                                  <td width="20%"> 
                                                  
                                                  <div class="col-md-12">
                                                    <label class="control-label mb-10">Account No
                                                    </label> 
                                                    
                                                    </div> 
                                                </td>     <td width="30%"> 
                                                  
                                                  <div class="col-md-12">
                                                    <label class="control-label mb-10">IBAN No / IFSC Code
                                                    </label> 
                                                    
                                                    </div> 
                                                </td>     <td width="10%"> 
                                                  
                                                  <div class="col-md-12">
                                                    <label class="control-label mb-10">Country
                                                    </label> 
                                                    
                                                    </div> 
                                                </td>
                                              </tr>

                                              <?php
                                              include "db.php";
                                              $result = mysqli_query($con, "SELECT * FROM customer_bank WHERE customerid=" . $_GET['edit_id']);
                                              $totalAddr = mysqli_num_rows($result);
                                              $first_row = true;
                                              while ($emp_bank = mysqli_fetch_array($result)) {
                                              ?>
                                              <tr id='empbank0'>
                                                <td>
                                                <!-- new change -->
                                                  <input type="hidden" name="supplier_bank_id[]" value="<?php echo $emp_bank['id']; ?>" />
                                                   <div class="form-group col-md-12">
                                            
                                                     <input name="bankname[]" type="text" class="form-control"  value="<?php echo $emp_bank['bankname'] ?>" >
                                            
                                                    </div>
                                                </td>
                                                <td>
                                                  <div class="form-group col-md-12">
                                                  
                                                        <input name="bankbranch[]" type="text" class="form-control"  value="<?php echo $emp_bank['bankbranch'] ?>" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group col-md-12">
                                                   
                                                    <input name="accountno[]" type="text" class="form-control"   value="<?php echo $emp_bank['accountno'] ?>" >
                                                    </div>
                                                </td>   <td>
                                                    <div class="form-group col-md-12">
                                                   
                                                    <input name="ibanno[]" type="text" class="form-control"   value="<?php echo $emp_bank['ibanno'] ?>" >
                                                    </div>
                                                </td>  <td>
                                                    <div class="form-group col-md-12">
                                                   
                                                    <input name="country[]" type="text" class="form-control"   value="<?php echo $emp_bank['country'] ?>" >
                                                    </div>
                                                </td>
                                                <td>
                                                <?php
                                                if ($first_row) {
                                                        echo "<a id='sup_bank_type_add'  style='margin-top:-55px' class='btn btn-default btn-icon-anim btn-circle'><i  style='margin-top: 12px;'  class='fa fa-plus' aria-hidden='true'></i></a> ";
                                                        $first_row = false;
                                                    } else {
                                                        echo "  <a style='margin-top:-55px' id='sup_bank_type_delete' class='btn btn-danger btn-icon-anim btn-circle sup_bank_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a>  ";
                                                    }
                                                    ?>
                                                </td>
                                              </tr>
                                          <?php }?>
                                      </tbody>
                                  </table>

                                <input type="hidden" name="sup_bank_type" id="sup_bank_type" value="<?php echo $totalAddr; ?>" />

                              </div>
                              </div>


                           
                                <script type="text/javascript">
                                  $(document).ready(function()  {
                                    // new change
                                    $("#sup_bank_type_add").click(function()  {
                                      let i = Number($("#sup_bank_type").val());

                                      $("#employeebanktable tbody").append(`
                                        <tr id='empbank${j=++i}'>
                                          <td>
                                           <div class='form-group col-md-12'>                      
                                                <input name='bankname[]' type='text' class='form-control'  />
                                            </div>
                                          </td>
                                          <td>
                                            <div class='form-group col-md-12'>
                                              <input name='bankbranch[]' type='text' class='form-control'  />
                                            </div>
                                          </td>
                                          <td>
                                            <div class='form-group col-md-12'>
                                             <input name='accountno[]' type='text' class='form-control' />
                                            </div>
                                          </td><td>
                                            <div class='form-group col-md-12'>
                                             <input name='ibanno[]' type='text' class='form-control' />
                                            </div>
                                          </td><td>
                                            <div class='form-group col-md-12'>
                                             <input name='country[]' type='text' class='form-control' />
                                            </div>
                                          </td>
                                          <td> <a style='margin-top:-55px' id='sup_bank_type_delete' class='btn btn-danger btn-icon-anim btn-circle sup_bank_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
                                         </td>
                                        </tr>`);
                                      $('#sup_bank_type').val(++i);
                                    });
                                    $("#employeebanktable tbody").on('click', '.sup_bank_type_delete', function() {
                                      let supplier_bank_id = $(this).parent().parent().first().children().children().first().val();

                                      if (supplier_bank_id) {
                                        $.ajax({
                                          url: window.location.origin + '/family/superadmin/masterdelete/sup_bank_delete.php?type=bank&id=' + supplier_bank_id,
                                          type: "GET",
                                          success: function(result) {
                                            window.alert("Bank Details of Supplier Removed");
                                            window.setTimeout(function() {
                                              window.location.href = window.location.href + "#Bank Details of Supplier Removed";
                                              window.location.reload(true);
                                            }, 0);
                                          }
                                        });
                                      } else {
                                        $(this).parent().parent().remove();
                                        let i = Number($("#sup_bank_type").val());
                                        $('#sup_bank_type').val(--i);
                                      }
                                    });
                                  });
                                </script>



                            
                         

                          </div>







                           <div  id="branchinformation" class="tab-pane fade mt-30" role="tabpanel">
                      <div class="col-md-12">
                            <div class="row">
                                 <table  id="customeraddresstable" width="100%">
                                        <tbody> 
                                          <tr>
                                                <td width="20%"> 
                                                <div class="col-md-12">
                                                  <label class="control-label mb-10">Branch Name
                                                  </label> 
                                                  </div>
                                              </td>
                                                <td width="10%">                                                   
                                                  <div class="col-md-12">
                                                    <label class="control-label mb-10">Contact Person
                                                    </label> 
                                                  </div>
                                                </td>
                                                  <td width="10%">                                                   
                                                  <div class="col-md-12">
                                                    <label class="control-label mb-10">Mobile no
                                                    </label>                                                     
                                                    </div> 
                                                </td>     
                                                <td width="30%">                                                   
                                                  <div class="col-md-12">
                                                    <label class="control-label mb-10">Branch Address
                                                    </label>                                                     
                                                    </div> 
                                                </td>     
                                                <td width="10%">                                                   
                                                  <div class="col-md-12">
                                                    <label class="control-label mb-10">Latitude
                                                    </label>                                                     
                                                    </div> 
                                                </td> <td width="10%">                                                   
                                                  <div class="col-md-12">
                                                    <label class="control-label mb-10">Longitude
                                                    </label>                                                     
                                                    </div> 
                                                </td>
                                              </tr>

                                              <?php
                                              include "db.php";
                                              $result = mysqli_query($con, "SELECT * FROM customer_officeaddress WHERE customerid=" . $_GET['edit_id']);
                                              $totalAddr = mysqli_num_rows($result);
                                              $first_row = true;
                                              while ($emp_bank = mysqli_fetch_array($result)) {
                                              ?>
                                              <tr id='custadd0'>
                                                <td>
                                                <!-- new change -->
                                                  <input type="hidden" name="customeraddress_id[]" value="<?php echo $emp_bank['id']; ?>" />
                                                   <div class="form-group col-md-12">
                                            
                                                     <input name="branchname[]" type="text" class="form-control"  value="<?php echo $emp_bank['branchname'] ?>" >
                                            
                                                    </div>
                                                </td>
                                                <td>
                                                  <div class="form-group col-md-12">
                                                  
                                                        <input name="contactperson[]" type="text" class="form-control"  value="<?php echo $emp_bank['contactperson'] ?>" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group col-md-12">
                                                   
                                                    <input name="mobileno[]" type="text" class="form-control"   value="<?php echo $emp_bank['mobileno'] ?>" >
                                                    </div>
                                                </td>   <td>
                                                    <div class="form-group col-md-12">
                                                   
                                                    <input name="branchaddress[]" type="text" class="form-control"   value="<?php echo $emp_bank['branchaddress'] ?>" >
                                                    </div>
                                                </td>  
                                                <td>
                                                    <div class="form-group col-md-12">
                                                   
                                                    <input name="latitude[]" type="text" class="form-control"   value="<?php echo $emp_bank['latitude'] ?>" >
                                                    </div>
                                                </td> <td>
                                                    <div class="form-group col-md-12">
                                                   
                                                    <input name="longitude[]" type="text" class="form-control"   value="<?php echo $emp_bank['longitude'] ?>" >
                                                    </div>
                                                </td>
                                                <td>
                                                <?php
                                                if ($first_row) {
                                                        echo "<a id='customerofficeaddress_type_add'  style='margin-top:-55px' class='btn btn-default btn-icon-anim btn-circle'><i  style='margin-top: 12px;'  class='fa fa-plus' aria-hidden='true'></i></a> ";
                                                        $first_row = false;
                                                    } else {
                                                        echo "  <a style='margin-top:-55px' id='cust_address_office_type_delete' class='btn btn-danger btn-icon-anim btn-circle cust_address_office_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a>  ";
                                                    }
                                                    ?>
                                                </td>
                                              </tr>
                                          <?php }?>
                                      </tbody>
                                  </table>

                                <input type="hidden" name="customeroffice_type" id="customeroffice_type" value="<?php echo $totalAddr; ?>" />

                              </div>
                              </div>


                           
                                <script type="text/javascript">
                                  $(document).ready(function()  {
                                    // new change
                                    $("#customerofficeaddress_type_add").click(function()  {
                                      let i = Number($("#customeroffice_type").val());

                                      $("#customeraddresstable tbody").append(`
                                        <tr id='custadd${j=++i}'>
                                          <td>
                                           <div class='form-group col-md-12'>                      
                                                <input name='branchname[]' type='text' class='form-control'  />
                                            </div>
                                          </td>
                                          <td>
                                            <div class='form-group col-md-12'>
                                              <input name='contactperson[]' type='text' class='form-control'  />
                                            </div>
                                          </td>
                                          <td>
                                            <div class='form-group col-md-12'>
                                             <input name='mobileno[]' type='text' class='form-control' />
                                            </div>
                                          </td><td>
                                            <div class='form-group col-md-12'>
                                             <input name='branchaddress[]' type='text' class='form-control' />
                                            </div>
                                          </td><td>
                                            <div class='form-group col-md-12'>
                                             <input name='latitude[]' type='text' class='form-control' />
                                            </div>
                                          </td><td>
                                            <div class='form-group col-md-12'>
                                             <input name='longitude[]' type='text' class='form-control' />
                                            </div>
                                          </td>
                                          <td> <a style='margin-top:-55px' id='cust_address_office_type_delete' class='btn btn-danger btn-icon-anim btn-circle cust_address_office_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
                                         </td>
                                        </tr>`);
                                      $('#customeroffice_type').val(++i);
                                    });
                                    $("#customeraddresstable tbody").on('click', '.cust_address_office_type_delete', function() {
                                      let customeraddress_id = $(this).parent().parent().first().children().children().first().val();

                                      if (customeraddress_id) {
                                        $.ajax({
                                          url: window.location.origin + '/family/superadmin/masterdelete/sup_bank_delete.php?type=bank&id=' + customeraddress_id,
                                          type: "GET",
                                          success: function(result) {
                                            window.alert("Bank Details of Supplier Removed");
                                            window.setTimeout(function() {
                                              window.location.href = window.location.href + "#Bank Details of Supplier Removed";
                                              window.location.reload(true);
                                            }, 0);
                                          }
                                        });
                                      } else {
                                        $(this).parent().parent().remove();
                                        let i = Number($("#customeroffice_type").val());
                                        $('#customeroffice_type').val(--i);
                                      }
                                    });
                                  });
                                </script>



                            <div class="form-group col-md-12 text-right"> 


                           <a href="customermaster.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a>

                              
                               <input type="submit" value="Update" name="submit" id="submit" class="btn btn-primary btn-rounded" />
                            </div>    
                         

                          </div>








                           
                         

                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /Row --> 







              <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default border-panel card-view">
              <div class="panel-wrapper collapse in">
                <div class="panel-body">



 <!-- BULK IMAGE UPLOAD CODE-->      

<?php $id = $_GET['edit_id']; ?>

<form action="bulkimageupload/customersubimgupload.php" method="post" enctype="multipart/form-data">
  
  <div class="form-group col-md-12">  
      <div class="seprator-block"></div>
      <h6 style="font-size: 20px;color: #2196F3;" class="flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-calendar-note mr-10"></i>Add Multiple IMAGES / PDF / EXCEL / PPT / WORDFILE Of Branch</h6>
      <hr class="light-grey-hr">
    </div>

    <div class="col-md-4 form-group">
        <input type="hidden" name="idd" value="<?php echo $id = $_GET['edit_id']; ?> ">
        <input type="file" name="files[]" class="form-control " multiple >       
    </div> 
    <div class="col-md-3 form-group">
     <input  class="btn btn-primary btn-rounded btn-lable-wrap left-label" type="submit"  name="submit" value="Add" />
    </div>

</form> 
<?php
//index.php
include "db.php";

$id = $_GET['edit_id'];

$query = "SELECT * FROM customerimages where idd = $id";
$result = mysqli_query($con, $query);
?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
   <?php
   if(mysqli_num_rows($result) > 0)
   {
   ?> 
   <div class="col-md-12">
   <?php 
    $count=0;

    while($row = mysqli_fetch_array($result))
    {
    $count++;
   ?>
     <div class="col-md-2 text-center" id="<?php echo $row["id"]; ?>" > 
      
      
      <?php  
        $a = explode(".", $row["file_name"]); 
        $a['1'];  

        if($a['1'] == 'jpg' || $a['1'] == 'png' || $a['1'] == 'jpeg' || $a['1'] == 'gif' || $a['1'] == 'JPEG' || $a['1'] == 'PNG')
        {
          echo   '<img width="100px" src="../media/customer/'.$row["file_name"].'"> <Br> IMAGE ';
        }
        else if ($a['1'] == 'pdf') {
          echo   '<a target="_blank" href="../media/customer/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-pdf-o txt-danger"> </i> </a><Br> PDF ';  
        } 
        else if ($a['1'] == 'docx') {
          echo   '<a target="_blank" href="../media/customer/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-word-o txt-primary"> </i> </a><Br> DOC ';  
        } 
        
        else if ($a['1'] == 'xls' ||  $a[1] == 'xlsx') {
          echo   '<a target="_blank" href="../media/customer/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-excel-o txt-success"> </i> </a><Br> EXCEL ';  
        } 
          else if ($a['1'] == 'pptx' || $a[1] == 'ppt') {
          echo   '<a target="_blank" href="../media/customer/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-powerpoint-o txt-info"> </i> </a><Br> PPT ';  
        } 


        else if ($a['1'] == 'mp4' || $a['1'] == 'avi' || $a['1'] == 'mov') {
          echo '<video width="170" height="auto" controls>
                <source src="../media/customer/'.$row["file_name"].'" type="video/mp4">
                </video> <Br> VIDEO';
        }
      ?>  


     

      
         <br>

          <div class="checkbox checkbox-danger">
             <input id="checkbox<?php echo $count; ?> "  class="delete_customer" value="<?php echo $row["id"]; ?>" type="checkbox"   name="id[]">
             <label for="checkbox<?php echo $count; ?> ">  </label>
          </div>   

           <span data="<?php echo $row['id'];?>" class="status_checks btn-sm label <?php echo ($row['status'])? 'label-success' : 'label-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></span> &nbsp;&nbsp; 


         <br>
         <br>
          
     </div> 
   <?php
    }
   ?> 


<!-- ACTIVE AND INACTIVE KA CODE -->

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).on('click','.status_checks',function(){
var status = ($(this).hasClass("label-success")) ? '0' : '1';
var msg = (status=='0')? 'Deactivate' : 'Activate';
if(confirm("Are you sure to "+ msg)){
  var current_element = $(this);
  url = "bulkimageupload/customerimagesactive.php";
  $.ajax({
  type:"POST",
  url: url,
  data: {id:$(current_element).attr('data'),status:status},
  success: function(data)
    {   
      location.reload();
    }
  });
  }      
});
</script>

     <!-- ACTIVE AND INACTIVE KA CODE --> 
    </div> 
   <div class="col-md-12">
   <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger btn-rounded">Delete</button>
  </div>
   

   
    <?php
   }
   else
   {
    echo '<div class="col-md-12 "> <B>No Images Found</b></div>';
   }
   ?>
       

    <script>
    $(document).ready(function(){
     
     $('#btn_delete').click(function(){
      
      if(confirm("Are you sure you want to delete this?"))
      {
       var id = [];
       
       $(':checkbox:checked').each(function(i){
        id[i] = $(this).val();
       });
       
       if(id.length === 0) //tell you if the array is empty
       {
        alert("Please Select atleast one checkbox");
       }
       else
       {
        $.ajax({
         url:'bulkimageupload/customersubimagedelete.php',
         method:'POST',
         data:{id:id},
         success:function()
         {
          for(var i=0; i<id.length; i++)
          {
           $('div#'+id[i]+'').css('background-color', '#ccc');
           $('div#'+id[i]+'').fadeOut('slow');
          }
         }
         
        });
       }
       
      }
      else
      {
       return false;
      }
     });
     
    });
    </script>


 <!-- BULK IMAGE UPLOAD CODE-->     




                </div>
              </div>
            </div>
          </div>
        </div>






      </div>
    </div>
    <!-- /Main Content -->
  </div>
  <!-- /#wrapper -->
  <?php include "allscript.php"; ?>

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
            <h5 class="txt-dark">Add Customer Master
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
                <span> Add Customer Master
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

                  <form id="example-advanced-form" action="customer_insert_sumit.php" method="post" enctype="multipart/form-data" > 

                            <?php
                            include "db.php";
                            $result = mysqli_query($con, "SELECT * FROM customer ORDER BY id DESC LIMIT 1");
                            while ($row = mysqli_fetch_array($result)) {
                                $id = $row['id'] + 1;
                            }
                            ?> 

                            <input  type="hidden" class="hiddentextbox" name="id" value="<?php echo $id ?>" >
                            
                           <?php
                            include "db.php";
                            $result = mysqli_query($con, "SELECT * FROM customer ORDER BY code DESC LIMIT 1");
                            while ($row = mysqli_fetch_array($result)) {
                                $abc = $row['code'] + 1;
                            }
                            ?> 

                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Customer Code  <b class="txt-danger">*</b>
                              </label> 
                              <input  type="text" name="code" value="<?php echo $abc ?>" readonly="" class="form-control"  placeholder="Enter Customer Code" >
                            </div>   

                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Customer Name <b class="txt-danger">*</b> 
                              </label>
                              <input autofocus="" type="text" name="customername" class="form-control"  placeholder="Enter Customer Name " >
                            </div>   

                           <div class="form-group col-md-4">   
                              <label  class="control-label mb-10">Upload Multiple IMAGES / PDF / EXCEL / PPT / WORDFILE Of Branch  <b class="txt-danger">*</b> </label>
                             <input class="fileinput btn-add form-control" type="file"  name="files[]" multiple > <span><b class="txt-danger">* Image size should be 974 x 648 in PNG and Less than 1 MB</b></span>
                           </div>
                  
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
                              <input type="text" name="oldcode" class="form-control"  placeholder="Enter Old Code" >
                            </div>   

                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Customer Name in Arabic 
                              </label>
                              <input type="text" name="customername_ar" class="form-control"  placeholder="Enter Customer Name " >
                            </div>   

                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Chq Print Name 
                              </label> 
                               <input type="text" name="chqprintname" class="form-control"  placeholder="Enter Chq Print Name " >
                            </div>
                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Account Head
                              </label>
                              <input type="text" name="accounthead"  class="form-control"  placeholder="Enter Account Head Number " >
                            </div>
 
                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Status
                              </label>

                               <select name="status" class="form-control select2"  tabindex="0">
                               <option  value="" >Select Status  </option>
                                 <option value="Active">Active
                                </option>  
                                <option value="Suspend">Suspend
                                </option>
                                <option value="Vacation">Vacation
                                </option>
                              </select>

                            </div> 

                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Quotation Period
                              </label>
                              <input type="number" name="quotationvalidity"  class="form-control"  placeholder="Enter Quotation Period" >
                            </div>


                             <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Select Customer Group</label>
                                        <select name="customergroup" class="form-control select2"  tabindex="0">
                                           <option value="">Select Customer Group  </option>
                                             <option value="DIRECT">Direct</option>  
                                      <option value="QUOTATION">Quotation</option>
                                        </select>
                                     </div> 

                                    <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Billing On</label>
                                       <select name="billingon" class="form-control select2"  tabindex="0">
                                         <option value="">Select Billing On  </option>
                                     <option value="CREDIT">Credit</option>  
                                      <option value="CASH">Cash</option>
                                      </select>
                                     </div> 


                                       <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Select Invoice Type</label>
                                       <select name="invoicetype" class="form-control select2"  tabindex="0">
                                         <option value="">Select Invoice Type  </option>
                                          <option value="WHOLESALE">Wholesale</option>  
                                        <option value="RETAIL">Retail</option>
                                        <option value="ANY">Any</option>
                                        </select>
                                     </div> 

                                    <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Select Sector</label>
                                        <select name="sector"  class="form-control select2"  tabindex="0">
                                           <option value="">Select Sector  </option>
                                        <?php
                                        include"db.php";
                                        $result = mysqli_query($con,"SELECT * FROM customer_sector");
                                        while($row = mysqli_fetch_array($result))
                                        {
                                        echo '<option value="'.$row['id'].'">' .$row['title'].'</option>';
                                        } 
                                        ?>
                                        </select>
                                     </div> 


                                     <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Select Category</label>
                                       <select name="category"  class="form-control select2"  tabindex="0">
                                        <option value="">Select Category  </option>
                                         <?php
                                        include"db.php";
                                        $result = mysqli_query($con,"SELECT * FROM customer_category");
                                        while($row = mysqli_fetch_array($result))
                                        {
                                        echo '<option value="'.$row['id'].'">' .$row['title'].'</option>';
                                        } 
                                        ?>
                                        </select>
                                     </div> 





                                   <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Select Invoice Price</label>
                                       <select name="invoiceprice" class="form-control select2"  tabindex="0">
                                         <option value="">Select Invoice Price  </option>
                                        <option value="WHOLESALE">Wholesale</option>  
                                        <option value="RETAIL">Retail</option>
                                        <option value="ANY">Any</option>
                                      </select>
                                     </div> 


                                    
                             <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Type 
                              </label>
                             <select name="type" class="form-control select2"  tabindex="0">
                               <option value="">Select Type of Customer  </option>
                            <option value="INTERNATIONAL CUSTOMER">Intl. Customer</option>  
                            <option value="LOCAL CUSTOMER">Local Customer</option>
                              </select>
                            </div>   
                            
                             <div class="form-group col-md-4">
                                         <label  class="control-label mb-10">Enter Area</label>
                                          <select name="area"  class="form-control select2"  tabindex="0">
                                             <option value="">Select Area  </option>
                                          <?php
                                          include"db.php";
                                          $result = mysqli_query($con,"SELECT * FROM customer_area");
                                          while($row = mysqli_fetch_array($result))
                                          {
                                          echo '<option value="'.$row['id'].'">' .$row['title'].'</option>';
                                          } 
                                          ?>
                                          </select>

                                     </div>        

                            <div class="form-group col-md-4">
                              <label  class="control-label mb-10">Location
                              </label>
                              <input type="text"  name="location " class="form-control"  placeholder="Enter Location" >
                            </div> 
                            <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Address
                              </label>
                              <textarea type="text"  name="address" class="form-control"  placeholder="Enter Address" ></textarea>                          
                            </div>

                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Credit Limit
                              </label>
                              <input type="text"  name="creditlimits" class="form-control"  placeholder="Enter Credit Limit" >
                            </div> 
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Credit Days 
                              </label>
                             <input type="number" name="creditdays"  class="form-control"  placeholder="Enter Credit Days  " >
                            </div>

                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Grace Limit
                              </label>
                              <input type="text"  name="gracelimit" class="form-control"  placeholder="Enter Grace Limit" >
                            </div> 
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Grace Days 
                              </label>
                             <input type="number" name="gracedays"  class="form-control"  placeholder="Enter Grace Days  " >                           
                            </div>

                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Telephone
                              </label>
                              <input type="text" name="ctelephone"  class="form-control"  placeholder="Enter Telephone  " >
                            </div>   
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Mobile 
                              </label>
                              <input type="text" name="cmobile"  class="form-control"  placeholder="Enter Mobile " >
                            </div> 
                            
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">FAX
                              </label>
                              <input type="text" name="fax"  class="form-control"  placeholder="Enter FAX" >
                            </div>
                            <div class="form-group col-md-3">
                              <label  class="control-label mb-10">Email
                              </label>
                              <input type="text" name="cemail"  class="form-control"  placeholder="Enter Email" >
                            </div>  

                             <div class="form-group col-md-12">
                                         <label  class="control-label mb-10">Select Multiple Branch Access</label>
                                         <select name="branchaccess"  class="form-control select2 select2-multiple"  multiple="multiple"  data-placeholder="Choose a Company" tabindex="0">
                                         
                                          <option value="">Select Multiple Branch Access  </option>
                                           <?php
                                          include"db.php";
                                          $result = mysqli_query($con,"SELECT * FROM branch");
                                          while($row = mysqli_fetch_array($result))
                                          {
                                          echo '<option value="'.$row['id'].'">' .$row['branchname_english'].'</option>';
                                          } 
                                          ?>
                                          </select>
                              </div>  
                                  
                          </div>
                      
                          <div  id="categorydetails" class="tab-pane fade mt-30" role="tabpanel">
                              <div class="col-md-12">
                                <div class="row">
                                  <table  id="customertelephonetable" width="100%">
                                  <tbody>   
                                      <tr id='customertelephone0'>
                                      <td> 
                          
                              <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Department
                              </label>
                              <input type="text" name="department[]" class="form-control"  placeholder=" Department" >
                            </div> 
                           

                        </td>
                        <td>
                          
                           <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Name
                              </label>
                              <input type="text" name="name[]" class="form-control"  placeholder=" Name" >
                            </div>                           
                        </td>
                       
                        <td style="width: 11%">
                      

                           <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Telephone
                              </label>
                              <input type="text" name="telephone[]" class="form-control"  placeholder=" Telephone" >
                            </div> 
                           
                        </td>

                        <td style="width: 11%">
                           
                          <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Mobile
                              </label>
                              <input type="text" name="mobile[]" class="form-control"  placeholder=" Mobile" >
                            </div> 
                          
                        </td> 


                        <td style="width: 11%">
                            <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Whats App
                              </label>
                              <input type="text" name="whatsapp[]" class="form-control"  placeholder=" WhatsApp" >
                            </div> 
                        </td> 

                        <td>
                             <div class="form-group col-md-12">
                              <label for="inputEmail" class="control-label mb-10">Email
                              </label>
                              <input type="email" name="email[]" class="form-control" id="inputEmail" placeholder=" Enter Email Id">   
                            </div>  
                        </td>


                       <td> 

                        <div class="form-group col-md-12">
                                               
                       <a style="margin-right: 10px;" id="customer_telephone_type_add"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a> 

                      <a  id='customer_telephone_type_delete' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a> 

                      </div>
                      </td>

                    </tr> 


                    <tr id='customertelephone1'></tr>  

                    <input type="hidden" name="customer_telephone_type" id="customer_telephone_type" value="1" /><!-- Count  -->

                </tbody>
            </table>
        
  

</div></div>



    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>


  <script type="text/javascript">
    $(document).ready(function(){
      var i=1;
     $("#customer_telephone_type_add").click(function(){
    
      $('#customertelephone'+i).html("   <td><div class='form-group col-md-12'>                                                       <input type='text' name='department[]' class='form-control' id='inputName' placeholder=' Department' >                            </div>                                                    </td>                        <td>                            <div class='form-group col-md-12'>                                                        <input type='text' name='name[]' class='form-control' id='inputName' placeholder=' Name' >                            </div>                                                    </td>                                                                                                                                                                      <td>     <div class='form-group col-md-12'>                                       <input type='text' class='form-control' name='telephone[]' id='inputName' placeholder=' Telephone' >                            </div>                                                        </td>                                                                                                                                                                                                                             <td><div class='form-group col-md-12'>                                                          <input type='text' class='form-control' id='inputName' name='mobile[]' placeholder=' Mobile' >                            </div>        </td>                        <td>                                                      <div class='form-group col-md-12'>                                                        <input type='text' class='form-control' name='whatsapp[]' id='inputName' placeholder=' WhatsApp' >                            </div>                                                  </td>                        <td>                             <div class='form-group col-md-12'>                                                      <input type='email' class='form-control' name='email' id='inputEmail' placeholder=' Enter Email Id'>                               </div>                          </td>");

      $('#customertelephonetable').append('<tr id="customertelephone'+(i+1)+'"></tr>');
      i++; 
      $('#customer_telephone_type').val(i);
  });
     $("#customer_telephone_type_delete").click(function(){
         if(i>1){
         $("#customertelephone"+(i-1)).html('');
         i--;
         $('#customer_telephone_type').val(i);
         }
     });


      
});

</script>
                          </div> 

                          <div  id="Customerdetails" class="tab-pane fade mt-30" role="tabpanel">
                            <div class="col-md-12">   
                              <div class="row">
                                <table  id="customerbanktable" width="100%">
                
                                <tbody>   
             
                                <tr id='customerbank0'>
                                   <td>
      
                           <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Bank Name
                              </label>
                              <input type="text" name="bankname[]" class="form-control"  placeholder="Enter Bank Name" >
                            </div>   

                        </td>
                        <td>
                          
                         <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Branch
                              </label>
                              <input type="text" name="bankbranch[]" class="form-control"  placeholder="Enter Bank Branch" >
                            </div>  
                          </td>
                       
                        <td>
                      
                        <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Account No
                              </label>
                              <input type="text" name="accountno[]" class="form-control"  placeholder="Enter Account No" >
                            </div>                         
                       </td>
                       <td>
                           <div class="form-group col-md-12">
                             <label  class="control-label mb-10">IBAN No / IFSC Code
                              </label>
                              <input type="text" name="ibanno[]" class="form-control"  placeholder="Enter IBAN No" >
                            </div>  

                        </td> 
                        <td>
                           <div class="form-group col-md-12">
                              <label  class="control-label mb-10">Country
                              </label>
                              <input type="text" name="country[]" class="form-control"  placeholder="Enter Country" >
                            </div> 

                        </td> 
                   
                       <td>  

                          <div class="form-group col-md-12">
                                                 
                         <a style="margin-right: 10px;" id="customer_bank_type_add"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a> 

                         <a  id='customer_bank_type_delete' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a> 


                          </div>
       
                      </td>


                        
                    </tr> 


                    <tr id='customerbank1'></tr>  

                   <!-- Barcode Count suppose to be hidden --> <input type="hidden" name="customer_bank_type" id="customer_bank_type" value="1" /><!-- Barcode Count  -->

                </tbody>
            </table>
        
  

</div></div>


    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>


  <script type="text/javascript">
    $(document).ready(function(){
      var i=1;
     $("#customer_bank_type_add").click(function(){
    
      $('#customerbank'+i).html("   <td>                                             <div class='form-group col-md-12'>                           <input type='text' name='bankname[]' class='form-control' id='inputName' placeholder='Enter Bank Name' >                            </div>                           </td>                           <td>                            <div class='form-group col-md-12'>                                                         <input type='text' name='bankbranch[]' class='form-control' id='inputName' placeholder='Enter Bank Branch' >                            </div>                                               </td>                                                                                                                                                                      <td>      <div class='form-group col-md-12'>                                                       <input type='text' name='accountno[]' class='form-control' id='inputName' placeholder='Enter Account No' >                            </div>                                                                   </td>                             <td>  <div class='form-group col-md-12'>                                                     <input type='text' name='ibanno[]' class='form-control' id='inputName' placeholder='Enter IBAN No' >                            </div>        </td>                                                                    <td>             <div class='form-group col-md-12'><input type='text' name='country[]' class='form-control' id='inputName' placeholder='Enter Country' >                            </div> </td> ");

      $('#customerbanktable').append('<tr id="customerbank'+(i+1)+'"></tr>');
      i++; 
      $('#customer_bank_type').val(i);
  });
     $("#customer_bank_type_delete").click(function(){
         if(i>1){
         $("#customerbank"+(i-1)).html('');
         i--;
         $('#customer_bank_type').val(i);
         }
     });


      
});

</script>



                          </div>











        

                             <div  id="branchinformation" class="tab-pane fade mt-30" role="tabpanel">
                            <div class="col-md-12">   
                              <div class="row">
                                <table  id="customeraddressinformation" width="100%">
                
                                <tbody>   
             
                                <tr id='customeraddress0'>

                                    <td>      
                                      <div class="form-group col-md-12">
                                        <label  class="control-label mb-10">branchname
                                        </label>
                                        <input type="text" name="branchname[]" class="form-control"  placeholder="Enter branchname" >
                                      </div>  
                                  </td>


                                   <td>      
                                      <div class="form-group col-md-12">
                                        <label  class="control-label mb-10">Contact Person
                                        </label>
                                        <input type="text" name="contactperson[]" class="form-control"  placeholder="Enter Contact Person" >
                                      </div>  
                                  </td>

                                   <td>      
                                      <div class="form-group col-md-12">
                                        <label  class="control-label mb-10">mobileno
                                        </label>
                                        <input type="text" name="mobileno[]" class="form-control"  placeholder="Enter mobileno" >
                                      </div>  
                                  </td>

                                   <td>      
                                      <div class="form-group col-md-12">
                                        <label  class="control-label mb-10">branchaddress
                                        </label>
                                        <input type="text" name="branchaddress[]" class="form-control"  placeholder="Enter branchaddress" >
                                      </div>  
                                  </td>

                                   <td>      
                                      <div class="form-group col-md-12">
                                        <label  class="control-label mb-10">latitude
                                        </label>
                                        <input type="text" name="latitude[]" class="form-control"  placeholder="Enter latitude" >
                                      </div>  
                                  </td>


                                   <td>      
                                      <div class="form-group col-md-12">
                                        <label  class="control-label mb-10">longitude
                                        </label>
                                        <input type="text" name="longitude[]" class="form-control"  placeholder="Enter longitude" >
                                      </div>  
                                  </td>

                                 



                       
                   
                                   <td>  
                                      <div class="form-group col-md-12">                                                             
                                         <a style="margin-right: 10px;" id="customer_address_type_add"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a> 
                                         <a  id='customer_address_type_delete' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a> 
                                      </div>                   
                                  </td>


                        
                    </tr> 


                    <tr id='customeraddress1'></tr>  

                   <!-- Barcode Count suppose to be hidden --> <input type="hidden" name="customer_addressinformation_type" id="customer_addressinformation_type" value="1" /><!-- Barcode Count  -->

                </tbody>
            </table>
        
  

</div></div>


    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>


  <script type="text/javascript">
    $(document).ready(function(){
      var i=1;
     $("#customer_address_type_add").click(function(){
    
      $('#customeraddress'+i).html("  <td><div class='form-group col-md-12'><input type='text' name='branchname[]' class='form-control'  placeholder='Enter branchname' ></div></td>        <td><div class='form-group col-md-12'><input type='text' name='contactperson[]' class='form-control'  placeholder='Enter contactperson' ></div></td>       <td><div class='form-group col-md-12'><input type='text' name='mobileno[]' class='form-control'  placeholder='Enter mobileno' ></div></td>    <td><div class='form-group col-md-12'><input type='text' name='branchaddress[]' class='form-control'  placeholder='Enter branchaddress' ></div></td>     <td><div class='form-group col-md-12'><input type='text' name='latitude[]' class='form-control'  placeholder='Enter latitude' ></div></td>     <td><div class='form-group col-md-12'><input type='text' name='longitude[]' class='form-control'  placeholder='Enter longitude' ></div></td>     ");

      $('#customeraddressinformation').append('<tr id="customeraddress'+(i+1)+'"></tr>');
      i++; 
      $('#customer_addressinformation_type').val(i);
  });
     $("#customer_address_type_delete").click(function(){
         if(i>1){
         $("#customeraddress"+(i-1)).html('');
         i--;
         $('#customer_addressinformation_type').val(i);
         }
     });


      
});

</script>


   <div class="form-group col-md-12 text-right"> 
                               
                           <a href="customermaster.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a> 

                               <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-primary btn-rounded" />
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
      </div>
    </div>
    <!-- /Main Content -->
  </div>
  <!-- /#wrapper -->
  <?php include "allscript.php"; ?>

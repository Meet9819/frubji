<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
</head>
<body>
  <div class="page-wrapper">
  <div class="container-fluid">
  <!-- Title -->
  <div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h5 class="txt-dark">Add Employee Master
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
          <a href="employeemaster.php">
          <span>Master
          </span>
          </a>
        </li>
        <li>
          <a href="employeemaster.php">
          <span>Employee Setup
          </span>
          </a>
        </li>
        <li class="active">
          <span> Add Employee Master
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
  <form id="example-advanced-form" action="employee_insert_sumit.php" method="post" enctype="multipart/form-data" >
  <?php 
    include "db.php";
    $result = mysqli_query($con, "SELECT * FROM employee ORDER BY id desc LIMIT 1");
       while ($row = mysqli_fetch_array($result)) {
       $id = $row['id'] + 1;
    }
    ?> 
  <input tabindex="-1" type="hidden"  name="id" class=" hiddentextbox"  value="<?php echo $id; ?>" readonly="">
  <div class="form-group col-md-1">   <label  class="control-label mb-10">Emp.Id
    </label> 
    <input type="text" class="form-control input-sm" placeholder="Enter Branch Request No." value="<?php echo $id; ?>" readonly="" />
  </div>
  <div class="form-group col-md-3">
    <label  class="control-label mb-10">Employee Code
    </label> 
    <input type="text" name="employeecode" class="form-control"  placeholder="Enter Employee Code" >
  </div>
  <div class="form-group col-md-3">
    <label  class="control-label mb-10">Employee Name 
    </label>
    <input type="text" name="employeename" class="form-control"  placeholder="Enter Employee Name " >
  </div>
  <div class="form-group col-md-1">
    <label  class="control-label mb-10">Gender
    </label>
    <select name="gender" class="form-control select2" data-placeholder="Choose a Gender" tabindex="0">
      <option value="Male">Male
      </option>
      <option value="Female">Female
      </option>
    </select>
  </div>
  <div class="form-group col-md-4">   
    <label  class="control-label mb-10">Add Multiple IMAGES / PDF / EXCEL / PPT / WORDFILE Of Employee </label>
    <input class="fileinput btn-add form-control" type="file"  name="files[]" multiple > <span><b class="txt-danger">* Image size should be 974 x 648 in PNG and Less than 1 MB</b></span>
  </div>


                  <div class="form-group col-md-12" style="padding: 5px"></div>
<div class="panel panel-default border-panel card-view">
<div  class="pills-struct ">
<ul role="tablist" class="nav nav-pills" id="myTabs_6">
  <li class="active " role="presentation" id="wi">
    <a aria-expanded="true" id="pad" data-toggle="tab" role="tab" id="home_tab_6" href="#personalinformation" >Personal Information
    </a>
  </li>
  <li role="presentation" class="" id="wi">
    <a  data-toggle="tab"  role="tab" href="#contactinformation" aria-expanded="false" id="pad"> Contact Information
    </a>
  </li>


  <li role="presentation" class="" id="wi">
    <a  data-toggle="tab"  role="tab" href="#jobinformation" aria-expanded="false"  id="pad">Job Information
    </a>
  </li>
  <li role="presentation" class="" id="wi">
    <a  data-toggle="tab"  role="tab" href="#empbankdetails" aria-expanded="false" id="pad">Employee Bank Details
    </a>
  </li>
</ul>
<div class="tab-content " id="myTabContent_6" >
<div  id="personalinformation" class="tab-pane fade active in  mt-30" role="tabpanel">




<div class="form-group col-md-3">
  <label  class="control-label mb-10">Choose User Group
  </label>
  <select name="u_rolecode" class="form-control select2 "  data-placeholder="Choose User Group" tabindex="0">
  <?php
    include"db.php";
    $result = mysqli_query($con,"SELECT * FROM role");
    while($row = mysqli_fetch_array($result))
    {
    echo '<option value="'.$row['role_rolecode'].'">' .$row['role_rolecode'].'</option>';
    } 
    ?> 
  </select>
</div>
<div class="form-group col-md-3">
  <label for="inputName" class="control-label mb-10">Username
  </label>
  <input type="text" name="username" class="form-control" id="inputName" placeholder="Enter Username" >
</div>
<div class="form-group col-md-3"> 
  <label  class="control-label mb-10">Password
  </label>
  <input type="text" name="password" class="form-control"  placeholder="Enter Password" >
</div>



<div class="form-group col-md-3">
  <label  class="control-label mb-10">Working In
  </label>
  <select name="workingin" class="form-control select2 select2-multiple"  multiple="multiple" data-placeholder="Choose Branch" tabindex="0">
    <option value="admin">ADMIN</option>
    <option value="admin , allbranch">ADMIN, ALL BRANCH </option>
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
<div class="form-group col-md-2">
  <label  class="control-label mb-10">Min Hours
  </label>
  <input name="minworkinghrs" type="text" class="form-control"  placeholder="Enter Min Working Hours " >
</div>



<div class="form-group col-md-2">
  <label  class="control-label mb-10">Blood Group 
  </label>
  <input type="text" name="bloodgroup"  class="form-control"  placeholder="Enter Blood Group  " >
</div>
<div class="form-group col-md-2">
  <label  class="control-label mb-10">Qualification 
  </label>
  <input type="text" name="qualification"  class="form-control"  placeholder="Enter Qualification " >
</div>

<div class="form-group col-md-2">
  <label  class="control-label mb-10">Date of Birth 
  </label> 
  <input type="date" name="dob" class="form-control"  placeholder="Enter Date of Birth  " >
</div>

<div class="form-group col-md-2">
  <label  class="control-label mb-10">Join Date 
  </label>
  <input name="joindate" type="date" class="form-control"  placeholder="Enter Join Date " >
</div>


<div class="form-group col-md-2">
  <label  class="control-label mb-10">Status
  </label>
  <select name="status" class="form-control select2" data-placeholder="Choose a  Status " tabindex="0">
    <option value="Active">Active
    </option>
    <option value="Suspend">Suspend
    </option>
    <option value="Vacation">Vacation
    </option>
  </select>
</div>
  

<div class="form-group">
  <div class="col-md-4">    
    <label  class="control-label mb-10">Profile Pic Upload</label>
  </div>
  <div class="col-md-12"> </div>
  <div class="col-md-4">
    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
      <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
      <span class="input-group-addon fileupload btn btn-default btn-anim btn-file"><i class="fa fa-upload"></i> <span class="fileinput-new btn-text">Select file</span> <span class="fileinput-exists btn-text">Change</span>
      <input type="file" name="image" id="file" required="">
      </span> <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash"></i><span class="btn-text"> Remove</span></a> 
    </div><span><b class="txt-danger">* Image size should be 480 x 480 and Less than 1 MB</b></span>
  </div>
</div>
</div>
<div  id="contactinformation" class="tab-pane fade mt-30" role="tabpanel">
<div class="col-md-12">
  <div class="row">
    <table  id="employeeaddresstable" width="100%">
      <tbody>
        <tr id='employeeaddress0'>
          <td>
            <div class="form-group col-md-12">
              <label  class="control-label mb-10">Type of Address 
              </label>
              <select name="typeofaddress[]" class="form-control " data-placeholder="Choose a Address Type"  tabindex="0">
                <option value="Warehouse Address">Warehouse Address
                </option>
                <option value="Office Address">Office Address
                </option>
                <option value="Other Address">Other Address
                </option>
              </select>
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <label  class="control-label mb-10">Address 
              </label>
              <input name="eaddress[]" type="text" class="form-control"  placeholder="Enter Address " >
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <label  class="control-label mb-10">Country
              </label>
              <input name="ecountry[]" type="text" class="form-control"  placeholder="Enter Country " >
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <a style="margin-right: 10px;" id="employee_address_type_add"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a> 
              <a  id='employee_address_type_delete' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a> 
            </div>
          </td>
        </tr>
        <tr id='employeeaddress1'></tr>
        <!-- Barcode Count suppose to be hidden --> <input type="hidden"  class="hiddentextbox" name="employee_address_type" id="employee_address_type" value="1" /><!-- Barcode Count  -->
      </tbody>
    </table>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script type="text/javascript">
  $(document).ready(function(){
    var i=1;
   $("#employee_address_type_add").click(function(){
  
    $('#employeeaddress'+i).html("<td>        <div  class='form-group col-md-12'>   <select name='typeofaddress[]' class='form-control select2' data-placeholder='Choose a Address Type' tabindex='1'>       <option value='Warehouse Address'>Warehouse Address   </option>    <option value='Office Address'>Office Address  </option>   <option value='Other Address'>Other Address    </option>   </select> </div>     </td>                                                                                                                                                                                                                                                                                                                                                                                                                                             <td>    <div  class='form-group col-md-12'>  <input name='eaddress[]' type='text' class='form-control' id='inputName' placeholder='Enter Address ' > </div>      </td>                                                                                                                                                                                                                             <td>  <div class='form-group col-md-12'>     <input name='ecountry[]' type='text' class='form-control' id='inputName' placeholder='Enter Country ' >   </div></td>");
  
    $('#employeeaddresstable').append('<tr id="employeeaddress'+(i+1)+'"></tr>');
    i++; 
    $('#employee_address_type').val(i);
  });
   $("#employee_address_type_delete").click(function(){
       if(i>1){
       $("#employeeaddress"+(i-1)).html('');
       i--;
       $('#employee_address_type').val(i);
       }
   });
  
  
    
  });
  
</script>
<div class="col-md-12">
  <div class="row">
    <table  id="employeetelephonetable" width="100%">
      <tbody>
        <tr id='employeetelephone0'>
          <td>
            <div class="form-group col-md-12">
              <label  class="control-label mb-10">Type of Mobile No 
              </label>
              <select  name="type[]" id="type" class="form-control" data-placeholder="Choose a Type" tabindex="0">
                <option value="Tel.">Tel.</option>
                <option value="FAX">FAX</option>
                <option value="Whatsapp">Whatsapp</option>
                <option value="Email">Email</option>
              </select>
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <label  class="control-label mb-10">Details
              </label>
              <input type="text" name="details[]" class="form-control"  placeholder=" Details" >
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <label  class="control-label mb-10">Display
              </label> 

              <select  name='display[]' id='display' class='form-control'  tabindex='1'>
                  <option value='YES'>YES</option>
                  <option value='NO'>NO</option>
              </select>
           
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <a style="margin-right: 10px;" id="employee_telephone_type_add"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a> 
              <a  id='employee_telephone_type_delete' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a> 
            </div>
          </td>
        </tr>
        <tr id='employeetelephone1'></tr>
        <input type="hidden" class="hiddentextbox" name="employee_telephone_type" id="employee_telephone_type" value="1" />
      </tbody>
    </table>
  </div>
</div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>


  <script type="text/javascript">
    $(document).ready(function(){
      var i=1;
     $("#employee_telephone_type_add").click(function(){
    
      $('#employeetelephone'+i).html("<td><div class='form-group col-md-12'><select  name='type[]' id='type' class='form-control' data-placeholder='Choose a Company' tabindex='1'> <option value='Tel.'>Tel.</option>   <option value='FAX'>FAX</option><option value='Whatsapp'>Whatsapp</option><option value='Email'>Email</option></select>   </div>  </td><td>     <div class='form-group col-md-12'><input type='text' class='form-control' name='details[]' id='inputName' placeholder=' Details' ></div></td><td><div class='form-group col-md-12'>  <select  name='display[]' id='display' class='form-control'  tabindex='1'> <option value='YES'>YES</option>   <option value='NO'>NO</option></select> </div>        </td>");

      $('#employeetelephonetable').append('<tr id="employeetelephone'+(i+1)+'"></tr>');
      i++; 
      $('#employee_telephone_type').val(i);
  });
     $("#employee_telephone_type_delete").click(function(){
         if(i>1){
         $("#employeetelephone"+(i-1)).html('');
         i--;
         $('#employee_telephone_type').val(i);
         }
     });


      
});

</script>


</div> 

<div  id="jobinformation" class="tab-pane fade mt-30" role="tabpanel">


<div class="form-group col-md-12">
  <div class="row">
    <table  id="employeesalarytable" width="100%">
      <tbody>
        <tr id='employeesalary0'>
          <td style="width: 20%">
            <div class="form-group col-md-12">
              <label  class="control-label mb-10">Start Date
              </label>
              <input type="date" name="startfrom[]" class="form-control"  placeholder="Start Date" >
            </div>
          </td>
          <td >
            <div class="form-group col-md-12">
              <label  class="control-label mb-10">Type
              </label> 
              <select name="stype[]" class="form-control select2" data-placeholder="Choose a Type" tabindex="0">
                <option selected="" value="" disabled="">Select Type  </option>
                <option value="BASIC">BASIC</option>
                <option value="HRA">HRA</option>
                <option value="TRANSPORT">TRANSPORT</option>
                <option value="OTHERS">OTHERS</option>
              </select>
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <label  class="control-label mb-10">Total
              </label>
              <input name="total[]" type="text" class="form-control"  placeholder="Total Cost" >
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <a style="margin-right: 10px;" id="employee_salary_type_add"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a> 
              <a  id='employee_salary_type_delete' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a> 
            </div>
          </td>
        </tr>
        <tr id='employeesalary1'></tr>
        <input type="hidden" class="hiddentextbox" name="employee_salary_type" id="employee_salary_type" value="1" />
      </tbody>
    </table>
  </div>
</div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script type="text/javascript">
  $(document).ready(function(){
    var i=1;
   $("#employee_salary_type_add").click(function(){
  
    $('#employeesalary'+i).html("       <td>                                                                                          <div class='form-group col-md-12'>                                 <input type='date' name='startfrom[]' class='form-control' id='inputName' placeholder='Start Date' >                            </div>                                                      </td>                                               <td>                           <div class='form-group col-md-12'>               <select name='stype[]' class='form-control select2' data-placeholder='Choose a Type' tabindex='1'><option selected=''0 value=' disabled='>Select Type  </option><option value='BASIC'>BASIC</option><option value='HRA'>HRA</option><option value='TRANSPORT'>TRANSPORT</option>     <option value='OTHERS'>OTHERS</option></select>                          </div>                                                   </td><td>   <div class='form-group col-md-12'>                                                    <input name='total[]' type='text' class='form-control' id='inputName' placeholder='Total Cost' >                            </div></td> ");
  
    $('#employeesalarytable').append('<tr id="employeesalary'+(i+1)+'"></tr>');
    i++; 
    $('#employee_salary_type').val(i);
  });
   $("#employee_salary_type_delete").click(function(){
       if(i>1){
       $("#employeesalary"+(i-1)).html('');
       i--;
       $('#employee_salary_type').val(i);
       }
   });
  
  
    
  });
  
</script>
<div class="form-group col-md-12"> 
</div>


</div>
<div  id="empbankdetails" class="tab-pane fade mt-30"   role="tabpanel">
  <div class="col-md-12">
    <div class="row">
      <table  id="employeebanktable" width="100%">
        <tbody>
          <tr id='employeebank0'>
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
                <a style="margin-right: 10px;" id="employee_bank_type_add"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a> 
                <a  id='employee_bank_type_delete' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a> 
              </div>
            </td>
          </tr>
          <tr id='employeebank1'></tr>
          <!-- Barcode Count suppose to be hidden --> <input type="hidden" class="hiddentextbox" name="employee_bank_type" id="employee_bank_type" value="1" /><!-- Barcode Count  -->
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script type="text/javascript">
    $(document).ready(function(){
      var i=1;
     $("#employee_bank_type_add").click(function(){
    
      $('#employeebank'+i).html("   <td>                                             <div class='form-group col-md-12'>                                                    <input type='text' name='bankname[]' class='form-control' id='inputName' placeholder='Enter Bank Name' >                            </div>                           </td>                           <td>                            <div class='form-group col-md-12'>                                               <input type='text' name='bankbranch[]' class='form-control' id='inputName' placeholder='Enter Bank Branch' >                            </div>                                               </td>                                                                                                                                                                      <td>      <div class='form-group col-md-12'>                                                 <input type='text' name='accountno[]' class='form-control' id='inputName' placeholder='Enter Account No' >                            </div>                                                                   </td>                             <td>  <div class='form-group col-md-12'>                                              <input type='text' name='ibanno[]' class='form-control' id='inputName' placeholder='Enter IBAN No' >                            </div>        </td>                                                                    <td>             <div class='form-group col-md-12'>                                              <input type='text' name='country[]' class='form-control' id='inputName' placeholder='Enter Country' >                            </div> </td> ");
    
      $('#employeebanktable').append('<tr id="employeebank'+(i+1)+'"></tr>');
      i++; 
      $('#employee_bank_type').val(i);
    });
     $("#employee_bank_type_delete").click(function(){
         if(i>1){
         $("#employeebank"+(i-1)).html('');
         i--;
         $('#employee_bank_type').val(i);
         }
     });
    
    
      
    });
    
  </script> 
  <div class="form-group col-md-12  text-right">  
    <a href="employeemaster.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a>
    <input type="submit" value="Submit" name="submit" id="submit" class="btn   btn-primary btn-rounded" />
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
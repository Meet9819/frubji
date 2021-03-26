

<?php
// $id = $_GET['edit_id'];

//new change
$id = empty($_GET['edit_id']) ? null : $_GET['edit_id'];

if (is_null($id) or empty($id)) {
    return;
}
?>
<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
</head>
<body>
  <!--Preloader-->
  <div class="preloader-it">
    <div class="la-anim-1">
    </div>
  </div>
  <!--/Preloader-->
  <div class="wrapper theme-2-active navbar-top-light">
  <!-- Main Content -->
  <div class="page-wrapper">
  <div class="container-fluid">
  <!-- Title -->
  <div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h5 class="txt-dark">Edit Employee Master
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
          <span> Edit Employee Master
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
  <?php
    include "db.php";
    $result = mysqli_query($con, "SELECT * FROM employee WHERE id=" . $_GET['edit_id']);
    $emp = mysqli_fetch_array($result);
    
    ?>
  <form id="example-advanced-form" action="employee_update.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" >
  <div class="form-group col-md-1"> <label  class="control-label mb-10">Emp.Id</label> 
    <input type="text" name="order_no" id="order_no" class="form-control input-sm" placeholder="Enter Branch Request No." value="<?php echo $emp['id']; ?>" readonly="" />
  </div>
  <div class="form-group col-md-3">
    <label for="inputName" class="control-label mb-10">Employee Code
    </label> 
    <input type="text" name="employeecode" class="form-control" id="inputName" placeholder="Enter Employee Code" value="<?php echo trim($emp['employeecode']) ?>" >
  </div>
  <div class="form-group col-md-6">
    <label for="inputName" class="control-label mb-10">Employee Name 
    </label>
    <input type="text" name="employeename" class="form-control" id="inputName" placeholder="Enter Employee Name " value="<?php echo trim($emp['employeename']) ?>" >
  </div>
  <div class="form-group col-md-2">
    <label for="inputName" class="control-label mb-10">Gender
    </label> 
    <select name="gender" class="form-control select2" data-placeholder="Choose a Gender" tabindex="0">
      <option value="<?php echo trim($emp['gender']) ?>"><?php echo trim($emp['gender']) ?></option>
      <option value="Male">Male
      </option>
      <option value="Female">Female
      </option>
    </select>
  </div>
  <div class="form-group col-md-12" style="padding: 5px"> </div>

            <div class="panel panel-default border-panel card-view">
<div  class="pills-struct ">
<!-- TABS -->
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
<!-- TABS -->
<!-- PERSONAL INFORMATION -->
<div class="tab-content " id="myTabContent_6" >
<div  id="personalinformation" class="tab-pane fade active in  mt-30" role="tabpanel">



<div class="form-group col-md-3">
  <label for="inputName" class="control-label mb-10">Choose User Group</label>                              
  <select name="u_rolecode" class="form-control select2 "  data-placeholder="Choose User Group" tabindex="0">
    <option value="<?php echo trim($emp['u_rolecode']) ?>"><?php echo trim($emp['u_rolecode']) ?></option>
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
  <label for="inputName" class="control-label mb-10">Username</label>
  <input type="text" name="username" class="form-control" id="inputName" placeholder="Enter Username" value="<?php echo trim($emp['username']) ?>">
</div>
<div class="form-group col-md-3">
  <label for="inputName" class="control-label mb-10">Password</label>
  <input type="text" name="password" class="form-control" id="inputName" placeholder="Enter Password" value="<?php echo trim($emp['password']) ?>">
</div>


<div class="form-group col-md-3">
  <label for="inputName" class="control-label mb-10">Working In
  </label>
  <select name="workingin" class="form-control select2" data-placeholder="Choose Branch" tabindex="0">
    <option  value="<?php echo trim($emp['workingin']) ?>"><?php echo trim($emp['workingin']) ?></option>
    <?php
      include"db.php";
      $result = mysqli_query($con,"SELECT * FROM branch");
      while($row = mysqli_fetch_array($result))
      {
      echo '<option value="'.$row['branchcode'].'">' .$row['branchname_english'].'</option>';
      } 
      ?> 
  </select>
</div>
<div class="form-group col-md-2">
  <label for="inputName" class="control-label mb-10">Min Hours</label>
  <input name="minworkinghrs" type="text" class="form-control" id="inputName" placeholder="Enter Min Working Hours " value="<?php echo trim($emp['minworkinghrs']) ?>">
</div>


<div class="form-group col-md-2">
  <label for="inputName" class="control-label mb-10">Blood Group 
  </label>
  <input type="text" name="bloodgroup"  class="form-control" id="inputName" placeholder="Enter Blood Group  "  value="<?php echo trim($emp['bloodgroup']) ?>">
</div>
<div class="form-group col-md-2">
  <label for="inputName" class="control-label mb-10">Qualification 
  </label>
  <input type="text" name="qualification"  class="form-control" id="inputName" placeholder="Enter Qualification "  value="<?php echo trim($emp['qualification']) ?>">
</div>

<div class="form-group col-md-2">
  <label for="inputName" class="control-label mb-10">Date of Birth</label> 
  <input type="date" name="dob" class="form-control" id="inputName" placeholder="Enter Date of Birth  " value="<?php echo trim($emp['dob']) ?>">
</div>


<div class="form-group col-md-2">
  <label for="inputName" class="control-label mb-10">Join Date 
  </label>
  <input name="joindate" type="date" class="form-control" id="inputName" placeholder="Enter Join Date "value="<?php echo trim($emp['joindate']) ?>" >
</div>
     

<div class="form-group col-md-2">
  <label for="inputName" class="control-label mb-10">Status</label>
  <select name="status" class="form-control select2" data-placeholder="Choose a  Status " tabindex="0">
    <option value="Active">Active</option>
    <option value="Suspend">Suspend</option>
    <option value="Vacation">Vacation</option>
  </select>
</div>

<div class="form-group">
  <div class="col-md-4">    
    <label for="" class="control-label mb-10">Profile Upload</label>
  </div>
  <div class="col-md-12"> </div>
  <div class="col-md-4">
    <img src="../media/employee/<?php echo trim($emp['img']) ?>" height="70" width="70" />
    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
      <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
      <span class="input-group-addon fileupload btn btn-default btn-anim btn-file"><i class="fa fa-upload"></i> <span class="fileinput-new btn-text">Update file</span> <span class="fileinput-exists btn-text">Change</span>
      <input type="file" name="user_image" id="file"  accept="image/*">
      </span> <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash"></i><span class="btn-text"> Remove</span></a> 
    </div> <span><b class="txt-danger">* Image size should be 480 x 480 and Less than 1 MB</b></span>
  </div>
</div>
</div>
<!-- PERSONAL INFORMATION -->
<!-- CONTACT INFORMATION -->
<div  id="contactinformation" class="tab-pane fade mt-30" role="tabpanel">
<div class="col-md-12">
  <div class="row">
    <table  id="employeeaddresstable" width="100%">
      <tbody>
        <tr>
          <td width="20%">
            <div class="col-md-12">
              <label class="control-label mb-10 ">Type Of Address</label> 
            </div>
          </td>
          <td width="70%">
            <div class="col-md-12">
              <label class="control-label mb-10">Address
              </label> 
            </div>
          </td>
          <td width="10%">
            <div class="col-md-12">
              <label class="control-label mb-10">Country
              </label> 
            </div>
          </td>
          <td>
            <a id='emp_address_type_add'  style='margin-top:-55px' class='btn btn-default btn-icon-anim btn-circle'><i  style='margin-top: 12px;'  class='fa fa-plus' aria-hidden='true'></i></a>
          </td>
        </tr>
        <?php
          include "db.php";
          $result = mysqli_query($con, "SELECT * FROM employee_address WHERE employeeid=" . $_GET['edit_id']);
          $totalAddr = mysqli_num_rows($result);
          $first_row = true;
          while ($dr_addr = mysqli_fetch_array($result)) {
          ?>
        <tr id='empsalary0'>
          <td width="20%">
            <!-- new change -->
            <input type="hidden" name="address_id[]" value="<?php echo $dr_addr['id']; ?>" />
            <div class="form-group col-md-12">
              <select  name="typeofaddress[]" id="typeofaddress" class="form-control" tabindex="0">
                <option value="<?php echo $dr_addr['typeofaddress'] ?>"><?php echo $dr_addr['typeofaddress'] ?></option>
                <option value="Warehouse ">Warehouse </option>
                <option value="Office">Office</option>
                <option value="Home">Home</option>
              </select>
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">                            
              <input name="eaddress[]" type="text" class="form-control"  value="<?php echo $dr_addr['eaddress'] ?>" >
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">                             
              <input name="ecountry[]" type="text" class="form-control"  value="<?php echo $dr_addr['ecountry'] ?>" >
            </div>
          </td>
          <td>
           
             <a style='margin-top:-55px' id='emp_address_type_delete' class='btn btn-danger btn-icon-anim btn-circle emp_address_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a>

          </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
    <input type="hidden" name="emp_address_type" id="emp_address_type" value="<?php echo $totalAddr; ?>" />
  </div>
  <hr class="light-grey-hr">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script type="text/javascript">
  $(document).ready(function()  {
    // new change
    $("#emp_address_type_add").click(function()  {
      let i = Number($("#emp_address_type").val());
  
      $("#employeeaddresstable tbody").append(`
        <tr id='empsalary${j=++i}'>
          <td>
           <div class='form-group col-md-12'>
               <select  name='typeofaddress[]' id='typeofaddress' class='form-control' tabindex='1'> <option value='Warehouse.'>Warehouse.</option>   <option value='Office'>Office</option><option value='Home'>Home</option></select>
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
              <input name='eaddress[]' type='text' class='form-control'  />
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
             <input name='ecountry[]' type='text' class='form-control'    />
            </div>
          </td>
          <td> <a style='margin-top:-55px' id='emp_address_type_delete' class='btn btn-danger btn-icon-anim btn-circle emp_address_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
         </td>
        </tr>`);
      $('#emp_address_type').val(++i);
    });
    $("#employeeaddresstable tbody").on('click', '.emp_address_type_delete', function() {
      let address_id = $(this).parent().parent().first().children().children().first().val();
  
      if (address_id) {
        $.ajax({
          url: window.location.origin + '/frubji/admin/superadmin/masterdelete/emp_address_delete.php?type=address&id=' + address_id,
          type: "GET",
          success: function(result) {
            window.alert("Employee Address Removed");
            window.setTimeout(function() {
              window.location.href = window.location.href + "#Employee Address Removed";
              window.location.reload(true);
            }, 0);
          }
        });
      } else {
        $(this).parent().parent().remove();
        let i = Number($("#emp_address_type").val());
        $('#emp_address_type').val(--i);
      }
    });
  });
</script>














                                     <div class="col-md-12">
  <div class="row">
    <table  id="employeetelephonetable" width="100%">
      <tbody>
        <tr>
          <td>
            <div class="col-md-12">
              <label class="control-label mb-10">Type</label>
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label class="control-label mb-10">Details</label> 
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label class="control-label mb-10">Display </label>
            </div>
          </td>
          <td>
              <a id='emp_telephone_type_add'  style='margin-top:-55px' class='btn btn-default btn-icon-anim btn-circle'><i  style='margin-top: 12px;'  class='fa fa-plus' aria-hidden='true'></i></a>
          </td>
        </tr>
        <?php
          include "db.php";
          $result = mysqli_query($con, "SELECT * FROM employee_telephone WHERE employeeid=" . $_GET['edit_id']);
          $totalAddr = mysqli_num_rows($result);
          $first_row = true;
          while ($dr_addr = mysqli_fetch_array($result)) {
              ?>
        <tr id='emptelephone0'>
          <td>
            <!-- new change -->
            <input type="hidden" name="telephone_id[]" value="<?php echo $dr_addr['id']; ?>" />
            <div class="form-group col-md-12">
              <select  name="type[]" id="type" class="form-control" tabindex="0">
                <option value="<?php echo $dr_addr['type'] ?>"><?php echo $dr_addr['type'] ?></option>
                <option value="Tel.">Tel.</option>
                <option value="FAX">FAX</option>
                <option value="Whatsapp">Whatsapp</option>
                <option value="Email">Email</option>
              </select>
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">                            
              <input name="details[]" type="text" class="form-control" value="<?php echo $dr_addr['details'] ?>" >
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">  


             <select  name="display[]" id="display" class="form-control" data-placeholder="Choose a Display" tabindex="0">
                <option value="<?php echo $dr_addr['display'] ?>"><?php echo $dr_addr['display'] ?></option>
                <option value="YES">YES</option>
                <option value="NO">NO</option>
              </select>      

            
            </div>
          </td>
          <td>
           
             <a style='margin-top:-55px' id='emp_telephone_type_delete' class='btn btn-danger btn-icon-anim btn-circle emp_telephone_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a>  
          </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
    <input type="hidden" name="emp_telephone_type" id="emp_telephone_type" value="<?php echo $totalAddr; ?>" />
  </div>
  <hr class="light-grey-hr">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script type="text/javascript">
  $(document).ready(function()  {
    // new change
    $("#emp_telephone_type_add").click(function()  {
      let i = Number($("#emp_telephone_type").val());
  
      $("#employeetelephonetable tbody").append(`
        <tr id='emptelephone${j=++i}'>
          <td>
           <div class='form-group col-md-12'>
               <select  name='type[]' id='type' class='form-control' tabindex='1'> <option value='Tel.'>Tel.</option>   <option value='FAX'>FAX</option><option value='Whatsapp'>Whatsapp</option><option value='Email'>Email</option></select>
  
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
              <input name='details[]' type='text' class='form-control' />
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
              <select  name='display[]' id='display' class='form-control'  tabindex='1'> <option value='YES'>YES</option>   <option value='NO'>NO</option></select>
            </div>
          </td>
          <td> <a style='margin-top:-55px' id='emp_telephone_type_delete' class='btn btn-danger btn-icon-anim btn-circle emp_telephone_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
         </td>
        </tr>`);
      $('#emp_telephone_type').val(++i);
    });
    $("#employeetelephonetable tbody").on('click', '.emp_telephone_type_delete', function() {
      let telephone_id = $(this).parent().parent().first().children().children().first().val();
  
      if (telephone_id) {
        $.ajax({
          url: window.location.origin + '/frubji/admin/superadmin/masterdelete/emp_telephone_delete.php?type=bank&id=' + telephone_id,
          type: "GET",
          success: function(result) {
            window.alert("Contact Details of Employee Removed");
            window.setTimeout(function() {
             
              window.location.reload(true);
            }, 0);
          }
        });
      } 
      else {
        $(this).parent().parent().remove();
        let i = Number($("#emp_telephone_type").val());
        $('#emp_telephone_type').val(--i);
      }
    });
  });
</script>
</div> 
<!-- CONTACT INFORMATION -->


<!-- JOB INFORMATION -->
<div  id="jobinformation" class="tab-pane fade mt-30" role="tabpanel">



<div class="form-group col-md-12">
  <div class="row">
    <table  id="empsalarytable" width="100%">
      <tbody>
        <tr>
          <td width="20%">
            <div class="col-md-12">
              <label class="control-label mb-10">Start Date
              </label> 
            </div>
          </td>
          <td width="30%">
            <div class="col-md-12">
              <label class="control-label mb-10">Type
              </label> 
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label class="control-label mb-10">Total
              </label> 
            </div>
          </td>
          <TD>
            <a id='emp_salary_add'  style='margin-top:-55px' class='btn btn-default btn-icon-anim btn-circle'><i  style='margin-top: 12px;'  class='fa fa-plus' aria-hidden='true'></i></a> 
          </TD>
        </tr>
        <?php
          include "db.php";
          $result = mysqli_query($con, "SELECT * FROM employee_salary WHERE employeeid=" . $_GET['edit_id']);
          $totalAddr = mysqli_num_rows($result);
          $first_row = true;
          while ($empsalary = mysqli_fetch_array($result)) {
              ?>
        <tr id='empsalary0'>
          <td>
            <!-- new change -->
            <input type="hidden" name="salary_id[]" value="<?php echo $empsalary['id']; ?>" />
            <div class="form-group col-md-12">
              <input name="startfrom[]" type="date" class="form-control"  value="<?php echo $empsalary['startfrom'] ?>" >       
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <select  name="stype[]" id="stype" class="form-control" tabindex="0">
                <option value="<?php echo $empsalary['stype'] ?>"><?php echo $empsalary['stype'] ?></option>
                <option value="BASIC">BASIC</option>
                <option value="HRA">HRA</option>
                <option value="TRANSPORT">TRANSPORT</option>
                <option value="OTHERS">OTHERS</option>
              </select>
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <input name="total[]" type="text" class="form-control"   value="<?php echo $empsalary['total'] ?>" >
            </div>
          </td>
          <td>
           
             <a style='margin-top:-55px' id='emp_salary_delete' class='btn btn-danger btn-icon-anim btn-circle emp_salary_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a>
          </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
    <input type="hidden" name="emp_salary" id="emp_salary" value="<?php echo $totalAddr; ?>" />
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script type="text/javascript">
  $(document).ready(function()  {
    // new change
    $("#emp_salary_add").click(function()  {
      let i = Number($("#emp_salary").val());
  
      $("#empsalarytable tbody").append(`
        <tr id='empsalary${j=++i}'>
          <td>
           <div class='form-group col-md-12'>
              <input name='startfrom[]' type='date' class='form-control'/>
  
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
              <select  name='stype[]' id='stype' class='form-control' tabindex='1'> <option value='BASIC.'>BASIC.</option>   <option value='OTHERS'>OTHERS</option><option value='TRANSPORT'>TRANSPORT</option><option value='HRA'>HRA</option></select>
             
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
             <input name='total[]' type='text' class='form-control'    />
            </div>
          </td>
          <td> <a style='margin-top:-55px' id='emp_salary_delete' class='btn btn-danger btn-icon-anim btn-circle emp_salary_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
         </td>
        </tr>`);
      $('#emp_salary').val(++i);
    });
    $("#empsalarytable tbody").on('click', '.emp_salary_delete', function() {
      let salary_id = $(this).parent().parent().first().children().children().first().val();
  
      if (salary_id) {
        $.ajax({
          url: window.location.origin + '/frubji/admin/superadmin/masterdelete/emp_salary_delete.php?type=salary&id=' + salary_id,
          type: "GET",
          success: function(result) {
            window.alert("Salary Removed");
            window.setTimeout(function() {
           
              window.location.reload(true);
            }, 0);
          }
        });
      } else {
        $(this).parent().parent().remove();
        let i = Number($("#emp_salary").val());
        $('#emp_salary').val(--i);
      }
    });
  });
</script>

</div>
<!-- JOB INFORMATION -->
<!-- BANK DETAILS -->
<div  id="empbankdetails" class="tab-pane fade mt-30"   role="tabpanel">
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
            </td>
            <td width="30%">
              <div class="col-md-12">
                <label class="control-label mb-10">IBAN No / IFSC Code
                </label> 
              </div>
            </td>
            <td width="10%">
              <div class="col-md-12">
                <label class="control-label mb-10">Country
                </label> 
              </div>
            </td>
            <td>
              <a id='emp_bank_type_add'  style='margin-top:-55px' class='btn btn-default btn-icon-anim btn-circle'><i  style='margin-top: 12px;'  class='fa fa-plus' aria-hidden='true'></i></a>
            </td>
          </tr>
          <?php
            include "db.php";
            $result = mysqli_query($con, "SELECT * FROM employee_bank WHERE employeeid=" . $_GET['edit_id']);
            $totalAddr = mysqli_num_rows($result);
            $first_row = true;
            while ($emp_bank = mysqli_fetch_array($result)) {
            ?>
          <tr id='empbank0'>
            <td>
              <!-- new change -->
              <input type="hidden" name="employee_bank_id[]" value="<?php echo $emp_bank['id']; ?>" />
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
            </td>
            <td>
              <div class="form-group col-md-12">
                <input name="ibanno[]" type="text" class="form-control"   value="<?php echo $emp_bank['ibanno'] ?>" >
              </div>
            </td>
            <td>
              <div class="form-group col-md-12">
                <input name="country[]" type="text" class="form-control"   value="<?php echo $emp_bank['country'] ?>" >
              </div>
            </td>
            <td>
            
             <a style='margin-top:-55px' id='emp_bank_type_delete' class='btn btn-danger btn-icon-anim btn-circle emp_bank_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a>
            </td>
          </tr>
          <?php }?>
        </tbody>
      </table>
      <input type="hidden" name="emp_bank_type" id="emp_bank_type" value="<?php echo $totalAddr; ?>" />
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function()  {
      // new change
      $("#emp_bank_type_add").click(function()  {
        let i = Number($("#emp_bank_type").val());
    
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
            <td> <a style='margin-top:-55px' id='emp_bank_type_delete' class='btn btn-danger btn-icon-anim btn-circle emp_bank_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
           </td>
          </tr>`);
        $('#emp_bank_type').val(++i);
      });
      $("#employeebanktable tbody").on('click', '.emp_bank_type_delete', function() {
        let employee_bank_id = $(this).parent().parent().first().children().children().first().val();
    
        if (employee_bank_id) {
          $.ajax({
            url: window.location.origin + '/frubji/admin/superadmin/masterdelete/emp_bank_delete.php?type=bank&id=' + employee_bank_id,
            type: "GET",
            success: function(result) {
              window.alert("Bank Details of Employee Removed");
              window.setTimeout(function() {
              
                window.location.reload(true);
              }, 0);
            }
          });
        } else {
          $(this).parent().parent().remove();
          let i = Number($("#emp_bank_type").val());
          $('#emp_bank_type').val(--i);
        }
      });
    });
  </script>
</div>
<!-- BANK DETAILS -->
<div class="form-group col-md-12  text-right">
  <a href="employeemaster.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a>  
  <input type="submit" value="Update" name="submit" id="submit" class="btn   btn-primary btn-rounded" />
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
          <form action="bulkimageupload/employeesubimgupload.php" method="post" enctype="multipart/form-data">
              <div class="form-group col-md-12">  
                <div class="seprator-block"></div>
                <h6 style="font-size: 20px;color: #2196F3;" class="flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-calendar-note mr-10"></i>Add Multiple IMAGES / PDF / EXCEL / PPT / WORDFILE Of Employee</h6>
                <hr class="light-grey-hr">
              </div>
            <div class="col-md-4 form-group">
              <input type="hidden" name="idd" value="<?php echo $id = $_GET['edit_id']; ?> ">
              <input type="file" name="files[]" class="form-control " multiple >       <span><b class="txt-danger">* Image size should be 974 x 648 in PNG and Less than 1 MB</b></span>
 
            </div>
            <div class="col-md-3 form-group">
              <input  class="btn btn-primary btn-rounded btn-lable-wrap left-label" type="submit"  name="submit" value="Add" />
            </div>
          </form>
          <?php
            //index.php
            include "db.php";
            
            $id = $_GET['edit_id'];
            
            $query = "SELECT * FROM employeeimages where idd = $id";
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
                  echo   '<img width="100px" src="../media/employee/'.$row["file_name"].'"> <Br> IMAGE ';
                }
                else if ($a['1'] == 'pdf') {
                  echo   '<a target="_blank" href="../media/employee/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-pdf-o txt-danger"> </i> </a><Br> PDF ';  
                } 
                else if ($a['1'] == 'docx') {
                  echo   '<a target="_blank" href="../media/employee/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-word-o txt-primary"> </i> </a><Br> DOC ';  
                } 
                
                else if ($a['1'] == 'xls' ||  $a[1] == 'xlsx') {
                  echo   '<a target="_blank" href="../media/employee/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-excel-o txt-success"> </i> </a><Br> EXCEL ';  
                } 
                  else if ($a['1'] == 'pptx' || $a[1] == 'ppt') {
                  echo   '<a target="_blank" href="../media/employee/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-powerpoint-o txt-info"> </i> </a><Br> PPT ';  
                } 
                
                
                else if ($a['1'] == 'mp4' || $a['1'] == 'avi' || $a['1'] == 'mov') {
                  echo '<video width="170" height="auto" controls>
                        <source src="../media/employee/'.$row["file_name"].'" type="video/mp4">
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
                url = "bulkimageupload/employeeimagesactive.php";
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
                 url:'bulkimageupload/employeesubimagedelete.php',
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
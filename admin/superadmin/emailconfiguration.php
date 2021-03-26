
<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

                        <!-- ROLE BASED -->
                         <?php
                        require_once "config.php";
                        if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
                            // not logged in send to login page
                            redirect("index.php");
                        }
                        $status = false;
                        if (authorize($_SESSION["access"]["ECOMMERCE"]["EMAILCONFIGURATION"]["create"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["EMAILCONFIGURATION"]["edit"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["EMAILCONFIGURATION"]["view"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["EMAILCONFIGURATION"]["delete"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["EMAILCONFIGURATION"]["approval"])) {
                            $status = true;
                        }

                        if ($status === false) {
                            die("You dont have the permission to access this page");
                        }

                        ?>
                        <!-- ROLE BASED -->


        <!-- Main Content -->
        <div class="page-wrapper"> 
          <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
              <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Ecommerce Email Configuration</h5>
              </div>
              <!-- Breadcrumb -->
              <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                  <li>
                    <a href="index.php">Dashboard</a>
                  </li>
                  <li>
                    <a href="ecommerceusers.php"><span>Ecommerce 
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="ecommercestock.php">
                      <span>Main Pages
                      </span>
                    </a>
                  </li>
                  <li class="active">
                    <span> Ecommerce Email Configuration
                    </span>
                  </li>
                </ol>
              </div>
              <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->  

  
            <div class="panel panel-default border-panel card-view">
              <div class="panel-wrapper collapse in">
                <div class="panel-body"> 


               <div class="table-responsive">
              
                <div id="alert_message"></div>
                <table id="user_data" class="table table-bordered table-striped">
                 <thead>
                  <tr>
                   <th >Type</th>
                   <th>Subject</th>
                   <th>Email</th>
                   <th>Password</th> 
                  </tr>
                 </thead>
                </table>
               </div>
 
                <script type="text/javascript" language="javascript" >
               $(document).ready(function(){
                
                fetch_data();

                function fetch_data()
                {
                 var dataTable = $('#user_data').DataTable({
                  "processing" : true,
                  "serverSide" : true,
                  "order" : [],
                  "ajax" : {
                   url:"newinsert/emailfetchh.php",
                   type:"POST"
                  }
                 });
                }
                
                function update_data(id, column_name, value)
                {
                 $.ajax({
                  url:"newinsert/emailupdatee.php",
                  method:"POST",
                  data:{id:id, column_name:column_name, value:value},
                  success:function(data)
                  {
                   $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                   $('#user_data').DataTable().destroy();
                   fetch_data();
                  }
                 });
                 setInterval(function(){
                  $('#alert_message').html('');
                 }, 5000);
                }

                $(document).on('blur', '.update', function(){
                 var id = $(this).data("id");
                 var column_name = $(this).data("column");
                 var value = $(this).text();
                 update_data(id, column_name, value);
                });
                
                $('#add').click(function(){
                 var html = '<tr>';
                 html += '<td contenteditable id="data1"></td>';
                 html += '<td contenteditable id="data2"></td>';
                 html += '<td contenteditable id="data3"></td>';
                 html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
                 html += '</tr>';
                 $('#user_data tbody').prepend(html);
                });
                
                $(document).on('click', '#insert', function(){
                 var name = $('#data1').text();
                 var price = $('#data2').text();
                 var oldprice = $('#data3').text();
                 if(name != '' && price != '')
                 {
                  $.ajax({
                   url:"newinsert/insert.php",
                   method:"POST",
                   data:{name:name, price:price, oldprice:oldprice},
                   success:function(data)
                   {
                    $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                   }
                  });
                  setInterval(function(){
                   $('#alert_message').html('');
                  }, 5000);
                 }
                 else
                 {
                  alert("Both Fields is required");
                 }
                });
                
                $(document).on('click', '.delete', function(){
                 var id = $(this).attr("id");
                 if(confirm("Are you sure you want to remove this?"))
                 {
                  $.ajax({
                   url:"newinsert/delete.php",
                   method:"POST",
                   data:{id:id},
                   success:function(data){
                    $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                   }
                  });
                  setInterval(function(){
                   $('#alert_message').html('');
                  }, 5000);
                 }
                });
               });
              </script>


                 
                  </div>
                </div>
              </div>
         


          <?php include "footer.php"; ?>
        </div>
      </div>
      <!-- /Main Content --> 

      <?php include "allscript.php"; ?>




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
            <h5 class="txt-dark">Edit Static Page 
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
                <a href="staticpages.php">
                  <span>Ecommerce
                  </span>
                </a>
              </li>
              <li>
                <a href="staticpages.php">
                  <span>Static Page Setup
                  </span>
                </a>
              </li>
              <li class="active">
                <span> Edit Static Page 
                </span>
              </li>
            </ol>
          </div>
          <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->  
        <!-- Row --> 

  
            <div class="panel panel-default border-panel card-view">
              <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  
                <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
                
                <?php
                include "db.php";

                if (isset($_POST["submit"])) { 


                    $id = $_POST['id'];  
                    $title=$_POST['title'];
                    $content=$_POST['content'];

                    $update = "UPDATE e_staticpages SET   `title`=\"" . trim($title) . "\", `content`=\"" . trim($content) . "\" WHERE `id`=" . $id . ";";
                    $query = mysqli_query($con, $update) or die(mysqli_error($con)); 
                   
                    ?>
                 <script>
                    alert('Successfully Updated');
                   window.location.href='staticpages.php';
                  </script>

                <?php
                }

                ?>
                 <form action=""  method="post" enctype="multipart/form-data"  id="example-advanced-form">  
                               <div class="row">
                                
                                    <div class="col-md-12"> 

                                      
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-wrap">
                                                      <?php 
                                                      include "db.php";
                                                      $result = mysqli_query($con, "SELECT * FROM e_staticpages WHERE id=" . $_GET['q']);
                                                      $staticpages = mysqli_fetch_array($result);
                                                      ?>  

                                                      <input type="text" name="id" value="<?php echo trim($staticpages['id']) ?>">


                                                              <div class="form-group col-md-12">
                                                                    <label for="title" class="control-label mb-10">Title</label>
                                                                    <input autofocus="" type="text" name="title" class="form-control" id="title" placeholder="Enter Name  in English" required value="<?php echo trim($staticpages['title']) ?>" tabindex="0">
                                                                </div>  

                                                              <div class="form-group col-md-12">
                                                                    <label for="title" class="control-label mb-10">Content</label>
                                                                   <textarea name="content" id="content" class="form-control"><?php echo trim($staticpages['content']) ?></textarea>
                                                                      <script>
                                                                             CKEDITOR.replace('content');        
                                                                      </script>
                                                                </div>  

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                          

                        </div>
                       <div class="form-group col-md-12 text-right ">   

                            <a href="staticpages.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a>
                            
                           <input type="submit" value="Update" name="submit" id="submit" class="btn btn-primary  btn-rounded" />
                       </div>    

                     </form> 
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

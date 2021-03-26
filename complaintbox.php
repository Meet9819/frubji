<?php error_reporting(0);
define(SERVER_ROOT, __DIR__);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> 
    <!-- LOGIN --> 

    <?php include "allcss.php"; ?>
<?php include "header.php"; ?>
<body class="page-template page-template-template page-template-template-full-width page-template-templatetemplate-full-width-php page page-id-7  theme-marketo woocommerce-account woocommerce-page woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default elementor-kit-2663 elementor-page elementor-page-7" data-spy="scroll" data-target="#header">
  <div class="xs-breadcumb">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Complain Box</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="page" role="main">
    <div class="builder-content xs-transparent">
      <!-- full-width-content -->
      <div id="post-7" class="full-width-content post-7 page type-page status-publish hentry">
        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7 elementor-bc-flex-widget" data-elementor-settings="[]">
          <div class="elementor-inner">
            <div class="elementor-section-wrap">
              <section class="elementor-element elementor-element-4601733 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="4601733" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                  <div class="elementor-row">
                    <div class="elementor-element elementor-element-46a8d5a elementor-column elementor-col-100 elementor-top-column" data-id="46a8d5a" data-element_type="column">
                      <div class="elementor-column-wrap  elementor-element-populated">
                        <div class="elementor-widget-wrap">
                          <div class="elementor-element elementor-element-0aa7991 elementor-widget elementor-widget-shortcode" data-id="0aa7991" data-element_type="widget" data-widget_type="shortcode.default">
                            <div class="elementor-widget-container">
                              <div class="elementor-shortcode">
                                <div class="woocommerce">
                                  <div class="woocommerce-notices-wrapper"></div>
                                  <div class="u-columns col2-set" id="customer_login">
                                    <div class="u-column1 col-1">
                                      <h2>Complaint Box - Raise a Ticket </h2>  

                                      

<?php
include('db.php');
if (!isset($_FILES['image']['tmp_name'])) {
    echo "";
    }else{
    $file=$_FILES['image']['tmp_name'];
    
   
    $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image_name= addslashes($_FILES['image']['name']);

            move_uploaded_file($_FILES["image"]["tmp_name"],"media/complaintbox/" . $_FILES["image"]["name"]);

            $img="" . $_FILES["image"]["name"];
    
        $customerid = $_POST['customerid'];
        $branch = $_POST['branch'];
        $topic = $_POST['topic'];
        

        $invoiceno = $_POST['invoiceno'];
       
        $message = $_POST['message'];
        
        
            $save=mysqli_query($con,"INSERT INTO complaintbox (img,customerid,message,topic,branch,invoiceno) VALUES 
              ('$img','$customerid','$message','$topic','$branch','$invoiceno')");
          


           ?>
                <script>
                alert('Your Complaint Has been Noted...!! Will Get Back to You ');
               window.location.href='complaintbox.php';
                </script>
                <?php

                             
    }
?>
  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" class="woocommerce-form woocommerce-form-login login" >

                                         
                                                                                        
                                                 <div class="row">
                                                     
                                                     <div class="col-md-12"> 
                                                          <input type="hidden" name="customerid" id="customerid" value="<?php echo $userID; ?>"  />
                                                          
                                                          <label for="username">Name&nbsp;<span class="required">*</span></label> 
                                                          <div class="form-item"> 
                                                          <input type="text"  value="<?php echo $userName; ?>" size="40" class="woocommerce-Input woocommerce-Input--text input-text" aria-required="true" aria-invalid="false" placeholder="First Name" /><br>
                                                        </div>
                                                       
                                                     </div> 

                                                        <div class="col-md-12"> 
                                                       <label for="Upload">Branch  &nbsp;<span class="required">*</span></label> 
                                                        <div class="form-item"> 
                                                         <select  name="branch" class="woocommerce-Input woocommerce-Input--text input-text" data-placeholder="Choose a Branch " tabindex="0">
                                                        <?php
                                                            
                                                            $result = mysqli_query($con,"SELECT *  FROM branch");
                                                            while($row = mysqli_fetch_array($result))
                                                            {
                                                            echo '<option value="'.$row['id'].'">' .$row['branchname_english'].'</option>';
                                                            } 
                                                            ?>
                                                          </select><br></div>
                                                    </div>



                                                       <div class="col-md-12"> 
                                                       <label for="Upload">Type of Complaint &nbsp;<span class="required">*</span></label> 
                                                    
                                                         <div class="form-item"> 
                                                          <select  class="woocommerce-Input woocommerce-Input--text input-text" name="topic" required="">
                                                            <option value="Replacement">Replacement</option>
                                                            <option value="Other">Other</option>
                                                          </select><br>
                                                        </div>

                                                    </div>  


                                                      <div class="col-md-12"> 
                                                       <label for="">Invoice No&nbsp;</label> 
                                                    
                                                         <div class="form-item"> 
                                                          <input type="text" id="" name="invoiceno" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Enter Your Invoice No"><br>
                                                      
                                                        </div>

                                                    </div> 


                                                       <div class="col-md-12"> 
                                                       <label for="Upload">Upload Photo&nbsp;<span class="required">*</span></label> 
                                                    
                                                         <div class="form-item"> 
                                                          <input class="woocommerce-Input woocommerce-Input--text input-text" type="file" id="" name="image" >
                                                      <br><br>
                                                        </div>

                                                    </div> 


                                                   <div class="col-md-12">
                                                      <label for="">Message&nbsp;<span class="required">*</span></label>
                                                       <div class="form-item"><span class="wpcf7-form-control-wrap your-message"><textarea style="height: 80px" name="message" id="message" cols="40" rows="50" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message"></textarea></span></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                       <div class="form-submit">  

                                                   
                                                        <input type="submit" name="Submit" id="Submit" class="btn btn-success" value="File Complaint" class="woocommerce-button button woocommerce-form-login__submit"/>


                                                       
                                                       </div>
                                                       </p>
                                                    </div>
                                                    </div>
                                                    
                                                </form>
                                                              
                                    </div>

                                      <div class="u-column1 col-1">
                                           <img  style="margin-left: 43px;" src="media/login.JPEG">
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
              </section>
            </div>
          </div>
        </div>
      </div>
      <!-- end full-width-content -->
    </div>
    <!-- end main-content -->
  </div>
  <!-- end main-content -->
 
  <?php include "footer.php"; ?>
  </div>     
  <?php include "allscript.php"; ?>
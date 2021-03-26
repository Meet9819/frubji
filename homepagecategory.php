      
               <section class="elementor-element elementor-element-18ad8e7c elementor-section-full_width grocery-hover-style elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="18ad8e7c" data-element_type="section">
                  <div class="elementor-container elementor-column-gap-extended">
                     <div class="elementor-row">
                        <div class="elementor-element elementor-element-4499d12a elementor-column elementor-col-100 elementor-top-column" data-id="4499d12a" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-67e7e892 elementor-widget elementor-widget-xs-cats-product" data-id="67e7e892" data-element_type="widget" data-widget_type="xs-cats-product.default">
                                    <div class="elementor-widget-container">
                                       <ul class="nav nav-tabs xs-nav-tab-v3" role="tablist">
                                         

                                           <?php

                                          include"db.php";
                                           
                                          $result = mysqli_query($con,"SELECT * FROM `menu` where parent_id = 0 order by menu_id desc limit 8 ");
                                          $count = 0;
                                          while($row = mysqli_fetch_array($result))
                                          {                                          

                                             if($count == 0)
                                            {    $menuid=  $row['menu_id'];
                                             echo '
                                                <li class="nav-item">
                                                   <a class="nav-link active" data-toggle="tab" href="#'.$row['menu_id'].'" role="tab">
                                                      <div>
                                                         <img width="38" height="38" src="" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" data-lazy-src="media/'.$row['img'].'" />
                                                      </div>
                                                      '.$row['menu_name'].' <small>20Items Available </small> 
                                                   </a>
                                                </li>                                          
                                          ';
                                         }
                                         else
                                         {    $menuid=  $row['menu_id'];
                                           echo ' 
                                            <li class="nav-item">
                                                <a class="nav-link " data-toggle="tab" href="#'.$row['menu_id'].'" role="tab">
                                                   <div>
                                                      <img width="38" height="38" src="" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" data-lazy-src="media/'.$row['img'].'" />
                                                   </div>
                                                   '.$row['menu_name'].' <small>20Items Available </small> 
                                                </a>
                                             </li>
                                          ';
                                         }
                                         $count = $count + 1;


                                        } ?> 
                                        



                                       </ul>



                                       <div class="tab-content">
                                           <div class="tab-pane fade show " id="<?php echo $menuid; ?>" role="tabpanel">
                                             <div class="row no-gutters product-category-version-2">
                                               
                                                 <?php

                                          include"db.php";
                                           
                                          $result = mysqli_query($con,"SELECT * FROM `products` where maincat = $menuid limit 6");
                                          while($row = mysqli_fetch_array($result))
                                          {
                                             echo '

                                                <div class="col-6 col-md-4 col-lg-2">
                                                   <div class="xs-product-category">
                                                      <a class="xs_product_img_link" href="detailpage.php">
                                                         <img style="width:250px;height:250px" data-lazy-src="media/products/'.$row['img'].'">
                                                        
                                                      </a>
                                                      <h4 class="product-title"><a href="detailpage.php">'.$row['name'].'</a></h4>
                                                      <span class="price"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#8377;</span>200.00</span> </span>
                                                   </div>
                                                </div>
                                                '; } ?>


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



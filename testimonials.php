    <link rel="stylesheet" href="./css/testimonialsstyle.css">

               <div class="testimonial-container">
                  <div class="dk-container">
                     <div class="cd-testimonials-wrapper cd-container">
                        <h2>Testimonials</h2>
                        <ul class="cd-testimonials">
                            <?php

                                          include"db.php";

                                          $result = mysqli_query($con,"SELECT * FROM e_testimonials ");

                                          while($row = mysqli_fetch_array($result))
                                          {
                                          echo '

                                           <li>
                                             <div class="testimonial-content">
                                                <p>'.$row['title'].' - '.$row['description'].'</p>
                                                <div class="cd-author">
                                                   <img src="http://placehold.it/350x350/222222/222222" alt="Author image">
                                                   <ul class="cd-author-info">
                                                      <li>'.$row['name'].'</span></li>
                                                      <li>'.$row['post'].'</li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </li>
                                          '; } 
                                          ?>

                         
                        </ul>
                     </div>
                     <!-- cd-testimonials -->
                  </div>
               </div>
               <!-- partial -->
               <script src='https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.1/jquery.flexslider.min.js'></script>
               <script  src="./js/testimonialsscript.js"></script>
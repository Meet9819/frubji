<?php error_reporting(0);
define(SERVER_ROOT, __DIR__);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> 

<?php include "allcss.php"; ?>
<?php include "header.php"; ?>
 
  <body class="post-template-default single single-post postid-822 single-format-standard theme-marketo woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default" data-spy="scroll" data-target="#header">
    <div class="xs-breadcumb">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Blogs</li>
            <li class="breadcrumb-item">Exterior Ideas: 10 Colored Fiber Garden Seats</li>
          </ol>
        </nav>
      </div>
    </div>
    <div id="main-container" class="main-container blog xs-section-padding" role="main">
      <div class="sections">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12"> 


             <?php

          include"db.php";
          $qq = $_GET['q'];
          $result = mysqli_query($con,"SELECT * FROM blogs where id = $qq");

          while($row = mysqli_fetch_array($result))
          {
          echo '
          <article id="post-822" class="post-content post-single post-822 post type-post status-publish format-standard has-post-thumbnail hentry category-speaker">
                <div class="entry-thumbnail post-media post-image">
                  <img width="720" height="394" src="admin/superadmin/ecommerce/blogsimages/'.$row['image'].'"  />
                

                </div>
                <div class="post-body clearfix">
                  <header class="entry-header clearfix">
                    <div class="post-meta">
                      <span class="meta-author post-author">
                       
                       
                        <a href="author/marketodemo/index.html" rel="author"> By Marketo</a>
                      </span>
                      <span class="meta-categories post-cat"> <i class="icon icon-folder"></i> <a href="category/speaker/index.html" rel="category tag">Speaker</a> </span><span class="post-comment"><i class="icon icon-comment"></i> <a href="index.html#respond">0</a></span>
                    </div>
                    <h2 class="entry-title"> '.$row['title'].'</h2>
                  </header>
                  <div class="entry-content marketo-main-content ">
                    <p>'.$row['shortdescription'].'</p> <p>'.$row['description'].'</p>
                   
                  </div>
                  <div class="post-footer clearfix">
                    <div class="share-items pull-right"></div>
                  </div>
                </div>
              </article>


              '; } ?>



          
           
</nav>
<div id="comments" class="xs-blog-post-comments comments-area">
  <div id="respond" class="comment-respond">
    <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow" id="cancel-comment-reply-link" href="index.html#respond" style="display:none;">Cancel reply</a></small></h3>
    <form action="https://wp.xpeedstudio.com/marketo/grocery/wp-comments-post.php" method="post" id="commentform" class="comment-form">
     
      <div class="comment-info row">
        <div class="col-md-6"><input placeholder="Enter Name *" id="author" class="form-control" name="author" type="text" value="" size="30" aria-required='true' /></div>
        <div class="col-md-6"> <input Placeholder="Enter Email *" id="email" name="email" class="form-control" type="email" value="" size="30" aria-required='true' /></div>
        <div class="col-md-12"><input Placeholder="Enter Website" id="url" name="url" class="form-control" type="url" value="" size="30" /></div>
      </div>
    
      <div class="row">
        <div class="col-md-12 "><textarea  class="form-control" Placeholder="Enter Comment" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>
        <div class="clearfix"></div>
      </div>
<br>
        <p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" /> <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label></p>

      <p class="form-submit"><input name="submit" type="submit" id="submit" class="btn-comments btn btn-primary" value="Post Comment" /> <input type='hidden' name='comment_post_ID' value='822' id='comment_post_ID' /> <input type='hidden' name='comment_parent' id='comment_parent' value='0' /></p>
    </form>
  </div>
</div>
</div>




<?php include "blogsleftsidebar.php"; ?>


</div>
</div>
</div>
</div>

<?php include "footer.php"; ?>
</div>     
<?php include "allscript.php"; ?>

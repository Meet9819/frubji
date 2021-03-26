<aside id="sidebar" class="sidebar sidebar-right col-lg-4 col-md-12" role="complementary">
  <div id="search-2" class="widget widget_search">
    <form class="search-form xs-serachForm xs-font-alt" method="get" action="" id="search"> <input type="text" name="s" class="xs-serach-filed search-field" placeholder="Search.." value=""> <input type="submit" class="search-submit" value=""> </span></form>
  </div>



  <div id="recent-posts-2" class="widget widget_recent_entries">
    <h3 class="widget-title xs-widget-title">Recent Posts</h3>
    <ul>

        <?php

          include"db.php";

          $result = mysqli_query($con,"SELECT * FROM blogs limit 5");

          while($row = mysqli_fetch_array($result))
          {
          echo '

      <li> <a href="blogsdetailpage.php?q='.$row['id'].'">'.$row['title'].'</a></li> 
      '; } ?>

    
    </ul>
  </div>




</aside>
<?php
    include_once 'header.php';     
    include "db.php";

    // Pagination setup
    // $results_per_page = 6; 
    // $sql_work_count = "SELECT COUNT(*) AS total FROM blog"; // Count total number of results
    // $result_count = mysqli_query($con, $sql_work_count);
    // $row = mysqli_fetch_assoc($result_count);
    // $total_results = $row['total'];
    // $total_pages = ceil($total_results / $results_per_page); 

    // if (!isset($_GET['page'])) {
    //     $page = 1;
    // }  else {
    //     $page = $_GET['page'];
    // }

    // $start_limit = ($page - 1) * $results_per_page; // Calculate starting limit for results

    $cat_query = "SELECT * FROM category";
    $cat_data = mysqli_query($con, $cat_query);

    $sql_work = "SELECT * FROM blog INNER JOIN category ON blog.category = category.id INNER JOIN admin ON blog.author = admin.id ORDER BY blog.id DESC limit 9";
    $work_d = mysqli_query($con, $sql_work);
?>

<section class="page-heading wow fadeIn" data-wow-duration="1.5s" style="background-image: url(files/images/01-heading.jpg)">
    <div class="container">
        <div class="page-name">
            <h1>Latest Photos</h1>
            <span>Lovely layout of heading</span>
        </div>
    </div>
</section>

<section class="portfolio on-portfolio">
    <div class="container">
        <div class="col-sm-12 text-center">
            <div id="projects-filter">
                <a href="#" data-filter="*" class="active">Show All</a>

                <?php while ($cat = mysqli_fetch_assoc($cat_data)) { ?>
                    <a href="#" data-filter=".<?php echo $cat['catname']; ?>"><?php echo $cat['catname']; ?></a>
                <?php } ?>

            </div>
        </div>
        <div class="row">
            <div class="row" id="portfolio-grid">
                <?php $id=0; while ($work_data = mysqli_fetch_assoc($work_d)) { ?>
                    <div class="item col-md-4 col-sm-6 col-xs-12 <?php echo $work_data['catname']; ?>">
                        <figure>
                            <a href="blog-single.php?id=<?php echo $id++; ?>">
                            	<img alt="1-image" src="admin/image/bimage/<?php echo $work_data['image']; ?>">
                            <figcaption>
                                <h3><?php echo $work_data['title']; ?></h3>
                                <p><?php echo $work_data['description']; ?></p>
                            </figcaption></a>
                        </figure>    
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Pagination -->
        <!-- <div class="col-md-12">
            <div class="portfolio-page-nav text-center">
                <ul>
                    <?php //for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <li><a href="?page=<?php //echo $i; ?>" class="<?php //echo ($page == $i) ? 'current' : ''; ?>"><?php //echo $i; ?></a></li>
                    <?php// } ?>
                </ul>
            </div>
        </div> -->
    </div>
</section>



                <footer class="footer">
      <div class="three spacing"></div>
	  <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h1>
            <a href="index.html">
             YOM
            </a>
          </h1>
          <p>©2015 Yom. All rights reserved.</p>
          <div class="spacing"></div>
          <ul class="socials">
            <li>
              <a href="http://facebook.com">
                <i class="fa fa-facebook"></i>
              </a>
            </li>
            <li>
              <a href="http://twitter.com">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
            <li>
              <a href="http://dribbble.com">
                <i class="fa fa-dribbble"></i>
              </a>
            </li>
            <li>
              <a href="http://tumblr.com">
                <i class="fa fa-tumblr"></i>
              </a>
            </li>
          </ul>
          <div class="spacing"></div>
        </div>
        <div class="col-md-3">
          <div class="spacing"></div>
          <div class="links">
            <h4>Some pages</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">View some works here</a></li>
              <li><a href="#">Follow our blog</a></li>
              <li><a href="#">Contact us</a></li>
              <li><a href="#">Our services</a></li>
            </ul>
          </div>
          <div class="spacing"></div>
        </div>
        <div class="col-md-3">
          <div class="spacing"></div>
          <div class="links">
            <h4>Recent posts</h4>
            <ul>
              <li><a href="#">Hello World!</a></li>
              <li><a href="#">This is the post title here</a></li>
              <li><a href="#">Our happy day</a></li>
              <li><a href="#">The first works done</a></li>
              <li><a href="#">The cats and dogs</a></li>
            </ul>
          </div>
          <div class="spacing"></div>
        </div>
        <div class="col-md-3">
          <div class="spacing"></div>
          <h4>Email updats</h4>
          <p>We want to share our latest trends, news and insights with you.</p>
          <form>
            <input class="email-address" placeholder="Your email address" type="text">
            <input class="button boxed small" type="submit">
          </form>
          <div class="spacing"></div>
        </div>
      </div>
	  </div>
      <div class="two spacing"></div>
    </footer>
				

				<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
			</div>
		</div>
	</div>


	

	<script type="text/javascript" src="files/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="files/js/bootstrap.min.js"></script>
	<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script src="files/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="files/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

	<script type="text/javascript" src="files/js/plugins.js"></script>
	<script type="text/javascript" src="files/js/custom.js"></script>

</body>

<!-- Mirrored from torchtemplates.net/html/miller/work-3columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Jun 2015 08:34:38 GMT -->
</html>
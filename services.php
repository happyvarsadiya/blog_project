<?php

  include_once 'header.php';
  include "db.php";

    $sql = "select * from `services`";
    $res = mysqli_query($con,$sql);

?>

				<section class="page-heading wow fadeIn" data-wow-duration="1.5s" style="background-image: url(files/images/01-heading.jpg)">
					<div class="container">
						<div class="page-name">
							<h1>Our Services</h1>
							<span>Lovely layout of heading</span>
						</div>
					</div>
				</section>

				<section class="services on-services green">
					<div class="container">
					<div class="row">
						<div class="section-heading">
							<h2>What We Offer</h2>
							<div class="section-dec"></div>
						</div>

					<?php while ($data=mysqli_fetch_assoc($res)) { ?>
						<div class="service-item col-md-4">
							<span><i class="<?php echo $data['icon'];  ?>"></i></span>
							<div class="tittle"><h3><?php echo $data['title']; ?></h3></div>
							<p><?php echo $data['description']; ?></p>
						</div>
					<?php } ?>
						
					</div>
				</section>

				<section class="call-to-action-2">
					<div class="container">
					<div class="left-text hidden-xs">
						<h4>Know Us Better, Read This</h4>
						<p><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi ut explicabo magni sapiente.</em><br><br>Inventore at quia, vel in repellendus, cumque dolorem autem ad quidem mollitia porro blanditiis atque rerum debitis eveniet nostrum aliquam. Sint aperiam expedita sapiente amet officia quis perspiciatis adipisci, iure dolorem esse exercitationem!</p>
					</div>
						<div class="right-image hidden-xs"></div>
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

		<nav class="sidebar-menu slide-from-left">
			<div class="nano">
				<div class="content">
					<nav class="responsive-menu">
						<ul>
							<li><a href="index-2.html">Home</a></li>
							<li class="menu-item-has-children"><a href="#">Pages</a>
								<ul class="sub-menu">
									<li><a href="services.html">Services</a></li>
									<li><a href="clients.html">Clients</a></li>
								</ul>
							</li>
							<li class="menu-item-has-children"><a href="#">Blog</a>
								<ul class="sub-menu">
									<li><a href="blog.html">Blog Classic</a></li>
									<li><a href="blog-grid.html">Blog Grid</a></li>
									<li><a href="blog-single.html">Single Post</a></li>
								</ul>
							</li>
							<li><a href="about.html">About</a></li>
							<li class="menu-item-has-children"><a href="#">Works</a>
								<ul class="sub-menu">
									<li><a href="work-3columns.html">Three Columns</a></li>
									<li><a href="work-4columns.html">Four Columns</a></li>
									<li><a href="single-project.html">Single Project</a></li>
								</ul>
							</li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</nav>

	</div>


	

	<script type="text/javascript" src="files/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="files/js/bootstrap.min.js"></script>
	<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script src="files/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="files/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

	<script type="text/javascript" src="files/js/plugins.js"></script>
	<script type="text/javascript" src="files/js/custom.js"></script>

</body>

</html>
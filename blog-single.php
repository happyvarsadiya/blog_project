<?php 

  include "db.php";
  include_once 'header.php';	


  $blog_select = "select * from blog";
  $blog_data = mysqli_query($con,$blog_select);
  $total_data = mysqli_num_rows($blog_data);	

  $id = $_GET['id'];
  $nnum = $id;
  $pnum = $id;


  $sql = "SELECT blog.* , category.catname , admin.name as c_id FROM blog INNER JOIN category ON blog.category = category.id INNER JOIN admin ON blog.author = admin.id ORDER BY blog.id DESC limit $id,1";
  $res = mysqli_query($con,$sql);
  $data = mysqli_fetch_assoc($res);

  if(isset($_POST['save']))
  {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $subject = $_POST['subject'];
      $comment = $_POST['comment'];      
      $image = $_FILES['image']['name'];
      $path = "admin/image/comment/".$image;
      move_uploaded_file($_FILES['image']['tmp_name'], $path);

      $blog_id=$data['id'];

      	if(isset($_GET['id']))
       {
        
        $sql = "insert into `comment` (`name`, `email`, `subject`, `comment`,`image`,`blog_id`) 
        values ('$name', '$email', '$subject','$comment','$image','$blog_id')";
        mysqli_query($con, $sql);
      } 
      
    //  header("location:blog-single.php");
  } 

 ?>

<!DOCTYPE html>
<!--[if IE 9]>
<html class="ie ie9" lang="en-US">
<![endif]-->
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<title>YOM- Multipurpose HTML Theme</title>
	

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>

	

	<link rel="stylesheet" href="files/css/bootstrap.css">
	<link rel="stylesheet" href="files/css/animate.css">
	<link rel="stylesheet" href="files/css/simple-line-icons.css">
	<link rel="stylesheet" href="files/css/font-awesome.min.css">
	<link rel="stylesheet" href="files/css/style.css">

	<link rel="stylesheet" href="files/rs-plugin/css/settings.css">

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

</head>
<style type="text/css">
	.even{
		margin-left: 200px;
		margin-bottom: 100px;
	}
</style>
<body>

				<section class="page-heading wow fadeIn" data-wow-duration="1.5s" style="background-image: url(files/images/01-heading.jpg)">
					<div class="container">
						<div class="page-name">
							<h1>Single Post</h1>
							<span>Lovely layout of heading</span>
						</div>
					</div>
				</section>
				
				<section class="blog-single">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<div class="blog-single-item">
									<img src="admin/image/bimage/<?php echo $data['image'] ?>" alt="" 
									style="height: 400px; width: 100%;">
									<div class="blog-single-content">	
										<h3><a href="#"><?php echo $data['title']; ?></a></h3>
										<span><a href="#"><?php echo $data['c_id']; ?></a></span>
										<p><br><br> <em><i class="fa fa-info"></i>Quis, sequi illo nobis velit. Quas minima corporis quis laborum, ex odit natus.</em><br><br>Blanditiis possimus voluptas similique numquam consequatur dolorem labore veritatis quaerat laboriosam, porro tenetur vel exercitationem laborum aperiam repellat expedita ipsum corrupti perspiciatis! Quia necessitatibus totam repudiandae ipsam aut repellendus, aspernatur soluta consectetur aperiam accusantium aliquid beatae nihil magni nulla, similique minus perspiciatis provident qui veritatis dolorum quasi sint. Quam impedit in eos illum sint officiis reiciendis repellendus quia, similique ipsa porro accusantium dolores sunt error, ex, tempora et voluptatibus eveniet. <br><br>Voluptatibus libero laboriosam tempore rerum error non. Perspiciatis deleniti iste a. Illo ipsum, commodi vel necessitatibus assumenda veritatis a velit possimus sint!</p>
										<div class="share-post">
											<span>Share on: <a href="#">facebook</a>, <a href="#">twitter</a>, <a href="#">linkedin</a>, <a href="#">instagram</a></span>
										</div>
									</div>
									<div class="prev-btn col-md-6 col-sm-6 col-xs-6">
									    	<?php if ($pnum>0): ?>
									        <a href="blog-single.php?id=<?php echo --$pnum; ?>"><i class="fa fa-angle-left"></i> Previous</a>
									    <?php endif; ?>
									</div>
									<div class="next-btn col-md-6 col-sm-6 col-xs-6">
									    <?php if ($nnum<$total_data-1): ?>
									        <a href="blog-single.php?id=<?php echo ++$nnum; ?>">Next <i class="fa fa-angle-right"></i></a>
									    <?php endif; ?>
									</div>	
								</div>

								<div class="blog-comments">
										
									<ul class="comments-content">
								    <?php 
								    $sql = "SELECT * FROM `comment` WHERE blog_id=".$data['id'];
								    $res = mysqli_query($con, $sql);
								    $cnt = 0;

								    while ($data = mysqli_fetch_assoc($res)) {
								        $cnt++;
								    ?>
								    <li class="comment-item <?php echo ($cnt % 2 == 0) ? 'even' : ''; ?>">
								        <img src="admin/image/comment/<?php echo $data['image']; ?>" alt="">
								        <span class="author-title"><a href="#"><?php echo $data['name']; ?></a></span>
								        <span class="comment-date">10 May 2015 / <a href="#">Reply</a></span>
								        <p><?php echo $data['comment']; ?></p>
								    </li>
								    <?php } ?>
								    <br>
								    <h2><?php echo $cnt; ?> Comments</h2>
								</ul>


								</div>

								<div class="submit-comment col-sm-12">
									<h2>Leave A Comment</h2>
									<form id="contact_form" action="#" method="POST" enctype="multipart/form-data">
										<div class=" col-md-4 col-sm-4 col-xs-6">
											<input type="text" class="blog-search-field" name="name" placeholder="Your name..." >
										</div>
										<div class="col-md-4 col-sm-4 col-xs-6">
											<input type="text" class="blog-search-field" name="email" placeholder="Your email..." >
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input type="text" class="subject" name="subject" placeholder="Subject..." >
										</div>
										<div class="col-md-12 col-sm-12">
											<textarea id="message" class="input" name="comment" placeholder="Comment..."></textarea>
										</div>
										<div class="col-md-12 col-sm-12">
											<input type="file" name="image">
										</div>
										<div class="submit-coment col-md-12">
											<div class="btn-black">
												<button type="submit" name="save">Submit now</button>
											</div>
										</div>
									</form>		
								</div>
							</div>
							<div class="col-md-4">
								<div class="widget-item">
									<h2>Search here</h2>
									<div class="dec-line"></div>
									<form method="get" id="blog-search" class="blog-search">
										<input type="text" class="blog-search-field" name="s" placeholder="Type keyword..." value="">
									</form>
								</div>
								<div class="widget-item">
									<h2>About Us</h2>
									<div class="dec-line">	
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique earum quod iste, natus quaerat facere a rem dolor sit amet, et placeat nemo.</p>
									<div class="social-icons">
										<ul>
											<li><a href="#"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#"><i class="fa fa-instagram"></i></a></li>
											<li><a href="#"><i class="fa fa-rss"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="widget-item">

									<?php 

										$sql="select * from `blog` ORDER BY id DESC limit 0,3";
										$res = mysqli_query($con,$sql);
									?>

									<h2>Recent Posts</h2>
									<div class="dec-line"></div>
									<?php $id=0; while ($data=mysqli_fetch_assoc($res)) { ?>

									<ul class="recent-item">
										<li class="recent-post-item">
											<a href="blog-single.php?id=<?php echo $id++; ?>">
												<img src="admin/image/bimage/<?php echo $data['image']; ?>" alt="">
												<span class="post-title"><?php echo $data['title']; ?></span>
											</a>
										</li>
									<?php } ?>
									</ul>
								</div>
								<div class="widget-item">
									<h2>From Flickr</h2>
									<div class="dec-line"></div>
									<div class="flickr-feed">
							        	<ul class="flickr-images">
							        	</ul>
							        </div>
								</div>
							</div>
						</div>
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

	</div>		</div>
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
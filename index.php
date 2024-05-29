<?php
	include("db.php");
	include("header.php");

    $sql = "select * from `yomslider` where status = 1";
    $res = mysqli_query($con,$sql);

    $sql_select_blog = "SELECT * FROM blog INNER JOIN category ON blog.category = category.id INNER JOIN admin ON blog.author = admin.id ORDER BY blog.id DESC limit 0,3";
    $blog_data = mysqli_query($con,$sql_select_blog);

?>
				<div class="slider">
					<div class="fullwidthbanner-container">
						<div class="fullwidthbanner">
							<ul>
							<?php while ($data=mysqli_fetch_assoc($res)) { ?>
								<li class="first-slide" data-transition="fade" data-slotamount="10" data-masterspeed="300">
									<img src="admin/image/slider/<?php echo $data['image']; ?>" data-fullwidthcentering="on" alt="slide">
									<div class="tp-caption first-line lft tp-resizeme start" data-x="center" data-hoffset="0" data-y="250" data-speed="1000" data-start="200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0"><?php echo $data['title'] ?></div>
									<div class="tp-caption second-line lfb tp-resizeme start" data-x="center" data-hoffset="0" data-y="340" data-speed="1000" data-start="800" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0"><?php echo $data['description'] ?></div>
									<div class="tp-caption slider-btn sfb tp-resizeme start" data-x="center" data-hoffset="0" data-y="510" data-speed="1000" data-start="2200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0"><a href="#" class="btn btn-slider">Discover More</a></div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				
				<section class="services green">

					<div class="container">
						<div class="section-heading">
							<h2>What We Offer</h2>
							<div class="section-dec"></div>
						</div>
						<?php 
							$sql = "select * from `our_offer` limit 3";
    						$res = mysqli_query($con,$sql);

						 while ($data=mysqli_fetch_assoc($res)) {
    						$icon = $data['icon'];					
						 	
						  ?>
						<div class="service-item col-md-4">
							<span><i class="<?php echo $data['icon'];  ?>"></i></span>
							<div class="tittle"><h3><?php echo $data['title']; ?></h3></div>
							<p><?php echo $data['description']; ?>.</p>
						</div>
						<?php } ?>
					</div>
				</section>
				
				
				<section class="call-to-action-1">
					<div class="container">
						<h4>Over 3000 people already downloaded YOM</h4>
						<p class="col-md-10 col-md-offset-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat quod voluptate consequuntur ad quasi, dolores obcaecati ex aliquid, dolor provident accusamus omnis dolorum ipsam. Voluptatem ipsum expedita, corporis facilis laborum asperiores nostrum! Amet porro numquam ratione temporibus quia dolorem sint lorem voluptates quasi mollitia.</p>
						<div class="buttons">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="border-btn"><a href="#">Learn More</a></div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="btn-black"><a href="#">Buy This Theme</a></div>
							</div>
						</div>
					</div>	
				</section>

				<section class="call-to-action-2">
					<div class="container">
					<div class="left-text hidden-xs">
						<h4>To know about this theme read this</h4>
						<p><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi ut explicabo magni sapiente.</em><br><br>Inventore at quia, vel in repellendus, cumque dolorem autem ad quidem mollitia porro blanditiis atque rerum debitis eveniet nostrum aliquam. Sint aperiam expedita sapiente amet officia quis perspiciatis adipisci, iure dolorem esse exercitationem!</p>
					</div>
						<div class="right-image hidden-xs"></div>
					</div>
				</section>

				<section class="portfolio">
					<div class="container">
						<div class="section-heading-white">
							<h2>Recent Photos</h2>
							<div class="section-dec"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div id="owl-portfolio" class="owl-carousel owl-theme">

							<?php 
								$sql = "select * from `blog` limit 0,6";
    							$res = mysqli_query($con,$sql);

						 		while ($data=mysqli_fetch_assoc($res)) { ?>

									<div class="item">
								  		<figure>
				        					<img alt="portfolio" src="admin/image/bimage/<?php echo $data['image']; ?>">
				        					<figcaption>
				            					<h3><?php echo $data['title']; ?></h3>
				            					<p><?php echo $data['description']; ?></p>
				        					</figcaption>
				    					</figure>								    
				    				</div>
				    			<?php } ?>
								</div>
							</div>
						</div>
						<div class="owl-navigation">
						  <a class="btn prev fa fa-angle-left"></a>
						  <a class="btn next fa fa-angle-right"></a>
						  <a href="work.php" class="go-to">Go to portfolio</a>
						</div>
					</div>
				</section>

				<section class="testimonials">
					<div class="container">
						<div class="section-heading">
							<h2>What Others saying</h2>
							<div class="section-dec"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div id="owl-demo" class="owl-carousel owl-theme">
								<?php 
									$sql = "select * from `what_others`";
    								$res = mysqli_query($con,$sql);

						 			while ($data=mysqli_fetch_assoc($res)) { ?>
									<div class="item">
								  		<div class="testimonials-post">
								  			<span class="<?php echo $data['icon'];  ?>"></span>
								  			<p><?php echo $data['description']; ?></p>
								  			<h6><?php echo $data['name']; ?>
								  			<em><?php echo $data['subname']; ?></em></h6>
								  		</div>
								    </div>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="call-to-action-3">
					<div class="container">
						<div class="col-md-12">
							<h4 class="col-md-10 col-sm-8">Read your lastest newsletters, we have an offer for you!</h4>
							<div class="btn-black col-md-2 col-sm-4"><a href="#">Take it now</a></div>
						</div>
					</div>
				</section>

				<section class="blog-posts">
					<div class="container">
						<div class="section-heading">
							<h2>Latest Posts</h2>
							<div class="section-dec"></div>
						</div>

						<?php $id=0; while($row = mysqli_fetch_assoc($blog_data)) { ?>
						<div class="blog-item">
							<div class="col-md-4">
								<a href="blog-single.php?id=<?php echo $id++; ?>"><img src="admin/image/bimage/<?php echo $row['image']; ?>" alt=""></a>
								<h3><a href="blog-single.php"><?php echo $row['title']; ?></a></h3>
								<span><a href="#"><?php echo $row['name']; ?></a> / <a href="#"><?php echo $row['date'] ?></a> / <a href="#"><?php echo $row['catname']; ?></a></span>
								<p><?php echo $row['description']; ?></p>
								<div class="read-more">
									<a href="blog-single.php">Read more</a>
								</div>
							</div>
						</div>
						<?php } ?>
						

					</div>
				</section>

<?php
	include("footer.php");
?>

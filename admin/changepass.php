<?php 
	
	$con = mysqli_connect("localhost","root","","adminpanel");
	include "header.php";

	// session_start();

	if(isset($_POST['submit']))
	{
		$newpass = $_POST['newpass'];
		$confim = $_POST['confim'];
		if(isset($_SESSION['userid']))
	  	{
	     	$userid= $_SESSION['userid'];
		}

		if($newpass == $confim)
		{
			$update = md5($newpass);
			$sql = "update `admin` set `password` = '$update' where `id` = '$userid'";
			mysqli_query($con,$sql);
			$mes = "Password Updated..!";
		}else
		{
			$mes = "Newpassword and ConfimPassword are not match";
		}
	}
	
 ?>

 <div class="content-wrapper">
    
 <h4><?php echo @$mes; ?></h4><br>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
             
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" id="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">New Password</label>
                    <input type="password" name="newpass" class="form-control" placeholder="Enter New Password" > 
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confim Password</label>
                    <input type="password" name="confim" class="form-control" placeholder="Enter Confim Password" > 
                  </div>
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>

<?php 
  include("footer.php");
?>


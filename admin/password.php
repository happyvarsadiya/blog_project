<?php 

	include "header.php";

	$con = mysqli_connect("localhost","root","","adminpanel");

	// session_start();
	if(isset($_SESSION['userid']))
	  {
	     $userid= $_SESSION['userid'];
	}
	if(isset($_POST['submit']))
	{
		$currant = md5($_POST['currant']);

		$sql = "select * from `admin` where `id`= '$userid' and `password` = '$currant'";
		$res = mysqli_query($con,$sql);
		$cnt = mysqli_num_rows($res);
		if($cnt == 1)
		{
			header("location:changepass.php");
		}else
		{
			$mes = "Your Currant PassWord Is Wrong";
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
                    <label for="exampleInputEmail1">Enter Currant PassWord</label>
                    <input type="password" name="currant" class="form-control" id="cat" placeholder="Enter Currant PassWord" > 
                    <span style="color: red; display: none;">Enter Currant PassWord...!</span>
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


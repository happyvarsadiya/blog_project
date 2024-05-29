<?php 
  include("header.php");

  $con = mysqli_connect("localhost", "root", "", "adminpanel");

  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    $sql1 = "select * from `category` where `id`=".$id;
    $res = mysqli_query($con,$sql1);
    $data = mysqli_fetch_assoc($res);
  }

  if(isset($_POST['submit']))
  {
      $catname = $_POST['catname'];

      $select = "select * from `category` where `catname`='$catname'";
      $select_res = mysqli_query($con,$select);
      $select_rec = mysqli_num_rows($select_res);

        if(isset($_GET['id']))
        {
          $sql = "update `category` set `catname`='$catname' where `id`=".$_GET['id'];
          mysqli_query($con, $sql);
          header("location:view_cat.php");

        }else
        {
            if($select_rec == 0 )
            {
               $sql = "insert into `category` (`catname`) values ('$catname')";
              mysqli_query($con, $sql);
              header("location:view_cat.php");
            }else{
               $mes = "This Catagory are already exist";
            }
        }
  }

?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Catagory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Catagory</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 <h4><?php echo @$mes; ?></h4><br>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
             
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" id="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Catagory</label>
                    <input type="text" name="catname" class="form-control" id="cat" placeholder="Enter Catagory" value="<?php echo @$data['catname']; ?>"> 
                    <span style="color: red; display: none;">Enter Catagory...!</span>

                  </div>
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php 
  include("footer.php");
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  <script type="text/javascript">
  
  $(document).ready(function()
  {
      $('#frm').submit(function() 
      {
        
        var cat= $('#cat').val();

        if(cat=='')
        {
          $('#cat').next('span').css('display','inline')
          return false;
        }else
        {
          $('#cat').next('span').css('display','none')
        }
    })
});
</script>
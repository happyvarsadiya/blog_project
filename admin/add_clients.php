<?php 
  include("header.php");

  $con = mysqli_connect("localhost", "root", "", "adminpanel");

  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    $sql = "select * from `clients` where `id`=".$id;
    $res = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($res);
  }

  if(isset($_POST['submit']))
  {
      $image = $_FILES['image']['name'];
      $path = "image/cimage/".$image;
      move_uploaded_file($_FILES['image']['tmp_name'], $path);

      if(isset($_GET['id']))
      {
        $sql = "update `clients` set  `image`='$image' where `id`=".$_GET['id'];
      }else
      {
        $sql = "insert into
         `clients` (`image`) values ('$image')";
      } 
      mysqli_query($con, $sql);
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
            <h1>Add Services</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Services</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <?php if(isset($data['image'])): ?>
                            <div style="height:70px; width: 70px; overflow:hidden;">
                                <img src="image/cimage/<?php echo $data['image']; ?>" alt="Profile Picture" style="height: 100%; width:100%; object-fit:cover;">
                            </div>
                        <?php endif; ?>
                      <span style="color: red; display: none;" id="image_error">Enter Image...!</span>

                    </div>
                  </div>
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

          var image= $('#image').val();
          if (image=="") 
          {
            $('#image_error').css('display','inline')
            return false;
          }
      
    })
});
</script>
<?php 
  include("header.php");

  $con = mysqli_connect("localhost", "root", "", "adminpanel");

  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    $sql = "select * from `yomslider` where `id`=".$id;
    $res = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($res);
  }

  if(isset($_POST['submit']))
  {
      $title = $_POST['title'];
      $description = $_POST['description'];
      $image = $_FILES['image']['name'];
      if($image==""){
        $image=$data['image'];
      }else{
          $image = rand(10000,90000).'img'.$image;
          $path = "image/slider/".$image;
          move_uploaded_file($_FILES['image']['tmp_name'], $path);
      }

      if(isset($_GET['id']))
      {
        $sql = "update `yomslider` set `title`='$title',`description`='$description',`image`='$image' where `id`=".$_GET['id'];
      }else
      {
        $sql = "insert into `yomslider` (`title`, `description`, `image`) values ('$title', '$description', '$image')";
      } 
      mysqli_query($con, $sql);

      header("location:view_slider.php");
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
            <h1>Add Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Slider</li>
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
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="<?php echo @$data['title'] ?>">
                    <span style="color: red; display: none;">Enter title...!</span>

                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="description" class="form-control" id="description" placeholder="Enter description" value="<?php echo @$data['description'] ?>"> 
                    <span style="color: red; display: none;">Enter description...!</span>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image" attr_data="<?php echo isset($data['image']) ? $data['image'] : ''; ?>">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                    <?php if(isset($data['image'])): ?>
                            <div style="height:70px; width: 70px; overflow:hidden;">
                                <img src="image/slider/<?php echo $data['image']; ?>" alt="Profile Picture" style="height: 100%; width:100%; object-fit:cover;">
                            </div>
                        <?php endif; ?>
                  </div>

                   <span style="color: red; display: none;" id="image_error">Enter Image...!</span>

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
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
        var title= $('#title').val();
        var description= $('#description').val();

    if(title=='')
    {
      $('#title').next('span').css('display','inline')
      return false;
    }else
    {
      $('#title').next('span').css('display','none')
    }

    if(description=='')
    {
      $('#description').next('span').css('display','inline')
      return false;
    }else
    {
      $('#description').next('span').css('display','none')
    }

      var image= $('#image').attr('attr_data');
          if(image==""){
            var image = $('#image').val();
          }

          if (image=="") 
          {
            $('#image_error').css('display','inline')
            return false;
          }else
          {
            $('#image_error').css('display','none')
          }
    })
});
</script>
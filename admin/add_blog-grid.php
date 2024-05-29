
<?php 
  include("header.php");

  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    $sql = "select * from `blog` where `id`=".$id;
    $res = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($res);
  }

  if(isset($_POST['submit']))
  {
      $image = $_FILES['image']['name'];
      $path = "image/bimage/".$image;
      move_uploaded_file($_FILES['image']['tmp_name'], $path);
      $title = $_POST['title'];
      $date = $_POST['date'];
      $description = $_POST['description'];
      $category = $_POST['category'];

      $author_id =$_SESSION['userid'];

      if(isset($_GET['id']))
      {
        $sql = "update `blog` set  `image`='$image',`title`='$title',`date`='$date',`description`='$description' , category='$category' where `id`=".$_GET['id'];
      }else
      {
       $sql = "insert into
         `blog` (`image`,`title`,`date`, `description`,`category`,`author`) values ('$image','$title','$date', '$description','$category','$author_id')";
         header("location:view_blog-grid.php");
      } 
      mysqli_query($con, $sql);
  }

  $sql_select_category = "select * from category";
  $cat_data = mysqli_query($con,$sql_select_category);

?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add Blog</li>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Blog</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter title" value="<?php echo @$data['title']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="description" class="form-control" id="exampleInputEmail1" placeholder="Description" value="<?php echo @$data['description']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Date</label>
                    <input type="date" name="date" class="form-control" id="exampleInputPassword1" placeholder="Date" value="<?php echo @$data['date']; ?>">
                  </div>
               <!--  -->

                  <div class="form-group">
                    <label for="exampleInputEmail2">Category</label>
                    <select name="category" id="category" class="form-control">
                    <option value="" selected>Select Category</option>
                      <?php
                      $cat="select * from `category`";
                      $c_sql=mysqli_query($con,$cat);
                       while ($c_data=mysqli_fetch_assoc($c_sql)) {
                       ?>
                      <option value="<?php echo $c_data['id']; ?>" 
                        <?php if(@$data['category']==@$c_data['id']){ echo "selected";} ?>>
                          <?php echo $c_data['catname']; ?>
                      </option>
                    <?php } ?>
                    </select>
                  </div>

                   <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image" attr_data="<?php echo $data['image']; ?>" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <?php if(isset($data['image'])): ?>
                            <div style="height:70px; width: 70px; overflow:hidden;">
                                <img src="image/bimage/<?php echo $data['image']; ?>" alt="Profile Picture" style="height: 100%; width:100%; object-fit:cover;">
                            </div>
                        <?php endif; ?>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="save" name="submit">
                </div>
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
        
        var title= $('#title').val();
      var date= $('#date').val();
        var description= $('#description').val();

         var image= $('#image').val();
          if (image=="") 
          {
            $('#image_error').css('display','inline')
            return false;
          }

        if(title=='')
        {
          $('#title').next('span').css('display','inline')
          return false;
        }else
        {
          $('#title').next('span').css('display','none')
        }

        if(date=='')
        {
          $('#date').next('span').css('display','inline')
          return false;
        }else
        {
          $('#date').next('span').css('display','none')
        }

        if(description=='')
        {
          $('#description').next('span').css('display','inline')
          return false;
        }else
        {
          $('#description').next('span').css('display','none')
        }
    })
});
</script>
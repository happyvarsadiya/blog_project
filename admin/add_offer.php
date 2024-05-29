<?php 
  include("header.php");

  $con = mysqli_connect("localhost", "root", "", "adminpanel");

  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    $sql = "select * from `our_offer` where `id`=".$id;
    $res = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($res);
  }

  if(isset($_POST['submit']))
  {
      $icon = $_POST['icon'];
      $title = $_POST['title'];
      $description = $_POST['description'];

      if(isset($_GET['id']))
      {
        $sql = "update `our_offer` set  `icon`='$icon',`title`='$title',`description`='$description' where `id`=".$_GET['id'];
      }else
      {
        $sql = "insert into
         `our_offer` (`icon`,`title`, `description`) values ('$icon','$title', '$description')";
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
            <h1>Add What We Offer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Offer</li>
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
                    <label for="exampleInputEmail1">Icon</label>
                    <input type="text" name="icon" class="form-control" id="icon" placeholder="Enter Icon" value="<?php echo @$data['icon']; ?>">
                    <span style="color: red; display: none;">Enter Icon...!</span>

                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="<?php echo @$data['title']; ?>"> 
                    <span style="color: red; display: none;">Enter title...!</span>

                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="description" class="form-control" id="description" placeholder="Enter Description" value="<?php echo @$data['description']; ?>">  
                    <span style="color: red; display: none;">Enter description...!</span>
                    
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

 <script type="text/javascript">
  
  $(document).ready(function()
  {
      $('#frm').submit(function() 
      {
        var icon= $('#icon').val();
        var title= $('#title').val();
        var description= $('#description').val();


    if(icon=='')
    {
      $('#icon').next('span').css('display','inline')
      return false;
    }else
    {
      $('#icon').next('span').css('display','none')
    }

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

    })
});
</script>
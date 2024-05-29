<?php 
  include_once 'header.php';

  $con = mysqli_connect("localhost", "root", "", "adminpanel");
  
  $search = ''; 
  
  if(isset($_GET['id']))
  {
    $id = $_GET['id'];
    // Retrieve image name from the database
    $rec = "select `image` from `yomslider` where `id`=$id";
    $res_image = mysqli_query($con, $rec);
    $image_data = mysqli_fetch_assoc($res_image);
    $image_name = $image_data['image'];
    
    // Delete record from the database
    $sql = "delete from `yomslider` where `id`=$id";
    mysqli_query($con, $sql);
    
    // Delete image file from the folder
    unlink("image/slider/$image_name");
    header("location:view_slider.php");
  }

    $sql_p = "select * from yomslider";
    $res_p = mysqli_query($con, $sql_p);
    
    $limit = 5; 
    if (isset($_GET['page']))   
    {
        $page = $_GET['page'];
    }else
    {
        $page = 1;
    }
    $start = ($page - 1) * $limit;  

    if (isset($_GET['title'])) 
    {
      $search = $_GET['title'];
      $sql_page = "select * from `yomslider` WHERE title LIKE '%$search%'  ORDER BY `yomslider`.`id` DESC LIMIT $start, $limit";
      $sql1 = "select * from `yomslider` WHERE title LIKE '%$search%' ORDER BY `yomslider`.`id` DESC";
    } else 
    {
      $sql_page = "select * from yomslider ORDER BY `yomslider`.`id` DESC limit $start, $limit"; 
      $sql1 = "select * from yomslider";
    }

    $total_rec = mysqli_query($con, $sql1);
    $total_r = mysqli_num_rows($total_rec);
    $total_page = ceil($total_r/$limit);
    $res_page = mysqli_query($con, $sql_page); 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    <form method="get">
        <input type="text" name="title" value="<?php echo $search; ?>">
        <input type="submit" name="submit" value="Search">
    </form> 

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                <tbody id="ans">
                 <?php while ($data=mysqli_fetch_assoc($res_page)) { ?>
                  <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['title']; ?></td>
                    <td><?php echo $data['description']; ?></td>
                    <td><img src="image/slider/<?php echo $data['image']; ?>" alt="Image"
                     style="height: 100px; width: 100px;"  ></td>
                   <td>
                      <input type="checkbox"  attr-value="<?php if($data['status']==0) { echo "1"; }else{ echo "0"; }?>"  class="check" attr-id="<?php echo $data['id']; ?>" <?php if($data['status']==1) { echo "checked"; } ?>>
                  </td>
                  <td>
                    <a href="view_slider.php?id=<?php echo $data['id'] ?>">Delete</a>||
                    <a href="add_slider.php?id=<?php echo $data['id'] ?>">Edit</a>
                  </td>
                  </tr>
                <?php } ?>
              </tbody>
              </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      <a <?php if ($page == 1) { echo 'style="pointer-events: none; opacity: 0.5;"'; } ?> 
      href='view_slider.php?page=<?php echo ($page-1); ?>&title=<?php echo $search; ?>' 
      >Previous</a>

      <?php for($i = 1; $i <= $total_page; $i++) {
          echo "<a href='view_slider.php?page=$i&title=$search'>$i</a> ";
      } ?>
      <a <?php if ($page == $total_page) { echo 'style="pointer-events: none; opacity: 0.5;"'; } ?> href='view_slider.php?page=<?php echo ($page+1); ?>&title=<?php echo $search; ?>' 
      >Next</a>

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
  include("footer.php");
?>

<script>
    $(document).ready(function() {
        $(document).on('click','.check',function(){
          var status =$(this).attr('attr-value');
          var id=$(this).attr('attr-id');

          $.ajax({
            type:"POST",
            url:"ajax.php",
            data:{"status":status,"id":id},

            success:function(res){
              $('#ans').html(res);
            }
          })
        })
    });
</script>

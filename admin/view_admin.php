<?php 
  include 'header.php';
  if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    if(!isset($_SESSION['userid'])) 
    { 
        header("location:index.php");
    }

$search = '';

if(isset($_GET['id'])) {
    $id = $_GET['id']; 

    $rec = "SELECT `s_image` FROM `admin` WHERE `id`='$id'";
    $res_image = mysqli_query($con, $rec);
    $image_data = mysqli_fetch_assoc($res_image);
    $image_name = $image_data['s_image'];

    if(isset($_SESSION['userid']) && $_SESSION['userid'] == $id) {
        // echo "<script>alert('You are an admin and cannot delete your own record.');</script>";
         $sql = "DELETE FROM `admin` WHERE `id`=$id"; 
        mysqli_query($con, $sql);
        header("location:logout.php");
    } else {

        $sql = "DELETE FROM `admin` WHERE `id`=$id"; 
        mysqli_query($con, $sql);
    
        unlink("image/admin/$image_name");
        header("location:view_admin.php");
    }
}
    $sql_p = "select * from admin";
    $res_p = mysqli_query($con, $sql_p);

    $limit = 4; 
    if (isset($_GET['page']))   
    {
        $page = $_GET['page'];
    }else
    {
        $page = 1;
    }

    $start = ($page - 1) * $limit;  

    if (isset($_GET['email'])) 
    {
      $search = $_GET['email'];
      $sql_page = "select * from `admin` WHERE email LIKE '%$search%' LIMIT $start, $limit";
      $sql1 = "select * from `admin` WHERE email LIKE '%$search%'";
    } else 
    {
      $sql_page = "select * from admin limit $start, $limit";
      $sql1 = "select * from admin";
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
        <input type="text" name="email" value="<?php echo $search; ?>">
        <input type="submit" name="submit" value="Search">
    </form>

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Admin</li>
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
                    <th>Email</th>
                    <!-- <th>Password</th> -->
                    <th>image</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
              <tbody>
                <?php while ($data=mysqli_fetch_assoc($res_page)) { ?>
                  <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><img src="image/admin/<?php echo $data['s_image']; ?>" alt="Image"
                     style="height: 100px; width: 100px;"  ></td>
                    <td><?php echo $data['name']; ?></td>
                    <td>
                        <a href="add_admin.php?id=<?php echo $data['id']; ?>">Edit</a> ||
                              <a href="view_admin.php?id=<?php echo $data['id']; ?>">Delete</a>                
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
      href='view_admin.php?page=<?php echo ($page-1); ?>&email=<?php echo $search; ?>' 
      >Previous</a>

      <?php for($i = 1; $i <= $total_page; $i++) {
          echo "<a href='view_admin.php?page=$i&email=$search'>$i</a> ";
      } ?>
      <a <?php if ($page == $total_page) { echo 'style="pointer-events: none; opacity: 0.5;"'; } ?> href='view_admin.php?page=<?php echo ($page+1); ?>&email=<?php echo $search; ?>' 
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

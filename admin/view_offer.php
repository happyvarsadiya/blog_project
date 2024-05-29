<?php 
  
  include_once 'header.php';

  $con = mysqli_connect("localhost", "root", "", "adminpanel");
 
  $search = '';

  if(isset($_GET['id']))
  {
    $id = $_GET['id'];
    $sql = "delete from `our_offer` where `id`=$id";
    mysqli_query($con, $sql);

    header('location:view_offer.php');
  }
    
    $sql_p = "select * from our_offer limit 3";
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
      $sql_page = "select * from `our_offer` WHERE title LIKE '%$search%' LIMIT $start, $limit";
      $sql1 = "select * from `our_offer` WHERE title LIKE '%$search%'";
    } else 
    {
      $sql_page = "select * from our_offer limit $start, $limit";
      $sql1 = "select * from our_offer";
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
            <h1>View Offer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Offer</li>
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
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
              <tbody>
                <tbody>
                <?php while ($data=mysqli_fetch_assoc($res_page)) { ?>
                  <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['icon']; ?></td>
                    <td><?php echo $data['title']; ?></td>
                    <td><?php echo $data['description']; ?></td>
                    <td>
                      <a href="view_offer.php?id=<?php echo $data['id']; ?>" >Delete</a>
                      || <a href="add_offer.php?id=<?php echo $data['id']; ?>">Edit</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
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
      href='view_offer.php?page=<?php echo ($page-1); ?>&title=<?php echo $search; ?>' 
      >Previous</a>

      <?php for($i = 1; $i <= $total_page; $i++) {
          echo "<a href='view_offer.php?page=$i&title=$search'>$i</a> ";
      } ?>
      <a <?php if ($page == $total_page) { echo 'style="pointer-events: none; opacity: 0.5;"'; } ?> href='view_offer.php?page=<?php echo ($page+1); ?>&title=<?php echo $search; ?>' 
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

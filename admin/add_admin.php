<?php 

   include("header.php");
   // session_start();
    if(!isset($_SESSION['userid'])) 
    { 
        header("location:index.php");
    }

    $pass = isset($_GET['id']); 

   $data = array();   

  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    $sql = "select * from `admin` where `id`=".$id;
    $res = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($res);
  }

  if(isset($_POST['submit']))
  {
      $email = $_POST['email'];
      $password = md5($_POST['password']);
      $image = $_FILES['image']['name'];
      $name = $_POST['name'];

      if($image=="")
      {
        $image=$data['image'];
      }else
      {
          $image = rand(10000,90000).'img'.$image;
          $path = "image/admin/".$image;
          move_uploaded_file($_FILES['image']['tmp_name'], $path);
      }

      $select = "select * from `admin` where `email`='$email'";
      $select_res = mysqli_query($con,$select);
      $select_rec = mysqli_num_rows($select_res);
      
       if (isset($_GET['id'])) {
        if($select_rec==0)
        {
        $id = $_GET['id'];

        $sql = "UPDATE admin SET  email='$email', image='$image',name='$name' WHERE id=$id"; 
        mysqli_query($con, $sql);
        
        if(isset($_SESSION['userid']) && $_SESSION['userid'] == $id)
        {
            header("location:logout.php");
        }
             }
             else{
          $sql = "UPDATE admin SET  s_image='$image',name='$name' WHERE id=$id";
           mysqli_query($con, $sql);
           $msg="email already exist you can't change it";
        }
           header("location:view_admin.php");
        
    } else {
      if($select_rec==0)
        {
             $sql = "INSERT INTO admin (email,password,s_image,name) VALUES ('$email','$password','$image','$name')";
             mysqli_query($con, $sql);
            header("location:view_admin.php");
        }else{
          $mss = "email already exist";
        }
    }
  }
?>


  <style type="text/css">
    #passwordd{
      display: <?php echo $pass? 'none' : 'block'; ?>
    }
  </style>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Admin</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <h2><?php echo @$msg; ?></h2>
    <h3><?php echo @$mss; ?></h3>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <form method="post" enctype="multipart/form-data" id="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo @$data['email'] ?>">
                    <span style="color: red; display: none;">Enter Email...!</span>
                  </div>
                  <div class="form-group" id="passwordd">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?php echo @$data['password'] ?>">
                    <span style="color: red; display: none;">Enter Password...!</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                  <div class="custom-file">
                      <input type="file" name="s_image" class="custom-file-input" id="image" attr_data="<?php echo isset($data['s_image']) ? $data['s_image'] : ''; ?>">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <?php if(isset($data['s_image'])): ?>
                      <div style="height:70px; width: 70px; overflow:hidden;">
                          <img src="image/admin/<?php echo $data['s_image']; ?>" alt="Profile Picture" style="height: 100%; width:100%; object-fit:cover;">
                      </div>
                  <?php endif; ?>
                </div>
                    <span style="color: red; display: none;" id="image_error">Enter Image...!</span>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?php echo @$data['name'] ?>">
                    <span style="color: red; display: none;">Enter name...!</span>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->

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
        var email= $('#email').val();
        var e_patten = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

        var password= $('#password').val();
        var p_patten= /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;

        if(!e_patten.test(email))
        {
            $('#email').next('span').css('display','inline')
            return false;
        }
        else
        {
            $('#email').next('span').css('display','none')
        }

        // if(!p_patten.test(password))
        // {
        //   $('#password').next('span').css('display','inline')
        //   return false;
        // }else
        // {
        //   $('#password').next('span').css('display','none')
        // }

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

        var name= $('#name').val();

          if(name=='')
          {
            $('#name').next('span').css('display','inline')
            return false;
          }else
          {
            $('#name').next('span').css('display','none')
          }
      
    })
});
</script>

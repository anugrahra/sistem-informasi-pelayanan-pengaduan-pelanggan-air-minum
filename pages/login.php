<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Admin Log In | UPT Air Minum Kota Cimahi</title>
</head>
  <body>

    <?php
    require_once "../core/init.php";
    require_once "../assets/view/loginnav.php";
    ?>

    <div class="container-fluid">
      
      <div class="row justify-content-center mt-5">
        <div class="col mt-5">
          <center><h1>Admin Log In</h1></center>
        </div>
      </div>

      <hr>
      <?php
      ob_start();
      session_start();
      if(isset($_SESSION['user'])){
        header('location: admin.php');
      }else{

      $eror='';
      if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if(!empty(trim($username) && !empty($password))){
          sistem_login($username, $password);
        }else{
          $eror = 'nama dan password harus diisi';
        }

      }
      ?>

      <div class="row justify-content-center">
        <div class="col-md-4">
          <?php echo $eror; ?>
          <form method="post">
            <div class="form-group">
              <label class="sr-only" for="username">Userame</label>
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
              <label class="sr-only" for="password">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <input type="submit" name="submit" value="Log In" class="btn btn-primary">
            <input type="reset" value="Batal" class="btn btn-danger">
          </form>
        </div>
      </div>

    </div> <!-- akhir container -->

    <footer class="text-white bg-dark fixed-bottom">
      <div class="container">
        <div class="row pt-3">
          <div class="col text-center">
            <p>UPT Air Minum Kota Cimahi &copy; 2018</p>
          </div>
        </div>
      </div>
    </footer>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
    <?php } ?>
    <?php
    mysqli_close($link);
    ob_end_flush();
    ?>
</html>
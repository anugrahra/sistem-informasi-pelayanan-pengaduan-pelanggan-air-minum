<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
  <title>Hapus Aduan | UPT Air Minum Kota Cimahi</title>
</head>
  <body>

    <?php
    require_once "../core/init.php";
    require_once "../assets/view/adminnav.php";
    ?>

    <div class="container-fluid">

      <?php
      ob_start();
      session_start();
      if(!isset($_SESSION['user'])) header('location:login.php');
      
      if(isset($_GET['id'])){
        if(hapus_aduan($_GET['id']) && hapus_tindak($_GET['id'])){
          echo '<div class="row mb-2 kepala">
        <div class="col text-center">
          &nbsp;<br>
          &nbsp;<br>
          &nbsp;<br>
          &nbsp;<br>
          <h3>Aduan berhasil dihapus</h3>
          <a class="btn btn-success btn-lg" href="admin.php">Kembali ke daftar aduan</a>
        </div>
      </div>';
        }
      }
      ?>

    </div> <!-- akhir container -->

<?php require_once "../assets/view/footeradmin.php"; ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
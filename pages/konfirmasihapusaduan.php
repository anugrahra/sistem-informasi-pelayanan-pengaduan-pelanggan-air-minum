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
    ob_start();
    session_start();
    if(!isset($_SESSION['user'])) header('location:login.php');
    require_once "../core/init.php";
    require_once "../assets/view/adminnav.php";
    ?>

    <div class="container-fluid">

      <?php
      $id = $_GET['id'];

      if(isset($_GET['id'])){
        $aduan = aduantunggal($id);
        while ($row = mysqli_fetch_assoc($aduan)){
          $nama = $row['nama'];
          $waktu_pengaduan = $row['waktu_pengaduan'];
        }
      }
      ?>

      <div class="row mb-2 kepala">
        <div class="col text-center">
          &nbsp;<br>
          &nbsp;<br>
          &nbsp;<br>
          &nbsp;<br>
          <h3>Apakah anda yakin akan menghapus aduan dengan atas nama <span style="color: green"><?=$nama;?></span> yang dikirim pada tanggal <span style="color: green"><?= date('d/m/Y', strtotime($waktu_pengaduan));?></span> pukul <span style="color: green"><?= date('H:i', strtotime($waktu_pengaduan));?></span> ?</h3>
          <a class="btn btn-danger btn-lg" href="hapusaduan.php?&id=<?=$id;?>">Hapus!</a>
          <a class="btn btn-success btn-lg" href="admin.php">Batal dan kembali ke daftar aduan</a>
        </div>
      </div>

    </div> <!-- akhir container -->

<?php require_once "../assets/view/footeradmin.php"; ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
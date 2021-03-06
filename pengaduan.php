<?php require_once "copyright/copyright.php"; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Form Pengaduan UPT Air Minum Kota Cimahi</title>
</head>
  <body>

  <?php
  require_once "assets/functions/db.php";
  require_once "assets/functions/fungsi.php";
  require_once "assets/view/mainnav.php";
  ?>

    <div class="container-fluid">

      <div class="row justify-content-center mb-2 kepala">
        <center><h1>Form Pengaduan Pelanggan UPT Air Minum Kota Cimahi</h1></center>
      </div>

      <hr>

      <div class="row justify-content-center mb-2">
        <div class="col-md-8">
          <div class="text-right"><i>Yang bertanda bintang (*) wajib diisi</i></div>
        </div>
      </div>

      <div class="row justify-content-center mb-3">
        <div class="col-md-8">

          <?php
          $error="";

          date_default_timezone_set('Asia/Jakarta');
          $waktusekarang = date('Y-m-d H:i:s');
          $sumberpengaduan = "Website";

          if(isset($_POST['submit'])){
            $sumber_pengaduan  = $sumberpengaduan;
            $no_pelanggan      = $_POST['no_pelanggan'];
            $nama              = $_POST['nama'];
            $telp              = $_POST['telp'];
            $email             = $_POST['email'];
            $alamat            = $_POST['alamat'];
            $jenis_pengaduan   = $_POST['jenis_pengaduan'];
            $aduan             = $_POST['aduan'];
            $waktu_pengaduan   = $waktusekarang;

            if(!empty($nama) && !empty($telp) && !empty($alamat) && !empty($jenis_pengaduan) && !empty($aduan)){
              if(tambah_aduan($sumber_pengaduan, $no_pelanggan, $nama, $telp, $email, $alamat, $jenis_pengaduan, $aduan, $waktu_pengaduan)){
                echo "<script>alert('Pengaduan anda sudah terkirim!');</script>";
              }else{
                $error = 'ada masalah ketika mengirim aduan';
              }
            }else{
              $error = 'yang bertanda bintang (*) wajib diisi';
            }
          }
          ?>

          <form action="" method="post">
            <div id="error"><?php echo $error; ?></div>
            <div class="form-group">
              <label for="nopelanggan">No Pelanggan</label> (Wajib diisi bagi pelanggan UPT Air Minum)
              <input type="number" class="form-control" name="no_pelanggan">
            </div>
            <div class="form-group">
              <label for="nama">Nama*</label>
              <input type="text" class="form-control" name="nama">
            </div>
            <div class="form-group">
              <label for="telp">No. Telp/HP*</label>
              <input type="number" class="form-control" name="telp">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat*</label>
              <textarea class="form-control" rows="2"  name="alamat"></textarea>
            </div>
            <div class="form-group">
              <label for="jenis_pengaduan">Jenis Aduan*</label>
              <select class="form-control" name="jenis_pengaduan">
                <option value="Perpipaan / Kebocoran Pipa">Perpipaan / Kebocoran Pipa</option>
                <option value="Kualitas Air">Kualitas Air</option>
                <option value="Sambungan Rumah / Meteran Air">Sambungan Rumah / Meteran Air</option>
                <option value="Rekening Air / Tagihan">Rekening Air / Tagihan</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
            <div class="form-group">
              <label for="aduan">Aduan*</label>
              <textarea class="form-control" rows="3" name="aduan"></textarea>
            </div>
            <input type="submit" name="submit" value="Kirim Aduan!" class="btn btn-primary">
            <button type="reset" class="btn btn-danger">Batal</button>
          </form>
        </div>
      </div>

    </div> <!-- akhir container -->

  <footer class="text-white bg-dark">
    <div class="container">
      <div class="row pt-3">
        <div class="col  text-center">
          <p>UPT Air Minum Kota Cimahi &copy; 2018</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
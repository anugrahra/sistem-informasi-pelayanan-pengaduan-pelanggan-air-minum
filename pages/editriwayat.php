<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

    <?php
    ob_start();
    session_start();
    if(!isset($_SESSION['user'])) header('location:login.php');

    require_once "../core/init.php";
    require_once "../assets/view/adminnav.php";

    $id = $_GET['id'];

    if(isset($_GET['id'])){
      $riwayat = riwayattunggal($id);
      if ($row = mysqli_fetch_assoc($riwayat)){
        $id_pengaduan             = $row['id_pengaduan'];
        $tindak_lanjut_awal       = $row['tindak_lanjut'];
        $hasil_tindak_lanjut_awal = $row['hasil_tindak_lanjut'];
        $status_pengaduan_awal    = $row['status_pengaduan'];
        $foto_dokumentasi_awal    = $row['foto_dokumentasi'];
        $foto_dokumentasi1_awal   = $row['foto_dokumentasi1'];
        $petugas_awal             = $row['petugas'];
        $petugas1_awal            = $row['petugas1'];
        $catatan_awal             = $row['catatan'];
        $tanggal_perbaikan_awal   = $row['tanggal_perbaikan'];
      }else{
        echo "ada yang salah";
      }
    }

    $id_untuk_data_pengaduan = settype($id_aduan, 'int');

    if(isset($_GET['id'])){
      $aduan = aduantunggal($id_untuk_data_pengaduan);
      if ($row = mysqli_fetch_assoc($aduan)){
        $nama         = $row['nama'];
        $no_pengaduan = $row['id'];
      }
    }

    $error = '';

    if(isset($_POST['submit'])){
      $tindak_lanjut       = $_POST['tindak_lanjut'];
      $hasil_tindak_lanjut = $_POST['hasil_tindak_lanjut'];
      $status_pengaduan    = $_POST['status_pengaduan'];
      $foto_dokumentasi    = $_POST['foto_dokumentasi'];
      $foto_dokumentasi1   = $_POST['foto_dokumentasi1'];
      $petugas             = $_POST['petugas'];
      $petugas1            = $_POST['petugas1'];
      $catatan             = $_POST['catatan'];
      $tanggal_perbaikan   = $_POST['tanggal_perbaikan'];

      if(edit_riwayat($tindak_lanjut, $hasil_tindak_lanjut, $status_pengaduan, $foto_dokumentasi, $foto_dokumentasi1, $petugas, $petugas1, $catatan, $tanggal_perbaikan, $id)){
        header('Location:riwayat.php?&id='.$id_pengaduan);
      }else{
        $error = 'ada masalah ketika mengedit aduan';
      }
    }
    ?>

      <title>Edit Riwayat <?=$nama;?> | SIPPPAM UPT Air Minum Kota Cimahi</title>
</head>
  <body>

    <div class="container-fluid">

      <div class="row mb-2 kepala">
        <div class="col text-center">
          <h3>EDIT RIWAYAT <?=$nama;?>. No Pengaduan <?=$no_pengaduan;?></h3>
        </div>
      </div>
      <?=$error;?>
      <div class="table-responsive daptar">
        <table class="table table-bordered table-striped">
          <tbody>
            <form action="" method="post">
              <tr>
                <th scope="row">Tindak Lanjut</th>
                <td><input class="form-control" type="text" name="tindak_lanjut" value="<?=$tindak_lanjut_awal;?>"></td>
              </tr>
              <tr>
                <th scope="row">Hasil Tindak Lanjut</th>
                <td><input class="form-control" type="text" name="hasil_tindak_lanjut" value="<?=$hasil_tindak_lanjut_awal;?>"></td>
              </tr>
              <tr>
                <th scope="row">Status Pengaduan</th>
                <td><!-- <input class="form-control" type="text" name="hasil_tindak_lanjut" value="<?=$hasil_tindak_lanjut_awal;?>"> --></td>
              </tr>
              <tr>
                <th scope="row">Foto Dokumentasi 1</th>
                <td><!-- <input class="form-control" type="text" name="hasil_tindak_lanjut" value="<?=$hasil_tindak_lanjut_awal;?>"> --></td>
              </tr>
              <tr>
                <th scope="row">Foto Dokumentasi 2</th>
                <td><!-- <input class="form-control" type="text" name="hasil_tindak_lanjut" value="<?=$hasil_tindak_lanjut_awal;?>"> --></td>
              </tr>
              <tr>
                <th scope="row">Petugas 1</th>
                <td><!-- <input class="form-control" type="text" name="hasil_tindak_lanjut" value="<?=$hasil_tindak_lanjut_awal;?>"> --></td>
              </tr>
              <tr>
                <th scope="row">Petugas 2</th>
                <td><!-- <input class="form-control" type="text" name="hasil_tindak_lanjut" value="<?=$hasil_tindak_lanjut_awal;?>"> --></td>
              </tr>
              <tr>
                <th scope="row">Catatan</th>
                <td><!-- <input class="form-control" type="text" name="hasil_tindak_lanjut" value="<?=$hasil_tindak_lanjut_awal;?>"> --></td>
              </tr>
              <tr>
                <th scope="row">Tanggal Perbaikan</th>
                <td><!-- <input class="form-control" type="text" name="hasil_tindak_lanjut" value="<?=$hasil_tindak_lanjut_awal;?>"> --></td>
              </tr>
              <tr>
                <th scope="row" colspan="2">
                  <button type="submit" name="submit" class="btn btn-warning">Edit Riwayat!</button>
                </th>
              </tr>
            </form>
          </tbody>
        </table>
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
</html>
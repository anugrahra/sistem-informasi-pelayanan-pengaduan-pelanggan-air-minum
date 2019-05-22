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
      $aduan = aduantunggal($id);
      if ($row = mysqli_fetch_assoc($aduan)){
        $id_aduan              = $row['id'];
        $no_pelanggan_awal     = $row['no_pelanggan'];
        $nama_awal             = $row['nama'];
        $telp_awal             = $row['telp'];
        $email_awal            = $row['email'];
        $alamat_awal           = $row['alamat'];
        $jenis_pengaduan_awal  = $row['jenis_pengaduan'];
        $aduan_awal            = $row['aduan'];
        $status_pengaduan_awal = $row['status_pengaduan'];
        $sumber_pengaduan_awal = $row['sumber_pengaduan'];
      }else{
        echo "ada yang salah";
      }
    }

    $error = '';

    if(isset($_POST['submit'])){
      $no_pelanggan     = $_POST['no_pelanggan'];
      $nama             = $_POST['nama'];
      $telp             = $_POST['telp'];
      $email            = $_POST['email'];
      $alamat           = $_POST['alamat'];
      $jenis_pengaduan  = $_POST['jenis_pengaduan'];
      $aduan            = $_POST['aduan'];
      $status_pengaduan = $_POST['status_pengaduan'];
      $sumber_pengaduan = $_POST['sumber_pengaduan'];

      if(edit_aduan($no_pelanggan, $nama, $telp, $email, $alamat, $jenis_pengaduan, $aduan, $status_pengaduan, $sumber_pengaduan, $id)){
        header('Location:riwayat.php?&id='.$id_aduan);
      }else{
        $error = 'ada masalah ketika mengedit aduan';
      }
    }
    ?>

      <title>Edit Aduan <?=$nama_awal;?> | SIPPPAM UPT Air Minum Kota Cimahi</title>
</head>
  <body>

    <div class="container-fluid">

      <div class="row mb-2 kepala">
        <div class="col text-center">
          <h3>EDIT PENGADUAN <?=$nama_awal;?></h3>
        </div>
      </div>
      <?=$error;?>
      <div class="table-responsive daptar">
        <table class="table table-bordered table-striped">
          <tbody>
            <form action="" method="post">
              <tr>
                <th scope="row">Sumber Pengaduan</th>
                <td>
                  <div class="form-group">
                    <select class="form-control" name="sumber_pengaduan">
                      <option value="<?=$sumber_pengaduan_awal;?>"><?=$sumber_pengaduan_awal;?></option>
                      <option value="Buku Pengaduan">Buku Pengaduan</option>
                      <option value="Tatap Muka">Tatap Muka</option>
                      <option value="Surat">Surat</option>
                      <option value="Email">Email</option>
                      <option value="Telepon">Telepon</option>
                      <option value="SMS">SMS</option>
                      <option value="Website">Website</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">No. Pelanggan</th>
                <td><input class="form-control" type="number" name="no_pelanggan" value="<?=$no_pelanggan_awal;?>"></td>
              </tr>
              <tr>
                <th scope="row">Nama</th>
                <td><input class="form-control" type="text" name="nama" value="<?=$nama_awal;?>"></td>
              </tr>
              <tr>
                <th scope="row">Telp</th>
                <td><input class="form-control" type="number" name="telp" value="<?=$telp_awal;?>"></td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td><input class="form-control" type="email" name="email" value="<?=$email_awal;?>"></td>
              </tr>
              <tr>
                <th scope="row">Alamat</th>
                <td><textarea class="form-control" name="alamat" rows="3" placeholder="Content"><?=$alamat_awal;?></textarea></td>
              </tr>
              <tr>
                <th scope="row">Jenis Pengaduan</th>
                <td>
                  <div class="form-group">
                    <select class="form-control" name="jenis_pengaduan">
                      <option value="<?=$jenis_pengaduan_awal;?>"><?=$jenis_pengaduan_awal;?></option>
                      <option value="Perpipaan / Kebocoran Pipa">Perpipaan / Kebocoran Pipa</option>
                      <option value="Kualitas Air">Kualitas Air</option>
                      <option value="Sambungan Rumah / Meteran Air">Sambungan Rumah / Meteran Air</option>
                      <option value="Rekening Air / Tagihan">Rekening Air / Tagihan</option>
                      <option value="Lainnya">Lainnya</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Aduan</th>
                <td><textarea class="form-control" name="aduan" rows="3" placeholder="Content"><?=$aduan_awal;?></textarea></td>
              </tr>
              <tr>
                <th scope="row">Status Pengaduan</th>
                <td>
                  <div class="form-group">
                    <select class="form-control" name="status_pengaduan">
                      <option value="<?=$status_pengaduan_awal;?>"><?=$status_pengaduan_awal;?></option>
                      <option value="Belum Selesai">Belum Selesai</option>
                      <option value="Selesai">Selesai</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row" colspan="2">
                  <button type="submit" name="submit" class="btn btn-warning">Edit Aduan!</button>
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
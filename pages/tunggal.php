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
        $waktu_pengaduan   = $row['waktu_pengaduan'];
        $no_pelanggan      = $row['no_pelanggan'];
        $nama              = $row['nama'];
        $telp              = $row['telp'];
        $email             = $row['email'];
        $alamat            = $row['alamat'];
        $jenis_pengaduan   = $row['jenis_pengaduan'];
        $aduan             = $row['aduan'];
      }else{echo "ada yang salah";}
    }
    ?>

      <title>Aduan <?=$nama;?> | Form Pengaduan UPT Air Minum Kota Cimahi</title>
</head>
  <body>

    <div class="container-fluid">

      <div class="row mb-2 kepala">
        <div class="col text-center">
          <h3>TINDAK LANJUT ADUAN</h3>
        </div>
      </div>

      <div class="table-responsive daptar">
        <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <th scope="row">Waktu Pengaduan</th>
              <td><?php echo date('l, j F Y', strtotime($waktu_pengaduan)); ?></td>
            </tr>
            <tr>
              <th scope="row">No. Pelanggan</th>
              <td><?php echo $no_pelanggan; ?></td>
            </tr>
            <tr>
              <th scope="row">Nama</th>
              <td><?php echo $nama; ?></td>
            </tr>
            <tr>
              <th scope="row">Telp</th>
              <td><?php echo $telp; ?></td>
            </tr>
            <tr>
              <th scope="row">Email</th>
              <td><?php echo $email; ?></td>
            </tr>
            <tr>
              <th scope="row">Alamat</th>
              <td><?php echo $alamat; ?></td>
            </tr>
            <tr>
              <th scope="row">Jenis Pengaduan</th>
              <td><?php echo $jenis_pengaduan; ?></td>
            </tr>
            <tr>
              <th scope="row">Aduan</th>
              <td><?php echo $aduan; ?></td>
            </tr>

            <?php
            $error ='';
            $ambil_id = $_GET['id'];
            if(isset($_POST['submit'])){
              $id_pengaduan        = $ambil_id;
              $tindak_lanjut       = $_POST['tindak_lanjut'];
              $hasil_tindak_lanjut = $_POST['hasil_tindak_lanjut'];
              $status_pengaduan    = $_POST['status_pengaduan'];
              $petugas             = $_POST['petugas'];
              $petugas1            = $_POST['petugas1'];
              $catatan             = $_POST['catatan'];
              $tanggal_perbaikan   = $_POST['tanggal_perbaikan'];

              $foto_dokumentasi    = $_FILES['foto_dokumentasi']['name'];
              $tmp   = $_FILES['foto_dokumentasi']['tmp_name'];
              $path  = "dokumentasi/".$foto_dokumentasi;

              move_uploaded_file($tmp, $path);

              $foto_dokumentasi1   = $_FILES['foto_dokumentasi1']['name'];
              $tmp1  = $_FILES['foto_dokumentasi1']['tmp_name'];
              $path1 = "dokumentasi/".$foto_dokumentasi1;

              move_uploaded_file($tmp1, $path1);

              if(laporkan($id_pengaduan, $tindak_lanjut, $hasil_tindak_lanjut, $status_pengaduan, $petugas, $petugas1, $catatan, $tanggal_perbaikan, $foto_dokumentasi, $foto_dokumentasi1) && laporkan_status($id_pengaduan, $status_pengaduan)){
                header("location:laporan.php?&id=$id_pengaduan");
              }else{
                $error = 'ada masalah ketika membuat laporan';
              }
            }
            ?>

            <form method="post" enctype="multipart/form-data">
              <?php echo $error; ?>
              <tr>
                <th scope="row"><label for="tindak_lanjut">Tindak Lanjut</label></th>
                <td><input type="text" class="form-control" name="tindak_lanjut" required></td>
              </tr>
              <tr>
                <th scope="row"><label for="hasil_tindak_lanjut">Hasil Tindak Lanjut</label></th>
                <td><input type="text" class="form-control" name="hasil_tindak_lanjut" required></td>
              </tr>
              <tr>
                <th scope="row"><label for="status_pengaduan">Status Pengaduan</label></th>
                <td>
                  <select class="form-control" name="status_pengaduan">
                    <option value="Belum Selesai">Belum Selesai</option>
                    <option value="Selesai">Selesai</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row"><label for="tanggal_perbaikan">Tanggal Pelaksanaan</label></th>
                <td><input type="date" class="form-control" name="tanggal_perbaikan" required></td>
              </tr>
              <tr>
                <th scope="row"><label for="foto_dokumentasi">Foto Dokumentasi 1</label></th>
                <td><input type="file" class="form-control" name="foto_dokumentasi"></td>
              </tr>
              <tr>
                <th scope="row"><label for="foto_dokumentasi1">Foto Dokumentasi 2</label></th>
                <td><input type="file" class="form-control" name="foto_dokumentasi1"></td>
              </tr>
              <tr>
                <th scope="row">Petugas 1</th>
                <td>
                  <div class="form-group">
                    <label for="petugas" class="sr-only">Petugas</label>
                    <select class="form-control" name="petugas" required>
                      <option value="Achmad Maulana">Achmad Maulana</option>
                      <option value="Adelia Meyleonita">Adelia Meyleonita</option>
                      <option value="Anugrah Ramadhan">Anugrah Ramadhan</option>
                      <option value="Asep Suarna">Asep Suarna</option>
                      <option value="Danny Rahardi Kusuma">Danny Rahardi Kusuma</option>
                      <option value="Dendy Yusetiadi">Dendy Yusetiadi</option>
                      <option value="Farhan Aditya Firani">Farhan Aditya Firani</option>
                      <option value="Ryan Febriaan">Riyan Febriaan</option>
                      <option value="Rizka Nurmalia">Rizka Nurmalia</option>
                      <option value="Saeful Rahman">Saeful Rahman</option>
                      <option value="Sofyan Nur Muhamad">Sofyan Nur Muhamad</option>
                      <option value="Yahya Zakariyya">Syarif Rudiyat</option>
                      <option value="Ujang Saepudin">Ujang Saepudin</option>
                      <option value="Yahya Zakariyya">Yahya Zakariyya</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Petugas 2</th>
                <td>
                  <div class="form-group">
                    <label for="petugas1" class="sr-only">Petugas 2</label>
                    <select class="form-control" name="petugas1">
                      <option value="Achmad Maulana">Achmad Maulana</option>
                      <option value="Adelia Meyleonita">Adelia Meyleonita</option>
                      <option value="Anugrah Ramadhan">Anugrah Ramadhan</option>
                      <option value="Asep Suarna">Asep Suarna</option>
                      <option value="Danny Rahardi Kusuma">Danny Rahardi Kusuma</option>
                      <option value="Dendy Yusetiadi">Dendy Yusetiadi</option>
                      <option value="Farhan Aditya Firani">Farhan Aditya Firani</option>
                      <option value="Ryan Febriaan">Riyan Febriaan</option>
                      <option value="Rizka Nurmalia">Rizka Nurmalia</option>
                      <option value="Saeful Rahman">Saeful Rahman</option>
                      <option value="Sofyan Nur Muhamad">Sofyan Nur Muhamad</option>
                      <option value="Yahya Zakariyya">Syarif Rudiyat</option>
                      <option value="Ujang Saepudin">Ujang Saepudin</option>
                      <option value="Yahya Zakariyya">Yahya Zakariyya</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row"><label for="catatan">Catatan</th>
                <td><textarea class="form-control" rows="3" name="catatan"></textarea></td>
              </tr>
              <tr>
                <th scope="row"></th>
                <td><input type="submit" name="submit" value="Laporkan!" class="btn btn-success"></td>
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
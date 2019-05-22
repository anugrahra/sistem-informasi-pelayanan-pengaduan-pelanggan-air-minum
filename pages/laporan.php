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
    
    $id           = $_GET['id'];
    $id_pengaduan = $_GET['id'];

    if(isset($_GET['id'])){

      $aduan  = aduantunggal($id);
      $tindak = tampilkanlaporan($id_pengaduan);

      if ($row = mysqli_fetch_array($aduan)){
        $waktu_pengaduan   = $row['waktu_pengaduan'];
        $sumber_pengaduan  = $row['sumber_pengaduan'];
        $no_pelanggan      = $row['no_pelanggan'];
        $nama              = $row['nama'];
        $telp              = $row['telp'];
        $email             = $row['email'];
        $alamat            = $row['alamat'];
        $jenis_pengaduan   = $row['jenis_pengaduan'];
        $aduan             = $row['aduan'];
      }

      $tindak_lanjut = '<i>Belum ada data</i>';
      $hasil_tindak_lanjut = '<i>Belum ada data</i>';
      $status_pengaduan = '<i>Belum ada data</i>';
      $petugas = '<i>Belum ada data</i>';
      $petugas1 = '<i>Belum ada data</i>';
      $catatan = '<i>Belum ada data</i>';
      $tanggal_perbaikan = '<i>Belum ada data</i>';
      $foto_dokumentasi = '<i>Belum ada data</i>';
      $foto_dokumentasi1 = '<i>Belum ada data</i>';

      while ($row = mysqli_fetch_array($tindak)){
        $tindak_lanjut       = $row['tindak_lanjut'];
        $hasil_tindak_lanjut = $row['hasil_tindak_lanjut'];
        $status_pengaduan    = $row['status_pengaduan'];
        $petugas             = $row['petugas'];
        $petugas1            = $row['petugas1'];
        $catatan             = $row['catatan'];
        $tanggal_perbaikan   = $row['tanggal_perbaikan'];
        $foto_dokumentasi    = $row['foto_dokumentasi'];
        $foto_dokumentasi1   = $row['foto_dokumentasi1'];
      }

    }
    ?>

  <title><?=$nama;?> | Status Pengaduan | Admin UPT Air Minum Kota Cimahi</title>
</head>
  <body>

    <div class="container-fluid">

      <div id="laporan">

        <div class="row mb-2 kepala">
          <div class="col text-center">
            <h3>LAPORAN HASIL PENGADUAN</h3>
          </div>
        </div>

        <div class="table-responsive daptar mb-0">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <th scope="row">Waktu Pengaduan</th>
                <td>
                  <?php
                  $tanggal = date('Y-m-d', strtotime($waktu_pengaduan));
                  echo tanggal_indo($tanggal, true);
                  ?>                    
                </td>
              </tr>
              <tr>
                <th scope="row">Sumber Pengaduan</th>
                <td><?php echo $sumber_pengaduan; ?></td>
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
              <tr>
                <th scope="row">Tindak Lanjut</th>
                <td><?php echo $tindak_lanjut; ?></td>
              </tr>
              <tr>
                <th scope="row">Hasil Tindak Lanjut</th>
                <td><?php echo $hasil_tindak_lanjut; ?></td>
              </tr>
              <tr>
                <th scope="row">Status Pengaduan</th>
                <td><?php echo $status_pengaduan; ?></td>
              </tr>
              <tr>
                <th scope="row">Tanggal Pelaksanaan</th>
                <td><?php echo date('l, j F Y', strtotime($tanggal_perbaikan)); ?></td>
              </tr>
              <tr>
                <th scope="row">Petugas 1</th>
                <td><?php echo $petugas; ?></td>
              </tr>
              <tr>
                <th scope="row">Petugas 2</th>
                <td><?php echo $petugas1; ?></td>
              </tr>
              <tr>
                <th scope="row">Catatan</th>
                <td><?php echo $catatan; ?></td>
              </tr>
              <tr>
                <th scope="row">Foto Dokumentasi</th>
                <td><?php echo "<img src='dokumentasi/".$foto_dokumentasi."' class='img-fluid fotodokumentasi'>"; ?>&nbsp;<?php echo "<img src='dokumentasi/".$foto_dokumentasi1."' class='img-fluid fotodokumentasi'>"; ?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <table class="ttd">
          <tr>
            <td class="text-center colttd">
              Mengetahui,<br>
              Kepala UPT Air Minum Kota Cimahi<br>
              <br>
              <br>
              <br>
              <br>
              <b>Dede Muhammad Asrori, SE., MM.</b><br>
              NIP. 19641129 199803 1 002      
            </td>
            <td class="text-center colttd">
              Cimahi, <?php echo date('j F Y'); ?><br>
              Dibuat oleh,<br>
              <br>
              <br>
              <br>
              <br>
              <b><?php echo $petugas; ?></b><br>
              &nbsp;
            </td>
          </tr>
        </table>

      </div> <!-- bagian akhir yang dicetak -->
      
      <div class="row justify-content-center bawah">
        <button class="btn btn-info" onclick="printContent('laporan')">Cetak Laporan</button>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a class="btn btn-dark" href="riwayat.php?&id=<?php echo $id_pengaduan;?>" role="button">Riwayat Pengaduan</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a class="btn btn-success" href="admin.php" role="button">Kembali Ke Daftar Pengaduan</a>
      </div>
    </div> <!-- akhir container -->

<?php require_once "../assets/view/footeradmin.php"; ?>

  <script>
    function printContent(laporan){
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(laporan).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
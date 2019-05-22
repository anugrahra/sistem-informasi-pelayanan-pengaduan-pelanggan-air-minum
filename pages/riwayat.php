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
        $no_pengaduan      = $row['id'];
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

    if ($_SESSION['user'] !== "superadministrator"){
      $akseshapusriwayat = "d-none";
    }else{
      $akseshapusriwayat = "";
    }
    ?>

  <title>Riwayat Pengaduan | UPT Air Minum Kota Cimahi</title>
</head>
  <body>

    <div class="container-fluid">

      <div class="row mb-2 kepala">
        <div class="col">
          <h3 style="text-transform: uppercase;">RIWAYAT PENGADUAN <?=$nama;?></h3>
        </div>
      </div>

      <div class="row pt-2 pb-2">
        <div class="col">
          <table class="table table-dark table-striped">
            <tbody>
              <tr>
                <th scope="row">No. Pengaduan</th>
                <td><?=$no_pengaduan;?></td>
              </tr>
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
                <th scope="row">Nama</th>
                <td><?=$nama;?></td>
              </tr>
              <tr>
                <th scope="row">Alamat</th>
                <td><?=$alamat;?></td>
              </tr>
              <tr>
                <th scope="row">Telp</th>
                <td><?=$telp;?></td>
              </tr>
              <tr>
                <th scope="row">Jenis Pengaduan</th>
                <td><?=$jenis_pengaduan;?></td>
              </tr>
              <tr>
                <th scope="row">Aduan</th>
                <td><?=$aduan;?></td>
              </tr>
              <tr class="<?=$akseshapusriwayat;?> table-warning">
                <th scope="row" colspan="2"><a class="btn btn-sm btn-danger" href="konfirmasihapusaduan.php?&id=<?php echo $row['id'];?>" role="button">Hapus Pengaduan</a>&nbsp;<a class="btn btn-sm btn-warning" href="editaduan.php?&id=<?php echo $row['id'];?>" role="button">Edit Pengaduan</a></th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <?php
      $id_pengaduan = $_GET['id'];
      $tindakan = tampilkanlaporan($id_pengaduan);
      ?>

      <div class="mb-2">
        <?php while($row = mysqli_fetch_assoc($tindakan)):?>
          <div class="row mb-3">
            <div class="col">
               <table class="table table-striped">
                 <thead>
                   <th scope="col" colspan="2" class="table-info">
                    <h2>
                      <?php
                      $tanggal = date('Y-m-d', strtotime($row['tanggal_perbaikan']));
                      echo tanggal_indo($tanggal, true);
                      ?>
                    </h2>
                   </th>
                 </thead>
                 <tbody>
                   <tr>
                     <th scope="row">Petugas</th>
                     <td><?=$row['petugas'];?>, <?=$row['petugas1'];?></td>
                   </tr>
                   <tr>
                     <th scope="row">Tindak Lanjut</th>
                     <td><?=$row['tindak_lanjut'];?></td>
                   </tr>
                   <tr>
                     <th scope="row">Hasil Tindak Lanjut</th>
                     <td><?=$row['hasil_tindak_lanjut'];?></td>
                   </tr>
                   <tr>
                     <th scope="row">Catatan</th>
                     <td><?=$row['catatan'];?></td>
                   </tr>
                   <tr>
                    <th scope="row">Foto Dokumentasi</th>
                    <td><?="<img src='dokumentasi/".$row['foto_dokumentasi']."' class='img-fluid fotodokumentasi'>";?>&nbsp;<?="<img src='dokumentasi/".$row['foto_dokumentasi1']."' class='img-fluid fotodokumentasi'>";?></td>
                   </tr>
                   <tr>
                     <th scope="row">Status</th>
                     <td><b style="text-transform: uppercase;"><?=$row['status_pengaduan'];?></b></td>
                   </tr>
                   <tr class="<?=$akseshapusriwayat;?> table-warning">
                     <th scope="row" colspan="2"><a class="btn btn-sm btn-danger" href="konfirmasihapusriwayat.php?&id=<?php echo $row['id'];?>" role="button">Hapus Riwayat</a><!-- &nbsp;<a class="btn btn-sm btn-warning" href="editriwayat.php?&id=<?php echo $row['id'];?>" role="button">Edit Riwayat</a> --></th>
                   </tr>
                 </tbody>
               </table>
               <hr>
             </div>
           </div>
        <?php endwhile; ?>
      </div>

      <div class="row bawah text-center">
        <div class="col">
          <a class="btn btn-info" href="laporan.php?&id=<?=$id_pengaduan;?>" role="button">Kembali Ke Laporan <?=$nama;?></a>
          <a class="btn btn-primary" href="admin.php" role="button">Kembali Ke Daftar Pengaduan</a>
        </div>
      </div>

    </div> <!-- akhir container -->

  <?php require_once "../assets/view/footeradmin.php"; ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
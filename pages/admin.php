<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <title>Admin | UPT Air Minum Kota Cimahi</title>
</head>
  <body>

    <?php
    ob_start();
    session_start();
    if(!isset($_SESSION['user'])) header('location:login.php');
    require_once "../assets/functions/db.php";
    require_once "../assets/view/adminnav.php";
    ?>

    <div class="container-fluid">

      <div class="row mb-3 kepala">
        <div class="col">
          <h3>
            <span class="sipppamtitle">SISTEM INFORMASI PENGELOLAAN PENGADUAN PELAYANAN AIR MINUM</span>
            <span class="sipppamtitles">SIPPPAM - DAFTAR PENGADUAN</span>
          </h3>
        </div>
      </div>

      <?php
      $per_page = 10;
      $page_now = 1;
      if(isset($_GET['page'])){
        $page_now = $_GET['page'];
        $page_now = ($page_now > 1) ? $page_now : 1;
      }
      $total_pengaduan = mysqli_num_rows(mysqli_query($link, "SELECT * FROM pengaduan"));
      $page_total = ceil($total_pengaduan/$per_page);
      $awal = ($page_now - 1) * $per_page;

      require_once "../assets/functions/fungsi.php";

      $nourut = $page_now * 10 - 9;

      $aduan  = tampilkanaduan();

      if(isset($_GET['cari'])){
        $cari   =  $_GET['cari'];
        $aduan  = hasil_cari($cari);
      }
 
      if ($_SESSION['user'] !== "superadministrator"){
        $akseshapus = "d-none";
      }else{
        $akseshapus = "";
      }

      $polabaru = 'asc';
      $pola = 'asc';

      if(isset($_GET['orderby'])){
        $pola = $_GET['pola'];
      }

        if($pola == 'asc'){
            $polabaru = 'desc';
        } else {
          $polabaru = 'asc';
        }
      ?>

      <div class="row mb-1">
        <div class="col-md-4">
          <form class="form-inline" action="" method="get">
            <div class="form-group mb-1">
              <label for="cari" class="sr-only">Cari Pengaduan</label>
              <input type="search" name="cari" class="form-control" placeholder="Cari pengaduan di sini">
            </div>
            &nbsp;
           <button class="btn btn-dark mb-1" type="submit">&#128269;</button>
          </form>
        </div>
        <div class="col-md-4 text-center">
          <a target="_blank" href="exportexcel.php" class="btn btn-success"><i class='far fa-file-excel'></i> Excel</a>
        </div>
        <div class="col-md-4 text-right daftaraduantitel">
          <h4>DAFTAR PENGADUAN</h4>
        </div>
      </div>

      <div class="row">
        <div class="table-responsive">
          <table class="table table-sm table-bordered table-striped tabeldaftarpengaduan">
            <thead class="thead-light">
              <tr>
                <th scope="col">No.</th>
                <th scope="col"><a href='admin.php?orderby=id&pola=<?=$polabaru;?>'>No.Pengaduan</a></th>
                <th scope="col"><a href='admin.php?orderby=waktu_pengaduan&pola=<?=$polabaru;?>'>Tanggal - Jam</a></th>
                <th scope="col"><a href='admin.php?orderby=sumber_pengaduan&pola=<?=$polabaru;?>'>Sumber</a></th>
                <th scope="col"><a href='admin.php?orderby=no_pelanggan&pola=<?=$polabaru;?>'>No. Pel</a></th>
                <th scope="col"><a href='admin.php?orderby=nama&pola=<?=$polabaru;?>'>Nama</a></th>
                <th scope="col"><a href='admin.php?orderby=telp&pola=<?=$polabaru;?>'>Phone</a></th>
                <th scope="col"><a href='admin.php?orderby=email&pola=<?=$polabaru;?>'>Email</a></th>
                <th scope="col"><a href='admin.php?orderby=alamat&pola=<?=$polabaru;?>'>Alamat</a></th>
                <th scope="col"><a href='admin.php?orderby=jenis_pengaduan&pola=<?=$polabaru;?>'>Jenis Aduan</a></th>
                <th scope="col"><a href='admin.php?orderby=aduan&pola=<?=$polabaru;?>'>Aduan</a></th>
                <th scope="col"><a href='admin.php?orderby=status_pengaduan&pola=<?=$polabaru;?>'>Status</a></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col" class="<?=$akseshapus;?>"></th>               
              </tr>
            </thead>
            <tbody>
               <?php while($row = mysqli_fetch_assoc($aduan)):?>
                 <tr>
                   <td><?php echo $nourut++; ?></td>
                   <td><?php echo $row['id']; ?></td>
                   <td><?php echo date('d/m/Y - H:i', strtotime($row['waktu_pengaduan']));?></td>
                   <td><?php echo $row['sumber_pengaduan']; ?></td>
                   <td><?php echo $row['no_pelanggan']; ?></td>
                   <td><?php echo $row['nama']; ?></td>
                   <td><?php echo $row['telp']; ?></td>
                   <td><a href="mailto:<?php echo $row['email']; ?>"><?php echo excerpt_email($row['email']); ?></td>
                   <td><?php echo $row['alamat']; ?></td>
                   <td><?php echo $row['jenis_pengaduan']; ?></td>
                   <td><?php echo $row['aduan']; ?></td>
                   <td>
                     <span style="color: blue; font-weight: bold;">
                       <a href="laporan.php?&id=<?php echo $row['id'];?>"><?php echo $row['status_pengaduan']; ?></a>
                     </span>
                   </td>

                   <?php
                   if ($row['status_pengaduan'] == "Selesai"){
                     $button = "disabled";
                     $warna = "dark";
                     $teks = "Selesai";
                   }else{
                     $button = "";
                     $warna = "warning";
                     $teks = "Tindak!";
                   }
                   ?>

                   <td>
                     <a class="btn btn-sm btn-<?=$warna;?> <?=$button;?>" href="tunggal.php?&id=<?php echo $row['id'];?>" role="button"><?=$teks;?></a>
                   </td>
                   <td>
                     <a class="btn btn-sm btn-info" href="laporan.php?&id=<?php echo $row['id'];?>" role="button">Status</a>
                   </td>
                   <td class="<?=$akseshapus;?>"><a class="btn btn-sm btn-danger" href="konfirmasihapusaduan.php?&id=<?php echo $row['id'];?>" role="button">Hapus</a>
                   </td>
                 </tr>
               <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row text-center bawah">
        <div class="col">
          <?php if(isset($page_total)) { ?>
            <?php if($page_total > 1) { ?>
              <?php if($page_now > 1) {?>
                <a href="admin.php?page=<?php echo $page_now - 1 ?>" role="button" class="btn btn-info">&lt; Sebelumnya</a>
                  <?php }else { ?>
                    <a href="" style="display: none;">Hilang</a>
                  <?php } ?>
                  <?php if($page_now < $page_total) {?>
                    <a href="admin.php?page=<?php echo $page_now + 1 ?>" role="button" class="btn btn-info">Selanjutnya &gt;</a>
                  <?php }else {?>
                    <a href="" style="display: none;">Hilang</a>
                  <?php } ?>
                </ul>
              </nav>
            <?php } ?>
          <?php } ?>
        </div>
      </div>

    </div> <!-- akhir container -->

  <?php require_once "../assets/view/footeradmin.php"; ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
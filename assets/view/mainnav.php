  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark sembunyi" id="napbars">
    <a class="navbar-brand" href="#">UPT Air Minum Kota Cimahi</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end text-center" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="index.php">Beranda</a>
        <a class="nav-item nav-link" href="index.php">Profil</a>
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Informasi
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="tarif.php">Tarif</a>
            <a class="dropdown-item" href="#">Cek Tagihan</a>
          </div>
        </div>
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pelayanan
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Pemasangan Baru</a>
            <a class="dropdown-item" href="#">Loket Pembayaran</a>
          </div>
        </div>
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pengaduan
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="pengaduan.php">Kirim Pesan Pengaduan</a>
          </div>
        </div>

        <?php
        if(isset($_SESSION['user'])){
          $textlog = 'Admin';
          $logout = '<a class="btn btn-danger" href="pages/logout.php" role="button">Log Out</a>'; 
        }else{
          $textlog = 'Log In';
          $logout = '';
        }
        ?>

        <a class="nav-item nav-link" href="kontak.php">Kontak Kami</a>
        <a class="nav-item nav-link" href="pages/login.php"><?=$textlog;?></a>
        <?=$logout;?>
      </div>
    </div>
  </nav>
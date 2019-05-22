<?php

function tampilkanaduan(){
	global $link, $awal, $per_page;

	$query = "SELECT * FROM pengaduan ORDER BY id DESC LIMIT $awal, $per_page";

      $pola='asc';
      $polabaru='asc';

      if(isset($_GET['orderby'])){
        $orderby=$_GET['orderby'];
        $pola=$_GET['pola'];

        $query = "SELECT * FROM pengaduan ORDER BY $orderby $pola LIMIT $awal, $per_page";
      }

	$result = mysqli_query($link, $query) or die ('gagal menampilkan daftar aduan');

	return $result;
}

function tampilkanaduanexcel(){
	global $link;

	$query = "SELECT * FROM pengaduan ORDER BY id DESC";
	$result = mysqli_query($link, $query) or die ('gagal menampilkan daftar aduan');

	return $result;	
}

function hasil_cari($cari){
	global $link, $awal, $per_page;

	$query = "SELECT * FROM pengaduan WHERE nama LIKE '%$cari%' OR no_pelanggan LIKE '%$cari%' OR telp LIKE '%$cari%' OR email LIKE '%$cari%' OR alamat LIKE '%$cari%' OR jenis_pengaduan LIKE '%$cari%' OR aduan LIKE '%$cari%' OR waktu_pengaduan LIKE '%$cari%' OR sumber_pengaduan LIKE '%$cari%' OR status_pengaduan LIKE '$cari'";
	$result = mysqli_query($link, $query) or die ('gagal menampilkan daftar aduan');
	
	return $result;
}

function opsi_tampil($opsi){
	global $link, $awal, $per_page;

	$query = "SELECT * FROM pengaduan WHERE status_pengaduan LIKE '$opsi' OR no_pelanggan LIKE '%$cari%' OR telp LIKE '%$cari%' OR email LIKE '%$cari%' OR alamat LIKE '%$cari%' OR jenis_pengaduan LIKE '%$cari%' OR aduan LIKE '%$cari%' OR waktu_pengaduan LIKE '%$cari%' OR sumber_pengaduan LIKE '%$cari%' OR status_pengaduan LIKE '$cari'";
	$result = mysqli_query($link, $query) or die ('gagal menampilkan daftar aduan');
	
	return $result;
}

function tampilkanlaporan($id_pengaduan){
	global $link;

	$query = "SELECT * FROM tindak WHERE id_pengaduan=$id_pengaduan";
	$result = mysqli_query($link, $query) or die ('gagal menampilkan hasil tindak sebuah laporan');

	return $result;
}

function aduantunggal($id){
	global $link;

	$query = "SELECT * FROM pengaduan WHERE id=$id";
	$result = mysqli_query($link, $query);

	return $result;
}

function riwayattunggal($id){
	global $link;

	$query = "SELECT * FROM tindak WHERE id=$id";
	$result = mysqli_query($link, $query) or die ('gagal menampilkan hasil data tindak');

	return $result;
}

function tambah_aduan($sumber_pengaduan, $no_pelanggan, $nama, $telp, $email, $alamat, $jenisaduan, $aduan, $waktu_pengaduan){
	$nama = escape($nama);
	$alamat = escape($alamat);
	$aduan = escape($aduan);

	$query = "INSERT INTO pengaduan (sumber_pengaduan, no_pelanggan, nama, telp, email, alamat, jenis_pengaduan, aduan, waktu_pengaduan) VALUES ('$sumber_pengaduan', '$no_pelanggan', '$nama', '$telp', '$email', '$alamat', '$jenisaduan', '$aduan', '$waktu_pengaduan')";

	return run($query);
}

function hapus_aduan($id){
	$query = "DELETE FROM pengaduan WHERE id=$id";

	return run($query);
}

function hapus_riwayat($id){
	$query = "DELETE FROM tindak WHERE id=$id";

	return run($query);
}

function hapus_tindak($id){
	$query = "DELETE FROM tindak WHERE id_pengaduan=$id";

	return run($query);
}

function laporkan($id_pengaduan, $tindak_lanjut, $hasil_tindak_lanjut, $status_pengaduan, $petugas, $petugas1, $catatan, $tanggal_perbaikan, $foto_dokumentasi, $foto_dokumentasi1){
	$tindak_lanjut = escape($tindak_lanjut);
	$hasil_tindak_lanjut = escape($hasil_tindak_lanjut);
	$catatan = escape($catatan);

	$query = "INSERT INTO tindak (id_pengaduan, tindak_lanjut, hasil_tindak_lanjut, status_pengaduan, petugas, petugas1, catatan, tanggal_perbaikan, foto_dokumentasi, foto_dokumentasi1) VALUES ('$id_pengaduan', '$tindak_lanjut', '$hasil_tindak_lanjut', '$status_pengaduan', '$petugas', '$petugas1', '$catatan', '$tanggal_perbaikan', '$foto_dokumentasi', '$foto_dokumentasi1')";
	
	return run($query);
}

function laporkan_status($id_pengaduan, $status_pengaduan){
	$query = "UPDATE pengaduan SET status_pengaduan='$status_pengaduan' WHERE id='$id_pengaduan'";

	return run($query);
}

function edit_aduan($no_pelanggan, $nama, $telp, $email, $alamat, $jenis_pengaduan, $aduan, $status_pengaduan, $sumber_pengaduan, $id){
	$query = "UPDATE pengaduan SET no_pelanggan=$no_pelanggan, nama='$nama', telp=$telp, email='$email', alamat='$alamat', jenis_pengaduan='$jenis_pengaduan', aduan='$aduan', status_pengaduan='$status_pengaduan', sumber_pengaduan='$sumber_pengaduan' WHERE id=$id";

	return run($query);
}

function edit_riwayat($tindak_lanjut, $hasil_tindak_lanjut, $status_pengaduan, $foto_dokumentasi, $foto_dokumentasi1, $petugas, $petugas1, $catatan, $tanggal_perbaikan, $id){
	$query = "UPDATE tindak SET tindak_lanjut='$tindak_lanjut', hasil_tindak_lanjut='$hasil_tindak_lanjut', status_pengaduan='$status_pengaduan', foto_dokumentasi='$foto_dokumentasi, foto_dokumentasi1='$foto_dokumentasi1', petugas='$petugas', petugas1='$petugas1', catatan='$catatan', tanggal_perbaikan='$tanggal_perbaikan' WHERE id=$id";

	return run($query);
}

function sistem_login($username, $password){
	$username = escape($username);
	$password = escape($password);

	$query = "SELECT * FROM akun WHERE username = '$username' AND password = '$password'";
	global $link;

	if($result = mysqli_query($link, $query)){
		if(mysqli_num_rows($result) > 0 ){
			$row_akun = mysqli_fetch_array($result);
			$_SESSION['id'] = $row_akun['id'];
			$_SESSION['user'] = $row_akun['username'];
			header('location: admin.php');
		}else{
			echo "Username / Password yang anda masukkan salah";
		}
	}
}

function run($query){
	global $link;

	if(mysqli_query($link, $query)) return true;
	else return false;
}

function excerpt_email($string){
	$string = substr($string, 0, 5);
	return $string . "...";
}

function escape($data){
	global $link;
	return mysqli_real_escape_string($link, $data);
}

function tanggal_indo($tanggal, $cetak_hari = false){
	$hari = array ( 1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');

	$bulan = array ( 1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

	$split = explode('-', $tanggal);
	$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

	if($cetak_hari){
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}
?>
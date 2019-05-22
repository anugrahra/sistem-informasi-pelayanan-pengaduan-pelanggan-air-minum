<!DOCTYPE HTML>
<html>
<head>
	<title>Export Data Pengaduan Ke Excel</title>
</head>
<body>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
		table{
			margin: 20px auto;
			border-collapse: collapse;
		}
		table th,
		table td{
			border: 1px solid #3c3c3c;
			padding: 3px 8px;
	 
		}
		a{
			background: blue;
			color: #fff;
			padding: 8px 10px;
			text-decoration: none;
			border-radius: 2px;
		}
	</style>
 
	<?php
    require_once "../assets/functions/db.php";
    require_once "../assets/functions/fungsi.php";
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Daftar_Pengaduan.xls");

	$aduan = tampilkanaduanexcel();
	$nourut = 1;
	?>
 
	<center>
		<h1>DAFTAR PENGADUAN PELANGGAN<br/> UPTD AIR MINUM KOTA CIMAHI</h1>
	</center>
 
	<table border="1">
		<tr>
            <th>No.</th>
            <th>No. Pengaduan</th>
            <th>Tanggal - Jam</th>
            <th>Sumber</th>
            <th>No. Pel</th>
            <th>Nama</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Jenis Aduan</th>
            <th>Aduan</th>
            <th>Status</th>
		</tr>
		
		<?php while($row = mysqli_fetch_assoc($aduan)):?>
		<tr>
			<td><?php echo $nourut++; ?></td>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo date('d/m/Y - H:i', strtotime($row['waktu_pengaduan']));?></td>
			<td><?php echo $row['sumber_pengaduan']; ?></td>
			<td><?php echo $row['no_pelanggan']; ?></td>
			<td><?php echo $row['nama']; ?></td>
			<td><?php echo "'" . $row['telp']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['alamat']; ?></td>
			<td><?php echo $row['jenis_pengaduan']; ?></td>
			<td><?php echo $row['aduan']; ?></td>
			<td><?php echo $row['status_pengaduan']; ?></td>
		</tr>
		<?php endwhile; ?>

	</table>
</body>
</html>
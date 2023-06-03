<?php 
$nis = $_GET['nis'];
$koneksi = oci_connect('C##ARIEL','ARIEL','localhost');
// if (empty($koneksi)) {
// 	echo "gagal";
// }
// else
// {
// 	echo "sukses";
// }

$statement = oci_parse($koneksi, "SELECT * FROM SISWA WHERE NIS = '$nis'");
oci_execute($statement);


$detail = oci_fetch_array($statement);


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Detail </title>
</head>
<body>

	<h1><?php echo $detail['NAMA_SISWA']; ?></h1>
	<p><?php echo $detail['ALAMAT_SISWA']->load(); ?></p>
	<p><?php echo $detail['JK_SISWA']; ?></p>
	<div>
		<img src="assets/foto/<?php echo $detail['FOTO_SISWA']; ?>" width="300">

	</div>

</body>
</html>
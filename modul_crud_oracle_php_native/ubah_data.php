<?php 

$koneksi = oci_connect('C##ARIEL','ARIEL','localhost/xe');
$nis = $_GET['nis'];


// if (!empty($koneksi)) {
// 	echo "koneksi sukses";
// }
// else
// {
// 	echo "koneksi gagal";	
// }

$statement = oci_parse($koneksi, "SELECT * FROM SISWA WHERE NIS='$nis'");

oci_execute($statement);

$detail = oci_fetch_array($statement);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ubah Data</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body>

	<div class="container">
		<h1>Ubah Data</h1>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<form method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label>NIS</label>
						<input type="number" name="NIS" class="form-control" value="<?php echo $detail['NIS']; ?>">
					</div>
					<div class="mb-3">
						<label>Nama</label>
						<input type="text" name="NAMA_SISWA" class="form-control" value="<?php echo $detail['NAMA_SISWA']; ?>">
					</div>
					<div class="mb-3">
						<label>Alamat</label>
						<textarea class="form-control" name="ALAMAT_SISWA"><?php echo $detail['ALAMAT_SISWA']->load(); ?></textarea>
					</div>
					<div class="mb-3">
						<label>Alamat</label>
						<select class="form-control" name="JK_SISWA">
							<option class="text-muted">pilih jenis kelamin</option>
							<option class="Laki-laki" <?php if ($detail['JK_SISWA']=="Laki-laki") {
								echo "selected";
							} ?>>Laki-laki</option>
							<option class="Permepuan" <?php if ($detail['JK_SISWA']=='Perempuan') {
								echo "selected";
							} ?>>Perempuan</option>
						</select>
					</div>
					<div class="mb-3">
						<label>Foto lama</label>
						<br>
						<img src="assets/foto/<?php echo $detail['FOTO_SISWA']; ?>" width="100">
					</div>
					<div class="mb-3">
						<label>Foto</label>
						<input type="file" name="FOTO_SISWA" class="form-control">
					</div>
					<button name="simpan" class="btn btn-primary">SIMPAN</button>
				</form>
			</div>
		</div>
	</div>

</body>
</html>
<?php 
if (isset($_POST['simpan'])) {
	$nis_siswa = $_POST['NIS'];
	$nama = $_POST['NAMA_SISWA'];
	$alamat = $_POST['ALAMAT_SISWA'];
	$jk = $_POST['JK_SISWA'];

	$namafoto = $_FILES['FOTO_SISWA']['name'];
	$filefoto = $_FILES['FOTO_SISWA']['tmp_name'];

	if (empty($filefoto)) {
		

		$query = "UPDATE SISWA SET NAMA_SISWA='$nama',
		ALAMAT_SISWA='$alamat',
		JK_SISWA='$jk',
		NIS='$nis_siswa' WHERE NIS='$nis'";

		$statement = oci_parse($koneksi,$query);	



		oci_execute($statement);

		echo "<script>alert('Data Berhasil Di Ubah')</script>";
		echo "<script>location='tampil_data.php'</script>";	
	}
	else
	{
		move_uploaded_file($filefoto, "assets/foto/$namafoto");

		$query1 = "UPDATE SISWA SET NAMA_SISWA = '$nama',
		ALAMAT_SISWA = '$alamat',
		JK_SISWA = '$jk',
		FOTO_SISWA = '$namafoto',
		NIS = '$nis_siswa' WHERE NIS='$nis'";

		$statement = oci_parse($koneksi,$query1);

		oci_execute($statement);

		echo "<script>alert('Data Berhasil Di Ubah')</script>";
		echo "<script>location='tampil_data.php'</script>";	
	}
	
	oci_close($koneksi);

}

?>
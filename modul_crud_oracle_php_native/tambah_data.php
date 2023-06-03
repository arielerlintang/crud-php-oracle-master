<?php 

$koneksi = oci_connect('C##ARIEL','ARIEL','localhost/xe') or die('connection failed !');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tambah Data</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body>

	<div class="container">
		<h1>Tambah Data</h1>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<form method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label>NIS</label>
						<input type="number" name="NIS" class="form-control">
					</div>
					<div class="mb-3">
						<label>Nama</label>
						<input type="text" name="NAMA_SISWA" class="form-control">
					</div>
					<div class="mb-3">
						<label>Alamat</label>
						<textarea class="form-control" name="ALAMAT_SISWA"></textarea>
					</div>
					<div class="mb-3">
						<label>Alamat</label>
						<select class="form-control" name="JK_SISWA">
							<option class="text-muted">pilih jenis kelamin</option>
							<option class="Laki-laki">Laki-laki</option>
							<option class="Permepuan">Perempuan</option>
						</select>
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
	$nis = $_POST['NIS'];
	$nama = $_POST['NAMA_SISWA'];
	$alamat = $_POST['ALAMAT_SISWA'];
	$jk = $_POST['JK_SISWA'];

	$namafoto = $_FILES['FOTO_SISWA']['name'];
	$filefoto = $_FILES['FOTO_SISWA']['tmp_name'];

	move_uploaded_file($filefoto, "assets/foto/$namafoto");

	$query = "INSERT INTO SISWA(NAMA_SISWA,ALAMAT_SISWA,JK_SISWA,FOTO_SISWA,NIS) VALUES('$nama','$alamat','$jk','$namafoto','$nis')";
	

	// Pernyataan SQL dieksekusi menggunakan fungsi oci_parse dan oci_execute. 
	$statement = oci_parse($koneksi,$query);
	oci_execute($statement);

	// Kemudian, perubahan yang dilakukan pada database dikonfirmasi menggunakan oci_commit.
	oci_commit($koneksi);
	// Setelah itu, statement dieksekusi, kemudian ditutup menggunakan oci_free_statement, 
	oci_free_statement($statement);

	// koneksi ke database ditutup menggunakan oci_close.
	oci_close($koneksi);

	echo "<script>alert('Data Berhasil Di Tambahkan')</script>";
	echo "<script>location='tampil_data.php'</script>";

}

?>

<?php 
// koneksi ke database oracle / sql developer
// koneksi ke database 'username/nama_pengguna',sandi pengguna, alamat serve
$koneksi = oci_connect('C##ARIEL','ARIEL','localhost');

// untuk ngecek apakah sudah terhubung
// if (!empty($koneksi)) {
// 	echo "koneksi sukses";
// }
// else
// {
// 	echo "koneksi gagal";	
// }
// dilakukan persiapan pernyataan SQL menggunakan fungsi oci_parse
$statement = oci_parse($koneksi, 'SELECT * FROM SISWA');

// pernyataan SQL dieksekusi menggunakan fungsi
oci_execute($statement);

//Dibuat sebuah array kosong bernama $siswa untuk menyimpan data siswa yang akan diambil dari database.
$siswa = array();

// Dalam loop while, menggunakan fungsi oci_fetch_array untuk mengambil setiap baris hasil query dari database. Setiap baris disimpan ke dalam array $siswa menggunakan sintaks $siswa[] = $detail.
while($detail = oci_fetch_array($statement))
{
	$siswa[] = $detail;
	
}
// echo "<pre>";
// print_r($siswa);
// echo "</pre>";




?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body>

	<div class="container">
		<h1>Data Siswa</h1>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>NIS</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Jenis Keelamin</th>
					<th>Foto</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($siswa as $key => $value): ?>
					<tr>
						
						<td><?php echo $key+1; ?></td>
						<td><?php echo $value['NAMA_SISWA'] ?></td>
						<!-- 
							->load() adalah metode yang digunakan untuk memuat (load) isi dari objek LOB (Large Object). Pada contoh ini, 'ALAMAT_SISWA' mungkin merupakan kolom yang memiliki tipe data LOB, seperti CLOB (Character LOB) atau BLOB (Binary LOB).

							Dengan menggunakan ->load(), Anda dapat mengakses isi LOB dan mencetaknya dalam output HTML. Metode load() akan mengambil dan mengembalikan isi LOB dari kolom tersebut.
						 -->
						<td><?php echo $value['ALAMAT_SISWA']->load();?></td>
					<td><?php echo $value['JK_SISWA'] ?></td>
					<td><img src="assets/foto/<?php echo $value['FOTO_SISWA'] ?>" width="100"></td>
					<td nowrap="nowrap">
						<a href="detail_data.php?nis=<?php echo $value['NIS']; ?>" class="btn btn-info btn-sm">Detail</a>
						<a href="ubah_data.php?nis=<?php echo $value['NIS'] ?>" class="btn btn-warning btn-sm">Ubah</a>
						<a href="hapus_data.php?nis=<?php echo $value['NIS'] ?>" class="btn btn-danger btn-sm">Hapus</a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<a href="tambah_data.php" class="btn btn-primary">Tambah Data</a>
</div>

</body>
</html>

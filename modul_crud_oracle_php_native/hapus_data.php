<?php 
$nis = $_GET['nis'];
$koneksi = oci_connect('C##ARIEL','ARIEL','localhost/xe');

$statement = oci_parse($koneksi,"delete from SISWA where nis = '$nis'");
 oci_execute($statement);

oci_close($koneksi);

echo "<script>alert('Data Berhasil Di Hapus')</script>";
echo "<script>location='tampil_data.php'</script>";

?>
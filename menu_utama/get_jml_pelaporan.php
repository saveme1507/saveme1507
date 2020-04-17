<?php
include "../koneksi.php";

$mp_nama = $_GET['mp_nama'];
class msn
{
}

$query1 = mysqli_query($con, "SELECT COUNT(laporan_kerusakan.lk_status) AS jml FROM laporan_kerusakan INNER JOIN master_user ON laporan_kerusakan.lk_id_pelapor=master_user.mu_id INNER JOIN master_perusahaan ON master_user.mu_id_pt=master_perusahaan.mp_id WHERE lk_status='Pending' AND master_perusahaan.mp_nama LIKE '%" . $mp_nama . "%' ");
$row1 = mysqli_fetch_array($query1);

$query2 = mysqli_query($con, "SELECT COUNT(laporan_kerusakan.lk_status) AS jml FROM laporan_kerusakan INNER JOIN master_user ON laporan_kerusakan.lk_id_pelapor=master_user.mu_id INNER JOIN master_perusahaan ON master_user.mu_id_pt=master_perusahaan.mp_id WHERE lk_status='Proses' AND master_perusahaan.mp_nama LIKE '%" . $mp_nama . "%' ");
$row2 = mysqli_fetch_array($query2);

$response = new msn();
$response->pending = $row1['jml'];
$response->proses = $row2['jml'];
die(json_encode($response));

mysqli_close($con);

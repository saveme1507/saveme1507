<?php
include "../koneksi.php";

$status = $_GET['status'];
$mp_nama = $_GET['mp_nama'];

$query = mysqli_query($con, "SELECT laporan_kerusakan.lk_id, laporan_kerusakan.lk_tgl, laporan_kerusakan.lk_ket, laporan_kerusakan.lk_status, laporan_kerusakan.lk_update,laporan_kerusakan.lk_id_hlm AS hlm_id, laporan_kerusakan.lk_id_pelapor AS mu_id, master_user.mu_nama, master_perusahaan.mp_id, master_perusahaan.mp_nama FROM laporan_kerusakan INNER JOIN master_user ON laporan_kerusakan.lk_id_pelapor=master_user.mu_id INNER JOIN master_perusahaan ON master_user.mu_id_pt=master_perusahaan.mp_id WHERE laporan_kerusakan.lk_status LIKE '%" . $status . "%' AND master_perusahaan.mp_nama LIKE '%" . $mp_nama . "%' ORDER BY lk_id DESC");

$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);

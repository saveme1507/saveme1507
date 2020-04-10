<?php
include "../koneksi.php";

$pt = $_GET["nama_pt"];

$query = mysqli_query($con, "SELECT master_mesin.mm_id,master_mesin.mm_sn,master_mesin.mm_tipe,master_mesin.mm_posisi,master_mesin.mm_last_pm,master_perusahaan.mp_id FROM master_mesin INNER JOIN master_perusahaan ON master_mesin.mm_id_pt=master_perusahaan.mp_id WHERE master_perusahaan.mp_nama LIKE '%" . $pt . "%'");

$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);

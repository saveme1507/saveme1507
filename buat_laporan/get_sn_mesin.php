<?php
include "../koneksi.php";

$mm_id = $_GET['dlm_id'];

$query = mysqli_query($con, "SELECT master_mesin.mm_sn FROM detail_laporan_mesin INNER JOIN master_mesin ON detail_laporan_mesin.dlm_id_mesin=master_mesin.mm_id WHERE detail_laporan_mesin.dlm_id=" . $mm_id);

$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);

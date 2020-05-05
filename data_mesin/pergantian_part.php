<?php
include "../koneksi.php";

$mm_id = $_GET['mm_id'];

$query = mysqli_query($con, "SELECT hs_id,hs_tgl,hs_nama FROM histori_sparepart WHERE hs_id_mesin=" . $mm_id);

$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);



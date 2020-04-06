<?php
include "../koneksi.php";

$id_mesin = $_GET["id_mesin"];

$query = mysqli_query($con, "SELECT header_laporan_mesin.hlm_id, header_laporan_mesin.hlm_tanggal FROM header_laporan_mesin INNER JOIN detail_laporan_mesin ON header_laporan_mesin.hlm_id=detail_laporan_mesin.dlm_id WHERE detail_laporan_mesin.dlm_id_mesin=" . $id_mesin . " AND header_laporan_mesin.hlm_pengerjaan='pm'");

$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);

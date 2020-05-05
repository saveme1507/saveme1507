<?php
include "../koneksi.php";

$mp_id  = $_GET['mp_id'];

if ($mp_id != 1) {
    $query = mysqli_query($con, "SELECT header_laporan_mesin.hlm_id,header_laporan_mesin.hlm_tanggal,master_mesin.mm_sn,header_laporan_mesin.hlm_ttd FROM header_laporan_mesin INNER JOIN detail_laporan_mesin ON header_laporan_mesin.hlm_id=detail_laporan_mesin.dlm_id INNER JOIN master_mesin ON master_mesin.mm_id = detail_laporan_mesin.dlm_id_mesin WHERE  header_laporan_mesin.hlm_id_teknisi != 0 AND header_laporan_mesin.hlm_id_perusahaan LIKE'" . $mp_id . "' ORDER BY hlm_id DESC");
} else {
    $query = mysqli_query($con, "SELECT header_laporan_mesin.hlm_id,header_laporan_mesin.hlm_tanggal,master_mesin.mm_sn,header_laporan_mesin.hlm_ttd FROM header_laporan_mesin INNER JOIN detail_laporan_mesin ON header_laporan_mesin.hlm_id=detail_laporan_mesin.dlm_id INNER JOIN master_mesin ON master_mesin.mm_id = detail_laporan_mesin.dlm_id_mesin WHERE  header_laporan_mesin.hlm_id_teknisi != 0 ORDER BY hlm_id DESC");
}

$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);

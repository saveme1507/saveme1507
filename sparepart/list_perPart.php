<?php
include "../koneksi.php";

$mp_id  = $_GET['mp_id'];

if ($mp_id != 1) {
    $query = mysqli_query($con, "SELECT histori_sparepart.hs_id,histori_sparepart.hs_tgl,master_mesin.mm_sn,histori_sparepart.hs_ttd FROM histori_sparepart INNER JOIN master_mesin ON histori_sparepart.hs_id_mesin=master_mesin.mm_id WHERE master_mesin.mm_id_pt LIKE'" . $mp_id . "' ORDER BY hs_id DESC");
} else {
    $query = mysqli_query($con, "SELECT histori_sparepart.hs_id,histori_sparepart.hs_tgl,master_mesin.mm_sn,histori_sparepart.hs_ttd FROM histori_sparepart INNER JOIN master_mesin ON histori_sparepart.hs_id_mesin=master_mesin.mm_id ORDER BY hs_id DESC");
}


$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);

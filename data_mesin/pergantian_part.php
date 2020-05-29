<?php
include "../koneksi.php";

$mm_id = $_GET['mm_id'];


$query_mpId = mysqli_query($con, "SELECT @mm_id_pt:= mm_id_pt FROM master_mesin WHERE mm_id=" . $mm_id);
$query_mpNama = mysqli_query($con, "SELECT mp_nama FROM master_perusahaan WHERE mp_id=@mm_id_pt");
$query = mysqli_query($con, "SELECT hs_id,hs_tgl,hs_pn, hs_nama FROM histori_sparepart WHERE hs_id_mesin=" . $mm_id);

$mp_nama = mysqli_fetch_row($query_mpNama);

$json = array();
while ($row = mysqli_fetch_assoc($query)) {
    $row["mp_nama"] = $mp_nama[0];
    $json[] = $row;
}
echo json_encode($json);

mysqli_close($con);

<?php
include "../koneksi.php";

$id_pt = $_GET['id_pt'];

$query = mysqli_query($con, "SELECT mm_id, mm_sn, mm_posisi FROM master_mesin WHERE mm_id_pt LIKE '%" . $id_pt . "%'");

$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);

<?php
include "../koneksi.php";

$dlm_id  = $_GET['dlm_id'];

$query = mysqli_query($con, "SELECT * FROM detail_laporan_mesin WHERE dlm_id=" . $dlm_id);

$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);

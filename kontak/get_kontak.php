<?php
include "../koneksi.php";

$query = mysqli_query($con, "SELECT mu_nama,mu_flag,mu_telp,mu_email FROM master_user WHERE mu_flag!=0");

$json = array();

while ($row = mysqli_fetch_assoc($query)) {
    $json[] = $row;
}

echo json_encode($json);

mysqli_close($con);

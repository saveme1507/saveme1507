<?php
include "../koneksi.php";

$id     = $_POST['mu_id'];
$token = $_POST['mu_token'];

class mesin
{
}

$query = mysqli_query($con, "UPDATE master_user SET mu_token='" . $token . "' WHERE mu_id='" . $id . "'");

if ($query) {
    $response = new mesin();
    $response->success = 1;
    $response->message = "TAMBAH TOKEN BERHASIL";
    die(json_encode($response));
} else {
    $response = new mesin();
    $response->success = 0;
    $response->message = "TAMBAH TOKEN GAGAL";
    die(json_encode($response));
}

mysqli_close($con);

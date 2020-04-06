<?php
include "../koneksi.php";

$id     = $_POST['mu_id'];
$telp  = $_POST['mu_telp'];
class Pass
{
}
$query = mysqli_query($con, "UPDATE master_user SET mu_telp='" . $telp . "' WHERE mu_id='" . $id . "'");

if ($query) {
    $response = new Pass();
    $response->success = 1;
    $response->message = "Edit nomer handphone berhasil";
    die(json_encode($response));
}

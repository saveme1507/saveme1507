<?php
include "../koneksi.php";

$id     = $_POST['mu_id'];
$user  = $_POST['mu_nama'];
class Pass
{
}
$query = mysqli_query($con, "UPDATE master_user SET mu_nama='" . $user . "' WHERE mu_id='" . $id . "'");

if ($query) {
    $response = new Pass();
    $response->success = 1;
    $response->message = "Edit username berhasil";
    die(json_encode($response));
}

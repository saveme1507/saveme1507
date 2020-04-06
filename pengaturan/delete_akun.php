<?php
include "../koneksi.php";

$id     = $_POST['mu_id'];
class Pass
{
}
$query = mysqli_query($con, "DELETE FROM master_user WHERE mu_id='" . $id . "'");

if ($query) {
    $response = new Pass();
    $response->message = "Hapus akun berhasil";
    die(json_encode($response));
}

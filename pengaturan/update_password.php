<?php
include "../koneksi.php";

$id     = $_POST['mu_id'];
$pass  = $_POST['mu_pass'];
class Pass
{
}
$query = mysqli_query($con, "UPDATE master_user SET mu_pass='" . $pass . "' WHERE mu_id='" . $id . "'");

if ($query) {
    $response = new Pass();
    $response->message = "Edit password berhasil";
    die(json_encode($response));
}
mysqli_close($con);

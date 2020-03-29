<?php
include "../koneksi.php";

$id     = $_POST['id_usr'];
$token = $_POST['token'];

class mesin
{
}

$query = mysqli_query($con, "UPDATE users SET token='" . $token . "' WHERE id_usr='" . $id . "'");

if ($query) {
    $response = new mesin();
    $response->success = 1;
    $response->message = "Data berhasil di simpan";
    die(json_encode($response));
} else {
    $response = new mesin();
    $response->success = 0;
    $response->message = "Error simpan Data";
    die(json_encode($response));
}

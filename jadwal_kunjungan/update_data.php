<?php
include "../koneksi.php";

$hari   = $_POST['mj_hari'];
$pel1   = $_POST['mj_pel1'];
$pel2   = $_POST['mj_pel2'];

class Pass
{
}

$query = mysqli_query($con, "UPDATE master_jadwal SET mj_pelanggan_1='" . $pel1 . "' , mj_pelanggan_2='" . $pel2 . "' WHERE mj_hari='" . $hari . "'");

if ($query) {
    $response = new Pass();
    $response->success = 1;
    $response->message = "Edit jadwal Berhasil";
    die(json_encode($response));
}

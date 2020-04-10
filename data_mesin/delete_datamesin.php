<?php
include "../koneksi.php";

$id = $_POST['mm_id'];

class Pass
{
}

$query = mysqli_query($con, "DELETE FROM master_mesin WHERE mm_id=" . $id);

if ($query) {
    $response = new Pass();
    $response->success = 1;
    $response->message = "Hapus data mesin berhasil";
    die(json_encode($response));
}

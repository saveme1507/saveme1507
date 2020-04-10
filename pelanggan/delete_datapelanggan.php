<?php
include "../koneksi.php";

class Pass
{
}

$id     = $_POST['mp_id'];
$patch_logo = $_POST['patch_logo'];

$query = mysqli_query($con, "DELETE FROM master_perusahaan WHERE mp_id=" . $id);

if ($query) {
    unlink($patch_logo);
    $response = new Pass();
    $response->success = 1;
    $response->message = "Hapus Data Perusahaan Berhasil";
    die(json_encode($response));
}

mysqli_close($con);

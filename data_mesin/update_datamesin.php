<?php
include "../koneksi.php";

$id     = $_POST['mm_id'];
$sn     = $_POST['mm_sn'];
$tipe   = $_POST['mm_tipe'];
$posisi = $_POST['mm_posisi'];
$last_pm = $_POST['mm_last_pm'];
$id_pt  = $_POST['mm_id_pt'];

class Pass
{
}

$query = mysqli_query($con, "UPDATE master_mesin SET mm_sn='" . $sn . "', mm_tipe='" . $tipe . "', mm_posisi='" . $posisi . "', mm_last_pm='" . $last_pm . "',mm_id_pt=" . $id_pt . " WHERE mm_id=" . $id);

if ($query) {
    $response = new Pass();
    $response->success = 1;
    $response->message = "Tambah data mesin berhasil";
    die(json_encode($response));
} else {
    $response->error = mysqli_error($con);
    die(json_encode($response));
}

mysqli_close($con);

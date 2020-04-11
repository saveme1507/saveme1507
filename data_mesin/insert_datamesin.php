<?php
include "../koneksi.php";

$sn     = $_POST['mm_sn'];
$tipe   = $_POST['mm_tipe'];
$posisi = $_POST['mm_posisi'];
$last_pm = $_POST['mm_last_pm'];
$id_pt  = $_POST['mm_id_pt'];

class Pass
{
}

$query = mysqli_query($con, "INSERT INTO master_mesin (mm_sn, mm_tipe, mm_posisi, mm_last_pm, mm_id_pt) 
VALUES('" . $sn . "','" . $tipe . "','" . $posisi . "','" . $last_pm . "'," . $id_pt . ")");

if ($query) {
    $response = new Pass();
    $response->success = 1;
    $response->message = "Tambah data mesin berhasil";
    die(json_encode($response));
} else {
    echo mysqli_error($con);
}

mysqli_close($con);

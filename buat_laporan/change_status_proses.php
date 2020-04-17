<?php
include "../koneksi.php";
include "../fcm/Fcm.php";

$id      = $_POST['lk_id'];
$status  = $_POST['lk_status'];
$update  = $_POST['lk_update'];
$ket     = $_POST['lk_ket'];

$queryToken = mysqli_query($con, "SELECT master_user.mu_token FROM master_user INNER JOIN laporan_kerusakan ON master_user.mu_id=laporan_kerusakan.lk_id_pelapor WHERE laporan_kerusakan.lk_id=" . $id);

while ($row2 = mysqli_fetch_row($queryToken)) {
    $json[] = $row2[0];
}
$token = json_encode($json);

class Pass
{
}
$query = mysqli_query($con, "UPDATE laporan_kerusakan SET lk_ket='" . $ket . "',lk_status='" . $status . "',lk_update='" . $update . "'WHERE lk_id=" . $id);

if ($query) {
    $notif = new Fcm();
    $notif->sendNotif($token, "Laporan anda telah di proses", $ket);

    $response = new Pass();
    $response->success = 1;
    $response->message = "Update pelaporan berhasil";
    die(json_encode($response));
}
mysqli_close($con);

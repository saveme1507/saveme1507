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
// else {
//     $response->message = "Edit password gagal";
//     die(json_encode($response));
// }
mysqli_close($con);

// $con->autocommit(false);
// // $con->query("INSERT INTO header_laporan_mesin (hlm_id_perusahaan) VALUES(" . $mp_id . ");");
// // $con->query("SELECT @id_lap := hlm_id FROM header_laporan_mesin ORDER BY hlm_id DESC LIMIT 1 ;");
// // $con->query("INSERT INTO detail_laporan_mesin (dlm_id,dlm_id_mesin) VALUES (@id_lap," . $mm_id . ");");
// $con->query("INSERT INTO laporan_kerusakan (lk_id_pelapor, lk_ket, lk_status, lk_tglll, lk_id_hlm) 
//             VALUES (" . $mu_id . ",'" . $deskripsi . "','pending','" . $tgl_lap . "',@id_lap);");
// if (!$con->commit()) {
//     echo "failed";
//     exit();
// } else {
//     echo "success";
// }
// $con->rollback();
// $con->close();

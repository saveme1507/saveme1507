<?php
include "../koneksi.php";
include "../fcm/Fcm.php";

$mp_id  = $_POST['mp_id'];
$mm_id  = $_POST['mm_id'];
$mu_id  = $_POST['mu_id'];
$deskripsi  = $_POST['deskripsi'];
$tgl_lap    = $_POST['tgl_lap'];
$mp_nama    = $_POST['mp_nama'];

$query = mysqli_query($con, "SELECT mu_token FROM master_user WHERE mu_flag != 0");
while ($row = mysqli_fetch_row($query)) {
    $json[] = $row[0];
}
$token = json_encode($json);


class Pass
{
}
mysqli_autocommit($con, false);

$query1 = mysqli_query($con, "INSERT INTO header_laporan_mesin (hlm_id_perusahaan) VALUES(" . $mp_id . ");");
$query2 = mysqli_query($con, "SELECT @id_lap := hlm_id FROM header_laporan_mesin ORDER BY hlm_id DESC LIMIT 1 ;");
$query3 = mysqli_query($con, "INSERT INTO detail_laporan_mesin (dlm_id,dlm_id_mesin) VALUES (@id_lap," . $mm_id . ");");
$query4 = mysqli_query($con, "INSERT INTO laporan_kerusakan (lk_id_pelapor, lk_ket, lk_status, lk_tgl, lk_id_hlm) VALUES (" . $mu_id . ",'" . $deskripsi . "','pending','" . $tgl_lap . "',@id_lap);");



if ($query1) {
    // echo "query 1 ok-----";
    if ($query2) {
        // echo "query 2 ok-----";
        if ($query3) {
            // echo "query 3 ok----";
            if ($query4) {
                $coba = new Fcm();
                $coba->sendNotif($token, "Pelaporan dari " . $mp_nama, $deskripsi);
                // echo "query 4 ok----";
                mysqli_commit($con);
                $response = new Pass();
                $response->success = 1;
                $response->message = "Laporan berhasil di kirim, terima kasih";
                die(json_encode($response));
            } else {
                echo "Erorr4 :" . mysqli_error($con);
            }
        } else {
            echo "Erorr3 :" . mysqli_error($con);
        }
    } else {
        echo "Erorr2 :" . mysqli_error($con);
    }
} else {
    echo "Erorr1 :" . mysqli_error($con);
}

mysqli_close($con);

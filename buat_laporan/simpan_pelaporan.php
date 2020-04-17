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



// class Fcm
// {
//     function sendNotif()
//     {
//         $token = '[
//     "f0fv4vx4Ge0:APA91bFGsmz6y6xZsQf9nCSIvzJVsN0PtcsCVs4JzF3JPabd13_N0oB3iGWIcgELWLIfaSfH2cPfJ6aTTIlcvZjMCRcdSzOzwg9FHlQpz1SN1MiDacl-3AQFDqQTpOOu4JAzZ2SzZw-f",
//     "cHZM9KrNO_4:APA91bHDhTa7ewYEBthOFGZkatLX78cm1NLfmq_8WWgTz_Fukawfmqk9qUL5J1zNpbh5LbRAac8-Uz9EIgIDrWKVDm-LvXjlMNFOMtUXKFegj20tCGUAxVe0BA1I-gT_rK6-5x0bL3RA","cy0Fm38ZIOA:APA91bHAw9IHOsLltgeH7UUzpgY9FfL0CGAFbmqmZo_eWT0U4-LHRO1PwFm3tE0dzlry5aqzaw4wQ6VfJB0nlS_6GaJSE-RuYeb4jMLc5TAZ0cHaYVnvQM1LdPE8E0oZXOu0oxDpt06w"
// ]';

//         $curl = curl_init();

//         curl_setopt_array($curl, array(
//             CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => "",
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 0,
//             CURLOPT_FOLLOWLOCATION => true,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => "POST",
//             CURLOPT_POSTFIELDS => '{
//     "registration_ids": ' . $token . ',
//     "collapse_key": "type_a",
//     "notification": {
//         "judul": "Judul notifikasi default",
//         "isi": "Isi notifikasi default"
//     },
//     "data": {
//         "judul": "Body of Your Notification in Data",
//         "isi": "Title of Your Notification in Title"
//     }
//     }',
//             CURLOPT_HTTPHEADER => array(
//                 "Authorization: key=AAAAYwXEOOg:APA91bEUAFCNo8kJ6t47cHx1pHU2Im0rux6xJRMKKry-jAxq3yX3toQXqdZ2DxwPeyf5qlaqysoEYiN23u2TLdQprCUST7uG3cEAnc8ae4GqoEMN9bT_1kaLAnu4uI7STqF11v77cubo",
//                 "Content-Type: application/json",
//                 "Content-Type: application/json"
//             ),
//         ));

//         $response = curl_exec($curl);

//         curl_close($curl);
//         echo $response;
//     }
// }

<?php
include "../koneksi.php";
include "../fcm/Fcm.php";

$hlm_tgl        = $_POST['hlm_tgl'];
$hlm_pengerjaan = $_POST['hlm_pengerjaan'];
$hlm_id_teknisi = $_POST['hlm_id_teknisi'];
$hlm_id         = $_POST['hlm_id'];
$dlm_vm         = $_POST['dlm_vm'];
$dlm_vj         = $_POST['dlm_vj'];
$dlm_press      = $_POST['dlm_press'];
$dlm_visco      = $_POST['dlm_visco'];
$dlm_temp       = $_POST['dlm_temp'];
$dlm_ket        = $_POST['dlm_ket'];
$query = mysqli_query($con, "SELECT master_user.mu_token FROM master_user INNER JOIN laporan_kerusakan ON master_user.mu_id=laporan_kerusakan.lk_id_pelapor WHERE laporan_kerusakan.lk_id_hlm=" . $hlm_id);
while ($row = mysqli_fetch_row($query)) {
    $json[] = $row[0];
}
$token = json_encode($json);


class Pass
{
}

mysqli_autocommit($con, false);

$query1 = mysqli_query($con, "UPDATE header_laporan_mesin SET hlm_tanggal='" . $hlm_tgl . "',hlm_pengerjaan='" . $hlm_pengerjaan . "',hlm_id_teknisi=" . $hlm_id_teknisi . " WHERE hlm_id=" . $hlm_id);

$query2 = mysqli_query($con, "UPDATE detail_laporan_mesin SET dlm_vm='" . $dlm_vm . "',dlm_vj='" . $dlm_vj . "',dlm_press='" . $dlm_press . "',dlm_visco='" . $dlm_visco . "',dlm_temp='" . $dlm_temp . "',dlm_ket='" . $dlm_ket . "' WHERE dlm_id=" . $hlm_id);

$query3 =  mysqli_query($con, "UPDATE laporan_kerusakan SET lk_status='Selesai' WHERE lk_id_hlm=" . $hlm_id);

if ($query) {
    if ($query1) {
        if ($query2) {
            if ($query3) {
                $coba = new Fcm();
                $coba->sendNotif($token, "notifikasi laporan mesin", "Aduan laporan kerusakan selesai di kerjaan, mohon konfirmasi");
                mysqli_commit($con);
                $response = new Pass();
                $response->success = 1;
                $response->message = "Laporan mesin berhasil disimpan, terima kasih";
                die(json_encode($response));
            } else {
                echo "Erorr3 :" . mysqli_error($con);
            }
        } else {
            echo "Erorr2 :" . mysqli_error($con);
        }
    } else {
        echo "Erorr1 :" . mysqli_error($con);
    }
} else {
    echo "Erorr :" . mysqli_error($con);
}
mysqli_close($con);

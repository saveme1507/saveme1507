<?php
include "../koneksi.php";

class emp
{
}

$hlm_id = $_POST['hlm_id'];
$hlm_ttd = $_POST['hlm_ttd'];

$random = random_word(20);

$path = "images_ttd/" . $random . ".png";

// sesuiakan ip address laptop/pc atau URL server
$actualpath = BASE_URL . "/buat_lapPengerjaan/$path";

$query = mysqli_query($con, "UPDATE header_laporan_mesin SET hlm_ttd='" . $actualpath . "' WHERE hlm_id=" . $hlm_id);


if ($query) {
    file_put_contents($path, base64_decode($hlm_ttd));

    $response = new emp();
    $response->success = 1;
    $response->message = "Laporan berhasil disetujui";
    die(json_encode($response));
}

// fungsi random string pada gambar untuk menghindari nama file yang sama
function random_word($id = 20)
{
    $pool = '1234567890abcdefghijkmnpqrstuvwxyz';

    $word = '';
    for ($i = 0; $i < $id; $i++) {
        $word .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
    }
    return $word;
}

mysqli_close($con);
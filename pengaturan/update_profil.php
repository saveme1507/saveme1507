<?php
include "../koneksi.php";

class emp
{
}

$mu_id = $_POST['mu_id'];
$mu_logo = $_POST['mu_logo'];
$hapus  = $_POST['hapus_file_lama'];

$random = random_word(20);

$path = "images_profil/" . $random . ".png";

// sesuiakan ip address laptop/pc atau URL server
$actualpath = "http://192.168.43.103/pelaporan_imaje/pengaturan/$path";

$query = mysqli_query($con, "UPDATE master_user SET mu_logo='$actualpath' WHERE mu_id='" . $mu_id . "'");


if ($query) {
    file_put_contents($path, base64_decode($mu_logo));
    if (file_exists($hapus)) {
        unlink($hapus);
    }

    $response = new emp();
    $response->success = 1;
    $response->message = "Edit profil berhasil";
    $response->patch = $actualpath;
    die(json_encode($response));
} else {
    $response = new emp();
    $response->success = 0;
    $response->message = "Edit profil gagal";
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

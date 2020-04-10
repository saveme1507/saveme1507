<?php
include "../koneksi.php";

class Pass
{
}

$id     = $_POST['mp_id'];
$nama   = $_POST['mp_nama'];
$alamat = $_POST['mp_alamat'];
$logo   = $_POST['mp_logo'];
$hapus  = $_POST['patch_logo'];

$random = random_word(20);

$path = "images_pelanggan/" . $random . ".png";

// sesuiakan ip address laptop/pc atau URL server
$actualpath = "http://192.168.43.103/pelaporan_imaje/pelanggan/$path";

$query = mysqli_query($con, "UPDATE master_perusahaan SET mp_nama='" . $nama . "',mp_alamat='" . $alamat . "',mp_logo='" . $actualpath . "' WHERE mp_id=" . $id);

if ($query) {
    if (file_exists($hapus)) {
        unlink($hapus);
    }
    file_put_contents($path, base64_decode($logo));

    $response = new Pass();
    $response->success = 1;
    $response->message = "Edit data pelanggan berhasil";
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

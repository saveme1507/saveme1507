<?php
include "../koneksi.php";

class Pass
{
}

$nama   = $_POST['mp_nama'];
$alamat = $_POST['mp_alamat'];
$logo   = $_POST['mp_logo'];

$random = random_word(20);

$path = "images_pelanggan/" . $random . ".png";

// sesuiakan ip address laptop/pc atau URL server
$actualpath = "http://192.168.43.103/pelaporan_imaje/pelanggan/$path";

$query = mysqli_query($con, "INSERT INTO master_perusahaan (mp_nama,mp_alamat,mp_logo) VALUES ('" . $nama . "','" . $alamat . "','" . $actualpath . "')");

if ($query) {
    file_put_contents($path, base64_decode($logo));

    $response = new Pass();
    $response->success = 1;
    $response->message = "Tambah Data Perusahaan Berhasil";
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

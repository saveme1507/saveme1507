<?php
include "../koneksi.php";

$hs_tgl     = $_POST['hs_tgl'];
$hs_pn      = $_POST['hs_pn'];
$hs_nama    = $_POST['hs_nama'];
$hs_gambar  = $_POST['hs_gambar'];
$hs_ket     = $_POST['hs_ket'];
$hs_id_mesin = $_POST['hs_id_mesin'];

class Pass
{
}

$random = random_word(20);

$path = "images_part/" . $random . ".png";

// sesuiakan ip address laptop/pc atau URL server
$actualpath = BASE_URL . "/sparepart/$path";

$query = mysqli_query($con, "INSERT INTO histori_sparepart (hs_tgl,hs_pn,hs_nama,hs_gambar,hs_ket,hs_id_mesin) VALUES ('" . $hs_tgl . "','" . $hs_pn . "','" . $hs_nama . "','" . $actualpath . "','" . $hs_ket . "'," . $hs_id_mesin . ")");

if ($query) {
    file_put_contents($path, base64_decode($hs_gambar));

    $query_id = mysqli_query($con, "SELECT hs_id FROM histori_sparepart ORDER BY hs_id DESC LIMIT 1");
    $row = mysqli_fetch_array($query_id);

    $response = new Pass();
    $response->success = 1;
    $response->message = "Pergantian sparepart berhasil disimpan";
    $response->id_pergantian = $row['hs_id'];
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

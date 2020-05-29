<?php
include_once "../koneksi.php";

class usr
{
}

$username   = $_POST["nama"];
$email      = $_POST["email"];
$password   = $_POST["password"];
$flag       = $_POST["flag"];
$cust       = $_POST["nama_pt"];




$query_pt = mysqli_query($con, "SELECT mp_id FROM master_perusahaan WHERE mp_nama='" . $cust . "'");
$row_pt = mysqli_fetch_row($query_pt);

$num_rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM master_user WHERE mu_nama='" . $username . "' AND mu_email = '" . $email . "'"));

if ($num_rows == 0) {
    $query = mysqli_query($con, "INSERT INTO master_user (mu_nama,mu_email,mu_pass,mu_flag,mu_id_pt) VALUES('" . $username . "','" . $email . "','" . $password . "'," . $flag . "," . $row_pt[0] . ")");

    if ($query) {
        $response = new usr();
        $response->success = 1;
        $response->message = "Pendaftaran berhasil, silahkan login.";
        die(json_encode($response));
    }
} else {
    $response = new usr();
    $response->success = 0;
    $response->message = "Username atau email sudah di gunakan";
    die(json_encode($response));
}

mysqli_close($con);

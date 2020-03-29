<?php
include_once "../koneksi.php";

class usr
{
}

$username = $_POST["nama"];
$email      = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$cust      = $_POST["nama_pt"];




if ((empty($username))) {
    $response = new usr();
    $response->success = 0;
    $response->message = "Kolom username tidak boleh kosong";
    die(json_encode($response));
} else if ((empty($email))) {
    $response = new usr();
    $response->success = 0;
    $response->message = "Kolom email tidak boleh kosong";
    die(json_encode($response));
} else if ((empty($password))) {
    $response = new usr();
    $response->success = 0;
    $response->message = "Kolom password tidak boleh kosong";
    die(json_encode($response));
} else if ((empty($confirm_password)) || $password != $confirm_password) {
    $response = new usr();
    $response->success = 0;
    $response->message = "Konfirmasi password tidak sama";
    die(json_encode($response));
} else if ((empty($cust))) {
    $response = new usr();
    $response->success = 0;
    $response->message = "Silahkan pilih perusahan";
    die(json_encode($response));
} else {
    if (!empty($username) && $password == $confirm_password) {
        $query_pt = mysqli_query($con, "SELECT id_pt FROM perusahaan WHERE nama_pt='" . $cust . "'");
        $row_pt = mysqli_fetch_array($query_pt);

        $num_rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email_usr='" . $email . "' OR nama_usr='" . $username . "'"));

        if ($num_rows == 0) {
            $query = mysqli_query($con, "INSERT INTO users (nama_usr, email_usr, password, id_pt) VALUES('" . $username . "','" . $email . "','" . $password . "','" . $row_pt['id_pt'] . "')");

            if ($query) {
                $response = new usr();
                $response->success = 1;
                $response->message = "Anda berhasil daftar, silahkan login.";
                die(json_encode($response));
            } else {
                $response = new usr();
                $response->success = 0;
                $response->message = "Daftar gagal, silahkan coba beberapa saat lagi";
                die(json_encode($response));
            }
        } else {
            $response = new usr();
            $response->success = 0;
            $response->message = "Nama user atau email sudah di gunakan";
            die(json_encode($response));
        }
    }
}

mysqli_close($con);

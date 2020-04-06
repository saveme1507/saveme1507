<?php
/* ===== www.dedykuncoro.com ===== */
// include 'koneksi.php';

// class usr{}

// $username = $_POST["username"];
// $password = $_POST["password"];

// if ((empty($username)) || (empty($password))) { 
// 	$response = new usr();
// 	$response->success = 0;
// 	$response->message = "Kolom tidak boleh kosong"; 
// 	die(json_encode($response));
// }

// $query = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");

// $row = mysql_fetch_array($query);

// if (!empty($row)){
// 	$response = new usr();
// 	$response->success = 1;
// 	$response->message = "Selamat datang ".$row['username'];
// 	$response->id = $row['id'];
// 	$response->username = $row['username'];
// 	die(json_encode($response));

// } else { 
// 	$response = new usr();
// 	$response->success = 0;
// 	$response->message = "Username atau password salah";
// 	die(json_encode($response));
// }

// mysql_close();


//=================== KALAU PAKAI MYSQLI YANG ATAS SEMUA DI REMARK, TERUS YANG INI RI UNREMARK ========
include_once "../koneksi.php";

class usr
{
}

$email = $_POST["nama/email"];
$password = $_POST["password"];

if ((empty($email)) || (empty($password))) {
	$response = new usr();
	$response->success = 0;
	$response->message = "Kolom tidak boleh kosong";
	die(json_encode($response));
}

$query = mysqli_query($con, "SELECT * FROM master_user WHERE (mu_email='$email' OR mu_nama='$email') AND mu_pass='$password'");
$row = mysqli_fetch_array($query);

$query_namapt = mysqli_query($con, "SELECT mp_nama FROM master_perusahaan WHERE mp_id='" . $row['mu_id_pt'] . "'");
$row_namapt = mysqli_fetch_array($query_namapt);

if (!empty($row)) {
	$response = new usr();
	$response->success = 1;
	$response->message = "Selamat datang " . $row['mu_nama'];
	$response->mu_id = $row['mu_id'];
	$response->mu_nama = $row['mu_nama'];
	$response->mu_telp = $row['mu_telp'];
	$response->mu_email = $row['mu_email'];
	$response->mu_pass	= $row['mu_pass'];
	$response->mu_logo = $row['mu_logo'];
	$response->mu_flag = $row['mu_flag'];
	$response->mu_token	= $row['mu_token'];
	$response->mu_id_pt = $row['mu_id_pt'];
	$response->mp_nama = $row_namapt['mp_nama'];
	die(json_encode($response));
} else {
	$response = new usr();
	$response->success = 0;
	$response->message = "Email atau password salah";
	die(json_encode($response));
}

mysqli_close($con);

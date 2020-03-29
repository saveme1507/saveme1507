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

$query = mysqli_query($con, "SELECT * FROM users WHERE email_usr='$email' OR nama_usr='$email' AND password='$password'");
$row = mysqli_fetch_array($query);

$query_namapt = mysqli_query($con, "SELECT nama_pt FROM perusahaan WHERE id_pt='" . $row['id_pt'] . "'");
$row_namapt = mysqli_fetch_array($query_namapt);

if (!empty($row)) {
	$response = new usr();
	$response->success = 1;
	$response->message = "Selamat datang " . $row['nama_usr'];
	$response->id_usr = $row['id_usr'];
	$response->nama_usr = $row['nama_usr'];
	$response->telp_usr = $row['telp_usr'];
	$response->email_usr = $row['email_usr'];
	$response->id_pt = $row['id_pt'];
	$response->logo_usr = $row['logo_usr'];
	$response->flag_usr = $row['flag_usr'];
	$response->nama_pt = $row_namapt['nama_pt'];

	die(json_encode($response));
} else {
	$response = new usr();
	$response->success = 0;
	$response->message = "Email atau password salah";
	die(json_encode($response));
}

mysqli_close($con);

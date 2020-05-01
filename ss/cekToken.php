<?php
include "../koneksi.php";

$id     = $_POST['mu_id'];
$token = $_POST['mu_token'];

class mesin
{
}

$query = mysqli_query($con, "SELECT mu_token FROM master_user WHERE mu_id=" . $id);
$row = mysqli_fetch_array($query);

if ($query) {
    if ($token == $row['mu_token']) {
        $response = new mesin();
        $response->success = 1;
        die(json_encode($response));
    }
}

mysqli_close($con);

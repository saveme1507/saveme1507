<?php
include "../koneksi.php";


$query = mysqli_query($con, "SELECT mu_token FROM master_user WHERE mu_flag != 0");

while ($row = mysqli_fetch_row($query)) {
    $json[] = $row[0];
}
$token = json_encode($json);
echo $token;
// echo json_encode($json);

mysqli_close($con);

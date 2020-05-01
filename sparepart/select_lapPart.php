<?php
include_once "../koneksi.php";

class usr
{
}

$hlm_id = $_GET["hlm_id"];

$query = mysqli_query($con, "SELECT * FROM histori_sparepart WHERE hs_id=" . $hlm_id);
$row = mysqli_fetch_array($query);

$query_mesin = mysqli_query($con, "SELECT mm_sn,mm_tipe,mm_posisi,mm_last_pm,mm_id_pt FROM master_mesin WHERE mm_id=" . $row['hs_id_mesin']);
$row_mesin = mysqli_fetch_array($query_mesin);

$query_pelanggan = mysqli_query($con, "SELECT mp_nama FROM master_perusahaan WHERE mp_id=" . $row_mesin['mm_id_pt']);
$row_pelanggan = mysqli_fetch_array($query_pelanggan);

$date = date_create($row['hs_tgl']);
$tgl = date_format($date, "d M Y");
$datePm = date_create($row_mesin['mm_last_pm']);
$laspPm = date_format($date, "d M Y");

if (!empty($row)) {
    $response = new usr();
    $response->success = 1;
    $response->hlm_id = $row['hs_id'];
    $response->header = "Tanggal: " . $tgl . " *Pelanggan: " . $row_pelanggan['mp_nama'] . " *Pengerjaan: Pergantian sparepart";
    $response->mesin = "Tipe Mesin: " . $row_mesin['mm_tipe'] . " *Serial Number: " . $row_mesin['mm_sn'] . " *Line Produksi: " . $row_mesin['mm_posisi'] . " *Last PM: " . $laspPm;
    $response->parameter = "Part Number :" . $row['hs_pn'] . " *Nama Part: " . $row['hs_nama'];
    $response->keterangan = $row['hs_ket'];
    $response->ttd = $row['hs_ttd'];
    die(json_encode($response));
}

mysqli_close($con);

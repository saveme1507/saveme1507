<?php
include_once "../koneksi.php";

class usr
{
}

$hlm_id = $_GET["hlm_id"];

$query = mysqli_query($con, "SELECT header_laporan_mesin.hlm_id, header_laporan_mesin.hlm_tanggal, header_laporan_mesin.hlm_pengerjaan ,header_laporan_mesin.hlm_id_perusahaan, header_laporan_mesin.hlm_id_teknisi, header_laporan_mesin.hlm_ttd , detail_laporan_mesin.dlm_id_mesin, detail_laporan_mesin.dlm_vm, detail_laporan_mesin.dlm_vj, detail_laporan_mesin.dlm_press, detail_laporan_mesin.dlm_visco, detail_laporan_mesin.dlm_temp, detail_laporan_mesin.dlm_ket FROM header_laporan_mesin INNER JOIN detail_laporan_mesin ON header_laporan_mesin.hlm_id=detail_laporan_mesin.dlm_id WHERE header_laporan_mesin.hlm_id=" . $hlm_id);
$row = mysqli_fetch_array($query);

$query_pelanggan = mysqli_query($con, "SELECT mp_nama FROM master_perusahaan WHERE mp_id=" . $row['hlm_id_perusahaan']);
$row_pelanggan = mysqli_fetch_array($query_pelanggan);

$query_user = mysqli_query($con, "SELECT mu_nama FROM master_user WHERE mu_id=" . $row['hlm_id_teknisi']);
$row_user = mysqli_fetch_array($query_user);

$query_mesin = mysqli_query($con, "SELECT mm_sn,mm_tipe,mm_posisi,mm_last_pm FROM master_mesin WHERE mm_id=" . $row['dlm_id_mesin']);
$row_mesin = mysqli_fetch_array($query_mesin);

$date = date_create($row['hlm_tanggal']);
$tgl = date_format($date, "d M Y");
$datePm = date_create($row_mesin['mm_last_pm']);
$laspPm = date_format($date, "d M Y");

if (!empty($row)) {
    $response = new usr();
    $response->success = 1;
    $response->hlm_id = $row['hlm_id'];
    $response->header = "Tanggal: " . $tgl . " *Pelanggan: " . $row_pelanggan['mp_nama'] . " *Pengerjaan: " . $row['hlm_pengerjaan'];
    $response->mesin = "Tipe Mesin: " . $row_mesin['mm_tipe'] . " *Serial Number: " . $row_mesin['mm_sn'] . " *Line Produksi: " . $row_mesin['mm_posisi'] . " *Last PM: " . $laspPm;
    $response->parameter = "Vm :" . $row['dlm_vm'] . " *Vj: " . $row['dlm_vj'] . " *Pressure: " . $row['dlm_press'] . " *Visco: " . $row['dlm_visco'] . " *Temperatur: " . $row['dlm_temp'];
    $response->keterangan = $row['dlm_ket'];
    $response->teknisi = "Teknisi: " . $row_user['mu_nama'];
    $response->ttd = $row['hlm_ttd'];
    die(json_encode($response));
}

mysqli_close($con);

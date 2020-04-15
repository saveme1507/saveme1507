<?php
include "../koneksi.php";

$mm_id = $_GET['mm_id'];
class xxx
{
}
$bulan1 = date('m', strtotime('-1 month'));
$bulan2 = date('m', strtotime('-2 month'));
$bulan3 = date('m', strtotime('-3 month'));
$tahun1 = date('Y', strtotime('-1 month'));
$tahun2 = date('Y', strtotime('-2 month'));
$tahun3 = date('Y', strtotime('-3 month'));

$query1 = mysqli_query($con, "SELECT COUNT(header_laporan_mesin.hlm_pengerjaan) AS jml FROM header_laporan_mesin INNER JOIN detail_laporan_mesin ON header_laporan_mesin.hlm_id=detail_laporan_mesin.dlm_id WHERE month(header_laporan_mesin.hlm_tanggal)='" . $bulan1 . "' AND year(header_laporan_mesin.hlm_tanggal)='" . $tahun1 . "' AND header_laporan_mesin.hlm_pengerjaan='Perbaikan' AND detail_laporan_mesin.dlm_id_mesin=" . $mm_id);
$row1 = mysqli_fetch_array($query1);

$query2 = mysqli_query($con, "SELECT COUNT(header_laporan_mesin.hlm_pengerjaan) AS jml FROM header_laporan_mesin INNER JOIN detail_laporan_mesin ON header_laporan_mesin.hlm_id=detail_laporan_mesin.dlm_id WHERE month(header_laporan_mesin.hlm_tanggal)='" . $bulan2 . "' AND year(header_laporan_mesin.hlm_tanggal)='" . $tahun2 . "' AND header_laporan_mesin.hlm_pengerjaan='Perbaikan' AND detail_laporan_mesin.dlm_id_mesin=" . $mm_id);
$row2 = mysqli_fetch_array($query2);

$query3 = mysqli_query($con, "SELECT COUNT(header_laporan_mesin.hlm_pengerjaan) AS jml FROM header_laporan_mesin INNER JOIN detail_laporan_mesin ON header_laporan_mesin.hlm_id=detail_laporan_mesin.dlm_id WHERE month(header_laporan_mesin.hlm_tanggal)='" . $bulan3 . "' AND year(header_laporan_mesin.hlm_tanggal)='" . $tahun3 . "' AND header_laporan_mesin.hlm_pengerjaan='Perbaikan' AND detail_laporan_mesin.dlm_id_mesin=" . $mm_id);
$row3 = mysqli_fetch_array($query3);

$response = new xxx();
$response->jml1 = $row1['jml'];
$response->bulan1 = $tahun1 . '-' . $bulan1;
$response->jml2 = $row2['jml'];
$response->bulan2 = $tahun2 . '-' . $bulan2;
$response->jml3 = $row3['jml'];
$response->bulan3 = $tahun3 . '-' . $bulan3;
die(json_encode($response));

mysqli_close($con);

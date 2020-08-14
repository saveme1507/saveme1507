<?php
include "../koneksi.php";

$id    = $_GET['id'];
$bulan = $_GET['bulan'];

class Data
{
}
$json = array();

$query = mysqli_query($con, "SELECT header_laporan_mesin.hlm_tanggal,header_laporan_mesin.hlm_pengerjaan,master_user.mu_nama FROM header_laporan_mesin INNER JOIN master_user ON header_laporan_mesin.hlm_id_teknisi=master_user.mu_id WHERE header_laporan_mesin.hlm_id_perusahaan=$id AND MONTH(header_laporan_mesin.hlm_tanggal)=$bulan");

$query2 = mysqli_query($con, "SELECT master_mesin.mm_sn,master_mesin.mm_tipe FROM header_laporan_mesin INNER JOIN detail_laporan_mesin ON header_laporan_mesin.hlm_id = detail_laporan_mesin.dlm_id INNER JOIN master_mesin ON detail_laporan_mesin.dlm_id_mesin=master_mesin.mm_id WHERE header_laporan_mesin.hlm_id_perusahaan=$id AND MONTH(header_laporan_mesin.hlm_tanggal)=$bulan");

$row2 = mysqli_fetch_assoc($query2);

while ($row = mysqli_fetch_assoc($query)) {
    $d = new Data();
    $d->tgl = tanggal($row['hlm_tanggal']);
    $d->pengerjaan = $row['hlm_pengerjaan'];
    $d->tipe = $row2['mm_tipe'];
    $d->sn = $row2['mm_sn'];
    $d->nama = $row['mu_nama'];
    $json[] = $d;
}

if ($json != null) {
    echo json_encode($json);
} else {
    $data = new Data();
    $data->result = "data kosong";
    $json[] = $data;
    echo json_encode($json);
}

mysqli_close($con);

function tanggal($tgSql)
{
    $namaBulan = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
    $date = date_create($tgSql);
    $tgl = date_format($date, 'd');
    $bulan = date_format($date, 'n');
    $tahun = date_format($date, 'Y');
    return $tgl . " " . $namaBulan[$bulan - 1] . " " . $tahun;
}

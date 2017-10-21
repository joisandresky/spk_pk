<?php
include('../../koneksi.php');
$in = json_decode(file_get_contents("php://input"));
// $query = "SELECT * FROM produksi LEFT JOIN produk ON produksi.kode_produk = produk.kode_produk
//     LEFT JOIN detail_produksi ON produksi.no_produksi = detail_produksi.no_produksi
//     LEFT JOIN ket_defect_produksi ON detail_produksi.kode_ket_defect = ket_defect_produksi.kode_ket_defect
//     WHERE produksi.tanggal_produksi >= '$in->start_date' AND produksi.tanggal_produksi <='$in->end_date' GROUP BY produksi.no_produksi";
if($in->kode_produk == '-' || $in->kode_produk == null || $in->kode_produk == ""){
    $sql = "SELECT detail_produksi.no_produksi, produksi.tanggal_produksi, produk.nama_material ,SUM(detail_produksi.sample) as totalSample, SUM(detail_produksi.jumlah_defect) as totalDefect from detail_produksi LEFT JOIN produksi ON detail_produksi.no_produksi = produksi.no_produksi LEFT JOIN produk ON produksi.kode_produk = produk.kode_produk WHERE produksi.tanggal_produksi >= '$in->start_date' AND produksi.tanggal_produksi <= '$in->end_date' GROUP BY no_produksi";
} else {
    $sql = "SELECT detail_produksi.no_produksi, produksi.tanggal_produksi, produk.nama_material ,SUM(detail_produksi.sample) as totalSample, SUM(detail_produksi.jumlah_defect) as totalDefect from detail_produksi LEFT JOIN produksi ON detail_produksi.no_produksi = produksi.no_produksi LEFT JOIN produk ON produksi.kode_produk = produk.kode_produk WHERE produksi.tanggal_produksi >= '$in->start_date' AND produksi.tanggal_produksi <= '$in->end_date' AND produk.kode_produk = '$in->kode_produk' GROUP BY no_produksi";
}
$data = mysqli_query($conn, $sql);
$output = array();
while($row = mysqli_fetch_assoc($data)){
    $output[] = $row;
}

if($data){
    echo json_encode(array('success' => true, 'produksi' => $output), JSON_NUMERIC_CHECK);
} else {
    echo json_encode(array('success' => false, 'msg' => 'error', 'err' => mysqli_error($conn)));
}

?>
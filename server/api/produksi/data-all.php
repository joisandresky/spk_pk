<?php
include('../../koneksi.php');
$in = json_decode(file_get_contents("php://input"));
$query = "SELECT * FROM produksi LEFT JOIN produk ON produksi.kode_produk = produk.kode_produk
    LEFT JOIN detail_produksi ON produksi.no_produksi = detail_produksi.no_produksi
    LEFT JOIN ket_defect_produksi ON detail_produksi.kode_ket_defect = ket_defect_produksi.kode_ket_defect ORDER BY produksi.no_produksi";
$data = mysqli_query($conn, $query);
$output = array();
while($row = mysqli_fetch_assoc($data)){
    $output[] = $row;
}

if($data){
    echo json_encode(array('success' => true, 'produksi' => $output), JSON_NUMERIC_CHECK);
} else {
    echo json_encode(array('success' => false, 'msg' => 'error'));
}

?>
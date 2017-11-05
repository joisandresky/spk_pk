<?php
include("../../koneksi.php");

$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $sd = mysqli_real_escape_string($conn, $data->start_date);
    $ed = mysqli_real_escape_string($conn, $data->end_date);
    $kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);

    $sql = "SELECT produksi_variable.*, produk.nama_material AS 'materialnya' FROM produksi_variable LEFT JOIN produk ON produksi_variable.nama_material = produk.kode_produk
    WHERE produksi_variable.nama_material = '$kode_produk' AND produksi_variable.tanggal_produksi BETWEEN '$sd' AND '$ed' ORDER BY produksi_variable.tanggal_produksi ASC";

    $tampil = mysqli_query($conn, $sql);
    $output = array();
    while($row = mysqli_fetch_assoc($tampil)){
        $output[] = $row;
    }

    if(isset($output)){
        echo json_encode(array('success' => true, 'pk' => $output));
    } else {
        echo json_encode(array('success' => false, 'pk' => $output, 'msg' => 'Kode Produk Tersebut Tidak ada Di dalam Data Produksi Variable','err' => mysqli_error($conn)));
    }
}
?>
<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

$kode_jenis_produksi = mysqli_real_escape_string($conn, $data->kode_jenis_produksi);
$jenis_produksi = mysqli_real_escape_string($conn, $data->jenis_produksi);
$keterangan_produksi = mysqli_real_escape_string($conn, $data->keterangan_produksi);

$updateSql = "UPDATE master_jenis_produksi SET jenis_produksi='$jenis_produksi', keterangan_produksi='$keterangan_produksi' WHERE kode_jenis_produksi='$kode_jenis_produksi'";
if(mysqli_query($conn, $updateSql){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
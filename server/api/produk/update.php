<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

$kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);
$nama_material = mysqli_real_escape_string($conn, $data->nama_material);
$keterangan_produk = mysqli_real_escape_string($conn, $data->keterangan_produk);

$updateSql = "UPDATE produk SET nama_material='$nama_material', keterangan_produk='$keterangan_produk' WHERE kode_produk='$kode_produk'";
if(mysqli_query($conn, $updateSql)){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

$kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);
$kode_jenis_produk = mysqli_real_escape_string($conn, $data->kode_jenis_produk);
$kode_merk = mysqli_real_escape_string($conn, $data->kode_merk);
$nama_produk = mysqli_real_escape_string($conn, $data->nama_produk);

$updateSql = "UPDATE produk SET kode_jenis_produk='$kode_jenis_produk', kode_merk='$kode_merk', nama_produk='$nama_produk' WHERE kode_produk='$kode_produk'";
if(mysqli_query($conn, $updateSql){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
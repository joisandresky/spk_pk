<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

$kode_merk = mysqli_real_escape_string($conn, $data->kode_merk);
$merk_barang = mysqli_real_escape_string($conn, $data->merk_barang);
$keterangan_merk = mysqli_real_escape_string($conn, $data->keterangan_merk);

$updateSql = "UPDATE master_merk SET merk_barang='$merk_barang', keterangan_merk='$keterangan_merk' WHERE kode_merk='$kode_merk'";
if(mysqli_query($conn, $updateSql){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
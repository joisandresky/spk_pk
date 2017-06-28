<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);
    $kode_jenis_produk = mysqli_real_escape_string($conn, $data->kode_jenis_produk);
    $kode_merk = mysqli_real_escape_string($conn, $data->kode_merk);
    $nama_produk = mysqli_real_escape_string($conn, $data->nama_produk);

    $sql = "INSERT INTO produk (kode_produk, kode_jenis_produk, kode_merk, nama_produk) VALUES('$kode_produk', '$kode_jenis_produk', '$kode_merk', '$nama_produk');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
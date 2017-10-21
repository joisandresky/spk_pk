<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);
    $nama_material = mysqli_real_escape_string($conn, $data->nama_material);
    $keterangan_produk = mysqli_real_escape_string($conn, $data->keterangan_produk);

    $sql = "INSERT INTO produk (kode_produk, nama_material, keterangan_produk) VALUES('$kode_produk', '$nama_material', '$keterangan_produk');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
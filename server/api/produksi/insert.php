<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);
    $tanggal_produksi = mysqli_real_escape_string($conn, $data->tanggal_produksi);
    $ukuran = mysqli_real_escape_string($conn, $data->ukuran);
    $jumlah_produksi = mysqli_real_escape_string($conn, $data->jumlah_produksi);
    $status = mysqli_real_escape_string($conn, $data->status);

    $sql = "INSERT INTO produksi (no_produksi, kode_produk, tanggal_produksi, ukuran, jumlah_produksi, status) VALUES('$no_produksi', '$kode_produk', '$tanggal_produksi', '$ukuran', '$jumlah_produksi', '$status');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
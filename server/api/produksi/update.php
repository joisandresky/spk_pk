<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);
    $tanggal_produksi = mysqli_real_escape_string($conn, $data->tanggal_produksi);
    $ukuran = mysqli_real_escape_string($conn, $data->ukuran);
    $jumlah_produksi = mysqli_real_escape_string($conn, $data->jumlah_produksi);
    $status = mysqli_real_escape_string($conn, $data->status);

$updateSql = "UPDATE produksi SET kode_produk='$kode_produk', tanggal_produksi='$tanggal_produksi', ukuran='$ukuran', jumlah_produksi='$jumlah_produksi', status='$status' WHERE no_produksi='$no_produksi'";
if(mysqli_query($conn, $updateSql){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);
    $tanggal_produksi = mysqli_real_escape_string($conn, $data->tanggal_produksi);

    $sql = "INSERT INTO produksi (no_produksi, kode_produk, tanggal_produksi) VALUES('$no_produksi', '$kode_produk', DATE('$tanggal_produksi'));";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan', 'err' => mysqli_error($conn), 'tgl' => $tanggal_produksi));
    }
}

 ?>
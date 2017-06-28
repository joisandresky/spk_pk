<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_transaksi = mysqli_real_escape_string($conn, $data->kode_transaksi);
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $tanggal_transaksi = mysqli_real_escape_string($conn, $data->tanggal_transaksi);
    $jumlah_cacat = mysqli_real_escape_string($conn, $data->jumlah_cacat);
    $jumlah_baik = mysqli_real_escape_string($conn, $data->jumlah_baik);

    $sql = "INSERT INTO transaksi_hitung_cacat (kode_transaksi, no_produksi, tanggal_transaksi, jumlah_cacat, jumlah_baik) VALUES('$kode_transaksi', '$no_produksi', '$tanggal_transaksi', '$jumlah_cacat', '$jumlah_baik');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
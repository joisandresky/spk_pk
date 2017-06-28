<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

    $kode_transaksi = mysqli_real_escape_string($conn, $data->kode_transaksi);
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $tanggal_transaksi = mysqli_real_escape_string($conn, $data->tanggal_transaksi);
    $jumlah_cacat = mysqli_real_escape_string($conn, $data->jumlah_cacat);
    $jumlah_baik = mysqli_real_escape_string($conn, $data->jumlah_baik);

$updateSql = "UPDATE transaksi_hitung_cacat SET no_produksi='$no_produksi', tanggal_transaksi='$tanggal_transaksi', jumlah_cacat='$jumlah_cacat', jumlah_baik='$jumlah_baik' WHERE kode_transaksi='$kode_transaksi'";
if(mysqli_query($conn, $updateSql){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
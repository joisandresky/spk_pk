<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

    $kode_detail_transaksi = mysqli_real_escape_string($conn, $data->kode_detail_transaksi);
    $kode_transaksi = mysqli_real_escape_string($conn, $data->kode_transaksi);
    $kode_sebab = mysqli_real_escape_string($conn, $data->kode_sebab);
    $kode_cacat = mysqli_real_escape_string($conn, $data->kode_cacat);
    $jumlah_detail_cacat = mysqli_real_escape_string($conn, $data->jumlah_detail_cacat);

$updateSql = "UPDATE detail_hitung_cacat SET kode_transaksi='$kode_transaksi', kode_sebab='$kode_sebab', kode_cacat='$kode_cacat', jumlah_detail_cacat='$jumlah_detail_cacat' WHERE kode_detail_transaksi='$kode_detail_transaksi'";
if(mysqli_query($conn, $updateSql){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
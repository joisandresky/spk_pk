<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_detail_transaksi = mysqli_real_escape_string($conn, $data->kode_detail_transaksi);
    $kode_transaksi = mysqli_real_escape_string($conn, $data->kode_transaksi);
    $kode_sebab = mysqli_real_escape_string($conn, $data->kode_sebab);
    $kode_cacat = mysqli_real_escape_string($conn, $data->kode_cacat);
    $jumlah_detail_cacat = mysqli_real_escape_string($conn, $data->jumlah_detail_cacat);

    $sql = "INSERT INTO detail_hitung_cacat (kode_detail_transaksi, kode_transaksi, kode_sebab, kode_cacat, jumlah_detail_cacat) VALUES('$kode_detail_transaksi', '$kode_transaksi', '$kode_sebab', '$kode_cacat', '$jumlah_detail_cacat');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
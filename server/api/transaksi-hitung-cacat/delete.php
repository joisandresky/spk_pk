<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
$delSql = "DELETE FROM transaksi_hitung_cacat WHERE kode_transaksi='$data->kode_transaksi'";

if(mysqli_query($conn, $delSql)){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Dihapus'));
} else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Dihapus'));
}

 ?>
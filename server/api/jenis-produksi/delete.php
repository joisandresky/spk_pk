<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
$delSql = "DELETE FROM master_jenis_produksi WHERE kode_jenis_produksi='$data->kode_jenis_produksi'";

if(mysqli_query($conn, $delSql)){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Dihapus'));
} else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Dihapus'));
}

 ?>
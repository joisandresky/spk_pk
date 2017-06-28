<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

$kode_cacat = mysqli_real_escape_string($conn, $data->kode_cacat);
$kode_sebab = mysqli_real_escape_string($conn, $data->kode_sebab);
$nama_cacat = mysqli_real_escape_string($conn, $data->nama_cacat);
$keterangan_cacat = mysqli_real_escape_string($conn, $data->keterangan_cacat);

$updateSql = "UPDATE master_cacat SET kode_sebab='$kode_sebab', nama_cacat='$nama_cacat', keterangan_cacat='$keterangan_cacat' WHERE kode_cacat='$kode_cacat'";
if(mysqli_query($conn, $updateSql){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
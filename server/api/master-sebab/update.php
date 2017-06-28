<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

$kode_sebab = mysqli_real_escape_string($conn, $data->kode_sebab);
$nama_sebab = mysqli_real_escape_string($conn, $data->nama_sebab);
$keterangan_sebab = mysqli_real_escape_string($conn, $data->keterangan_sebab);

$updateSql = "UPDATE master_sebab SET nama_sebab='$nama_sebab', keterangan_sebab='$keterangan_sebab' WHERE kode_sebab='$kode_sebab'";
if(mysqli_query($conn, $updateSql){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
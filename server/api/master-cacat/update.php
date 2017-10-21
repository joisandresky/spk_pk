<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

$kode_defect = mysqli_real_escape_string($conn, $data->kode_defect);
$jenis_cacat = mysqli_real_escape_string($conn, $data->jenis_cacat);
$penyebab_cacat = mysqli_real_escape_string($conn, $data->penyebab_cacat);
$tindakan = mysqli_real_escape_string($conn, $data->tindakan);

$updateSql = "UPDATE master_cacat SET kode_defect='$kode_defect', jenis_cacat='$jenis_cacat', tindakan='$tindakan' WHERE kode_defect='$kode_defect'";
if(mysqli_query($conn, $updateSql)){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
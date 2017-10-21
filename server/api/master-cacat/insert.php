<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_defect = mysqli_real_escape_string($conn, $data->kode_defect);
    $jenis_cacat = mysqli_real_escape_string($conn, $data->jenis_cacat);
    $penyebab_cacat = mysqli_real_escape_string($conn, $data->penyebab_cacat);
    $tindakan = mysqli_real_escape_string($conn, $data->tindakan);

    $sql = "INSERT INTO master_cacat (kode_defect, jenis_cacat, penyebab_cacat, tindakan) VALUES('$kode_defect', '$jenis_cacat', '$penyebab_cacat', '$tindakan');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan', 'err' => mysqli_error($conn)));
    }
}

 ?>
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $jenis_cacat = mysqli_real_escape_string($conn, $data->jenis_cacat);
    $penyebab = mysqli_real_escape_string($conn, $data->penyebab);
    $s = mysqli_real_escape_string($conn, $data->s);
    $o = mysqli_real_escape_string($conn, $data->o);
    $d = mysqli_real_escape_string($conn, $data->d);
    $rpn = mysqli_real_escape_string($conn, $data->rpn);
    $tindakn = mysqli_real_escape_string($conn, $data->tindakan);

    $sql = "INSERT INTO data_fmea (jenis_cacat, penyebab, severity, occurrence, detectabillity, rpn, tindakan) VALUES('$jenis_cacat', '$penyebab', '$s', '$o', '$d','$rpn', '$tindakn');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan', 'err' => mysqli_error($conn)));
    }
}

 ?>

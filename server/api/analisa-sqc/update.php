<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));

    $no_analisa = mysqli_real_escape_string($conn, $data->no_analisa);
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $tanggal_analisa = mysqli_real_escape_string($conn, $data->tanggal_analisa);
    $jumlah_cacat = mysqli_real_escape_string($conn, $data->jumlah_cacat);
    $proporsi_cacat = mysqli_real_escape_string($conn, $data->proporsi_cacat);
    $UCL = mysqli_real_escape_string($conn, $data->UCL);
    $LCL = mysqli_real_escape_string($conn, $data->LCL);

$updateSql = "UPDATE analisa_sqc SET no_produksi='$no_produksi', tanggal_analisa='$tanggal_analisa', jumlah_cacat='$jumlah_cacat', proporsi_cacat='$proporsi_cacat', UCL='$UCL', LCL='$LCL' WHERE no_analisa='$no_analisa'";
if(mysqli_query($conn, $updateSql){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
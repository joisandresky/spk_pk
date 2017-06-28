<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $no_analisa = mysqli_real_escape_string($conn, $data->no_analisa);
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $tanggal_analisa = mysqli_real_escape_string($conn, $data->tanggal_analisa);
    $jumlah_cacat = mysqli_real_escape_string($conn, $data->jumlah_cacat);
    $proporsi_cacat = mysqli_real_escape_string($conn, $data->proporsi_cacat);
    $UCL = mysqli_real_escape_string($conn, $data->UCL);
    $LCL = mysqli_real_escape_string($conn, $data->LCL);

    $sql = "INSERT INTO analisa_sqc (no_analisa, no_produksi, tanggal_analisa, jumlah_cacat, proporsi_cacat, UCL, LCL) VALUES('$no_analisa', '$no_produksi', '$tanggal_analisa', '$jumlah_cacat', '$proporsi_cacat', '$UCL', '$LCL');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
<?php
include('../../koneksi.php');

$data = json_decode(file_get_contents("php://input"));
    $no_detail_produksi = mysqli_real_escape_string($conn, $data->no_detail_produksi);
    $sample = mysqli_real_escape_string($conn, $data->sample);
    $jumlah_defect = mysqli_real_escape_string($conn, $data->jumlah_defect);
    $kode_ket_defect = mysqli_real_escape_string($conn, $data->kode_ket_defect);
    $action_inspector = mysqli_real_escape_string($conn, $data->action_inspector);

$updateSql = "UPDATE detail_produksi SET sample='$sample', jumlah_defect='$jumlah_defect', kode_ket_defect='$kode_ket_defect', action_inspector='$action_inspector' WHERE no_detail_produksi='$no_detail_produksi'";

if(mysqli_query($conn, $updateSql)){
    echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Diubah'));
}else {
    echo json_encode(array('success' => false, 'msg' => 'Data Gagal Diubah'));
}

 ?>
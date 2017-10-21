<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $periode = mysqli_real_escape_string($conn, $data->periode);
    $sample = mysqli_real_escape_string($conn, $data->sample);
    $jumlah_defect = mysqli_real_escape_string($conn, $data->jumlah_defect);
    $kode_ket_defect = mysqli_real_escape_string($conn, $data->kode_ket_defect);
    $action_inspector = mysqli_real_escape_string($conn, $data->action_inspector);

    $sql = "INSERT INTO detail_produksi (no_produksi, periode, sample, jumlah_defect, kode_ket_defect, action_inspector) VALUES('$no_produksi', '$periode', '$sample','$jumlah_defect', '$kode_ket_defect', '$action_inspector')";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan', 'err' => mysqli_error($conn)));
    }
}
 ?>
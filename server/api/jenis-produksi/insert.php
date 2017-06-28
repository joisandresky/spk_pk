<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_jenis_produksi = mysqli_real_escape_string($conn, $data->kode_jenis_produksi);
    $jenis_produksi = mysqli_real_escape_string($conn, $data->jenis_produksi);
    $keterangan_jenis_produksi = mysqli_real_escape_string($conn, $data->keterangan_jenis_produksi);

    $sql = "INSERT INTO master_jenis_produksi (kode_jenis_produksi, jenis_produksi, keterangan_jenis_produksi) VALUES('$kode_jenis_produksi', '$jenis_produksi', '$keterangan_jenis_produksi');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_merk = mysqli_real_escape_string($conn, $data->kode_merk);
    $merk_barang = mysqli_real_escape_string($conn, $data->merk_barang);
    $keterangan_merk = mysqli_real_escape_string($conn, $data->keterangan_merk);

    $sql = "INSERT INTO master_jenis_produksi (kode_merk, merk_barang, keterangan_merk) VALUES('$kode_merk', '$merk_barang', '$keterangan_merk');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
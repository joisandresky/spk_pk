<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_cacat = mysqli_real_escape_string($conn, $data->kode_cacat);
    $kode_sebab = mysqli_real_escape_string($conn, $data->kode_sebab);
    $nama_cacat = mysqli_real_escape_string($conn, $data->nama_cacat);
    $keterangan_cacat = mysqli_real_escape_string($conn, $data->keterangan_cacat);

    $sql = "INSERT INTO master_cacat (kode_cacat, kode_sebab, nama_cacat, keterangan_cacat) VALUES('$kode_cacat', '$kode_sebab', '$nama_cacat', '$keterangan_cacat');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
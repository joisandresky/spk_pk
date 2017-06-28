<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_sebab = mysqli_real_escape_string($conn, $data->kode_sebab);
    $nama_sebab = mysqli_real_escape_string($conn, $data->nama_sebab);
    $keterangan_sebab = mysqli_real_escape_string($conn, $data->keterangan_sebab);

    $sql = "INSERT INTO master_sebab (kode_sebab, nama_sebab, keterangan_sebab) VALUES('$kode_sebab', '$nama_sebab', '$keterangan_sebab');";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
    }else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan'));
    }
}

 ?>
<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_ket_defect = mysqli_real_escape_string($conn, $data->kode_ket_defect);
    $defect_pertama = mysqli_real_escape_string($conn, $data->defect_pertama);
    $defect_kedua = mysqli_real_escape_string($conn, $data->defect_kedua);
    $defect_ketiga = mysqli_real_escape_string($conn, $data->defect_ketiga);

    $sql = "INSERT INTO ket_defect_produksi (kode_ket_defect, defect_pertama, defect_kedua,defect_ketiga) VALUES('$kode_ket_defect', '$defect_pertama', '$defect_kedua', '$defect_ketiga')";
    if(mysqli_query($conn, $sql)){
            echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan', 'err' => mysqli_error($conn) ));
        }
    }
 ?>
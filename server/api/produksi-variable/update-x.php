<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $x = $data->x;

    $sql = "UPDATE produksi_variable SET x1 = '$x[0]',x2 = '$x[1]',x3 = '$x[2]',x4 = '$x[3]',x5 = '$x[4]',x6 = '$x[5]',x7 = '$x[6]',x8 = '$x[7]' WHERE no_produksi = '$no_produksi'";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data X Berhasil Disimpan!'));
    } else {
        echo json_encode(array('success' => false, 'msg' => 'Data X Gagal Disimpan!', 'err' => mysqli_error($conn)));
    }
}

?>
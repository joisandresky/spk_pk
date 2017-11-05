<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);

    $sql = "DELETE FROM produksi_variable WHERE no_produksi = '$no_produksi'";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Dihapus!'));
    } else {
        echo json_encode(array('success' => true, 'msg' => 'Data Gagal Dihapus!', 'err' => mysqli_error($conn)));
    }
}
?>
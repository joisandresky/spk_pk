<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);
    // $tanggal_produksi = mysqli_real_escape_string($conn, $data->tanggal_produksi);
    // $dx = mysqli_real_escape_string($conn, $data->x);
    // $x = $dx;
    // $x = array();
    // for($i = 1; $i <= $x;$i++){
    //     array_push($x, $dx[$i]);
    // }

    $sql = "UPDATE produksi_variable SET nama_material = '$kode_produk' WHERE no_produksi = '$no_produksi'";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan!'));
    } else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan!', 'err' => mysqli_error($conn)));
    }
}

?>
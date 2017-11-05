<?php
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $no_produksi = mysqli_real_escape_string($conn, $data->no_produksi);
    $kode_produk = mysqli_real_escape_string($conn, $data->kode_produk);
    $tanggal_produksi = mysqli_real_escape_string($conn, $data->tanggal_produksi);
    $dx = $data->x;
    $x = $dx;
    // $x = array();
    // for($i = 1; $i <= $x;$i++){
    //     array_push($x, $dx[$i]);
    // }

    $sql = "INSERT INTO produksi_variable VALUES('$no_produksi', '$kode_produk', '$tanggal_produksi', '$x[0]','$x[1]','$x[2]','$x[3]','$x[4]','$x[5]','$x[6]','$x[7]')";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array('success' => true, 'msg' => 'Data Berhasil Disimpan!'));
    } else {
        echo json_encode(array('success' => false, 'msg' => 'Data Gagal Disimpan!', 'err' => mysqli_error($conn)));
    }
}

?>
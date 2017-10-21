<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include('../../koneksi.php');
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $kode_defect = mysqli_real_escape_string($conn, $data->kode_defect);
    $cacatNya = array();
    $sql = "SELECT penyebab_cacat, tindakan from master_cacat WHERE kode_defect = '$kode_defect'";
    $hasil = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_object($hasil)){
      $cacatNya = $row->penyebab_cacat;
      $tindakan = $row->tindakan;
    }
    $cacat = explode(",", $cacatNya);
    if(count($cacatNya) > 0){
        echo json_encode(array('success' => true, 'data_cct' => $cacat, 'tindakan' => $tindakan));
    }else {
        echo json_encode(array('success' => false, 'data_cct' => $cacat, 'err' => mysqli_error($conn)));
    }
}

 ?>

<?php
include('../../koneksi.php');
$in = json_decode(file_get_contents("php://input"));
$query = "SELECT jenis_cacat FROM master_cacat WHERE kode_defect='$in->kode_defect'";
$data = mysqli_query($conn, $query);
while($row = mysqli_fetch_object($data)){
    $output = $row;
}

if($data){
    echo json_encode(array('success' => true, 'detail_defect' => $output->jenis_cacat));
} else {
    echo json_encode(array('success' => false, 'msg' => 'error'));
}

?>
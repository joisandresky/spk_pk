<?php
include('../../koneksi.php');

$query = "SELECT * FROM transaksi_hitung_cacat";
$data = mysqli_query($conn, $query);
$output = array();
while($row = mysqli_fetch_assoc($data)){
    $output[] = $row;
}

if($data){
    echo json_encode(array('success' => true, 'transaksi_hitung_cacat' => $output));
} else {
    echo json_encode(array('success' => false, 'msg' => 'error'));
}

?>
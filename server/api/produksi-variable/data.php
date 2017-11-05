<?php
include('../../koneksi.php');

$query = "SELECT produksi_variable.*, produk.nama_material AS 'materialnya' FROM produksi_variable LEFT JOIN produk ON produksi_variable.nama_material = produk.kode_produk";
$run = mysqli_query($conn, $query);

$output = array();
while($row = mysqli_fetch_assoc($run)){
    $output[] = $row;
}

if(isset($output)){
    echo json_encode(array('success' => true,'pv' => $output));
} else {
    echo json_encode(array('success' => false, 'err' => mysqli_error($conn), 'pv' => $output));
}

?>
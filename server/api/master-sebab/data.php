<?php
include('../../koneksi.php');

$query = "SELECT * FROM master_sebab";
$data = mysqli_query($conn, $query);
$output = array();
while($row = mysqli_fetch_assoc($data)){
    $output[] = $row;
}

if($data){
    echo json_encode(array('success' => true, 'data_sebab' => $output));
} else {
    echo json_encode(array('success' => false, 'msg' => 'error'));
}

?>
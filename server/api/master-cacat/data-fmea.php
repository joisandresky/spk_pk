<?php
include('../../koneksi.php');

$sql = "SELECT * from data_fmea";
$hasil = mysqli_query($conn, $sql);
$hasilNya = array();
while($row = mysqli_fetch_assoc($hasil)){
  array_push($hasilNya, $row);
}

if(count($hasilNya) > 0){
  echo json_encode($hasilNya);
} else {
  echo json_encode($hasilNya);
}

 ?>

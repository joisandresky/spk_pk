<?php
include('koneksi.php');
session_start();
$error = "";

if(isset($_POST['submit'])){
    if(empty($_POST['username'] || empty($_POST['password']))){
        $error = "<script type='text/javascript'>swal('Ooppss..!', 'Tidak Boleh Kosong','error')</script>";
        echo "GAK BOLEH KOSONG";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = stripcslashes($username);
        $password = stripcslashes($password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $data = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($data);

        if($rows == 1){
            $_SESSION['login_user'] = $username;
            header("location: ../");
        }  else {
            $error = "<script type='text/javascript'>swal('Ooppss..!', 'User Tidak Ditemukan','error')</script>";
            echo "User Tidak Ditemukan";
        }
    }
}


 ?>
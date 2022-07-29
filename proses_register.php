<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $level = "costumer";
    $status = "on";
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $jk = "Laki-laki";
    $tgl_lahir = "1970-01-01";
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    unset($_POST['password']);
    unset($_POST['re_password']);
    $dataForm = http_build_query($_POST);

    $query = mysqli_query($connection, "SELECT * FROM user WHERE email='$email'");

    if(empty($nama_lengkap) || empty($email) || empty($phone) || empty($alamat) || empty($password)) {
        header("location: ".BASE_URL."index.php?page=register&notif=require&$dataForm");
    } else if($password !== $re_password) {
        header("location: ".BASE_URL."index.php?page=register&notif=password&$dataForm");
    } else if(mysqli_num_rows($query) == 1) {
        header("location: ".BASE_URL."index.php?page=register&notif=email&$dataForm");
    } else {
        $password = md5($password);
        mysqli_query($connection, "INSERT INTO user (level, nama, email, alamat, phone, jenis_kelamin, tanggal_lahir, password, status) VALUES ('$level', '$nama_lengkap', '$email', '$alamat', '$phone', '$jk', '$tgl_lahir', '$password', '$status')");

        header("location: ".BASE_URL."index.php?page=login");
    }
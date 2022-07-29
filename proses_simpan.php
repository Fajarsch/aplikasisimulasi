<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    session_start();

    $judul_simulasi = $_POST["judul_simulasi"];

    $user_id = $_SESSION['user_id'];
    $waktu_saat_ini = date("Y-m-d");

    $query = mysqli_query($connection, "INSERT INTO simpan (judul_simulasi, user_id, tanggal_simpan) 
                                        VALUES ('$judul_simulasi', '$user_id', '$waktu_saat_ini')");

    if($query) {
        $last_simpan_id = mysqli_insert_id($connection);

        $preview = $_SESSION['preview'];

        foreach($preview AS $key => $value) {
            $barang_id = $key;
            $quantity = $value['quantity'];
            $harga = $value['harga'];

            mysqli_query($connection, "INSERT INTO simpan_detail (simpan_id, barang_id, quantity, harga) 
                                        VALUES ('$last_simpan_id', '$barang_id', '$quantity', '$harga')");

        }

        unset($_SESSION["preview"]);

        header("location: ".BASE_URL."index.php?page=my_profile&module=simpan&action=detail&simpan_id=$last_simpan_id");
    }
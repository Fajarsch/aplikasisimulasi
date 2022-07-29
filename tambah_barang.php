<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");
    
    session_start();

    $barang_id = $_GET['barang_id'];
    $preview = isset($_SESSION['preview']) ? $_SESSION['preview'] : false;

    $query = mysqli_query($connection, "SELECT nama_barang, gambar, harga FROM barang WHERE barang_id = '$barang_id'");

    $row = mysqli_fetch_assoc($query);
    
    $preview[$barang_id] = array("nama_barang" => $row["nama_barang"],
                                "gambar" => $row["gambar"],
                                "harga" => $row["harga"],
                                "quantity" => 1);

    $_SESSION["preview"] = $preview;

    header("location:".BASE_URL);
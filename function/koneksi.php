<?php

    $server = "localhost:3306";
    $username = "root";
    $password = "";
    $database = "aplikasisimulasi";

    $connection = mysqli_connect($server, $username, $password, $database) or die("Koneksi ke database gagal"); 
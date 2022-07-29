<?php
    session_start();

    $preview = $_SESSION['preview'];
    $barang_id = $_POST['barang_id'];
    $value = $_POST['value'];

    $preview[$barang_id]["quantity"] = $value;

    $_SESSION["preview"] = $preview;
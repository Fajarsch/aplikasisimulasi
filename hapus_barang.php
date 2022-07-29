<?php

    include_once("function/helper.php");

    session_start();

    $barang_id = $_GET['barang_id'];
    $preview = $_SESSION['preview'];

    unset($preview[$barang_id]);

    $_SESSION['preview'] = $preview;

    header("location:".BASE_URL."index.php?page=preview");
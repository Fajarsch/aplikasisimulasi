<?php 

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $button = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];
    $simpan_id = isset($_GET['simpan_id']) ? $_GET['simpan_id'] : "";

    if($button == "Delete") {
        mysqli_query($connection, "DELETE simpan.*, simpan_detail.* FROM simpan JOIN simpan_detail ON simpan.simpan_id = simpan_detail.simpan_id WHERE simpan_detail.simpan_id = '$simpan_id'");
    }

    header("location:".BASE_URL."index.php?page=my_profile&module=simpan&action=list");
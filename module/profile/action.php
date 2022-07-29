<?php 

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $button = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : "";

    $nama = isset($_POST['nama']) ? $_POST['nama'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : "";
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
    $jk = isset($_POST['jk']) ? $_POST['jk'] : "";
    $tgl_lahir = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : "";
    $update_gambar = "";

    if(!empty($_FILES["file"]["name"])) {
        $nama_file = $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/profile/".$nama_file);

        $update_gambar = ", gambar='$nama_file'";
    } 


    if($button == "Update") {
        mysqli_query($connection, "UPDATE user SET nama = '$nama',
                                                    email = '$email',
                                                    alamat = '$alamat',
                                                    phone = '$phone',
                                                    jenis_kelamin = '$jk',
                                                    tanggal_lahir = '$tgl_lahir'
                                                    $update_gambar WHERE user_id = '$user_id'");
    }

    header("location:".BASE_URL."index.php?page=my_profile&module=profile&action=profil");
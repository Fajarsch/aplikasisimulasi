<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($connection, "SELECT * FROM user WHERE email='$email' AND password='$password' AND status='on'");

    if(mysqli_num_rows($query) == 0) {
        header("location:". BASE_URL . "index.php?page=login&notif=true");
    } else {
        $row = mysqli_fetch_assoc($query);

        session_start();

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['level'] = $row['level'];

        if(isset($_SESSION["proses_barang"])) {
            unset($_SESSION["proses_barang"]);
            header("location: ".BASE_URL."data-simpan.html");
        } else {
            header("location: ".BASE_URL."index.php?page=my_profile&module=simpan&action=list");
        }
    }
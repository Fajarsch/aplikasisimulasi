<?php
    if($user_id) {
        header("location: ".BASE_URL);
    }
?>

<div id="container-user-akses">
    <h2>Hello</h2>
    <form action="<?php echo BASE_URL."proses_login.php"; ?>" method="POST">
        <?php
            $notif = isset($_GET['notif']) ? $_GET['notif'] : false;

            if($notif == true) {
                echo "<div class='notif'>
                    <strong>Perhatian!</strong>, Email atau Password salah
                    <span class='close_notif' onClick='closeNotif()'>&times;</span>
                </div>";
            }
        ?>

        <div class="element_form">
            <label for="">Email</label>
            <span><input type="text" name="email" placeholder="Masukkan Email" /></span>       
        </div>

        <div class="element_form">
            <label for="">Password</label>
            <span><input type="password" name="password" placeholder="Masukkan Password" /></span>
        </div>

        <div class="element_form">
            <span><input type="submit" value="Masuk"></span>
        </div>

        <div class="register_link">
            <h4>Belum memiliki akun? <a href="<?php echo BASE_URL."index.php?page=register"; ?>">Daftar Disini</a></h4>
        </div>
    </form>
</div>
<?php
    if($user_id) {
        header("location: ".BASE_URL);
    }
?>

<div id="container-user-akses">
    <h2>SELAMAT DATANG</h2>

    <form action="<?php echo BASE_URL."proses_register.php"; ?>" method="POST">

        <?php
            $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
            $nama_lengkap = isset($_GET['nama_lengkap']) ? $_GET['nama_lengkap'] : false; 
            $email = isset($_GET['email']) ? $_GET['email'] : false; 
            $phone = isset($_GET['phone']) ? $_GET['phone'] : false; 
            $alamat = isset($_GET['alamat']) ? $_GET['alamat'] : false; 

            if($notif == "require") {
                echo "<div class='notif'>
                    <strong>Perhatian!</strong>, wajib lengkapi form
                    <span class='close_notif' onClick='closeNotif()'>&times;</span>
                </div>";
            } else if($notif == "password") {
                echo "<div class='notif'>
                    <strong>Perhatian!</strong>, password tidak sama
                    <span class='close_notif' onClick='closeNotif()'>&times;</span>
                </div>";
            } else if($notif == "email") {
                echo "<div class='notif'>
                    <strong>Perhatian!</strong>, email sudah terdaftar
                    <span class='close_notif' onClick='closeNotif()'>&times;</span>
                </div>";
            }
        ?>

        <div class="element_form">
            <label for="">Nama</label>
            <span><input type="text" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" placeholder="Masukkan Nama" /></span>
        </div>

        <div class="element_form">
            <label for="">Telepon</label>
            <span><input class="input_phone" type="number" name="phone" value="<?php echo $phone; ?>" placeholder="0800 0000 0000" /></span>
        </div>

        <div class="element_form">
            <label for="">Alamat</label>
            <span><textarea name="alamat" id="" cols="30" rows="10" placeholder="Masukkan Alamat"><?php echo $alamat; ?></textarea></span>
        </div>

        <div class="element_form">
            <label for="">Email</label>
            <span><input type="text" name="email" value="<?php echo $email; ?>" placeholder="Masukkan Email" /></span>       
        </div>

        <div class="element_form">
            <label for="">Password</label>
            <span><input type="password" name="password" placeholder="Masukkan Password" /></span>
        </div>

        <div class="element_form">
            <label for="">Re-Password</label>
            <span><input type="password" name="re_password" placeholder="Masukkan Konfirmasi Password" /></span>
        </div>

        <div class="element_form">
            <span><input type="submit" value="Daftar"></span>
        </div>
    </form>
</div>
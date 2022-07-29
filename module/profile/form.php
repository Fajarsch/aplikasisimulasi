<?php
    if($user_id) {
        $query = mysqli_query($connection, "SELECT * FROM user WHERE user_id='$user_id'");
        $row = mysqli_fetch_assoc($query);

        $gambar = $row['gambar'];
        $nama = $row['nama'];
        $email = $row['email'];
        $alamat = $row['alamat'];
        $phone = $row['phone'];
        $jk = $row['jenis_kelamin'];
        $tgl_lahir = $row['tanggal_lahir'];

        $button = "Update";

        $keterangan_gambar = " (Klik pilih gambar jika ingin mengubah gambar)";

        $gambar = "<img src='".BASE_URL."images/profile/$gambar' style='width: 100px; vertical-align: middle;' />";
    }
?>

<div id="container_form">
    <form action="<?php echo BASE_URL."module/profile/action.php?user_id=$user_id"; ?>" method="POST" enctype="multipart/form-data">

        <div class="element_form">
            <label>Foto Profil<?php echo $keterangan_gambar; ?></label>
            <span>
                <input type="file" name="file" /><?php echo $gambar; ?>
            </span>
        </div>

        <div class="element_form">
            <label>Nama</label>
            <span><input type="text" name="nama" value="<?php echo $nama; ?>"></span>
        </div>

        <div class="element_form">
            <label>Email</label>
            <span><input type="text" name="email" value="<?php echo $email; ?>"></span>
        </div>

        <div class="element_form">
            <label for="">Nomor Telepon</label>
            <span><input class="input_phone" type="number" name="phone" value="<?php echo $phone; ?>" /></span>
        </div>

        <div class="element_form">
            <label for="">Alamat</label>
            <span><textarea name="alamat" id="" cols="30" rows="10"><?php echo $alamat; ?></textarea></span>
        </div>

        <div class="element_form">
            <label>Tanggal Lahir</label>
            <span><input type="date" name="tgl_lahir" value="<?php echo $tgl_lahir; ?>"></span>
        </div>

        <div class="element_form">
            <label>Jenis Kelamin</label>
            <span>
                <input type="radio" name="jk" value="Laki-laki" <?php if($jk == "Laki-laki") {echo "checked='true'"; } ?>  />Laki-laki
                <input type="radio" name="jk" value="Perempuan" <?php if($jk == "Perempuan") {echo "checked='true'"; } ?> />Perempuan
            </span>       
        </div>
        <div class="element_form">
            <span><input type="submit" name="button" value="<?php echo $button; ?>"/></span>       
        </div>
    </form>
</div>
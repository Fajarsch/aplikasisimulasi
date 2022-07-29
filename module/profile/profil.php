<?php
    if($user_id) {
        $queryDataProfile = mysqli_query($connection, "SELECT * FROM user WHERE user_id='$user_id'");
    }

    $row = mysqli_fetch_assoc($queryDataProfile);

    $tgl_lahir = tgl_lokal($row['tanggal_lahir']);

    echo "
        <div class='header_profile'>
            <h3>Profil Saya</h3>
            <p>Kelola informasi profil anda untuk mengontrol akun</p>
            <div class='btn_action'>
                <a class='btn_cetak' href='".BASE_URL."module/profile/reportprofileuser.php?user_id=$user_id' target='_blank'>
                    <i class='fa-solid fa-print'></i>Cetak
                </a>
            </div>
        </div>
                
        <div id='frame_profile'>
            <div class='profile_container'>
                <table class='profile_table'>
                    <tr>
                        <td class='profile_title'>Nama</td>
                        <td>$row[nama]</td>
                    </tr>
                    <tr>
                        <td class='profile_title'>Email</td>
                        <td>$row[email]</td>
                    </tr>
                    <tr>
                        <td class='profile_title'>Nomor Telepon</td>
                        <td>$row[phone]</td>
                    </tr>
                    <tr>
                        <td class='profile_title'>Jenis Kelamin</td>                        
                        <td>$row[jenis_kelamin]</td>
                    </tr>
                    <tr>
                        <td class='profile_title'>Tanggal Lahir</td>                        
                        <td>$tgl_lahir</td>
                    </tr>
                    <tr>
                        <td class='profile_title'>Alamat</td>                        
                        <td>$row[alamat]</td>
                    </tr>
                </table>
            </div>

            <div class='image_profile'>";
                    echo "<img class='frame_image_profile' src='".BASE_URL."images/profile/$row[gambar]' />
                        <a class='btn_ubah' href='".BASE_URL."index.php?page=my_profile&module=profile&action=form&user_id=$row[user_id]'>
                            <i class='fas fa-pen-to-square'></i>Edit
                        </a>";
        echo  "</div>
        </div>
    ";
?>
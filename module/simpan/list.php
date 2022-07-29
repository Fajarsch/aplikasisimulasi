<?php

    if($level == "superadmin") {
        $querySimpan = mysqli_query($connection, "SELECT * FROM simpan JOIN user ON simpan.user_id = user.user_id ORDER BY simpan.tanggal_simpan DESC");
    } else {
        $querySimpan = mysqli_query($connection, "SELECT * FROM simpan JOIN user ON simpan.user_id = user.user_id WHERE simpan.user_id='$user_id' ORDER BY simpan.tanggal_simpan DESC");
    }


    if(mysqli_num_rows($querySimpan) == 0) {
        echo "<h3>Belum ada simulasi yang tersimpan</h3>";
    } else {
        echo "<div class='container_table'>
            <table class='table_list'>
                <tr class='baris_title'>
                    <th class='kolom_kiri'>Nomor Simpan</th>
                    <th class='kolom_kiri'>Judul Simulasi</th>
                    <th class='kolom_kiri'>Tanggal Simpan</th>
                    <th class='kolom_tengah'>Action</th>
                </tr>
        ";

        while($row = mysqli_fetch_assoc($querySimpan)) {
            echo "
                <tr>
                    <td class='kolom_kiri'>$row[simpan_id]</td>
                    <td class='kolom_kiri'>$row[judul_simulasi]</td>
                    <td class='kolom_kiri'>$row[tanggal_simpan]</td>
                    <td class='kolom_tengah'>
                        <div class='frame_action'>
                            <a class='btn_ubah' href='".BASE_URL."index.php?page=my_profile&module=simpan&action=detail&simpan_id=$row[simpan_id]'>
                                <i class='fas fa-circle-info'></i>Detail
                            </a>
                            <a class='btn_hapus' href='".BASE_URL."module/simpan/action.php?button=Delete&simpan_id=$row[simpan_id]'>
                                <i class='fa-solid fa-trash'></i>Hapus
                            </a>
                        </div>
                    </td>
                </tr>
            ";
        }

        echo "</table>
            </div>"; 
    }
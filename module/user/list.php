<?php
    $queryAdmin = mysqli_query($connection, "SELECT * FROM user");

    if(mysqli_num_rows($queryAdmin) == 0)
    {
        echo "<h3>Saat ini belum ada data user yang dimasukan</h3>";
    } else {
        echo "<div class='container_table'>
                <table class='table_list'>";
        
            echo "<tr class='baris_title'>
                    <th class='kolom_nomor'>No</th>
                    <th class='kolom_kiri'>Nama</th>
                    <th class='kolom_kiri'>Email</th>
                    <th class='kolom_kiri'>Phone</th>
                    <th class='kolom_kiri'>Level</th>
                    <th class='kolom_tengah'>Status</th>
                    <th class='kolom_tengah'>Action</th>
                </tr>";

            $no = 1;
            while($rowUser = mysqli_fetch_assoc($queryAdmin))
            {
                echo "<tr>
                        <td class='kolom_nomor'>$no</td>
                        <td class='kolom_kiri'>$rowUser[nama]</td>
                        <td class='kolom_kiri'>$rowUser[email]</td>
                        <td class='kolom_kiri'>$rowUser[phone]</td>
                        <td class='kolom_kiri'>$rowUser[level]</td>
                        <td class='kolom_tengah'>$rowUser[status]</td>
                        <td class='kolom_tengah'>
                            <div class='frame_action'>                         
                                <a class='btn_ubah' href='".BASE_URL."index.php?page=my_profile&module=user&action=form&user_id=$rowUser[user_id]"."'>
                                    <i class='fas fa-pen-to-square'></i>Edit
                                </a>
                                <a class='btn_hapus' href='".BASE_URL."module/user/action.php?button=Delete&user_id=$rowUser[user_id]'>
                                    <i class='fa-solid fa-trash'></i>Hapus
                                </a>
                            </div>
                        </td>
                    </tr>";
            
                $no++;
            }
        
        //AKHIR DARI TABLE
        echo "</table>
            </div>";
    }
?>
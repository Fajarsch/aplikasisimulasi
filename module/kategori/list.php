<div id="frame_tambah">
    <a href="<?php echo BASE_URL."index.php?page=my_profile&module=kategori&action=form"; ?>" class="tombol_action">+ Tambah Kategori</a>
</div>

<?php 
    $pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
    $data_per_halaman = 5;
    $mulai_dari = ($pagination-1) * $data_per_halaman;

    $queryKategori = mysqli_query($connection, "SELECT * FROM kategori LIMIT $mulai_dari, $data_per_halaman");

    if(mysqli_num_rows($queryKategori) == 0) {
        echo "<h3>Kategori tidak tersedia</h3>";
    } else {
        echo "<div class='container_table'>
                <table class='table_list'>";
            echo "<tr class='baris_title'>
                    <th class='kolom_nomor'>No</th>
                    <th class='kolom_kiri'>Kategori</th>
                    <th class='kolom_tengah'>Status</th>
                    <th class='kolom_tengah'>Action</th>
            </tr>";

            $no = 1 + $mulai_dari;
            while($row = mysqli_fetch_assoc($queryKategori)) {
                echo "<tr>
                        <td class='kolom_nomor'>$no</td>
                        <td class='kolom_kiri'>$row[kategori]</td>
                        <td class='kolom_tengah'>$row[status]</td>
                        <td class='kolom_tengah'>
                            <div class='frame_action'>                        
                                <a class='btn_ubah' href='".BASE_URL."index.php?page=my_profile&module=kategori&action=form&kategori_id=$row[kategori_id]'>
                                    <i class='fas fa-pen-to-square'></i>Edit
                                </a>
                                <a class='btn_hapus' href='".BASE_URL."module/kategori/action.php?button=Delete&kategori_id=$row[kategori_id]'>
                                    <i class='fa-solid fa-trash'></i>Hapus
                                </a>
                                <a class='btn_cetak' href='".BASE_URL."module/kategori/reportbarangperkategori.php?kategori_id=$row[kategori_id]' target='_blank'>
                                    <i class='fa-solid fa-print'></i>Cetak
                                </a>
                            </div>
                        </td>
                    </tr>";

                    $no++;
            }

        echo "</table>
            </div>";

        $queryHitungKategori = mysqli_query($connection, "SELECT * FROM kategori");
        pagination($queryHitungKategori, $data_per_halaman, $pagination, "index.php?page=my_profile&module=kategori&action=list");
    }
?>
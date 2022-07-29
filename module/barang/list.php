<?php
    $search = isset($_GET["search"]) ? $_GET["search"] : false;

    $where = "";
    $search_url = "";
    if($search) {
        $search_url = "&search=$search";
        $where = "WHERE barang.nama_barang LIKE '%$search%'";
    }
?>

<div id="frame_tambah">
    <a href="<?php echo BASE_URL."index.php?page=my_profile&module=barang&action=form"; ?>" class="tombol_action">+ Tambah</a>
    <a class="btn_cetak" href="<?php echo BASE_URL."module/barang/reportbarang.php"; ?>" target="_blank">
        <i class="fa-solid fa-print"></i>Cetak
    </a>

    <div id="search_bar">
        <form action="<?php echo BASE_URL."index.php"; ?>" method="GET">
            <input type="hidden" name="page" value="<?php echo $_GET["page"]; ?>" />
            <input type="hidden" name="module" value="<?php echo $_GET["module"]; ?>" />
            <input type="hidden" name="action" value="<?php echo $_GET["action"]; ?>" />
            <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Cari.."/>
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
</div>

<?php
    $pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
    $data_per_halaman = 3;
    $mulai_dari = ($pagination-1) * $data_per_halaman;

    $queryBarang = mysqli_query($connection, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id = kategori.kategori_id $where LIMIT $mulai_dari, $data_per_halaman");

    if(mysqli_num_rows($queryBarang) == 0) {
        echo "<h3>Barang tidak tersedia</h3>";
    } else {
        echo "<div class='container_table'>
                <table class='table_list'>";
            echo "<tr class='baris_title'>
                    <th class='kolom_nomor'>No</th>
                    <th class='kolom_kiri'>Barang</th>
                    <th class='kolom_kiri'>Kategori</th>
                    <th class='kolom_kiri'>Harga</th>
                    <th class='kolom_tengah'>Status</th>
                    <th class='kolom_tengah'>Action</th>
            </tr>";

            $no = 1 + $mulai_dari;
            while($row = mysqli_fetch_assoc($queryBarang)) {
                echo "<tr>
                        <td class='kolom_nomor'>$no</td>
                        <td class='kolom_kiri'>$row[nama_barang]</td>
                        <td class='kolom_kiri'>$row[kategori]</td>
                        <td class='kolom_kiri'>".rupiah($row["harga"])."</td>
                        <td class='kolom_tengah'>$row[status]</td>
                        <td class='kolom_tengah'>
                            <div class='frame_action'>
                                <a class='btn_ubah' href='".BASE_URL."index.php?page=my_profile&module=barang&action=form&barang_id=$row[barang_id]'>
                                    <i class='fas fa-pen-to-square'></i>Edit
                                </a>
                                <a class='btn_hapus' href='".BASE_URL."module/barang/action.php?button=Delete&barang_id=$row[barang_id]'>
                                    <i class='fa-solid fa-trash'></i>Hapus
                                </a>
                            </div>
                        </td>
                    </tr>";

                    $no++;
            }

        echo "</table>
            </div>";

        $queryHitungBarang = mysqli_query($connection, "SELECT * FROM barang $where");
        pagination($queryHitungBarang,$data_per_halaman, $pagination, "index.php?page=my_profile&module=barang&action=list&$search_url");
    }
?>
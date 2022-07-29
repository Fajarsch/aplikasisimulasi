<div id="menu_kategori" class="submenu_kategori">
    <?php
        echo kategori($kategori_id);
    ?>
</div>

<div id="container_kanan">
    <?php
        $barang_id = $_GET['barang_id'];

        $query = mysqli_query($connection, "SELECT * FROM barang WHERE barang_id = '$barang_id' AND status = 'on'");

        $row = mysqli_fetch_assoc($query);

        echo "
            <div id='detail_barang'>
                <h3>$row[nama_barang]</h3>
                <div id='frame_gambar'>
                    <img src='".BASE_URL."images/barang/$row[gambar]' />
                </div>
                <div id='frame_harga'>
                    <span>".rupiah($row['harga'])."</span>
                    <a href='".BASE_URL."tambah_barang.php?barang_id=$row[barang_id]'>+ Tambah</a>
                </div>
                <div id='keterangan'>
                    <b>Keterangan : </b>$row[spesifikasi]
                </div>
            </div>
        ";
    ?>
</div>
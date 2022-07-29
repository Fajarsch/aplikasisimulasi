<?php
    $search = isset($_GET["search"]) ? $_GET["search"] : false;

    $where = "";
    $search_url = "";
    if($search) {
        $search_url = "&search=$search";
        $where = "WHERE barang.nama_barang LIKE '%$search%'";
    }
?>

<div id="menu_kategori" class="submenu_kategori">
    <?php
        echo kategori($kategori_id);
    ?>
</div>

<div id="container_kanan">
    <div class="search_bar_main">
        <form action="<?php echo BASE_URL."index.php"; ?>" method="GET">
            <input type="hidden" name="page" value="<?php echo $_GET["page"]; ?>" />
            <input type="text" name="search" placeholder="Cari.."/>
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
    <div id="frame_barang">
        <?php
            if($kategori_id) {
                $kategori_id = "AND barang.kategori_id='$kategori_id'";
            } 
            $query = mysqli_query($connection, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id = kategori.kategori_id $where AND barang.status='on' $kategori_id ORDER BY rand() DESC LIMIT 25");


            $no = 1;
            while($row = mysqli_fetch_assoc($query)) {
                $kategori = strtolower($row['kategori']);
                $barang = strtolower($row['nama_barang']);
                $barang = str_replace(" ", "-", $barang);

                echo "
                    <div class='card_product'>
                        <div class='card_product_image'>
                            <a href='".BASE_URL."$row[barang_id]/$kategori/$barang.html'>
                                <img src='".BASE_URL."images/barang/$row[gambar]' />
                            </a>
                        </div>
                        <div class='card_product_content'>
                            <div class='keterangan_gambar'>
                                <a href='".BASE_URL."$row[barang_id]/$kategori/$barang.html'>$row[nama_barang]</a>
                                <h4 class='price'>".rupiah($row['harga'])."</h4>
                            </div>
                            <button class='button_tambah'>
                                <a href='".BASE_URL."tambah_barang.php?barang_id=$row[barang_id]'>+ Tambah</a>
                            </button>
                        </div>
                    </div>
                ";
                $no++;
            }

            
        ?>
    </div>
</div>
<?php
    $barang_id = isset($_GET['barang_id']) ? $_GET['barang_id'] : false;

    $nama_barang = "";
    $kategori_id = "";
    $spesifikasi = "";
    $gambar = "";
    $stok = "";
    $harga = "";
    $status = "";
    $keterangan_gambar = "";
    $button = "Add";

    if($barang_id) {
        $queryBarang = mysqli_query($connection, "SELECT * FROM barang WHERE barang_id='$barang_id'");
        $row = mysqli_fetch_assoc($queryBarang);

        $nama_barang = $row['nama_barang'];
        $kategori_id = $row['kategori_id'];
        $spesifikasi = $row['spesifikasi'];
        $gambar = $row['gambar'];
        $harga = $row['harga'];
        $stok = $row['stok'];
        $status = $row['status'];
        $button = "Update";

        $keterangan_gambar = "(Klik pilih gambar jika ingin mengubah gambar)";

        $gambar = "<img src='".BASE_URL."images/barang/$gambar' style='width: 200px; vertical-align: middle;' />";
    }
?>

<script src="<?php echo BASE_URL."js/ckeditor/ckeditor.js"; ?>"></script>

<div id="container_form">
    <form action="<?php echo BASE_URL."module/barang/action.php?barang_id=$barang_id"; ?>" method="POST" enctype="multipart/form-data">
        <div class="element_form">
            <label>Barang</label>
            <span>
                <select name="kategori_id">
                    <?php
                        $query = mysqli_query($connection, "SELECT * FROM kategori WHERE status='on' ORDER BY kategori ASC");

                        while($row = mysqli_fetch_assoc($query)) {
                            if($kategori_id == $row['kategori_id']) {
                                echo "<option value='$row[kategori_id]' selected='true'>$row[kategori]</option>";
                            } else {
                                echo "<option value='$row[kategori_id]'>$row[kategori]</option>";
                            }
                        }
                    ?>
                </select>
            </span>       
        </div>
        
        <div class="element_form">
            <label>Nama Barang</label>
            <span><input type="text" name="nama_barang" value="<?php echo $nama_barang; ?>"></span>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Spesifikasi</label>
            <span><textarea name="spesifikasi" id="editor" cols="30" rows="10"><?php echo $spesifikasi; ?></textarea></span>
        </div>

        <div class="element_form">
            <label>Stok</label>
            <span><input type="text" name="stok" value="<?php echo $stok; ?>"></span>
        </div>

        <div class="element_form">
            <label>Harga</label>
            <span><input type="text" name="harga" value="<?php echo $harga; ?>"></span>
        </div>

        <div class="element_form">
            <label>Gambar Produk <?php echo $keterangan_gambar; ?></label>
            <span>
                <input type="file" name="file" /><?php echo $gambar; ?>
            </span>
        </div>

        <div class="element_form">
            <label>Status</label>
            <span>
                <input type="radio" name="status" value="on" <?php if($status == "on") {echo "checked='true'"; } ?>  />On
                <input type="radio" name="status" value="off" <?php if($status == "off") {echo "checked='true'"; } ?> />Off
            </span>       
        </div>
        <div class="element_form">
            <span><input type="submit" name="button" value="<?php echo $button; ?>"/></span>       
        </div>
    </form>
</div>

<script>
    CKEDITOR.replace("editor");
</script>
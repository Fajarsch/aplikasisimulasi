<?php

    $simpan_id = $_GET["simpan_id"];

    $query = mysqli_query($connection, "SELECT simpan.judul_simulasi, simpan.tanggal_simpan, user.nama FROM simpan JOIN user ON simpan.user_id=user.user_id WHERE simpan.simpan_id ='$simpan_id'");

    $row = mysqli_fetch_assoc($query);

    $tanggal_simpan = tgl_lokal($row['tanggal_simpan']);
    $judul_simulasi = $row['judul_simulasi'];
    $nama = $row['nama'];

?>

<div id="frame_detail_simpan">
    <h3>Detail Komponen Tersimpan</h3>
    <a class="btn_cetak" href="<?php echo BASE_URL."module/simpan/reportdetail.php?simpan_id=$simpan_id"; ?>" target="_blank">
        <i class="fa-solid fa-print"></i>Cetak
    </a>

    <hr/>

    <table>
        <tr>
            <td>Judul Simulasi</td>
            <td>:</td>
            <td><?php echo $judul_simulasi; ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?php echo $nama; ?></td>
        </tr>
        <tr>
            <td>Tanggal Simpan</td>
            <td>:</td>
            <td><?php echo $tanggal_simpan; ?></td>
        </tr>
    </table>
</div>

<div class="container_table">
    <table class="table_list">
        <tr class="baris_title">
            <th class="kolom_nomor">No</th>
            <th class="kolom_kiri">Nama Barang</th>
            <th class="kolom_tengah">Qty</th>
            <th class="kolom_kanan">Harga Satuan</th>
            <th class="kolom_kanan">Total</th>
        </tr>

        <?php
            $queryDetail = mysqli_query($connection, "SELECT simpan_detail.*, barang.nama_barang FROM simpan_detail JOIN barang ON simpan_detail.barang_id = barang.barang_id WHERE simpan_detail.simpan_id='$simpan_id'");

            $no = 1;
            $subtotal = 0;
            while($rowDetail = mysqli_fetch_assoc($queryDetail)) {

                $total = $rowDetail["harga"] * $rowDetail["quantity"];
                $subtotal = $subtotal + $total;
                echo "
                    <tr>
                        <td class='kolom_nomor'>$no</td>
                        <td class='kolom_kiri'>$rowDetail[nama_barang]</td>
                        <td class='kolom_tengah'>$rowDetail[quantity]</td>
                        <td class='kolom_kanan'>".rupiah($rowDetail["harga"])."</td>
                        <td class='kolom_kanan'>".rupiah($total)."</td>
                    </tr>
                ";

                $no++;
            }

            echo "<tr>
                    <td colspan='4' class='kolom_kanan'><b>Sub Total</b></td>
                    <td class='kolom_kanan'><b>".rupiah($subtotal)."</b></td>
                </tr>";
        ?>
    </table>
</div>
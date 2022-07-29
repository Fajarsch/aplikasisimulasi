<?php
    
    if($totalBarang == 0) {
        echo "<h3>Belum ada barang yang disimpan</h3>";
    } else {
        $no = 1;
        echo "<div class='container_table'>
                <table class='table_list'>";
            echo "<tr class='baris_title'>
                    <th class='kolom_nomor'>No</th>
                    <th class='kolom_tengah'>Image</th>
                    <th class='kolom_kiri'>Nama Barang</th>
                    <th class='kolom_kiri'>Qty</th>
                    <th class='kolom_kanan'>Harga Satuan</th>
                    <th class='kolom_kanan'>Total</th>
                </tr>";

        $subtotal = 0;
        foreach($preview as $key => $value) {
            $barang_id = $key;

            $nama_barang = $value["nama_barang"];
            $quantity = $value["quantity"];
            $gambar = $value["gambar"];
            $harga = $value["harga"];

            $total = $quantity * $harga;
            $subtotal = $subtotal + $total;

                echo "<tr>
                        <td class='kolom_nomor'>$no</td>
                        <td class='kolom_tengah'><Img src='".BASE_URL."images/barang/$gambar' width='50px' /></td>
                        <td class='kolom_kiri'>$nama_barang</td>
                        <td class='kolom_kiri'><input type='number' name='$barang_id' value='$quantity' class='update_quantity' /></td>
                        <td class='kolom_kanan'>".rupiah($harga)."</td>
                        <td class='kolom_kanan hapus_item'>".rupiah($total)." <a href='".BASE_URL."hapus_barang.php?barang_id=$barang_id'>X</a> </td>
                    </tr>";

                $no++;
            }

            echo "<tr>
                    <td colspan='5' class='kolom_kanan'><b>Sub Total</b></td>
                    <td class='kolom_kanan'><b>".rupiah($subtotal)."</b></td>
                </tr>";

            echo "</table>
                </div>";

            echo "<div id='frame_button_simpan'>
                    <a id='button_beranda' href='".BASE_URL."index.php'>Kembali Ke Beranda</a>
                    <a id='button_simpan' href='".BASE_URL."data-simpan.html'>Simpan</a>
                </div>";
    }
?>

<script>
    $(".update_quantity").on("input", function(e) {
        var barang_id = $(this).attr("name"); 
        var value = $(this).val();

        $.ajax({
            method: "POST",
            url: "update_barang.php",
            data: "barang_id="+barang_id+"&value="+value
        })
        .done(function(data) {
            location.reload();
        });
    });
</script>
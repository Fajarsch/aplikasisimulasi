<?php
    if($user_id == false) {
        $_SESSION["proses_barang"] = true;

        header("location: ".BASE_URL."login.html");
        exit;
    }
?>

<div class="container_split">
    <div class="container_split_half">
        <div id="frame_data_simpan">
            <h3>Simpan Pilihan</h3>

            <div id="frame_form_simpan">
                <form action="<?php echo BASE_URL."proses_simpan.php"; ?>" method="POST">
                    <div class="element_form">
                        <label>Judul</label>
                        <span><input type="text" name="judul_simulasi"></span>
                    </div>

                    <div class="element_form">
                        <span><input type="submit" value="Simpan"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container_split_half">
        <div id="frame_data_detail">
            <h3>Detail Komponen</h3>
            <div id="detail_barang">
                <table class="table_list">
                    <tr class="baris_title">
                        <th class="kolom_kiri">Nama Komponen</th>
                        <th class="kolom_tengah">Qty</th>
                        <th class="kolom_kanan">Total</th>
                    </tr>
                    
                    <?php

                        $subtotal = 0;
                        foreach($preview as $key => $value) {
                            $barang_id = $key;

                            $nama_barang = $value['nama_barang'];
                            $quantity = $value['quantity'];
                            $harga = $value['harga'];
                            
                            $total = $quantity * $harga;
                            $subtotal = $subtotal + $total;

                            echo "
                                <tr>
                                    <td class='kolom_kiri'>$nama_barang</td>
                                    <td class='kolom_tengah'>$quantity</td>
                                    <td class='kolom_kanan'>".rupiah($total)."</td>
                                </tr>
                            ";
                        }

                        echo "<tr>
                            <td colspan='2' class='kolom_kanan'><b>Sub Total</b></td>
                            <td class='kolom_kanan'><b>".rupiah($subtotal)."</b></td>
                        </tr>";
                    ?>

                </table>
            </div>
        </div>
    </div>
</div>
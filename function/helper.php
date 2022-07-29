<?php

    define("BASE_URL", "http://localhost/aplikasisimulasi/");

    function rupiah($nilai = 0) {
        $string = "Rp. ".number_format($nilai);
        
        return $string;
    }

    function kategori($kategori_id = false) {
        global $connection;

            $string = "<div class='side_logo'>";
                $string .= "<button class='btn_menu' onclick='closeMenu()'>";
                $string .= "<img src='".BASE_URL."images/menu.svg'>";
                $string .= "</button>";

                $string .= "<a href='".BASE_URL."index.php' id='logo'>";
                $string .= "<img class='svg_logo' src='".BASE_URL."images/logo.svg' />";
                $string .= "<img class='svg_logo_sub' src='".BASE_URL."images/logo_sub.svg' />";
                $string .= "<img class='svg_fan' src='".BASE_URL."images/fan.svg' />";
                $string .= "</a>";
                $string .= "</div>";

                $query = mysqli_query($connection, "SELECT * FROM kategori WHERE status='on'");

                while($row = mysqli_fetch_assoc($query)) {
                    $kategori = strtolower($row['kategori']);
                    if($kategori_id == $row['kategori_id']) {
                        $string .= "
                                <a class='list_menu active' href='".BASE_URL."$row[kategori_id]/$kategori.html'>$row[kategori]</a>
                        ";
                    } else {
                        $string .= "
                                <a class='list_menu' href='".BASE_URL."$row[kategori_id]/$kategori.html'>$row[kategori]</a>
                        ";
                    }
                }
                $string .= "
                                <a class='list_menu' href='".BASE_URL."index.php?page=simulasi'>Simulasi</a>
                        ";

        return $string;
    }

    function pagination($query, $data_per_halaman, $pagination, $url) {
        $total_data = mysqli_num_rows($query);
        $total_halaman = ceil($total_data / $data_per_halaman);

        $batas_posisi_nomor = 6;
        $batas_halaman = 10;
        $mulai_pagination = 1;
        $batas_pagination = $total_halaman;
        
        echo "<ul class='pagination'>";

        if($pagination > 1) {
            $back = $pagination - 1;
            echo "
                <li>
                    <a href='".BASE_URL."$url&pagination=$back'><< Back</a>
                </li>
                ";
        }

        if($total_halaman >= $batas_halaman) {
            if($pagination > $batas_posisi_nomor) {
                $mulai_pagination = $pagination - ($batas_posisi_nomor - 1);
            }
            $batas_pagination = ($mulai_pagination - 1) + $batas_halaman;

            if($batas_pagination > $total_halaman) {
                $batas_pagination = $total_halaman;
            }
        }


        for($i = $mulai_pagination; $i <= $batas_pagination; $i++) {
            if($pagination == $i) {
                echo "
                <li>
                    <a class='active' href='".BASE_URL."$url&pagination=$i'>$i</a>
                </li>
                ";
            } else {
                echo "
                <li>
                    <a href='".BASE_URL."$url&pagination=$i'>$i</a>
                </li>
                ";
            }
        }

        if($pagination < $total_halaman) {
            $next = $pagination + 1;
            echo "
                <li>
                    <a href='".BASE_URL."$url&pagination=$next'>Next >></a>
                </li>
                ";
        }
        echo "</ul>";
    }

    function tgl_lokal($tanggal){
        $bulan = array (1 =>'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
    
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
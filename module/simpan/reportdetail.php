<?php
    ob_start();
    require("../../fpdf/fpdf.php");
    require("../../function/koneksi.php");
    require("../../function/helper.php");

    class PDF extends FPDF {
        function Header() {
            $this -> Image('../../images/logo_report.png', 10, 11, 30);
            $this -> SetFont('Arial', 'B', 16);
            $this -> Cell(60);
            $this -> Cell(70, 10, 'Aplikasi Simulasi Rakit PC', 0, 1, 'C');

            $this -> Ln(5);

            $this->SetFont('Arial','',14);
            $this->Cell(60, 10, 'Detail Komponen Tersimpan', 0, 1, 'C');
        }

        // function Footer() {
        //     $this -> Line(150, 250, 200, 250);
        //     $this -> SetY(-45);
        //     $this -> SetX(140);
        //     $this -> SetFont('Arial', '', 10);
        //     $this -> Cell(70, 10, 'Detail Komponen Tersimpan', 0, 1, 'C');
        // }
    }

    $filepath = "reportDetailKomponen.pdf";
    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Arial', '', 10);

    $simpan_id = $_GET["simpan_id"];

    $query = mysqli_query($connection, "SELECT simpan.judul_simulasi, simpan.tanggal_simpan, user.nama FROM simpan JOIN user ON simpan.user_id=user.user_id WHERE simpan.simpan_id ='$simpan_id'");

    $row = mysqli_fetch_assoc($query);

    $pdf->Cell(30, 8, 'Judul Simulasi', 0, 0, 'L');
    $pdf->Cell(5, 8, ':', 0, 0, 'C');
    $pdf->Cell(30, 8, $row['judul_simulasi'], 0, 1, 'L');

    $pdf -> Ln(2);
    $pdf->Cell(30, 8, 'Nama', 0, 0,' L');
    $pdf->Cell(5, 8, ':', 0, 0, 'C');
    $pdf->Cell(30, 8, $row['nama'], 0, 1, 'L');

    $pdf -> Ln(2);
    $pdf->Cell(30, 8, 'Tanggal Simpan', 0, 0, 'L');
    $pdf->Cell(5, 8, ':', 0, 0, 'C');
    $pdf->Cell(30, 8, tgl_lokal($row['tanggal_simpan']), 0, 1, 'L');

    $pdf -> Ln(5);

    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(100, 10, 'Nama Barang', 1, 0, 'L');
    $pdf->Cell(10, 10, 'Qty', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Harga Satuan', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Total', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 10);

    $queryDetail = mysqli_query($connection, "SELECT simpan_detail.*, barang.nama_barang FROM simpan_detail JOIN barang ON simpan_detail.barang_id = barang.barang_id WHERE simpan_detail.simpan_id='$simpan_id'");

    $no = 1;
    $subtotal = 0;
    while($rowDetail = mysqli_fetch_assoc($queryDetail)) {

        $total = $rowDetail['harga'] * $rowDetail['quantity'];
        $subtotal = $subtotal + $total;

        $pdf->Cell(10, 10, $no, 1, 0, 'C');
        $pdf->Cell(100, 10, $rowDetail['nama_barang'], 1, 0, 'L');
        $pdf->Cell(10, 10, $rowDetail['quantity'], 1, 0, 'C');
        $pdf->Cell(35, 10, rupiah($rowDetail['harga']), 1, 0, 'C');
        $pdf->Cell(35, 10, rupiah($total), 1, 1, 'C');

        $no++;
    }

    $pdf->Cell(10, 10, '', 0, 0, 'C');
    $pdf->Cell(100, 10, '', 0, 0, 'L');
    $pdf->Cell(10, 10, '', 0, 0, 'C');
    $pdf->Cell(35, 10, 'Sub Total', 1, 0, 'C');
    $pdf->Cell(35, 10, rupiah($subtotal), 1, 1, 'C');

    $pdf -> Ln(10);
    $pdf -> Text(165, 235, tgl_lokal($row['tanggal_simpan']));
    $pdf -> Line(160, 260, 190, 260);
    $pdf -> SetY(-35);
    $pdf -> SetX(140);
    $pdf -> SetFont('Arial', '', 10);
    $pdf -> Cell(70, 10, $row['nama'], 0, 1, 'C');


    $pdf->Output("I", $filepath, false);
    ob_end_flush();
?>
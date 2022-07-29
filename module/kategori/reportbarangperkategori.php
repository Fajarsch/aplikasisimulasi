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
            $this->Cell(47, 10, 'Laporan Data Barang', 0, 1, 'C');

            $this->SetFont('Arial','',10);
            $this -> Text(180, 32, tgl_lokal(date("Y-m-d")));
        }

        // function Footer() {
        //     $this -> Line(150, 250, 200, 250);
        //     $this -> SetY(-45);
        //     $this -> SetX(140);
        //     $this -> SetFont('Arial', '', 10);
        //     $this -> Cell(70, 10, 'Detail Komponen Tersimpan', 0, 1, 'C');
        // }
    }

    $filepath = "reportDataBarang.pdf";
    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Arial', '', 10);

    $kategori_id =  $_GET['kategori_id'];

    $query = mysqli_query($connection, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id = kategori.kategori_id WHERE kategori.kategori_id = $kategori_id");

    $row = mysqli_fetch_assoc($query);

    $pdf->Cell(30, 8, 'Kategori', 0, 0, 'L');
    $pdf->Cell(5, 8, ':', 0, 0, 'C');
    $pdf->Cell(30, 8, $row['kategori'], 0, 1, 'L');

    $pdf -> Ln(5);

    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(100, 10, 'Nama Barang', 1, 0, 'L');
    $pdf->Cell(10, 10, 'Qty', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Kategori', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Harga Satuan', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 10);

    $queryDetail = mysqli_query($connection, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id = kategori.kategori_id WHERE kategori.kategori_id = $kategori_id");

    $no = 1;
    while($rowDetail = mysqli_fetch_assoc($queryDetail)) {

        $pdf->Cell(10, 10, $no, 1, 0, 'C');
        $pdf->Cell(100, 10, $rowDetail['nama_barang'], 1, 0, 'L');
        $pdf->Cell(10, 10, $rowDetail['stok'], 1, 0, 'C');
        $pdf->Cell(35, 10, $rowDetail['kategori'], 1, 0, 'C');
        $pdf->Cell(35, 10, rupiah($rowDetail['harga']), 1, 1, 'C');

        $no++;
    }

    $pdf -> Ln(10);
    $pdf -> Text(165, 235, "Admin ASRPC");
    $pdf -> Line(160, 260, 190, 260);
    $pdf -> SetY(-35);
    $pdf -> SetX(140);
    $pdf -> SetFont('Arial', '', 10);
    // $pdf -> Cell(70, 10, $row['nama'], 0, 1, 'C');

    $pdf->Output("I", $filepath, false);
    ob_end_flush();

?>
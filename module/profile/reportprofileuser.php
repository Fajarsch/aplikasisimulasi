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
            $this->Cell(37, 10, 'Data Profile User', 0, 1, 'C');

        }

        // function Footer() {
        //     $this -> Line(150, 250, 200, 250);
        //     $this -> SetY(-45);
        //     $this -> SetX(140);
        //     $this -> SetFont('Arial', '', 10);
        //     $this -> Cell(70, 10, 'Detail Komponen Tersimpan', 0, 1, 'C');
        // }
    }

    $filepath = "reportProfileUser.pdf";
    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Arial', '', 10);

    $user_id = $_GET["user_id"];

    $query = mysqli_query($connection, "SELECT * FROM user WHERE user_id ='$user_id'");

    $row = mysqli_fetch_assoc($query);

    $pdf -> Ln(3);

    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(40, 10, 'Nama', 0, 0, 'L');
    $pdf->Cell(5, 10, ':', 0, 0, 'C');
    $pdf->Cell(80, 10, $row['nama'], 0, 1, 'L');

    $pdf->Cell(40, 10, 'Email', 0, 0, 'L');
    $pdf->Cell(5, 10, ':', 0, 0, 'C');
    $pdf->Cell(80, 10, $row['email'], 0, 1, 'L');

    $pdf->Cell(40, 10, 'Nomor Telepon', 0, 0, 'L');
    $pdf->Cell(5, 10, ':', 0, 0, 'C');
    $pdf->Cell(80, 10, $row['phone'], 0, 1, 'L');

    $pdf->Cell(40, 10, 'Jenis Kelamin', 0, 0, 'L');
    $pdf->Cell(5, 10, ':', 0, 0, 'C');
    $pdf->Cell(80, 10, $row['jenis_kelamin'], 0, 1, 'L');

    $pdf->Cell(40, 10, 'Tanggal Lahir', 0, 0, 'L');
    $pdf->Cell(5, 10, ':', 0, 0, 'C');
    $pdf->Cell(80, 10, $row['tanggal_lahir'], 0, 1, 'L');

    $pdf->Cell(40, 10, 'Alamat', 0, 0, 'L');
    $pdf->Cell(5, 10, ':', 0, 0, 'C');
    $pdf->Cell(80, 10, $row['alamat'], 0, 1, 'L');

    $pdf->setX(50);
    $pdf->Image("../../images/profile/$row[gambar]", 150, 30, 30);

    $pdf->Output("I", $filepath, false);
    ob_end_flush();
?>
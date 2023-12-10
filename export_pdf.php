<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'system/functions.php';

// Konfigurasi
$per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

// Query data dari database
$sql = "SELECT * FROM stockbarang ORDER BY id ASC LIMIT $start, $per_page";
$query = mysqli_query($conn, $sql);

// Menghitung total baris
$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM stockbarang"));
$total_pages = ceil($total_rows / $per_page);

// Membuat objek mPDF
$mpdf = new Mpdf\Mpdf();

// CSS untuk tampilan PDF
$css = '
    body {
        font-family: Arial, sans-serif;
    }
    h1 {
        color: #333;
        text-align: center;
        font-size: 24px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    thead {
        background-color: #f2f2f2;
    }
    .pagination {
        text-align: center;
        margin-top: 10px;
    }
    ';

// Tambahkan CSS ke mPDF
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);

// Header PDF
$mpdf->SetHeader('Stock Barang - PT. ABC');

// Membuat halaman PDF
$mpdf->WriteHTML('
    <h1>Stock Barang - PT. ABC</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Tanggal Update</th>
            </tr>
        </thead>
        <tbody>
');

// Menambahkan data dari database ke dalam tabel PDF
while ($row = mysqli_fetch_array($query)) {
    $mpdf->WriteHTML('
        <tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['nama_barang'] . '</td>
            <td>' . $row['jumlah'] . '</td>
            <td>' . $row['tanggalupdate'] . '</td>
        </tr>
    ');
}

$mpdf->WriteHTML('
        </tbody>
    </table>
');

// Menampilkan navigasi halaman PDF
$mpdf->WriteHTML('
    <div class="pagination">
        Halaman ' . $page . ' dari ' . $total_pages . '
    </div>
');

// Output PDF
$mpdf->Output('Stock_Barang', "I"); // Menampilkan PDF di browser dengan nama file "Stock_Barang.pdf"
?>
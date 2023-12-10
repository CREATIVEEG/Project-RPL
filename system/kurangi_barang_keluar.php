<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang_keluar = $_POST["nama_barang_keluar"];
    $jumlahkeluar = $_POST["jumlahkeluar"];
    $tanggalkeluar = $_POST["tanggalkeluar"];

    $sql_keluar = "INSERT INTO barang_keluar (nama_barang, jumlahkeluar, tanggalkeluar) VALUES ('$nama_barang_keluar', $jumlahkeluar, '$tanggalkeluar')";
    $result_keluar = $conn->query($sql_keluar);

    if ($result_keluar === TRUE) {
        $sql_stock = "UPDATE stockbarang SET jumlah = jumlah - $jumlahkeluar, tanggalupdate = '$tanggalkeluar' WHERE nama_barang = '$nama_barang_keluar'";
        $conn->query($sql_stock);

        echo "<script> alert('Barang keluar berhasil ditambahkan.');window.location.href = '../pages/barangkeluar.php';</script>";
    } else {
        echo "Error: " . $sql_keluar . "<br>" . $conn->error;
    }
}

$conn->close();
?>
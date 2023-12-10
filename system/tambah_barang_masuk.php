<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang_masuk = $_POST["nama_barang_masuk"];
    $jumlahmasuk = $_POST["jumlahmasuk"];
    $tanggalmasuk = $_POST["tanggalmasuk"];

    $sql_masuk = "INSERT INTO barang_masuk (nama_barang, jumlahmasuk, tanggalmasuk) VALUES ('$nama_barang_masuk', $jumlahmasuk, '$tanggalmasuk')";
    $result_masuk = $conn->query($sql_masuk);

    if ($result_masuk === TRUE) {
        $sql_stock = "UPDATE stockbarang SET jumlah = jumlah + $jumlahmasuk, tanggalupdate = '$tanggalmasuk' WHERE nama_barang = '$nama_barang_masuk'";
        $conn->query($sql_stock);

        echo "<script> alert('Barang masuk berhasil ditambahkan.');window.location.href = '../pages/barangmasuk.php';</script>";
    } else {
        echo "Error: " . $sql_masuk . "<br>" . $conn->error;
    }
}

$conn->close();
?>

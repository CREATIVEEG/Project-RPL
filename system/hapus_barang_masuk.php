<?php
// Sertakan file koneksi ke database
require 'functions.php';

// Pastikan parameter id terkirim
if (isset($_GET['id'])) {
    // Ambil id_barangmasuk dari parameter URL
    $id_barangmasuk = $_GET['id'];

    // Query SQL untuk menghapus data
    $sql_delete = "DELETE FROM barang_masuk WHERE id_barangmasuk = $id_barangmasuk";

    // Jalankan query
    if ($conn->query($sql_delete) === TRUE) {
        // Data berhasil dihapus, arahkan kembali ke halaman sebelumnya
        header("Location: ../pages/barangmasuk.php");
        exit;
    } else {
        // Jika ada kesalahan dalam eksekusi query
        echo "Error: " . $conn->error;
    }
} else {
    // Jika parameter id tidak terkirim, mungkin terjadi kesalahan
    echo "Invalid request!";
}

// Tutup koneksi database
$conn->close();
?>

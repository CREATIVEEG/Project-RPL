<?php

session_start();

require '../system/functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: ../index.php");
  exit;
}

$sql_barang = "SELECT nama_barang FROM stockbarang";
$result_barang = $conn->query($sql_barang);

$sql_barang_masuk = "SELECT * FROM barang_masuk";
$result_barang_masuk = $conn->query($sql_barang_masuk);

// Memproses hasil query
if ($result_barang->num_rows > 0) {
  $barang_options = "";
  while ($row = $result_barang->fetch_assoc()) {
    $barang_options .= "<option value='" . $row["nama_barang"] . "'>" . $row["nama_barang"] . "</option>";
  }
} else {
  $barang_options = "<option value=''>Tidak ada barang</option>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INCOME SIMIN | PT. ABC</title>

  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

</head>

<body id="bgmasuk">
  <!-- Header -->
  <div class="container pb-3"></div>
  <nav class="navbar bg-primary fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">SISTEM INFORMASI MANAGEMEN INVENTORY</a>
    </div>
  </nav>
  </div>
  <!-- Header end -->

  <!-- Sidebar -->
  <div class="sidenav">
    <a id="menu" class="btn" href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a id="menu" class="btn" href="#"><i class="bi bi-inboxes-fill"></i> Barang Masuk</a>
    <a id="menu" class="btn" href="barangkeluar.php"><i class="bi bi-inbox-fill"></i> Barang Keluar</a>
    <a id="menu" class="btn" href="stockbarang.php"><i class="bi bi-clipboard2-data-fill"></i></i> Stock Barang</a>
    <a class="btn" role="button" id="logout" href="../system/logout.php"><i class="bi bi-power"
        style="font-size: 35px;"></i></a>
  </div>
  <!-- Sidebar End -->

  <!-- Tambah -->
  <div class="container ps-5" id="jarak">
    <div class="card">
      <div class="card-header bg-body-secondary">
        Barang Masuk
      </div>
      <div class="card-header">
        <button class="btn btn-primary mb-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
          aria-expanded="false" aria-controls="collapseExample">
          Tambah Barang
        </button>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <form action="../system/tambah_barang_masuk.php" method="POST">
              <div class="mb-3 row">
                <label for="nama_barang_masuk" class="col-sm-2 col-form-label">Nama Barang:</label>
                <div class="col-sm-10">
                  <select name="nama_barang_masuk" id="nama_barang_masuk">
                    <?php echo $barang_options; ?>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="jumlahmasuk" class="col-sm-2 col-form-label">Jumlah Masuk:</label>
                <div class="col-sm-10">
                  <input type="number" name="jumlahmasuk" id="jumlahmasuk" required>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="tanggalmasuk" class="col-sm-2 col-form-label">Tanggal Masuk:</label>
                <div class="col-sm-10">
                  <input type="datetime-local" name="tanggalmasuk" id="tanggalmasuk" required>
                </div>
              </div>
              <div class="col-12">
                <input type="submit" value="Simpan Data" class="btn btn-primary" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Jumlah Masuk</th>
              <th scope="col">Tanggal Masuk</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row_barang_masuk = $result_barang_masuk->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row_barang_masuk["id_barangmasuk"] . "</td>";
              echo "<td>" . $row_barang_masuk["nama_barang"] . "</td>";
              echo "<td>" . $row_barang_masuk["jumlahmasuk"] . "</td>";
              echo "<td>" . $row_barang_masuk["tanggalmasuk"] . "</td>";
              echo "<td><button class='btn btn-danger' onclick='hapusData(" . $row_barang_masuk["id_barangmasuk"] . ")'>Hapus</button></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
          <script>
            function hapusData(id_barangmasuk) {
              // Konfirmasi pengguna sebelum menghapus
              var konfirmasi = confirm("Anda yakin ingin menghapus data?");

              if (konfirmasi) {
                window.location.href = '../system/hapus_barang_masuk.php?id=' + id_barangmasuk;
              }
            }
          </script>
        </table>
      </div>
    </div>
    <!-- Tambah end -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
</body>

</html>
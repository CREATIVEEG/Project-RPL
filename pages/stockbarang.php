<?php

session_start();

require '../system/functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: ../index.php");
  exit;
}

$nama_barang = "";
$jumlah = "";
$tanggalupdate = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
  $op = $_GET['op'];
} else {
  $op = "";
}
if ($op == 'delete') {
  $id = $_GET['id'];
  $sql1 = "DELETE FROM stockbarang WHERE id = '$id'";
  $q1 = mysqli_query($conn, $sql1);
  if ($q1) {
    $sukses = "Berhasil hapus data";
  } else {
    $error = "Gagal melakukan hapus data";
  }
}
if ($op == 'edit') {
  $id = $_GET['id'];
  $sql1 = "SELECT * FROM stockbarang WHERE id = '$id'";
  $q1 = mysqli_query($conn, $sql1);
  $r1 = mysqli_fetch_array($q1);
  $nama_barang = $r1['nama_barang'];
  $tanggalupdate = $r1['tanggalupdate'];

  if ($nama_barang == '') {
    $error = "Data tidak ditemukan";
  }
}
if (isset($_POST['simpan'])) { //untuk create
  $nama_barang = $_POST['nama_barang'];
  $tanggalupdate = $_POST['tanggalupdate'];

  if ($nama_barang) {
    if ($op == 'edit') { //untuk update
      $sql1 = "UPDATE stockbarang SET nama_barang='$nama_barang', tanggalupdate='$tanggalupdate' WHERE id = '$id'";
      $q1 = mysqli_query($conn, $sql1);
      if ($q1) {
        $sukses = "Data berhasil diupdate";
      } else {
        $error = "Data gagal diupdate";
      }
    } else { //untuk insert
      $sql1 = "INSERT INTO stockbarang(nama_barang,jumlah,tanggalupdate) values ('$nama_barang','0','$tanggalupdate')";
      $q1 = mysqli_query($conn, $sql1);
      if ($q1) {
        $sukses = "Berhasil memasukkan data baru";
      } else {
        $error = "Gagal memasukkan data";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>STOCK SIMIN | PT. ABC</title>

  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

</head>

<body id="bgstock">
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
    <a id="menu" class="btn" href="barangmasuk.php"><i class="bi bi-inboxes-fill"></i> Barang Masuk</a>
    <a id="menu" class="btn" href="barangkeluar.php"><i class="bi bi-inbox-fill"></i> Barang Keluar</a>
    <a id="menu" class="btn" href="#"><i class="bi bi-clipboard2-data-fill"></i></i> Stock Barang</a>
    <a class="btn" role="button" id="logout" href="../system/logout.php"><i class="bi bi-power"
        style="font-size: 35px;"></i></a>
  </div>
  <!-- Sidebar End -->

  <!-- Tambah -->
  <div class="container ps-5" id="jarak">
    <div class="card">
      <div class="card-header bg-body-secondary">
        Stock Barang
      </div>
      <div class="card-header">
        <button class="btn btn-primary mb-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
          aria-expanded="false" aria-controls="collapseExample">
          Tambah Stock
        </button>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <?php
            if ($error) {
              ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
              </div>
              <?php
              header("refresh:4;url=stockbarang.php"); //5 : detik
            }
            ?>
            <?php
            if ($sukses) {
              ?>
              <div class="alert alert-success" role="alert">
                <?php echo $sukses ?>
              </div>
              <?php
              header("refresh:4;url=stockbarang.php");
            }
            ?>
            <form action="" method="POST">
              <div class="mb-3 row">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                    value="<?php echo $nama_barang ?>">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="tanggalupdate" class="col-sm-2 col-form-label">Tanggal Ditambah:</label>
                <div class="col-sm-10">
                  <input type="datetime-local" class="form-control" id="tanggalupdate" name="tanggalupdate"
                    value="<?php echo $tanggalupdate ?>">
                </div>
              </div>
              <div class="col-12">
                <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php
        // Konfigurasi paginasi
        $per_page = 5;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $start = ($page - 1) * $per_page;

        $sql2 = "SELECT * FROM stockbarang ORDER BY id ASC LIMIT $start, $per_page";
        $q2 = mysqli_query($conn, $sql2);

        $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM stockbarang"));
        $total_pages = ceil($total_rows / $per_page);

        $true_urut = ($page - 1) * $per_page + 1;

        ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Jumlah Barang</th>
              <th scope="col">Tanggal Update</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($r2 = mysqli_fetch_array($q2)) {
              $id = $r2['id'];
              $nama_barang = $r2['nama_barang'];
              $jumlah = $r2['jumlah'];
              $tanggalupdate = $r2['tanggalupdate'];
              ?>
              <tr>
                <th scope="row">
                  <?php echo $true_urut++; ?>
                </th>
                <td scope="row">
                  <?php echo $nama_barang; ?>
                </td>
                <td scope="row">
                  <?php echo $jumlah; ?>
                </td>
                <td scope="row">
                  <?php echo $tanggalupdate; ?>
                </td>
                <td scope="row">
                  <a href="stockbarang.php?op=edit&id=<?php echo $id; ?>"><button type="button"
                      class="btn btn-warning">Ubah</button></a>
                  <a href="stockbarang.php?op=delete&id<?php echo $id; ?>"
                    onclick="return confirm('Yakin mau hapus data?')">
                    <button type="button" class="btn btn-danger">Hapus</button>
                  </a>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>

        <!-- Tampilkan navigasi halaman -->
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
              <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>">
                  <?php echo $i; ?>
                </a>
              </li>
            <?php endfor; ?>
          </ul>
          <a class="btn btn-primary" href='../export_pdf.php?page=<?php echo $page; ?>' target="_blank">Cetak</a>
        </nav>
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
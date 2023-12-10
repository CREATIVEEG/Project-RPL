<?php

session_start();

require '../system/functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: ../index.php");
  exit;
}
// Query to get the number of distinct item types
$sql_item_types = "SELECT COUNT(DISTINCT nama_barang) AS total_item_types FROM stockbarang";
$result_item_types = $conn->query($sql_item_types);
$totalItemTypes = $result_item_types->fetch_assoc()['total_item_types'];

// Query to get the total quantity of items
$sql_total_quantity = "SELECT SUM(jumlah) AS total_quantity FROM stockbarang";
$result_total_quantity = $conn->query($sql_total_quantity);
$totalQuantity = $result_total_quantity->fetch_assoc()['total_quantity'];

// Query to get the total number of administrators
$sql_admin_count = "SELECT COUNT(*) AS total_admins FROM admin_gudang";
$result_admin_count = $conn->query($sql_admin_count);
$totalAdmins = $result_admin_count->fetch_assoc()['total_admins'];

$sql_admin_name = "SELECT nama FROM admin_gudang LIMIT 1";
$result_admin_name = $conn->query($sql_admin_name);

// Check if the query was successful and fetch the admin's name
if ($result_admin_name && $result_admin_name->num_rows > 0) {
  $row_admin_name = $result_admin_name->fetch_assoc();
  $namaadmin = $row_admin_name['nama'];
} else {
  $namaadmin = "Admin";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DASH SIMIN | PT. ABC</title>

  <link rel="stylesheet" href="dashstyle.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

</head>

<body id="bgdash">
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
    <a id="menu" class="btn" href="#"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a id="menu" class="btn" href="barangmasuk.php"><i class="bi bi-inboxes-fill"></i> Barang Masuk</a>
    <a id="menu" class="btn" href="barangkeluar.php"><i class="bi bi-inbox-fill"></i> Barang Keluar</a>
    <a id="menu" class="btn" href="stockbarang.php"><i class="bi bi-clipboard2-data-fill"></i> Stock Barang</a>
    <a class="btn" role="button" id="logout" href="../system/logout.php"><i class="bi bi-power"
        style="font-size: 35px;"></i></a>
  </div>
  <!-- Sidebar End -->

  <!-- Dashboard Section -->
  <div class="container" id="jarak">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <i class="bi bi-box" id="icon"></i>
            <h5 class="card-title">Jumlah Jenis Barang</h5>
            <p class="card-text">
              <?php echo $totalItemTypes; ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <i class="bi bi-archive" id="icon"></i>
            <h5 class="card-title">Jumlah Total Barang</h5>
            <p class="card-text">
              <?php echo $totalQuantity; ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <i class="bi bi-person" id="icon"></i>
            <h5 class="card-title" >Jumlah Admin</h5>
            <p class="card-text">
              <?php echo $totalAdmins; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Dashboard Section -->

  <!-- Greeting Message -->
  <div class="container mt-3" id="greeting">
    <p>Hallo, selamat datang dan selamat beraktifitas
      <?php echo $namaadmin; ?>
    </p>
  </div>
  <!-- End Greeting Message -->




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
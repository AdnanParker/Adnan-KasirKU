<?php
include("Koneksi/connect.php");
include("header.php");

// Check if the search form is submitted
if(isset($_GET['search'])){
    $search = $_GET['search'];
    // You may need to sanitize and validate the input before using it in the query
    $search = mysqli_real_escape_string($conn, $search);

    // Modify the SQL query to include the search condition
    $sql = $conn->query("SELECT * FROM produk WHERE NamaProduk LIKE '%$search%'");
} else {

    $sql = $conn->query("SELECT * FROM produk");
}

?>

<body>

<style>
  .main-content {
    margin-top: 60px;
  }

  .card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }

  .card {
    margin-bottom: 20px;
  }

  .navbar {
    height: 100px;
  }

  .navbar-brand {
    font-size: 20px;
  }

  .navbar-nav {
    margin-top: -5px;
  }

  .navbar {
    position: absolute;
    width: 70%;
    left: 0;
    right: 0;
  }

  .search-form {
    margin-left: auto; /* Push the search form to the right */
  }

</style>

<nav class="navbar navbar-expand-lg navbar-primary fixed-top mx-auto">
  <div class="card bg-warning container-fluid">
    <b><i class="navbar-brand">Pilih Menu mu!</i></b>
    <div class="navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaksi.php">Transaksi</a>
        </li>
      </ul>
      
      <!-- Search Form -->
      <form class="form-inline ml-auto" method="GET" action="">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="p-5" id="main-content">
  <div class="bg-dark card mt-5">
    <?php
    while ($data = $sql->fetch_assoc()) {
      ?>
      <div class='card' style='width: 18rem; margin: 50px;'>
        
        <?php echo "<img class='card-img-top' src='foto/" . $data['Foto'] . "' width='230' height='250'>" ?>
        <div class='card-body'>
          <h5 class='card-title'><?php echo $data['NamaProduk']?></h5>
          <p class='card-text'>Harga: RP.<?php echo number_format($data['Harga']) ?></p>
          <p class='card-text'>Stok: <?php echo $data['Stok']?></p>
          <a href='transaksi.php' class='btn btn-md btn-primary float-end'>Beli</a>
        </div>
        
      </div>

      <?php
    }
    ?>
  </div>
</div>

</body>
</html>
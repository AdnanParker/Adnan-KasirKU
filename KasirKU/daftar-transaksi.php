<?php
include("header.php");
?>
<style>
  #main-content {
    margin-top: 40px;
  }

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

</style>
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-primary fixed-top mx-auto">
     <div class="card bg-warning container-fluid">
        <b><i class="navbar-brand">Total Harga</i></b>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaksi.php">Transaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <div class="p-5" id="main-content">
          <a href="transaksi.php" class="btn btn-md btn-primary float-end">Tambah Transaksi+</a>
          <div class="card mt-5">
            <div class="card-body">
            <table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal Transaksi</th>
                <th>Nama Pemesan</th>
				<th>Menu</th>	
			</tr>
		</thead>
		<tbody>
        <?php
            include("Koneksi/connect.php");

            $sql = $conn->query("SELECT * FROM penjualan ORDER BY PenjualanID DESC LIMIT 1");
            while ($data= $sql->fetch_assoc()) {
        ?>
              <tr>
                <td><?php echo $data['PenjualanID']?></td>
                <td><?php echo $data['TanggalPenjualan']?></td>
                <td>
                  <?php
                    $sql2 = $conn->query("SELECT * FROM pelanggan WHERE PelangganID = '".$data['PenjualanID']."'");
                    while ($data2= $sql2->fetch_assoc()) {
                      echo $data2['NamaPelanggan'];
                    }
                  ?>
                </td>
                <td>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Produk</th> 
                                <th class="col-1">Jumlah</th>
                                <th class="col-1">Harga</th>
                                <th class="col-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          // Fetch details for the current Penjualan
                          $sql3 = $conn->query("SELECT * FROM detailpenjualan WHERE DetailID = '" . $data['PenjualanID'] . "'");
                            
                          $totalharga = 0;

                          while ($data3= $sql3->fetch_assoc()) {
                        ?>
                            <tr>
                              <td>
                              <?php
                                $sql4 = $conn->query("SELECT * FROM produk WHERE ProdukID = '" . $data3['ProdukID'] . "' ");
                                while ($data4= $sql4->fetch_assoc()) {
                                    echo $data4['NamaProduk'];
                                }
                              ?>
                              </td>
                              <td><?php echo $data3['JumlahProduk']?> Pcs</td>
                              <td>RP.<?php echo number_format($data3['Subtotal']) ?></td>
                              <td><?php echo"<a href='hapus-menu.php?id=$data3[PenjualanID]' class='btn btn-sm btn-danger'>Hapus</a>" ?></td>
                            </tr>

                            <?php
                              $totalproduk = $data3['JumlahProduk'] * $data3['Subtotal'];
                              $totalharga += $totalproduk;
                            }
                            ?>

                            <tr>
                            <td colspan='2'><strong>Total Harga:</strong></td>
                            <td colspan='2'><strong>RP.<?php echo number_format("$totalharga") ?></strong></td>
                            </tr>
                            

                        </tbody>
                    </table>
                </td>
                <?php
                echo "</tr>";
            }
              
        ?>
		</tbody>
	</table>
  <a href="cetaktransaksi.php" target="_blank" class="btn btn-md btn-success float-end">Cetak Transaksi</a>
            </div>
          </div>
        </div>
</body>


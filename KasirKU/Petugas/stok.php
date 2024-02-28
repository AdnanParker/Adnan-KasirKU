<h2>Daftar Barang</h2>

<form action="?page=search-tambah" method="post">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Cari Barang" name="search_query" aria-label="Cari Barang" aria-describedby="button-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
        </div>
    </div>
</form>

<a class="btn btn-primary btn-md" href="?page=tambah-barang">Tambah Barang</a>

<br>
<br>

<?php
    require '../Koneksi/connect.php';

    if(isset($_POST['search_query'])){
        $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
        $sql = "SELECT * FROM produk WHERE NamaProduk LIKE '%$search_query%' ORDER BY ProdukID ASC";
    } else {
        $sql = "SELECT * FROM produk ORDER BY ProdukID ASC";
    }

    $result = mysqli_query($conn, $sql);

    $no = 1;
?>


<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Terjual</th>
            <th>Foto</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($data = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['NamaProduk']?></td>
                <td><?php echo $data['Harga']?></td>
                <td><?php echo $data['Stok']?></td>
                <td><?php echo $data['Terjual']?></td>
                <td><?php echo "<img src='../foto/".$data['Foto']."' width='70' height='70'>"; ?></td>
                <td align="center" width="12%">
                    <a href="?page=edit-stok&ProdukID=<?= $data['ProdukID'] ?>" class="badge badge-primary p-2" title="Edit"><i class="">Edit</i></a>
                    <a href="?page=hapus-produk&ProdukID=<?= $data['ProdukID']?>" onclick="return confirm('Yakin Mau Hapus?')" class="badge badge-danger p-2 delete-data" title='Delete'><i class="button">Hapus</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
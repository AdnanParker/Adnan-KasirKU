<?php 

include "../Koneksi/connect.php";

error_reporting(0);
session_start();

if (isset($_SESSION['NamaUser'])) {
  echo "<script>alert('Maaf Anda Sudah login, Silahkan Logout terlebih dahulu'); window.location.replace('index.php');</script>";
}

if (isset($_POST['submit'])) {
    $NamaUser = $_POST['NamaUser'];
    $Password = md5($_POST['Password']);

    $sql = "SELECT * FROM user WHERE NamaUser='$NamaUser' AND Password='$Password' ";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        // Mengambil informasi level dari database
        $level = $row['Level'];
        $_SESSION['Level'] = $level;

        $_SESSION['NamaUser'] = $row['NamaUser'];

        header("Location: index.php");        
        echo "<script>alert('Berhasil Masuk!')</script>";
    } else {
        echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login User</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('../img/ore.jpg'); /* Replace 'path/to/your/image.jpg' with the actual path to your image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(6px);
        }

    </style>
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card text-black">
            <div class="card-header bg-default">
              <form action="" class="form-signin" method="post"> 
              <center><h3 class="">Login</h3></center>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="mb-4 mt-4">
                      <table for="" class="form-label">Nama</table>
                      <input type="text" name="NamaUser" class="form-control" placeholder="Username" required autofocus>
                    </div>
                    <div class="mb-4 mt-4">
                      <label for="" class="form-label">Password</label>
                      <input type="password" name="Password" class="form-control" placeholder="Password" required autofocus>
                    </div>
                    <button name="submit" class="btn btn-primary">Login</button>
                    <a href="../index.php" class="btn btn-warning">Customer Page</a>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../Bootstrap/bootstrap.min.js"></script>
    <script src="../Bootstrap/jquery.min.js "></script>
  </body>
</html>
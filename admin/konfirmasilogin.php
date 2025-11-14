<?php
include('../koneksi/koneksi.php'); 

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($user)) {
        header("Location: index.php?gagal=userKosong");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?gagal=passKosong");
        exit();
    }

    $username = mysqli_real_escape_string($koneksi, $user);
    $password = mysqli_real_escape_string($koneksi, md5($pass));

    $sql = "select `id_pengguna`, `nama_pengguna`, `level` from `pengguna` 
            where (nama_pengguna='$username' or email_pengguna='$username') 
            and `sandi`='$password'";

    $query = mysqli_query($koneksi, $sql);
    $jumlah = mysqli_num_rows($query);

    if ($jumlah == 0) {
        header("Location: index.php?gagal=userpassSalah");
    } else {
        session_start();
        $data = mysqli_fetch_assoc($query);
        $_SESSION['id_pengguna'] = $data['id_pengguna'];
        $_SESSION['nama_pengguna'] = $data['nama_pengguna'];
        $_SESSION['level'] = $data['level'];
        header("Location: home.php");
        exit();
    }
}
?>

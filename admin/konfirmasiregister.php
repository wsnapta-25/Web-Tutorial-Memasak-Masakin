<?php
include('../koneksi/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));

    if (empty($email) || empty($username) || empty($password)) {
        header("Location: register.php?gagal=Harap lengkapi semua data");
        exit();
    }

    $cek = mysqli_query($koneksi, "select * from pengguna where email_pengguna = '$email'");
    if (mysqli_num_rows($cek) > 0) {
        header("Location: register.php?gagal=Email sudah digunakan");
        exit();
    }

    $query = "insert into pengguna (nama_pengguna, email_pengguna, sandi, tanggal_daftar)
              values ('$username', '$email', '$password', NOW())";

    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: register.php?gagal=Gagal mendaftar, coba lagi.");
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}
?>

<?php
session_start();
include('../koneksi/koneksi.php');

if (!isset($_SESSION['id_pengguna']) || !isset($_POST['id_info_resep']) || !isset($_POST['ulasan'])) {
    echo "Data tidak lengkap.";
    exit();
}

$id_pengguna = $_SESSION['id_pengguna'];
$id_info_resep = intval($_POST['id_info_resep']);
$ulasan = trim($_POST['ulasan']);

$sql_jenis = "SELECT id_jenis FROM info_resep WHERE id_info_resep = ?";
$stmt_jenis = mysqli_prepare($koneksi, $sql_jenis);
mysqli_stmt_bind_param($stmt_jenis, "i", $id_info_resep);
mysqli_stmt_execute($stmt_jenis);
$result_jenis = mysqli_stmt_get_result($stmt_jenis);

if ($result_jenis && mysqli_num_rows($result_jenis) > 0) {
    $row = mysqli_fetch_assoc($result_jenis);
    $id_jenis = $row['id_jenis'];


    $sql_insert = "INSERT INTO ulasan (id_info_resep, id_pengguna, ulasan, id_jenis) VALUES (?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "iisi", $id_info_resep, $id_pengguna, $ulasan, $id_jenis);

    if (mysqli_stmt_execute($stmt_insert)) {
        header("Location: home.php");
        exit();
    } else {
        echo "Gagal menyimpan ulasan.";
    }
} else {
    echo "Jenis resep tidak ditemukan.";
}
?>

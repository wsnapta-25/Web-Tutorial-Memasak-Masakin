<?php
session_start();
include('../koneksi/koneksi.php');

if (!isset($_SESSION['id_pengguna'])) {
    header("Location: index.php");
    exit();
}

$id_pengguna = $_SESSION['id_pengguna'];

$nama_resep = $_POST['nama_resep'];
$id_jenis = $_POST['id_jenis'];
$id_budget = $_POST['id_budget'];
$alat = $_POST['alat'];
$bahan = $_POST['bahan'];
$deskripsi = $_POST['deskripsi'];

$gambar_nama = $_FILES['gambar']['name'];
$gambar_tmp = $_FILES['gambar']['tmp_name'];
$target_path = 'image/' . $gambar_nama;
move_uploaded_file($gambar_tmp, $target_path);

$gambar_penutup = $_FILES['gambar_penutup']['name'];
$tmp_penutup = $_FILES['gambar_penutup']['tmp_name'];

if (!empty($gambar_penutup)) {
    $lokasi_penutup = 'image/' . $gambar_penutup;
    move_uploaded_file($tmp_penutup, $lokasi_penutup);
} else {
    $gambar_penutup = NULL;
}

$sql_resep = "insert into info_resep (id_jenis, id_budget, nama_resep, gambar, alat, bahan, deskripsi, gambar_penutup)
              values ('$id_jenis', '$id_budget', '$nama_resep', '$gambar_nama', '$alat', '$bahan', '$deskripsi', '$gambar_penutup')";
mysqli_query($koneksi, $sql_resep);
$id_info_resep = mysqli_insert_id($koneksi);

for ($i = 0; $i < count($_POST['langkah_deskripsi']); $i++) {
    $deskripsi = $_POST['langkah_deskripsi'][$i];
    $alat_l = $_POST['langkah_alat'][$i];
    $bahan_l = $_POST['langkah_bahan'][$i];

    $gambar_l = $_FILES['langkah_gambar']['name'][$i];
    $tmp_l = $_FILES['langkah_gambar']['tmp_name'][$i];
    $lokasi = 'image/' . $gambar_l;
    move_uploaded_file($tmp_l, $lokasi);

    $sql_l = "insert into langkah (gambar, alat, bahan, langkah, id_info_resep)
              values ('$gambar_l', '$alat_l', '$bahan_l', '$deskripsi', '$id_info_resep')";

    mysqli_query($koneksi, $sql_l);
}

header("Location: home.php?notif=sukses");
exit();

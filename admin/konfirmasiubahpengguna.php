<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_SESSION['id_pengguna'])) {
    $id_pengguna = $_SESSION['id_pengguna'];
    $item['nama_pengguna'] = $_POST['nama_pengguna'];
    $item['pekerjaan'] = $_POST['pekerjaan'];
    $item['nama'] = $_POST['nama'];
    $item['level'] = $_POST['level'];
}

$sql_cek = "select * from pengguna where id_pengguna = '$id_pengguna'";
$query_cek = mysqli_query($koneksi, $sql_cek);
$data_lama = mysqli_fetch_assoc($query_cek);

if (empty($item['nama_pengguna'])) {
    header("Location:ubahprofil.php?notif=editkosong&jenis=nama_pengguna");
} else if (empty($item['pekerjaan'])) {
    header("Location:ubahprofil.php?notif=editkosong&jenis=pekerjaan");
} else if (empty($item['nama'])) {
    header("Location:kelolapengguna.php?notif=editkosong&jenis=nama");
// } else if (empty($item['level'])) {
//     header("Location:kelolapengguna.php?notif=editkosong&jenis=level");
} else {
    $sql = "update `pengguna` set
            `nama_pengguna` = '{$item['nama_pengguna']}', 
            `pekerjaan` = '{$item['pekerjaan']}',
            `nama` = '{$item['nama']}', `level` = '{$item['level']}'
            where `id_pengguna` = '$id_pengguna'";
    mysqli_query($koneksi, $sql);
    header("Location:kelolapengguna.php?notif=editberhasil");
}

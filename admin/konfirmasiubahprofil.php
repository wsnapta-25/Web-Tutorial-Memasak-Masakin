<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_SESSION['id_pengguna'])) {
    $id_pengguna = $_SESSION['id_pengguna'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $email_pengguna = $_POST['email_pengguna'];
    $pekerjaan = $_POST['pekerjaan'];
    $kontak = $_POST['kontak'];
    $nama = $_POST['nama'];
    //get foto
    $sql_f = "select `foto` from `pengguna` where `id_pengguna`='$id_pengguna'";
    $query_f = mysqli_query($koneksi, $sql_f);
    while ($data_f = mysqli_fetch_row($query_f)) {
        $foto = $data_f[0];
    }
    if (empty($nama_pengguna)) {
        header("Location:ubahprofil.php?notif=editkosong&jenis=nama_pengguna");
    } else if (empty($email_pengguna)) {
        header("Location:ubahprofil.php?notif=editkosong&jenis=email_pengguna");
    } else if (empty($pekerjaan)) {
        header("Location:ubahprofil.php?notif=editkosong&jenis=pekerjaan");
    } else if (empty($kontak)) {
        header("Location:ubahprofil.php?notif=editkosong&jenis=kontak");
    } else if (empty($nama)) {
        header("Location:ubahprofil.php?notif=editkosong&jenis=nama");
    }else {
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $nama_file = $_FILES['foto']['name'];
        $direktori = 'image/' . $nama_file;
        if (move_uploaded_file($lokasi_file, $direktori)) {

            if (!empty($foto)) {
                unlink("foto/$foto");
            }
            $sql = "update `pengguna` set `nama_pengguna`='$nama_pengguna', `email_pengguna`='$email_pengguna', `foto`='$nama_file', `pekerjaan`='$pekerjaan',
            `kontak`='$kontak', `nama`='$nama' where `id_pengguna`='$id_pengguna'";
            mysqli_query($koneksi, $sql);
        } else {
           $sql = "update `pengguna` set `nama_pengguna`='$nama_pengguna', `email_pengguna`='$email_pengguna', `pekerjaan`='$pekerjaan',
            `kontak`='$kontak', `nama`='$nama' where `id_pengguna`='$id_pengguna'";
            mysqli_query($koneksi, $sql);
        }
        header("Location:profil.php?notif=editberhasil");
    }
}

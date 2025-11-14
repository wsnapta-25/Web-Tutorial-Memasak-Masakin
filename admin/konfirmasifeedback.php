<?php
session_start();
include('../koneksi/koneksi.php');

$nama = $_POST['nama'];
$email_pengguna = $_POST['email_pengguna'];
$kontak = $_POST['kontak'];
$feedback = $_POST['feedback'];

if (empty($nama)) {
    header("Location:feedback.php?notif=tambahkosong&jenis=nama");
} else if (empty($email_pengguna)) {
    header("Location:feedback.php?notif=tambahkosong&jenis=email_pengguna");
} else if (empty($kontak)) {
    header("Location:feedback.php?notif=tambahkosong&jenis=kontak");
} else if (empty($feedback)) {
    header("Location:feedback.php?notif=tambahkosong&jenis=feedback");
} else {
    $query_pengguna = mysqli_query($koneksi, "select id_pengguna from pengguna where email_pengguna = '$email_pengguna'");
    
    if (mysqli_num_rows($query_pengguna) > 0) {
        $data = mysqli_fetch_assoc($query_pengguna);
        $id_pengguna = $data['id_pengguna'];
    } else {
        mysqli_query($koneksi, "insert into pengguna (nama, email_pengguna, kontak) values ('$nama', '$email_pengguna', '$kontak')");
        $id_pengguna = mysqli_insert_id($koneksi);
    }

    $sql = "insert into feedback (id_pengguna, feedback) values ('$id_pengguna', '$feedback')";
    mysqli_query($koneksi, $sql);

    header("Location:feedback.php?notif=tambahberhasil");
}
?>

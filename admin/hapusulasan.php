<?php
include('../koneksi/koneksi.php');
$id = $_POST['id_ulasan'];
$stmt = $conn->prepare("delete from ulasan where id_ulasan = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
exit();

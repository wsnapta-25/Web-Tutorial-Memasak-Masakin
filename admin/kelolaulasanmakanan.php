<?php
session_start();
include('../koneksi/koneksi.php');

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['data'])) {
    $id_ulasan = $_GET['data'];
    $sql_hapus = "delete from ulasan where id_ulasan = ?";
    $stmt = $koneksi->prepare($sql_hapus);
    $stmt->bind_param("i", $id_ulasan);
    $stmt->execute();
    $stmt->close();
    header("Location: kelolaulasanmakanan.php?notif=hapusberhasil");
    exit;
}

$id_pengguna = $_SESSION['id_pengguna'];
$sql = "select `nama`, `email_pengguna`, `kontak`, `id_ulasan`, `ulasan`, `nama_resep` from `pengguna` inner join `ulasan` on `pengguna`.`id_pengguna` = `ulasan`.`id_pengguna` inner join `info_resep` on `ulasan`.`id_info_resep` = `info_resep`.`id_info_resep` where `ulasan`.`id_jenis` = 1";
$query = mysqli_query($koneksi, $sql);
$feedbacks = [];
while ($data = mysqli_fetch_row($query)) {
    $feedbacks[] = [
        'nama' => $data[0],
        'email' => $data[1],
        'kontak' => $data[2],
        'id_ulasan' => $data[3],
        'ulasan' => $data[4],
        'nama_resep' => $data[5]
    ];
}
?>
<!DOCTYPE html>

<head>
    <?php include("includes/head.php") ?>
    <title>Profil - MasaKin!</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div id="sidebar">
        <?php include 'includes/sidebar.php'; ?>
    </div>
    <div id="overlay" onclick="toggleSidebar()"></div>

    <nav>
        <div class="hamburger" onclick="toggleSidebar()"><i class="fas fa-bars"></i></div>
        <div class="nav-container">
            <a href="home.php"><i class="fas fa-home"></i></a>
            <a href="favorit.php"><i class="fas fa-heart"></i></a>
            <a href="medsos.php"><i class="fas fa-globe"></i></a>
            <a href="feedback.php"><i class="fas fa-envelope"></i></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <div class="col-sm-12">
        <?php if (isset($_GET['notif']) && $_GET['notif'] == "hapusberhasil") { ?>
            <div class="alert alert-success" role="alert">
                Data Berhasil Dihapus</div>
        <?php } ?>
    </div>
    <?php if (empty($feedbacks)) { ?>
        <div class="card-kelola">
            <div class="bio-feedback">
                <div style="text-align: center;">Tidak ada ulasan pada makanan.</div>
            </div>
        </div>
    <?php } else { ?>
        <?php foreach ($feedbacks as $item) { ?>
            <div class="card-kelola">
                <div class="bio-feedback">
                    <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $item['id_ulasan']; ?>?'))
                      window.location.href = 'kelolaulasanmakanan.php?aksi=hapus&data=<?php echo $item['id_ulasan']; ?>&notif=hapusberhasil'"
                        class="btn btn-xs btn-warning">
                        <i class="fas fa-trash" title="Hapus"></i>
                    </a>
                    <div class="nama-resepnya">
                        <label><?php echo $item['nama_resep']; ?></label>
                    </div>
                    <div class="kelola-fb-all">
                        <label class="pengirim-fb"><?php echo $item['nama']; ?> - <?php echo $item['email']; ?> - <?php echo $item['kontak']; ?></label>
                    </div>
                    <div>
                        <div class="isi-fb"><?php echo $item['ulasan']; ?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>


    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            sidebar.classList.toggle("active");
            overlay.classList.toggle("active");
        }
    </script>


    <?php include("includes/script.php") ?>

</body>

</html>
<?php
include('../koneksi/koneksi.php');
session_start();
if (isset($_SESSION['id_pengguna'])) {
    $id_pengguna = $_SESSION['id_pengguna'];
    $sql = "select `nama_pengguna`, `email_pengguna`, `foto`, `pekerjaan`, `kontak`, `nama` from `pengguna` where `id_pengguna`='$id_pengguna'";
    $query = mysqli_query($koneksi, $sql);
    while ($data = mysqli_fetch_row($query)) {
        $nama_pengguna = $data[0];
        $email_pengguna = $data[1];
        $foto = $data[2];
        $pekerjaan = $data[3];
        $kontak = $data[4];
        $nama = $data[5];
    }
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

    <div class="container">
        <div class="about-card">
            <?php if ((!empty($_GET['notif'])) && (!empty($_GET['jenis']))) { ?>
                <?php if ($_GET['notif'] == "editkosong") { ?>
                    <div class="alert alert-danger" role="alert">Maaf data
                        <?php echo $_GET['jenis']; ?> wajib di isi</div>
                <?php } ?>
            <?php } ?>
            <form class="form-ubah" method="post" action="konfirmasiubahprofil.php" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="foto" class="col-sm-3 col-form-label">Foto Profil</label>
                    <div class="col-sm-7">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto" id="customFile">
                            <label class="custom-file-label" for="customFile"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" value="<?php echo $nama_pengguna; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="email_pengguna" id="email_pengguna" value="<?php echo $email_pengguna; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-sm-3 col-form-label">Kontak</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="kontak" id="kontak" value="<?php echo $kontak; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-sm-3 col-form-label">Pekerjaan</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo $pekerjaan; ?>">
                    </div>
                </div>
                <button type="submit" class="edit">Simpan</button>
            </form>
        </div>
    </div>



    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            sidebar.classList.toggle("active");
            overlay.classList.toggle("active");
        }
    </script>
    </div>



    <?php include("includes/script.php") ?>

</body>

</html>
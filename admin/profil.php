<?php
session_start();
include('../koneksi/koneksi.php');
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
      <?php if (!empty($_GET['notif'])) {
        if ($_GET['notif'] == "editberhasil") { ?>
          <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
        <?php } ?>
      <?php } ?>
      <h2 class="fotoprofil">
        <img src="image/<?php echo $foto; ?>" class="about-image" style="width: 250px; height: 250px; border-radius: 50%;">
        <div style="margin: 25px;"><?php echo $nama_pengguna; ?></div>
      </h2>

      <div class="biodata-profil">
        <div class="biodata">
          <div class="form-row">
            <label class="label_profil">Nama</label>
            <div class="label_value"><?php echo $nama; ?></div>
          </div>
          <div class="form-row">
            <label class="label_profil">Email</label>
            <div class="label_value"><?php echo $email_pengguna; ?></div>
          </div>
          <div class="form-row">
            <label class="label_profil">Kontak</label>
            <div class="label_value"><?php echo $kontak; ?></div>
          </div>
          <div class="form-row">
            <label class="label_profil">Pekerjaan</label>
            <div class="label_value"><?php echo $pekerjaan; ?></div>
          </div>
        </div>
        <div class="daftar-favorit"></div>
      </div>
      <div class="ubah-profil">
        <a class="label_value" href="ubahprofil.php">Ubah Profil</a>
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
<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>

<head>
  <?php include("includes/head.php") ?>
  <title>Media Sosial - MasaKin</title>
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

  <div class="col-sm-10">
    <?php if ((!empty($_GET['notif'])) && (!empty($_GET['jenis']))) { ?>
      <?php if ($_GET['notif'] == "tambahkosong") { ?>
        <div class="alert alert-danger" role="alert">Maaf data
          <?php echo $_GET['jenis']; ?> wajib di isi</div>
      <?php } ?>
    <?php } ?>
  </div>
  
  <div class="head-feedback">
    <h1>FEEDBACK</h1>
    <h7>TERDAPAT SARAN DAN KRITIKAN? CUKUP TULIS PESAN KEPADA KAMI!</h7>
  </div>
  <div class="container">
    <div class="feedback-konten">
      <h5>INFORMASI KONTAK</h5>
      <div class="isi-feedback">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque nec velit sem.
          Cras ultrices leo a ante lobortis, a tincidunt lorem fermentum. Donec at dui arcu.
          Curabitur at malesuada nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.
        </p>
        <p><i class="fas fa-phone" style="margin-right: 8px;"></i>08XX-XXXX-XXXX</p>
        <p><i class="fas fa-envelope" style="margin-right: 8px;"></i>wisnu@gmail.com</p>
        <p><i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i>Jl. Veteran, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145</p>
      </div>
    </div>
  </div>
  <form class="form-horizontal-feedback" action="konfirmasifeedback.php" method="post">
    <div class="left-column">
      <div class="form-feedback">
        <div>
          <label class="inputfb">NAMA</label>
        </div>
        <div class="input-all-feedback">
          <input type="text" class="form-control" name="nama" id="nama" value="">
        </div>
      </div>
      <div class="form-feedback">
        <div>
          <label class="inputfb">EMAIL</label>
        </div>
        <div class="input-all-feedback">
          <input type="text" class="form-control" name="email_pengguna" id="email_pengguna" value="">
        </div>
      </div>
      <div class="form-feedback">
        <div>
          <label class="inputfb">NOMOR TELEPON</label>
        </div>
        <div class="input-all-feedback">
          <input type="text" class="form-control" name="kontak" id="kontak" value="">
        </div>
      </div>
      <div class="submit-feedback">
        <button type="submit">KIRIM</button>
      </div>
    </div>

    <div class="right-column">
      <div class="input-feedback">
        <div>
          <label class="inputfb">KRITIK DAN SARAN</label>
        </div>
        <div class="input-all-feedback">
          <textarea class="form-control kritik-saran-input" name="feedback" id="feedback"></textarea>
        </div>
      </div>
    </div>
  </form>
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
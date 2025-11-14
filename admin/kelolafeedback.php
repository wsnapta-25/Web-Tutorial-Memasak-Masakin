<?php
session_start();
include('../koneksi/koneksi.php');
$id_pengguna = $_SESSION['id_pengguna'];
$sql = "select `nama`, `email_pengguna`, `kontak`, `feedback` from `pengguna` inner join `feedback` on `pengguna`.`id_pengguna` = `feedback`.`id_pengguna` ";
$query = mysqli_query($koneksi, $sql);
$feedbacks = [];
while ($data = mysqli_fetch_row($query)) {
  $feedbacks[] = [
    'nama' => $data[0],
    'email' => $data[1],
    'kontak' => $data[2],
    'feedback' => $data[3]
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

  <?php foreach ($feedbacks as $item) { ?>
    <div class="card-kelola">
      <div class="bio-feedback">
        <div class="kelola-fb-all">
          <label class="pengirim-fb"><?php echo $item['nama']; ?> - <?php echo $item['email']; ?> - <?php echo $item['kontak']; ?></label>
        </div>
        <div>
          <div class="isi-fb"><?php echo $item['feedback']; ?></div>
        </div>
      </div>
    </div>
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
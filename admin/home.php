<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head.php") ?>
    <title>Home - MasaKin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div>
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

        <div class="content">
            <div class="box">
                <a href="menumakanan.php">
                    <h3>MAKANAN</h3>
                </a>
                <div class="image-placeholder">
                    <a href="menumakanan.php">
                        <img src="image/makanan1.png" alt="Makanan">
                    </a>
                </div>
            </div>

            <div class="box">
                <a href="menuminuman.php">
                    <h3>MINUMAN</h3>
                </a>
                <div class="image-placeholder">
                    <a href="menuminuman.php">
                        <img src="image/minuman1.png" alt="Minuman">
                    </a>
                </div>
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
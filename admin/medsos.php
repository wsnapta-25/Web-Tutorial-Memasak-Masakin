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

    <div class="container">
        <div class="about-card">
            <h2>TENTANG KAMI</h2>
            <div class="about-content">
                <img src="image/wisnu.jpg" alt="Profil" class="about-image" style="width: 250px; height: 250px; border: 1px solid #ccc; border-radius: 10px;">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque nec velit sem.
                    Cras ultrices leo a ante lobortis, a tincidunt lorem fermentum. Donec at dui arcu.
                    Curabitur at malesuada nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.
                </p>
            </div>
            <h3>MEDIA SOSIAL KAMI</h3>
            <div class="social-icons">
                <a href="https://www.instagram.com/wisnuaptaa/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-x-twitter"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
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
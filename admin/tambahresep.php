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
    <title>Tambah Resep</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script>
        let langkahIndex = 0;
        let penutupDitambahkan = false;

        function tambahLangkah() {
            langkahIndex++;
            const container = document.getElementById('langkah-container');
            const div = document.createElement('div');
            div.className = 'langkah-item';
            div.innerHTML = `
        <h4>Langkah ke-${langkahIndex}</h4>
        <label>Gambar:</label>
        <input type="file" name="langkah_gambar[]" required><br>
        <label>Alat:</label>
        <textarea name="langkah_alat[]" required></textarea><br>
        <label>Bahan:</label>
        <textarea name="langkah_bahan[]" required></textarea><br>
        <label>Deskripsi Langkah:</label>
        <textarea name="langkah_deskripsi[]" required></textarea>
        <hr>
      `;
            container.appendChild(div);
        }

        function hapusLangkah() {
            const container = document.getElementById('langkah-container');
            if (container.lastElementChild) {
                container.removeChild(container.lastElementChild);
                langkahIndex--;
            }
        }

        function tambahPenutup() {
            if (penutupDitambahkan) return;
            penutupDitambahkan = true;
            const container = document.getElementById('penutup-container');
            const div = document.createElement('div');
            div.className = 'penutup-item';
            div.innerHTML = `
        <h4>Penutup</h4>
        <label>Gambar Penutup:</label>
        <input type="file" name="gambar_penutup"><br>`;
            container.appendChild(div);
        }
    </script>
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
            <h2>TAMBAH RESEP BARU</h2>
            <form action="tambahresep_proses.php" method="POST" enctype="multipart/form-data">
                <label>Nama Resep:</label>
                <input type="text" name="nama_resep" required><br>

                <label>Jenis:</label>
                <select name="id_jenis">
                    <option value="1">Makanan</option>
                    <option value="2">Minuman</option>
                </select><br>

                <label>Budget:</label>
                <select name="id_budget">
                    <option value="1">Hemat</option>
                    <option value="2">Sederhana</option>
                    <option value="3">Fancy</option>
                </select><br>

                <label>Alat:</label>
                <textarea name="alat" required></textarea><br>

                <label>Bahan:</label>
                <textarea name="bahan" required></textarea><br>

                <label>Deskripsi:</label>
                <textarea name="deskripsi" required></textarea><br>

                <label>Gambar Resep:</label>
                <input type="file" name="gambar" required><br><br>

                <div id="langkah-container"></div>

                <button type="button" onclick="tambahLangkah()">Tambah Langkah</button>
                <button type="button" onclick="hapusLangkah()">Hapus Langkah</button><br><br>

                <div id="penutup-container"></div>
                <button type="button" onclick="tambahPenutup()">Penutup</button><br><br>

                <button type="submit">Simpan Resep</button>
            </form>
        </div>
    </div>

    </html>
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
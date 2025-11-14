<?php
session_start();
include('../koneksi/koneksi.php');

$filter_budget = isset($_GET['budget']) ? $_GET['budget'] : '';
$katakunci = isset($_GET['katakunci']) ? trim($_GET['katakunci']) : '';
$id_pengguna = $_SESSION['id_pengguna'];
$menuresep = [];

if ($filter_budget != '' || $katakunci != '') {
    $sql = "SELECT `id_info_resep`, `nama_resep`, `gambar` FROM `info_resep` WHERE `id_jenis` = 1";

    $param_types = "";
    $param_values = [];

    if ($filter_budget != '') {
        $sql .= " AND `id_budget` = ?";
        $param_types .= "i";
        $param_values[] = $filter_budget;
    }

    if ($katakunci != '') {
        $sql .= " AND `nama_resep` LIKE ?";
        $param_types .= "s";
        $param_values[] = "%$katakunci%";
    }

    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param($param_types, ...$param_values);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($data = $result->fetch_assoc()) {
        $menuresep[] = $data;
    }

    $stmt->close();
} else {
    $sql = "SELECT `id_info_resep`, `nama_resep`, `gambar` FROM `info_resep` WHERE `id_jenis` = 1";
    $query = mysqli_query($koneksi, $sql);
    while ($data = mysqli_fetch_assoc($query)) {
        $menuresep[] = $data;
    }
}

?>
<!DOCTYPE html>
<html lang="id">

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
        <div class="menumami">
            <div class="hamburger" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </div>
            <div class="search-bar">
                <form method="GET" id="form-search">
                    <input type="text" id="kata_kunci" name="katakunci" placeholder="ㅤCari resep..." value="<?php echo isset($_GET['katakunci']) ? htmlspecialchars($_GET['katakunci']) : ''; ?>">
                </form>
            </div>
            <div class="pilih-budget">
                <div class="col-sm-7">
                    <select class="form-control" name="budget" id="budget">
                        <option value="">Budget</option>
                        <?php
                        $sql_j = "SELECT `id_budget`,`budget` FROM `budget` ORDER BY `id_budget`";
                        $query_j = mysqli_query($koneksi, $sql_j);
                        while ($data_j = mysqli_fetch_row($query_j)) {
                            $id_budget = $data_j[0];
                            $budget = $data_j[1];
                            $selected = ($filter_budget == $id_budget) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $id_budget; ?>" <?php echo $selected; ?>>
                                <?php echo $budget; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="nav-container">
            <a href="home.php"><i class="fas fa-home"></i></a>
            <a href="favorit.php"><i class="fas fa-heart"></i></a>
            <a href="medsos.php"><i class="fas fa-globe"></i></a>
            <a href="feedback.php"><i class="fas fa-envelope"></i></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <div class="container">
        <div class="isi-resep">
            <h2>REKOMENDASI MAKANAN</h2>
            <div id="resep-container" class="gridresep">
                <?php if (empty($menuresep)) { ?>
                    <div class='no-resep'>Resep tidak ditemukan.</div>
                <?php } else { ?>
                    <?php foreach ($menuresep as $item) { ?>
                        <div class="daftarmami">
                            <div class="infomami">
                                <span class="namamami"><?php echo $item['nama_resep']; ?></span>
                                <button class="buttonmami">❤️</button>
                            </div>
                            <a href="info_resep.php?id=<?php echo $item['id_info_resep']; ?>">
                                <img src="../admin/image/<?php echo $item['gambar']; ?>">
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
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

        document.getElementById("budget").addEventListener("change", function() {
            const selectedBudget = this.value;
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "filter_resep.php?budget=" + selectedBudget, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById("resep-container").innerHTML = this.responseText;
                }
            };
            xhr.send();
        });

        document.getElementById("kata_kunci").addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                document.getElementById("form-search").submit();
            }
        });
    </script>

    <?php include("includes/script.php") ?>
</body>

</html>
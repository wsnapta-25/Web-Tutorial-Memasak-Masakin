<?php
include('../koneksi/koneksi.php');

$budget = isset($_GET['budget']) ? $_GET['budget'] : '';

$sql = "SELECT `id_info_resep`, `nama_resep`, `gambar` 
        FROM `info_resep` 
        WHERE `id_jenis` = 1";

if ($budget != '') {
    $sql .= " AND `id_budget` = " . intval($budget);
}

$query = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($item = mysqli_fetch_assoc($query)) {
?>
        <div class="daftarmami">
            <div class="infomami">
                <span class="namamami"><?php echo $item['nama_resep']; ?></span>
                <button class="buttonmami">❤️</button>
            </div>
            <a href="info_resep.php?id=<?php echo $item['id_info_resep']; ?>">
                <img src="../admin/image/<?php echo $item['gambar']; ?>">
            </a>
        </div>
<?php
    }
} else {
    echo "<div class='no-resep'>Tidak ada resep sesuai budget.</div>";
}
?>

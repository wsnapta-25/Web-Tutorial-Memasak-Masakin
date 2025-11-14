<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="home.php" class="brand-link">
    <img src="../admin/image/logomasakin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">MasaKin! </span>
  </a>

  <div class="sidebar">
    <nav class="mt-2" style="background-color: #343a40; ">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="profil.php" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profil
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="favoritglobal.php" class="nav-link">
            <i class="nav-icon fas fa-heart"></i>
            <p>
              Favorit Global
            </p>
          </a>
        </li>
        <?php
        if (isset($_SESSION['level']) && $_SESSION['level'] == "pengguna") { ?>
          <li class="nav-item">
            <a href="feedback.php" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Feedback</p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a href="medsos.php" class="nav-link">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Media Sosial
            </p>
          </a>
        </li>
        <?php
        if (isset($_SESSION['level']) && $_SESSION['level'] == "admin") { ?>
          <li class="nav-item">
            <a href="kelolapengguna.php" class="nav-link">
              <i class="fas fa-user-cog nav-icon"></i>
              <p>Kelola Pengguna</p>
            </a>
          </li>
        <?php } ?>

        <?php
        if (isset($_SESSION['level']) && $_SESSION['level'] == "admin") { ?>
          <li class="nav-item">
            <a href="kelolafeedback.php" class="nav-link">
              <i class="fas fa-envelope-open-text nav-icon"></i>
              <p>Kelola Feedback</p>
            </a>
          </li>
        <?php } ?>

        <?php
        if (isset($_SESSION['level']) && $_SESSION['level'] == "admin") { ?>
          <li class="nav-item">
            <a href="tambahresep.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Kelola Resep</p>
            </a>
          </li>
        <?php } ?>

        <?php
        if (isset($_SESSION['level']) && $_SESSION['level'] == "admin") { ?>
          <li class="nav-item has-treeview dropdown">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comment-dots"></i>
              <p>Kelola Ulasan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="kelolaulasanmakanan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ulasan Makanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="kelolaulasanminuman.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ulasan Minuman</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Sign Out
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
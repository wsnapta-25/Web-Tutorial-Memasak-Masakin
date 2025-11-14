<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head.php"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>MasaKin!</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body" style="background-color:#FFFDD0">


                <?php if (!empty($_GET['gagal'])) { ?>
                    <span class="text-danger"><?php echo htmlspecialchars($_GET['gagal']); ?></span>
                <?php } ?>

                <form action="konfirmasiregister.php" method="post">
                    <div class="input-group mb-3">
                        <label class="text-center d-block w-100">EMAIL</label>
                        <input type="email" class="form-control" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label class="text-center d-block w-100">USERNAME</label>
                        <input type="text" class="form-control" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-circle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label class="text-center d-block w-100">PASSWORD</label>
                        <input type="password" class="form-control" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mx-auto">
                        <button type="submit" name="daftar" class="btn w-100" style="background-color: white; color: #666666; border: 1px solid #ccc; font-weight: bold;">
                            DAFTAR
                        </button>
                    </div>
                    <div class="text-center mt-3 small-text">
                        <span>Sudah punya akun? </span>
                        <div class="sclogin">
                            <a href="index.php"><b>Login</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include("includes/script.php"); ?>
</body>

</html>
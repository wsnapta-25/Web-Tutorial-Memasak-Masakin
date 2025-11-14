<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head.php") ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a><b>MasaKin!</b></a>
        </div>
        
        <div class="card">
            <div class="card-body login-card-body" style="background-color:#FFFDD0">
                <div class="text-center">
                    <?php if (!empty($_GET['gagal'])) { ?>
                        <?php if ($_GET['gagal'] == "userKosong") { ?>
                            <span class="text-danger">Maaf Username Tidak Boleh Kosong</span>
                        <?php } else if ($_GET['gagal'] == "passKosong") { ?>
                            <span class="text-danger">Maaf Password Tidak Boleh Kosong</span>
                        <?php } else { ?>
                            <div class="text-center">
                                <span class="text-danger">
                                    Maaf Username atau Password Anda Tidak Ada
                                </span>
                            </div>

                        <?php } ?>
                </div>
            <?php } ?>
            <form action="konfirmasilogin.php" method="post">
                <div class="input-group mb-3">
                    <label class="text-center d-block w-100">USERNAME / EMAIL</label>
                    <input type="text" class="form-control" name="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <label class="text-center d-block w-100">PASSWORD</label>
                    <input type="password" class="form-control" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="col-8">

                </div>

                <div class="col-4 mx-auto">
                    <button type="submit" name="login" class="btn w-100" style="background-color: white; color: #666666; border: 1px solid #ccc; font-weight: bold;">
                        LOGIN
                    </button>
                </div>
                <div class="text-center mt-3 small-text">
                    <span>Apakah anda belum memiliki akun? </span>
                    <div class="scdaftar">
                        <a href="register.php"><b>Daftar</b></a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <?php include("includes/script.php") ?>
</body>

</html>
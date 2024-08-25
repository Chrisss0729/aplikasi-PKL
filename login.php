<?php
session_start();

// Keamanan menggunakan token
if (!empty($_SESSION['csrf_token'])) {
    header("Location: admin/dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="asset/image/logo.png" type="image/x-icon">
    <link href="asset/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/style.css">
    <title>Login atau Register</title>
</head>

<body>
    <!-- TOAST -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3 z-3 position-absolute">
        <?php
        if (isset($_SESSION['pesan'])) {
        ?>
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="asset/image/logo.png" class="rounded me-2" alt="..." width="5%">
                    <strong class="me-auto">Coba Login</strong>
                    <small>Just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-white">
                    <?php echo $_SESSION['pesan']  ?>
                </div>
            </div>
        <?php
            unset($_SESSION['pesan']);
        }
        ?>
    </div>

    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-inner">
            <div class="carousel-item <?php echo isset($_SESSION['active']) ? '' : 'active' ?>" data-bs-interval="10000">
                <div class="d-flex justify-content-center align-items-center min-vh-100">
                    <div class="row border rounded-5 ms-3 me-3 p-3 bg-white shadow box-area gx-0" style="height: 700px;">
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="row m-5 p-5">
                                <div class="header-text mb-4">
                                    <h2>Hello, Kawan RPL</h2>
                                    <p>Kami senang Anda kembali.</p>
                                </div>


                                <form action="action/login.php" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-lg bg-light fs-6 <?php echo isset($_SESSION['errorNama']) ? 'is-invalid' : '' ?>" placeholder="Username" name="nama" value="<?php echo isset($_COOKIE['nama']) ? htmlspecialchars($_COOKIE['nama']) : ''; ?>">
                                        <?php
                                        if (isset($_SESSION['errorNama'])) {
                                        ?>
                                            <div class="invalid-tooltip">
                                                <?php echo $_SESSION['errorNama'] ?>
                                            </div>
                                        <?php
                                            unset($_SESSION['errorNama']);
                                        }
                                        ?>
                                    </div>
                                    <div class="input-group mb-1">
                                        <input type="password" class="form-control form-control-lg bg-light fs-6 <?php echo isset($_SESSION['errorPass']) ? 'is-invalid' : '' ?>" placeholder="Password" name="pass" value="<?php echo isset($_COOKIE['pass']) ? htmlspecialchars($_COOKIE['pass']) : ''; ?>">
                                        <?php
                                        if (isset($_SESSION['errorPass'])) {
                                        ?>
                                            <div class="invalid-tooltip">
                                                <?php echo $_SESSION['errorPass'] ?>
                                            </div>
                                        <?php
                                            unset($_SESSION['errorPass']);
                                        }
                                        ?>
                                    </div>
                                    <div class="input-group mb-5 d-flex justify-content-between">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="formCheck" name="remember" <?php echo isset($_COOKIE['nama']) ? 'checked' : ''; ?>>
                                            <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <button type="submit" class="btn btn-lg btn-primary w-100 fs-6" name="login">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #81008c;">
                            <div class="featured-image mb-3">
                                <img src="asset/image/nigg.png" class="img-fluid" style="width: 350px;">
                            </div>
                            <p class="text-light fs-2">Apa itu Login?</p>
                            <small class="text-light text-center mb-3">
                                Proses masuk ke jaringan komputer
                                dengan memasukkan identitas akun <br>
                                minimal terdiri dari username/akun
                                pengguna dan password untuk <br>
                                mendapatkan hak akses. <br>
                            </small>
                            <button class="btn btn-primary" type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1">Sign In</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="carousel-item <?php echo isset($_SESSION['active']) ? 'active' : '';
                                        unset($_SESSION['active']) ?>" data-bs-interval="10000">
                <div class="d-flex justify-content-center align-items-center min-vh-100">
                    <div class="row border rounded-5 ms-3 me-3 p-3 bg-white shadow box-area gx-0" style="height: 700px;">
                        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #81008c;">
                            <div class="featured-image mb-3">
                                <img src="asset/image/nigg.png" class="img-fluid" style="width: 350px;">
                            </div>
                            <p class="text-light fs-2">Apa itu registrasi ?</p>
                            <small class="text-light text-center mb-3">
                                Sebagai proses pendaftaran atau pengajuan aplikasi <br>
                                untuk memperoleh izin atau hak atas suatu <br>
                                produk, layanan, atau entitas tertentu. <br>
                            </small>
                            <button class="btn" type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0">Login</button>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="row ms-5 me-5">
                                <div class="header-text mb-4">
                                    <h2>Sign In</h2>
                                    <p>We are happy to have you back.</p>
                                </div>
                                <form action="action/signin.php" method="post" name="register">
                                    <div class="input-group mb-3">
                                        <input type="text" name="nisn" class="form-control form-control-lg bg-light fs-6 <?php echo isset($_SESSION['errorNisn']) ? 'is-invalid' : '' ?>" placeholder="NISN" value="<?php echo isset($_SESSION['nisn']) ? $_SESSION['nisn'] : '' ?>">
                                        <?php
                                        if (isset($_SESSION['errorNisn'])) {
                                        ?>
                                            <div class="invalid-tooltip">
                                                <?php echo $_SESSION['errorNisn'] ?>
                                            </div>
                                        <?php
                                            unset($_SESSION['errorNisn']);
                                        }
                                        unset($_SESSION['nisn']);
                                        ?>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" name="namaRegister" class="form-control form-control-lg bg-light fs-6 <?php echo isset($_SESSION['errornamaRegister']) ? 'is-invalid' : '' ?>" placeholder="Nama" value="<?php echo isset($_SESSION['namaRegister']) ? $_SESSION['namaRegister'] : '' ?>">
                                        <?php
                                        if (isset($_SESSION['errornamaRegister'])) {
                                        ?>
                                            <div class="invalid-tooltip">
                                                <?php echo $_SESSION['errornamaRegister'] ?>
                                            </div>
                                        <?php
                                            unset($_SESSION['errornamaRegister']);
                                        }
                                        unset($_SESSION['namaRegister']);
                                        ?>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" name="sekolah" class="form-control form-control-lg bg-light fs-6 <?php echo isset($_SESSION['errorSekolah']) ? 'is-invalid' : '' ?>" placeholder="Asal Sekolah" value="<?php echo isset($_SESSION['sekolah']) ? $_SESSION['sekolah'] : '' ?>">
                                        <?php
                                        if (isset($_SESSION['errorSekolah'])) {
                                        ?>
                                            <div class="invalid-tooltip">
                                                <?php echo $_SESSION['errorSekolah'] ?>
                                            </div>
                                        <?php
                                            unset($_SESSION['errorSekolah']);
                                        }
                                        unset($_SESSION['sekolah']);
                                        ?>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" name="jurusan" class="form-control form-control-lg bg-light fs-6 <?php echo isset($_SESSION['errorJurusan']) ? 'is-invalid' : '' ?>" placeholder="Jurusan" value="<?php echo isset($_SESSION['jurusan']) ? $_SESSION['jurusan'] : '' ?>">
                                        <?php
                                        if (isset($_SESSION['errorJurusan'])) {
                                        ?>
                                            <div class="invalid-tooltip">
                                                <?php echo $_SESSION['errorJurusan'] ?>
                                            </div>
                                        <?php
                                            unset($_SESSION['errorJurusan']);
                                        }
                                        unset($_SESSION['jurusan']);
                                        ?>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" name="username" class="form-control form-control-lg bg-light fs-6 <?php echo isset($_SESSION['errorUsername']) ? 'is-invalid' : '' ?>" placeholder="Username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>">
                                        <?php
                                        if (isset($_SESSION['errorUsername'])) {
                                        ?>
                                            <div class="invalid-tooltip">
                                                <?php echo $_SESSION['errorUsername'] ?>
                                            </div>
                                        <?php
                                            unset($_SESSION['errorUsername']);
                                        }
                                        unset($_SESSION['username']);
                                        ?>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg bg-light fs-6 <?php echo isset($_SESSION['errorPassword']) ? 'is-invalid' : '' ?>" placeholder="Password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : '' ?>">
                                        <?php
                                        if (isset($_SESSION['errorPassword'])) {
                                        ?>
                                            <div class="invalid-tooltip">
                                                <?php echo $_SESSION['errorPassword'] ?>
                                            </div>
                                        <?php
                                            unset($_SESSION['errorPassword']);
                                        }
                                        unset($_SESSION['password']);
                                        ?>
                                    </div>
                                    <div class="input-group mb-3">
                                        <button class="btn" name="register">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <?php
        if (isset($_SESSION['pesanSignIn'])) {
        ?>
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="logo.png" class="rounded me-2" alt="..." width="5%">
                    <strong class="me-auto">Sign In</strong>
                    <small>Just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php echo $_SESSION['pesanSignIn']  ?>
                </div>
            </div>
        <?php
            unset($_SESSION['pesanSignIn']);
        }
        ?>
    </div>


    <!-- <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 ms-3 me-3 p-3 bg-white shadow box-area gx-0" style="height: 700px;">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
                <div class="featured-image mb-3">
                    <img src="utdi.png" class="img-fluid" style="width: 500px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on this platform.</small>
                <a href="" class="btn btn-light">Sign In</a>
            </div>

            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="row m-5 p-5">
                    <div class="header-text mb-4">
                        <h2>Hello,Again</h2>
                        <p>We are happy to have you back.</p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                    </div>
                    <div class="input-group mb-5 d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="formCheck">
                            <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                        </div>
                        <div class="forgot">
                            <small><a href="#">Forgot Password?</a></small>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                    </div>
                </div>
            </div>



        </div>
    </div> -->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="asset/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var toastTrigger = $('#liveToast');
            var toast = new bootstrap.Toast(toastTrigger);

            // Show the toast if it exists
            if (toastTrigger.length) {
                toast.show();
            }
        });
    </script>
</body>

</html>
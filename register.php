<?php
require './functions/function.php';
session_start();

if (isset($_POST['register'])) {
    if (register($_POST) > 0) {
        echo "
            <script>
                alert('Registrasi akun berhasil, silahkan login!');
                document.location.href = 'login.php';
            </script>
            ";
    } else {
        echo mysqli_error($conn);
    }
}

// koneksi ke header
include "view/header.php";
?>

<!-- html -->
<br>
<div class="container d-flex justify-content-end">
    <div class="row">
        <div class="col-md-18">
            <div style="width: 20rem;">
                <h3 style="text-align: start;">Register</h3>
                <hr class="mb-3">

                <!-- form Register -->
                <form method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                </svg>
                            </div>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" autocomplete="off" required>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <br>
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                </form>
            </div>
            <div class="card-body">
                <label class="">Sudah punya akun?</label>
                <a href="login.php" class="btn btn-danger"> Login </a>
            </div>
        </div>
    </div>
</div>

<!-- koneksi ke footer -->
<div class="container-fluid mt-5">
    <footer class="py-3 my-4">
        <?php
        include "view/footer.php";
        ?>
    </footer>
</div>
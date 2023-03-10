<?php
// koneksi ke db
include("config/function.php");

if (isset($_SESSION["login"])) {
    header("Location: dashboard.php");
}

if (isset($_POST["submit"])) {
    $username   = $_POST["username"];
    $password   = $_POST["password"];
    $result     = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"]      = true;
            $_SESSION["name"]       = $username;
            $_SESSION["idUser"]     = $row["idUser"];
            header("Location: dashboard.php");
        }
    }
}

// koneksi ke header
include("view/header.php");
?>

<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-18">
            <div style="width: 20rem;">
                <h3 style="text-align: start;">Login</h3>
                <hr class="mb-3">
                <!-- form login -->
                <form method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                </svg>
                            </div>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off" required>
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
                        <br>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            <div class="card-body">
                <label class="">Belum punya akun?</label>
                <a href="register.php" class="btn btn-danger">Register</a>
            </div>
        </div>
    </div>
</div>

<br><br><br><br><br>

<?php
// koneksi ke footer
include("view/footer.php");
?>
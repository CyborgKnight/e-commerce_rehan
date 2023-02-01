<?php
require_once "core/init.php";

// validasi login
if (isset($_POST['submit'])) {
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    if (!empty(trim($username)) && !empty(trim($password))) {
        if (register_cek_username($username)) {
            // menginput dari db
            if (cek_data($username, $password)) {
                $_SESSION['tb_users'] = $username;
                header('Location: index.php');
            } else {
                echo 'data ada yang salah';
            }
        } else {
            echo 'nama belum terdaftar';
        }
    } else {
        echo 'tidak boleh kosong';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
    <title>toko onlen</title>
</head>

<body>
    <br><br><br>
    <div class="container">
        <div class="card">
            <div>
                <h3 style="text-align: center;"> Login </h3>
            </div>

            <!-- form login -->
            <div class="card-body">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="username">
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
                                </svg>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <br>
                        <div class="input-group">
                            <input type="submit" name="submit" value="Login" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>

            <!-- buat register -->
            <div class="card-body">
                <label class="">Belum punya akun?</label>
                <a href="register.php" type="submit" class="btn btn-danger"> Register </a>
            </div>
        </div>
    </div>

</body>

</html>
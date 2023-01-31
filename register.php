<?php

require_once "core/init.php";

// validasi register
if (isset($_POST['submit'])) {
    $name       = $_POST['name'];
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    if (!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password))) {

        if (register_cek_name($name)) {
            // memasukkan ke db
            if (register_user($name, $username, $email, $password)) {
                echo 'berhasil';
            } else {
                echo 'gagal';
            }
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
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <title>toko onlen</title>
</head>

<body>
    <br><br><br>
    <div class="container">
        <div class="card">
            <div>
                <h3 style="text-align: center;"> Register </h3>
            </div>
            <div class="card-body">
                <form action="register.php" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" autocomplete="off" id="name" onkeyup="myFunction()" required>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                            </div>
                            <input type="text" name="email" class="form-control" placeholder="Email" autocomplete="off" b required>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
                                </svg>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <br>
                        <div class="input-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Register">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <label class="">Sudah punya akun?</label>
                <a href="login.php" type="submit" class="btn btn-danger"> Login </a>
            </div>
        </div>
    </div>
</body>

<script>
    function myFunction() {
        var x = document.getElementById("name");
        x.value = x.value.toUpperCase();
    }
</script>

</html>
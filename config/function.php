<?php
session_start();
$conn   = mysqli_connect("localhost", "root", "", "e-commerce_rehan") or die("gagal koneksi");
$eror   = "";

// sistem register
function register($data)
{
    global $conn;
    $username       = mysqli_real_escape_string($conn, $data["username"]);
    $password       = mysqli_real_escape_string($conn, $data["password"]);

    // cek username sudah ada atau belum
    $result         = mysqli_query($conn, "SELECT username FROM tb_users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Sudah ada username yang terdaftar');
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // masukkan ke database
    mysqli_query($conn, "INSERT INTO tb_users (username, password, statusUser) VALUES ('$username', '$password', 0)");

    return mysqli_affected_rows($conn);
}

// sistem cek status user
function cek_status($username)
{
    global $conn;

    $name   = mysqli_escape_string($conn, $username);
    $query  = "SELECT statusUser FROM tb_users WHERE username = '$name'";

    if ($result = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $statusUser = $row["statusUser"];
        }
    }
    return $statusUser;
}

<?php
// untuk koneksi ke database
$conn   = mysqli_connect('localhost', 'root', '', 'e-commerce_rehan');

// sistem register
function register_user($username, $password)
{
    global $conn;
    $username   = mysqli_escape_string($conn, $username);
    $password   = mysqli_escape_string($conn, $password);

    // hash password
    $password   = password_hash($password, PASSWORD_DEFAULT);
    $query      = "INSERT INTO tb_users (username, password) VALUES ('$username', '$password')";
    $result     = mysqli_query($conn, $query);
    return $result;
}

function cek_nama($username)
{
    global $conn;
    $username = mysqli_escape_string($conn, $username);
    $query = "SELECT * FROM tb_users WHERE username = '$username'";

    if ($result = mysqli_query($conn, $query)) {
        if (mysqli_num_rows($result) == 0) return true;
        else return false;
    }
}

// sistem login atau status
// function cek_status($username)
// {
//     global $conn;
//     $name   = mysqli_escape_string($conn, $username);
//     $query  = "SELECT status FROM tb_users WHERE username = '$name'";

//     if ($result = mysqli_query($conn, $query)) {
//         while ($row = mysqli_fetch_assoc($result)) {
//             $status = $row["status"];
//         }
//     };
//     return $status;
// }

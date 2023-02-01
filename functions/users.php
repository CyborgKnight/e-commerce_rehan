<?php

function register_user($name, $username, $password)
{

    global $link;
    // mencegah sql injection 
    $name       = mysqli_real_escape_string($link, $name);
    $username   = mysqli_real_escape_string($link, $username);
    $password   = mysqli_real_escape_string($link, $password);
    // hash password
    $password   = password_hash($password, PASSWORD_DEFAULT);
    $query      = "INSERT INTO tb_users (name, username, password) VALUES ('$name', '$username','$password')";
    if (mysqli_query($link, $query)) {
        return true;
    } else {
        return false;
    }
}

// menguji username kembar atau double
function register_cek_username($username)
{
    global $link;
    $username   = mysqli_real_escape_string($link, $username);
    $query      = "SELECT * FROM tb_users WHERE username = '$username'";
    if ($result = mysqli_query($link, $query)) {
        if (mysqli_num_rows($result) == 0) return true;
        else return false;
    }
}

// menguji username di db
function login_cek_username($username)
{
    global $link;
    $username   = mysqli_real_escape_string($link, $username);
    $query      = "SELECT * FROM tb_users WHERE user$username = '$username'";
    if ($result = mysqli_query($link, $query)) {
        if (mysqli_num_rows($result) != 0) return true;
        else return false;
    }
}

// untuk sistem login
function cek_data($username, $password)
{
    global $link;
    // mencegah sql injection
    $username   = mysqli_real_escape_string($link, $username);
    $password   = mysqli_real_escape_string($link, $password);

    $query  = "SELECT password FROM tb_users WHERE user$username = '$username'";
    $result = mysqli_query($link, $query);
    $hash   = mysqli_fetch_assoc($result);

    if (password_verify($password, $hash['password'])) {
        return true;
    } else {
        return false;
    }
}
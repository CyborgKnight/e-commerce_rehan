<?php

function register_user($name, $username, $email, $password)
{

    global $link;

    // mencegah sql injection 
    $name = mysqli_real_escape_string($link, $name);
    $username = mysqli_real_escape_string($link, $username);
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);

    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO tb_users (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";

    if (mysqli_query($link, $query)) {
        return true;
    } else {
        return false;
    }
}

<?php

require_once "core/init.php";

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
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

    <div>
        halaman profile
    </div>
</body>

</html>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "tb_users");

// cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_errno();
}

<?php
// koneksi ke database
include "functions/function.php";

// konek ke header
include "view/layout/header.php";

// konek ke navbar
include "view/navbar.php";
?>

<div class="container-fluid">
    <h2>List Barang</h2>
    <p>selamat datang</p>

    <!-- untuk tambah barang -->
    <input type="button" class="btn btn-primary" value="+ Tambah Barang" data-bs-target="#">

    <?php
    // konek ke footer
    include "view/layout/footer.php";
    ?>
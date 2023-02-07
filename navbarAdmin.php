<?php
if (!isset($_SESSION['login'])) {
    header("Location: index");
}
?>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"> HAN Printer </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="tambahBarang.php"> Tambah Barang </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="konfirmasiTransaksi.php?idUser=<?= $user['idUser']; ?>"> Konfirmasi Transaksi </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="riwayatTransaksi.php?idUser=<?= $user['idUser']; ?>"> Riwayat Transaksi </a>
                </li>
            </ul>
        </div>
        <div class="navbar-button">
            <a href="logout.php">
                <button class="btn btn-group-lg btn-danger" type="submit" name="logut"> Logout </button>
            </a>
        </div>
    </div>
</nav>
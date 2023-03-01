<?php
// koneksi ke db
include("config/function.php");

// harus login dulu
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

// $idUser     = $_SESSION["idUser"];
// $username   = $_SESSION["name"];

// $result     = mysqli_query($conn, "SELECT * FROM 'tb_transaksi' INNER JOIN tb_barang ON tb_transaksi.idBarang = tb_barang.idBarang WHERE idUser = '$idUser' ORDER BY idTransaksi DESC");

// koneksi ke header
include("view/header.php");

// koenksi ke navbar
include("view/navbar.php");
?>

<div class="container">
    <h3 class="text-center my-3"> DAFTAR TRANSAKSI </h3>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <thead style="color: #508FC7;">
                <tr>
                    <th> Nama Pembeli </th>
                    <th> Jenis Barang </th>
                    <th> Jumlah Beli </th>
                    <th> Status </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> Rehan </td>
                    <td> mobil </td>
                    <td> 1 </td>
                    <td> Transaksi Belum di Konfirmasi </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>








<br><br><br><br><br>

<?php
// koneksi ke footer
include("view/footer.php");
?>
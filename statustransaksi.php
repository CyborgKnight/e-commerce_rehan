<?php
// koneksi ke db
include("config/function.php");

// harus login dulu
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

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
                <?php
                $result = mysqli_query($conn, "SELECT * FROM `tb_transaksi` INNER JOIN tb_barang ON tb_transaksi.idBarang = tb_barang.idBarang");

                while ($row = mysqli_fetch_assoc($result)) :

                    $status = "";
                    if ($row["status"] == 2) {
                        $status = "Transaksi di tolak";
                    } else if ($row["status"] == 1) {
                        $status = "Transaksi di konfirmasi";
                    } else {
                        $status = "Belum di konfirmasi";
                    }
                ?>
                    <tr>
                        <td><?= $row["nama"] ?></td>
                        <td><?= $row["namaBarang"] ?></td>
                        <td><?= $row["qty"] ?></td>
                        <td><?= $status ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>








<br><br><br><br><br>

<?php
// koneksi ke footer
include("view/footer.php");
?>
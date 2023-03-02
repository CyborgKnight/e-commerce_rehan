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
                    <th width="20%"> Nama Pembeli </th>
                    <th> Nama Barang </th>
                    <th width="10%"> Jumlah Beli </th>
                    <th width="10%"> Harga </th>
                    <th width="20%"> Alamat </th>
                    <th> Kurir </th>
                    <th width="18%"> Action </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM `tb_transaksi` INNER JOIN tb_barang ON tb_transaksi.idBarang = tb_barang.idBarang WHERE tb_transaksi.status = 0");
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <form action="" method="post">
                            <td><?= $row["nama"] ?></td>
                            <td><?= $row["namaBarang"] ?></td>
                            <td><?= $row["qty"] ?></td>
                            <td><?= $row["harga"] ?></td>
                            <td><?= $row["alamat"] ?></td>
                            <td><?= $row["jasa_pengiriman"] ?></td>
                            <td>
                                <input type="hidden" name="idTransaksi" value="<?= $row["idTransaksi"] ?>">
                                <button type="submit" class="btn btn-success" name="konfirmasi">Konfirmasi</button>
                                <button type="submit" class="btn btn-danger" name="tolak">Tolak</button>
                            </td>
                        </form>
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
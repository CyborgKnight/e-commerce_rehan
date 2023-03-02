<?php
// koneksi ke db
include("config/function.php");

// harus login dulu
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

$iduser     = $_SESSION["idUser"];
$query      = mysqli_query($conn, "SELECT * FROM tb_users WHERE idUser = $iduser");
$datauser   = mysqli_fetch_assoc($query);

$id = $_GET["detail"];
$query = mysqli_query($conn, "SELECT stok FROM tb_barang WHERE idBarang = $id");


// koneksi ke header
include("view/header.php");

// koenksi ke navbar
include("view/navbar.php");
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card my-3">
                <div class="card-body">
                    <div class="row">
                        <?php
                        $id     = $_GET["detail"];
                        $result = mysqli_query($conn, "SELECT * FROM tb_barang WHERE idBarang = $id");
                        while ($row = mysqli_fetch_assoc($result)) :
                            $barang     = $row["namaBarang"];
                            $harga      = $row["harga"];
                            $stok       = $row["stok"];
                            $gambar     = $row["gambar"];
                            $deskripsi  = $row["deskripsi"];
                        ?>
                            <!-- tampilan gambar/foto -->
                            <div class="col-md-6">
                                <img class="img-fluid" src="assets/img/<?= $gambar ?>" alt="">
                            </div>
                            <!-- tampilan detail deskripsi barang -->
                            <div class="col-md-6">
                                <h5> <?= $barang; ?> </h5>
                                <h4> <?= "Rp" . number_format($harga, 2); ?> </h4>
                                <p><strong> Stok </strong> <?= $stok; ?> </p>
                                <p> <?= $deskripsi ?> </p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($super_user == false) : ?>
    <?php while ($stok = mysqli_fetch_assoc($query)) :
        if ($stok["stok"] != "Tak Tersedia") :
    ?>
            <!-- form pembelian -->
            <div class="container">
                <div class="row-justify-content-center">
                    <div class="col">
                        <div class="card my-3">
                            <div class="card-header"> Form Pembelian </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="col-md-4">
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" autocomplete="off" required>
                                    </div>
                                    <br>
                                    <div class="col-md-4">
                                        <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap" autocomplete="off" required>
                                    </div>
                                    <br>
                                    <div class="col-md-4">
                                        <input type="number" name="qty" class="form-control" placeholder="jumlah Pembelian"  required>
                                    </div>
                                    <br>
                                    <div class="col-md-4">
                                        <select class="form-select" aria-label="Default select example" name="pengiriman">
                                            <option selected> Pilih Jasa Pengiriman </option>
                                            <option value="jne" name="pengiriman"> JNE </option>
                                            <option value="j&t" name="pengiriman"> J&T </option>
                                            <option value="sicepat" name="pengiriman"> SiCepat </option>
                                        </select>
                                    </div>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM tb_barang WHERE idBarang = $id");

                                    $name           = $_SESSION["name"];
                                    $ambiliduser    = mysqli_query($conn, "SELECT idUser FROM tb_users WHERE username = '$name'");
                                    $data           = mysqli_fetch_assoc($ambiliduser);
                                    ?>
                                    <br>
                                    <div class="col-md-4">
                                        <input type="hidden" name="idUser" value="<?= $data["idUser"]; ?>">
                                        <button type="submit" class="btn btn-success" name="checkout"> CheckOut </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<br><br><br><br><br>

<?php
// koneksi ke footer
include("view/footer.php");
?>
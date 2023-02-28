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
                                <p><strong> Stok <?= $stok; ?> </strong></p>
                                <p> <?= $deskripsi ?> </p>
                                <?php if ($super_user == false) : ?>
                                    <a href="formBeli.php?beli<?= $id; ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#beliBarang"> BELI </a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Beli Barang -->
    <div class="modal fade" id="beliBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Isi form di bawah ini </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-grup">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="text" placeholder="Nama Lengkap" name="nama" class="form-control" autocomplete="off" required><br>
                            <input type="text" placeholder="Alamat Lengkap" name="alamat" class="form-control" autocomplete="off" required><br>
                            <input type="number" placeholder="Jumlah Pembelian" name="qty" class="form-control" autocomplete="off" required><br>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"> Jasa Pengiriman </label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option name="kurir" value="SICEPAT" id="sicepat"> Si Cepat </option>
                                    <option name="kurir" value="JNE" id="jne"> JNE </option>
                                    <option name="kurir" value="J&T" id="j&t"> J&T </option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="idUser" value="<?= $data["idUser"]; ?>">
                                <button type="submit" class="btn btn-primary" name="checkout"> CheckOut </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br><br><br>

<?php
// koneksi ke footer
include("view/footer.php");
?>
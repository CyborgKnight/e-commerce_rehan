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

<div class="container">
    <div class="row-justify-content-center">
        <div class="col">
            <div class="card my-3">
                <div class="card-header"> Form Pembelian </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="col-md-4">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <br>
                        <div class="col-md-4">
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap" required>
                        </div>
                        <br>
                        <div class="col-md-4">
                            <input type="number" name="qty" class="form-control" placeholder="jumlah Pembelian" required>
                        </div>
                        <br>
                        <div class="col-md-4">
                            <select class="form-select" aria-label="Default select example">
                                <option selected> Pilih Jasa Pengiriman </option>
                                <option value="jne"> JNE </option>
                                <option value="j&t"> J&T </option>
                                <option value="sicepat"> SiCepat </option>
                            </select>
                        </div>
                        <br>
                        <div class="col-md-4">
                            <a href="#" class="btn btn-success"> CheckOut </a>
                        </div>
                    </form>
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
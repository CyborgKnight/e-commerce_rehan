<?php
// koneksi ke db
include("config/function.php");

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

// koneksi ke header
include("view/header.php");

// koneksi ke navbar
include("view/navbar.php");
?>

<br>

<div class="container">
    <!-- tombol tambah barang -->
    <?php if ($super_user == true) : ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahbarang">
            Tambah Barang
        </button>
    <?php endif; ?>

    <?php
    if (isset($_GET["p"])) {
        $pesan = $_GET["p"];
        echo '<div class="alert alert-secondary alert-dismissible fade show my-3" role="alert">
                <strong>' . $pesan . '</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>

    <!-- untuk menampikan barang -->
    <div class="row">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM tb_barang");
        while ($row = mysqli_fetch_assoc($result)) :
            $idBarang           = $row["idBarang"];
            $namaBarang         = $row["namaBarang"];
            $hargaBarang        = $row["harga"];
            $deskripsiBarang    = $row["deskripsi"];
            $stok               = $row["stok"];
            $gambar             = $row["gambar"];
        ?>
            <div class="col g-3">
                <div class="card h-100 border-0 kartu" style="width: 15rem; background-color: #E2E3E5;">
                    <img src="assets/img/<?= $gambar ?>" class="card-img-top" width="100%" height="150px">
                    <div class="card-body">
                        <h5 class="card-text"> <a href="detail.php?detail=<?= $idBarang ?>" class="text-decoration-none"> <?= $namaBarang ?> </a> </h5>
                        <p class="card-text"> <?= "Rp " . number_format($hargaBarang, 0, ',', '.'); ?> </p>

                        <?php if ($super_user == true) : ?>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusbarang<?= $idBarang ?>">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editbarang<?= $idBarang ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        <?php endif; ?>

                        <?php if ($super_user == false) : ?>
                            <a href="detail.php?detail=<?= $idBarang ?>" class="btn btn-primary">Beli</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Modal hapus-->
            <div class="modal fade" id="hapusbarang<?= $idBarang ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"> Hapus Barang </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                Apakah Yakin ingin menghapus <?= $namaBarang ?>?
                                <input type="hidden" name="id_barang" value="<?= $idBarang ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" name="btnhapusbarang"> Hapus </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit-->
            <div class="modal fade" id="editbarang<?= $idBarang ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"> Edit Barang </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="text" placeholder="Nama Barang" value="<?= $namaBarang ?>" name="barang" class="form-control" required><br>
                                <input type="number" placeholder="Harga" value="<?= $hargaBarang ?>" name="harga" class="form-control" required><br>
                                <input type="number" placeholder="Stok" value="<?= $stok ?>" name="stok" class="form-control" required><br>
                                <input type="text" value="<?= $deskripsiBarang ?>" placeholder="Deskripsi" name="deskripsi" class="form-control" required><br>
                                <img src="assets/img/<?= $gambar ?>" class="card-img-top"><br><br>
                                <input type="file" value="<?= $gambar ?>" name="gambar" class="form-control"><br>
                                <input type="hidden" name="gambar_lama" value="<?= $gambar; ?>">
                                <input type="hidden" name="id_barang" value="<?= $idBarang ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" name="btneditbarang">Edit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Modal tambah-->
    <div class="modal fade" id="tambahbarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-grup">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="text" placeholder="Nama Produk" name="barang" class="form-control" autocomplete="off" required><br>
                            <input type="number" placeholder="Harga" name="harga" class="form-control" autocomplete="off" required><br>
                            <input type="number" placeholder="Stok" name="stok" class="form-control" autocomplete="off" required><br>
                            <input type="text" placeholder="Deskripsi Barang" name="deskripsi" class="form-control" autocomplete="off" required><br>
                            <input type="file" name="gambar" class="form-control" required><br>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btntambahbarang">Tambah</button>
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
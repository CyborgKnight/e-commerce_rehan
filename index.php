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
    <p>selamat datang ... </p>

    <!-- untuk tambah barang -->
    <input type="button" class="btn btn-primary" value="+ Tambah Barang" data-bs-target="#">

    <!-- table barang -->
    <div class="row">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM tb_produk");
        while ($row = mysqli_fetch_assoc($result)) :
            $id = $row["id_produk"];
            $produk = $row["judul_produk"];
            $harga = $row["harga"];
            $stok = $row["stok"];
            $gambar = $row["gambar"];
        ?>
            <div class="col">
                <div class="card" style="width: 15rem;">
                    <img src="assets/img/<?= $gambar ?>" class="card-img-top" width="25%">
                    <div class="card-body">
                        <h5 class="card-title"><a href="detail.php?detail=<?= $id ?>"><?= $produk ?></a></h5>
                        <p class="card-text"><?= "Rp " . number_format($harga, 0, ',', '.'); ?></p>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusproduk<?= $id ?>">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editproduk<?= $id ?>">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal hapus-->
            <div class="modal fade" id="hapusproduk<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                Apakah Yakin ingin menghapus <?= $produk ?>?
                                <input type="hidden" name="idproduk" value="<?= $id ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" name="btnhapusproduk">Hapus</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit-->
            <div class="modal fade" id="editproduk<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="text" value="<?= $produk ?>" name="produk" class="form-control" required><br>
                                <input type="text" value="<?= $harga ?>" name="harga" class="form-control" required><br>
                                <input type="number" value="<?= $stok ?>" name="stok" class="form-control" required><br>
                                <img src="assets/img/<?= $gambar ?>" class="card-img-top"><br><br>
                                <input type="file" value="<?= $gambar ?>" name="gambar" class="form-control"><br>
                                <input type="hidden" name="idproduk" value="<?= $id ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" name="btneditproduk">Edit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
// konek ke footer
include "view/layout/footer.php";
?>
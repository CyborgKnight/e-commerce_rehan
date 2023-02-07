<?php
// koneksi ke database
include "functions/function.php";

$barangs = query("SELECT * FROM tb_barang");

if (isset($_SESSION['idUser']) && isset($_SESSION['username']) && isset($_SESSION['statusUser'])) {
    $idUser         = $_SESSION['idUser'];
    $username       = $_SESSION['username'];
    $statusUser     = $_SESSION['statusUser'];

    $result         = mysqli_query($conn, "SELECT * FROM tb_users WHERE idUser = $idUser");
    $user           = mysqli_fetch_assoc($result);
}

// koneksi ke header
include "view/header.php";


if (!isset($_SESSION['login'])) {
    include './view/navbar.php';
} elseif ($_SESSION['statusUser'] == '0') {
    include 'navbarCustomer.php';
} elseif ($_SESSION['statusUser'] == '1') {
    include './navbarAdmin.php';
}
?>
</nav>

<div class="product container mt-3">
    <div class="row row-cols-1-sm-2 row-cols-md-3 g-3">
        <?php foreach ($barangs as $barang) : ?>
            <?php $harga = $barang['harga']; ?>
            <div class="col">
                <div class="card w-100 h-100">
                    <div class="card-img-top">
                        <img src="/asset/img/imgBarang/$barang['gambar']; ?>" class="img rounded-2" width="100%" height="225" alt="">
                    </div>
                    <div class="card-body mb-auto">
                        <h5 class="card-title text-uppercase"><?= $barang['namaBarang']; ?></h5>
                        <p class="card-text"><?= $barang['deskripsi']; ?></p>
                    </div>
                    <div class="card-footer border-0  bg-white">
                        <ul class="card-text list-unstyled mb-auto">
                            <li class="card-text text-start">Stok: <?= $barang['stok']; ?></li>
                            <li class="card-text text-start">Harga: Rp<?= number_format("$harga"); ?></li>
                        </ul>
                    </div>
                    <div class="card-footer bg-white border-0 p-3">
                        <?php if (!isset($_SESSION['login'])) : ?>
                            <button submit="button" class="btn btn-md btn-primary w-100" data-bs-toggle="modal" data-bs-target="#notLogin" title="Beli Barang">Beli Barang</button>
                            <div class="modal fade" id="notLogin" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <center><img src="img/imgProperties/login.png" class="loginImg w-50"></center>
                                            <h1 class="display-6 text-center">Oops, login dahulu!</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($_SESSION['statusUser'] == '0') : ?>
                            <a href="pembelian.php?idUser=<?= $user['idUser']; ?>&idBarang=<?= $barang['idBarang']; ?>" class="btn btn-md btn-primary w-100" title="Beli Barang">Beli Barang</a>

                        <?php elseif ($_SESSION['statusUser'] == '1') : ?>
                            <button type="button" class="btn btn-md btn-warning" data-bs-toggle="modal" data-bs-target="#editBarang<?= $barang['idBarang']; ?>" title="Edit data">Edit</button>

                            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="editBarang<?= $barang['idBarang']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Barang</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <input type="hidden" name="idBarang" value="<?= $barang['idBarang']; ?>">
                                                <div class="editElement mb-3">
                                                    <label for="namaBarang" class="form-label">Nama Barang:</label>
                                                    <input type="text" name="namaBarang" id="namaBarang" class="form-control" value="<?= $barang['namaBarang']; ?>">
                                                </div>
                                                <div class="editElement mb-3">
                                                    <label for="deskripsi" class="form-label">Deskripsi :</label><br>
                                                    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control overflow-scroll"><?= $barang['deskripsi']; ?></textarea>
                                                </div>
                                                <div class="editElement mb-3">
                                                    <label for="harga" class="form-label">Harga :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Rp</span>
                                                        <input type="number" min="0" name="harga" id="harga" class="form-control" value="<?= $barang['harga']; ?>">
                                                    </div>
                                                </div>
                                                <div class="editElement mb-4">
                                                    <label for="stok" class="form-label">Stok :</label>
                                                    <input type="number" min="0" name="stok" id="stok" class="form-control" value="<?= $barang['stok']; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" name="editBarang" class="btn btn-primary">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-md btn-danger" data-bs-toggle="modal" data-bs-target="#hapusBarang<?= $barang['idBarang']; ?>" title="Hapus data">Hapus</button>

                            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="hapusBarang<?= $barang['idBarang']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                <img src="./asset/img/imgProperties/delete.png" class="deleteImg w-50 mb-4">
                                            </center>
                                            <p class="fs-4 text-center"> Yakin hapus <b class="text-uppercase">" <?= $barang['namaBarang']; ?>" </b> ? </p>
                                            <form action="" method="post">
                                                <input type="hidden" name="idBarang" value="<?= $barang['idBarang']; ?>">
                                                <div class="modal-footer d-flex justify-content-center border-0">
                                                    <button type="submit" name="hapusBarang" class="btn btn-danger px-5">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- koneksi ke footer -->
<div class="container-fluid mt-5">
    <footer class="py-3 my-4">
        <?php
        include "view/footer.php";
        ?>
    </footer>
</div>
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
            <thead style="color: #F7F7F7;">
                <tr>
                    <th width="20%"> Nama Pembeli </th>
                    <th> Jenis Barang </th>
                    <th width="10%"> Jumlah Beli </th>
                    <th width="10%"> Harga </th>
                    <th width="20%"> Alamat </th>
                    <th> Kurir </th>
                    <th width="18%"> Action </th>
                </tr>
            </thead>            
            <tbody>
                <tr>
                    <form action="" method="post">
                        <td> Rehan </td>
                        <td> mobil </td>
                        <td> 2 </td>
                        <td> 10000 </td>
                        <td> jl surga </td>
                        <td> JNE </td>
                        <td>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#konfirmasi"> Konfirmasi </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-targer="#cancel"> Cancel </button>
                        </td>
                    </form>
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
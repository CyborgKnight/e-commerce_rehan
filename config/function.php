<?php
session_start();
$conn   = mysqli_connect("localhost", "root", "", "e-commerce_rehan") or die("gagal koneksi");
$eror   = "";

// sistem register
function register($data)
{
    global $conn;
    $username       = mysqli_real_escape_string($conn, $data["username"]);
    $password       = mysqli_real_escape_string($conn, $data["password"]);

    // cek username sudah ada atau belum
    $result         = mysqli_query($conn, "SELECT username FROM tb_users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Sudah ada username yang terdaftar');
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // masukkan ke database
    mysqli_query($conn, "INSERT INTO tb_users (username, password, statusUser) VALUES ('$username', '$password', 0)");
    return mysqli_affected_rows($conn);
}

// sistem cek status user
function cek_status($username)
{
    global $conn;

    $name   = mysqli_escape_string($conn, $username);
    $query  = "SELECT statusUser FROM tb_users WHERE username = '$name'";

    if ($result = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $statusUser = $row["statusUser"];
            return $statusUser;
        }
    }
}

// untuk cek apakah yg login admin atau user biasa
$super_user = false;
if (isset($_SESSION["name"])) {
    if (cek_status($_SESSION["name"]) == 1) {
        $super_user = true;
    }
}

// sistem tambah produk
if (isset($_POST["btntambahbarang"])) {
    $title_barang           = $_POST["barang"];
    $hargaBarang            = $_POST["harga"];
    $deskripsiBarang        = $_POST["deskripsi"];
    $stokBarang             = $_POST["stok"];

    $result                 = mysqli_query($conn, "INSERT INTO tb_barang (namaBarang, harga, stok, deskripsi) VALUES ('$title_barang', '$hargaBarang', '$stokBarang','$deskripsiBarang') ");


    if ($result) {
        header("Location: dashboard.php?p=Berhasil ditambah!");
    }
}

// hapus barang
if (isset($_POST["btnhapusbarang"])) {
    $idBarang         = $_POST["id_barang"];

    $result           = mysqli_query($conn, "DELETE FROM tb_barang WHERE idBarang = $idBarang");

    if ($result) {
        header("Location: dashboard.php?p=Berhasil dihapus");
    }
}

// edit barang
if (isset($_POST["btneditbarang"])) {
    $idBarang               = $_POST["id_barang"];
    $title_barang           = $_POST["barang"];
    $harga_barang           = $_POST["harga"];
    $deskripsiBarang        = $_POST["deskripsi"];
    $stok                   = $_POST["stok"];

    $result = mysqli_query($conn, "UPDATE tb_barang SET namaBarang = '$title_barang', harga = '$harga_barang', deskripsi = '$deskripsiBarang', stok = '$stok'  WHERE idBarang = $idBarang");

    if ($result) {
        header("Location: dashboard.php?p=Berhasil mengedit");
    }
}

// sistem beli barang
if (isset($_GET["beli"])) {
    $id     = $_GET["beli"];
    $query  = mysqli_query($conn, "SELECT * FROM tb_barang WHERE idBarang = $id");
}

if (isset($_POST["checkout"])) {
    $nama           = $_POST["nama"];
    $alamat         = $_POST["alamat"];
    $pengiriman     = $_POST["pengiriman"];
    $qty            = $_POST["qty"];
    $idUser         = $_POST["idUser"];

    $idbarang = $_GET["detail"];

    $result = mysqli_query($conn, "INSERT INTO tb_transaksi (idUser, idBarang, nama, alamat, jasa_pengiriman, qty, status) VALUES ('$idUser', '$idbarang', '$nama', '$alamat', '$pengiriman', $qty, 0)");

    if ($result) {
        header("Location: statustransaksi.php");
    }
}

if (isset($_POST['konfirmasi'])) {
    $idTransaksi = $_POST["idTransaksi"];
    $result = mysqli_query($conn, "UPDATE tb_transaksi SET status = 1 WHERE idTransaksi = $idTransaksi");

    if ($result) {
        header("Location: konfirmasitransaksi.php");
    }
}

if (isset($_POST['tolak'])) {
    $idTransaksi = $_POST["idTransaksi"];
    $result = mysqli_query($conn, "UPDATE tb_transaksi SET status = 2 WHERE idTransaksi = $idTransaksi");

    if ($result) {
        header("Location: konfirmasitransaksi.php");
    }
}

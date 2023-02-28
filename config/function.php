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

// function upload nya buat gambar barang
function upload()
{
    $nama_file      = $_FILES["gambar"]["name"];
    $tipe_file      = $_FILES["gambar"]["type"];
    $ukuran_file    = $_FILES["gambar"]["size"];
    $error          = $_FILES["gambar"]["error"];
    $tmp_file       = $_FILES["gambar"]["tmp_name"];

    // cek ekstensi file
    $daftar_gambar = ["jpg", "jpeg", "png"];
    $ekstensi_file = explode(".", $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));

    if (!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<script>
            alert('yang anda pilih bukan gambar');
            window.location.href = 'dashboard.php';
        </script>";
    }

    // cek tipe file
    if ($tipe_file != "image/jpeg" && $tipe_file != "image/png") {
        echo "<script>
            alert('yang anda pilih bukan gambar');
            window.location.href = 'dashboard.php';
        </script>";
    }

    // cek ukuran file
    if ($ukuran_file > 5000000) {
        echo "<script>
            alert('ukuran gambar terlalu besar');
            window.location.href = 'dashboard.php';
        </script>";
    }

    $nama_file_baru = uniqid();
    $nama_file_baru .= ".";
    $nama_file_baru .= $ekstensi_file;

    move_uploaded_file($tmp_file, "assets/img/" . $nama_file_baru);

    return $nama_file_baru;
}

// sistem tambah produk
if (isset($_POST["btntambahbarang"])) {
    $title_barang           = $_POST["barang"];
    $hargaBarang            = $_POST["harga"];
    $deskripsiBarang        = $_POST["deskripsi"];
    $stokBarang             = $_POST["stok"];
    $gambar                 = upload();

    $result                 = mysqli_query($conn, "INSERT INTO tb_barang (namaBarang, harga, stok, deskripsi, gambar) VALUES ('$title_barang', '$hargaBarang', '$stokBarang','$deskripsiBarang', '$gambar') ");


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
    $gambar_lama            = $_POST["gambar_lama"];

    if ($_FILES["gambar"]["error"] == 4) {
        $gambar = $gambar_lama;
    } else {
        $gambar = upload();
    }

    $result = mysqli_query($conn, "UPDATE tb_barang SET namaBarang = '$title_barang', harga = '$harga_barang', deskripsi = '$deskripsiBarang', stok = '$stok', gambar = '$gambar'  WHERE idBarang = $idBarang");

    if ($result) {
        header("Location: dashboard.php?p=Berhasil mengedit");
    }
}

// sistem beli barang
if (isset($_GET["beli"])) {
    $id     = $_GET["beli"];
    $query  = mysqli_query($conn, "SELECT * FROM tb_barang WHERE idBarang = $id");
}

if (isset($_GET["checkout"])) {
    $nama   = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $kurir  = $_POST["kurir"];
    $qty    = $_POST["qty"];
    $idUser = $_POST["idUser"];

    $idbarang = $_GET["detail"];

    $query  = mysqli_query($conn, "SELECT * FROM tb_transaksi");

    // untuk cek stok barang
    $cekstoksekarang    = mysqli_query($conn, "SELECT * FROM tb_barang WHERE idBarang = $id");
    $ambildata          = mysqli_fetch_assoc($cekstoksekarang);

    $stoksekarang       = $ambildata["stok"];

    if ($stoksekarang >= $qty) {
        $kurangkanstoksekarangdenganqty = $stoksekarang - $qty;

        $updatestokmasuk = mysqli_query($conn, "UPDATE tb_barang SET stok = $kurangkanstoksekarangdenganqty WHERE idBarang = $id");
    } else {
        echo "
        <script>
        alert('Maaf stok tidak mencukupi');
            window.location.href = 'detail.php?beli={$id}';
            </script>
            ";
        die;
    }

    $result = mysqli_query($conn, "INSERT INTO tb_transaksi (idUser, idBarang, nama, alamat, jasa_pengiriman, qty, status) VALUES ('$idUser', '$idbarang', '$nama', '$alamat', '$pengiriman', $qty, 0)");

    var_dump($result);

    if ($result) {
        header("Location: statustransaksi.php?beli=" . "$id");
    }
}

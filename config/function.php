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
        }
    }
    return $statusUser;
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
    $namaBarang    = $_POST["namaBarang"];
    $deskripsi      = $_POST["deskripsi"];
    $harga          = $_POST["harga"];
    $stok           = $_POST["stok"];
    $gambar         = upload();

    $result         = mysqli_query($conn, "INSERT INTO tb_barang (namaBarang, deskripsi, harga, stok, gambar) VALUES ('$namaBarang,', '$deskripsi', '$harga', '$gambar')");

    if ($result) {
        header("Location : dashboard.php?p=Berhasil ditambah!");
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

    $nama_file_baru  = uniqid();
    $nama_file_baru .= ".";
    $nama_file_baru .= $ekstensi_file;

    move_uploaded_file($tmp_file, "assets/img/" . $nama_file_baru);

    return $nama_file_baru;
}

// hapus barang
if (isset($_POST["btnhapusbarang"])) {
    $idBarang         = $_POST["idBarang"];
    $result     = mysqli_query($conn, "DELETE FROM tb_barang WHERE id = $idBarang");

    if ($result) {
        header("Location: dashboard.php?p=Berhasil dihapus");
    }
}

// edit barang
if (isset($_POST["btnedibarang"])) {
    $idBarang       = $_POST["idBarang"];
    $title_barang   = $_POST["barang"];
    $harga          = $_POST["harga"];
    $stok           = $_POST["stok"];
    $gambar_lama    = $_POST["gambar_lama"];

    if ($_FILES["gambar"]["error"] == 4) {
        $gambar = $gambar_lama;
    } else {
        $gambar = upload();
    }

    $result = mysqli_query($conn, "UPDATE tb_barang SET namaBarang = '$title_barang', harga = '$harga', stok = '$stok', gambar = '$gambar'  WHERE id_barang = $idBarang");

    if ($result) {
        header("Location: dashboard.php?p=Berhasil mengedit");
    }
}

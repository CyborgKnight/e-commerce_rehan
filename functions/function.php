<?php
// untuk koneksi ke database
$conn   = mysqli_connect('localhost', 'root', '', 'e-commerce_rehan') or die('gagal koneksi');
$error  = '';

// sistem register
function register($data)
{
    global $conn;
    $username       = htmlspecialchars(stripslashes($data['username']));
    $password       = mysqli_real_escape_string($conn, $data['password']);
    $statusUser     = $data['statusUser'];

    $result         = mysqli_query($conn, "SELECT username FROM tb_users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        $_SESSION['username'] = true;
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO tb_users VALUES('','$username', '$password', '$statusUser')");
    return mysqli_affected_rows($conn);
}

// sistem login
function login($data)
{
    global $conn;
    $username   = $data['username'];
    $password   = $data['password'];

    $result     = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;

            if ($row['statusUser'] == '0') {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['statusUser'] = '0';
                header("Location: index.php");
                exit;
            }
            if ($row['statusUser'] == '1') {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['statusUser'] = '1';
                header("Location: index.php");
                exit;
            }
        } else {
            $_SESSION['passwordSalah'] = true;
        }
    } else {
        $_SESSION['usernameTidakAda'] = true;
    }
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// function barang
// tambah barang
function tambahBarang($data)
{
    global $conn;
    $namaBarang  = htmlspecialchars($data['namaBarang']);
    $deskripsi   = htmlspecialchars($data['deskripsi']);
    $harga       = htmlspecialchars($data['harga']);
    $stok        = htmlspecialchars($data['stok']);

    $gambar      = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO tb_barang VALUES ('', '$gambar', '$namaBarang', '$deskripsi', '$harga', '$stok')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// foto barang  
function upload()
{
    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        return 'noPhoto.jpg';
    }

    $ekstensiGambarValid = ["jpg", "jpeg", "png"];
    $ekstensiGambar      = explode(".", $namaFile);
    $ekstensiGambar      = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
        <script>
            alert('Bukan gambar yang Anda upload!');
        </script>";
        return false;
    }

    if ($ukuranFile > 3000000) {
        echo "
        <script>
            alert('Ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    $namaFileBaru  = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, "/asset/img/imgBarang" . $namaFileBaru);
    return $namaFileBaru;
}

// edit foto
if (isset($_POST['editBarang'])) {
    $idBarang           = $_POST['idBarang'];
    $namaBarang         = htmlspecialchars($_POST['namaBarang']);
    $deskripsi          = htmlspecialchars($_POST['deskripsi']);
    $harga              = htmlspecialchars($_POST['harga']);
    $stok               = htmlspecialchars($_POST['stok']);

    $queryEditBarang   = mysqli_query($conn, "UPDATE tb_barang SET namaBarang = '$namaBarang', deskripsi = '$deskripsi', harga = '$harga', stok = '$stok' WHERE idBarang = $idBarang");

    if ($queryEditBarang) {
        header("Location: index.php");
    }
}

// hapus foto
if (isset($_POST['hapusBarang'])) {
    $idBarang           = $_POST['idBarang'];
    $queryHapusBarang   = mysqli_query($conn, "DELETE FROM tb_barang WHERE idBarang = $idBarang");

    if ($queryHapusBarang) {
        header("Location: index.php");
    }
}

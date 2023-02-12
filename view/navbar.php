<?php
$super_user = false;
if (isset($_SESSION["name"])) {
  $user = true;
  if (cek_status($_SESSION["name"]) == 1) {
    $super_user = true;
  }
}
?>

<nav class="navbar navbar-expand-lg bg-info" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"> HAN Printer </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../dashboard.php">Home</a>
        </li>

        <?php if ($super_user == false) : ?>
          <li class="nav-item">
            <a class="nav-link" href="#"> Tambah Printer </a>
          </li>
        <?php endif; ?>

        <?php if ($super_user == false) : ?>
          <li class="nav-item">
            <a class="nav-link" href="#"> Konfirmasi Transaksi </a>
          </li>
        <?php endif; ?>

        <?php if ($super_user == true || $super_user == false) : ?>
          <li class="nav-item">
            <a class="nav-link" href="#"> Status Transaksi </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>

    <div class="navbar-button">
      <a href="logout.php">
        <button class="btn btn-group-lg btn-danger" type="submit" name="logut"> Logout </button>
      </a>
    </div>
  </div>
</nav>
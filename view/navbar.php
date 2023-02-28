<?php
$super_user = false;
if (isset($_SESSION["name"])) {
  $user = true;
  if (cek_status($_SESSION["name"]) == 1) {
    $super_user = true;
  }
}
?>

<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"> HAN Printer </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Home</a>
        </li>
        <?php if ($super_user == true) : ?>
          <li class="nav-item">
            <a class="nav-link" href="konfirmasitransaksi.php"> Konfirmasi Transaksi </a>
          </li>
        <?php endif; ?>
        <?php if ($super_user == false || $super_user == true) : ?>
          <li class="nav-item">
            <a class="nav-link" href="statustransaksi.php"> Status Transaksi </a>
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
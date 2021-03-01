<?php

require "../function.php";
if (isset($_SESSION['login'])) {
  if ($_SESSION['level'] === "siswa") {
    header("location:siswa/");
    exit;
  } else if ($_SESSION['level'] === "petugas") {
    header("location:petugas/");
    exit;
  }
} else {
  header("location:../");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/select2.css" />
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Halaman Admin</title>
</head>

<body>
  <header>
    <div class="container">
      <div class="branding">
        <img class="img-fluid" src="../assets/img/kanesa.png" alt="">
        <img class="img-fluid" src="../assets/img/tempat.png" alt="">
      </div>
    </div>
  </header>
  <nav class="clearfix" id="navigation">
    <a href="#" id="pull">Menu </a>
    <ul class="clearfix">
      <li><a class="item" href="?p=home">Beranda</a></li>
      <li><a class="item" href="?p=siswa">Data Siswa</a></li>
      <li><a class="item" href="?p=petugas">Data Petugas</a></li>
      <li><a class="item" href="?p=kelas">Data Kelas</a></li>
      <li><a class="item" href="?p=spp">Data SPP</a></li>
      <li><a class="item" href="?p=histori">Histori</a></li>
      <li class="right"><a class="item" href="?p=logout">
          Keluar
        </a></li>
    </ul>
  </nav>


  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <script src="../assets/js/select2.min.js"></script>
  <div class="container" style="margin-top: 30px;">
    <?php require "./content_admin.php"; ?>
  </div>
  <script>
    $(document).ready(function($) {
      $('b[role="presentation"]').hide()
      $('.select2-selection__arrow').append('<i class="fa fa-angle-down"></i>')
      $('.select2-dropdown').addClass('m-2')
    })
  </script>
  <script src="../assets/js/script.js"></script>
</body>

</html>
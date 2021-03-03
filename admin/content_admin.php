<?php

if (isset($_GET['p'])) {
  $page = $_GET['p'];
  if ($page === 'home') {
    include "./home.php";
  } elseif ($page === 'kelas') {
    include './data-kelas.php';
  } elseif ($page === 'siswa') {
    include './data-siswa.php';
  } elseif ($page === 'petugas') {
    include './data-petugas.php';
  } elseif ($page === 'spp') {
    include './data-spp.php';
  } elseif ($page === 'histori') {
    include './histori.php';
  } elseif ($page === 'laporan') {
    include './laporan.php';
  } elseif ($page === 'logout') {
    logout();
  }
} else {
  header("location:index.php?p=home");
  exit;
}

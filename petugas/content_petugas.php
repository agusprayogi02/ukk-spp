<?php

if (isset($_GET['p'])) {
  $page = $_GET['p'];
  if ($page === 'home') {
    include "./home.php";
  } elseif ($page === 'histori') {
    include "./histori.php";
  } elseif ($page === 'logout') {
    logout();
  }
} else {
  header("location:index.php?p=home");
  exit;
}

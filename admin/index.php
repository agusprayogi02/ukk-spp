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
  <title>Halaman Admin</title>
</head>

<body>

</body>

</html>
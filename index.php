<?php

include "./function.php";
if (isset($_SESSION['login'])) {
  if ($_SESSION['level'] === "admin") {
    header("location:admin/");
  } else if ($_SESSION['level'] === "petugas") {
    header("location:petugas/");
  } else {
    header("location:siswa/");
  }
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/all.min.css">
  <title>Login SPP</title>
</head>

<body>
  <div class="wrapper">
    <div class="top">
      <h1>Pembayaran SPP Online</h1>
      <h2 style="margin-bottom: 25px;">Masuk</h2>
      <form action="cek_login.php" class="form" method="POST" onsubmit="return validasi(this)">
        <div class="input_field">
          <input type="text" id="username" name="username" autocomplete="on" placeholder="USERNAME" required>
        </div>
        <div class="input_field">
          <input type="Password" id="user-password" name="password" placeholder="PASSWORD" required>
        </div>
        <input class="btn" type="submit" name="submit" value="Masuk" />
      </form>
    </div>
  </div>

  <script type="text/javascript">
    window.onload(e)

    function validasi(form) {
      if (form.username.value == "") {
        alert("Anda belum mengisikan Username");
        form.username.focus();
        return false;
      }
      if (form.password.value == "") {
        alert("Anda belum mengisikan Password.");
        form.password.focus();
        return false;
      }
      return true;
    }
  </script>
  <script src="./assets/js/script.js"></script>
</body>

</html>
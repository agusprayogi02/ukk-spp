<?php

require "../function.php";
// script Insert data
if (isset($_POST['simpan'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $username = htmlspecialchars($_POST['username']);
  $password = md5(htmlspecialchars($_POST['password']));
  $level = htmlspecialchars($_POST['level']);
  $rest = mysqli_query($conn, "INSERT INTO petugas VALUES (null,'$username','$password','$nama','$level')");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Menambahkan Petugas!');
        location.href = 'index.php?p=petugas';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Menambahkan Petugas!');
        location.href = 'index.php?p=petugas';
      </script>
    ";
  }
}

if (isset($_POST['update'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $username = htmlspecialchars($_POST['username']);
  $level = htmlspecialchars($_POST['level']);
  $id = $_POST['id'];
  $rest = mysqli_query($conn, "UPDATE petugas SET nama_petugas ='$nama',username ='$username',level='$level' where id_petugas = '$id'");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Mengubah Petugas!');
        location.href = 'index.php?p=petugas';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Mengubah Petugas!');
        location.href = 'index.php?p=petugas';
      </script>
    ";
  }
}

if (isset($_POST['changepass'])) {
  $passwordLama = md5(htmlspecialchars($_POST['password_lama']));
  $passwordBaru = md5(htmlspecialchars($_POST['password']));
  $id = $_POST['id'];
  $query = query("SELECT * FROM petugas WHERE id_petugas='$id' AND password='$passwordLama'");
  if (count($query) <= 0) {
    echo "<script>
        alert('Password Lama Salah!');
        location.href = 'index.php?p=petugas';
      </script>
    ";
  } else {
    $rest = mysqli_query($conn, "UPDATE petugas SET password='$passwordBaru' where id_petugas = '$id'");
    if ($conn->affected_rows > 0) {
      echo "<script>
        alert('Berhasil Mengubah Sandi!');
        location.href = 'index.php?p=petugas';
      </script>
    ";
    } else {
      echo "<script>
        alert('Gagal Mengubah Sandi!');
        location.href = 'index.php?p=petugas';
      </script>
    ";
    }
  }
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  $rest = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = '$id'");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Menghapus Petugas!');
        location.href = 'index.php?p=petugas';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Menghapus Petugas, Karena Masih ada Relasi!');
        location.href = 'index.php?p=petugas';
      </script>
    ";
  }
}

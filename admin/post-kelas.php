<?php

require "../function.php";
// script Insert data
if (isset($_POST['simpan'])) {
  $kelas = $_POST['kelas'];
  $kejuruan = $_POST['kejuruan'];
  $rest = mysqli_query($conn, "INSERT INTO kelas VALUES (null,'$kelas','$kejuruan')");
  if ($conn->affected_rows > 0) {
    header("location:index.php?p=kelas");
  }
  echo $conn->affected_rows;
}

if (isset($_POST['update'])) {
  $kelas = $_POST['kelas'];
  $kejuruan = $_POST['kejuruan'];
  $id = $_POST['id'];
  $rest = mysqli_query($conn, "UPDATE kelas SET nama_kelas ='$kelas', kopetensi_keahlian = '$kejuruan' where id_kelas = '$id'");
  if ($conn->affected_rows > 0) {
    header("location:index.php?p=kelas");
  }
  echo $conn->affected_rows;
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  $rest = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = '$id'");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Menghapus Kelas!');
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Menghapus Kelas, karena masih ada ikatan!');
      </script>
    ";
  }
  header("location:index.php?p=kelas");
}

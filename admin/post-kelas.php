<?php

require "../function.php";
// script Insert data
if (isset($_POST['simpan'])) {
  $kelas = htmlspecialchars($_POST['kelas']);
  $kejuruan = htmlspecialchars($_POST['kejuruan']);
  $rest = mysqli_query($conn, "INSERT INTO kelas VALUES (null,'$kelas','$kejuruan')");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Menambahkan Kelas!');
        location.href = 'index.php?p=kelas';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Menambahkan Kelas!');
        location.href = 'index.php?p=kelas';
      </script>
    ";
  }
}

if (isset($_POST['update'])) {
  $kelas = htmlspecialchars($_POST['kelas']);
  $kejuruan = htmlspecialchars($_POST['kejuruan']);
  $id = $_POST['id'];
  $rest = mysqli_query($conn, "UPDATE kelas SET nama_kelas ='$kelas', kopetensi_keahlian = '$kejuruan' where id_kelas = '$id'");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Mengubah Kelas!');
        location.href = 'index.php?p=kelas';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Mengubah Kelas');
        location.href = 'index.php?p=kelas';
      </script>
    ";
  }
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  $rest = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = '$id'");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Menghapus Kelas!');
        location.href = 'index.php?p=kelas';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Menghapus Kelas, Karena Masih ada Relasi!');
        location.href = 'index.php?p=kelas';
      </script>
    ";
  }
}

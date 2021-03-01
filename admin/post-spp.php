<?php

require "../function.php";
// script Insert data
if (isset($_POST['simpan'])) {
  $tahun = htmlspecialchars($_POST['tahun']);
  $nominal = htmlspecialchars($_POST['nominal']);
  $rest = mysqli_query($conn, "INSERT INTO spp VALUES (null,'$tahun','$nominal')");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Menambahkan SPP!');
        location.href = 'index.php?p=spp';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Menambahkan SPP!');
        location.href = 'index.php?p=spp';
      </script>
    ";
  }
}

if (isset($_POST['update'])) {
  $tahun = htmlspecialchars($_POST['tahun']);
  $nominal = htmlspecialchars($_POST['nominal']);
  $id = $_POST['id'];
  $rest = mysqli_query($conn, "UPDATE spp SET tahun ='$tahun', nominal = '$nominal' where id_spp = '$id'");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Mengubah SPP!');
        location.href = 'index.php?p=spp';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Mengubah SPP!');
        location.href = 'index.php?p=spp';
      </script>
    ";
  }
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  $rest = mysqli_query($conn, "DELETE FROM spp WHERE id_spp = '$id'");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Menghapus SPP!');
        location.href = 'index.php?p=spp';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Menghapus SPP!');
        location.href = 'index.php?p=spp';
      </script>
    ";
  }
}

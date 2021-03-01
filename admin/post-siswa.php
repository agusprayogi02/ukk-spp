<?php

require "../function.php";

if (isset($_POST['simpan'])) {
  $nisn = htmlspecialchars($_POST["nisn"]);
  $nama = htmlspecialchars($_POST["nama"]);
  $kelas = htmlspecialchars($_POST["kelas"]);
  $alamat = htmlspecialchars($_POST["alamat"]);
  $telp = htmlspecialchars($_POST["telp"]);
  $tahun = htmlspecialchars($_POST["tahun"]);
  $pass = md5($telp);
  $rest = mysqli_query($conn, "INSERT INTO siswa VALUES ('$nisn','$nama','$kelas','$alamat','$telp','$tahun')");
  $rest = mysqli_query($conn, "INSERT INTO petugas VALUES (null,'$nisn','$pass','$nama','siswa')");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Menambahkan Siswa!');
        location.href = 'index.php?p=siswa';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Menambahkan Siswa!');
        location.href = 'index.php?p=siswa';
      </script>
    ";
  }
}

if (isset($_POST['update'])) {
  $nisn = htmlspecialchars($_POST["nisn"]);
  $nama = htmlspecialchars($_POST["nama"]);
  $kelas = htmlspecialchars($_POST["kelas"]);
  $alamat = htmlspecialchars($_POST["alamat"]);
  $telp = htmlspecialchars($_POST["telp"]);
  $tahun = htmlspecialchars($_POST["tahun"]);
  $pass = md5($telp);
  $rest = mysqli_query($conn, "UPDATE siswa SET nama='$nama', id_kelas='$kelas', alamat='$alamat', no_telp='$telp',id_spp='$tahun' WHERE nisn = '$nisn'");
  $rest = mysqli_query($conn, "UPDATE petugas SET nama_petugas='$nama', password = '$pass' WHERE username = '$nisn'");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Mengubah Siswa!');
        location.href = 'index.php?p=siswa';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Mengubah Siswa!');
        location.href = 'index.php?p=siswa';
      </script>
    ";
  }
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  $rest = mysqli_query($conn, "DELETE FROM siswa WHERE nisn = '$id'");
  $rest = mysqli_query($conn, "DELETE FROM petugas WHERE username = '$id'");
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Menghapus Siswa!');
        location.href = 'index.php?p=siswa';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Menghapus Siswa!');
        location.href = 'index.php?p=siswa';
      </script>
    ";
  }
}

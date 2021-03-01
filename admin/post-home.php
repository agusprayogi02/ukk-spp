<?php

require '../function.php';
if (isset($_POST['simpan'])) {
  $idP = $_SESSION['id'];
  $nama = htmlspecialchars($_POST['nama']);
  $tgl = htmlspecialchars($_POST['tgl']);
  $bulan = $_POST['bulan'];
  $id_tahun = htmlspecialchars($_POST['id_tahun']);
  $tahun = htmlspecialchars($_POST['tahun']);
  $nominal = htmlspecialchars($_POST['nominal']);

  $query = "";
  foreach ($bulan as $i => $bln) {
    $query .= "(null,'$idP','$nama','$tgl','$bln','$tahun','$id_tahun','$nominal'),";
  }
  $str = substr($query, 0, -1);
  $rest = mysqli_query($conn, "INSERT INTO pembayaran VALUES " . $str);
  if ($conn->affected_rows > 0) {
    echo "<script>
        alert('Berhasil Melakukan Transaksi Pembayaran SPP!');
        location.href = 'index.php?p=home';
      </script>
    ";
  } else {
    echo "<script>
        alert('Gagal Melakukan Transaksi Pembayaran SPP!');
        location.href = 'index.php?p=home';
      </script>
    ";
  }
}

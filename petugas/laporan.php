<?php

require "../function.php";
if (isset($_GET['nisn'])) {
  $nisn = $_GET['nisn'];
  $str = "SELECT * FROM pembayaran as a JOIN siswa as b ON a.nisn = b.nisn JOIN kelas as c ON b.id_kelas = c.id_kelas JOIN petugas as d ON a.id_petugas = d.id_petugas WHERE a.nisn = '$nisn' ";
  $query = query($str);
}

$bln = '01';
if (isset($_GET['bln'])) {
  $bln = $_GET['bln'];
}
foreach ($query as $key => $p) {
  $nama = $p['nama'];
  $kelas = $p['nama_kelas'] . " " . $p['kopetensi_keahlian'];
  $Npetugas = $p['nama_petugas'];
}

?>

<style>
  tr th {
    text-align: left;
  }

  table tr th,
  table tr td {
    padding: 10px 30px;
  }
</style>
<table>
  <tr>
    <th>Nama</th>
    <td><?= $nama; ?></td>
  </tr>
  <tr>
    <th>Kelas</th>
    <td><?= $kelas; ?></td>
  </tr>
  <tr>
    <th>Bulan</th>
    <td><?= $bln; ?></td>
  </tr>
  <tr>
    <th>Nama Petugas</th>
    <td><?= $Npetugas; ?></td>
  </tr>
</table>

<script>
  window.print();
</script>
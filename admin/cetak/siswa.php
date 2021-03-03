<?php

require "../../function.php";
if (isset($_GET['kelas'])) {
  $str = "SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas JOIN spp as c ON a.id_spp = c.id_spp ";
  $kelas = $_GET['kelas'];
  $str .= $kelas != "" ? "WHERE a.id_kelas = '$kelas'" : "";
} else {
  $str = "SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas JOIN spp as c ON a.id_spp = c.id_spp";
}
$query = query($str);

?>
<link rel="stylesheet" href="../../assets/css/style.css">
<div id="print-area">
  <table class="table table-responsive">
    <thead>
      <tr class="table-blue">
        <th>No</th>
        <th>NISN</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Tahun Masuk</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $i = 1;
      foreach ($query as $key => $isi) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><?= $isi['nisn']; ?></td>
          <td><?= $isi['nama']; ?></td>
          <td><?= $isi['nama_kelas'] . " " . $isi['kopetensi_keahlian']; ?></td>
          <td><?= $isi['alamat']; ?></td>
          <td><?= $isi['no_telp']; ?></td>
          <td><?= $isi['tahun']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.href = originalContents;
  }

  printDiv("print-area");
  console.log("coba");
</script>
<?php

if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $str = "SELECT * FROM pembayaran as a JOIN siswa as b ON a.nisn = b.nisn JOIN kelas as c ON b.id_kelas = c.id_kelas WHERE b.nama LIKE '%$cari%' ";
  // cek pilih kelas
  if (isset($_GET['kelas'])) {
    $kelas = $_GET['kelas'];
    $str .= $kelas != "" ? "AND a.id_kelas = '$kelas' " : " ";
  }
  $query = query($str);
} else {
  $query = query("SELECT * FROM pembayaran");
}
$baris = 2; // banyak perhalaman
$jum = count($query);
$page = ceil($jum / $baris);
$limit = 0;
if (isset($_GET['l'])) {
  $l = $_GET['l'];
  $limit = ($l - 1) * $baris;
}

if (isset($_GET['cari'])) {
  $query = query($str . "ORDER BY id_pembayaran DESC LIMIT " . $limit . "," . $baris);
} else {
  $query = query("SELECT * FROM pembayaran as a JOIN siswa as b ON a.nisn = b.nisn JOIN kelas as c ON b.id_kelas = c.id_kelas ORDER BY id_pembayaran DESC LIMIT " . $limit . "," . $baris);
}
// get semua kelas
$kelas = query("SELECT * FROM kelas");
$tahun = query("SELECT * FROM spp");

?>


<div class="card">
  <div class="card-header">
    <h3 class="t-center">Histori Transaksi Pembayaran</h4>
  </div>
  <div class="card-header bg-white">
    <div class="row mx-2">
      <form class="col-sm-8  col-xl-5 row" action="index.php" method="get">
        <input type="hidden" name="p" value="histori">
        <input placeholder="Cari Nama.." type="text" name="cari" class="input-form col">
        <select name="kelas" id="cari-kelas" class="input-select col-xl-3 mx-2">
          <option value="">Kelas</option>
          <?php foreach ($kelas as $key => $k) : ?>
            <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas'] . " " . $k['kopetensi_keahlian']; ?></option>
          <?php endforeach; ?>
        </select>
        <button class="btn col-md-4 col-xl-2" type="submit">
          Cari
        </button>
      </form>
      <a href="index.php?p=home" class="btn col-sm-4 col-md-2  off-md-5">
        Tambah
      </a>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-responsive">
      <thead>
        <tr class="table-blue">
          <th>No</th>
          <th>Tanggal</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Nominal</th>
          <th>Tindakan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($query as $key => $isi) : ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= $isi['nisn']; ?></td>
            <td><?= $isi['tgl_bayar']; ?></td>
            <td><?= $isi['nama_kelas'] . " " . $isi['kopetensi_keahlian']; ?></td>
            <td><?= $isi['bulan_dibayar']; ?></td>
            <td><?= $isi['tahun_dibayar']; ?></td>
            <td><?= $isi['jumlah_bayar']; ?></td>
            <td class="col-sm-6 col-xl-3 t-center">
              <button data-target="update-modal" data-all="<?= $isi['nisn'] . "," . $isi['nama'] . ","  . $isi['alamat'] . "," . $isi['no_telp']; ?>" data-kelas="<?= $isi['id_kelas']; ?>" data-tahun="<?= $isi['id_spp']; ?>" class="btn btn-orange">Ubah</button> |
              <button onclick="onDelete(<?= $isi['nisn']; ?>)" class="btn btn-red">Hapus</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <!-- pagination -->
    <div class="page">
      <h4>Halaman</h4>
      <div class="pagination" id="pagination">
        <?php
        $page = $page == 0 ? 1 : $page;
        for ($i = 1; $i <= $page; $i++) : ?>
          <a href="index.php?p=histori&l=<?= $i; ?>"><?= $i; ?></a>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</div>
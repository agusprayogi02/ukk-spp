<?php

$uid = $_SESSION['id'];
if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $str = "SELECT * FROM pembayaran as a JOIN siswa as b ON a.nisn = b.nisn JOIN kelas as c ON b.id_kelas = c.id_kelas WHERE a.id_petugas = '$uid' b.nama LIKE '%$cari%' ";
  // cek pilih kelas
  if (isset($_GET['kelas'])) {
    $kelas = $_GET['kelas'];
    $str .= $kelas != "" ? "AND b.id_kelas = '$kelas' " : " ";
  }
  $query = query($str);
} else {
  $query = query("SELECT * FROM pembayaran as a JOIN siswa as b ON a.nisn = b.nisn JOIN kelas as c ON b.id_kelas = c.id_kelas WHERE a.id_petugas = '$uid'");
}
$printAll = $query;
$baris = 5; // banyak perhalaman
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
  $query = query("SELECT * FROM pembayaran as a JOIN siswa as b ON a.nisn = b.nisn JOIN kelas as c ON b.id_kelas = c.id_kelas Where a.id_petugas = '$uid' ORDER BY id_pembayaran DESC LIMIT " . $limit . "," . $baris);
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
      <div class="col t-right">
        <button class="btn">
          <a href="index.php?p=home">
            Tambah
          </a>
        </button>
      </div>
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
        $i = $limit + 1;
        foreach ($query as $key => $isi) : ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= $isi['tgl_bayar']; ?></td>
            <td><?= $isi['nama']; ?></td>
            <td><?= $isi['nama_kelas'] . " " . $isi['kopetensi_keahlian']; ?></td>
            <td><?= $isi['bulan_dibayar']; ?></td>
            <td><?= $isi['tahun_dibayar']; ?></td>
            <td><?= $isi['jumlah_bayar']; ?></td>
            <td class="t-center">
              <button onclick="onDelete(<?= $isi['id_pembayaran']; ?>)" class="btn btn-red">Hapus</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <!-- pagination -->
    <div class="row">
      <div class="page col">
        <h4>Halaman</h4>
        <div class="pagination" id="pagination">
          <?php
          $page = $page == 0 ? 1 : $page;
          for ($i = 1; $i <= $page; $i++) : ?>
            <a href="index.php?p=siswa&l=<?= $i; ?>"><?= $i; ?></a>
          <?php endfor; ?>
        </div>
      </div>
      <div class="col-2 t-right">
        <button onclick="printDiv('print-area')" class="btn mt-3 mr-4">
          Cetak
        </button>
      </div>
    </div>
  </div>
</div>

<div id="print-area" style="display: none;">
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
      </tr>
    </thead>
    <tbody>
      <?php
      $i = 1;
      foreach ($printAll as $key => $p) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><?= $p['tgl_bayar']; ?></td>
          <td><?= $p['nama']; ?></td>
          <td><?= $p['nama_kelas'] . " " . $p['kopetensi_keahlian']; ?></td>
          <td><?= $p['bulan_dibayar']; ?></td>
          <td><?= $p['tahun_dibayar']; ?></td>
          <td><?= $p['jumlah_bayar']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  // cetak
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }

  function onDelete(id) {
    var r = confirm("Yakin Ingin Menghapus data Histori ini?"),
      cur = $(location).attr('href');
    if (r) {
      $(location).attr('href', './post-home.php?del=' + id)
    }
  }

  // pagination
  $(document).ready(() => {
    var pageItem = $('#pagination a'),
      page = $(location).attr('href').split('#')[0].split('?')[1].split('&l='),
      current = page[1]
    $(pageItem[0]).addClass('active')
    console.log(page[0]);
    for (let i = 0; i < pageItem.length; i++) {
      var href = $(pageItem[i]).attr('href').split('&l=')[1]
      $(pageItem[i]).attr('href', "index.php?" + page[0] + "&l=" + (i + 1))
      if (href == current || href == decodeURIComponent(current)) {
        $(pageItem[i]).addClass('active')
        if ($(pageItem[i]).attr('href') != $(pageItem[0]).attr('href')) {
          $(pageItem[0]).removeClass('active')
        }
      }
    }
  })
</script>
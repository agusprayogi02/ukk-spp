<?php

$query = query("SELECT * FROM siswa");
$kelas = query("SELECT * FROM kelas");
$baris = 1; // banyak perhalaman
$jum = count($query);
$page = ceil($jum / $baris);
$limit = 0;
if (isset($_GET['l'])) {
  $l = $_GET['l'];
  $limit = ($l - 1) * $baris;
  $query = query("SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas JOIN spp as c ON a.id_spp = c.id_spp LIMIT " . $limit . ", " . $baris);
} else {
  $query = query("SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas JOIN spp as c ON a.id_spp = c.id_spp LIMIT " . 0 . "," . $baris);
}

if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $kelas = $_GET['kelas'];
  $query = query("SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas JOIN spp as c ON a.id_spp = c.id_spp WHERE a.nama LIKE '%$cari%' AND a.id_kelas = '$kelas'");
}

?>

<div class="card">
  <div class="card-header">
    <h3 class="t-center">Kelola Data Siswa</h4>
  </div>
  <div class="card-header bg-white">
    <div class="row mx-2">
      <form class="col-sm-8  col-xl-5 row" action="index.php?p=kelas" method="get">
        <input type="hidden" name="p" value="siswa">
        <input placeholder="Cari Nama.." type="text" name="cari" class="input-form col">
        <select name="kelas" id="kelas" class="input-select col-xl-3 mx-2">
          <option value="">Kelas</option>
          <?php foreach ($kelas as $key => $k) : ?>
            <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas'] . " " . $k['kopetensi_keahlian'];; ?></option>
          <?php endforeach; ?>
        </select>
        <button class="btn col-md-4 col-xl-2" type="submit">
          Cari
        </button>
      </form>
      <button name="tambah" data-target="tambah-modal" class="btn col-sm-4 col-md-2  off-md-5">
        Tambah
      </button>
    </div>
  </div>
  <div class="card-body">
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
            <td><?= $isi['nama']; ?></td>
            <td><?= $isi['nama_kelas'] . " " . $isi['kopetensi_keahlian']; ?></td>
            <td><?= $isi['alamat']; ?></td>
            <td><?= $isi['no_telp']; ?></td>
            <td><?= $isi['tahun']; ?></td>
            <td class="col-sm-6 col-xl-3 t-center">
              <button data-target="update-modal" data-kelas="<?= $isi['nama_kelas']; ?>" data-jurusan="<?= $isi['kopetensi_keahlian']; ?>" data-id="<?= $isi['id_kelas']; ?>" class="btn btn-orange">Update</button> |
              <button onclick="onDelete(<?= $isi['id_kelas']; ?>)" class="btn btn-red">Delete</button>
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
          <a href="index.php?p=kelas&l=<?= $i; ?>"><?= $i; ?></a>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal" id="tambah-modal">
  <div class="modal-content col-4">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Tambah Siswa</h2>
    </div>
    <form id="form-tambah" action="./post-kelas.php" method="post" onsubmit="return validation(this)">
      <div class="modal-body">
        <input id="t-kelas" type="number" class="input-form mb-3" name="kelas" placeholder="Kelas.." require>
        <input id="t-jurusan" type="text" class="input-form" name="kejuruan" placeholder="Nama Kopetensi Keahlian.." require>
      </div>
      <div class="modal-footer t-right">
        <button class="btn" type="submit" name="simpan">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Ubah -->
<div class="modal" id="update-modal">
  <div class="modal-content col-4">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Ubah Data Kelas</h2>
    </div>
    <form id="form-update" action="./post-kelas.php" method="post" onsubmit="return validation(this)">
      <div class="modal-body">
        <input type="hidden" name="id" id="u-id">
        <input id="u-kelas" type="number" class="input-form mb-3" name="kelas" placeholder="Kelas.." require>
        <input id="u-jurusan" type="text" class="input-form" name="kejuruan" placeholder="Nama Kopetensi Keahlian.." require>
      </div>
      <div class="modal-footer t-right">
        <button class="btn" type="submit" name="update">Ubah</button>
      </div>
    </form>
  </div>
</div>


<script>
  $(window).ready(() => {
    var pageItem = $('#pagination a'),
      current = $(location).attr('href').split('#')[0].split('?')[1].split('&')[1]
    $(pageItem[0]).addClass('active')
    for (let i = 0; i < pageItem.length; i++) {
      var href = $(pageItem[i]).attr('href').split('?')[1].split('&')[1]
      if (href == current || href == decodeURIComponent(current)) {
        console.log(href);
        $(pageItem[i]).addClass('active')
        if ($(pageItem[i]).attr('href') != $(pageItem[0]).attr('href')) {
          $(pageItem[0]).removeClass('active')
        }
      }
    }
  })
</script>
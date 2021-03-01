<?php

if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $kelas = $_GET['kelas'];
  $str = "SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas JOIN spp as c ON a.id_spp = c.id_spp WHERE a.nama LIKE '%$cari%'";
  // cek pilih kelas
  $str .= $kelas != "" ? "AND a.id_kelas = '$kelas'" : "";
  $query = query($str);
} else {
  $query = query("SELECT * FROM siswa");
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
  $query = query($str . "LIMIT " . $limit . "," . $baris);
} else {
  $query = query("SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas JOIN spp as c ON a.id_spp = c.id_spp LIMIT " . $limit . "," . $baris);
}
// get semua kelas
$kelas = query("SELECT * FROM kelas");
$tahun = query("SELECT * FROM spp");

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
          <a href="index.php?p=siswa&l=<?= $i; ?>"><?= $i; ?></a>
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
    <form id="form-tambah" action="./post-siswa.php" method="post" onsubmit="return validation(this)">
      <div class="modal-body">
        <input type="number" class="input-form mb-3" name="nisn" placeholder="Nisn.." require>
        <input type="text" class="input-form mb-3" name="nama" placeholder="Nama.." require>
        <select name="kelas" class="input-select mb-3 select-kelas">
          <option value="">Kelas</option>
          <?php foreach ($kelas as $key => $k) : ?>
            <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas'] . " " . $k['kopetensi_keahlian']; ?></option>
          <?php endforeach; ?>
        </select>
        <input type="text" class="input-form my-3" name="alamat" placeholder="Alamat.." require>
        <input type="number" class="input-form mb-3" name="telp" placeholder="No HP.." require>
        <select name="tahun" class="input-select select-tahun">
          <option value="">Tahun</option>
          <?php foreach ($tahun as $key => $t) : ?>
            <option value="<?= $t['id_spp']; ?>"><?= $t['tahun']; ?></option>
          <?php endforeach; ?>
        </select>
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
    <form id="form-update" action="./post-siswa.php" method="post" onsubmit="return validation(this)">
      <div class="modal-body">
        <input type="number" readonly class="input-form mb-3" name="nisn" placeholder="Nisn.." require>
        <input type="text" class="input-form mb-3" name="nama" placeholder="Nama.." require>
        <select name="kelas" id="u-kelas" class="input-select mb-3 select-kelas">
          <option value="">Kelas</option>
          <?php foreach ($kelas as $key => $k) : ?>
            <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas'] . " " . $k['kopetensi_keahlian']; ?></option>
          <?php endforeach; ?>
        </select>
        <input type="text" class="input-form my-3" name="alamat" placeholder="Alamat.." require>
        <input type="number" class="input-form mb-3" name="telp" placeholder="No HP.." require>
        <select name="tahun" class="input-select select-tahun" id="u-tahun">
          <option value="">Tahun</option>
          <?php foreach ($tahun as $key => $t) : ?>
            <option value="<?= $t['id_spp']; ?>"><?= $t['tahun']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="modal-footer t-right">
        <button class="btn" type="submit" name="update">Ubah</button>
      </div>
    </form>
  </div>
</div>

<script>
  // select
  $('.select-kelas').select2({
    width: '100%',
    placeholder: 'Pilih Kelas..'
  })
  $('.select-tahun').select2({
    width: '100%',
    placeholder: 'Pilih Tahun Masuk..'
  })

  $('#cari-kelas').select2({
    width: '35%',
    placeholder: 'Kelas..'
  })

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

  function onDelete(id) {
    var r = confirm("Yakin Ingin Menghapus data Siswa ini?"),
      cur = $(location).attr('href');
    if (r) {
      $(location).attr('href', './post-siswa.php?del=' + id)
    }
  }

  // modal
  $('.btn').click((e) => {
    if ($(e.target).data('target') == 'update-modal') {
      var target = document.getElementById("update-modal").getElementsByTagName('input'),
        data = $(e.target).data('all').split(","),
        i = 0;
      while (i < data.length) {
        $(target[i]).val(data[i]);
        i++;
      }
      var kelas = $(e.target).data('kelas'),
        tahun = $(e.target).data('tahun');
      if ($('#u-kelas').find("option[value='" + kelas + "']").length) {
        $('#u-kelas').val(kelas).trigger('change');
      }
      if ($('#u-tahun').find("option[value='" + tahun + "']").length) {
        $('#u-tahun').val(tahun).trigger('change');
      }
    } else if ($(e.target).data('target') == 'tambah-modal') {
      var target = $("#tambah-modal input");
      $(target[0]).focus();
    }
  })

  // validasi
  function validation(form) {
    if (form.nisn.value == "") {
      alert("Anda belum mengisikan NISN!");
      form.nisn.focus();
      return false;
    }
    if (form.nama.value == "") {
      alert("Anda belum mengisikan Nama!");
      form.nama.focus();
      return false;
    }
    if (form.kelas.value == "") {
      alert("Anda belum mengisikan Kelas!");
      form.kelas.focus();
      return false;
    }
    if (form.alamat.value == "") {
      alert("Anda belum mengisikan alamat!");
      form.alamat.focus();
      return false;
    }
    if (form.telp.value == "") {
      alert("Anda belum mengisikan No Hp!");
      form.telp.focus();
      return false;
    }
    if (form.telp.value.length > 13) {
      alert("No Hp telalu banyak!");
      form.telp.focus();
      return false;
    }
    if (form.tahun.value == "") {
      alert("Anda belum mengisikan Tahun!");
      form.tahun.focus();
      return false;
    }
    return true
    form.defaultPrevented()
  }
</script>
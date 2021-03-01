<?php

if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $query = query("SELECT * FROM kelas WHERE kopetensi_keahlian LIKE '%$cari%' ");
} else {
  $query = query("SELECT * FROM kelas");
}
$baris = 1;
$jum = count($query);
$page = ceil($jum / $baris);
$limit = 0;
if (isset($_GET['l'])) {
  $l = $_GET['l'];
  $limit = ($l - 1) * $baris;
}
if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $query = query("SELECT * FROM kelas WHERE kopetensi_keahlian LIKE '%$cari%' LIMIT " . $limit . "," . $baris);
} else {
  $query = query("SELECT * FROM kelas LIMIT " . $limit . "," . $baris);
}


?>

<div class="card">
  <div class="card-header">
    <h3 class="t-center">Kelola Data Kelas</h4>
  </div>
  <div class="card-header" style="background-color: #fff;">
    <div class="row mx-2">
      <form class="col-sm-8 col-md-5 row" action="index.php?p=kelas" method="get">
        <input type="hidden" name="p" value="kelas">
        <input placeholder="Cari Berdasarkan Kejuruan.." type="text" name="cari" class="input-form col">
        <button class="btn col-md-4 col-2 mx-2" type="submit">
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
          <th>Kelas</th>
          <th>Jurusan</th>
          <th>Tindakan</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $i = $limit + 1;
        foreach ($query as $key => $isi) : ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= $isi['nama_kelas']; ?></td>
            <td><?= $isi['kopetensi_keahlian']; ?></td>
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

<div class="modal" id="tambah-modal">
  <!-- Modal content -->
  <div class="modal-content col-4">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Tambah Kelas</h2>
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

<div class="modal" id="update-modal">
  <!-- Modal content -->
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
  // modal
  $('.btn').click((e) => {
    if ($(e.target).data('target') == 'update-modal') {
      $('#u-kelas').focus()
      $('#u-id').val($(e.target).data('id'))
      $('#u-kelas').val($(e.target).data('kelas'))
      $('#u-jurusan').val($(e.target).data('jurusan'))
    } else if ($(e.target).data('target') == 'tambah-modal') {
      $('#t-kelas').focus()
    }
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

  // komfirmasi delete
  function onDelete(id) {
    var r = confirm("Yakin Ingin Menghapus data Kelas ini?"),
      cur = $(location).attr('href');
    if (r) {
      $(location).attr('href', './post-kelas.php?del=' + id)
    }
  }

  // validation
  function validation(form) {
    if (form.kelas.value == '') {
      alert("Anda belum mengisikan Kelas!");
      form.kelas.focus();
      return false;
    }
    if (form.kejuruan.value == '') {
      alert("Anda belum mengisikan Kompetensi Keahlian!");
      form.kejuruan.focus();
      return false;
    }
    return true;
    form.defaultPrevented()
  }
</script>
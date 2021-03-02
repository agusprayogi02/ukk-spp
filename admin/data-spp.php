<?php

if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $query = query("SELECT * FROM spp WHERE tahun LIKE '%$cari%' ");
} else {
  $query = query("SELECT * FROM spp");
}
$baris = 2;
$jum = count($query);
$page = ceil($jum / $baris);
$limit = 0;
if (isset($_GET['l'])) {
  $l = $_GET['l'];
  $limit = ($l - 1) * $baris;
}
if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $query = query("SELECT * FROM spp WHERE tahun LIKE '%$cari%' LIMIT " . $limit . "," . $baris);
} else {
  $query = query("SELECT * FROM spp LIMIT " . $limit . "," . $baris);
}


?>

<div class="card">
  <div class="card-header">
    <h3 class="t-center">Kelola Data SPP Pertahun</h4>
  </div>
  <div class="card-header" style="background-color: #fff;">
    <div class="row mx-2">
      <form class="col-sm-8 col-md-4 row" action="index.php" method="get">
        <input type="hidden" name="p" value="spp">
        <input placeholder="Cari Berdasarkan Tahun.." type="text" name="cari" class="input-form col">
        <button class="btn col-md-4 col-xl-2 mx-2" type="submit">
          Cari
        </button>
      </form>
      <div class="col t-right">
        <button name="tambah" data-target="tambah-modal" class="btn">
          Tambah
        </button>
      </div>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-responsive">
      <thead>
        <tr class="table-blue">
          <th>No</th>
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
            <td><?= $isi['tahun']; ?></td>
            <td><?= $isi['nominal']; ?></td>
            <td class="col-sm-6 col-xl-3 t-center">
              <button data-target="update-modal" data-all="<?= $isi['id_spp'] . "," . $isi['tahun'] . "," . $isi['nominal']; ?>" class="btn btn-orange">Ubah</button> |
              <button onclick="onDelete(<?= $isi['id_spp']; ?>)" class="btn btn-red">Hapus</button>
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
        <button class="btn mt-3 mr-4">
          Cetak
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="tambah-modal">
  <!-- Modal content -->
  <div class="modal-content col-4">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Tambah SPP</h2>
    </div>
    <form id="form-tambah" action="./post-spp.php" method="post" onsubmit="return validation(this)">
      <div class="modal-body">
        <input type="number" class="input-form mb-3" name="tahun" placeholder="Tahun.." require>
        <input type="number" class="input-form" name="nominal" placeholder="Nominal Uang.." require>
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
      <h2>Ubah Data SPP</h2>
    </div>
    <form id="form-update" action="./post-spp.php" method="post" onsubmit="return validation(this)">
      <div class="modal-body">
        <input type="hidden" name="id" id="u-id">
        <input type="number" class="input-form mb-3" name="tahun" placeholder="Tahun.." require>
        <input type="number" class="input-form" name="nominal" placeholder="Nominal Uang.." require>
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
      var all = $(e.target).data('all').split(','),
        target = $('#update-modal input'),
        i = 0
      console.log(target[0]);
      $('#u-kelas').focus()
      while (i < all.length) {
        $(target[i]).val(all[i])
        i++
      }
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
    var r = confirm("Yakin Ingin Menghapus data SPP ini?"),
      cur = $(location).attr('href');
    if (r) {
      $(location).attr('href', './post-spp.php?del=' + id)
    }
  }

  // validation
  function validation(form) {
    if (form.tahun.value == '') {
      alert("Anda belum mengisikan Tahun!");
      form.tahun.focus();
      return false;
    }
    if (form.tahun.value.length > 4) {
      alert("Inputan Tahun yang anda masukkan terlalu banyak!");
      form.tahun.focus();
      return false;
    }
    if (form.nominal.value == '') {
      alert("Anda belum mengisikan Nominal Uang!");
      form.nominal.focus();
      return false;
    }
    if (form.nominal.value.length > 11) {
      alert("Inputan Nominal Uang yang anda masukkan terlalu banyak!");
      form.nominal.focus();
      return false;
    }
    return true;
    form.defaultPrevented()
  }
</script>
<?php

if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $query = query("SELECT * FROM petugas WHERE nama_petugas LIKE '%$cari%' ");
} else {
  $query = query("SELECT * FROM petugas");
}
$printAll = $query;
$baris = 5;
$jum = count($query);
$page = ceil($jum / $baris);
$limit = 0;
if (isset($_GET['l'])) {
  $l = $_GET['l'];
  $limit = ($l - 1) * $baris;
}
if (isset($_GET['cari'])) {
  $cari = $_GET['cari'];
  $query = query("SELECT * FROM petugas WHERE nama_petugas LIKE '%$cari%' LIMIT " . $limit . "," . $baris);
} else {
  $query = query("SELECT * FROM petugas LIMIT " . $limit . "," . $baris);
}


?>

<div class="card">
  <div class="card-header">
    <h3 class="t-center">Kelola Data Petugas</h4>
  </div>
  <div class="card-header" style="background-color: #fff;">
    <div class="row mx-2">
      <form class="col-sm-8 col-md-4 row" action="index.php" method="get">
        <input type="hidden" name="p" value="petugas">
        <input placeholder="Cari Berdasarkan Nama.." type="text" name="cari" class="input-form col">
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
          <th>Nama</th>
          <th>Username</th>
          <th>Jabatan</th>
          <th>Tindakan</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $i = $limit + 1;
        foreach ($query as $key => $isi) : ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= $isi['nama_petugas']; ?></td>
            <td><?= $isi['username']; ?></td>
            <td><?= $isi['level']; ?></td>
            <td class="col-sm-6 col-xl-4 t-center">
              <button data-target="pass-modal" data-id="<?= $isi['id_petugas']; ?>" class="btn btn-orange">Ubah Sandi</button> |
              <button data-target="update-modal" data-all="<?= $isi['id_petugas'] . "," . $isi['nama_petugas'] . "," . $isi['username']; ?>" data-level="<?= $isi['level']; ?>" class="btn btn-orange">Ubah</button> |
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
        <button onclick="printDiv('print-area')" class="btn mt-3 mr-4">
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
      <h2>Tambah Petugas</h2>
    </div>
    <form id="form-tambah" action="./post-petugas.php" method="post" onsubmit="return validation(this)">
      <div class="modal-body">
        <input type="text" class="input-form mb-3" name="nama" placeholder="Nama Petugas.." require>
        <input type="text" class="input-form mb-3" name="username" placeholder="Username.." require>
        <input type="password" class="input-form mb-3" name="password" placeholder="Sandi.." require>
        <select class="input-select" name="level" id="">
          <option>Jabatan</option>
          <option value="admin">Admin</option>
          <option value="petugas">Petugas</option>
        </select>
      </div>
      <div class="modal-footer t-right">
        <button class="btn" type="submit" name="simpan">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="modal" id="pass-modal">
  <!-- Modal content -->
  <div class="modal-content col-4">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Ubah Password</h2>
    </div>
    <form id="form-pass" action="./post-petugas.php" method="post" onsubmit="return validasi(this)">
      <div class="modal-body">
        <input type="hidden" name="id" id="p-id">
        <input type="password" class="input-form mb-3" name="password_lama" placeholder="Sandi Lama.." require>
        <input type="password" class="input-form mb-3" name="password_baru" placeholder="Sandi Baru.." require>
        <input type="password" class="input-form mb-3" name="password" placeholder="Konfirmasi Sandi.." require>
      </div>
      <div class="modal-footer t-right">
        <button class="btn" id="btn-pass" type="submit" name="changepass">Ubah</button>
      </div>
    </form>
  </div>
</div>

<div class="modal" id="update-modal">
  <!-- Modal content -->
  <div class="modal-content col-4">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Ubah Data Petugas</h2>
    </div>
    <form id="form-update" action="./post-petugas.php" method="post" onsubmit="return validationUpdate(this)">
      <div class="modal-body">
        <input type="hidden" name="id" id="u-id">
        <input type="text" class="input-form mb-3" name="nama" placeholder="Nama Petugas.." require>
        <input type="text" class="input-form mb-3" name="username" placeholder="Username.." require>
        <select class="input-select" name="level" id="u-level">
          <option>Jabatan</option>
          <option value="admin">Admin</option>
          <option value="petugas">Petugas</option>
          <option disabled value="siswa">Siswa</option>
        </select>
      </div>
      <div class="modal-footer t-right">
        <button class="btn" type="submit" name="update">Ubah</button>
      </div>
    </form>
  </div>
</div>


<div id="print-area" style="display: none;">
  <table class="table table-responsive">
    <thead>
      <tr class="table-blue">
        <th>No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Jabatan</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $i = 1;
      foreach ($printAll as $key => $p) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><?= $p['nama_petugas']; ?></td>
          <td><?= $p['username']; ?></td>
          <td><?= $p['level']; ?></td>
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

  // modal
  $('.btn').click((e) => {
    if ($(e.target).data('target') == 'update-modal') {
      var all = $(e.target).data('all').split(','),
        target = $('#update-modal input'),
        i = 0
      $(target[1]).focus()
      while (i < all.length) {
        $(target[i]).val(all[i])
        i++
      }
      if ($(e.target).data('level') != 'siswa') {
        $('#u-level').val($(e.target).data('level')).trigger('change');
        $('#u-level').prop("disabled", false);
        $(target[2]).prop('readonly', false)
      } else {
        $(target[2]).prop('readonly', true)
        $('#u-level').val($(e.target).data('level')).trigger('change');
        $('#u-level').prop("disabled", true);
      }
    } else if ($(e.target).data('target') == 'tambah-modal') {
      var target = $('#update-modal input')
      $(target[0]).focus()
    } else if ($(e.target).data('target') == 'pass-modal') {
      var target = $('#pass-modal input')
      $(target[1]).focus()
      $(target[0]).val($(e.target).data('id'))
    }
  })

  // pagination
  $(document).ready(() => {
    // select2
    $('#u-level').select2({
      width: '100%',
      placeholder: 'Pilih Jabatan..'
    })
    // pagination
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
    var r = confirm("Yakin Ingin Menghapus data Petugas ini?"),
      cur = $(location).attr('href');
    if (r) {
      $(location).attr('href', './post-petugas.php?del=' + id)
    }
  }

  // validation
  function validation(form) {
    if (form.nama.value == '') {
      alert("Anda belum mengisikan Nama!");
      form.nama.focus();
      return false;
    }
    if (form.username.value == '') {
      alert("Anda belum mengisikan username!");
      form.username.focus();
      return false;
    }
    if (form.password.value == '') {
      alert("Anda belum mengisikan Sandi!");
      form.password.focus();
      return false;
    }
    if (form.level.value == '') {
      alert("Anda belum mengisikan level!");
      form.level.focus();
      return false;
    }
    return true;
    form.defaultPrevented()
  }

  function validasi(form) {
    if (form.password_lama.value == '') {
      alert("Anda belum mengisikan Sandi Lama!");
      form.password_lama.focus();
      return false;
    }
    if (form.password_baru.value == '') {
      alert("Anda belum mengisikan Sandi Baru!");
      form.password_baru.focus();
      return false;
    }
    if (form.password_baru.value < 6) {
      alert("Sandi Minimal 6 Karakter!");
      form.password_baru.focus();
      return false;
    }
    if (form.password.value == '') {
      alert("Anda belum mengisikan Konfirmasi Sandi!");
      form.password.focus();
      return false;
    }
    if (form.password_baru.value != form.password.value) {
      alert("Sandi yang anda masukkan tidak Sama!");
      form.password.value = "";
      form.password.focus();
      return false;
    }
    return true;
    form.defaultPrevented();
  }

  function validationUpdate(form) {
    if (form.nama.value == '') {
      alert("Anda belum mengisikan Nama!");
      form.nama.focus();
      return false;
    }
    if (form.username.value == '') {
      alert("Anda belum mengisikan username!");
      form.username.focus();
      return false;
    }
    if (form.level.value == '') {
      alert("Anda belum mengisikan level!");
      form.level.focus();
      return false;
    }
    return true;
    form.defaultPrevented()
  }
</script>
<?php

$query = query("SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas");
$tahun = query("SELECT * FROM spp");
// var_dump($_SESSION['username']);
$strbulan = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>
<center>
  <div class="card col-md-10 col-xl-5">
    <div class="card-header">
      <h3 class="t-center">Transaksi Pembayaran SPP</h3>
    </div>
    <div class="card-body t-left">
      <form action="post-home.php" method="post" onsubmit="return validasi(this)">
        <select name="nama" id="nama_siswa" class="col input-select">
          <option value="">Nama</option>
          <?php foreach ($query as $key => $siswa) : ?>
            <option value="<?= $siswa['nisn']; ?>"><?= $siswa['nama'] . " - " . $siswa['nama_kelas'] . " " . $siswa['kopetensi_keahlian']; ?></option>
          <?php endforeach; ?>
        </select>
        <input type="date" id="tgl" name="tgl" placeholder="Tanggal Bayar" value="<?= date('Y-m-d', time()); ?>" class="input-form my-3" readonly>
        <select name="bulan[]" id="bulan" class="col input-select" multiple>
          <option value="">Bulan dibayar</option>
          <?php foreach ($bulan as $key => $b) : ?>
            <option value="<?= $strbulan[$key]; ?>"><?= $b; ?></option>
          <?php endforeach; ?>
        </select>
        <div class="mb-3"></div>
        <select name="id_tahun" id="id-spp" class="col input-select">
          <option value="">Tahun dibayar</option>
          <?php foreach ($tahun as $key => $t) : ?>
            <option data-nominal="<?= $t['nominal']; ?>" data-tahun="<?= $t['tahun']; ?>" value="<?= $t['id_spp']; ?>"><?= $t['tahun']; ?></option>
          <?php endforeach; ?>
        </select>
        <input type="hidden" name="tahun" id="tahun">
        <input type="number" readonly class="input-form mt-3" placeholder="Nominal Uang.." name="nominal" id="nominal">
        <input type="number" readonly class="input-form mt-3" placeholder="Total Bayar.." name="total" id="total">
        <input type="number" class="input-form my-3" placeholder="Nominal Uang yang dibayar.." name="uang" id="uang">
        <h4 id="kembalian" class="m-3">Kembalian Rp.0</h4>
        <div class="row m-2">
          <button type="submit" name="simpan" class="btn col">Bayar</button>
          <div class="col"></div>
          <button class="btn btn-red col" id="reset" type="reset">Reset</button>
        </div>
      </form>
    </div>
  </div>
</center>

<script>
  $('#id-spp').change((e) => {
    var val = $('#id-spp').val()
    if ($('#id-spp').find("option[value='" + val + "']").length) {
      var tar = $('#id-spp').find("option[value='" + val + "']")
      $('#nominal').val($(tar).data('nominal'))
      $('#tahun').val($(tar).data('tahun'))
    }
  })

  $('#reset').click((e) => {
    $('#bulan').val(null).trigger('change');
    $('#nama_siswa').val(null).trigger('change');
    $('#id-spp').val(null).trigger('change');
    $('#kembalian').text("Kembalian Rp." + 0)
  })

  $(document).change((e) => {
    var tot = $('#bulan').val().length * $('#nominal').val()
    console.log($('#bulan').val());
    $('#total').val(tot)
    tot = $('#uang').val() - $('#total').val()
    $('#kembalian').text("Kembalian Rp." + tot)
  })

  $('#uang').keyup((e) => {
    var tot = $(e.target).val() - $('#total').val()
    $('#kembalian').text("Kembalian Rp." + tot)
  })

  $(document).ready(() => {
    $('#nama_siswa').select2({
      width: '100%',
      placeholder: 'Nama..'
    })
    $('#id-spp').select2({
      width: '100%',
      placeholder: 'Tahun dibayar..'
    })
    $('#bulan').select2({
      width: '100%',
      placeholder: 'Bulan dibayar..'
    })
  })

  function validasi(form) {
    if (form.nama.value == '') {
      alert("Anda belum mengisikan Nama!");
      form.nama.focus()
      return false;
    }
    if (form.bulan.value == '') {
      alert("Anda belum mengisikan Bulan dibayar!");
      form.bulan.focus()
      return false;
    }
    if (form.id_tahun.value == '') {
      alert("Anda belum mengisikan Tahun dibayar!");
      form.id_tahun.focus()
      return false;
    }
    if (form.uang.value == '') {
      alert("Anda belum mengisikan Uang dibayar!");
      form.uang.focus()
      return false;
    }
    if (form.uang.value < $('#total').val()) {
      alert("Uang anda Kurang!");
      form.uang.focus()
      return false;
    }
    return true;
    form.preventDefault()
  }
</script>
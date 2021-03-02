<?php

$query = query("SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas");
$tahun = query("SELECT * FROM spp");
// var_dump($_SESSION['username']);
$strbulan = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
$Longbulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$kelas = query("SELECT * FROM kelas");
?>
<style>
  @media print {

    body * {
      visibility: hidden;
    }

    #print-area,
    #print-area * {
      visibility: visible;
    }

    #print-area {
      z-index: 100;
      position: absolute;
      left: 0;
      top: 0;
    }
  }
</style>
<center>
  <div class="card">
    <div class="card-header">
      <h3 class="t-center">Laporan Transaksi Pembayaran SPP</h3>
    </div>
    <div class="card-body t-left">
      <form action="" class="row mx-3" method="post" onsubmit="return validasi(this)">
        <select name="kelas" id="cari-kelas" class="input-select col-2 mx-2">
          <option value="">Kelas</option>
          <?php foreach ($kelas as $key => $k) : ?>
            <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas'] . " " . $k['kopetensi_keahlian']; ?></option>
          <?php endforeach; ?>
        </select>
        <select name="bulan" id="bulan" class="col-3 input-select">
          <option value="">Bulan dibayar</option>
          <?php foreach ($Longbulan as $key => $b) : ?>
            <option value="<?= $strbulan[$key]; ?>"><?= $b; ?></option>
          <?php endforeach; ?>
        </select>
        <select name="id_tahun" id="id-spp" class="col-2 mx-4 input-select">
          <option value="">Tahun dibayar</option>
          <?php foreach ($tahun as $key => $t) : ?>
            <option data-nominal="<?= $t['nominal']; ?>" data-tahun="<?= $t['tahun']; ?>" value="<?= $t['id_spp']; ?>"><?= $t['tahun']; ?></option>
          <?php endforeach; ?>
        </select>
        <button name="lapor" type="submit" class="btn btn-dark col-2">Lihat</button>
        <button onclick="window.print()" class="btn col-2 ml-4">Cetak</button>
      </form>
    </div>
    <div class="card-footer p-3">
      <?php
      if (isset($_POST['lapor'])) :
        $bulan = $_POST['bulan'];
        $id_tahun = $_POST['id_tahun'];
        $kelas = $_POST['kelas'];
        $nama = query("SELECT * FROM siswa as a JOIN kelas as b ON a.id_kelas = b.id_kelas WHERE a.id_kelas = '$kelas'");
        // var_dump($nama);
      ?>
        <div class="card p-5" id="print-area">
          <div class="m-4">
            <h3>Laporan Pembayaran SPP Kelas <?= $nama[0]['nama_kelas'] . " " . $nama[0]['kopetensi_keahlian']; ?></h3>
          </div>
          <table class="table table-responsive">
            <thead>
              <tr class="table-blue">
                <th>No</th>
                <th>Nama</th>
                <th><?= $Longbulan[(int)$bulan]; ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($nama as $key => $isi) : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $isi['nama']; ?></td>
                  <td class="col-2 t-center">
                    <?php
                    $n = $isi['nisn'];
                    $cek = query("SELECT * FROM pembayaran WHERE nisn = '$n' AND bulan_dibayar = '$bulan'");
                    if (count($cek) <= 0) {
                      echo "Belum Bayar";
                    } else {
                      echo "Sudah Bayar";
                    }
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php
      endif;
      ?>
    </div>
  </div>
</center>

<script>
  function validasi(form) {
    if (form.kelas.value == '') {
      alert("Anda belum mengisikan Kelas!");
      form.kelas.focus();
      return false;
    }
    if (form.bulan.value == '') {
      alert("Anda belum mengisikan Bulan!");
      form.bulan.focus();
      return false;
    }
    if (form.id_tahun.value == '') {
      alert("Anda belum mengisikan Tahun!");
      form.id_tahun.focus();
      return false;
    }
    return true;
    form.defaultPrevented()
  }
</script>
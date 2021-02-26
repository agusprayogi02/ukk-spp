<?php

$query = query("SELECT * FROM kelas");

?>

<div class="card">
  <div class="card-header">
    <h3 class="t-center">Kelola Data Kelas</h4>
  </div>
  <div class="card-header" style="background-color: #fff;">
    <div class="row">
      <form class="col" action="index.php?p=kelas" method="get">
        <input type="hidden" name="p" value="kelas">
        <input style="width: 20rem; " placeholder="Cari Kelas.." type="text" name="cari" class="input-form">
        <button class="btn ml-2" type="submit">
          Cari
        </button>
      </form>
      <button id="btn-modal" class="btn right mx-2 col-1">
        Tambah
      </button>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-responsive">
      <thead>
        <tr class="table-blue">
          <th>ID</th>
          <th>Kelas</th>
          <th>Jurusan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($query as $isi => $key) : ?>
          <td><?= $isi['kelas_id']; ?></td>
          <td><?= $isi['nama_kelas']; ?></td>
          <td><?= $isi['kompetensi_keahlian']; ?></td>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal" id="tambah-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#btn-modal').click(() => {
    $('#tambah-modal').css('display', 'block')
  })

  $('.close').click(() => {
    $('#tambah-modal').css('display', 'none')
  })
</script>
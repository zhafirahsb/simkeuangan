<?php 
session_start();
require('../../url.php'); 
require('../../proses/bos.php'); 
require('../_template/head.php'); 
require('../_template/header.php');
require('../_template/sidebar.php');
?>
<div class="page-wrapper">
  <!-- Container fluid  -->
  <div class="container-fluid">
        <div class="row page-titles">
          <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Realisasi</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?= $url; ?>">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">BOS</li>
              <li class="breadcrumb-item active">Realisasi Dana BOS</li>
              <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
          </div>
        </div>
        <div class="card">
          <div class="card-block">
            <h4><u>Form Tambah Data Pengeluaran BOS</u></h4>
            <form class="mt-5" action="" method="POST">

              <input type="hidden" name="realisasi" value="<?= @$id_realisasi; ?>">
              <input type="hidden" name="detail" value="<?= @$detail_realisasi; ?>">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Tahun Ajaran</label>
                <div class="col-sm-8">
                  <select name="tahun" class="form-control" required>
                    <?php for ($i = 2017; $i <= date('Y'); $i++) {
                    ?>
                      <option value="<?= $i ?>" <?= @$realisasi['tahun_ajaran'] == $i ? 'selected' : ''; ?>><?= $i; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Program Standar Pendidikan</label>
                <div class="col-sm-8">
                  <select name="standar" class="form-control">
                    <?php foreach ($standar as $st) { ?>
                      <option value="<?= $st['idsnp'] ?>" <?= @$realisasi['idsnp'] == $st['idsnp'] ? 'selected' : ''; ?>><?= $st['nama_program']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Komponen Penggunaan Dana BOS</label>
                <div class="col-sm-8">
                  <select name="komponen" class="form-control">
                    <?php foreach ($sub_program as $sp) { ?>
                      <option value="<?= $sp['id_bos_realisasi_komponen'] ?>" <?= @$realisasi['idsnp'] == $sp['id_bos_realisasi_komponen'] ? 'selected' : ''; ?>><?= $sp['nama_program']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Tanggal</label>
                <div class="col-sm-8">
                  <input type="date" name="tanggal" class="form-control" value="<?= @$detail['tanggal']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">No. Kode</label>
                <div class="col-sm-8">
                  <input type="text" name="kode" class="form-control" value="<?= @$detail['no_kode']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">No. Bukti</label>
                <div class="col-sm-8">
                  <input type="text" name="bukti" class="form-control" value="<?= @$detail['no_bukti']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Uraian</label>
                <div class="col-sm-8">
                  <textarea name="uraian" class="form-control" cols="30" rows="10"><?= @$detail['uraian']; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Jumlah (Rp)</label>
                <div class="col-sm-8">
                  <input type="number" name="jumlah" class="form-control" value="<?= @$detail['jumlah']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                  <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                  <a href="<?= $url; ?>tata_usaha/realisasi/" class="btn btn-default">Batal</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  <!-- End Container fluid  -->
  <!-- footer -->
  <?php require('../_template/footer.php') ?>
</div>
<?php require('../_template/jquery.php') ?>

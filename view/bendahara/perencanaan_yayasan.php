<?php 
session_start();
require('../../url.php'); 
require('../../proses/yayasan.php'); 
require('../../proses/koneksi.php'); 
require('../_template/head.php'); 
require('../_template/header.php');
require('../_template/sidebar.php');
$tahun=2017;

if (isset($_POST['submit'])) {
  $tahun=$_POST['tahun'];
}
?>
<div class="page-wrapper">
  <!-- Container fluid  -->
  <div class="container-fluid">
    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
      <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Perencanaan Dana BOS</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $url; ?>">Home</a></li>
          <li class="breadcrumb-item active">Perencanaan BOS</li>
        </ol>
      </div>
    </div>
    <!-- Start Page Content -->
    <div class="card">
          <div class="card-block">
            <h4><u>Perencanaan Dana Yayasan (Pendapatan)</u></h4>
            <table class="table table-bordered" >
              <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Tahun</th>
                  <th>Keterangan</th>
                  <th colspan="7">Uraian</th>
                  <th>Jumlah</th>
                  <th>aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $pendapatan = get_rencana_pendapatan_yys();
                $no = 0;
                foreach ($pendapatan as $p) {
                ?>
                  <tr>
                    <td><?= $no + 1; ?></td>
                    <td><?= $p['tahun']; ?></td>
                    <td><?= $p['keterangan']; ?></td>
                    <td><?= $p['jumlah_siswa'] > 0 ? $p['jumlah_siswa'] : ''; ?></td>
                    <td><?= $p['jumlah_siswa'] > 0 ? 'sis' : ''; ?></td>
                    <td><?= $p['jumlah_siswa'] > 0 ? 'x' : ''; ?></td>
                    <td><?= $p['jumlah_siswa'] > 0 ? '12' : ''; ?></td>
                    <td><?= $p['jumlah_siswa'] > 0 ? 'x' : ''; ?></td>
                    <td><?= $p['jumlah_siswa'] > 0 ? 'bln' : ''; ?></td>
                    <td>Rp. <?= number_format($p['jumlah_iuran'], 0, ',', '.'); ?></td>
                    <td>Rp. <?= number_format($p['jumlah_siswa'] > 0 ? $p['jumlah_siswa'] * $p['jumlah_iuran'] * 12 : $p['jumlah_iuran'], 0, ',', '.'); ?></td>
                    <!-- <td>Rp. <?= number_format($p['jumlah_iuran'], 0, ',', '.'); ?></td> -->
                    <td>ubah | hapus</td>
                  </tr>
                <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
          <form action="" method="post" class="align-right">
                  <select name="tahun" id="tahun">
                    <?php
                    for ($i=2017; $i <= date('Y') ; $i++) { ?>
                      <option <?=$selected = ($tahun==$i) ? 'selected' : '' ;?> value='<?=$i?>'><?=$i?></option>";
                    <?php }
                    ?>
                  </select>
                  <input type="submit" name="submit">
                </form>
            <div class="card">
              <div class="card-block">
                <a href="perencanaan_yayasan_tambah.php?tahun=<?=$tahun?>" class="btn btn-primary mb-5">Tambah Data</a> 
                <table class="table table-bordered mt-3" id="example">
                  <thead>
                    <tr class="text-center">
                      <th>Kode</th>
                      <th>Uraian</th>
                      <th>Satuan</th>
                      <th>Volume</th>
                      <th>Jumlah</th>
                      <th>Total</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
                    $rencana = get_detail_rencana_pengeluaran(['tahun'=>$tahun]);
                    if ($rencana) {
                      
                    
                    $jenis_biaya = get_jenis_biaya();
                    $i = 1;
                    foreach($jenis_biaya as $jb) {
                      
                    ?>
                    <tr>
                      <th><?=$i?></th>
                      <th><?=$jb['jenis_biaya']?></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>

                    <?php 
                      if ($jb['jenis_biaya']=='Biaya Bantuan') {
                        $uraian = get_uraian_rencana(['jenis_biaya'=>'Biaya Bantuan','tahun'=>$tahun]);
                        $j=1;
                        foreach($uraian as $u){
                        ?>
                          <tr>
                            <th><?=$i.' . '.$j?></th>
                            <td><?=$u['uraian']?></td>
                            <td><?=$u['nilai_satuan'].' '.$u['satuan']?></td>
                            <td><?=$u['nilai_volume'].' ' .$u['volume']?></td>
                            <td><?='Rp '.$u['jumlah']?></td>
                            <td><?='Rp '.$u['total']?></td>
                            <td><a href="<?= $url; ?>view/bendahara/perencanaan_yayasan_ubah.php?id=<?=$u['id_yayasan_detail_rencana_pengeluaran']?>" class="btn btn-warning">ubah</a>
                            <a href="<?= $url; ?>view/bendahara/perencanaan_yayasan_hapus.php?id=<?=$u['id_yayasan_detail_rencana_pengeluaran']?>" class="btn btn-danger">Hapus</a></td>
                          
                          </tr>
                        <?php
                        $j++;
                        }
                      } else {
                        $sub_jenis_biaya = get_sub_jenis_biaya(['jenis_biaya'=>$jb['jenis_biaya']]);
                        $j = 1;
                        foreach ($sub_jenis_biaya as $sjb) {
                          
                          ?>
                            <tr>
                              <th><?=$i.' . '.$j?></th>
                              <th><?=$sjb['sub_jenis_biaya']?></th>
                              <th></th>
                              <th></th>
                              <th></th>                           
                              <th></th>
                              <th></th>
                            </tr>
                          <?php
                          if ($sjb['id_yayasan_rencana_pengeluaran']>2) {
                            $uraian = get_uraian_rencana(['sub_jenis_biaya'=>$sjb['sub_jenis_biaya'],'tahun'=>$tahun]);
                            $k=1;
                            foreach($uraian as $u){
                              ?>
                                <tr>
                                  <th><?=$i.' . '.$j.' . '.$k?></th>
                                  <td><?=$k.'. '.$u['uraian']?></td>
                                  <td><?=$u['nilai_satuan'].' '.$u['satuan']?></td>
                                  <td><?=$u['nilai_volume'].' ' .$u['volume']?></td>
                                  <td><?='Rp '.$u['jumlah']?></td>
                                  <td><?='Rp '.$u['total']?></td>
                                  <td><a href="<?= $url; ?>view/bendahara/perencanaan_yayasan_ubah.php?id=<?=$u['id_yayasan_detail_rencana_pengeluaran']?>" class="btn btn-warning">ubah</a>
                                  <a href="<?= $url; ?>view/bendahara/perencanaan_yayasan_hapus.php?id=<?=$u['id_yayasan_detail_rencana_pengeluaran']?>" class="btn btn-danger">Hapus</a></td>
                                
                                </tr>
                              <?php
                              $k++;
                            }
                          } else {
                            $masa_kerja = get_masa_kerja();
                            $k = 1;
                            foreach ($masa_kerja as $mk) {
                                $data_uraian = ['sub_jenis_biaya'=>$sjb['sub_jenis_biaya'],'tahun'=>$tahun,'masa_kerja'=>$mk];
                                ?>
                                <tr>
                                  <th><?=$i.' . '.$j.' . '.$k?></th>
                                  <th><?=$mk?></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>                           
                                  <th></th>
                                  <th></th>
                                </tr>
                              <?php
                            $uraian = get_uraian_rencana($data_uraian);
                            $l = 1;
                            foreach ($uraian as $u) {
                            // var_dump($u);
                              
                              ?>
                                <tr>
                                  <?php  if ($sjb['sub_jenis_biaya']=="") {
                                    echo "<td>$i . $j</td>";
                                  } else {?>
    
                                  <td><?= $i .' . '. $j .' . '. $k.' . '. $l?></td>
                                  <?php }  ?>
                                  <td><?=$l.'. '.$u['uraian']?></td>
                                  <td><?=$u['nilai_satuan'].' '.$u['satuan']?></td>
                                  <td><?=$u['nilai_volume'].' ' .$u['volume']?></td>
                                  <td><?='Rp '.$u['jumlah']?></td>
                                  <td><?='Rp '.$u['total']?></td>
                                  <td><a href="<?= $url; ?>view/bendahara/perencanaan_yayasan_ubah.php?id=<?=$u['id_yayasan_detail_rencana_pengeluaran']?>" class="btn btn-warning">ubah</a>
                                  <a href="<?= $url; ?>view/bendahara/perencanaan_yayasan_hapus.php?id=<?=$u['id_yayasan_detail_rencana_pengeluaran']?>" class="btn btn-danger">Hapus</a></td>
                                </tr>
                            <?php
                              
                              $l++;
                              }
                            $k++;
                            }
                          }
                          
                        $j++;
                        } 
                      }

                      
                    $i++; 
                    } 
                  }else{?>
                    <tr class="text-center">
                      <td colspan="7">Belum Ada Data</td>
                    </tr>
                  <?php
                  }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    <!-- End PAge Content -->
  </div>
  <!-- End Container fluid  -->
  <!-- footer -->
  <?php require('../_template/footer.php') ?>
</div>
<?php require('../_template/jquery.php') ?>


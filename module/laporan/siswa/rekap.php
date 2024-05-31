<?php
$acuan = $_GET['idj'];
$sqlacuan = mysqli_query($conn, "select * from jadwal where idj='$acuan'");
$rss = mysqli_fetch_array($sqlacuan);
$sqlrss = mysqli_query($conn, "select * from siswa where nis='$uidi'");
$siswa = mysqli_fetch_array($sqlrss);
$sqlmp = mysqli_query($conn, "select * from mata_pelajaran where idm='$rss[idm]'");
$nama_mp = mysqli_fetch_array($sqlmp);
$sqlidh = mysqli_query($conn, "select * from hari where idh='$rss[idh]'");
$nama_hari = mysqli_fetch_array($sqlidh);

$pecah = explode(" ", $tgl_lengkap);
$satu = $pecah[0];
$dua = $pecah[1];
$tahun1 = $pecah[2];

if ($dua == "Juli" || $dua == "Agustus" || $dua == "September" || $dua == "Oktober" || $dua == "November" || $dua == "Desember") {
  $tahun2 = $tahun1 + 1;
} else {
  $tahun2 = $tahun1 - 1;
}
?>
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header mt-4">
      <strong>
        <?php
        if ($dua == "Juli" || $dua == "Agustus" || $dua == "September" || $dua == "Oktober" || $dua == "November" || $dua == "Desember") {
          echo "Tahun Ajaran $tahun1 - $tahun2 ($nama_mp[nama_mp])";
        } else {
          echo "Tahun Ajaran $tahun2 - $tahun1 ($nama_mp[nama_mp])";
        }
        ?>
      </strong>
    </h3>
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-primary">
      <div class="panel-heading mb-2">
        Data Absensi Siswa
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table-responsive">
          <?php
          $sqlabsen = mysqli_query($conn, "select DISTINCT tgl from absen where idj='$acuan' AND ids='$siswa[ids]'");
          ?>
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <td colspan="2" class="text-center info"><?php echo "<b>$nama_hari[hari], $rss[jam_mulai] - $rss[jam_selesai]</b>"; ?></td>
            </tr>
            <tr>
              <td class="success text-center" rowspan="2"><b>Tanggal (TGL/BLN)</b></td>
              <td class="text-center success"><b>Siswa</b></td>
            </tr>
            <tr>
              <?php
              $siswanya = mysqli_fetch_array($sqlrss);
              ?>
              <td class="text-center warning"><?php echo "<b>$usre | Kelas : $rs[nama]</b>"; ?></td>
            </tr>
            <?php
            while ($tglnya = mysqli_fetch_array($sqlabsen)) {
              $pecah = explode("-", $tglnya['tgl']);
              $satu = $pecah[0];
              $dua = $pecah[1];
              $tiga = $pecah[2];
            ?>
              <tr>
                <td class="text-center warning"><?php echo "<b>$tiga/$dua</b>"; ?></td>
                <?php
                $sqlabsen2 = mysqli_query($conn, "select ket from absen where ids='$siswa[ids]' AND idj='$acuan' AND tgl='$tglnya[tgl]'");
                while ($ketnya = mysqli_fetch_array($sqlabsen2)) {
                ?>
                  <td class="text-center"><?php echo $ketnya['ket']; ?></td>
                <?php } ?>
              </tr>
            <?php } ?>
          </table>

        </div>


        <!-- /.table-responsive -->
        <div class="well">
          <h4>Keterangan Absensi</h4>
          <p>A = Tidak Masuk Tanpa Keterangan</p>
          <p>I = Tidak Masuk Ada Surat Ijin Atau Pemberitahuan</p>
          <p>S = Tidak Masuk Ada Surat Dokter Atau Pemberitahuan</p>
          <p>M = Hadir</p>
        </div>
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

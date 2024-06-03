<?php
session_start();

if (!empty($_SESSION['nama'])) {
  $uidi = $_SESSION['idu'];
  $usre = $_SESSION['nama'];
  $level = $_SESSION['level'];
  $klss = $_SESSION['idk'];
  $ortu = $_SESSION['ortu'];
  $idd = $_SESSION['id'];

  include "../../../config/conn.php";
  include "../../../config/fungsi.php";
  require_once("../../../vendor/autoload.php");

  $filename = "Laporan_Absensi_Kelas.pdf";
  $content = ob_get_clean();
  $acuan = $_POST['idj'];
  $tgl_lengkap = $_POST['tgl_lengkap'];
  $sqlacuan = mysqli_query($conn, "select * from jadwal where idj='$acuan'");
  $rss = mysqli_fetch_array($sqlacuan);
  $sqlkss = mysqli_query($conn, "select * from kelas where idk='$rss[idk]'");
  $kss = mysqli_fetch_array($sqlkss);
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
    $tahun_ajaran = "Tahun Ajaran $tahun1 - $tahun2";
  } else {
    $tahun2 = $tahun1 - 1;
    $tahun_ajaran = "Tahun Ajaran $tahun2 - $tahun1";
  }

  $sqlabsen = mysqli_query($conn, "select DISTINCT tgl from absen where idj='$acuan'");
  $jumlahtanggal = mysqli_num_rows($sqlabsen);
  $jumlahkolom = $jumlahtanggal + 1;

  $content = "<h3>Laporan Data Absensi Kelas $kss[nama] | $nama_mp[nama_mp]</h3>

				    <p><b>$tahun_ajaran</b><br>$nama_hari[hari], $rss[jam_mulai] - $rss[jam_selesai]</p>
				    <table cellpadding=0 cellspacing=0>
              <tr>
                <td align='center' style='border: 1px solid #000; padding: 5px; font-size: 11.5px; background-color:#d0e9c6;' rowspan=2><b>Siswa</b></td>
                <td align='center' style='border: 1px solid #000; padding: 5px; font-size: 11.5px; background-color:#d0e9c6;' colspan='$jumlahtanggal'><b>Tanggal (TGL/BLN)</b></td>
              </tr>
              <tr>
            ";

  while ($tglnya = mysqli_fetch_array($sqlabsen)) {
    $pecah = explode("-", $tglnya['tgl']);
    $satu = $pecah[0];
    $dua = $pecah[1];
    $tiga = $pecah[2];
    $content .= "<td align='center' style='border: 1px solid #000; padding: 5px; font-size: 11.5px; background-color:#faf2cc;'><b>$tiga/$dua</b></td>";
  }
  $content .= "</tr>";
  $sqlrss = mysqli_query($conn, "select * from siswa where idk='$rss[idk]'");
  while ($siswanya = mysqli_fetch_array($sqlrss)) {
    $content .= "<tr>
              <td align='center' style='border: 1px solid #000; padding: 5px; font-size: 11.5px; background-color:#faf2cc;'>$siswanya[nama]</td>";

    $sqlabsen2 = mysqli_query($conn, "select ket from absen where ids='$siswanya[ids]' AND idj='$acuan'");
    while ($ketnya = mysqli_fetch_array($sqlabsen2)) {
      $content .= "<td align='center' style='border: 1px solid #000; padding: 5px; font-size: 11.5px;'>$ketnya[ket]</td>";
    }
    $content .= "</tr>";
  }
  $content .= "</table>
              <br>
              <br>
              <b>Keterangan Absensi</b>
              <p>A = Tidak Masuk Tanpa Keterangan<br>
              I = Tidak Masuk Ada Surat Ijin Atau Pemberitahuan<br>
              S = Tidak Masuk Ada Surat Dokter Atau Pemberitahuan<br>
              M = Hadir</p>
            ";

  // conversion HTML => PDF
  // try {
  //   $html2pdf = new HTML2PDF('P', 'A4', 'fr', false, 'ISO-8859-15', array(10, 10, 10, 10)); //setting ukuran kertas dan margin pada dokumen anda
  //   // $html2pdf->setModeDebug();
  //   $html2pdf->setDefaultFont('Arial');
  //   $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  //   $html2pdf->Output($filename);
  // } catch (HTML2PDF_exception $e) {
  //   echo $e;
  // }
  try {
    ob_start();
    // include dirname(__FILE__).'/res/example00.php';
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->output('rekap.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
?>

<?php } else {
  echo "<center><h2>Anda Harus Login Terlebih Dahulu</h2>
    <a href=index.php><b>Klik ini untuk Login</b></a></center>";
}
?>

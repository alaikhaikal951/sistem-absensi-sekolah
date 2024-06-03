<?php
session_start();
if (!empty($_SESSION['nama'])) {
    $uidi = $_SESSION['idu'];
    $usre = $_SESSION['nama'];
    $level = $_SESSION['level'];
    $klss = $_SESSION['idk'];
    $ortu = $_SESSION['ortu'];
    $idd = $_SESSION['id'];

    include "config/conn.php";
    include "config/fungsi.php";
?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>SISTEM ABSENSI SISWA</title>

        <!-- Core CSS - Include with every page -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">

        <!-- Page-Level Plugin CSS - Tables -->
        <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- SB Admin CSS - Include with every page -->
        <link href="css/sb-admin.css" rel="stylesheet">
        <script type="text/javascript">
            var detik = <?php echo date('s'); ?>;
            var menit = <?php echo date('i'); ?>;
            var jam = <?php echo date('H'); ?>;

            function clock() {
                if (detik != 0 && detik % 60 == 0) {
                    menit++;
                    detik = 0;
                }
                second = detik;

                if (menit != 0 && menit % 60 == 0) {
                    jam++;
                    menit = 0;
                }
                minute = menit;

                if (jam != 0 && jam % 24 == 0) {
                    jam = 0;
                }
                hour = jam;

                if (detik < 10) {
                    second = '0' + detik;
                }
                if (menit < 10) {
                    minute = '0' + menit;
                }
                if (jam < 10) {
                    hour = '0' + jam;
                }
                waktu = hour + ':' + minute + ':' + second;

                document.getElementById("clock").innerHTML = waktu;
                detik++;
            }
            setInterval(clock, 1000);
        </script>
        <style media="screen">
            .labelol {
                padding: 0;
                margin: 0;
            }
        </style>
    </head>

    <body>
        <!-- test nav -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="d-flex navbar-brand align-items-center">
                <img src="./asset/logo.png" alt="" class="mr-3" style="width: 3rem;">
                <a class="navbar-brand" href="media.php?module=home">SISTEM ABSENSI SISWA</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <?php
                            if ($level == "admin") {
                                echo "Admin : $usre";
                            } elseif ($level == "guru") {
                                echo "Guru : $usre";
                            } else {
                                echo "Siswa : $usre";
                            }
                            ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" href="#">
                            <?php
                            if ($level == "admin" or $level == "guru") {
                                $sqla = mysqli_query($conn, "select * from sekolah where id='$idd'");
                                $rsa = mysqli_fetch_array($sqla);
                                echo "$rsa[nama]";
                            } else {
                                $sql = mysqli_query($conn, "select * from kelas where idk='$klss'");
                                $rs = mysqli_fetch_array($sql);
                                $sqla = mysqli_query($conn, "select * from sekolah where id='$idd'");
                                $rsa = mysqli_fetch_array($sqla);
                                echo "Kelas: $rs[nama] | $rsa[nama]";
                            }
                            ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" href="#">
                            <?php
                            $tgl_lengkap = tgl_ina(date("Y-m-d"));
                            if ($level == "guru") {
                                $hhari = hari_ina(date("l"));
                                echo "<b>$hhari, $tgl_lengkap</b>";
                                echo " | <label class='labelol' id='clock'></label>";
                            } else {
                                echo "$tgl_lengkap";
                            }
                            ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link logout-btn" href="logout.php">
                            <?php echo "Logout"; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="d-flex">
            <!-- side nav -->
            <div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
                <ul class="list-unstyled ps-0">

                    <!-- level admin -->
                    <?php if ($level == 'admin') { ?>

                        <li class="mb-2">
                            <button class="btn btn-light rounded collapsed w-100" data-toggle="collapse" data-target="#home-collapse" aria-expanded="false">
                                Data Siswa
                            </button>
                            <div class="collapse mt-2 ml-3" id="home-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="media.php?module=input_siswa&act=input" class="link-dark rounded mb-3">Input Data</a></li>
                                    <li><a href="media.php?module=tampil" class="link-dark rounded">Lihat Data</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-2">
                            <button class="btn btn-light rounded collapsed w-100" data-toggle="collapse" data-target="#data-guru-collapse" aria-expanded="false">
                                Data Guru
                            </button>
                            <div class="collapse mt-2 ml-3" id="data-guru-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="media.php?module=input_guru&act=input" class="link-dark rounded mb-3">Input Data</a></li>
                                    <li><a href="media.php?module=guru" class="link-dark rounded">Lihat Data</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-2">
                            <button class="btn btn-light rounded collapsed w-100" data-toggle="collapse" data-target="#data-kelas-collapse" aria-expanded="false">
                                Data Kelas
                            </button>
                            <div class="collapse mt-2 ml-3" id="data-kelas-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="media.php?module=input_kelas&act=input" class="link-dark rounded mb-3">Input Data</a></li>
                                    <li><a href="media.php?module=kelas" class="link-dark rounded">Lihat Data</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-2">
                            <button class="btn btn-light rounded collapsed w-100" data-toggle="collapse" data-target="#data-pelajaran-collapse" aria-expanded="false">
                                Data Mata Pelajaran
                            </button>
                            <div class="collapse mt-2 ml-3" id="data-pelajaran-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="media.php?module=input_pelajaran&act=input" class="link-dark rounded mb-3">Input Data</a></li>
                                    <li><a href="media.php?module=mata_pelajaran" class="link-dark rounded">Lihat Data</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-2">
                            <button class="btn btn-light rounded collapsed w-100" data-toggle="collapse" data-target="#data-jadwal-collapse" aria-expanded="false">
                                Data Jadwal
                            </button>
                            <div class="collapse mt-2 ml-3" id="data-jadwal-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="media.php?module=input_jadwal&act=input" class="link-dark rounded mb-3">Input Data</a></li>
                                    <li><a href="media.php?module=senin" class="link-dark rounded">Lihat Data</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-2">
                            <button class="btn btn-light rounded w-100" aria-expanded="false">
                                <a href="media.php?module=sekolah" style="color: #212529;">Data Sekolah</a>
                            </button>
                        </li>

                    <?php } ?>

                    <!-- level siswa -->
                    <?php if ($level == 'siswa') { ?>

                        <li class="mb-2">
                            <button class="btn btn-light rounded w-100" aria-expanded="false">
                                <a href="media.php?module=siswa_senin" style="color: #212529;">Jadwal Belajar</a>
                            </button>
                        </li>
                        <li class="mb-2">
                            <button class="btn btn-light rounded w-100" aria-expanded="false">
                                <a href="media.php?module=siswa_det" style="color: #212529;">Data Siswa</a>
                            </button>
                        </li>

                    <?php } ?>

                    <!-- level guru -->
                    <?php if ($level == 'guru') { ?>

                        <li class="mb-2">
                            <button class="btn btn-light rounded w-100" aria-expanded="false">
                                <a href="media.php?module=jadwal_mengajar" style="color: #212529;">Jadwal Mengajar</a>
                            </button>
                        </li>
                        <li class="mb-2">
                            <button class="btn btn-light rounded w-100" aria-expanded="false">
                                <a href="media.php?module=guru_det" style="color: #212529;">Data Guru</a>
                            </button>
                        </li>

                    <?php } ?>

                </ul>
            </div>

            <!-- page-wrapper -->
            <div id="page-wrapper">
                <?php include "content.php";  ?>
            </div>
        </div>

        <!-- Core Scripts - Include with every page -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <!-- Page-Level Plugin Scripts - Tables -->
        <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

        <!-- SB Admin Scripts - Include with every page -->
        <script src="js/sb-admin.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').dataTable();
            });
        </script>

    </body>

    </html>

<?php } else {
    echo "<center><h2>Anda Harus Login Terlebih Dahulu</h2>
    <a href=index.php><b>Klik ini untuk Login</b></a></center>";
}
?>
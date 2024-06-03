<div class="row">
    <div class="col-lg-12 mt-4">
        <h3 class="page-header"><strong>Input Data Absensi</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading mb-2">
                <?php $idj = $_GET['idj'];
                $dataquery = mysqli_query($conn, "select * from jadwal where idj='$idj'");
                $arrayj = mysqli_fetch_array($dataquery);
                $datamp = mysqli_query($conn, "select * from mata_pelajaran where idm='$arrayj[idm]'");
                $arraymp = mysqli_fetch_array($datamp);

                echo "Data Siswa";
                $sqlj = mysqli_query($conn, "select * from kelas where idk='$arrayj[idk]'");
                $rsj = mysqli_fetch_array($sqlj);

                echo "Kelas $rsj[nama] | $arraymp[nama_mp]";
                ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <form method="post" role="form" action="././module/simpan.php?act=input_absen&idj=<?php echo $idj ?>&tanggal=<?php echo date("Y-m-d") ?>&kelas=<?php echo $arrayj['idk'] ?>">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">NIS</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Keterangan</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tg = date("Y-m-d");
                                $sqljk = mysqli_query($conn, "select * from siswa where idk='$arrayj[idk]'");
                                while ($rs = mysqli_fetch_array($sqljk)) {
                                    $sqla = mysqli_query($conn, "select * from absen where ids='$rs[ids]' and tgl='$tg' and idj='$idj'");
                                    $rsa = mysqli_fetch_array($sqla);
                                    $conk = mysqli_num_rows($sqla);
                                    $sqlw = mysqli_query($conn, "select * from kelas where idk='$rs[idk]'");
                                    $rsw = mysqli_fetch_array($sqlw);
                                    $sqlb = mysqli_query($conn, "select * from sekolah where id='$rsw[id]'");
                                    $rsb = mysqli_fetch_array($sqlb);

                                ?> <tr class="odd gradeX">
                                        <td><label style="font-weight:normal;"><?php echo "$rs[nis]";  ?></label></td>
                                        <td><label style="font-weight:normal;"><?php echo "$rs[nama]";  ?></label></td>

                                        <td class="text-center">
                                            <div class="form-group">

                                                <?php
                                                if ($conk == 0) {
                                                ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="A">A
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="I">I
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="S">S
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="M">M
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="N" checked>N
                                                    </label>

                                                <?php } elseif ($rsa['ket'] == "A") {
                                                ?>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="A" checked>A
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="I">I
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="S">S
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="M">M
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="N">N
                                                    </label>

                                                <?php } elseif ($rsa['ket'] == "I") {
                                                ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="A">A
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="I" checked>I
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="S">S
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="M">M
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="N">N
                                                    </label>


                                                <?php } elseif ($rsa['ket'] == "S") {
                                                ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="A">A
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="I">I
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="S" checked>S
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="M">M
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="N">N
                                                    </label>


                                                <?php } elseif ($rsa['ket'] == "M") {
                                                ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="A">A
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="I">I
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="S">S
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="M" checked>M
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="N">N
                                                    </label>


                                                <?php } elseif ($rsa['ket'] == "N") {
                                                ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="A">A
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="I">I
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="S">S
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="M">M
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?php echo $rs['ids'] ?>" value="N" checked>N
                                                    </label>

                                                <?php } ?>

                                            </div>

                                        </td>

                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success">Simpan Data Absen</button>

                    </form>
                </div>
                <!-- /.table-responsive -->
                <br>
                <div class="well">
                    <h4>Keterangan Absensi</h4>
                    <p>A = Tidak Masuk Tanpa Keterangan</p>
                    <p>I = Tidak Masuk Ada Surat Ijin Atau Pemberitahuan</p>
                    <p>S = Tidak Masuk Ada Surat Dokter Atau Pemberitahuan</p>
                    <p>M = Hadir</p>
                    <p>N = Belum di Absen</p>

                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
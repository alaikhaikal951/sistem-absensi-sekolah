            <div class="row">
                <div class="col-lg-12 my-4">
                    <h3 class="page-header"><strong>Data Jadwal</strong></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="media.php?module=senin">Senin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="media.php?module=selasa">Selasa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="media.php?module=rabu">Rabu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="media.php?module=kamis">Kamis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="media.php?module=jumat">Jum'at</a>
                            </li>
                        </ul>
                        <br>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Hari</th>
                                            <th class="text-center">Jam</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Guru</th>
                                            <th class="text-center">Mata Pelajaran</th>
                                            <th class="text-center">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = mysqli_query($conn, "select jadwal.idj , hari.hari , kelas.nama AS nama_kelas, guru.nama AS nama_guru, mata_pelajaran.nama_mp
, jadwal.jam_selesai, jadwal.jam_mulai from jadwal,hari,kelas,guru,mata_pelajaran WHERE jadwal.idh=hari.idh AND jadwal.idk=kelas.idk AND jadwal.idg=guru.idg AND jadwal.idm=mata_pelajaran.idm AND jadwal.idh=3
ORDER BY jadwal.jam_mulai");
                                        while ($rs = mysqli_fetch_array($sql)) {

                                        ?> <tr class="odd gradeX">
                                                <td><?php echo "$no";  ?></td>
                                                <td><?php echo "$rs[hari]";  ?></td>
                                                <td style="width: 108px;"><?php
                                                                            $jam_mulai = substr("$rs[jam_mulai]", 0, 5);
                                                                            $jam_selesai = substr("$rs[jam_selesai]", 0, 5);
                                                                            echo "$jam_mulai - $jam_selesai";  ?></td>
                                                <td><?php echo "$rs[nama_kelas]";  ?></td>
                                                <td style="width: 120px;"><?php echo "$rs[nama_guru]";  ?></td>
                                                <td><?php echo "$rs[nama_mp]";  ?></td>
                                                <td class="text-center" style="width: 19%;"><a href="./././media.php?module=input_jadwal&act=edit_jadwal&idj=<?php echo $rs['idj'] ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a>
                                                    <a href="././module/simpan.php?act=hapus_jadwal&idj=<?php echo $rs['idj'] ?>"><button type="button" class="btn btn-outline-danger">Hapus</button></a>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
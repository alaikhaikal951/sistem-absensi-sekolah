          <div class="row">
              <div class="col-lg-12">
                  <h3 class="page-header mt-4"><strong>Data Siswa Per-Kelas</strong></h3>
              </div>
              <!-- /.col-lg-12 -->
          </div>
          <div class="row">
              <div class="col-lg-12">
                  <div class="panel panel-primary">
                      <div class="panel-heading mt-3">
                          Pilih Kelas
                      </div>
                      <div class="panel-body">
                          <form method="get" role="form" action="././media.php?module=siswa">
                              <div>
                                  <input type="hidden" name="module" value="siswa">

                                  <div class="form-group">
                                      <!-- <label>Kelas</label> -->
                                      <select class="form-control w-50 mt-2" name="kls">

                                          <?php
                                            if ($_SESSION['level'] == "guru") {
                                                $sql = mysqli_query($conn, "select * from kelas where idk='$_SESSION[idk]'");
                                            } else {
                                                $sql = mysqli_query($conn, "select * from kelas");
                                            ?>
                                              <option>semua</option>

                                          <?php
                                            }
                                            while ($rs = mysqli_fetch_array($sql)) {
                                                $sqla = mysqli_query($conn, "select * from sekolah where id='$rs[id]'");
                                                $rsa = mysqli_fetch_array($sqla);

                                                echo "<option value='$rs[idk]'>$rs[nama]</option>";
                                            }
                                            ?>
                                      </select>
                                  </div>

                                  <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                          </form>
                          <!-- /.row (nested) -->
                      </div>
                      <!-- /.panel-body -->
                  </div>
                  <!-- /.panel -->
              </div>
              <!-- /.col-lg-12 -->
          </div>
          <!-- /.row -->
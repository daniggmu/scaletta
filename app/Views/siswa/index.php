          <!-- Begin Page Content -->
          <div class="container-fluid">
              <!-- Page Heading -->
              <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

              <!-- Alert pesan -->
              <?php if (session()->get('pesan')) : ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      Data berhasil <strong><?= session()->getFlashdata('pesan'); ?></strong>
                  </div>

              <?php endif; ?>
              <div class="row">
                  <div class="col-md-6">
                      <?php
                        if (session()->get('error')) {
                            echo "<div class='alert alert-danger' role='alert'>" . session()->get('error') . "</div>";
                        } ?>
                  </div>
              </div>

              <div class="card">
                  <div class="card-header">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                          Tambah Data
                      </button>
                  </div>
                  <div class="card-body">
                      <table class="table table-stripped">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Foto</th>
                                  <th>NIM</th>
                                  <th>Nama</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php $i = 1; ?>
                              <?php foreach ($siswa->getResultArray() as $row) : ?>
                                  <tr>
                                      <td scope="row"><?= $i; ?></td>
                                      <td><img src="<?= base_url() ?>/assets/img/<?= $row['gambar']; ?>" class="gambar" width="100px" height="130px"></td>
                                      <td><?= $row['nim']; ?></td>
                                      <td><?= $row['nama']; ?></td>
                                      <td>
                                          <button type="button" data-toggle="modal" data-target="#modalUbah<?= $row['id']; ?>" name="id" class="btn btn-sm btn-warning"><i class=" fas fa-edit"></i></button>
                                          <a href="<?= base_url() ?>/siswa/hapus/<?= $row['id']; ?>" type="button" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin')"><i class="fas fa-trash-alt"></i>
                                      </td>
                                  </tr>
                                  <?php $i++; ?>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
              </div>

          </div>
          <!-- /.container-fluid -->
          </div>
          <!-- End of Main Content -->

          <!-- Modal Tambah -->
          <div class="modal fade" id="modalTambah">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <form action="<?= base_url('siswa/tambah'); ?>" method="post" enctype="multipart/form-data">
                              <div class="form-group mb-2"></div>
                              <label for="gambar">Upload foto!</label>
                              </br>
                              <input type="file" name="gambar">
                              <div class="form-group mb-0">
                                  <label for="nim"></label>
                                  <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan NIM">
                              </div>
                              <div class="form-group mb-0">
                                  <label for="nama"></label>
                                  <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama">
                              </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
                      </div>
                  </div>
                  </form>
              </div>
          </div>

          <!-- Modal Ubah data -->
          <?php foreach ($siswa->getResultArray() as $row) : ?>
              <div class="modal fade" id="modalUbah<?= $row['id']; ?>">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Ubah <?= $judul; ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">

                              <div class="form-group mb-2"></div>
                              <label for="gambar">Upload foto!</label>
                              </br>
                              <input type="file" name="gambar">
                              <form action="<?= base_url('siswa/ubah'); ?>" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                  <div class="form-group mb-0">
                                      <label for="nim"></label>
                                      <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" value="<?= $row['nim']; ?>">
                                  </div>
                                  <div class="form-group mb-0">
                                      <label for="nama"></label>
                                      <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="<?= $row['nama']; ?>">
                                  </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
                          </div>
                      </div>
                      </form>
                  </div>
              </div>
          <?php endforeach; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/>
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <title>CRUD MODAL!</title>
  </head>
  <body>
    <div class="container">
      <h2>CRUD MODAL</h2>
      <!-- Button tambah -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah Data User
      </button>

      <div class="row mt-2">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT * FROM user");
                    $no=1;
                    while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['password'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td>
                    <a href="#" class="btn btn-primary btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#edituser<?= $no ?>">Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#hapususer<?= $no ?>">Hapus</a> 
                    </td>
                    
                    <!-- Modal edit -->
                    <div class="modal fade" id="edituser<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <?php
                                $id_user = $row['id_user'];
                                $query2 = "SELECT * FROM user WHERE id_user='$id_user'";
                                $result = mysqli_query($koneksi, $query2);
                                while ($d = mysqli_fetch_assoc($result)) {
                            ?>
                            <form action="function_user.php?act=edituser" method="post">
                                <input type="hidden" name="id_user" value="<?= $d['id_user'] ?>">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input value="<?= $row['nama'] ?>" name="nama" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input value="<?= $row['username'] ?>" name="username" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input value="<?= $row['password'] ?>" name="password" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" aria-label="With textarea"><?= $row['alamat'] ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <input type="submit" class="btn btn-primary" value="Edit Data">
                            </form>
                            <?php } ?>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal hapus -->
                    <div class="modal fade" id="hapususer<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <?php
                                $id_user = $row['id_user'];
                                $query3 = "SELECT * FROM user WHERE id_user='$id_user'";
                                $result = mysqli_query($koneksi, $query3);
                                while ($d = mysqli_fetch_assoc($result)) {
                            ?>
                            <h4 align="center" >Apakah anda yakin ingin menghapus user nama <?= $row['nama'] ?> yang beralamat <?= $row['alamat'] ?> <strong><span class="grt"></span></strong> ?</h4>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <a href="function_user.php?act=hapususer&id=<?= $row['id_user'] ?>" class="btn btn-danger">Hapus Data</a>
                            <?php } ?>
                            </div>
                        </div>
                        </div>
                    </div>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
      </div>

      <!-- Modal tambah -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="function_user.php?act=tambahuser" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input name="nama" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input name="username" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" aria-label="With textarea"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <input type="submit" class="btn btn-primary" value="Tambah Data">
              </form>
            </div>
          </div>
        </div>
      </div>

      

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>
  </body>
</html>
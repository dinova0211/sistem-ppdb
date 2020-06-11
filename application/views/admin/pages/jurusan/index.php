<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view("admin/include/header.php") ?>
</head>
<body class="hold-transition login-page">

<div class="container-fluid p-0">
    <?php $this->load->view("admin/include/nav_bar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jurusan</h1>
          </div>
         </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <?php echo $this->session->flashdata('success')?>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <!-- /.card-header -->
          <div class="card-header">
                <a href="<?php echo site_url('jurusanController/add') ?>"><i class="fas fa-plus"></i> Tambah Jurusan</a>
            </div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover datatables" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Jurusan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jurusan as $j): ?>
                        <tr>
                            <td width="150">
                                <?php echo $j->nama_jurusan ?>
                            </td>
                            <td width="250">
                                <a href="<?php echo site_url('jurusanController/edit/'.$j->id_jurusan) ?>"
                                    class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
                                <a onclick="deleteConfirm('<?php echo site_url('jurusanController/delete/'.$j->id_jurusan) ?>')"
                                    href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah Kamu Yakin?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function deleteConfirm(url){
                                            $('#btn-delete').attr('href', url);
                                            $('#deleteModal').modal();
                                        }
                                    </script>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        <!-- /.card -->
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view("admin/include/copyright.php") ?>
</div>



<?php $this->load->view("admin/include/footer.php") ?>

</body>
</html>

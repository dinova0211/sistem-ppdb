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
            <div class="card-header">
                    <a href="<?php echo site_url('jurusanController/index') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">

            <form action="<?php echo site_url('jurusanController/add') ?>" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="name">Nama Jurusan</label>
                    <input class="form-control <?php echo form_error('nama_jurusan') ? 'is-invalid':'' ?>"
                        type="text" name="nama_jurusan" placeholder="Nama Jurusan" />
                    <div class="invalid-feedback">
                        <?php echo form_error('nama_jurusan') ?>
                    </div>
                </div>

                <input class="btn btn-success" type="submit" name="btn" value="Simpan" />
            </form>
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

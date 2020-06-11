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
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover datatables" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendaftaran as $p): ?>

                        <tr>
                            <td>
                                <?php echo $p->nama ?>
                            </td>
                            <td>
                                <?php echo $p->nisn ?>
                            </td>
                            <td>
                                <?php echo $p->email ?>
                            </td>
                            <td>
                                <?php echo $p->nama_jurusan ?>
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

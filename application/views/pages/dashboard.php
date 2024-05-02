<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Pendukung Keputusan</title>

    <?php $this->load->view('assets/stylesheet') ?>
</head>

<body>
    <div id="wrapper">
        <?php $this->load->view('master/header') ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            Selamat Datang <strong><?php echo $profile->nama; ?></strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading" style="background-color: #337AB7;">
                                <h4>Tentang Stunting</h4>
                            </div>
                            <div class="panel-body">
                                <p align="justify">
                                    Stunting dapat didefinisikan sebagai gangguan tumbuh kembang anak yang disebabkan masalah gizi kronis sejak anak anak masih berada dalam kandungan. Umumnya gejala stunting baru terlihat saat anak berusia 2 tahun. Stunting merupakan parameter pertumbuhan anak berdasarkan tinggi badan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
</body>
<?php $this->load->view('assets/javascript') ?>

</html>
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
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Standart Antropometri</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           <!-- Content -->
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title"><br></h4>
					</div>
					<div class="row">
						<section class="content" style="margin-top: -50px;">
							<div class="Antropometri" style="display: flex;  flex-wrap: wrap; gap: 20px;">
								<br>
								<div class="container" style="margin-bottom: 50px; width: 45%;">
									<h5 style="margin-bottom: 10px; font-weight: bold">Tabel Berat Badan</h5>
									<table class="table table-bordered ">
										<thead class="thead-light">
											<tr>
												<th colspan="5" style="text-align: center; background-color: #337AB7; color: white">Berat Badan (Kg)</th>
											</tr>
											<tr style="text-align: center;">
												<th>No</th>
												<th>Umur (Bulan)</th>
												<th>-1 SD</th>
												<th>Median</th>
												<th>+1 SD</th>
											</tr>
										</thead>
										<?php
										$no = 1;
										foreach ($berat as $datas) : ?>
											<tr style="text-align: center;">
												<td><?php echo $no++ ?></td>
												<td><?php echo $datas->umur ?></td>
												<td style="background-color: yellow;"><?php echo $datas->min_SD ?></td>
												<td style="background-color: #337AB7; color: white""><?php echo $datas->median ?></td>
												<td style="background-color: yellow;"><?php echo $datas->plus_SD ?></td>
											</tr>
										<?php endforeach; ?>
									</table>

								</div>
								<div class="container" style="margin-bottom: 50px; width: 45%;">
									<h5 style="margin-bottom: 10px; font-weight: bold">Tabel Tinggi Badan</h5>
									<table class="table table-bordered ">
										<thead class="thead-light">
											<tr>
												<th colspan="5" style="text-align: center; background-color: #337AB7; color: white">Tinggi Badan (Cm)</th>
											</tr>
											<tr style="text-align: center;">
												<th>No</th>
												<th>Umur (Bulan)</th>
												<th>-1 SD</th>
												<th>Median</th>
												<th>+1 SD</th>
											</tr>
										</thead>
										<?php
										$no = 1;
										foreach ($tinggi as $datas) : ?>
											<tr style="text-align: center;">
												<td><?php echo $no++ ?></td>
												<td><?php echo $datas->umur ?></td>
												<td style="background-color: yellow;"><?php echo $datas->min_SD ?></td>
												<td style="background-color: #337AB7; color: white""><?php echo $datas->median ?></td>
												<td style="background-color: yellow;"><?php echo $datas->plus_SD ?></td>
											</tr>
										<?php endforeach; ?>
									</table>

								</div>

								<div class="container" style="margin-bottom: 50px; width: 45%;">
									<h5 style="margin-bottom: 10px; font-weight: bold">Tabel Berat Badan Per Tinggi Badan</h5>
									<table class="table table-bordered ">
										<thead class="thead-light">
											<tr>
												<th colspan="5" style="text-align: center; background-color: #337AB7; color: white">Berat Badan (Kg)</th>
											</tr>
											<tr style="text-align: center;">
												<th>No</th>
												<th>Umur (Bulan)</th>
												<th>-1 SD</th>
												<th>Median</th>
												<th>+1 SD</th>
											</tr>
										</thead>
										<?php
										$no = 1;
										foreach ($bbtb as $datas) : ?>
											<tr style="text-align: center;">
												<td><?php echo $no++ ?></td>
												<td><?php echo $datas->umur ?></td>
												<td style="background-color: yellow;"><?php echo $datas->min_SD ?></td>
												<td style="background-color: #337AB7;color: white""><?php echo $datas->median ?></td>
												<td style="background-color: yellow;"><?php echo $datas->plus_SD ?></td>
											</tr>
										<?php endforeach; ?>
									</table>

								</div>


								<div class="container" style="margin-bottom: 50px; width: 45%;">
									<h5 style="margin-bottom: 10px; font-weight: bold">Tabel Indeks Masa Tubuh Menurut Umur</h5>
									<table class="table table-bordered ">
										<thead class="thead-light">
											<tr>
												<th colspan="5" style="text-align: center; background-color: #337AB7; color: white">Indeks Massa Tubuh (IMT)</th>
											</tr>
											<tr style="text-align: center;">
												<th>No</th>
												<th>Umur (Bulan)</th>
												<th>-1 SD</th>
												<th>Median</th>
												<th>+1 SD</th>
											</tr>
										</thead>
										<?php
										$no = 1;
										foreach ($imt as $datas) : ?>
											<tr style="text-align: center;">
												<td><?php echo $no++ ?></td>
												<td><?php echo $datas->umur ?></td>
												<td style="background-color: yellow;"><?php echo $datas->min_SD ?></td>
												<td style="background-color: #337AB7;color: white""><?php echo $datas->median ?></td>
												<td style="background-color: yellow;"><?php echo $datas->plus_SD ?></td>
											</tr>
										<?php endforeach; ?>
									</table>

								</div>

							</div>

						</section>

					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- Content -->
</div>


        </div>
        <!-- /#page-wrapper -->
    </div>
</body>
<?php $this->load->view('assets/javascript') ?>

</html>
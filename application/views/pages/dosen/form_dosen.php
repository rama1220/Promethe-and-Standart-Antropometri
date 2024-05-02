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
                        <h1 class="page-header"><?= $mode ?> Data</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Form Data Pasien
                            </div>
                            <div class="panel-body">
                                <form action="" method="post">
                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>No. KK</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="nidn" placeholder="No KK" required="" value="<?php if (isset($data_calon)) echo $data_calon['nidn']; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="nama" placeholder="Nama" required="" value="<?php if (isset($data_calon)) echo $data_calon['nama']; ?>">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Berat Badan (kg)</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" id="berat_badan" name="berat_badan" placeholder="Berat Badan" required="" value="<?php if (isset($data_calon)) echo $data_calon['berat_badan']; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Tinggi Badan (cm)</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan" required="" value="<?php if (isset($data_calon)) echo $data_calon['tinggi_badan']; ?>">
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Umur (Bulan)</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select id="id_umur" name="id_umur" class="form-control">
                                                <option disabled selected>Pilih Umur</option>
                                                <?php
                                                foreach ($usia as $umur) {
                                                    echo '<option value="' . $umur['id'] . '">' . $umur['umur'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <?php
                                    // foreach ($usia as $umur) {
                                    //     foreach ($this->DataModel->getDataByUmur($umur['id']) as $nilai) {
                                    //         // Validate and sanitize input
                                    //         $berat_badan_input = isset($_POST['berat_badan']) ? floatval($_POST['berat_badan']) : 0;
                                    //         $tinggi_badan_input = isset($_POST['tinggi_badan']) ? floatval($_POST['tinggi_badan']) : 0;

                                    //         // Perform calculations only if input values are numeric
                                    //         if (is_numeric($berat_badan_input) && is_numeric($tinggi_badan_input)) {
                                    //             // Calculate deviation from median weight
                                    //             $berat_deviation = $berat_badan_input - $nilai->b_median;

                                    //             // Determine result based on deviation
                                    //             $result = ($berat_deviation < 0) ? ($nilai->b_median - $nilai->b_min_SD) : ($nilai->b_plus_SD - $nilai->b_median);

                                    //             // Calculate 'a' value
                                    //             $a = $berat_deviation / $result;

                                    //             $nilaiF1=0;
                                    //             if ($a < -3) {
                                    //                 $nilaiF1 = 8;
                                    //             } elseif ($a >= -3 && $a < -2) {
                                    //                 $nilaiF1 = 9;
                                    //             } elseif ($a >= -2) {
                                    //                 $nilaiF1 = 10;
                                    //             }


                                    //         } 
                                    //     }
                                    // }
                                    // 
                                    ?>

                                    <script>
                                        document.getElementById('id_umur').addEventListener('change', function() {
                                            var selectedUmurId = this.value;
                                            console.log("Usia:", selectedUmurId);

                                            // AJAX request to get data based on selected umur
                                            fetch('<?php echo base_url('Dosen/getUmurData/') ?>' + selectedUmurId)
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data && data.length > 0) { // Check if data is not null and has length
                                                        let berat_badan_input = parseFloat(document.getElementById('berat_badan').value);
                                                        let tinggi_badan_input = parseFloat(document.getElementById('tinggi_badan').value);

                                                        console.log("Berat Badan:", berat_badan_input);
                                                        console.log("Tinggi Badan:", tinggi_badan_input);

                                                        if (!isNaN(berat_badan_input) && !isNaN(tinggi_badan_input)) {
                                                            let bb_u = berat_badan_input - data[0].b_median;
                                                            let result = (bb_u < 0) ? (data[0].b_median - data[0].b_min_SD) : (data[0].b_plus_SD - data[0].b_median);
                                                            let a = bb_u / result;

                                                            let nilaiF1 = 0;
                                                            if (a < -3) {
                                                                nilaiF1 = 8;
                                                            } else if (a >= -3 && a < -2) {
                                                                nilaiF1 = 9;
                                                            } else if (a >= -2) {
                                                                nilaiF1 = 10;
                                                            }

                                                            let imt_u = tinggi_badan_input / 100;
                                                            let resultTB = Math.pow(imt_u, 2); // Calculate squared height
                                                            let resultImt = berat_badan_input / resultTB;

                                                            let restIMT = 0;
                                                            if (resultImt < data[0].u_median) {
                                                                restIMT = data[0].u_median - data[0].u_min_SD;
                                                            } else {
                                                                restIMT = data[0].u_plus_SD - data[0].u_median;
                                                            }

                                                            let d = (resultImt - data[0].u_median) / restIMT;

                                                            let nilaiF4 = 0;

                                                            if (d < -3) {
                                                                nilaiF4 = 1;
                                                            } else if (d >= -3 && d < -2) {
                                                                nilaiF4 = 2;
                                                            } else if (d >= -2 && d <= 2) {
                                                                nilaiF4 = 3;
                                                            } else if (d > 2) {
                                                                nilaiF4 = 4;
                                                            }



                                                            let tb_u=tinggi_badan_input - data[0].t_median;
                                                            let resultTB_U = 0;
                                                            if(tb_u < data[0].t_median ){
                                                                resultTB_U = data[0].t_median - data[0].t_min_SD;
                                                            }else{
                                                                resultTB_U = data[0].t_plus_SD - data[0].t_median;
                                                            }


                                                            let e = tb_u / resultTB_U;

                                                            let nilaiF2 = 0;
                                                            if (e < -3) {
                                                                nilaiF2 = 11;
                                                            }else if (e >= -3 && e < -2) {
                                                                nilaiF2 = 12;
                                                            }else if (e >= -2) {
                                                                nilaiF2 = 13;
                                                            }

                                                            let bb_tb = berat_badan_input - data[0].bt_median;
                                                            let resultBBTB = 0;
                                                            if(bb_tb < data[0].bt_median ){
                                                                resultBBTB = data[0].bt_median - data[0].bt_min_SD;
                                                            }else{
                                                                resultBBTB = data[0].bt_plus_SD - data[0].bt_median;
                                                            }
                                                            

                                                            let f = bb_tb / resultBBTB;
                                                            let nilaiF3 = 0;
                                                            if (f < -3) {
                                                                nilaiF3 = 5;
                                                            }else if (f >= -3 && f < -2) {
                                                                nilaiF3 = 6;
                                                            }else if (f >= -2) {
                                                                nilaiF3 = 7;
                                                            }

                                                            // Set nilaiF1 value to input field and log the value
                                                            document.getElementById('nilaiF1').value = nilaiF1;
                                                            document.getElementById('nilaiF2').value = nilaiF2;
                                                            document.getElementById('nilaiF3').value = nilaiF3;
                                                            document.getElementById('nilaiF4').value = nilaiF4;
                                                            console.log("NilaiF1:", nilaiF1);
                                                            console.log("NilaiF2:", nilaiF2);
                                                            console.log("NilaiF3:", nilaiF3);
                                                            console.log("NilaiF4:", nilaiF4);
                                                        }
                                                    }
                                                });
                                        });
                                    </script>



                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="radio" name="jenis_kelamin" value="Laki - Laki" <?php if (isset($data_calon) && $data_calon['jenis_kelamin'] == 'Laki - Laki') echo 'checked';  ?>>
                                            Laki - Laki
                                            <input type="radio" name="jenis_kelamin" value="Perempuan" <?php if (isset($data_calon) && $data_calon['jenis_kelamin'] == 'Perempuan') echo 'checked';  ?>>
                                            Perempuan
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Alamat</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" name="alamat" placeholder="Alamat"><?php if (isset($data_calon)) echo $data_calon['alamat']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Nomor Telepon</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="no_hp" placeholder="Nomor Telepon" value="<?php if (isset($data_calon)) echo $data_calon['no_hp']; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Nama Orang Tua</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="nama_ortu" placeholder="Nama Orang Tua" value="<?php if (isset($data_calon)) echo $data_calon['nama_ortu']; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Indeks Masa Tubuh Menurut Umur (IMT/U)</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" id="nilaiF4" name="sub_id[21]" placeholder="Indeks Masa Tubuh Menurut Umur (IMT/U)" value="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Berat Badan Per Tinggi Badan (BB/TB)</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" id="nilaiF3" name="sub_id[22]" placeholder="Berat Badan Per Tinggi Badan (BB/TB)" value="">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Berat Badan menurut Umur (BB/U)</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="sub_id[23]" id="nilaiF1" placeholder="Berat Badan menurut Umur (BB/U)" value="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-3">
                                            <label>Tinggi Badan menurut Umur (TB/U)</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" id="nilaiF2" name="sub_id[24]" placeholder="Tinggi Badan menurut Umur (TB/U)" value="">
                                        </div>
                                    </div>

                                    <!-- <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var formGroups = document.querySelectorAll('.row.form-group');

                                            formGroups.forEach(function(formGroup) {
                                                formGroup.addEventListener('click', function(event) {
                                                    var input = formGroup.querySelector('input');
                                                    var select = formGroup.querySelector('select');

                                                    if (input) {
                                                        console.log("Input Name:", input.name);
                                                        console.log("Input Value:", input.value);
                                                    }

                                                    if (select) {
                                                        console.log("Select Name:", select.name);
                                                        console.log("Select Value:", select.value);
                                                    }
                                                });
                                            });
                                        });
                                    </script> -->

                                    <div class="form-group">
                                        <input type="hidden" id="previousPage" value="http://localhost/spk_promethee/proses?periode=1">

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <input type="submit" class="btn btn-md btn-success" name="kirim" value="Simpan" onclick="saveData()">
                                                <button type="reset" class="btn btn-md btn-warning"><i class="fa fa-undo"></i> Ulangi</button>
                                            </div>
                                        </div>

                                        <script>
                                            function saveData() {

                                                var previousPage = document.getElementById("previousPage").value;
                                                window.location.href = previousPage;
                                            }
                                        </script>

                                </form>
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
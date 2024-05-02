<?php

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Dosen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel');
        $this->load->library('form_validation');
        // $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }

    public function index()
    {
        if ($this->_isLoggedIn()) {
            $profile = $this->DataModel->getWhere('id', $this->session->userdata['admin_data']['id']);
            $profile = $this->DataModel->getData('pengguna')->row();
            if ($profile->level != "superadmin") {
                $dosen = $this->DataModel->order_by('dosen.nama', 'ASC');
                $dosen = $this->DataModel->getWhere('prodi', $profile->prodi);
                $dosen = $this->DataModel->getData('dosen')->result_array();
            } else {
                $dosen = $this->DataModel->order_by('dosen.nama', 'ASC');
                $dosen = $this->DataModel->getData('dosen')->result_array();
            }
            $data = array(
                "datas" => $dosen,
                "profile" => $profile,
            );
            $this->load->view('pages/dosen/data', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function detail()
    {
        if ($this->_isLoggedIn()) {
            $id = $this->input->get('nidn');
            // die(json_encode($id));
            $profile = $this->DataModel->getWhere('id', $this->session->userdata['admin_data']['id']);
            $profile = $this->DataModel->getData('pengguna')->row();
            $dosen = $this->DataModel->select('dosen.*, kriteria.nama as nama_kriteria, subkriteria.nama as nama_subkriteria, dosen_subkriteria.value as value_dosen_subkriteria, dosen_subkriteria.id as dosen_subkriteria_id,dosen_subkriteria.periode');
            $dosen = $this->DataModel->getJoin('dosen_subkriteria', 'dosen.nidn = dosen_subkriteria.nidn', 'inner');
            $dosen = $this->DataModel->getJoin('subkriteria', 'dosen_subkriteria.id_subkriteria = subkriteria.id', 'inner');
            $dosen = $this->DataModel->getJoin('kriteria', 'subkriteria.id_kriteria=kriteria.id', 'inner');
            $dosen = $this->DataModel->getWhere('dosen.nidn', $id);
            $dosen = $this->DataModel->getData('dosen')->result_array();
            $umur = $this->DataModel->getUsiaById($dosen[0]['id_umur'],'usia_pasien');
            
            // die(json_encode($dosen));   
            $data['nidn'] = $dosen[0]['nidn'];
            $data['nama'] = $dosen[0]['nama'];
            $data['jenis_kelamin'] = $dosen[0]['jenis_kelamin'];
            $data['alamat'] = $dosen[0]['alamat']; // Tambah informasi alamat
            $data['no_hp'] = $dosen[0]['no_hp']; // Tambah informasi no_hp
            $data['nama_ortu'] = $dosen[0]['nama_ortu']; // Tambah informasi nama_ortu
            $data['umur'] = $umur->umur;
            $data['berat_badan'] = $dosen[0]['berat_badan'];
            $data['tinggi_badan'] = $dosen[0]['tinggi_badan'];


            foreach ($dosen as $key => $value) {
                $data['kriteria'][$value['nama_kriteria']]['value'] = $value['nama_subkriteria'] != 'input' ? $value['nama_subkriteria'] : $value['value_dosen_subkriteria'];

                $data['kriteria'][$value['nama_kriteria']]['id'] = $value['dosen_subkriteria_id'];
            }
            $dosens = $data;
            $data = array(
                "data_calon" => $dosens,
                "profile" => $profile,
            );
            $this->load->view('pages/dosen/data_detail', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function tambah()
    {
        if ($this->_isLoggedIn()) {
            $id_periode = $this->input->get('periode');
            $profile = $this->DataModel->getWhere('id', $this->session->userdata['admin_data']['id']);
            $profile = $this->DataModel->getData('pengguna')->row();
            $kriteria = $this->DataModel->select("kriteria.id, kriteria.nama, kriteria.bobot, kriteria.jenis, subkriteria.nama as nama_subkriteria , subkriteria.bobot as bobot_subkriteria, subkriteria.id as subkriteria_id");
            $kriteria = $this->DataModel->getJoin('subkriteria', 'kriteria.id = subkriteria.id_kriteria', 'left');
            $kriteria = $this->DataModel->getData('kriteria')->result_array();
            $umur = $this->DataModel->getUsia();
            foreach ($kriteria as $key) {
                $datas[$key['nama']][] = $key;
            }
            $data = array(
                "datas" => $datas,
                "profile" => $profile,
                "mode" => "Tambah",
                "usia" => $umur
            );
            if ($this->input->post('kirim')) {
                $nidn = $this->input->post('nidn');
                $nama = $this->input->post('nama');
                $jk = $this->input->post('jenis_kelamin');
                $alamat = $this->input->post('alamat'); // Tambah informasi alamat
                $no_hp = $this->input->post('no_hp'); // Tambah informasi no_hp
                $nama_ortu = $this->input->post('nama_ortu'); // Tambah informasi nama_ortu
                $id_umur = $this->input->post('id_umur');
                $berat_badan = $this->input->post('berat_badan');
                $tinggi_badan = $this->input->post('tinggi_badan');
                $sub = $this->input->post('sub_id');
                $value = $this->input->post('value');
                $data = array(
                    "nidn" => $nidn,
                    "nama" => $nama,
                    "jenis_kelamin" => $jk,
                    "alamat" => $alamat, // Tambah informasi alamat
                    "no_hp" => $no_hp, // Tambah informasi no_hp
                    "nama_ortu" => $nama_ortu, // Tambah informasi nama_ortu
                    "id_umur" => $id_umur,
                    "berat_badan" => $berat_badan,
                    "tinggi_badan" => $tinggi_badan

                );
                $cek = $this->DataModel->getWhere('nidn', $nidn);
                $cek = $this->DataModel->getData('dosen')->row();
                // die(json_encode($cek));
                if ($cek != null) {
                    $this->DataModel->getWhere('nidn', $nidn);
                    $this->DataModel->update('dosen', $data);
                } else {
                    $this->DataModel->insert("dosen", $data);
                }
                $dataS = array();
                $i = 0;
                foreach ($sub as $key => $val) {
                    if (isset($value[$key])) {
                        $nilai = $value[$key];
                    } else {
                        $nilai = 0;
                    }
                    $dataS[$i]['nidn'] = $nidn;
                    $dataS[$i]['id_subkriteria'] = $val;
                    $dataS[$i]['value'] = $nilai;
                    $dataS[$i]['periode'] = $id_periode;
                    $i++;
                    // $dataS[$i]['value'] = $value[$key];
                }
                // die(json_encode($dataS));
                $this->DataModel->insert_multiple("dosen_subkriteria", $dataS);
                redirect('proses?periode=' . $id_periode);
            } else {
                $this->load->view('pages/dosen/form_dosen', $data);
            }
        } else {
            redirect('admin/login');
        }
    }



    public function import()
    {
        if ($this->_isLoggedIn()) {
            $id_periode = $this->input->get('periode');
            $profile = $this->DataModel->getWhere('id', $this->session->userdata['admin_data']['id']);
            $profile = $this->DataModel->getData('pengguna')->row();
            $data = array(
                "profile" => $profile,
            );
            if ($this->input->post('kirim')) {
                if (!empty($_FILES['file']['name'])) {
                    $config['upload_path'] = "assets/data_dosen";
                    $config['file_name'] = date("y-m-d") . "data_dosen";
                    $config['allowed_types'] = 'xlsx|xls';
                    $config['overwrite'] = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file')) {
                        echo " error " . "<br>";
                        var_dump($_FILES['file']);
                        // var_dump($_FILES['usulan']);
                        echo $this->upload->display_errors('<p>', '</p>');
                    } else {
                        // $media = $this->upload->data('file');
                        // die(json_encode($media));
                        $inputFileName = 'assets/data_dosen/' . date("y-m-d") . "data_dosen.xlsx";
                        try {
                            $objReader = new Xlsx();
                            $objReader->setReadDataOnly(true);
                            // $objReader->setLoadSheetsOnly("Sheet 1");
                            $objPHPExcel = $objReader->load($inputFileName);
                        } catch (Excepton $e) {
                            // die("error ".pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                        }
                        $datas = [];
                        // var_dump($objPHPExcel->getActiveSheet()->toArray());
                        $sheet = $objPHPExcel->getActiveSheet();
                        $hr = $sheet->getHighestRow();
                        $hc = $sheet->getHighestColumn();
                        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($hc);
                        for ($row = 2; $row <= $hr; $row++) {
                            $dataArray = $objPHPExcel->getActiveSheet()
                                ->rangeToArray(
                                    'A' . $row . ':' . $hc . $row,
                                    NULL,
                                    TRUE,
                                    FALSE
                                );
                            $data_dosen['data'][] = array(
                                "nidn" => $dataArray[0][0],
                                "nama" => $dataArray[0][1],
                                "jenis_kelamin" => $dataArray[0][3],
                            );
                            $datas['data'][] = array(
                                "nidn" => $dataArray[0][0],
                                "X1" => $dataArray[0][4],
                                "X2" => $dataArray[0][5],
                                "X3" => $dataArray[0][6],
                                "X4" => $dataArray[0][7],
                                "X5" => $dataArray[0][8],
                                "X6" => $dataArray[0][9],
                                "X7" => $dataArray[0][10],
                                "X8" => $dataArray[0][11],
                                "X9" => $dataArray[0][12],
                                "X10" => $dataArray[0][13],
                                // "X11" => $dataArray[0][14]
                            );
                        }
                        $dat = array();
                        for ($i = 1; $i <= 10; $i++) {
                            $q = $this->DataModel->select('id');
                            $q = $this->DataModel->getWhere('simbol', 'X' . $i);
                            $q = $this->DataModel->getData('kriteria')->row();
                            // var_dump($q);
                            for ($j = 0; $j < count($datas['data']); $j++) {
                                $dat['data'][$datas['data'][$j]['nidn']][$q->id] = $datas['data'][$j]['X' . $i];
                                // $dat['data'][]['bobot'][] = $datas['data'][$j]['X'.$i];
                            }
                        }
                        // die(json_encode($data_dosen));
                        $dat_sub = array();
                        for ($i = 0; $i < count($data_dosen['data']); $i++) {
                            for ($j = 0; $j < count($dat['data'][$data_dosen['data'][$i]['nidn']]); $j++) {
                                $arr = array_keys($dat['data'][$data_dosen['data'][$i]['nidn']]);
                                $cek = $this->DataModel->getWhere('id_kriteria', $arr[$j]);
                                $cek = $this->DataModel->getWhere('bobot', $dat['data'][$data_dosen['data'][$i]['nidn']][$arr[$j]]);
                                $cek = $this->DataModel->getData('subkriteria')->row();
                                // var_dump($cek);
                                if ($cek != null) {
                                    $ceka = $this->DataModel->getWhereArr(array("nidn" => $data_dosen['data'][$i]['nidn'], "periode" => $id_periode));
                                    $ceka = $this->DataModel->getData('dosen_subkriteria')->result_array();
                                    // $dat_sub[$i]["nidn"][] = $data_dosen['data'][$i]['nidn'];
                                    // $dat_sub[$i]['id_subkriteria'][] = $cek->id;
                                    // $dat_sub[$i]['periode'][] = $id_periode;
                                    // $dat_sub[$i]['value'][] = 0;
                                    $dat_sub[] = array(
                                        "nidn" => $data_dosen['data'][$i]['nidn'],
                                        "id_subkriteria" => $cek->id,
                                        "periode" => $id_periode,
                                        "value" => 0
                                    );
                                } else {
                                    $sk = $this->DataModel->select('id');
                                    $sk = $this->DataModel->getWhere('id_kriteria', $arr[$j]);
                                    $sk = $this->DataModel->getData('subkriteria')->row();
                                    // $dat_sub[$i]["nidn"][] = $data_dosen['data'][$i]['nidn'];
                                    // $dat_sub[$i]['id_subkriteria'][] = $sk->id;
                                    // $dat_sub[$i]['periode'][] = $id_periode;
                                    // $dat_sub[$i]['value'][] = $dat['data'][$data_dosen['data'][$i]['nidn']][$arr[$j]];
                                    $dat_sub[] = array(
                                        "nidn" => $data_dosen['data'][$i]['nidn'],
                                        "id_subkriteria" => $sk->id,
                                        "periode" => $id_periode,
                                        "value" => $dat['data'][$data_dosen['data'][$i]['nidn']][$arr[$j]]
                                    );
                                }
                            }
                        }
                        $aaa = 0;
                        $data_dosub = array();
                        foreach ($data_dosen['data'] as $key => $val) {
                            $cek = $this->DataModel->getWhere('nidn', $val['nidn']);
                            $cek = $this->DataModel->getData('dosen')->row();
                            // var_dump($cek);
                            $data = array(
                                "nidn" => $val['nidn'],
                                "nama" => $val['nama'],
                                "jenis_kelamin" => $val['jenis_kelamin']
                            );
                            if ($cek != null) {
                                $this->DataModel->getWhere('nidn', $val['nidn']);
                                $this->DataModel->update('dosen', $data);
                            } else {
                                $this->DataModel->insert('dosen', $data);
                            }
                            $ceka = $this->DataModel->getWhereArr(array("nidn" => $val['nidn'], "periode" => $id_periode));
                            $ceka = $this->DataModel->getData('dosen_subkriteria')->result_array();
                            foreach($ceka as $key){
                                $data_dosub['id'][] = $key['id'];
                            }
                            // var_dump($ceka);
                            if(count($ceka) != 0){
                                // $data_dosub = $ceka;
                                $aaa = count($ceka);
                            }else{
                                $aaa = 0;
                            }
                        }
                        // die(json_encode($data_dosub));
                        $no = 0;
                        // $i = 0;

                        foreach ($dat_sub as $key) {
                            // echo $key['nidn'] ."<br>" ;
                            // die();
                            // var_dump($aaa);
                            // die(json_encode($cek));
                            if ($aaa > 0) {
                                // echo "kadune ana";
                                $dat_in = array(
                                    "nidn" => $key['nidn'],
                                    "id_subkriteria" => $key['id_subkriteria'],
                                    "value" => $key['value'],
                                    "periode" => $key['periode']
                                );
                                // echo $data_dosub['id'][$no];
                                // var_dump($dat_in);
                                // $this->DataModel->getWhereArr(array("nidn" => $key['nidn'],"periode" => $key['periode']));
                                $this->DataModel->getWhere('id',$data_dosub['id'][$no]);
                                $this->DataModel->update('dosen_subkriteria',$dat_in);
                                // $this->DataModel->delete_arr(array("nidn" => $key['nidn'], "periode" => $key['periode']), 'dosen_subkriteria');
                            }else{
                                $dat_in = array(
                                    "nidn" => $key['nidn'],
                                    "id_subkriteria" => $key['id_subkriteria'],
                                    "value" => $key['value'],
                                    "periode" => $key['periode']
                                );
                                // die(json_encode($dat_in));
                                // var_dump($dat_in);
                                // echo $dat_in;
                                $this->DataModel->insert('dosen_subkriteria', $dat_in);
                            }
                            unset($dat_in);
                            $no++;
                        }
                        // die();
                        // die(json_encode($dat_sub));
                        // die(json_encode(($data_dosen)));
                        redirect('proses?periode='.$id_periode);
                    }
                }
            } else {
                $this->load->view('pages/dosen/import_file', $data);
            }
        } else {
            redirect('admin/login');
        }
    }

public function getUmurData($id_umur){

    $umur_data = $this->DataModel->getDataByUmur($id_umur);

    // Check if data is available
    if ($umur_data) {
        // Send umur data as JSON response
        header('Content-Type: application/json');
        echo json_encode($umur_data);
        exit; 
    } else {
        // Handle case when data is not available
        header('HTTP/1.1 404 Not Found');
        echo json_encode(array('error' => 'Data not found'));
    }

}

    public function ubah()
    {
        if ($this->_isLoggedIn()) {
            $id_periode = $this->input->get('periode');
            $id = $this->input->get('nidn');
            $profile = $this->DataModel->getWhere('id', $this->session->userdata['admin_data']['id']);
            $profile = $this->DataModel->getData('pengguna')->row();
            $kriteria = $this->DataModel->select("kriteria.id, kriteria.nama, kriteria.bobot, kriteria.jenis, subkriteria.nama as nama_subkriteria , subkriteria.bobot as bobot_subkriteria, subkriteria.id as subkriteria_id");
            $kriteria = $this->DataModel->getJoin('subkriteria', 'kriteria.id = subkriteria.id_kriteria', 'left');
            $kriteria = $this->DataModel->getData('kriteria')->result_array();
            $dosen = $this->DataModel->select('dosen.*, kriteria.nama as nama_kriteria, subkriteria.nama as nama_subkriteria, dosen_subkriteria.value as value_dosen_subkriteria, dosen_subkriteria.id as dosen_subkriteria_id');
            $dosen = $this->DataModel->getJoin('dosen_subkriteria', 'dosen.nidn = dosen_subkriteria.nidn', 'inner');
            $dosen = $this->DataModel->getJoin('subkriteria', 'dosen_subkriteria.id_subkriteria = subkriteria.id', 'inner');
            $dosen = $this->DataModel->getjOin('kriteria', 'subkriteria.id_kriteria=kriteria.id', 'inner');
            $dosen = $this->DataModel->getWhere('dosen.nidn', $id);
            $dosen = $this->DataModel->getData('dosen')->result_array();
            $umur = $this->DataModel->getUsia();
            foreach ($kriteria as $key) {
                $datas[$key['nama']][] = $key;
            }
            // die(json_encode($dosen));
            $data['nidn'] = $dosen[0]['nidn'];
            $data['nama'] = $dosen[0]['nama'];
            $data['jenis_kelamin'] = $dosen[0]['jenis_kelamin'];
            $data['alamat'] = $dosen[0]['alamat'];
            $data['no_hp'] = $dosen[0]['no_hp'];
            $data['nama_ortu'] = $dosen[0]['nama_ortu']; // Tambah informasi alamat
            $data['berat_badan']=$dosen[0]['berat_badan'];
            $data['tinggi_badan']=$dosen[0]['tinggi_badan'];

            foreach ($dosen as $key => $value) {
                $data['kriteria'][$value['nama_kriteria']]['value'] = $value['nama_subkriteria'] != 'input' ? $value['nama_subkriteria'] : $value['value_dosen_subkriteria'];

                $data['kriteria'][$value['nama_kriteria']]['id'] = $value['dosen_subkriteria_id'];
            }
            $dosens = $data;
            $data = array(
                "datas" => $datas,
                "data_calon" => $dosens,
                "profile" => $profile,
                "mode" => "Ubah",
                "usia"=>$umur,
            );
            // die(json_encode($data));
            if ($this->input->post('kirim')) {
                // die(json_encode($id_periode));
                $nidn = $this->input->get('nidn');
                $nama = $this->input->post('nama');
                $jk = $this->input->post('jenis_kelamin');
                $alamat = $this->input->post('alamat'); // Tambah informasi alamat
                $no_hp = $this->input->post('no_hp'); // Tambah informasi no_hp
                $nama_ortu = $this->input->post('nama_ortu'); 
                $id_umur = $this->input->post('id_umur');
                $berat_badan = $this->input->post('berat_badan');
                $tinggi_badan = $this->input->post('tinggi_badan');// Tambah informasi nama_ortu
                $sub = $this->input->post('sub_id');
                $value = $this->input->post('value');
                $old_sub_id = $this->input->post('old_sub_id');
                $new_sub_id = $this->input->post('new_sub_id');
                $data = array(
                    "nama" => $nama,
                    "jenis_kelamin" => $jk,
                    "alamat" => $alamat,
                    "no_hp" => $no_hp,
                    "nama_ortu" => $nama_ortu,
                    "id_umur" => $id_umur,
                    "berat_badan" => $berat_badan,
                    "tinggi_badan" => $tinggi_badan
                );
                $this->DataModel->getWhere('nidn', $nidn);
                $this->DataModel->update('dosen', $data);
                $dataS = array();
                $data_array = null;
                $i = 0;
                // die(json_encode($value));
                foreach ($sub as $key => $val) {
                    if (isset($value[$key])) {
                        $nilai = $value[$key];
                    } else {
                        $nilai = 0;
                    }
                    // echo $nilai . "<br>";
                    // die();
                    // echo $old_sub_id[$key] . "<br>";
                    // echo $sub[$val];
                    if(isset($old_sub_id[$key])){
                        $data_array = array(
                            "id" => $old_sub_id[$key],
                            "nidn" => $nidn,
                            "id_subkriteria" => $sub[$key],
                            "value" => $nilai,
                            "periode" => $id_periode  
                        );
                        // echo "test". "<br>";
                        // die()
                        $query = $this->DataModel->getWhere('id',$old_sub_id[$key]);
                        $query = $this->DataModel->update('dosen_subkriteria',$data_array);
                        // die(json_encode($data_array));
                        // var_dump($data_array);
                    }else{
                        $data_array = array(
                            "nidn" => $nidn,
                            "id_subkriteria" => $sub[$key],
                            "value" => $nilai,
                            "periode" => $id_periode  
                        );
                        $query = $this->DataModel->insert('dosen_subkriteria',$data_array);
                        // die(json_encode($data_array));
                    }
                    unset($data_array);
                    $dataS[$i]['id'] = $val;
                    $dataS[$i]['nidn'] = $nidn;
                    $dataS[$i]['id_subkriteria'] = $sub[$key];
                    $dataS[$i]['value'] = $nilai;
                    $dataS[$i]['periode'] = $id_periode;
                    $i++;
                }
                // die();
                if (!empty($new_sub_id)) {
                    foreach ($new_sub_id as $key => $val) {
                        if (isset($value[$key])) {
                            $nilai = $value[$key];
                        } else {
                            $nilai = 0;
                        }
                        $dataS[$i]['nidn'] = $nidn;
                        $dataS[$i]['id_subkriteria'] = $sub[$key];
                        $dataS[$i]['value'] = $nilai;
                        $dataS[$i]['periode'] = $id_periode;
                        $i++;

                    }
                    // $this->DataModel->insert_multiple("dosen_subkriteria", $dataS);
                }
                // $this->DataModel->update_multiple("dosen_subkriteria", $dataS, "id");
                redirect('proses?periode=1');
                // die(json_encode($new_sub_id));
            } else {
                // die(json_encode($data));
                $this->load->view('pages/dosen/form_dosen', $data);
            }
        } else {
            redirect('admin/login');
        }
    }

    public function hapus()
    {
        if ($this->_isLoggedIn()) {
            $id = $this->input->get('nidn');
            // die(json_encode($id));
            $this->DataModel->delete('nidn', $id, 'dosen_subkriteria');
            $this->DataModel->delete('nidn', $id, 'dosen');
            redirect('dosen');
        } else {
            redirect('admin/login');
        }
    }

    private function _isLoggedIn()
    {
        if (isset($this->session->userdata['admin_data']['status'])) {
            return true;
        } else {
            return false;
        }
    }
}

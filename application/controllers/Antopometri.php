<?php

class Antopometri extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->_isLoggedIn()) {
            $datas = null;
            $profile = $this->DataModel->getWhere('id', $this->session->userdata['admin_data']['id']);
            $profile = $this->DataModel->getData('pengguna')->row();
            $data["berat"]= $this->DataModel->getberat();
            $data["tinggi"] = $this->DataModel->gettinggi();
            $data["bbtb"] = $this->DataModel->getbb_tb();
            $data["imt"] = $this->DataModel->getimt();
            // die(json_encode($kriteria));
          
            // die(json_encode($datas));
            $data = array(
                "datas" => $datas,
                "profile" => $profile,
                "berat" => $data["berat"], // Pass $berat variable to view data array
                "tinggi" => $data["tinggi"], // Pass $tinggi variable to view data array
                "bbtb" => $data["bbtb"], // Pass $bbtb variable to view data array
                "imt" => $data["imt"], // Pass $imt variable to view data array
            );
            $this->load->view('pages/antopometri/antopometri', $data);
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

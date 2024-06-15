<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends CI_Controller {
    
    public function index($head="")
    {   
        if ($this->session->userdata("username")) {
            $d["title"] = "Selamat Datang";    
            $d["content"] = $this->load->view("home/v_beranda",$d,TRUE);
            $d["menu"] = $this->dokumen_lib->build_menu();
            $this->load->view("v_backend",$d);
        } else {
            $d["title"] = "Login";
            $d["content"] = $this->load->view('v_login','',true);
            $this->load->view('v_template', $d);
        }
    }
}
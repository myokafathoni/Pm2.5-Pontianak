<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu extends CI_Controller {

	var $table 		   = 'menu';
	var $primary_field =  "kode_menu";
    public function  __construct() {
        parent::__construct();
        $_idmenu = 'M0021';
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
		$this->load->model('model_crud','mc');
    }
    public function index() {
        $this->lists();
    }
    public function lists() {
        $data['home']     = base_url().'menu';
        $data['modul'] 	  = 'Menu';
        $data['title'] 	  = 'List Data Menu';
        $data['subtitle'] = 'Menu';
        $data['link_add'] = 'menu/add/';
		$id_table		  = 'menu';
		$url_json		  = base_url().'menu/data';
		$data['js_dtbl']  = $this->mc->js_datatables($id_table,$url_json,5);
        $data["menu"] 	  = $this->dokumen_lib->build_menu();
        $data["id_table"] = $id_table;
        $data['content']  = $this->load->view('menu/list', $data, TRUE);
        $data["content"]  = $this->load->view("v_backend", $data);
    }
  	public function data()
	{
		$cols		= array("kode_menu","nama_menu","kode_parent");
		$tables		= "menu";
		$id			= "kode_menu";
		$urldel 	= base_url()."menu/delete/";
		$urledit	= base_url()."menu/edit/";
		$this->mc->getTable($tables,$cols,$id,$urledit,$urldel);
	}  
    public function add() {
		$data['home'] = base_url().'menu';
		$data['modul'] = 'Management Data Menu';
        $data["title"] = "List";
        $data["subtitle"] = "Tambah ";
        $data['act'] = 'menu/add_act';
        $data["menu"] = $this->dokumen_lib->build_menu();
        $data["content"] 	= $this->load->view("menu/add", $data, true);
        $data["content"] 	= $this->load->view("v_backend", $data);
    }

    public function edit($id) {
	
        $hasil = $this->mc->getById($id,$this->primary_field,$this->table);
        $hasil = $hasil->result();
		$data['home'] 		= base_url().'menu';
		$data['modul'] 		= 'Management Data Menu';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Edit";
		$data["block"] 		= "readonly";
		$data['act'] 		= 'menu/edit_act/'.$id;
        $data["data"] 		= array(
								"kode_menu"  	=> $hasil[0]->kode_menu,
								"nama_menu"      => $hasil[0]->nama_menu
							  );
        $data["menu"] 		= $this->dokumen_lib->build_menu();
        $data['content'] 	= $this->load->view('menu/add', $data, TRUE);
        $this->load->view('v_backend', $data);
		
    }

    public function delete($id)
    {
        $this->mc->delete($id,  $this->primary_field, $this->table);
        redirect('menu', 'refresh');	
    }

    public function add_act() {
	
        $kode_menu 			= $this->input->post('kode_menu', TRUE);
        $nama_menu 			= $this->input->post('nama_menu', TRUE);
		$data						= array();
        $data['kode_menu'] 	= $kode_menu;
        $data['nama_menu'] 	= $nama_menu;
        $this->mc->insert($this->table,$data);
        redirect('menu', 'refresh');
    }

    public function edit_act($id) {
        $name_menu  = $this->input->post('nama_menu', TRUE);
		$data 		  	  = array('nama_menu' => $name_menu);
		$this->mc->update($id, $this->primary_field,$this->table, $data);
        redirect('menu', 'refresh');
    }
    
}
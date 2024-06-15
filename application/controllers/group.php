<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class group extends CI_Controller {

	var $table 		   = 'group';
	var $primary_field =  "kode_group";
    public function  __construct() {
        parent::__construct();
        $_idmenu = 'M0004';
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
		$this->load->model('model_crud','mc');
    }
    public function index() {
        $this->lists();
    }
    public function lists() {
        $data['home']     = base_url().'group';
        $data['modul'] 	  = 'Group';
        $data['title'] 	  = 'List Data Group';
        $data['subtitle'] = 'Group';
        $data['link_add'] = 'group/add/';
		$id_table		  = 'group';
		$url_json		  = base_url().'group/data';
		$data['js_dtbl']  = $this->mc->js_datatables($id_table,$url_json,5);
        $data["menu"] 	  = $this->dokumen_lib->build_menu();
        $data["id_table"] = $id_table;
        $data['content']  = $this->load->view('group/list', $data, TRUE);
        $data["content"]  = $this->load->view("v_backend", $data);
    }
  	public function data()
	{
		$cols		= array("kode_group","nama_group");
		$tables		= "group";
		$id			= "kode_group";
		$urldel 	= base_url()."group/delete/";
		$urledit	= base_url()."group/edit/";
		$this->mc->getTable($tables,$cols,$id,$urledit,$urldel);
	}  
    public function add() {
		$data['home'] 		= base_url().'group';
		$data['modul'] 		= 'Management Data Group';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Tambah ";
        $data['act'] 		= 'group/add_act';
        $data["menu"] 		= $this->dokumen_lib->build_menu();
        $data["content"] 	= $this->load->view("group/add", $data, true);
        $data["content"] 	= $this->load->view("v_backend", $data);
    }

    public function edit($id) {
	
        $hasil = $this->mc->getById($id,$this->primary_field,$this->table);
        $hasil = $hasil->result();
		$data['home'] 		= base_url().'group';
		$data['modul'] 		= 'Management Data Group';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Edit";
		$data["block"] 		= "readonly";
		$data['act'] 		= 'group/edit_act/'.$id;
        $data["data"] 		= array(
								"kode_group"  => $hasil[0]->kode_group,
								"nama_group"  => $hasil[0]->nama_group
							  );
        $data["menu"] 		= $this->dokumen_lib->build_menu();
        $data['content'] 	= $this->load->view('group/add', $data, TRUE);
        $this->load->view('v_backend', $data);
		
    }

    public function delete($id)
    {
        $this->mc->delete($id,  $this->primary_field, $this->table);
        redirect('group', 'refresh');	
    }

    public function add_act() {
	
        $kode_group 			= $this->input->post('kode_group', TRUE);
        $nama_group 			= $this->input->post('nama_group', TRUE);
		$data					= array();
        $data['kode_group'] 	= $kode_group;
        $data['nama_group'] 	= $nama_group;
        $this->mc->insert($this->table,$data);
        redirect('group', 'refresh');
    }

    public function edit_act($id) {
        $name_group  = $this->input->post('nama_group', TRUE);
		$data 		  	  = array('nama_group' => $name_group);
		$this->mc->update($id, $this->primary_field,$this->table, $data);
        redirect('group', 'refresh');
    }
    
}
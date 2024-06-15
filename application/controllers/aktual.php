<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aktual extends CI_Controller {

	var $table 		   = 'actual';
	var $primary_field =  "id";
    public function  __construct() {
        parent::__construct();
        $_idmenu = 'M0002';
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
		$this->load->model('model_crud','mc');
    }
    public function index() {
        $this->lists();
    }
    public function lists() {
        $data['home']     = base_url().'aktual';
        $data['modul'] 	  = 'Aktual';
        $data['title'] 	  = 'Rincian Data Aktual';
        $data['subtitle'] = 'Aktual';
        $data['link_add'] = 'aktual/add/';
		$id_table		  = 'aktual';
		$url_json		  = base_url().'aktual/data';
		$data['js_dtbl']  = $this->mc->js_datatables($id_table,$url_json,5);
        $data["menu"] 	  = $this->dokumen_lib->build_menu();
        $data["id_table"] = $id_table;
        $data['content']  = $this->load->view('aktual/list', $data,true);
        $data["content"]  = $this->load->view("v_backend", $data);
    }
  	public function data()
	{
		$cols		= array("id","waktu","nilai");
		$tables		= "actual";
		$id			= "id";
		$urldel 	= base_url()."aktual/delete/";
		$urledit	= base_url()."aktual/edit/";
		$this->mc->getTable($tables,$cols,$id,$urledit,$urldel);
	}  
    public function add() {
		$data['home'] 		= base_url().'aktual';
		$data['modul'] 		= 'Management Data Aktual';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Tambah ";
        $data['act'] 		= 'aktual/add_act';
        $data["menu"] 		= $this->dokumen_lib->build_menu();
        $data["content"] 	= $this->load->view("aktual/add", $data, true);
        $data["content"] 	= $this->load->view("v_backend", $data);
    }
	
    public function edit($id) {
	
        $hasil = $this->mc->getById($id,$this->primary_field,$this->table);
        $hasil = $hasil->result();
		$data['home'] 		= base_url().'aktual';
		$data['modul'] 		= 'Management Data Aktual';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Edit";
		$data["block"] 		= "readonly";
		$data['act'] 		= 'aktual/edit_act/'.$id;
        $data["data"] 		= array(
								"id"  => $hasil[0]->id,
								"waktu"  => $hasil[0]->waktu,
								"nilai"  => $hasil[0]->nilai
							  );
        $data["menu"] 		= $this->dokumen_lib->build_menu();
        $data['content'] 	= $this->load->view('aktual/add', $data, TRUE);
        $this->load->view('v_backend', $data);
		
    }

    public function delete($id)
    {
        $this->mc->delete($id,  $this->primary_field, $this->table);
        redirect('aktual', 'refresh');	
    }

    public function add_act() {
		$row			= $this->db->query('select max(id)+1 as id from actual limit 1')->row_array();
        $id 			= $row['id'];
        $waktu 			= $this->input->post('waktu', TRUE);
        $nilai 			= $this->input->post('nilai', TRUE);
		$data			= array();
        $data['id'] 	= $id;
        $data['waktu'] 	= $waktu;
        $data['nilai'] 	= $nilai;
		if($this->mc->isExist($id,$this->primary_field,$this->table))
		{
			echo "<script>alert('ID actual $id SUDAH ADA !!');window.history.back();</script>";
		}
		else
		{
        $this->mc->insert($this->table,$data);
        redirect('aktual', 'refresh');
		}
    }

    public function edit_act($id) {
        $waktu  	 	= $this->input->post('waktu', TRUE);
		$nilai 			= $this->input->post('nilai', TRUE);
		$data			= array();
        $data['waktu'] 	= $waktu;
        $data['nilai'] 	= $nilai;
		$this->mc->update($id, $this->primary_field,$this->table, $data);
        redirect('aktual', 'refresh');
    }
    
}
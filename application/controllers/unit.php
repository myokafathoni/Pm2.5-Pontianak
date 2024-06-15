<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unit extends CI_Controller {

	var $table 		   = 'unit';
	var $primary_field =  "kode_unit";
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
        $data['home']     = base_url().'unit';
        $data['modul'] 	  = 'Unit';
        $data['title'] 	  = 'List Data Unit';
        $data['subtitle'] = 'Unit';
        $data['link_add'] = 'unit/add/';
		$id_table		  = 'unit';
		$url_json		  = base_url().'unit/data';
		$data['js_dtbl']  = $this->mc->js_datatables($id_table,$url_json,10);
        $data["menu"] 	  = $this->dokumen_lib->build_menu();
        $data["id_table"] = $id_table;
        $data['content']  = $this->load->view('unit/list', $data, TRUE);
        $data["content"]  = $this->load->view("v_backend", $data);
    }
  	public function data()
	{
		$cols		= array("kode_unit","nama_unit");
		$tables		= "unit";
		$id			= "kode_unit";
		$urldel 	= base_url()."unit/delete/";
		$urledit	= base_url()."unit/edit/";
		$this->mc->getTable($tables,$cols,$id,$urledit,$urldel);
	}  
    public function add() {
		$data['home'] = base_url().'unit';
		$data['modul'] = 'Management Data Unit';
        $data["title"] = "List";
        $data["subtitle"] = "Tambah ";
        $data['act'] = 'unit/add_act';
        $data["menu"] = $this->dokumen_lib->build_menu();
        $data["content"] 	= $this->load->view("unit/add", $data, true);
        $data["content"] 	= $this->load->view("v_backend", $data);
    }

    public function edit($id) {
	
        $hasil = $this->mc->getById($id,$this->primary_field,$this->table);
        $hasil = $hasil->result();
		$data['home'] 		= base_url().'unit';
		$data['modul'] 		= 'Management Data Unit';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Edit";
		$data["block"] 		= "readonly";
		$data['act'] 		= 'unit/edit_act/'.$id;
        $data["data"] 		= array(
								"kode_unit"  	=> $hasil[0]->kode_unit,
								"nama_unit"     => $hasil[0]->nama_unit,
								"parent"     => $hasil[0]->parent,
								"status_terima_surat_internal"      => $hasil[0]->status_terima_surat_internal,
								"status_terima_surat_eksternal"     => $hasil[0]->status_terima_surat_eksternal
								
							  );
        $data["menu"] 		= $this->dokumen_lib->build_menu();
        $data['content'] 	= $this->load->view('unit/add', $data, TRUE);
        $this->load->view('v_backend', $data);
		
    }

    public function delete($id)
    {
        $this->mc->delete($id,  $this->primary_field, $this->table);
        redirect('unit', 'refresh');	
    }

    public function add_act() {
	
        $kode_unit 			= $this->input->post('kode_unit', TRUE);
        $nama_unit 			= $this->input->post('nama_unit', TRUE);
        $parent 			= $this->input->post('parent', TRUE);
		$data						= array();
        $data['kode_unit'] 	= $kode_unit;
        $data['nama_unit'] 	= $nama_unit;
        $data['parent'] 	= $parent;
		$status_terima_surat_internal 		= $this->input->post('status_terima_surat_internal', TRUE);
		$status_terima_surat_eksternal 		= $this->input->post('status_terima_surat_eksternal', TRUE);
		$data['status_terima_surat_internal'] 		= ($status_terima_surat_internal=='on') ? 1 :0;
		$data['status_terima_surat_eksternal'] 		= ($status_terima_surat_eksternal=='on') ? 1 :0;
        $this->mc->insert($this->table,$data);
        redirect('unit', 'refresh');
    }

    public function edit_act($id) {
        $nama_unit 			= $this->input->post('nama_unit', TRUE);
        $parent 			= $this->input->post('parent', TRUE);
		$data				= array();
        $data['nama_unit'] 	= $nama_unit;
        $data['parent'] 	= $parent;
		$status_terima_surat_internal 		= $this->input->post('status_terima_surat_internal');
		$status_terima_surat_eksternal 		= $this->input->post('status_terima_surat_eksternal');
		$data['status_terima_surat_internal'] 		= ($status_terima_surat_internal=='on') ? 1 : 0;
		$data['status_terima_surat_eksternal'] 		= ($status_terima_surat_eksternal=='on') ? 1 : 0;
		$this->mc->update($id, $this->primary_field,$this->table, $data);
        redirect('unit', 'refresh');
    }
    
}
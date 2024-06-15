<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

	var $table 		   = 'user';
	var $primary_field =  "username";
    public function  __construct() {
        parent::__construct();
        $_idmenu = 'M0022';
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
		$this->load->model('model_crud','mc');
    }
    public function index() {
        $this->lists();
    }
    public function lists() {
        $data['home']     = base_url().'user';
        $data['modul'] 	  = 'User';
        $data['title'] 	  = 'List Data User';
        $data['subtitle'] = 'User';
        $data['link_add'] = 'user/add/';
		$id_table		  = 'user';
		$url_json		  = base_url().'user/data';
		$data['js_dtbl']  = $this->mc->js_datatables($id_table,$url_json,5);
        $data["menu"] 	  = $this->dokumen_lib->build_menu();
        $data["id_table"] = $id_table;
        $data['content']  = $this->load->view('user/list', $data, TRUE);
        $data["content"]  = $this->load->view("v_backend", $data);
    }
  	public function data()
	{
		$cols		= array("username","nama","telp","nama_group");
		$tables		= "(
						select * from `user`
						natural join `group` 
					   ) as a";
		$id			= "username";
		$urldel 	= base_url()."user/delete/";
		$urledit	= base_url()."user/edit/";
		$this->mc->getTable($tables,$cols,$id,$urledit,$urldel);
	}  
    public function add() {
		$data['home'] 		= base_url().'user';
		$data['modul'] 		= 'Management Data User';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Tambah ";
        $data['act']   		= 'user/add_act';
        $data["menu"] 		= $this->dokumen_lib->build_menu();
		$data["group"] 		= $this->mc->getAll('group');
        $data["content"] 	= $this->load->view("user/add", $data, true);
        $data["content"] 	= $this->load->view("v_backend", $data);
    }

    public function edit($id) {
	
        $hasil = $this->db->query("
							SELECT
							user.username
							, user.nama
							, user.telp
							, user.email
							, user.password
							, group.kode_group
							, group.nama_group
							FROM
							user
							INNER JOIN `group` 
								ON (user.kode_group = group.kode_group)
							where
							user.username='".$id."'
						");
        $hasil = $hasil->row();
		$data['home'] 		= base_url().'user';
		$data['modul'] 		= 'Management Data User';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Edit";
		$data["block"] 		= "readonly";
		$data['act'] 		= 'user/edit_act/'.$id;
        $data["data"] 		= array();
        $data['data']['username'] 	   	   = $hasil->username;
        $data['data']['nama'] 	   	   	   = $hasil->nama;
		$data['data']['password']  		   = $hasil->password;
		$data['data']['email']     		   = $hasil->email;
		$data['data']['telp']      		   = $hasil->telp;
		$data['data']['kode_group']        = $hasil->kode_group;
		$data['data']['nama_group']        = $hasil->nama_group;
        $data["menu"] 		= $this->dokumen_lib->build_menu();
		$data["group"] 		= $this->mc->getAll('group');
        $data['content'] 	= $this->load->view('user/add', $data, TRUE);
        $this->load->view('v_backend', $data);
		
    }

    public function delete($id)
    {
        $this->mc->delete($id,  $this->primary_field, $this->table);
        redirect('user', 'refresh');	
    }

    public function add_act() {
	
        $username 	  	   = $this->input->post('username', TRUE);
        $nama  	  		   = $this->input->post('nama', TRUE);
        $password  	  	   = $this->input->post('password', TRUE);
        $email	  	  	   = $this->input->post('email', TRUE);
        $telp	  	  	   = $this->input->post('telp', TRUE);
        $kode_group	   	   = $this->input->post('kode_group', TRUE);
		$data			 		   = array();
		$data['username'] 	   	   = $username;
		$data['nama'] 	   		   = $nama;
		$data['password']  		   = $password;
		$data['email']     		   = $email;
		$data['telp']      		   = $telp;
		$data['kode_group']        = $kode_group;
        $this->mc->insert($this->table,$data);
        redirect('user', 'refresh');
    }

    public function edit_act($id) {
        $nama  	  		   = $this->input->post('nama', TRUE);
        $password  	  	   = $this->input->post('password', TRUE);
        $email	  	  	   = $this->input->post('email', TRUE);
        $telp	  	  	   = $this->input->post('telp', TRUE);
        $kode_group	   	   = $this->input->post('kode_group', TRUE);
		$data			 		   = array();
		$data['nama'] 	   		   = $nama;
		$data['password']  		   = $password;
		$data['email']     		   = $email;
		$data['telp']      		   = $telp;
		$data['kode_group']        = $kode_group;
		$this->mc->update($id, $this->primary_field,$this->table, $data);
        redirect('user', 'refresh');
    }
    
}
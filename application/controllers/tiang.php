<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiang extends CI_Controller {

	var $table 		   = 'tiang';
	var $primary_field =  "kode_tiang";
    public function  __construct() {
        parent::__construct();
        $_idmenu = 'M0003';
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
		$this->load->model('model_crud','mc');
    }
    public function index() {
        $this->lists();
    }
    public function lists() {
        $data['home']     = base_url().'tiang';
        $data['modul'] 	  = 'Tiang';
        $data['title'] 	  = 'List Data Tiang';
        $data['subtitle'] = 'Tiang';
        $data['link_add'] = 'tiang/add/';
		$id_table		  = 'tiang';
		$url_json		  = base_url().'tiang/data';
		$hidden 		  = "oTable.fnSetColumnVis( 5, false );";
		$data['js_dtbl']  = $this->mc->js_datatables($id_table,$url_json,5,'',$hidden);
        $data["menu"] 	  = $this->dokumen_lib->build_menu();
        $data["id_table"] = $id_table;
        $data['content']  = $this->load->view('tiang/list', $data, TRUE);
        $data["content"]  = $this->load->view("v_backend", $data);
    }
  	public function data()
	{
		$cols		= array("kode_tiang","nama_tiang","nama_penyulang","latitude","longitude","foto");
		$tables		= "(select j.kode_tiang,j.nama_tiang,u.nama_penyulang,j.latitude,j.longitude,j.foto from tiang j join penyulang u
                       on j.kode_penyulang=u.kode_penyulang) as a";
		$id			= "kode_tiang";
		$urldel 	= base_url()."tiang/delete/";
		$urledit	= base_url()."tiang/edit/";
		$urledit	= base_url()."tiang/edit/";
		$urlfile	= "foto";
		$this->mc->getTable($tables,$cols,$id,$urledit,$urldel,$urlfile);
	}  
    public function add() 
	{
		$data['home'] 		= base_url().'tiang';
		$data['modul'] 		= 'Management Data Tiang';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Tambah ";
        $data['act']   		= 'tiang/add_act';
        $data["menu"] 		= $this->dokumen_lib->build_menu();
		$data["penyulang"] 	= $this->mc->getAll('penyulang');
        $data["content"] 	= $this->load->view("tiang/add", $data, true);
        $data["content"] 	= $this->load->view("v_backend", $data);
    }

    public function edit($id) {
	
        $hasil = $this->mc->getById($id,$this->primary_field,$this->table);
        $hasil = $hasil->result_array();
		$data['home'] 		= base_url().'tiang';
		$data['modul'] 		= 'Management Data Tiang';
        $data["title"] 		= "List";
        $data["subtitle"] 	= "Edit";
		$data["block"] 		= "readonly";
		$data['act'] 		= 'tiang/edit_act/'.$id;
        $data["data"] 		= array(
								"kode_tiang"  	  => $hasil[0]['kode_tiang'],
								"nama_tiang"      => $hasil[0]['nama_tiang'],
								"kode_penyulang"  => $hasil[0]['kode_penyulang'],
								"latitude"  	  => $hasil[0]['latitude'],
								"longitude"  	  => $hasil[0]['longitude']
							  );
        $data["menu"] 		= $this->dokumen_lib->build_menu();
		$data["penyulang"] 	= $this->mc->getAll('penyulang');
        $data['content'] 	= $this->load->view('tiang/add', $data, TRUE);
        $this->load->view('v_backend', $data);
		
    }

    public function delete($id)
    {
        $this->mc->delete($id,  $this->primary_field, $this->table);
        redirect('tiang', 'refresh');	
    }

    public function add_act() {
	
        $kode_tiang 			= $this->input->post('kode_tiang', TRUE);
        $nama_tiang 			= $this->input->post('nama_tiang', TRUE);
        $kode_penyulang 		= $this->input->post('kode_penyulang', TRUE);
        $latitude 				= $this->input->post('latitude', TRUE);
        $longitude 				= $this->input->post('longitude', TRUE);
		$data					= array();
        $data['kode_tiang'] 	= $kode_tiang;
        $data['nama_tiang'] 	= $nama_tiang;
        $data['kode_penyulang'] = $kode_penyulang;
        $data['latitude'] 		= $latitude;
        $data['longitude'] 		= $longitude;
		$filenya 					= '';
        $config['upload_path'] 		= './assets/files/';
        $config['allowed_types'] 	= 'gif|jpg|png|jpeg';
        $config['file_name'] 		= date("Y_m_d_h_i_s",strtotime("now")).'_uid_'.$this->session->userdata("username");
        $config['max_size'] 		= '1000000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto')) 
		{
			echo "<script>alert('File Belum di pilih !');window.history.back();</script>";
        } 
		else 
		{
		$files 				= array('upload_data' => $this->upload->data());
		$file 				= $files['upload_data']['file_name'];
		$nama 				= $files['upload_data']['raw_name'];
		$type 				= $files['upload_data']['file_type'];
		$data['foto'] 		= $file;
		$this->mc->insert($this->table,$data);
		}
        redirect('tiang', 'refresh');
    }

    public function edit_act($id) {
        $name_tiang  				= $this->input->post('nama_tiang', TRUE);
        $kode_penyulang     		= $this->input->post('kode_penyulang', TRUE);
        $latitude 					= $this->input->post('latitude', TRUE);
        $longitude 					= $this->input->post('longitude', TRUE);
		$data						= array();
		$data['nama_tiang'] 		= $name_tiang;
		$data['kode_penyulang'] 	= $kode_penyulang;
        $data['latitude'] 			= $latitude;
        $data['longitude'] 			= $longitude;
		$filenya 					= '';
        $config['upload_path'] 		= './assets/files/';
        $config['allowed_types'] 	= 'gif|jpg|png|jpeg';
        $config['file_name'] 		= date("Y_m_d_h_i_s",strtotime("now")).'_uid_'.$this->session->userdata("username");
        $config['max_size'] 		= '1000000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto')) 
		{
			$this->mc->update($id, $this->primary_field,$this->table, $data);
        } 
		else 
		{
		$files 				= array('upload_data' => $this->upload->data());
		$file 				= $files['upload_data']['file_name'];
		$nama 				= $files['upload_data']['raw_name'];
		$type 				= $files['upload_data']['file_type'];
		$data['foto'] 		= $file;
		$this->mc->update($id, $this->primary_field,$this->table, $data);
		}
        redirect('tiang', 'refresh');
    }
    
}
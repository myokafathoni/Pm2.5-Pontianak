<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class aksesmenu extends CI_Controller {

	var $table 		   = 'aksesmenu';
	var $primary_field =  "kode_aksesmenu";
    public function  __construct() {
        parent::__construct();
        $_idmenu = 'M0019';
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
		$this->load->model('model_crud','mc');
    }
    public function index() {
        $this->edit();
    }
	function simpan(){ 
	$nilai		=$this->input->post('nilai');
	$tipe		=$this->input->post('tipe');
	$kode_group	=$this->input->post('kode_group');
	$kode_menu	=$this->input->post('kode_menu');
	$kode_parent	=$this->input->post('kode_parent');
	if($tipe=="menu")
	{
	$this->db->query('delete from akses_menu where kode_menu="'.$kode_menu.'" and kode_group="'.$kode_group.'"');
	$this->db->query('delete from akses_menu where kode_menu in (select kode_menu from menu where kode_parent="'.$kode_menu.'") and kode_group="'.$kode_group.'"');
	if($nilai=="true")
	{
	$this->db->query('insert into akses_menu(kode_menu,kode_group) values("'.$kode_menu.'","'.$kode_group.'")');
	$this->db->query('insert into akses_menu(kode_menu,kode_group) 
	select kode_menu,"'.$kode_group.'" as kode_group from menu where kode_parent="'.$kode_menu.'"');
	if($kode_parent!="0")
	{
	$this->db->query('delete from akses_menu where kode_menu="'.$kode_parent.'" and kode_group="'.$kode_group.'"');
	$this->db->query('insert into akses_menu(kode_menu,kode_group) values("'.$kode_parent.'","'.$kode_group.'")');
	}
	echo "ok";
	}
	}
	else
	{
	echo "ok";
	}	
	
	}
	function edit(){ 
		$data['home'] = base_url().'akses';
        $data['modul'] = 'Management Akses Menu';
        $data["title"] = "List Akses Menu";
        $data["subtitle"] = "Edit Akses Menu";
		$data['act'] = 'akses/edit_act/';
		$kode_group=$this->uri->segment(3) ? $this->uri->segment(3) : $this->session->userdata('kode_group');
		$sqlgroup = $this->db->query("select kode_group,nama_group,case when kode_group='$kode_group' then 'selected' else ''  end as cek from `group`");

		$sql = $this->db->query("
								select '$kode_group' as kode_group,m.kode_menu,case when am.id_akses_menu is not null 
								then 'checked' else '' end as value,
								case when kode_parent='0' then ''
								else concat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')
								end as space,m.nama_menu,m.kode_parent
								,am.id_akses_menu from menu m left join
								akses_menu am
								on (m.kode_menu=am.kode_menu and kode_group='$kode_group')
							  ");
								
					
		$data['result'] = $sql->result_array();
		$data['title']  = "Akses Menu";
		
		$data['rgroup'] = $sqlgroup->result_array();
		$data['output'] = 
		//$this->parser->parse('admin.php',$this->data);
		
		$data["menu"] 		= $this->dokumen_lib->build_menu();
        $data['content'] 	= $this->parser->parse('aksesmenu/group_view.php',$data,true);
        $this->load->view('v_backend', $data);
		
	}
    
}
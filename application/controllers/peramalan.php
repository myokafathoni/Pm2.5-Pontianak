<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peramalan extends CI_Controller {

	var $table 		   = 'peramalan';
	var $primary_field =  "kode_peramalan";
    public function  __construct() {
        parent::__construct();
        $_idmenu = 'M0003';
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
		$this->load->model('model_crud','mc');
		$this->data['base_url'] = base_url();
		$this->data['css'] 		= array();
		$this->data['js'] 		= array();
    }
    public function index() {
        $this->lists();
    }
    public function lists() {
        $data['home']     = base_url().'peramalan';
        $data['modul'] 	  = 'Prediksi';
        $data['title'] 	  = 'Rincian Data Prediksi';
        $data['subtitle'] = 'Prediksi';
        $data['link_add'] = 'peramalan/execute/';
		$id_table		  = 'peramalan';
		$url_json		  = base_url().'peramalan/data';
		$data['js_dtbl']  = $this->mc->js_datatables($id_table,$url_json,20);
        $data["menu"] 	  = $this->dokumen_lib->build_menu();
        $data["id_table"] = $id_table;
        $data['content']  = $this->load->view('peramalan/list', $data, TRUE);
        $data["content"]  = $this->load->view("v_backend", $data);
    }
  	public function data()
	{
		$cols		= array("id","waktu","nilai");
		$tables		= "hasil";
		$id			= "id";
		$this->mc->getTable($tables,$cols,$id,'','','','');
	}
	public function grafik()
	{
		$output = $this->db->query("						
									
									select CONCAT(' \" ',CAST(DATE_FORMAT(coalesce(a.waktu,h.waktu),'%d-%m-%Y %h:%i') AS CHAR),' \" ') as titik,coalesce(a.nilai,0) as kode1 ,coalesce(h.nilai,0) as kode2 
									from actual a
									left join hasil h
									on (h.waktu=a.waktu)
									union 
									select CONCAT(' \" ',CAST(DATE_FORMAT(coalesce(a.waktu,h.waktu),'%d-%m-%Y %h:%i') AS CHAR),' \" ') as titik,coalesce(a.nilai,0) as kode1 ,coalesce(h.nilai,0) as kode2 
									from actual a
									right join hasil h
									on (h.waktu=a.waktu)
								
								")->result_array();
								
								
        $data['home']     = base_url().'peramalan';
        $data['modul'] 	  = 'Grafik Hasil Prediksi';
        $data['title'] 	  = 'Grafik Hasil Prediksi';
        $data['subtitle'] = 'Grafik Hasil Prediksi';
        $data['link_add'] = 'peramalan/execute/';
		$id_table		  = 'peramalan';
		$url_json		  = base_url().'peramalan/data';
		$data['js_dtbl']  = $this->mc->js_datatables($id_table,$url_json,20);
        $data["menu"] 	  = $this->dokumen_lib->build_menu();
        $data["output"] = $output;
        $data["id"] ='21';
        $data['content']  = $this->load->view('peramalan/chart',$data,true);
        $data["content"]  = $this->load->view("v_backend", $data);								
								
								
		
	}	
	public function execute()
	{
		$this->db->query("delete from hasil");
		$hasil = $this->db->query("
								insert into hasil
								select @c:=@c+1 as id,coalesce(waktu,(select DATE_ADD(waktu,interval 2 hour) from actual order by id desc limit 1)) as waktu,nilai from 
								(
								select b.waktu,sum(e.midpoint*(d.jumlah/f.total)) as nilai from actual a
								left join
								actual b
								on (a.id=b.id-1)
								left join 
								vi c
								on (a.nilai BETWEEN c.min and c.max) 
								left join bobotrelasi d
								on (d.a=c.i)
								left join 
								vi e
								on (e.i=d.a_rel) 
								left join (select a,sum(jumlah) as total from bobotrelasi group by a) f
								on (f.a=c.i) 
								group by b.waktu
								)
								as a
								join (select @c:=0) r
								order by waktu	
							   ");
				
			
			redirect('peramalan');
	
	}
}
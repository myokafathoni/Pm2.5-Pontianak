<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan extends CI_Controller {

	var $table 		   = "surat";
	var $primary_field = "no_surat";
    public function  __construct() {
        parent::__construct();
        $_idmenu = 'M0002';
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
		$this->load->model('model_crud','mc');
    }
    public function index() {
        $this->add();
    }
    public function lapmasuk() 
	{
		$data['home'] 				= base_url().'surat/add';
		$data['modul'] 				= 'Laporan Surat Eksternal';
        $data["title"] 				= "Cetak Laporan";
        $data["subtitle"] 			= "Laporan Arsip Surat Eksternal";
        $data['act'] 				= 'laporan/cetak_surat_masuk';
        $data["menu"] 				= $this->dokumen_lib->build_menu();
        $data["content"] 			= $this->load->view("laporan/form", $data, true);
        $data["content"] 			= $this->load->view("v_backend", $data);
    }
    public function lapkeluar() 
	{
		$data['home'] 				= base_url().'surat/add';
		$data['modul'] 				= 'Laporan Surat Internal';
        $data["title"] 				= "Cetak Laporan";
        $data["subtitle"] 			= "Laporan Arsip Surat Internal";
        $data['act'] 				= 'laporan/cetak_surat_keluar';
        $data["menu"] 				= $this->dokumen_lib->build_menu();
        $data["content"] 			= $this->load->view("laporan/form", $data, true);
        $data["content"] 			= $this->load->view("v_backend", $data);
    }
	function cetak_surat_keluar(){
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$type = $this->input->post('type');
		$this->data['tgl1']=$tgl1;
		$this->data['tgl2']=$tgl2;
		$this->db->query("SET @n=0;");
		$query=$this->db->query("							
								select * from daftarsuratkeluar where tglsurat >= '$tgl1' and tglsurat <= '$tgl2' 
								
								");
		$this->data['result']=$query->result_array();
		$num = $query->num_rows();
		if($num > 0)
		{
			for($i=0;$i<$num;$i++)
			{
			$this->data['result'][$i]['no']=$i+1;
			}
		}
		$html = $this->parser->parse('laporan/cetak',$this->data,true);
		
		if($type=='Excel'){
			header('Content-type: application/vnd.ms-excel');
			header("Content-Disposition: attachment; filename=cetak.xls");
			header("Pragma: no-cache");
			header("Expires: 0"); 
			echo $html;
		}
		else
		{
		ini_set('memory_limit','1024M');
		ob_start();
		include_once APPPATH.'/third_party/pdf/mpdf.php';
		$pdf = & new mPDF('','A4-L','','',15,15,25,25,10,10);
		
		$pdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
		$pdf->defaultheaderfontsize = 8;	/* in pts */
		$pdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
		$pdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
		$pdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
		$pdf->defaultfooterfontsize = 9;	/* in pts */
		$pdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */
		

		//$pdf->SetHTMLHeader();
		$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_end_clean();
		//	echo $string_to_print;
		die();
		}
	}
	function cetak_surat_masuk(){
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$type = $this->input->post('type');
		$this->data['tgl1']=$tgl1;
		$this->data['tgl2']=$tgl2;
		$this->db->query("SET @n=0;");
		$query=$this->db->query("							
								select * from daftarsuratmasuk where tglsurat >= '$tgl1' and tglsurat <= '$tgl2' 
								
								");
		$this->data['result']=$query->result_array();
		$num = $query->num_rows();
		if($num > 0)
		{
			for($i=0;$i<$num;$i++)
			{
			$this->data['result'][$i]['no']=$i+1;
			}
		}
		$html = $this->parser->parse('laporan/cetak',$this->data,true);
		
		if($type=='Excel'){
			header('Content-type: application/vnd.ms-excel');
			header("Content-Disposition: attachment; filename=cetak.xls");
			header("Pragma: no-cache");
			header("Expires: 0"); 
			echo $html;
		}
		else
		{
		ini_set('memory_limit','1024M');
		include_once APPPATH.'/third_party/pdf/mpdf.php';
		$pdf = new mPDF('','A4-L','','',15,15,25,25,10,10);
		
		$pdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
		$pdf->defaultheaderfontsize = 8;	/* in pts */
		$pdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
		$pdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
		$pdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
		$pdf->defaultfooterfontsize = 9;	/* in pts */
		$pdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */
		

		$pdf->SetHTMLHeader();
		$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
		$pdf->WriteHTML($html);
		$pdf->Output();
		//	echo $string_to_print;
		die();
		}
	}
    
}
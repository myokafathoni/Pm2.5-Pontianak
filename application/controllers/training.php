<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training extends CI_Controller {

    public function  __construct() {
        parent::__construct();
        $_idmenu = 'M0002';
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
		$this->load->model('model_crud','mc');
		$this->load->model('m_training','mt');
		$this->data['base_url'] = base_url();
		$this->data['css'] 		= array();
		$this->data['js'] 		= array();
    }
	public function index() {
	
			$data['home']     = base_url().'training';
			$data['modul'] 	  = 'PROSES PREDIKSI';
			$data['title'] 	  = 'TAHAPAN PROSES PREDIKSI';
			$data['subtitle'] = 'Pelatihan';
			$data["menu"] 	  = $this->dokumen_lib->build_menu();
			$data["content"]  = $this->tampilan();
			$data['content']  = $this->load->view('training/list', $data,true);
			$data["content"]  = $this->load->view("v_backend", $data);
	
	}
    public function tampilan() 
	{

	 //  $this->db->query("select * from actual")->result_array();
	   /*----------------------proses training---------------------*/
		//$this->execute();
	   $tampilan  =' <div style="display: block;" id="tab-1" class="tab-content">';
	   $tampilan .=' 
				   <div class="_51">
				  
				   ';
	   $rowd1d2 	= $this->mt->getd1d2(); 
	   $rowinterval = $this->mt->getInterval(); 
	   $ui 		    = $this->proses_u($rowd1d2['umin'],$rowd1d2['umax'],$rowinterval['penambah'],'ui');
	   $vi 			= $this->proses_us('vi');
	   $fs 			= $this->fuzzyset();
	   $relasi 		= $this->relasi();
	   $grelasi 	= $this->group_relasi();
	   $brelasi 	= $this->bobot_relasi();
	   $this->execute_prediksi();
	   $d1 			= $rowd1d2['d1'];
	   $d2 			= $rowd1d2['d2'];
	   $dmin 		= $rowd1d2['dmin'];
	   $umin 		= $rowd1d2['umin'];
	   $dmax 		= $rowd1d2['dmax'];
	   $umax 		= $rowd1d2['umax'];
	   $tampilan .='
		<table width="10px;">
		<tr>
		<td width="30px;"><b>Dmin</b></td>
		<td>:</td>
		<td colspan="2">'.$dmin.'</td>
		</tr>
		<tr>
		<td><b>Dmax</b></td>
		<td>:</td>
		<td colspan="2">'.$dmax.'</td>
		</tr>
		
		<tr>
		<td width="30px;"><b>D1</b></td>
		<td>:</td>
		<td colspan="2">'.$d1.'</td>
		</tr>
		<tr>
		<td><b>D2</b></td>
		<td>:</td>
		<td colspan="2">'.$d2.'</td>
		</tr>
		<tr>
		<td width="30px;"><b>U</b></td>
		<td>=</td>
		<td>['.$umin.','.$umax.']</td>
		</tr>
		</table>
		</div>
	   ';
			$tampilan .="<table style='width:40%;margin-top:10px;margin-bottom:10px;margin-right:70%;' class='table' cellpadding='3' border=1 style='border-collapse:collapse;'>";
			$tampilan .="<tr><th>Ui</th><th>Jumlah</th><!--<th>Anggota</th>--></tr>";

			foreach($ui as $row)
			{
			$tampilan .="<tr><td>U".$row['i']."=[".$row['min'].",".$row['max']."] </td><td>".$row['jumlah']."</td><!--<td>".$row['corresponden']."</td>--></tr>";
			}
			$tampilan .= "</table>";
			$tampilan .="<table style='width:40%;margin-top:10px;margin-bottom:10px;margin-right:70%;' class='table' cellpadding='3' border=1 style='border-collapse:collapse;'>";
			$tampilan .="<tr><th>Redive Ui</th><th>Nilai Tengah</th></tr>";

			foreach($vi as $row)
			{
			$tampilan .="<tr><td>U".$row['i']."=[".$row['min'].",".$row['max']."] </td><td>".$row['midpoint']." </td></tr>";
			}
			$tampilan .= "</table>";
			
			
			$tampilan .="</div>";

			
			$tampilan  .="<div style='display: none;' id='tab-2' class='tab-content'> ";
		    $tampilan .=' 
						   <div class="_51">
						   ';

						   
			$tampilan .="<table style='width:40%;margin-top:10px;margin-bottom:10px;margin-right:70%;' class='table' cellpadding='3' border=1 style='border-collapse:collapse;'>";
			$tampilan .="<tr><th>Himpunan Fuzzy</th></tr>";

			foreach($vi as $row)
			{
			$tampilan .="<tr><td>A".$row['i']."=[".$row['min'].",".$row['max']."] </td></tr>";
			}
			$tampilan .= "</table>";				   
			$tampilan .='</div>';
			
			$tampilan .="</div>";			
			//================================== tab 3 ==============================
			$tampilan  .="<div style='display: none;' id='tab-3' class='tab-content'> ";
		    $tampilan .=' 
						   <div class="_51">
						   ';

						   
			$tampilan .="<table style='width:40%;margin-top:10px;margin-bottom:10px;margin-right:70%;' class='table' cellpadding='3' border=1 style='border-collapse:collapse;'>";
			$tampilan .="<tr><th>Waktu</th><th>Aktual</th><th>Interval</th><th>Fuzzifikasi</th></tr>";
			foreach($fs as $row)
			{
			$tampilan .="<tr><td>".$row['waktu']."</td><td>".$row['nilai']."</td><td>[".$row['min'].",".$row['max']."]</td><td>A".$row['a']."</td></tr>";
			}
			$tampilan .= "</table>";				   
			$tampilan .='</div>';
			
			$tampilan .="</div>";
			
			//================================== tab 4 ==============================
			$tampilan  .="<div style='display: none;' id='tab-4' class='tab-content'> ";
		    $tampilan .='<div class="_51">';			   
			$tampilan .="<table style='width:40%;margin-top:10px;margin-bottom:10px;margin-right:70%;' class='table' cellpadding='3' border=1 style='border-collapse:collapse;'>";
			$tampilan .="<tr><th>Relasi</th></tr>";
			foreach($relasi as $row)
			{
			$tampilan .="<tr><td>A".$row['a']." -> A".$row['a_rel']."</td></tr>";
			}
			$tampilan .= "</table>";				   
			$tampilan .='</div>';
			$tampilan .="</div>";
			//================================== batas tab 4 ==============================
			
			//================================== tab 5 ==============================
			$tampilan  .="<div style='display: none;' id='tab-5' class='tab-content'> ";
		    $tampilan .='<div class="_51" style="overflow: auto;">';			   
			$tampilan .="<table style='width:100%;margin-top:10px;margin-bottom:10px;margin-right:70%;' class='table' cellpadding='3' border=1 style='border-collapse:collapse;'>";
			$tampilan .="<tr><th colspan='3'>Group Relasi</th></tr>";
			foreach($grelasi as $row)
			{
			$tampilan .="<tr><td>A".$row['a']."</td><td> -> </td><td>".$row['a_rel']."</td></tr>";
			}
			$tampilan .= "</table>";				   
			$tampilan .='</div>';			
			
			$tampilan .="</div>";
			//================================== batas tab 5 ==============================
			
			//================================== tab 6 ==============================
			$tampilan  .="<div style='display: none;' id='tab-6' class='tab-content'> ";
		    $tampilan .='<div class="_51">';			   
			$tampilan .="<table style='width:40%;margin-top:10px;margin-bottom:10px;margin-right:70%;' class='table' cellpadding='3' border=1 style='border-collapse:collapse;'>";
			$tampilan .="<tr><th>Relasi</th><th>Jumlah (Bobot)</th></tr>";
			foreach($brelasi as $row)
			{
			$tampilan .="<tr><td>A".$row['a']." -> A".$row['a_rel']."</td><td>".$row['jumlah']."</td></tr>";
			}
			$tampilan .= "</table>";				   
			$tampilan .='</div>';			
			
			$tampilan .="</div>";
			//================================== batas tab 6 ==============================
			
			
			
		return $tampilan;
    }
	public function execute()
	{
		/*
		$row = $this->db->query("select min(waktu) as minx from actual")->row_array();
		$sampai = $this->input->post('sampai');
		if($sampai!="" && $sampai > $row['minx'])
		{
		*/
		$this->db->trans_start();
		$this->db->query("delete from data");
		$this->db->query("insert into data select * from actual ");
		$this->db->trans_complete();
		redirect('training');
		/*
		}
		else
		{
		redirect('training');
		
		}
		*/
	}
	public function proses_u($min,$x,$interval,$table)
	{
		$u=array();
		$li=$min;
		$ui=0;
		$i=1;
		while(($min+($i*$interval)) <= $x)
		{
			$u[$i]['i'] = $i; 
			$li = $min+(($i-1)*$interval);
			$u[$i]['min']= $li; 
			$ui = $min+($i*$interval);
			$u[$i]['max']= $ui;
			$i++;
		}
		$this->db->query("delete from $table");
		$this->db->insert_batch($table, $u);
		return $this->db->query("select * from view_ui")->result_array();
	
	}	
	
	public function proses_us($table)
	{
		
		$this->db->query("delete from $table");
		$this->db->query("
							insert into $table
							select @c:=@c+1 as i,a.min, a.max,a.min+((a.max-a.min)/2) as midpoint from 
							(
							select va.min,va.max from view_ui va where jumlah <= (select jinterval/2 from vinterval)
							union all
							select vi.min,vi.min+((vi.max-vi.min)/2) as `max` from view_ui vi where jumlah >  (select jinterval/2 from vinterval)
							union all 
							select vu.min+((vu.max-vu.min)/2),vu.max from view_ui vu where jumlah > (select jinterval/2 from vinterval)
							)
							as a
							join (select @c:=0) r
							order by a.min 

							");
		return $this->db->query("select * from $table")->result_array();
	
	}
	public function fuzzyset()
	{
		return $this->db->query("select * from fuzzyset")->result_array();
	}
	public function relasi()
	{
		$this->db->query("delete from relasi");
		$this->db->query("
							insert into relasi 
							select @c:=@c+1 as id,i as a,'' as b from `data` d
							left join vi
							on (d.nilai BETWEEN vi.min and vi.max) 
							join (select @c:=0) r

						 ");
		$this->db->query("update relasi a join relasi b on (a.id=b.id-1) set a.a_rel=b.a");	
		return $this->db->query("select * from relasi where a_rel!=0 order by id")->result_array();
	
	}
	public function group_relasi()
	{
					return $this->db->query("select a,GROUP_CONCAT('A',a_rel order by id) as a_rel from relasi where a_rel!=0 group by a  ")->result_array();
	}
	public function bobot_relasi()
	{
				return $this->db->query("select * from bobotrelasi")->result_array();
	}
	
	public function execute_prediksi()
	{
		$this->db->query("delete from hasil");
		$hasil = $this->db->query("
								insert into hasil
								select @c:=@c+1 as id,coalesce(waktu,(select DATE_ADD(waktu,INTERVAL +60 MINUTE) from actual order by id desc limit 1)) as waktu,nilai from 
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
				
			
	
	}

}
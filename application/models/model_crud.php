<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_crud extends CI_Model {
	
	public function __construct(){
		 parent::__construct();
	}
	public function list_field($tabel){
		return $this->db->list_fields($tabel);
	} 
	
	public function list_data_fields($tabel){
		return $this->db->field_data($tabel);
	}
	
	public function insert($tabel, $data){
		return $this->db->insert($tabel, $data);
	}
	
	public function update($id, $field_id, $tabel, $data){
		$this->db->where($field_id, $id);
		return $this->db->update($tabel, $data);
	}
	
	public function delete($id, $field_id, $tabel){
		$this->db->where($field_id, $id);
		return $this->db->delete($tabel);
	}
	
	public function get_all($start,$perpage,$id,$tabel){
		$this->db->limit($perpage,$start);
		$this->db->order_by($id,'desc');
		return $this->db->get($tabel);
	}
    public function getAll($table) {
        return $this->db->get($table);
    }
	public function get_autocomplete($id,$tabel){
		$this->db->select($id);
		$this->db->order_by($id,'asc');
		return $this->db->get($tabel);
	}
	public function isExist($id,$field,$table)
	{
		$this->db->where($field,$id);
		$query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function autoNIS($cabang){
						$autonew1=0;
						$query = $this->db->query("select NIS from siswa where kode_cabang='$cabang' and year(tanggal_daftar)='".date("Y")."'  order by NIS DESC LIMIT 1");
						if ($query->num_rows() > 0)
						{
						$ret = $query->row();
						$str=explode('/',$ret->NIS);
						$autonew1 = $str[0]; 
						}
						$autonew2 = (int) $autonew1;
						$autonew3 = sprintf("%04d",$autonew2+1);
						return $autonew3."/".$cabang."/".date("Y");
	}


	public function count_result($table)
	{
		return $this->db->count_all_results($table);
	}
	
	public function searching($key,$field_1, $tabel, $limit=0, $offset=0){
		$this->db->like($field_1,$key);
		$list_header = $this->list_field($tabel);
		foreach($list_header as $row_field)
		{
			$this->db->or_like($row_field,$key);			
		}
		if($limit==0 && $offset==0){
			$count = $this->db->get($tabel);
			return $count->num_rows();
		}else{
			return $this->db->get($tabel,$limit,$offset);
		}
	}
	
	public function getById($id,$field,$table){
		$this->db->where($field,$id);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			return $query;
		}
	}	
	public function get_where($table,$array_field)
	{
		$query = $this->db->get_where($table,$array_field);		
		return $query;
	}	
	public function getTable($sTable ,$aColumns,$ids,$urledit='',$urldel='',$urlprint='',$urldetail='',$urlpeta='')
    {
        $iDisplayStart  = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 	= $this->input->get_post('iSortCol_0', true);
        $iSortingCols 	= $this->input->get_post('iSortingCols', true);
        $sSearch 		= $this->input->get_post('sSearch', true);
        $sEcho 			= $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }		
				
            }
        }
		
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                @$sSearchs[$i] = $this->input->get_post('sSearch_'.$i, true);
                if (isset($bSearchable) && $bSearchable == 'true' && $sSearchs[$i]!='')
				{
					 $this->db->like($aColumns[$i-1], $this->db->escape_like_str($sSearchs[$i]));
				}		
				
            }

		
        // Select Data
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->db->get($sTable);
    
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all($sTable);
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
			$button_del		= 'Hapus';
			$button_edit	= 'Edit';
			$button_detail	= 'Detail';
			$button_print	= 'Foto';
			$button_peta	= 'Peta';
			$act='';
            foreach($aColumns as $col)
            {
                $row[] = $aRow[$col];
            }
			if($urldetail)
			{
			 $act .= '<a href="'.$urldetail.$aRow[$ids].'" class="button blue" style="margin-bottom:10px;">'.$button_detail.'</a>&nbsp;';
			}
			if($urlpeta && $aRow[$urlpeta]!='')
			{
			 $act .= '<a href="javascript:void(0);" onclick="return peta(\''.$aRow[$urlpeta].'\');" class="button blue">'.$button_peta.'</a> ';
			}
			if($urlprint && $aRow[$urlprint]!='')
			{
			 $act .= '<a href="javascript:void(0);" onclick="return pilih(\''.$aRow[$urlprint].'\');" class="button blue">'.$button_print.'</a> ';
			}
			if($urledit)
			{
			 $act .= '<a href="'.$urledit.$aRow[$ids].'" class="button green" style="padding-bottom:5px;">'.$button_edit.'</a>&nbsp;';
			}
			if($urldel)
			{
			 $act .= '<a data-toggle="tooltip" title="hapus" href="'.$urldel.$aRow[$ids].'" onclick="return confirm(\'Apakah Anda Ingin hapus data ini ?\')" class="button red">'.$button_del.'</a>';
			}

			$row[] =$act;
            $output['aaData'][] = $row;
        }
    
        echo json_encode($output);
    }
	public function js_datatables($id_table,$url_json,$limit,$add='',$hidden='')
	{
		return	'$(document).ready(function()
				{
				var oTable=$(\'#'.$id_table.'\').dataTable({
				"oLanguage": {
				"sProcessing": "Processing... <img src=\''.base_url().'images/ajax-loader.gif\'>",
				"sZeroRecords"  : "Tidak ada entri.",
				"sInfo"         : "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
				"sInfoEmpty"    : "Menampilkan 0 - 0 dari 0 entri",
				"sInfoFiltered" : "(Disaring dari _MAX_ total entri)",
				"sInfoPostFix"  : "",
				"sSearch"       : "Pencarian",
				"sUrl"			: "",
				"oPaginate": {						
				"sFirst":    "Pertama",							
				"sPrevious": "Sebelumnya",							
				"sNext":     "Selanjutnya",							
				"sLast":     "Terakhir"
				}
				},
				"bProcessing": true,
				"bServerSide": true,
				"sServerMethod": "GET",
				"sAjaxSource": "'.$url_json.'",
				"bPaginate": true,
				"bLengthChange": true,
				"bFilter": true,
				"bSort": true,
				"bInfo": true,
				"bAutoWidth": false,
				"bSortClasses": true,			
				"bStateSave": false,
				"aaSorting": [[0, \'asc\']],
				"iDisplayLength":'.$limit.',
				"aLengthMenu": [5,10,25,50,100],
				"sPaginationType": "full_numbers"
				'.$add.'
				
				})
				'.$hidden.'
				});';	
	}
	public function paging($segment,$limits,$query,$data_name,$link,$key)
	{
		$page  = $this->uri->segment($segment);
		$limit = $limits;
		if(!$page)
		{
		$offset = 0;
		}
		else
		{
		   $offset = ($page-1)*$limit;
		}
		$config['base_url']    = $link;
		$config['total_rows']  = $this->db->query("$query")->num_rows();
		$config['per_page']    = $limit;
		$config['uri_segment'] = $segment;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#"><font color="#4D4D4D">';
		$config['cur_tag_close'] = '</font></a></li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link']  = 'Awal';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['last_link']   = 'Akhir';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['next_link']   = 'Selanjutnya';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link']   = 'Sebelumnya';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$data["paginator"]     	  = $this->pagination->create_links();
		$data[$data_name.'_entries'] = $this->db->query("$query limit $offset,$limit")->result_array();
		return $data;
	}
}

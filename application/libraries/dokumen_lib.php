<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class dokumen_lib
{
    function dokumen_lib()
    {
        $this->CI=& get_instance();

        $this->CI->load->library('session');
        $this->CI->load->helper('form');
        $this->CI->load->helper('url');
    }

    function check_login() {
        if ($this->CI->session->userdata('username')) {
            return true;
        } else {
            redirect('beranda','refresh');
            return false;
        }
    }

    function cek_wewenang_menu($menu_id) {
        $group = $this->CI->session->userdata("kode_group");
        $sql = "SELECT * FROM akses_menu WHERE kode_group = '$group' AND kode_menu = '$menu_id'";
        $res = $this->CI->db->query($sql);
        $res = $res->row();
        if ($res->kode_menu == "") {
            redirect("beranda","refresh");
            return false;
        } else {
            return true;
        }
    }

    /*function get_grup_user() {
        return $this->CI->session->userdata('grupuser');
    }*/

    function get_password($password) {
        $pass = md5($password);
        $res = $this->CI->db->query("SELECT ('$pass') AS pass");
        $res = $res->row();
        return $res->pass;
    }

    //  define createCache
    function createCache ( $content ,  $cacheFile ) {
        $cacheFile = 'cache/' . $cacheFile;
        $fp = fopen($cacheFile , 'w' );
        $content = "<!-- this is cache -->\n" . $content;
        fwrite( $fp , $content );
        fclose( $fp);
    }

    // define getCache
    function getCache ( $cacheFile ,  $expireTime ) {
        $cacheFile = 'cache/' . $cacheFile;
        if (file_exists($cacheFile) && (time() - $expireTime < filemtime($cacheFile))) {
            return file_get_contents($cacheFile);
        } else {
            return "";
        }
    }
    
    public function child_menu($id) {
		 $group = $this->CI->session->userdata("kode_group");
        $sql = "SELECT kode_menu, nama_menu, link,image, kode_parent
                FROM menu a 
                WHERE kode_parent != '0'
                AND kode_parent = '$id' and
				kode_menu IN (SELECT kode_menu FROM akses_menu WHERE kode_group = '$group')
                ";

        $res = $this->CI->db->query($sql);
	$tmp = "<ul class='sub'>";
        foreach ($res->result_array() as $mn) {
            $tmp .= "<li><a href='" .base_url().$mn['link'] . "' id='" . $mn['kode_menu'] . "'>" . $mn['nama_menu'] . "</a></li>";
            }
        $tmp .= "</ul>";
        return $tmp;
    }
    
    public function build_menu() {
        $group = $this->CI->session->userdata("kode_group");
        //$grupuser = $this->CI->session->userdata("grupuser");
        $sql = "SELECT kode_menu, nama_menu, link,image, (SELECT COUNT(*) FROM menu WHERE kode_parent = a.kode_menu) as has_child
                FROM menu a 
                WHERE kode_menu IN (SELECT kode_menu FROM akses_menu WHERE kode_group = '$group') and a.kode_parent = '0'
                ";
        
        $res = $this->CI->db->query($sql);
        
	$tmp = "<nav id='nav'><ul class=\"menu collapsible shadow-bottom\">";
	$img ="";
        foreach ($res->result_array() as $mn) {
            if ($mn["has_child"] > 0) {
			$img ="";
				if($mn['image']!="")
				{
				$img = "<img src=\"". base_url()."assets/images/".$mn['image'] ."\">";
				}
                $tmp .= "<li><a href='javascript:void(0);' id='" . $mn['kode_menu'] . "'>". $img."". $mn['nama_menu'] . "</a>";
                $tmp .= $this->child_menu($mn['kode_menu']);
                $tmp .= "</li>";
            } else {
			$img ="";
				if($mn['image']!="")
				{
				$img = "<img src=\"". base_url()."assets/images/".$mn['image'] ."\">";
				}
                $tmp .= "<li><a href='" .base_url().$mn['link'] . "' id='" . $mn['kode_menu'] . "'>". $img."". $mn['nama_menu'] . "</a></li>";
            
            }
            }
        $tmp .= "</ul></nav>";
        return $tmp;
        //$this->CI->session->set_userdata("menu", $menu);
    }

	public function getTopBerita() {
		$sql = "SELECT * FROM tbl_berita WHERE AKTIF='Y' ORDER BY ID_BERITA DESC LIMIT 0,4 ";
		$res = $this->CI->db->query($sql);
		$tmp="";
		foreach ($res->result_array() as $news) {
			$d = explode("-",substr($news['TANGGAL'],0,10));
			
			$tmp.= "<b>$news[JUDUL]</b><br />
			<font color='red'>$d[2]-$d[1]-$d[0] ".substr($news['TANGGAL'],11,8)."</font><br />
			$news[DESKRIPSI] <br />[<b>".anchor("beranda/berita/$news[ID_BERITA]","selengkapnya")."</b>]<hr />";
		}
		$tmp.= "Untuk melihat arsip berita akademik, silahkan klik link berikut [Arsip]";
		return $tmp;
    }
	
	public function getDetailBerita($id) {
		$sql = "SELECT * FROM tbl_berita WHERE ID_BERITA='$id' ";
		$res = $this->CI->db->query($sql);
		$tmp="";
		foreach ($res->result_array() as $news) {
			$d = explode("-",substr($news['TANGGAL'],0,10));
			
			$tmp.= "<b>$news[JUDUL]</b><br />
			<font color='red'>$d[2]-$d[1]-$d[0] ".substr($news['TANGGAL'],11,8)."</font><br />
			$news[ISI] ";
		}
		
		return $tmp;
    }
	
	public function getTopKalender() {
		$sql = "SELECT * FROM tbl_kalender WHERE AKTIF='Y' ORDER BY DARI ASC ";
		$res = $this->CI->db->query($sql);
		$tmp="";
		foreach ($res->result_array() as $cal) {
			if($cal['SAMPAI']==='0000-00-00'){
				$sampai = "";
			}else{
				$ds = explode("-",$cal['SAMPAI']);
				$sampai = "s.d $ds[2]-$ds[1]-$ds[0]";
			}
			$d = explode("-",$cal['DARI']);
			$tmp.= "<font color='green'>$d[2]-$d[1]-$d[0] $sampai</font><br />
			&bull; <b> $cal[NM_KEGIATAN]</b><hr />";
		}
		return $tmp;
    }
	
	public function getInfo() {
		$query=$this->CI->db->query("select NM_FAKULTAS, NM_PRODI from tbl_konfigurasi order by ID_KONF desc limit 0,1");
		return $query;
    }
	
}
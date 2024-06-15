<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_training extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->CI = get_instance();
    }
    
    public function getd1d2() {
	
		return $this->db->query("select * from d1d2 limit 1")->row_array();

    }
	public function getInterval() {
	
		return $this->db->query("select * from vinterval limit 1")->row_array();

    }
	
}
?>
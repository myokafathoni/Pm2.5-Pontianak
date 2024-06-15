<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_statis extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->_table = 'statis';
        $this->CI = get_instance();
    }
    
    public function getStatisAll() {
        $this->db->select("a.*,(select title from ".$this->_table." b where b.id = a.parent) as nama_parent");
		$this->db->from($this->_table.' a');
        return $this->db->get();
    }
	
	public function getStatisById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table);
    }

    public function insertStatis($data) {
        $this->db->insert($this->_table, $data);
    }

    public function deleteStatis($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
    }

    public function updateStatis($where, $data) {
        $this->db->where($where);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
	
}
?>

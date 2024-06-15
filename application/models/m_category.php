<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_news extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->_table  	= 'category';
        $this->CI 		= get_instance();
    }
    
    public function getCategoryAll() {
        return $this->db->get($this->_table);
    }
	
	public function getCategoryById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table);
    }

    public function insertCategory($data) {
        $this->db->insert($this->_table, $data);
    }

    public function deleteCategory($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
    }

    public function updateCategory($where, $data) {
        $this->db->where($where);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
	
}
?>
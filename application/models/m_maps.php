<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_maps extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->_table = 'maps';
        $this->CI = get_instance();
    }
    
    public function getMapsAll() {
        return $this->db->get($this->_table);
    }
	
	public function getMapsById($id)
    {
        $this->db->where('map_id', $id);
        return $this->db->get($this->_table);
    }

    public function insertMaps($data) {
        $this->db->insert($this->_table, $data);
    }

    public function deleteMaps($id)
    {
        $this->db->where('map_id', $id);
        $this->db->delete($this->_table);
    }

    public function updateMaps($where, $data) {
        $this->db->where($where);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
	
}
?>
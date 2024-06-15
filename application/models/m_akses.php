<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_akses extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->_table = 'be_menu_user';
        $this->CI = get_instance();
    }
    
    public function getAksesAll() {
		$this->db->select("a.*,b.*,c.*");
		$this->db->from($this->_table.' a');
		$this->db->join('be_group_user b', 'b.group_id = a.group_id', 'left');
		$this->db->join('be_menu c', 'c.menu_id = a.menu_id', 'left');
		$this->db->order_by("a.group_id", "asc");
        return $this->db->get();
    }
	public function getGroupsAll() {
        return $this->db->get("be_group_user");
    }
	
	public function getMenusAll() {
        return $this->db->get("be_menu");
    }
	
	public function getAksesById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table);
    }

    public function insertAkses($data) {
        $this->db->insert($this->_table, $data);
    }

    public function deleteAkses($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
    }

    public function updateAkses($where, $data) {
        $this->db->where($where);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
	
}
?>
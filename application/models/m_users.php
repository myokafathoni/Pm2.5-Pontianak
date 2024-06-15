<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_users extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->_table = 'user';
        $this->CI = get_instance();
    }
    
    public function getUserAll() {
		$this->db->query("
		select * from user u left join group g on (u.kode_group=g.kode_group)
		")->result();
    }
    
    public function getUserLogin($user,$pass) {
		$r=$this->db->query("
							SELECT
							user.username
							, user.nama
							, user.telp
							, user.email
							, user.password
							, `group`.kode_group
							, `group`.nama_group
							FROM
							user
							INNER JOIN `group` 
								ON (user.kode_group = `group`.kode_group)
							where
							user.username='".$user."' and user.password='".$pass."'
						");
        return $r;
    }
	
	public function getUsersById($id)
    {
		$r=$this->db->query("
							SELECT
							user.username
							, user.nama
							, user.telp
							, user.email
							, user.password
							, group.kode_group
							FROM
							user
							INNER JOIN group 
								ON (user.kode_group = group.kode_group)
							username='".$id."'
		");
        return $r;
    }
	
    public function getUsersByUname($user)
    {
        $this->db->where('username', $user);
        return $this->db->get($this->_table);
    }

    public function insertUsers($data) {
        $this->db->insert($this->_table, $data);
    }

    public function deleteUsers($id)
    {
        $this->db->where('username', $id);
        $this->db->delete($this->_table);
    }

    public function updateUsers($where, $data) {
        $this->db->where($where);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
   
    public function getGroup(){
        return $this->db->get("group");
    }
}
?>
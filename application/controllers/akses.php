<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akses extends CI_Controller {
    
    public function  __construct() {
        parent::__construct();
        $_idmenu = 5;
        $this->dokumen_lib->check_login();
        $this->dokumen_lib->cek_wewenang_menu($_idmenu);
        $this->load->model("m_akses");
    }

    public function index() {
        $this->lists();
    }

    public function lists() {
        $data['sql'] = $this->m_akses->getAksesAll();
        $data['home'] = base_url().'akses';
        $data['modul'] = 'Management Akses Menu';
        $data['title'] = 'List Akses Menu';
        $data['subtitle'] = 'Akses Menu';
        $data['link_add'] = 'akses/add/';
        $data['link_edit'] = 'akses/edit/';
        $data['link_delete'] = 'akses/delete/';
        $data["menu"] = $this->dokumen_lib->build_menu();
        $data['content'] = $this->load->view('akses/list', $data, TRUE);
        $data["content"] = $this->load->view("v_backend", $data);
    }
    
    public function add() {
		$data['home'] = base_url().'akses';
		$data['modul'] = 'Management Akses Menu';
        $data["title"] = "List Akses Menu";
        $data["subtitle"] = "Add Akses Menu";
        $data['act'] = 'akses/add_act';
		$data['groups'] = $this->m_akses->getGroupsAll();
        $data['menus'] = $this->m_akses->getMenusAll();
        $data["menu"] = $this->dokumen_lib->build_menu();
        $data["content"] = $this->load->view("akses/add", $data, true);
        $data["content"] = $this->load->view("v_backend", $data);
    }

    public function edit($id) {
        $hasil = $this->m_akses->getAksesById($id);
        $hasil = $hasil->result();
		$data['home'] = base_url().'akses';
        $data['modul'] = 'Management Akses Menu';
        $data["title"] = "List Akses Menu";
        $data["subtitle"] = "Edit Akses Menu";
		$data['act'] = 'akses/edit_act/'.$id;
        $data["data"] = array(
            "group_id" => $hasil[0]->group_id,
            "menu_id" => $hasil[0]->menu_id,
            "enable" => $hasil[0]->enable
        );
		$data['groups'] = $this->m_akses->getGroupsAll();
        $data['menus'] = $this->m_akses->getMenusAll();
        $data["menu"] = $this->dokumen_lib->build_menu();
        $data['content'] = $this->load->view('akses/add', $data, TRUE);
        $this->load->view('v_backend', $data);
    }

    public function delete($id)
    {
        $this->m_akses->deleteAkses($id);

        redirect('akses', 'refresh');
    }

    public function add_act() {
        $group = $this->input->post('group', TRUE);
        $menu = $this->input->post('menu', TRUE);
        $enable = $this->input->post('enable', TRUE);

        $data = array(
            'group_id' => $group,
            'menu_id' => $menu,
            'enable' => $enable
        );
        
        $this->m_akses->insertAkses($data);

        redirect('akses', 'refresh');
    }

    public function edit_act($id) {
       $group = $this->input->post('group', TRUE);
        $menu = $this->input->post('menu', TRUE);
        $enable = $this->input->post('enable', TRUE);

        $data = array(
            'group_id' => $group,
            'menu_id' => $menu,
            'enable' => $enable
        );

        $result = $this->m_akses->updateAkses(array("id" => $id), $data);
        redirect('akses', 'refresh');
    }
    
}
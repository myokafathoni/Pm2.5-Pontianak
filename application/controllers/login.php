<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function index() {
        redirect("beranda","refresh");
    }

    public function cek_login()
    {
        $user = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        #convert password ke MD5
        if ($password != "") {
            $password = $password;
        }
        $this->load->model('m_users');
        $res = $this->m_users->getUserLogin($user,$password);
        if ($res->num_rows() > 0) {
            foreach ($res->result() as $row)
            {
				$this->session->set_userdata('username', $row->username);
				$this->session->set_userdata('nama', $row->nama);
				$this->session->set_userdata('email', $row->email);
				$this->session->set_userdata('kode_group', $row->kode_group);
				$this->session->set_userdata('nama_group', $row->nama_group);
            }
			redirect("beranda","refresh");
        }
        else
        {
             echo "<script>alert('Maaf username atau password anda salah!')</script>";
            echo "<script>window.location.href='".site_url('login')."'</script>";
        }
        
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata("nama");
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('kode_group');
        $this->session->unset_userdata('nama_group');
        $this->session->unset_userdata('kode_unit');
        $this->session->unset_userdata('nama_unit');
        redirect("beranda","refresh");
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  public function index()
  {
    $session = $this->session->userdata('status');
    if ($session == '') {
      $this->load->view('v_login');
    } else {
      redirect('dashboard');
    }
  }

  public function proses()
  {
    $user = $this->input->post('username');
    $pass = $this->input->post('password');

    $cek = $this->db->get_where('pengguna', ['pengguna_username' => $user]);

    if ($cek->num_rows() > 0) {

      $hasil = $cek->row();

      if (password_verify($pass, $hasil->pengguna_password)) {
        $this->session->set_userdata('id', $hasil->pengguna_id);
        $this->session->set_userdata('username', $hasil->pengguna_username);
        $this->session->set_userdata('nama', $hasil->pengguna_nama);
        $this->session->set_userdata('foto', $hasil->foto);
        $this->session->set_userdata('level', $hasil->pengguna_level);
        $this->session->set_userdata('status', 'telah_login');
        redirect(base_url() . 'dashboard');
      } else {
        redirect(base_url() . 'login?alert=gagal');
      }
    } else {
      redirect(base_url() . 'login?alert=belum_login');
    }
  }

  public function notfound()
  {
    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_notfound');
    $this->load->view('dashboard/v_footer');
  }
}

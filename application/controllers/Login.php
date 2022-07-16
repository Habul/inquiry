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

    $where = array(
      'pengguna_username' => $user,
      'pengguna_status' => 1
    );

    $cek = $this->m_data->cek_login('pengguna', $where);

    if ($cek->num_rows() > 0) {
      $hasil = $cek->row();
      if (password_verify($pass, $hasil->pengguna_password)) {
        $this->session->set_userdata('id', $hasil->pengguna_id);
        $this->session->set_userdata('username', $hasil->pengguna_username);
        $this->session->set_userdata('nama', $hasil->pengguna_nama);
        $this->session->set_userdata('foto', $hasil->foto);
        $this->session->set_userdata('level', $hasil->pengguna_level);
        $this->session->set_userdata('status', 'telah_login');

        $data =
          [
            'username' => $hasil->pengguna_username,
            'ip' => $this->input->ip_address(),
            'os' => $this->agent->platform(),
            'browser' => $this->agent->browser() . '-' . $this->agent->version(),
            'date' => date('Y-m-d H:i:s')
          ];

        if (mdate('%H:%i') >= '00:01' && mdate('%H:%i') <= '10:00') :
          $logg = 'Good morning ' . $this->session->userdata('nama') . '!';
        elseif (mdate('%H:%i') >= '10:01' && mdate('%H:%i') <= '18:00') :
          $logg = 'Good afternoon ' . $this->session->userdata('nama') . '!';
        elseif (mdate('%H:%i') >= '18:01' && mdate('%H:%i') <= '23:59') :
          $logg = 'Good evening' . $this->session->userdata('nama') . '!';
        endif;

        $this->m_data->insert_data($data, 'history_log');
        $this->session->set_flashdata('loginok', $logg);
        redirect(base_url() . 'dashboard');
      } else {
        redirect(base_url() . 'login?alert=gagal');
      }
    } else {
      redirect(base_url() . 'login?alert=belum_login');
    }
  }

  public function register()
  {
    $session = $this->session->userdata('status');
    if ($session == '') {
      $this->load->view('v_register');
    } else {
      redirect('dashboard');
    }
  }

  public function register_proses()
  {
    $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
    $userIp = $this->input->ip_address();
    $secret = $this->config->item('google_secret');
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $status = json_decode($output, true);

    if ($status['success']) {
      $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
      $this->form_validation->set_rules('username', 'Username', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim');
      $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password2]');
      $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]');

      if ($this->form_validation->run() != false) {
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $timestamp = mdate('%Y-%m-%d %H:%i:%s');

        $data = array(
          'pengguna_nama' => $nama,
          'pengguna_email' => $email,
          'pengguna_username' => $username,
          'pengguna_password' => $password,
          'pengguna_level' => 'guest',
          'pengguna_status' => '1',
          'date_created' => $timestamp,
        );
        $this->load->model('m_data');
        $this->m_data->insert_data($data, 'pengguna');
        redirect(base_url() . 'login?alert=registered');
      } else {
        redirect(base_url() . 'login/register?alert=not_registered');
      }
    } else {
      redirect(base_url() . 'login/register?alert=not_registered');
    }
  }

  public function notfound()
  {
    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_notfound');
    $this->load->view('dashboard/v_footer');
  }
}

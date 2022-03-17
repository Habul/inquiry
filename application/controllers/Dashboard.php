<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('m_data');
    if ($this->session->userdata('status') != "telah_login") {
      redirect(base_url() . 'login?alert=belum_login');
    }
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['jumlah_SJ'] = $this->m_data->get_data('sj_user_df')->num_rows();
    $data['jumlah_pengguna'] = $this->m_data->get_data('pengguna')->num_rows();
    $data['total_inquiry'] = $this->m_data->tot_inquiry();
    $data['total_buffer'] = $this->m_data->tot_buffer();
    $data['tot_mobil'] = $this->db->where('type', 'mobil')->get('type_vehicles')->num_rows();
    $data['tot_motor'] = $this->db->where('type', 'motor')->get('type_vehicles')->num_rows();
    $data['tot_truck'] = $this->db->where('type', 'truck')->get('type_vehicles')->num_rows();
    $data['tot_vehicles'] = $this->m_data->get_data('type_vehicles')->num_rows();

    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

    $sales = $this->m_data->select_by_sales();
    $index = 0;
    foreach ($sales as $value) {
      $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

      $sales_color[$index] = $color;
      $data_sales[$index] = $value->nama;

      $index++;
    }

    $brand = $this->m_data->select_by_brand();
    $index = 0;
    foreach ($brand as $value) {
      $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

      $brand_color[$index] = $color;
      $data_posisi[$index] = $value->nama;

      $index++;
    }

    $data['barmobil'] = $this->m_data->bartracking('mobil');
    $data['barmotor'] = $this->m_data->bartracking('motor');
    $data['bartruck'] = $this->m_data->bartracking('truck');
    $data['suratdf'] = $this->m_data->suratjalan('sj_user_df');
    $data['suraths'] = $this->m_data->suratjalan('sj_user');
    $data['data_sales'] = $this->m_data->select_by_sales();
    $data['data_brand'] = $this->m_data->select_by_brand();
    $data['sales_color'] = json_encode($sales_color);
    $data['brand_color'] = json_encode($brand_color);
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('dashboard/v_index', $data);
    $this->load->view('dashboard/v_footer', $data);
  }

  public function keluar()
  {
    $this->session->sess_destroy();
    redirect('login?alert=logout');
  }

  public function ganti_password_aksi()
  {
    $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
    $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[6]', 'required|matches[password_lama]');
    $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password Baru', 'required|matches[password_baru]');

    if ($this->form_validation->run() != false) {

      $password_lama = $this->input->post('password_lama');
      $password_baru = $this->input->post('password_baru');
      $konfirmasi_password = $this->input->post('konfirmasi_password');

      $where = array(
        'pengguna_id' => $this->session->userdata('id')
      );

      $cek = $this->m_data->cek_login('pengguna', $where);

      if ($cek->num_rows() > 0) {
        $hasil = $cek->row();
        if (password_verify($password_lama, $hasil->pengguna_password)) {
          $w = array(
            'pengguna_id' => $this->session->userdata('id')
          );
          $data = array(
            'pengguna_password' => password_hash($password_baru, PASSWORD_DEFAULT)
          );
          $this->m_data->update_data($where, $data, 'pengguna');
          redirect('dashboard/profil?alert=ok');
        } else {
          redirect('dashboard/profil?alert=gagal');
        }
      }
    } else {
      redirect('dashboard/profil?alert=kurang');
    }
  }

  public function profil()
  {
    // id pengguna yang sedang login
    $id_pengguna = $this->session->userdata('id');

    $where = array(
      'pengguna_id' => $id_pengguna
    );

    $data['title'] = 'Profile';
    $data['profil'] = $this->m_data->edit_data($where, 'pengguna')->result();

    $this->load->view('dashboard/v_header', $data);
    $this->load->view('dashboard/v_profil', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function profil_update()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');

    if ($this->form_validation->run() != false) {

      $id = $this->session->userdata('id');
      $pengguna_nama = $this->input->post('nama');
      $pengguna_email = $this->input->post('email');

      $where = array(
        'pengguna_id' => $id
      );

      $data = array(
        'pengguna_nama' => $pengguna_nama,
        'pengguna_email' => $pengguna_email
      );

      $this->m_data->update_data($where, $data, 'pengguna');

      if (!empty($_FILES['foto']['name'])) {
        $config['upload_path']   = './gambar/profile/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite']  = true;
        $config['max_size']     = 2024;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
          $gambar = $this->upload->data();

          $id = $this->session->userdata('id');
          $foto = $gambar['file_name'];

          $data = array(
            'foto' => $foto
          );

          $where = array(
            'pengguna_id' => $id
          );

          $this->m_data->update_data($where, $data, 'pengguna');
        }
      }
      redirect(base_url() . 'dashboard/profil/?alert=sukses');
    } else {
      $id_pengguna = $this->session->userdata('id');

      $where = array(
        'pengguna_id' => $id_pengguna
      );

      $data['profil'] = $this->m_data->edit_data($where, 'pengguna')->result();

      $this->load->view('dashboard/v_header');
      $this->load->view('dashboard/v_profil', $data);
      $this->load->view('dashboard/v_footer');
    }
  }

  public function pengaturan()
  {
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_pengaturan', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function pengaturan_update()
  {
    $this->form_validation->set_rules('nama', 'Nama Website', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi Website', 'required');

    if ($this->form_validation->run() != false) {

      $nama = $this->input->post('nama');
      $deskripsi = $this->input->post('deskripsi');
      $link_facebook = $this->input->post('link_facebook');
      $link_twitter = $this->input->post('link_twitter');
      $link_instagram = $this->input->post('link_instagram');
      $link_github = $this->input->post('link_github');

      $where = array();

      $data = array(
        'nama' => $nama,
        'deskripsi' => $deskripsi,
        'link_facebook' => $link_facebook,
        'link_twitter' => $link_twitter,
        'link_instagram' => $link_instagram,
        'link_github' => $link_github
      );

      $this->m_data->update_data($where, $data, 'pengaturan');

      if (!empty($_FILES['logo']['name'])) {

        $config['upload_path']   = './gambar/website/';
        $config['allowed_types'] = 'jpg|png|gif';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('logo')) {

          $gambar = $this->upload->data();

          $logo = $gambar['file_name'];

          $this->db->query("UPDATE pengaturan SET logo='$logo'");
        }
      }

      redirect(base_url() . 'dashboard/pengaturan/?alert=sukses');
    } else {
      $data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

      $this->load->view('dashboard/v_header');
      $this->load->view('dashboard/v_pengaturan', $data);
      $this->load->view('dashboard/v_footer');
    }
  }

  // CRUD PENGGUNA
  public function pengguna()
  {
    $data['title'] = 'User Access';
    $data['pengguna'] = $this->m_data->get_data('pengguna')->result();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('dashboard/v_pengguna', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function pengguna_aksi()
  {
    $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
    $this->form_validation->set_rules('email', 'Email Pengguna', 'required');
    $this->form_validation->set_rules('username', 'Username Pengguna', 'required');
    $this->form_validation->set_rules('password', 'Password Pengguna', 'required|min_length[6]');
    $this->form_validation->set_rules('level', 'Level Pengguna', 'required');
    $this->form_validation->set_rules('status', 'Status Pengguna', 'required');

    if ($this->form_validation->run() != false) {
      $nama = $this->input->post('nama');
      $email = $this->input->post('email');
      $username = $this->input->post('username');
      $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
      $level = $this->input->post('level');
      $status = $this->input->post('status');
      $timestamp = mdate('%Y-%m-%d %H:%i:%s');

      $data = array(
        'pengguna_nama' => $nama,
        'pengguna_email' => $email,
        'pengguna_username' => $username,
        'pengguna_password' => $password,
        'pengguna_level' => $level,
        'pengguna_status' => $status,
        'date_created' => $timestamp
      );

      $this->m_data->insert_data($data, 'pengguna');
      $this->session->set_flashdata('berhasil', 'Add Data successfully, Name : ' . $this->input->post('nama', TRUE) . ' !');
      redirect(base_url() . 'dashboard/pengguna');
    } else {
      $this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
      redirect(base_url() . 'dashboard/pengguna');
    }
  }

  public function pengguna_update()
  {
    $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
    $this->form_validation->set_rules('email', 'Email Pengguna', 'required');
    $this->form_validation->set_rules('username', 'Username Pengguna', 'required');
    $this->form_validation->set_rules('level', 'Level Pengguna', 'required');
    $this->form_validation->set_rules('status', 'Status Pengguna', 'required');

    if ($this->form_validation->run() != false) {

      $id = $this->input->post('id');

      $nama = $this->input->post('nama');
      $email = $this->input->post('email');
      $username = $this->input->post('username');
      $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
      $level = $this->input->post('level');
      $status = $this->input->post('status');

      if ($this->input->post('password') == "") {
        $data = array(
          'pengguna_nama' => $nama,
          'pengguna_email' => $email,
          'pengguna_username' => $username,
          'pengguna_level' => $level,
          'pengguna_status' => $status
        );
      } else {
        $data = array(
          'pengguna_nama' => $nama,
          'pengguna_email' => $email,
          'pengguna_username' => $username,
          'pengguna_password' => $password,
          'pengguna_level' => $level,
          'pengguna_status' => $status
        );
      }

      $where = array(
        'pengguna_id' => $id
      );

      $this->m_data->update_data($where, $data, 'pengguna');
      $this->session->set_flashdata('berhasil', 'Update Data successfully, Name : ' . $this->input->post('nama', TRUE) . ' !');
      redirect(base_url() . 'dashboard/pengguna');
    } else {
      $this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
      redirect(base_url() . 'dashboard/pengguna');
    }
  }

  public function pengguna_hapus()
  {
    $id = $this->input->post('id'); {

      $where = array(
        'pengguna_id' => $id
      );

      $this->m_data->delete_data($where, 'pengguna');
      $this->session->set_flashdata('berhasil', 'Data has been deleted !');
      redirect(base_url() . 'dashboard/pengguna');
    }
  }

  public function contact()
  {
    $data['title'] = 'Contact IT';
    $data['it'] = $this->m_data->get_data('kontak')->result();
    $data['id_add'] = $this->db->select_max('id_user')->get('kontak')->row();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('dashboard/v_contact', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function contact_add()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('posisi', 'Posisi', 'required');
    $this->form_validation->set_rules('no_hp', 'No Hp', 'required');
    $this->form_validation->set_rules('about', 'About', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');

    if ($this->form_validation->run() != false) {
      $id = $this->input->post('id');
      $nama = $this->input->post('nama');
      $posisi = $this->input->post('posisi');
      $no_hp = $this->input->post('no_hp');
      $about = $this->input->post('about');
      $alamat = $this->input->post('alamat');

      $data = array(
        'id_user' =>$id,
        'nama' => $nama,
        'posisi' => $posisi,
        'no_hp' => $no_hp,
        'about' => $about,
        'alamat' => $alamat
      );

      $this->m_data->insert_data($data, 'kontak');

      if (!empty($_FILES['foto']['name'])) {

        $config['upload_path']   = './gambar/contact/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite']  = true;
        $config['max_size']     = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
          $gambar = $this->upload->data();

          $id = $this->input->post('id');
          $file = $gambar['file_name'];

          $this->db->query("UPDATE kontak SET foto='$file' WHERE id_user='$id'");
        }
      }
      $this->session->set_flashdata('berhasil', 'Add contact successfully, Name : ' . $this->input->post('nama', TRUE) . ' !');
      redirect(base_url() . 'dashboard/contact');
    } else {
      $this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
      redirect(base_url() . 'dashboard/contact');
    }
  }

  public function contact_edit()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('posisi', 'Posisi', 'required');
    $this->form_validation->set_rules('no_hp', 'No Hp', 'required');
    $this->form_validation->set_rules('about', 'About', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');

    if ($this->form_validation->run() != false) {

      $id = $this->input->post('id');
      $nama = $this->input->post('nama');
      $posisi = $this->input->post('posisi');
      $no_hp = $this->input->post('no_hp');
      $about = $this->input->post('about');
      $alamat = $this->input->post('alamat');

      $where = array(
        'id_user' => $id
      );

      $data = array(
        'nama' => $nama,
        'posisi' => $posisi,
        'no_hp' => $no_hp,
        'about' => $about,
        'alamat' => $alamat
      );

      $this->m_data->update_data($where, $data, 'kontak');

      if (!empty($_FILES['foto']['name'])) {

        $config['upload_path']   = './gambar/contact/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite']  = true;
        $config['max_size']     = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
          $gambar = $this->upload->data();

          $id = $this->input->post('id');
          $file = $gambar['file_name'];

          $this->db->query("UPDATE kontak SET foto='$file' WHERE id_user='$id'");
        }
      }
      $this->session->set_flashdata('berhasil', 'Edit contact successfully, Name : ' . $this->input->post('nama', TRUE) . ' !');
      redirect(base_url() . 'dashboard/contact');
    } else {
      $this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
      redirect(base_url() . 'dashboard/contact');
    }
  }

  public function contact_hapus()
  {
    $id = $this->input->post('id'); {
      $where = array(
        'id_user' => $id
      );
      $this->m_data->delete_data($where, 'kontak');
      $this->session->set_flashdata('berhasil', 'Data has been deleted !');
      redirect(base_url() . 'dashboard/contact');
    }
  }

  public function notfound()
  {
    $this->load->view('dashboard/v_header');
    $this->load->view('frontend/v_notfound');
    $this->load->view('dashboard/v_footer');
  }

  public function mini_games()
  {
    $data['title'] = 'Mini Games';
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('it/v_games.php');
    $this->load->view('dashboard/v_footer');
  }

  public function kanban()
  {
    $data['title'] = 'Mini Games';
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('it/v_kanban.php');
    $this->load->view('dashboard/v_footer');
  }
}

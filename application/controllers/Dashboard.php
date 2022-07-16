<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    date_default_timezone_set('Asia/Jakarta');
    if ($this->session->userdata('status') != "telah_login") {
      redirect(base_url() . 'login?alert=belum_login');
    }
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['jumlah_SJ'] = $this->m_data->get_data('sj_user_df')->num_rows();
    $data['jumlah_pengguna'] = $this->m_data->get_data('pengguna')->num_rows();
    $data['master_item'] = $this->m_data->get_data('master_item')->num_rows();
    $data['total_inquiry'] = $this->m_data->tot_inquiry();
    $data['total_buffer'] = $this->m_data->tot_buffer();
    $data['tot_mobil'] = $this->db->where('type', 'mobil')->get('type_vehicles')->num_rows();
    $data['tot_motor'] = $this->db->where('type', 'motor')->get('type_vehicles')->num_rows();
    $data['tot_truck'] = $this->db->where('type', 'truck')->get('type_vehicles')->num_rows();
    $data['license'] = $this->m_data->get_data('license')->num_rows();
    $data['history_log'] = $this->m_data->get_index('history_log', 'date')->result();

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
          $this->session->set_flashdata('berhasil', 'Update password successfully !');
          redirect('dashboard/profil');
        } else {
          $this->session->set_flashdata('gagal', 'Password does not match !');
          redirect('dashboard/profil');
        }
      }
    } else {
      $this->session->set_flashdata('ulang', 'Password must be 6 digits!');
      redirect('dashboard/profil');
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
      $this->session->set_flashdata('berhasil', 'Update Profile ' . $pengguna_nama . ' successfully !');

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
      redirect(base_url() . 'dashboard/profil');
      $this->session->set_flashdata('berhasil', 'Update Profile ' . $pengguna_nama . ' successfully !');
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
      $this->session->set_flashdata('berhasil', 'Update Password ' . $nama . ' successfully !');

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
      redirect(base_url() . 'dashboard/pengaturan');
      $this->session->set_flashdata('berhasil', 'Update Password ' . $nama . ' successfully !');
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
    $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required|is_unique[pengguna.pengguna_nama]');
    $this->form_validation->set_rules('email', 'Email Pengguna', 'required');
    $this->form_validation->set_rules('username', 'Username Pengguna', 'required|is_unique[pengguna.pengguna_username]');
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
      $this->session->set_flashdata('success', 'Add Data successfully, Name : ' . $this->input->post('nama', TRUE) . ' !');
      redirect(base_url() . 'dashboard/pengguna');
    } else {
      $this->session->set_flashdata('error', 'Data failed to Add, Username or Name as exists !');
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
      $this->session->set_flashdata('success', 'Update Data successfully, Name : ' . $this->input->post('nama', TRUE) . ' !');
      redirect(base_url() . 'dashboard/pengguna');
    } else {
      $this->session->set_flashdata('error', 'Data failed to Update, Please repeat !');
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
      $this->session->set_flashdata('success', 'Data has been deleted !');
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
        'id_user' => $id,
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
      $this->session->set_flashdata('success', 'Add contact successfully, Name : ' . $this->input->post('nama', TRUE) . ' !');
      redirect(base_url() . 'dashboard/contact');
    } else {
      $this->session->set_flashdata('error', 'Data failed to Add, Please repeat !');
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
      $this->session->set_flashdata('success', 'Edit contact successfully, Name : ' . $this->input->post('nama', TRUE) . ' !');
      redirect(base_url() . 'dashboard/contact');
    } else {
      $this->session->set_flashdata('error', 'Data failed to Update, Please repeat !');
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
      $this->session->set_flashdata('success', 'Data has been deleted !');
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
    $data['title'] = 'Trick Or Treat';
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('it/v_games.php');
    $this->load->view('dashboard/v_footer');
  }

  public function workspace()
  {
    $data['title'] = 'Workspace';
    $data['todo'] = $this->m_data->get_index_where('addtime', ['status' => '1'], 'workspace')->result();
    $data['progress'] = $this->m_data->get_index_where('addtime', ['status' => '2'], 'workspace')->result();
    $data['done'] = $this->m_data->get_index_where('addtime', ['status' => '3'], 'workspace')->result();
    $data['failed'] = $this->m_data->get_index_where('addtime', ['status' => '4'], 'workspace')->result();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('dashboard/v_kanban.php', $data);
    $this->load->view('dashboard/v_footer', $data);
  }

  public function workspace_add()
  {
    $this->form_validation->set_rules('header', 'Header', 'required');
    $this->form_validation->set_rules('body', 'Body', 'required');

    if ($this->form_validation->run() != false) {
      $header = $this->input->post('header');
      $body = $this->input->post('body');
      $status = $this->input->post('status');
      $ket = $this->input->post('ket');
      $addtime = mdate('%Y-%m-%d %H:%i:%s');

      $data = array(
        'header' => $header,
        'body' => $body,
        'status' => $status,
        'addtime' => $addtime
      );

      $this->m_data->insert_data($data, 'workspace');
      $this->session->set_flashdata('berhasil', 'Add workspace ' . $ket . ' successfully : ' . $header . ' !');
      redirect(base_url() . 'dashboard/workspace');
    } else {
      $this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
      redirect(base_url() . 'dashboard/workspace');
    }
  }

  public function workspace_edit()
  {
    $this->form_validation->set_rules('header', 'Header', 'required');
    $this->form_validation->set_rules('body', 'Body', 'required');

    if ($this->form_validation->run() != false) {
      $id = $this->input->post('id');
      $header = $this->input->post('header');
      $ket = $this->input->post('ket');
      $body = $this->input->post('body');
      $status = $this->input->post('status');

      $where = array(
        'id' => $id
      );

      $data = array(
        'header' => $header,
        'body' => $body,
        'status' => $status,
        'addtime' => mdate('%Y-%m-%d %H:%i:%s')
      );

      $this->m_data->update_data($where, $data, 'workspace');
      $this->session->set_flashdata('berhasil', 'Edit workspace ' . $ket . '  successfully : ' . $header . ' !');
      redirect(base_url() . 'dashboard/workspace');
    } else {
      $this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
      redirect(base_url() . 'dashboard/workspace');
    }
  }

  public function workspace_del()
  {
    $id = $this->input->post('id');
    $ket = $this->input->post('ket');
    $this->m_data->delete_data(['id' => $id], 'workspace');
    $this->session->set_flashdata('berhasil', 'Data ' . $ket . ' has been deleted !');
    redirect(base_url() . 'dashboard/workspace');
  }

  public function generate()
  {
    $data['title'] = 'Trick Or Treat';
    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    $update = $this->input->post('keyword');

    if ($update == '') {
      redirect(base_url() . 'dashboard/mini_games');
    }

    $data['generate'] = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($update, $generator::TYPE_CODE_128)) . '">';
    $data['detail'] = $update;
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('it/v_games.php', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function generateQR()
  {
    $data['title'] = 'Trick Or Treat';
    $update = $this->input->post('keywordqr');

    if ($update == '') {
      redirect(base_url() . 'dashboard/mini_games');
    }

    $this->load->library('ciqrcode');
    $params['data'] = $update;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = FCPATH . 'Qr.png';
    $this->ciqrcode->generate($params);

    $data['generateqr'] = '<img src="' . base_url() . 'Qr.png" style="width: 100px;" />';
    $data['detailqr'] = $update;
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('it/v_games.php', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function license()
  {
    $data['title'] = 'License 7Soft';
    $data['license'] = $this->m_data->get_index('license', 'addtime')->result();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('dashboard/v_license.php', $data);
    $this->load->view('dashboard/v_footer', $data);
  }

  public function license_add()
  {
    $this->form_validation->set_rules('user', 'User', 'required');
    $this->form_validation->set_rules('user_log', 'User login', 'required|is_unique[license.user_log]');
    $this->form_validation->set_rules('unit', 'Phone', 'required');

    if ($this->form_validation->run() != false) {
      $user = $this->input->post('user');
      $user_log = $this->input->post('user_log');
      $unit = $this->input->post('unit');
      $sn = $this->input->post('sn');
      $key = $this->input->post('key');
      $addtime = mdate('%Y-%m-%d %H:%i:%s');

      $data = array(
        'user' => $user,
        'user_log' => $user_log,
        'unit' => $unit,
        'sn' => $sn,
        'key' => $key,
        'addtime' => $addtime
      );

      $this->m_data->insert_data($data, 'license');
      $this->session->set_flashdata('berhasil', 'Add license ' . $user . ' successfully !');
      redirect(base_url() . 'dashboard/license');
    } else {
      $this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
      redirect(base_url() . 'dashboard/license');
    }
  }

  public function license_edit()
  {
    $this->form_validation->set_rules('user', 'User', 'required');
    $this->form_validation->set_rules('user_log', 'User login', 'required');
    $this->form_validation->set_rules('unit', 'Phone', 'required');

    if ($this->form_validation->run() != false) {
      $id = $this->input->post('id');
      $user = $this->input->post('user');
      $user_log = $this->input->post('user_log');
      $unit = $this->input->post('unit');
      $sn = $this->input->post('sn');
      $key = $this->input->post('key');
      $status = $this->input->post('status');

      $where = array(
        'id' => $id
      );

      $data = array(
        'user' => $user,
        'user_log' => $user_log,
        'unit' => $unit,
        'sn' => $sn,
        'key' => $key,
        'status' => $status,
        'updtime' => mdate('%Y-%m-%d %H:%i:%s')
      );

      $this->m_data->update_data($where, $data, 'license');
      $this->session->set_flashdata('berhasil', 'Edit license ' . $user . ' successfully !');
      redirect(base_url() . 'dashboard/license');
    } else {
      $this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
      redirect(base_url() . 'dashboard/license');
    }
  }

  public function license_del()
  {
    $id = $this->input->post('id');
    $user = $this->input->post('user');
    $this->m_data->delete_data(['id' => $id], 'license');
    $this->session->set_flashdata('berhasil', 'Data ' . $user . ' has been deleted !');
    redirect(base_url() . 'dashboard/license');
  }

  public function license_import()
  {
    $this->form_validation->set_rules('excel', 'File', 'trim|required');

    if ($_FILES['excel']['name'] != '') {
      $config['upload_path'] = './assets/excel/';
      $config['allowed_types'] = 'xls|xlsx';
      $config['overwrite']  = true;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('excel')) {
        $this->upload->display_errors();
      } else {
        $data = $this->upload->data();
        $this->db->empty_table('license');

        error_reporting(E_ALL);
        date_default_timezone_set('Asia/Jakarta');
        include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';
        $inputFileName = './assets/excel/' . $data['file_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

        $index = 0;
        foreach ($sheetData as $key => $value) {
          if ($key != 1) {
            $resultData[$index]['user'] = $value['A'];
            $resultData[$index]['unit'] = $value['B'];
            $resultData[$index]['user_log'] = $value['C'];
            $resultData[$index]['sn'] = $value['D'];
            $resultData[$index]['key'] = $value['E'];
            $resultData[$index]['addtime'] = mdate('%Y-%m-%d %H:%i:%s');
          }
          $index++;
        }

        unlink('./assets/excel/' . $data['file_name']);

        if (count($resultData) != 0) {
          $result = $this->m_data->insert_license($resultData);
          if ($result > 0) {
            $this->session->set_flashdata('berhasil', 'Data successfully imported to database');
            redirect(base_url() . 'dashboard/license');
          }
        } else {
          $this->session->set_flashdata('gagal', 'Data failed to import to database');
          redirect(base_url() . 'dashboard/license');
        }
      }
    }
  }
}

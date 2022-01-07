<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->helper(array('form', 'url'));
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
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[6]');
		$this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password Baru', 'required|matches[password_baru]');

		if ($this->form_validation->run() != false) {

			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru');
			$konfirmasi_password = $this->input->post('konfirmasi_password');

			$where = array(
				'pengguna_id' => $this->session->userdata('id'),
				'pengguna_password' => md5($password_lama)
			);
			$cek = $this->m_data->cek_login('pengguna', $where)->num_rows();

			if ($cek > 0) {

				$w = array(
					'pengguna_id' => $this->session->userdata('id')
				);
				$data = array(
					'pengguna_password' => md5($password_baru)
				);
				$this->m_data->update_data($where, $data, 'pengguna');

				redirect('dashboard/profil?alert=ok');
			} else {

				redirect('dashboard/profil?alert=gagal');
			}
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_profil');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kategori()
	{
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_aksi()
	{
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$kategori = $this->input->post('kategori');

			$data = array(
				'kategori_nama' => $kategori,
				'kategori_slug' => strtolower(url_title($kategori))
			);

			$this->m_data->insert_data($data, 'kategori');

			redirect(base_url() . 'dashboard/kategori');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kategori_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kategori_edit($id)
	{
		$where = array(
			'kategori_id' => $id
		);
		$data['kategori'] = $this->m_data->edit_data($where, 'kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_update()
	{
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$kategori = $this->input->post('kategori');

			$where = array(
				'kategori_id' => $id
			);

			$data = array(
				'kategori_nama' => $kategori,
				'kategori_slug' => strtolower(url_title($kategori))
			);

			$this->m_data->update_data($where, $data, 'kategori');

			redirect(base_url() . 'dashboard/kategori');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'kategori_id' => $id
			);
			$data['kategori'] = $this->m_data->edit_data($where, 'kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kategori_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kategori_hapus($id)
	{
		$where = array(
			'kategori_id' => $id
		);

		$this->m_data->delete_data($where, 'kategori');

		redirect(base_url() . 'dashboard/kategori');
	}

	public function artikel()
	{
		$data['artikel'] = $this->db->query("SELECT * FROM artikel,kategori,pengguna WHERE artikel_kategori=kategori_id and artikel_author=pengguna_id order by artikel_id desc")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function artikel_tambah()
	{
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel_tambah', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function artikel_aksi()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/artikel/';
			$config['allowed_types'] = 'gif|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('sampul')) {

				$gambar = $this->upload->data();

				$tanggal = date('Y-m-d H:i:s');
				$judul = $this->input->post('judul');
				$slug = strtolower(url_title($judul));
				$konten = $this->input->post('konten');
				$sampul = $gambar['file_name'];
				$author = $this->session->userdata('id');
				$kategori = $this->input->post('kategori');
				$status = $this->input->post('status');

				$data = array(
					'artikel_tanggal' => $tanggal,
					'artikel_judul' => $judul,
					'artikel_slug' => $slug,
					'artikel_konten' => $konten,
					'artikel_sampul' => $sampul,
					'artikel_author' => $author,
					'artikel_kategori' => $kategori,
					'artikel_status' => $status,
				);

				$this->m_data->insert_data($data, 'artikel');

				redirect(base_url() . 'dashboard/artikel');
			} else {

				$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

				$data['kategori'] = $this->m_data->get_data('kategori')->result();
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_artikel_tambah', $data);
				$this->load->view('dashboard/v_footer');
			}
		} else {
			$data['kategori'] = $this->m_data->get_data('kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_artikel_tambah', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function artikel_edit($id)
	{
		$where = array(
			'artikel_id' => $id
		);
		$data['artikel'] = $this->m_data->edit_data($where, 'artikel')->result();
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function artikel_update()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');
			$kategori = $this->input->post('kategori');
			$status = $this->input->post('status');

			$where = array(
				'artikel_id' => $id
			);

			$data = array(
				'artikel_judul' => $judul,
				'artikel_slug' => $slug,
				'artikel_konten' => $konten,
				'artikel_kategori' => $kategori,
				'artikel_status' => $status,
			);

			$this->m_data->update_data($where, $data, 'artikel');

			if (!empty($_FILES['sampul']['name'])) {
				$config['upload_path']   = './gambar/artikel/';
				$config['allowed_types'] = 'gif|jpg|png';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {

					// mengambil data tentang gambar
					$gambar = $this->upload->data();

					$data = array(
						'artikel_sampul' => $gambar['file_name'],
					);

					$this->m_data->update_data($where, $data, 'artikel');

					redirect(base_url() . 'dashboard/artikel');
				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'artikel_id' => $id
					);
					$data['artikel'] = $this->m_data->edit_data($where, 'artikel')->result();
					$data['kategori'] = $this->m_data->get_data('kategori')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_artikel_edit', $data);
					$this->load->view('dashboard/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/artikel');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'artikel_id' => $id
			);
			$data['artikel'] = $this->m_data->edit_data($where, 'artikel')->result();
			$data['kategori'] = $this->m_data->get_data('kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_artikel_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function artikel_hapus($id)
	{
		$where = array(
			'artikel_id' => $id
		);

		$this->m_data->delete_data($where, 'artikel');

		redirect(base_url() . 'dashboard/artikel');
	}

	public function pages()
	{
		$data['halaman'] = $this->m_data->get_data('halaman')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pages_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pages_aksi()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[halaman.halaman_judul]');
		$this->form_validation->set_rules('konten', 'Konten', 'required');

		if ($this->form_validation->run() != false) {

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');

			$data = array(
				'halaman_judul' => $judul,
				'halaman_slug' => $slug,
				'halaman_konten' => $konten
			);

			$this->m_data->insert_data($data, 'halaman');

			redirect(base_url() . 'dashboard/pages');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pages_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pages_edit($id)
	{
		$where = array(
			'halaman_id' => $id
		);
		$data['halaman'] = $this->m_data->edit_data($where, 'halaman')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function pages_update()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');

			$where = array(
				'halaman_id' => $id
			);

			$data = array(
				'halaman_judul' => $judul,
				'halaman_slug' => $slug,
				'halaman_konten' => $konten
			);

			$this->m_data->update_data($where, $data, 'halaman');

			redirect(base_url() . 'dashboard/pages');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'halaman_id' => $id
			);
			$data['halaman'] = $this->m_data->edit_data($where, 'halaman')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pages_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pages_hapus($id)
	{
		$where = array(
			'halaman_id' => $id
		);

		$this->m_data->delete_data($where, 'halaman');

		redirect(base_url() . 'dashboard/pages');
	}
	// end crud pages


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
				$config['overwrite']	= true;
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

	public function pengguna_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pengguna_aksi()
	{
		// Wajib isi
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
			$password = md5($this->input->post('password'));
			$level = $this->input->post('level');
			$status = $this->input->post('status');

			$data = array(
				'pengguna_nama' => $nama,
				'pengguna_email' => $email,
				'pengguna_username' => $username,
				'pengguna_password' => $password,
				'pengguna_level' => $level,
				'pengguna_status' => $status
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
			$password = md5($this->input->post('password'));
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

	public function pengguna_hapus_aksi()
	{
		$pengguna_hapus = $this->input->post('pengguna_hapus');
		$pengguna_tujuan = $this->input->post('pengguna_tujuan');

		// hapus pengguna
		$where = array(
			'pengguna_id' => $pengguna_hapus
		);

		$this->m_data->delete_data($where, 'pengguna');

		// pindahkan semua artikel pengguna yang dihapus ke pengguna yang dipilih
		$w = array(
			'artikel_author' => $pengguna_hapus
		);

		$d = array(
			'artikel_author' => $pengguna_tujuan
		);

		$this->m_data->update_data($w, $d, 'artikel');

		redirect(base_url() . 'dashboard/pengguna');
	}
	//END Crud pengguna

	public function contact()
	{
		$data['title'] = 'Contact IT';
		$data['it1'] = $this->m_data->kontak('1');
		$data['it2'] = $this->m_data->kontak('2');
		$data['it3'] = $this->m_data->kontak('3');
		$data['it4'] = $this->m_data->kontak('4');
		$data['it5'] = $this->m_data->kontak('5');
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('dashboard/v_contact', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function notfound()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('frontend/v_notfound');
		$this->load->view('dashboard/v_footer');
	}

	public function iframe()
	{
		$data['title'] = 'Tabbed Iframe';
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('dashboard/v_iframe.php');
		$this->load->view('dashboard/v_footer');
	}
}

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

		// cek session yang login, 
		// jika session status tidak sama dengan session telah_login, berarti pengguna belum login
		// maka halaman akan di alihkan kembali ke halaman login.
		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
		}
	}

	public function index()
	{
		$data['tot'] = $this->m_data->total_rows();
		// hitung jumlah artikel
		$data['jumlah_artikel'] = $this->m_data->get_data('artikel')->num_rows();
		// hitung jumlah pengguna
		$data['jumlah_pengguna'] = $this->m_data->get_data('pengguna')->num_rows();
		// hitung jumlah inquiry belum terjawab
		$data['jumlah_inquiry'] = $this->m_data->select_null();
		// hitung jumlah inquiry sudah terjawab
		$data['total_inquiry'] = $this->m_data->select_not_null();
		// count inquiry belum terjawab

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_index', $data);
		$this->load->view('dashboard/v_footer');

		//$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

		//$user 		= $this->m_data->select_all();
		//$index = 0;
		//foreach ($user as $u) {
		//$color = '#' .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)];

		//$pegawai_by_inquiry = $this->m_data->select_by_inquiry($u->pengguna_id);
		//$data_inquiry[$index]['value'] = $pegawai_by_inquiry->jml;
		//$data_inquiry[$index]['color'] = $color;
		//$data_inquiry[$index]['highlight'] = $color;
		//$data_inquiry[$index]['label'] = $u->id_sales;	

		//$index++;
		//$data['data_inquiry'] = json_encode($data_inquiry);
	}


	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('login?alert=logout');
	}

	public function ganti_password()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_ganti_password');
		$this->load->view('dashboard/v_footer');
	}

	public function ganti_password_aksi()
	{

		// form validasi
		$this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[6]');
		$this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password Baru', 'required|matches[password_baru]');

		// cek validasi
		if ($this->form_validation->run() != false) {

			// menangkap data dari form
			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru');
			$konfirmasi_password = $this->input->post('konfirmasi_password');

			// cek kesesuaian password lama dengan id pengguna yang sedang login dan password lama
			$where = array(
				'pengguna_id' => $this->session->userdata('id'),
				'pengguna_password' => md5($password_lama)
			);
			$cek = $this->m_data->cek_login('pengguna', $where)->num_rows();

			// cek kesesuaikan password lama
			if ($cek > 0) {

				// update data password pengguna
				$w = array(
					'pengguna_id' => $this->session->userdata('id')
				);
				$data = array(
					'pengguna_password' => md5($password_baru)
				);
				$this->m_data->update_data($where, $data, 'pengguna');

				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=sukses');
			} else {
				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=gagal');
			}
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_ganti_password');
			$this->load->view('dashboard/v_footer');
		}
	}

	// CRUD KATEGORI
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
	// END CRUD KATEGORI

	// CRUD ARTIKEL
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
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['sampul']['name'])) {
			$this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/artikel/';
			$config['allowed_types'] = 'gif|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('sampul')) {

				// mengambil data tentang gambar
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
		// Wajib isi judul,konten dan kategori
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
	// end crud artikel


	// CRUD PAGES
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
		// Wajib isi judul,konten
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

			// alihkan kembali ke method pages
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
		// Wajib isi judul,konten 
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

		$data['profil'] = $this->m_data->edit_data($where, 'pengguna')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_profil', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function profil_update()
	{
		// Wajib isi nama dan email

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/profile/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite']	= true;
			$config['max_size']     = 1024;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$id = $this->session->userdata('id');
				$nama = $this->input->post('nama');
				$email = $this->input->post('email');
				$foto = $gambar['file_name'];


				$where = array(
					'pengguna_id' => $id
				);

				$data = array(
					'pengguna_nama' => $nama,
					'pengguna_email' => $email,
					'foto' => $foto

				);

				$this->m_data->update_data($where, $data, 'pengguna');

				redirect('dashboard');
			} else {
				redirect('dashboard/profil');
			}
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
		// Wajib isi nama dan deskripsi website
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

			// update pengaturan
			$this->m_data->update_data($where, $data, 'pengaturan');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['logo']['name'])) {

				$config['upload_path']   = './gambar/website/';
				$config['allowed_types'] = 'jpg|png|gif';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('logo')) {
					// mengambil data tentang gambar logo yang diupload
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
		$data['pengguna'] = $this->m_data->get_data('pengguna')->result();
		$this->load->view('dashboard/v_header');
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
		$this->form_validation->set_rules('password', 'Password Pengguna', 'required|min_length[8]');
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

			redirect(base_url() . 'dashboard/pengguna');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengguna_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pengguna_edit($id)
	{
		$where = array(
			'pengguna_id' => $id
		);
		$data['pengguna'] = $this->m_data->edit_data($where, 'pengguna')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function pengguna_update()
	{
		// Wajib isi
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

			redirect(base_url() . 'dashboard/pengguna');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'pengguna_id' => $id
			);
			$data['pengguna'] = $this->m_data->edit_data($where, 'pengguna')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengguna_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pengguna_hapus($id)
	{
		$where = array(
			'pengguna_id' => $id
		);
		$data['pengguna_hapus'] = $this->m_data->edit_data($where, 'pengguna')->row();
		$data['pengguna_lain'] = $this->db->query("SELECT * FROM pengguna WHERE pengguna_id != $id")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna_hapus', $data);
		$this->load->view('dashboard/v_footer');
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

	// CRUD Inquiry

	public function inquiry()
	{
		$data['inquiry'] = $this->m_data->get_data('inquiry')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('inquiry_id', 'No Inquiry', 'required');
		$this->form_validation->set_rules('sales', 'Nama Sales', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('brand', 'Brand Produk', 'required');
		$this->form_validation->set_rules('desc', 'Description Produk', 'required');
		$this->form_validation->set_rules('qty', 'Quantity', 'required');
		$this->form_validation->set_rules('deadline', 'Deadline', 'required');
		$this->form_validation->set_rules('keter', 'Keterangan', 'required');
		$this->form_validation->set_rules('request', 'Request', 'required');

		if ($this->form_validation->run() != false) {

			$inquiry_id = $this->input->post('inquiry_id');
			$sales = $this->input->post('sales');
			$tanggal = $this->input->post('tanggal');
			$brand = $this->input->post('brand');
			$desc = $this->input->post('desc');
			$qty = $this->input->post('qty');
			$deadline = $this->input->post('deadline');
			$keter = $this->input->post('keter');
			$request = $this->input->post('request');

			$data = array(
				'inquiry_id' => $inquiry_id,
				'sales' => $sales,
				'tanggal' => $tanggal,
				'brand' => $brand,
				'desc' => $desc,
				'qty' => $qty,
				'deadline' => $deadline,
				'keter' => $keter,
				'request' => $request
			);


			$this->m_data->insert_data($data, 'inquiry');

			redirect(base_url() . 'dashboard/inquiry');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('inquiry/v_inquiry_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function inquiry_edit($id)
	{
		$where = array(
			'inquiry_id' => $id
		);
		$data['inquiry'] = $this->m_data->edit_data($where, 'inquiry')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function inquiry_update()
	{
		// Wajib isi
		$this->form_validation->set_rules('cek', 'Check', 'required');
		$this->form_validation->set_rules('fu1', 'Fu1', 'required');
		//$this->form_validation->set_rules('ket_fu','Ket FU','required');
		$this->form_validation->set_rules('cogs', 'COGS', 'required');
		$this->form_validation->set_rules('kurs', 'Kurs', 'required');
		$this->form_validation->set_rules('cogs_idr', 'COGS IDR', 'required');
		$this->form_validation->set_rules('reseller', 'Reseller', 'required');
		$this->form_validation->set_rules('new_seller', 'New Reseller', 'required');
		$this->form_validation->set_rules('user', 'User', 'required');
		$this->form_validation->set_rules('delivery', 'Delivery', 'required');
		$this->form_validation->set_rules('ket_purch', 'Keterangan purchase', 'required');
		$this->form_validation->set_rules('name_purch', 'Nama purchase', 'required');


		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$cek = $this->input->post('cek');
			$fu1 = $this->input->post('fu1');
			$ket_fu = $this->input->post('ket_fu');
			$cogs = $this->input->post('cogs');
			$kurs = $this->input->post('kurs');
			$cogs_idr = $this->input->post('cogs_idr');
			$reseller = $this->input->post('reseller');
			$new_seller = $this->input->post('new_seller');
			$user = $this->input->post('user');
			$delivery = $this->input->post('delivery');
			$ket_purch = $this->input->post('ket_purch');
			$name_purch = $this->input->post('name_purch');

			if ($this->form_validation->run() != false) {
				$data = array(
					'cek' => $cek,
					'fu1' => $fu1,
					'ket_fu' => $ket_fu,
					'cogs' => $cogs,
					'kurs' => $kurs,
					'cogs_idr' => $cogs_idr,
					'reseller' => $reseller,
					'new_seller' => $new_seller,
					'user' => $user,
					'delivery' => $delivery,
					'ket_purch' => $ket_purch,
					'name_purch' => $name_purch,
				);
			}

			$where = array(
				'inquiry_id' => $id
			);

			$this->m_data->update_data($where, $data, 'inquiry');

			redirect(base_url() . 'dashboard/inquiry');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'inquiry_id' => $id
			);
			$data['inquiry'] = $this->m_data->edit_data($where, 'inquiry')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('inquiry/v_inquiry_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function inquiry_edit_sales($id)
	{
		$where = array(
			'inquiry_id' => $id
		);
		$data['inquiry'] = $this->m_data->edit_data($where, 'inquiry')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_edit_sales', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function inquiry_update_sales()
	{
		// Wajib isi
		$this->form_validation->set_rules('sales', 'Tanggal', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('brand', 'Brand Produk', 'required');
		$this->form_validation->set_rules('desc', 'Description Product', 'required');
		$this->form_validation->set_rules('qty', 'Quantity', 'required');
		$this->form_validation->set_rules('deadline', 'Deadline', 'required');
		$this->form_validation->set_rules('keter', 'Keterangan', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$sales = $this->input->post('sales');
			$tanggal = $this->input->post('tanggal');
			$brand = $this->input->post('brand');
			$desc = $this->input->post('desc');
			$qty = $this->input->post('qty');
			$deadline = $this->input->post('deadline');
			$keter = $this->input->post('keter');

			if ($this->form_validation->run() != false) {
				$data = array(
					'sales' => $sales,
					'tanggal' => $tanggal,
					'brand' => $brand,
					'desc' => $desc,
					'qty' => $qty,
					'deadline' => $deadline,
					'keter' => $keter,

				);
			}

			$where = array(
				'inquiry_id' => $id
			);

			$this->m_data->update_data($where, $data, 'inquiry');

			redirect(base_url() . 'dashboard/inquiry');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'inquiry_id' => $id
			);
			$data['inquiry'] = $this->m_data->edit_data($where, 'inquiry')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('inquiry/v_inquiry_edit_sales', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function inquiry_hapus($id)
	{
		$where = array(
			'inquiry_id' => $id
		);

		$this->m_data->delete_data($where, 'inquiry');

		redirect(base_url() . 'dashboard/inquiry');
	}

	public function inquiry_view()
	{
		$data['inquiry'] = $this->m_data->select_inquiry();

		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_view', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_export()
	{
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->m_data->select_all_inquiry();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "ID Inquiry");
		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Nama Sales");
		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "Tanggal");
		$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "Brand Produk");
		$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "Desc");
		$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "Qty");
		$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "Deadline");
		$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "Keter Sales");
		$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, "Request");
		$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, "Check");
		$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, "Follow Up");
		$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, "Keter FU");
		$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, "COGS");
		$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, "KURS");
		$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, "COGS IDR");
		$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, "Reseller");
		$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, "New Seller");
		$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, "User");
		$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, "Delivery");
		$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, "Keter Purchase");
		$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, "Nama Purchase");
		$rowCount++;

		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->inquiry_id);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->sales);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->tanggal);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->brand);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->desc);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->qty);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->deadline);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->keter);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $value->request);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $value->cek);
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $value->fu1);
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $value->ket_fu);
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $value->cogs);
			$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $value->kurs);
			$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $value->cogs_idr);
			$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $value->reseller);
			$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $value->new_seller);
			$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $value->user);
			$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $value->delivery);
			$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $value->ket_purch);
			$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $value->name_purch);
			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data Inquiry.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data Inquiry.xlsx', NULL);
	}

	public function inquiry_detail($id)
	{
		$where = array(
			'inquiry_id' => $id
		);
		$data['inquiry'] = $this->m_data->edit_data($where, 'inquiry')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_detail', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_master()
	{
		$data['master'] = $this->m_data->get_data('master')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_master', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_master_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_master_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_master_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('id_master', 'Master Inquiry', 'required');
		$this->form_validation->set_rules('brand', 'Brand Produk', 'required');
		$this->form_validation->set_rules('d1', 'D1', 'required');
		$this->form_validation->set_rules('d2', 'D2', 'required');
		$this->form_validation->set_rules('user', 'USER', 'required');
		$this->form_validation->set_rules('distributor', 'DISTRIBUTOR', 'required');

		if ($this->form_validation->run() != false) {

			$id_master = $this->input->post('id_master');
			$brand = $this->input->post('brand');
			$d1 = $this->input->post('d1');
			$d2 = $this->input->post('d2');
			$user = $this->input->post('user');
			$distributor = $this->input->post('distributor');

			$data = array(
				'id_master' => $id_master,
				'brand' => $brand,
				'd1' => $d1,
				'd2' => $d2,
				'user' => $user,
				'distributor' => $distributor
			);


			$this->m_data->insert_data($data, 'master');

			redirect(base_url() . 'dashboard/inquiry_master');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('inquiry/v_inquiry_master_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function inquiry_master_hapus($id)
	{
		$where = array(
			'id_master' => $id
		);

		$this->m_data->delete_data($where, 'master');

		redirect(base_url() . 'dashboard/inquiry_master');
	}

	public function inquiry_master_edit($id)
	{
		$where = array(
			'id_master' => $id
		);
		$data['master'] = $this->m_data->edit_data($where, 'master')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_master_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function inquiry_master_update()
	{
		// Wajib isi
		$this->form_validation->set_rules('d1', 'D1', 'required');
		$this->form_validation->set_rules('d2', 'D2', 'required');
		$this->form_validation->set_rules('user', 'USER', 'required');
		$this->form_validation->set_rules('distributor', 'Manufacture/Distributor', 'required');

		if ($this->form_validation->run() != false) {
			$id = $this->input->post('id');

			$brand = $this->input->post('brand');
			$d1 = $this->input->post('d1');
			$d2 = $this->input->post('d2');
			$user = $this->input->post('user');
			$distributor = $this->input->post('distributor');

			if ($this->form_validation->run() != false) {
				$data = array(
					'brand' => $brand,
					'd1' => $d1,
					'd2' => $d2,
					'user' => $user,
					'distributor' => $distributor
				);
			}

			$where = array(
				'id_master' => $id
			);

			$this->m_data->update_data($where, $data, 'master');

			redirect(base_url() . 'dashboard/inquiry_master');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'id_master' => $id
			);
			$data['master'] = $this->m_data->edit_data($where, 'master')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('inquiry/v_inquiry_master_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function inquiry_kurs()
	{
		$data['kurs'] = $this->m_data->get_data('kurs')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_kurs', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_kurs_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_kurs_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_kurs_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('id_kurs', 'ID Kurs', 'required');
		$this->form_validation->set_rules('currency', 'Currency', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required');

		if ($this->form_validation->run() != false) {

			$id_kurs = $this->input->post('id_kurs');
			$currency = $this->input->post('currency');
			$amount = $this->input->post('amount');

			$data = array(
				'id_kurs' => $id_kurs,
				'currency' => $currency,
				'amount' => $amount
			);

			$this->m_data->insert_data($data, 'kurs');

			redirect(base_url() . 'dashboard/inquiry_kurs');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('inquiry/v_inquiry_kurs_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function inquiry_kurs_edit($id)
	{
		$where = array(
			'id_kurs' => $id
		);
		$data['kurs'] = $this->m_data->edit_data($where, 'kurs')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_kurs_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function inquiry_kurs_update()
	{
		// Wajib isi
		$this->form_validation->set_rules('currency', 'Currency', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required');

		if ($this->form_validation->run() != false) {
			$id = $this->input->post('id');

			$currency = $this->input->post('currency');
			$amount = $this->input->post('amount');

			if ($this->form_validation->run() != false) {
				$data = array(
					'currency' => $currency,
					'amount' => $amount
				);
			}

			$where = array(
				'id_kurs' => $id
			);

			$this->m_data->update_data($where, $data, 'kurs');

			redirect(base_url() . 'dashboard/inquiry_kurs');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'id_kurs' => $id
			);
			$data['kurs'] = $this->m_data->edit_data($where, 'kurs')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('inquiry/v_inquiry_kurs_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function inquiry_kurs_hapus($id)
	{
		$where = array(
			'id_kurs' => $id
		);

		$this->m_data->delete_data($where, 'kurs');

		redirect(base_url() . 'dashboard/inquiry_kurs');
	}
}

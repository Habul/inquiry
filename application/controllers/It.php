<?php
defined('BASEPATH') or exit('No direct script access allowed');

class It extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->helper(array('form', 'url'));
		$this->load->model('m_data');
	}

	public function data()
	{
        $data['penting'] = $this->m_data->get_data('datapenting_it')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('it/v_it', $data);
		$this->load->view('dashboard/v_footer');
    }

    
	public function data_aksi()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('isi', 'Isi', 'required');

		if ($this->form_validation->run() != false) {
			$judul = $this->input->post('judul');
			$isi = $this->input->post('isi');
			$addtime = $this->input->post('addtime');

			$data = array(
				'judul' => $judul,
				'isi' => $isi,
				'addtime' => $addtime
			);

			$this->m_data->insert_data($data, 'datapenting_it');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['file']['name'])) {

				$config['upload_path']   = './gambar/datait/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 2024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					$gambar = $this->upload->data();

					$file = $gambar['file_name'];

					$this->db->query("UPDATE datapenting_it SET `file`='$file'");
				}
			}
			$this->session->set_flashdata('berhasil', 'Add Data successfully, Judul : ' . $this->input->post('judul', TRUE) . ' !');
			redirect(base_url() . 'it/data');
		}else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			redirect(base_url() . 'it/data');
		}
	}

    public function data_edit()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('isi', 'Isi', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_id');
			$judul = $this->input->post('judul');
			$isi = $this->input->post('isi');
            $addtime = $this->input->post('addtime');

			$where = array(
				'no_id' => $id
			);

			$data = array(
				'judul' => $judul,
				'isi' => $isi,
                'addtime' => $addtime,
			);

			$this->m_data->update_data($where, $data, 'datapenting_it');

			// Periksa apakah ada gambar yang diupload
			if (!empty($_FILES['file']['name'])) {

				$config['upload_path']   = './gambar/datait/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 2024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					// mengambil data tentang gambar yang diupload
					$gambar = $this->upload->data();

					$id = $this->input->post('no_id');
					$file = $gambar['file_name'];

					$data = array(
						'file' => $file
					);
					
					$where = array(
						'no_id' => $id
					);

					$this->m_data->update_data($where, $data, 'datapenting_it');					
				}
			}
			$this->session->set_flashdata('berhasil', 'Edit Data successfully, Judul : ' . $this->input->post('judul', TRUE) . ' !');
			redirect(base_url() . 'it/data');
		}
		else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			redirect(base_url() . 'it/data');
		}
	}

    public function data_hapus()
	{
		    $id = $this->input->post('no_id'); {
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'datapenting_it');
			$this->session->set_flashdata('berhasil', 'Data has been deleted !');
			redirect(base_url() . 'it/data');
		}
	}

	
}
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

	public function mobil()
	{
		$data['mobil'] = $this->m_data->get_data('type_vehicles')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('driver/v_mobil', $data);
		$this->load->view('dashboard/v_footer');
    }

	public function mobil_view()
	{
		$where = array(
			'type' => 'mobil'
		);
		$data['mobil'] = $this->m_data->edit_data($where, 'type_vehicles')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('driver/v_mobil_data', $data);
		$this->load->view('dashboard/v_footer');
    }
    
	public function mobil_add()
	{
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('plat', 'Plat', 'required');
		$this->form_validation->set_rules('addtime', 'Addtime', 'required');

		if ($this->form_validation->run() != false) {
			$type = $this->input->post('type');
			$merk = $this->input->post('merk');
			$plat = $this->input->post('plat');
			$addtime = $this->input->post('addtime');

			$data = array(
				'type' => $type,
				'merk' => $merk,
				'plat' => $plat,
				'addtime' => $addtime
			);

			$this->m_data->insert_data($data, 'type_vehicles');

			if (!empty($_FILES['file']['name'])) {

				$config['upload_path']   = './gambar/vehicles/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 1024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					$gambar = $this->upload->data();

					$file = $gambar['file_name'];

					$this->db->query("UPDATE type_vehicles SET `foto`='$file'");
				}
			}
			$this->session->set_flashdata('berhasil', 'Add Data successfully, type : ' . $this->input->post('type', TRUE) . ' !');
			redirect(base_url() . 'driver/mobil');
		}else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			redirect(base_url() . 'driver/mobil');
		}
	}

    public function mobil_edit()
	{
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('plat', 'Plat', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_id');
			$merk = $this->input->post('merk');
			$plat = $this->input->post('plat');

			$where = array(
				'no_id' => $id
			);

			$data = array(
				'merk' => $merk,
				'plat' => $plat
			);

			$this->m_data->update_data($where, $data, 'type_vehicles');

			// Periksa apakah ada gambar yang diupload
			if (!empty($_FILES['file']['name'])) {

				$config['upload_path']   = './gambar/vehicles/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 1024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					// mengambil data tentang gambar yang diupload
					$gambar = $this->upload->data();

					$id = $this->input->post('no_id');
					$file = $gambar['file_name'];

					$this->db->query("UPDATE type_vehicles SET `foto`='$file' where no_id='$id'");					
				}
			}
			$this->session->set_flashdata('berhasil', 'Edit Data successfully, Merk : ' . $this->input->post('merk', TRUE) . ' !');
			redirect(base_url() . 'driver/mobil');
		}
		else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			redirect(base_url() . 'driver/mobil');
		}
	}

    public function mobil_del()
	{
		    $id = $this->input->post('no_id'); 
		{
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'type_vehicles');
			$this->session->set_flashdata('berhasil', 'Data has been deleted !');
			redirect(base_url() . 'driver/mobil');
		}
	}

	public function mobil_odo($id)
	{
		$where = array(
			'no_id' => $id
		);
		$data['odo'] = $this->m_data->edit_data($where, 'driver')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('driver/v_mobil', $data);
		$this->load->view('dashboard/v_footer');
    }

	public function mobil_odo_add()
	{
		$this->form_validation->set_rules('join_id', 'No Id', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('odometer', 'Odometer', 'required');

		if ($this->form_validation->run() != false) {
			$join_id = $this->input->post('join_id');
			$nama = $this->input->post('nama');
			$tanggal = $this->input->post('tanggal');
			$odometer = $this->input->post('odometer');

			$data = array(
				'join_id' => $join_id,
				'nama' => $nama,
				'tanggal' => $tanggal,
				'odometer' => $odometer
			);

			$this->m_data->insert_data($data, 'driver');

			$this->session->set_flashdata('berhasil', 'Add Data successfully, odometer : ' . $this->input->post('odometer', TRUE) . ' !');
			redirect(base_url() . 'driver/mobil_odo');
		}else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			redirect(base_url() . 'driver/mobil_odo');
		}
	}

	public function mobil_odo_edit()
	{
		$this->form_validation->set_rules('odometer', 'Merk', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_id');
			$odometer = $this->input->post('odometer');

			$where = array(
				'no_id' => $id
			);

			$data = array(
				'odometer' => $odometer,
			);

			$this->m_data->update_data($where, $data, 'driver');

			$this->session->set_flashdata('berhasil', 'Edit Data successfully, odometer : ' . $this->input->post('odometer', TRUE) . ' !');
			redirect(base_url() . 'driver/mobil_odo');
		}
		else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			redirect(base_url() . 'driver/mobil_odo');
		}
	}

	public function mobil_odo_del()
	{
		    $id = $this->input->post('no_id'); 
		{
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'driver');
			$this->session->set_flashdata('berhasil', 'Data has been deleted !');
			redirect(base_url() . 'driver/mobil_odo');
		}
	}

	public function mobil_history($id)
	{
		$where = array(
			'no_id' => $id
		);
		$data['odo'] = $this->m_data->edit_data($where, 'driver')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('driver/v_mobil', $data);
		$this->load->view('dashboard/v_footer');
    }

	public function mobil_history_add()
	{
		$this->form_validation->set_rules('join_id', 'No Id', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('odometer', 'Odometer', 'required');

		if ($this->form_validation->run() != false) {
			$join_id = $this->input->post('join_id');
			$jenis = $this->input->post('jenis');
			$tanggal = $this->input->post('tanggal');
			$odometer = $this->input->post('odometer');

			$data = array(
				'join_id' => $join_id,
				'jenis' => $jenis,
				'tanggal' => $tanggal,
				'odometer' => $odometer
			);

			$this->m_data->insert_data($data, 'driver');

			$this->session->set_flashdata('berhasil', 'Add Data successfully, Jenis : ' . $this->input->post('jenis', TRUE) . ' !');
			redirect(base_url() . 'driver/mobil_history');
		}else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			redirect(base_url() . 'driver/mobil_history');
		}
	}
	
	public function mobil_history_edit()
	{
		$this->form_validation->set_rules('jenis', 'Merk', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('odometer', 'Odometer', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_id');

			$jenis = $this->input->post('jenis');
			$tanggal = $this->input->post('tanggal');
			$odometer = $this->input->post('odometer');

			$where = array(
				'no_id' => $id
			);

			$data = array(
				'jenis' => $jenis,
				'tanggal' => $tanggal,
				'odometer' => $odometer

			);

			$this->m_data->update_data($where, $data, 'history_vehicles');

			$this->session->set_flashdata('berhasil', 'Edit Data successfully, Jenis : ' . $this->input->post('jenis', TRUE) . ' !');
			redirect(base_url() . 'driver/mobil_history');
		}
		else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			redirect(base_url() . 'driver/mobil_history');
		}
	}

	public function mobil_history_del()
	{
		    $id = $this->input->post('no_id'); 
		{
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'history_vehicles');
			$this->session->set_flashdata('berhasil', 'Data has been deleted !');
			redirect(base_url() . 'driver/mobil_history');
		}
	}
}
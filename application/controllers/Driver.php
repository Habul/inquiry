<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->helper(array('form', 'url'));
		$this->load->model('m_data');
		$session = $this->session->userdata('status');
		if ($session == '') {
			redirect(base_url() . 'login?alert=belum_login');
		}
	}

	public function mobil()
	{
		$where = array(
			'type' => 'mobil'
		);

		$data['title'] = 'Tracking Car';
		$data['mobil'] = $this->m_data->edit_data($where, 'type_vehicles')->result();
		$data['id_add'] = $this->db->select_max('no_id')->get('type_vehicles')->row();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('driver/v_mobil', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function mobil_add()
	{
		$this->form_validation->set_rules('no_id', 'No Id', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('plat', 'Plat', 'required');
		$this->form_validation->set_rules('addtime', 'Addtime', 'required');

		if ($this->form_validation->run() != false) {
			$id = $this->input->post('no_id');
			$type = $this->input->post('type');
			$merk = $this->input->post('merk');
			$plat = $this->input->post('plat');
			$addtime = $this->input->post('addtime');

			$data = array(
				'no_id' => $id,
				'type' => $type,
				'merk' => $merk,
				'plat' => $plat,
				'addtime' => $addtime
			);

			$this->m_data->insert_data($data, 'type_vehicles');

			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/vehicles/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 1024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$gambar = $this->upload->data();

					$id = $this->input->post('no_id');
					$file = $gambar['file_name'];

					$this->db->query("UPDATE type_vehicles SET foto='$file' WHERE no_id='$id'");
				}
			}
			$this->session->set_flashdata('berhasil', 'Add data successfully, Merk : ' . $this->input->post('merk', TRUE) . ' !');
			redirect(base_url() . 'driver/mobil');
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			redirect(base_url() . 'driver/mobil');
		}
	}

	public function mobil_edit()
	{
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('plat', 'Plat', 'required');
		$this->form_validation->set_rules('addtime', 'Plat', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_id');

			$merk = $this->input->post('merk');
			$plat = $this->input->post('plat');
			$addtime = $this->input->post('addtime');

			$where = array(
				'no_id' => $id
			);

			$data = array(
				'merk' => $merk,
				'plat' => $plat,
				'addtime' => $addtime
			);

			$this->m_data->update_data($where, $data, 'type_vehicles');

			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/vehicles/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 1024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$gambar = $this->upload->data();

					$id = $this->input->post('no_id');
					$file = $gambar['file_name'];

					$this->db->query("UPDATE type_vehicles SET foto='$file' where no_id='$id'");
				}
			}
			$this->session->set_flashdata('berhasil', 'Edit Data successfully, Merk : ' . $this->input->post('merk', TRUE) . ' !');
			redirect(base_url() . 'driver/mobil');
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			redirect(base_url() . 'driver/mobil');
		}
	}

	public function mobil_del()
	{
		$id = $this->input->post('no_id'); {

			$where = array(
				'no_id' => $id
			);

			$where2 = array(
				'join_id' => $id
			);

			$this->m_data->delete_data($where, 'type_vehicles');
			$this->m_data->delete_data($where2, 'driver');
			$this->m_data->delete_data($where2, 'history_vehicles');
			$this->session->set_flashdata('berhasil', 'Data has been deleted !');
			redirect(base_url() . 'driver/mobil');
		}
	}

	public function mobil_odo($id)
	{
		$where = array(
			'no_id' => $id
		);

		$where2 = array(
			'join_id' => $id
		);

		$data['title'] = 'Tracking Car';
		$data['odo'] = $this->m_data->edit_data($where, 'type_vehicles')->result();
		$data['driver'] = $this->m_data->edit_data($where2, 'driver')->result();
		$data['history'] = $this->m_data->edit_data($where2, 'history_vehicles')->result();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('driver/v_mobil_data', $data);
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

			$this->session->set_flashdata('berhasil', 'Add history odometer successfully, odometer : ' . $this->input->post('odometer', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
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

			$this->session->set_flashdata('berhasil', 'Edit history odometer successfully, odometer : ' . $this->input->post('odometer', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
		}
	}

	public function mobil_odo_del()
	{
		$id = $this->input->post('no_id'); {
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'driver');
			$this->session->set_flashdata('berhasil', 'History odometer has been deleted !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
		}
	}

	public function mobil_history_add()
	{
		$this->form_validation->set_rules('join_id', 'No Id', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		//$this->form_validation->set_rules('odometer', 'Odometer', 'required');

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

			$this->m_data->insert_data($data, 'history_vehicles');

			$this->session->set_flashdata('berhasil', 'Add history service successfully, Jenis : ' . $this->input->post('jenis', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
		}
	}

	public function mobil_history_edit()
	{
		$this->form_validation->set_rules('jenis', 'Merk', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		//$this->form_validation->set_rules('odometer', 'Odometer', 'required');

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

			$this->session->set_flashdata('berhasil', 'Edit history service successfully, Jenis : ' . $this->input->post('jenis', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
		}
	}

	public function mobil_history_del()
	{
		$id = $this->input->post('no_id'); {
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'history_vehicles');
			$this->session->set_flashdata('berhasil', 'History service has been deleted !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/mobil_odo/' . $id);
		}
	}

	public function motor()
	{
		$where = array(
			'type' => 'motor'
		);

		$data['title'] = 'Tracking Motorcyle';
		$data['motor'] = $this->m_data->edit_data($where, 'type_vehicles')->result();
		$data['id_add'] = $this->db->select_max('no_id')->get('type_vehicles')->row();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('driver/v_motor', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function motor_add()
	{
		$this->form_validation->set_rules('no_id', 'No Id', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('plat', 'Plat', 'required');
		$this->form_validation->set_rules('addtime', 'Addtime', 'required');

		if ($this->form_validation->run() != false) {
			$id = $this->input->post('no_id');
			$type = $this->input->post('type');
			$merk = $this->input->post('merk');
			$plat = $this->input->post('plat');
			$addtime = $this->input->post('addtime');

			$data = array(
				'no_id' => $id,
				'type' => $type,
				'merk' => $merk,
				'plat' => $plat,
				'addtime' => $addtime
			);

			$this->m_data->insert_data($data, 'type_vehicles');

			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/vehicles/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 1024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$gambar = $this->upload->data();

					$id = $this->input->post('no_id');
					$file = $gambar['file_name'];

					$this->db->query("UPDATE type_vehicles SET foto='$file' WHERE no_id='$id'");
				}
			}
			$this->session->set_flashdata('berhasil', 'Add data successfully, Merk : ' . $this->input->post('merk', TRUE) . ' !');
			redirect(base_url() . 'driver/motor');
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			redirect(base_url() . 'driver/motor');
		}
	}

	public function motor_edit()
	{
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('plat', 'Plat', 'required');
		$this->form_validation->set_rules('addtime', 'Plat', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_id');

			$merk = $this->input->post('merk');
			$plat = $this->input->post('plat');
			$addtime = $this->input->post('addtime');

			$where = array(
				'no_id' => $id
			);

			$data = array(
				'merk' => $merk,
				'plat' => $plat,
				'addtime' => $addtime
			);

			$this->m_data->update_data($where, $data, 'type_vehicles');

			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/vehicles/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 1024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$gambar = $this->upload->data();

					$id = $this->input->post('no_id');
					$file = $gambar['file_name'];

					$this->db->query("UPDATE type_vehicles SET foto='$file' where no_id='$id'");
				}
			}
			$this->session->set_flashdata('berhasil', 'Edit Data successfully, Merk : ' . $this->input->post('merk', TRUE) . ' !');
			redirect(base_url() . 'driver/motor');
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			redirect(base_url() . 'driver/motor');
		}
	}

	public function motor_del()
	{
		$id = $this->input->post('no_id'); {

			$where = array(
				'no_id' => $id
			);

			$where2 = array(
				'join_id' => $id
			);

			$this->m_data->delete_data($where, 'type_vehicles');
			$this->m_data->delete_data($where2, 'driver');
			$this->m_data->delete_data($where2, 'history_vehicles');
			$this->session->set_flashdata('berhasil', 'Data has been deleted !');
			redirect(base_url() . 'driver/motor');
		}
	}

	public function motor_odo($id)
	{
		$where = array(
			'no_id' => $id
		);

		$where2 = array(
			'join_id' => $id
		);

		$data['title'] = 'Tracking Motorcyle';
		$data['odo'] = $this->m_data->edit_data($where, 'type_vehicles')->result();
		$data['driver'] = $this->m_data->edit_data($where2, 'driver')->result();
		$data['history'] = $this->m_data->edit_data($where2, 'history_vehicles')->result();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('driver/v_motor_data', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function motor_odo_add()
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

			$this->session->set_flashdata('berhasil', 'Add history odometer successfully, odometer : ' . $this->input->post('odometer', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		}
	}

	public function motor_odo_edit()
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

			$this->session->set_flashdata('berhasil', 'Edit history odometer successfully, odometer : ' . $this->input->post('odometer', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		}
	}

	public function motor_odo_del()
	{
		$id = $this->input->post('no_id'); {
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'driver');
			$this->session->set_flashdata('berhasil', 'History odometer has been deleted !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		}
	}

	public function motor_history_add()
	{
		$this->form_validation->set_rules('join_id', 'No Id', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		//$this->form_validation->set_rules('odometer', 'Odometer', 'required');

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

			$this->m_data->insert_data($data, 'history_vehicles');

			$this->session->set_flashdata('berhasil', 'Add history service successfully, Jenis : ' . $this->input->post('jenis', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		}
	}

	public function motor_history_edit()
	{
		$this->form_validation->set_rules('jenis', 'Merk', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		//$this->form_validation->set_rules('odometer', 'Odometer', 'required');

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

			$this->session->set_flashdata('berhasil', 'Edit history service successfully, Jenis : ' . $this->input->post('jenis', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		}
	}

	public function motor_history_del()
	{
		$id = $this->input->post('no_id'); {
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'history_vehicles');
			$this->session->set_flashdata('berhasil', 'History service has been deleted !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/motor_odo/' . $id);
		}
	}

	public function truck()
	{
		$where = array(
			'type' => 'truck'
		);

		$data['title'] = 'Tracking Truck';
		$data['truck'] = $this->m_data->edit_data($where, 'type_vehicles')->result();
		$data['id_add'] = $this->db->select_max('no_id')->get('type_vehicles')->row();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('driver/v_truck', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function truck_add()
	{
		$this->form_validation->set_rules('no_id', 'No Id', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('plat', 'Plat', 'required');
		$this->form_validation->set_rules('addtime', 'Addtime', 'required');

		if ($this->form_validation->run() != false) {
			$id = $this->input->post('no_id');
			$type = $this->input->post('type');
			$merk = $this->input->post('merk');
			$plat = $this->input->post('plat');
			$addtime = $this->input->post('addtime');

			$data = array(
				'no_id' => $id,
				'type' => $type,
				'merk' => $merk,
				'plat' => $plat,
				'addtime' => $addtime
			);

			$this->m_data->insert_data($data, 'type_vehicles');

			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/vehicles/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 1024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$gambar = $this->upload->data();

					$id = $this->input->post('no_id');
					$file = $gambar['file_name'];

					$this->db->query("UPDATE type_vehicles SET foto='$file' WHERE no_id='$id'");
				}
			}
			$this->session->set_flashdata('berhasil', 'Add data successfully, Merk : ' . $this->input->post('merk', TRUE) . ' !');
			redirect(base_url() . 'driver/truck');
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			redirect(base_url() . 'driver/truck');
		}
	}

	public function truck_edit()
	{
		$this->form_validation->set_rules('merk', 'Merk', 'required');
		$this->form_validation->set_rules('plat', 'Plat', 'required');
		$this->form_validation->set_rules('addtime', 'Plat', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_id');

			$merk = $this->input->post('merk');
			$plat = $this->input->post('plat');
			$addtime = $this->input->post('addtime');

			$where = array(
				'no_id' => $id
			);

			$data = array(
				'merk' => $merk,
				'plat' => $plat,
				'addtime' => $addtime
			);

			$this->m_data->update_data($where, $data, 'type_vehicles');

			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/vehicles/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= true;
				$config['max_size']     = 1024;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$gambar = $this->upload->data();

					$id = $this->input->post('no_id');
					$file = $gambar['file_name'];

					$this->db->query("UPDATE type_vehicles SET foto='$file' where no_id='$id'");
				}
			}
			$this->session->set_flashdata('berhasil', 'Edit Data successfully, Merk : ' . $this->input->post('merk', TRUE) . ' !');
			redirect(base_url() . 'driver/truck');
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			redirect(base_url() . 'driver/truck');
		}
	}

	public function truck_del()
	{
		$id = $this->input->post('no_id'); {

			$where = array(
				'no_id' => $id
			);

			$where2 = array(
				'join_id' => $id
			);

			$this->m_data->delete_data($where, 'type_vehicles');
			$this->m_data->delete_data($where2, 'driver');
			$this->m_data->delete_data($where2, 'history_vehicles');
			$this->session->set_flashdata('berhasil', 'Data has been deleted !');
			redirect(base_url() . 'driver/truck');
		}
	}

	public function truck_odo($id)
	{
		$where = array(
			'no_id' => $id
		);

		$where2 = array(
			'join_id' => $id
		);

		$data['title'] = 'Tracking Truck';
		$data['odo'] = $this->m_data->edit_data($where, 'type_vehicles')->result();
		$data['driver'] = $this->m_data->edit_data($where2, 'driver')->result();
		$data['history'] = $this->m_data->edit_data($where2, 'history_vehicles')->result();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('driver/v_truck_data', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function truck_odo_add()
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

			$this->session->set_flashdata('berhasil', 'Add history odometer successfully, odometer : ' . $this->input->post('odometer', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		}
	}

	public function truck_odo_edit()
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

			$this->session->set_flashdata('berhasil', 'Edit history odometer successfully, odometer : ' . $this->input->post('odometer', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		}
	}

	public function truck_odo_del()
	{
		$id = $this->input->post('no_id'); {
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'driver');
			$this->session->set_flashdata('berhasil', 'History odometer has been deleted !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		}
	}

	public function truck_history_add()
	{
		$this->form_validation->set_rules('join_id', 'No Id', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		//$this->form_validation->set_rules('odometer', 'Odometer', 'required');

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

			$this->m_data->insert_data($data, 'history_vehicles');

			$this->session->set_flashdata('berhasil', 'Add history service successfully, Jenis : ' . $this->input->post('jenis', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		}
	}

	public function truck_history_edit()
	{
		$this->form_validation->set_rules('jenis', 'Merk', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		//$this->form_validation->set_rules('odometer', 'Odometer', 'required');

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

			$this->session->set_flashdata('berhasil', 'Edit history service successfully, Jenis : ' . $this->input->post('jenis', TRUE) . ' !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		} else {
			$this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		}
	}

	public function truck_history_del()
	{
		$id = $this->input->post('no_id'); {
			$where = array(
				'no_id' => $id
			);
			$this->m_data->delete_data($where, 'history_vehicles');
			$this->session->set_flashdata('berhasil', 'History service has been deleted !');
			$id = $this->input->post('join_id');
			redirect(base_url() . 'driver/truck_odo/' . $id);
		}
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sj extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->helper(array('form', 'url'));
		$this->load->model('m_data');
	}

	public function sj()
	{
		$data['sj_user'] = $this->m_data->get_data('sj_user')->result();
		$data['sj_hs'] = $this->m_data->get_data('sj_hs')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('sj/v_sj', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function sj_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('no_delivery', 'No Delivery', 'required');
		$this->form_validation->set_rules('date_delivery', 'Date Delivery', 'required');
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		$this->form_validation->set_rules('no_po', 'No PO', 'required');
		$this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('addtime', 'Addtime', 'required');

		if ($this->form_validation->run() != false) {

			$no_delivery = $this->input->post('no_delivery');
			$date_delivery = $this->input->post('date_delivery');
			$due_date = $this->input->post('due_date');
			$no_po = $this->input->post('no_po');
			$cust_name = $this->input->post('cust_name');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$phone = $this->input->post('phone');
			$addtime = $this->input->post('addtime');

			$data = array(
				'no_delivery' => $no_delivery,
				'date_delivery' => $date_delivery,
				'due_date' => $due_date,
				'no_po' => $no_po,
				'cust_name' => $cust_name,
				'address' => $address,
				'city' => $city,
				'phone' => $phone,
				'addtime' => $addtime
			);

			$this->m_data->insert_data($data, 'sj_user');
			$this->session->set_flashdata('berhasil', 'Surat jalan berhasil di Tambah No  : '.$this->input->post('no_delivery',TRUE).' !');
			redirect(base_url() . 'sj/sj');
		} else {
			$this->session->set_flashdata('gagal', 'SJ Gagal di Tambah, Silahkan input ulang!!');
			redirect(base_url() . 'sj/sj');
		}
	}

	public function sj_isi($id)
	{
		$where = array(
			'no_po' => $id
		);
		
		$data['sj_user'] = $this->m_data->get_data('sj_user')->result();
		$data['sj_hs'] = $this->m_data->get_data('sj_hs')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('sj/v_sj_isi', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function sj_update()
	{
		// Wajib isi
		$this->form_validation->set_rules('descript', 'Deskripsi', 'required');
		$this->form_validation->set_rules('qty', 'Qty', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_po');
			$descript = $this->input->post('descript');
			$qty = $this->input->post('qty');
			if ($this->form_validation->run() != false) {
				$data = array(
					'descript' => $descript,
					'qty' => $qty
				);
			}
			$where = array(
				'no_po' => $id
			);
			$this->m_data->update_data($where, $data, 'sj_hs');
			$this->session->set_flashdata('berhasil', 'Surat jalan berhasil di Buat No Po : '.$this->input->post('id',TRUE).' !');
			redirect(base_url() . 'sj/sj');
		}
		else {
			$this->session->set_flashdata('gagal', 'Sj Gagal di Buat, silahkan di buat kembali !');
			redirect(base_url() . 'sj/sj');
		}
	}

	public function sj_edit()
	{
		// Wajib isi
		$this->form_validation->set_rules('no_delivery', 'No Delivery', 'required');
		$this->form_validation->set_rules('date_delivery', 'Date Delivery', 'required');
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		$this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_po');

			$no_delivery = $this->input->post('no_delivery');
			$date_delivery = $this->input->post('date_delivery');
			$due_date = $this->input->post('due_date');
			$cust_name = $this->input->post('cust_name');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$phone = $this->input->post('phone');
			if ($this->form_validation->run() != false) {
				$data = array(

					'no_delivery' => $no_delivery,
					'date_delivery' => $date_delivery,
					'due_date' => $due_date,
					'cust_name' => $cust_name,
					'address' => $address,
					'city' => $city,
					'phone' => $phone
				);
			}

			$where = array(
				'no_po' => $id
			);
			$this->m_data->update_data($where, $data, 'sj_user');
			$this->session->set_flashdata('berhasil', 'Surat jalan berhasil di Edit No po : '.$this->input->post('po_no',TRUE).' !');
			redirect(base_url() . 'sj/sj');
		} else {
			$this->session->set_flashdata('gagal', 'Surat jalan Gagal di Edit, silahkan di ulang!');
			redirect(base_url() . 'sj/sj');
		}
	}

	public function sj_hapus()
	{
	$id = $this->input->post('no_po');
		{
		$where = array(
			'no_po' => $id
		);
		$this->m_data->delete_data($where, 'sj_hs');
		$this->m_data->delete_data($where, 'sj_user');
		$this->session->set_flashdata('message', 'Sj berhasil di Hapus !');
		redirect(base_url() . 'sj/sj');
		}
	}

}
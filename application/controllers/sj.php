<?php
defined('BASEPATH') or exit('No direct script access allowed');

class sj extends CI_Controller
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
			$this->session->set_flashdata('berhasil', 'SJ successfully added, No Po : ' . $this->input->post('no_po', TRUE) . ' !');
			redirect(base_url() . 'sj/sj');
		} else {
			$this->session->set_flashdata('gagal', 'SJ failed to add, Please repeat !');
			redirect(base_url() . 'sj/sj');
		}
	}

	public function sj_update()
	{
		// Wajib isi
		//$this->form_validation->set_rules('no_urut', 'No Urut', 'required');
		$this->form_validation->set_rules('descript', 'Deskripsi', 'required');
		$this->form_validation->set_rules('qty', 'Qty', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$descript = $this->input->post('descript');
			$qty = $this->input->post('qty');

			$data = array(
				'no_po' => $id,
				'descript' => $descript,
				'qty' => $qty
			);

			$this->m_data->insert_data($data, 'sj_hs');
			$this->session->set_flashdata('berhasil', 'No Po ' . $this->input->post('id', TRUE) . ' Successfully added Desc : ' . $this->input->post('descript', TRUE) . '  !');
			redirect(base_url() . 'sj/sj');
		} else {
			$this->session->set_flashdata('gagal', 'SJ Desc failed to add, Please repeat !');
			redirect(base_url() . 'sj/sj');
		}
	}

	public function sj_edit()
	{
		// Wajib isi
		$this->form_validation->set_rules('no_delivery', 'No Delivery', 'required');
		$this->form_validation->set_rules('date_delivery', 'Date Delivery', 'required');
		$this->form_validation->set_rules('no_po', 'No Po', 'required');
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		$this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('no_po');

			$no_delivery = $this->input->post('no_delivery');
			$date_delivery = $this->input->post('date_delivery');
			$no_po = $this->input->post('no_po');
			$due_date = $this->input->post('due_date');
			$cust_name = $this->input->post('cust_name');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$phone = $this->input->post('phone');
			$addtime2 = $this->input->post('addtime2');
			if ($this->form_validation->run() != false) {
				$data = array(

					'no_delivery' => $no_delivery,
					'date_delivery' => $date_delivery,
					'due_date' => $due_date,
					'no_po' => $no_po,
					'cust_name' => $cust_name,
					'address' => $address,
					'city' => $city,
					'phone' => $phone,
					'addtime2' => $addtime2
				);
			}

			$where = array(
				'no_po' => $id
			);
			$this->m_data->update_data($where, $data, 'sj_user');
			$this->session->set_flashdata('berhasil', 'SJ successfully Update, No Po : ' . $this->input->post('no_po', TRUE) . ' !');
			redirect(base_url() . 'sj/sj');
		} else {
			$this->session->set_flashdata('gagal', 'SJ failed to Update, Please repeat !');
			redirect(base_url() . 'sj/sj');
		}
	}

	public function sj_hapus()
	{
		$id = $this->input->post('no_po'); {
			$where = array(
				'no_po' => $id
			);
			$this->m_data->delete_data($where, 'sj_hs');
			$this->m_data->delete_data($where, 'sj_user');
			$this->session->set_flashdata('berhasil', 'SJ has been deleted !');
			redirect(base_url() . 'sj/sj');
		}
	}

	public function sj_print($id)
	{
		//$this->load->library('mypdf');
		$where = array(
			'no_po' => $id
		);	
		$data['sj_user'] = $this->m_data->edit_data($where, 'sj_user')->result();
		$data['sj_hs'] = $this->m_data->edit_data($where, 'sj_hs')->result();
		$this->load->view('sj/hs_sj', $data);			
		//$this->mypdf->generate('sj/hs_sj', $data, 'surat-jalan', 'A4', 'landscape');
	}
}

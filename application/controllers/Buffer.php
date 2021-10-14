<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buffer extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->helper(array('form', 'url'));
		$this->load->model('m_data');
	}

	public function buffer()
	{
		$data['master'] = $this->m_data->get_master()->result();
		$data['buffer'] = $this->m_data->get_data('buffer')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('buffer/v_buffer', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function buffer_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('id_buffer', 'Id Buffer', 'required');
		$this->form_validation->set_rules('sales', 'Nama Sales', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('brand', 'Brand Produk', 'required');
		$this->form_validation->set_rules('deskripsi', 'Description Produk', 'required');
		$this->form_validation->set_rules('qty', 'Quantity', 'required');
		$this->form_validation->set_rules('keter', 'Keterangan', 'required');

		if ($this->form_validation->run() != false) {

			$id_buffer = $this->input->post('id_buffer');
			$sales = $this->input->post('sales');
			$tanggal = $this->input->post('tanggal');
			$brand = $this->input->post('brand');
			$deskripsi = $this->input->post('deskripsi');
			$qty = $this->input->post('qty');
			$keter = $this->input->post('keter');

			$data = array(
				'id_buffer' => $id_buffer,
				'sales' => $sales,
				'tanggal' => $tanggal,
				'brand' => $brand,
				'deskripsi' => $deskripsi,
				'qty' => $qty,
				'keter' => $keter
			);

			$this->m_data->insert_data($data, 'buffer');
			$this->session->set_flashdata('berhasil', 'Buffer berhasil di Tambah No ID : ' . $this->input->post('id_buffer', TRUE) . ' !');
			redirect(base_url() . 'buffer/buffer');
		} else {
			$this->session->set_flashdata('gagal', 'Buffer Gagal di Tambah, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'buffer/buffer');
		}
	}

	public function buffer_update()
	{
		// Wajib isi
		$this->form_validation->set_rules('status', 'Check', 'required');
		$this->form_validation->set_rules('pr_no', 'PR No', 'required');
		$this->form_validation->set_rules('fu', 'Follow Up', 'required');
		$this->form_validation->set_rules('wh', 'Warehouse', 'required');
		//$this->form_validation->set_rules('ket_wh', 'Ket Warehouse', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$wh = $this->input->post('wh');
			$fu = $this->input->post('fu');
			$status = $this->input->post('status');
			$pr_no = $this->input->post('pr_no');
			$ket_wh = $this->input->post('ket_wh');
			if ($this->form_validation->run() != false) {
				$data = array(
					'wh' => $wh,
					'fu' => $fu,
					'status' => $status,
					'pr_no' => $pr_no,
					'ket_wh' => $ket_wh
				);
			}
			$where = array(
				'id_buffer' => $id
			);
			$this->m_data->update_data($where, $data, 'buffer');
			$this->session->set_flashdata('berhasil', 'Buffer berhasil di Update No ID : ' . $this->input->post('id', TRUE) . ' !');
			redirect(base_url() . 'buffer/buffer');
		} else {
			$this->session->set_flashdata('gagal', 'Buffer Gagal di Update, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'buffer/buffer');
		}
	}

	public function buffer_edit()
	{
		// Wajib isi
		$this->form_validation->set_rules('sales', 'Nama Sales', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('brand', 'Brand Produk', 'required');
		$this->form_validation->set_rules('deskripsi', 'Description Product', 'required');
		$this->form_validation->set_rules('qty', 'Quantity', 'required');
		$this->form_validation->set_rules('keter', 'Keterangan', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$sales = $this->input->post('sales');
			$tanggal = $this->input->post('tanggal');
			$brand = $this->input->post('brand');
			$deskripsi = $this->input->post('deskripsi');
			$qty = $this->input->post('qty');
			$keter = $this->input->post('keter');

			if ($this->form_validation->run() != false) {
				$data = array(

					'sales' => $sales,
					'tanggal' => $tanggal,
					'brand' => $brand,
					'deskripsi' => $deskripsi,
					'qty' => $qty,
					'keter' => $keter
				);
			}

			$where = array(
				'id_buffer' => $id
			);
			$this->m_data->update_data($where, $data, 'buffer');
			$this->session->set_flashdata('berhasil', 'Buffer berhasil di Edit No ID : ' . $this->input->post('id', TRUE) . ' !');
			redirect(base_url() . 'buffer/buffer');
		} else {
			$this->session->set_flashdata('gagal', 'Buffer Gagal di Edit, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'buffer/buffer');
		}
	}

	public function buffer_hapus()
	{
		$id = $this->input->post('id_buffer'); {
			$where = array(
				'id_buffer' => $id
			);
			$this->m_data->delete_data($where, 'buffer');
			$this->session->set_flashdata('message', 'Buffer berhasil di Hapus !');
			redirect(base_url() . 'buffer/buffer');
		}
	}

	public function buffer_view()
	{
		$data['buffer'] = $this->m_data->select_buffer();

		$this->load->view('dashboard/v_header');
		$this->load->view('buffer/v_buffer_view', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function buffer_export()
	{
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->m_data->select_buffer();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "Id Buffer");
		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Nama Sales");
		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "Tanggal");
		$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "Brand Produk");
		$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "Deskripsi");
		$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "Qty");
		$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "Keter(sales)");
		$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "Status");
		$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, "PR No");
		$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, "Nama WH");
		$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, "Follow Up");
		$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, "Keter(WH)");
		$rowCount++;

		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->id_buffer);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->sales);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->tanggal);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->brand);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->deskripsi);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->qty);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->keter);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->status);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $value->pr_no);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $value->wh);
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $value->fu);
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $value->ket_wh);
			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data Buffer.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data Buffer.xlsx', NULL);
	}
}

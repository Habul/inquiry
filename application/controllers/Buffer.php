<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
		$data['userdata'] = $this->userdata;
		$data['master'] = $this->m_data->get_master()->result();
		$data['buffer'] = $this->m_data->get_data('buffer')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('buffer/v_buffer', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function buffer_aksi()
	{
		// Wajib isi
		//$this->form_validation->set_rules('id_buffer', 'Id Buffer', 'required');
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
			$this->session->set_flashdata('berhasil', 'Buffer berhasil di Tambah No Buffer : ' . $this->input->post('id_buffer', TRUE) . ' !');
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
			$this->session->set_flashdata('berhasil', 'Buffer berhasil di Hapus !');
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
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('A1', 'Id Buffer');
			$sheet->setCellValue('B1', 'Nama Sales');
			$sheet->setCellValue('C1', 'Tanggal');
			$sheet->setCellValue('D1', 'Brand');
			$sheet->setCellValue('E1', 'Deskripsi');
			$sheet->setCellValue('F1', 'Qty');
			$sheet->setCellValue('G1', 'Keter(sales)');
			$sheet->setCellValue('H1', 'Status');
			$sheet->setCellValue('I1', 'PR No');
			$sheet->setCellValue('J1', 'Nama WH');
			$sheet->setCellValue('K1', 'Follow Up');
			$sheet->setCellValue('L1', 'Keter(WH)');
			
			$data = $this->m_data->select_buffer();
			$x = 2;
			foreach($data as $row)
			{
				$sheet->setCellValue('A'.$x, $row->id_buffer);
				$sheet->setCellValue('B'.$x, $row->sales);
				$sheet->setCellValue('C'.$x, $row->tanggal);
				$sheet->setCellValue('D'.$x, $row->brand);
				$sheet->setCellValue('E'.$x, $row->deskripsi);
				$sheet->setCellValue('F'.$x, $row->qty);
				$sheet->setCellValue('G'.$x, $row->keter);
				$sheet->setCellValue('H'.$x, $row->status);
				$sheet->setCellValue('I'.$x, $row->pr_no);
				$sheet->setCellValue('J'.$x, $row->wh);
				$sheet->setCellValue('K'.$x, $row->fu);
				$sheet->setCellValue('L'.$x, $row->ket_wh);

				$x++;
			}
			$writer = new Xlsx($spreadsheet);
			$filename = 'Data-Buffer';
			
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
	}
}

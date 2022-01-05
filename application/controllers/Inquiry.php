<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Inquiry extends CI_Controller
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

	public function inquiry()
	{
		$data['title'] = 'Inquiry';
		$data['kurs'] = $this->m_data->get_kurs()->result();
		$data['master'] = $this->m_data->get_master()->result();
		$data['inquiry'] = $this->m_data->get_data('inquiry')->result();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('inquiry/v_inquiry', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_aksi()
	{
		//$this->form_validation->set_rules('inquiry_id', 'No Inquiry', 'required');
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
			$this->session->set_flashdata('berhasil', 'Inquiry berhasil di Tambah No ID : ' . $this->input->post('inquiry_id', TRUE) . ' !');
			redirect(base_url() . 'inquiry/inquiry');
		} else {
			$this->session->set_flashdata('gagal', 'Inquiry Gagal di Tambah, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'inquiry/inquiry');
		}
	}

	public function inquiry_update_prch($id)
	{
		$where = array(
			'inquiry_id' => $id
		);
		$data['title'] = 'Inquiry';
		$data['inquiry'] = $this->m_data->edit_data($where, 'inquiry')->result();
		$data['kurs'] = $this->m_data->get_data('kurs')->result();
		$data['master'] = $this->m_data->get_data('master')->result();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('inquiry/v_inquiry_update', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_update()
	{
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
		//$this->form_validation->set_rules('ket_purch', 'Keterangan purchase', 'required');
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
			$this->session->set_flashdata('berhasil', 'Inquiry berhasil di Update No ID : ' . $this->input->post('id', TRUE) . ' !');
			redirect(base_url() . 'inquiry/inquiry');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'inquiry_id' => $id
			);
			$data['inquiry'] = $this->m_data->edit_data($where, 'inquiry')->result();
			$this->session->set_flashdata('gagal', 'Inquiry Gagal di Update, ada form yang belum terisi, silahkan cek kembali !!!');
			$this->load->view('dashboard/v_header');
			$this->load->view('tracking/v_inquiry_update', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function inquiry_update_sales()
	{
		$this->form_validation->set_rules('sales', 'Nama Sales', 'required');
		$this->form_validation->set_rules('tanggal2', 'Tanggal', 'required');
		$this->form_validation->set_rules('brand', 'Brand Produk', 'required');
		$this->form_validation->set_rules('desc', 'Description Product', 'required');
		$this->form_validation->set_rules('qty', 'Quantity', 'required');
		$this->form_validation->set_rules('deadline', 'Deadline', 'required');
		$this->form_validation->set_rules('keter', 'Keterangan', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$sales = $this->input->post('sales');
			$tanggal2 = $this->input->post('tanggal2');
			$brand = $this->input->post('brand');
			$desc = $this->input->post('desc');
			$qty = $this->input->post('qty');
			$deadline = $this->input->post('deadline');
			$keter = $this->input->post('keter');

			if ($this->form_validation->run() != false) {
				$data = array(
					'sales' => $sales,
					'tanggal2' => $tanggal2,
					'brand' => $brand,
					'desc' => $desc,
					'qty' => $qty,
					'deadline' => $deadline,
					'keter' => $keter

				);
			}

			$where = array(
				'inquiry_id' => $id
			);

			$this->m_data->update_data($where, $data, 'inquiry');
			$this->session->set_flashdata('berhasil', 'Inquiry berhasil di Edit No ID : ' . $this->input->post('id', TRUE) . ' !');
			redirect(base_url() . 'inquiry/inquiry');
		} else {
			$this->session->set_flashdata('gagal', 'Buffer Gagal di Edit, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'inquiry/inquiry');
		}
	}

	public function inquiry_hapus()
	{
		$id = $this->input->post('inquiry_id'); {
			$where = array(
				'inquiry_id' => $id
			);

			$this->m_data->delete_data($where, 'inquiry');
			$this->session->set_flashdata('berhasil', 'Inquiry berhasil di Hapus !');
			redirect(base_url() . 'inquiry/inquiry');
		}
	}

	public function inquiry_view()
	{
		$data['title'] = 'Arship Inquiry';
		$data['inquiry'] = $this->m_data->select_inquiry();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('inquiry/v_inquiry_view', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_export()
	{
		$this->load->model('m_data');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'ID Inquiry');
		$sheet->setCellValue('B1', 'Nama Sales');
		$sheet->setCellValue('C1', 'Tanggal');
		$sheet->setCellValue('D1', 'Brand Produk');
		$sheet->setCellValue('E1', 'Desc');
		$sheet->setCellValue('F1', 'Qty');
		$sheet->setCellValue('G1', 'Deadline');
		$sheet->setCellValue('H1', 'Keter Sales');
		$sheet->setCellValue('I1', 'Request');
		$sheet->setCellValue('J1', 'Check');
		$sheet->setCellValue('K1', 'Follow Up');
		$sheet->setCellValue('L1', 'Keter Fu');
		$sheet->setCellValue('M1', 'Cogs');
		$sheet->setCellValue('N1', 'Kurs');
		$sheet->setCellValue('O1', 'Cogs IDR');
		$sheet->setCellValue('P1', 'Reseller');
		$sheet->setCellValue('Q1', 'New Seller');
		$sheet->setCellValue('R1', 'User');
		$sheet->setCellValue('S1', 'Delivery');
		$sheet->setCellValue('T1', 'Keter Purchase');
		$sheet->setCellValue('U1', 'Nama Purchase');


		$data = $this->m_data->select_inquiry();
		$x = 2;
		foreach ($data as $row) {
			$sheet->setCellValue('A' . $x, $row->inquiry_id);
			$sheet->setCellValue('B' . $x, $row->sales);
			$sheet->setCellValue('C' . $x, $row->tanggal);
			$sheet->setCellValue('D' . $x, $row->brand);
			$sheet->setCellValue('E' . $x, $row->desc);
			$sheet->setCellValue('E' . $x, $row->qty);
			$sheet->setCellValue('G' . $x, $row->deadline);
			$sheet->setCellValue('H' . $x, $row->keter);
			$sheet->setCellValue('I' . $x, $row->request);
			$sheet->setCellValue('J' . $x, $row->cek);
			$sheet->setCellValue('K' . $x, $row->fu1);
			$sheet->setCellValue('L' . $x, $row->ket_fu);
			$sheet->setCellValue('M' . $x, $row->cogs);
			$sheet->setCellValue('N' . $x, $row->kurs);
			$sheet->setCellValue('O' . $x, $row->cogs_idr);
			$sheet->setCellValue('P' . $x, $row->reseller);
			$sheet->setCellValue('Q' . $x, $row->new_seller);
			$sheet->setCellValue('R' . $x, $row->user);
			$sheet->setCellValue('S' . $x, $row->delivery);
			$sheet->setCellValue('T' . $x, $row->ket_purch);
			$sheet->setCellValue('U' . $x, $row->name_purch);



			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'Data Inquiry';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function inquiry_master()
	{
		$data['title'] = 'Master Inquiry';
		$data['master'] = $this->m_data->get_data('master')->result();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('inquiry/v_inquiry_master', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_master_aksi()
	{
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
			$this->session->set_flashdata('berhasil', 'Master berhasil di Tambah dengan nama Brand : ' . $this->input->post('brand', TRUE) . ' !');
			redirect(base_url() . 'inquiry/inquiry_master');
		} else {
			$this->session->set_flashdata('gagal', 'Master Gagal di Tambah, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'inquiry/inquiry_master');
		}
	}

	public function inquiry_master_hapus()
	{
		$id = $this->input->post('id_master'); {
			$where = array(
				'id_master' => $id
			);

			$this->m_data->delete_data($where, 'master');
			$this->session->set_flashdata('berhasil', 'Master berhasil di Hapus !');
			redirect(base_url() . 'inquiry/inquiry_master');
		}
	}

	public function inquiry_master_update()
	{
		$this->form_validation->set_rules('d1', 'D1', 'required');
		$this->form_validation->set_rules('d2', 'D2', 'required');
		$this->form_validation->set_rules('user', 'USER', 'required');
		//$this->form_validation->set_rules('distributor', 'Manufacture/Distributor', 'required');

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
			$this->session->set_flashdata('berhasil', 'Master berhasil di Update dengan nama Brand ' . $this->input->post('brand', TRUE) . ' !');
			redirect(base_url() . 'inquiry/inquiry_master');
		} else {
			$this->session->set_flashdata('gagal', 'Master Gagal di Update, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'inquiry/inquiry_master');
		}
	}

	public function inquiry_master_export()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Brand');
		$sheet->setCellValue('C1', 'D1');
		$sheet->setCellValue('D1', 'D2');
		$sheet->setCellValue('E1', 'User');
		$sheet->setCellValue('F1', 'Manufature/Distributor');

		$data = $this->m_data->select_master();
		$no = 1;
		$x = 2;
		foreach ($data as $row) {
			$sheet->setCellValue('A' . $x, $no++);
			$sheet->setCellValue('B' . $x, $row->brand);
			$sheet->setCellValue('C' . $x, $row->d1);
			$sheet->setCellValue('D' . $x, $row->d2);
			$sheet->setCellValue('E' . $x, $row->user);
			$sheet->setCellValue('F' . $x, $row->distributor);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'Master-Inquiry';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function inquiry_master_import()
	{
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] != '') {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			$config['overwrite']	= true;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('excel')) {
				$this->upload->display_errors();
			} else {
				$data = $this->upload->data();
				$this->db->empty_table('master');

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');
				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';
				$inputFileName = './assets/excel/' . $data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) { {
							$resultData[$index]['id_master'] = $value['A'];
							$resultData[$index]['brand'] = $value['B'];
							$resultData[$index]['d1'] = $value['C'];
							$resultData[$index]['d2'] = $value['D'];
							$resultData[$index]['user'] = $value['E'];
							$resultData[$index]['distributor'] = $value['F'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' . $data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->m_data->insert_master($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('berhasil', 'Data Master Berhasil diimport ke database');
						redirect('inquiry/inquiry_master');
					}
				} else {
					$this->session->set_flashdata('gagal', 'Data Master Gagal diimport ke database');
					redirect('inquiry/inquiry_master');
				}
			}
		}
	}

	public function inquiry_kurs()
	{
		$data['title'] = 'Kurs';
		$data['kurs'] = $this->m_data->get_data('kurs')->result();
		$this->load->view('dashboard/v_header', $data);
		$this->load->view('inquiry/v_inquiry_kurs', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_kurs_aksi()
	{
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
			$this->session->set_flashdata('berhasil', 'Kurs ' . $this->input->post('currency', TRUE) . ' Berhasil di Tambah !');
			redirect(base_url() . 'inquiry/inquiry_kurs');
		} else {
			$this->session->set_flashdata('gagal', 'Kurs Gagal di Tambah, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'inquiry/inquiry_kurs');
		}
	}

	public function inquiry_kurs_update()
	{
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
			$this->session->set_flashdata('berhasil', 'Kurs ' . $this->input->post('currency', TRUE) . ' Berhasil di Update !');
			redirect(base_url() . 'inquiry/inquiry_kurs');
		} else {
			$this->session->set_flashdata('gagal', 'Kurs Gagal di Update, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'inquiry/inquiry_kurs');
		}
	}

	public function inquiry_kurs_hapus()
	{
		$id = $this->input->post('id_kurs'); {
			$where = array(
				'id_kurs' => $id
			);
			$this->m_data->delete_data($where, 'kurs');
			$this->session->set_flashdata('berhasil', 'Kurs Berhasil di Hapus !');
			redirect(base_url() . 'inquiry/inquiry_kurs');
		}
	}

	public function inquiry_kurs_export()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Currency');
		$sheet->setCellValue('C1', 'Amount');

		$data = $this->m_data->select_kurs();
		$no = 1;
		$x = 2;
		foreach ($data as $row) {
			$sheet->setCellValue('A' . $x, $no++);
			$sheet->setCellValue('B' . $x, $row->currency);
			$sheet->setCellValue('C' . $x, $row->amount);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'Kurs-Inquiry';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function inquiry_kurs_import()
	{
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] != '') {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			$config['overwrite']	= true;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('excel')) {
				$this->upload->display_errors();
			} else {
				$data = $this->upload->data();
				$this->db->empty_table('kurs');

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');
				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';
				$inputFileName = './assets/excel/' . $data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) { {
							$resultData[$index]['id_kurs'] = $value['A'];
							$resultData[$index]['currency'] = $value['B'];
							$resultData[$index]['amount'] = $value['C'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' . $data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->m_data->insert_kurs($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('berhasil', 'Data Kurs Berhasil diimport ke database');
						redirect('inquiry/inquiry_kurs');
					}
				} else {
					$this->session->set_flashdata('gagal', 'Data Kurs Gagal diimport ke database');
					redirect('inquiry/inquiry_kurs');
				}
			}
		}
	}
}

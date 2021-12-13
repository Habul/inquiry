<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inquiry extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->helper(array('form', 'url'));
		$this->load->model('m_data');
	}

	public function inquiry()
	{
		$data['kurs'] = $this->m_data->get_kurs()->result();
		$data['master'] = $this->m_data->get_master()->result();
		$data['inquiry'] = $this->m_data->get_data('inquiry')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function inquiry_aksi()
	{
		// Wajib isi
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

        $data['inquiry'] = $this->m_data->edit_data($where, 'inquiry')->result();
        $data['kurs'] = $this->m_data->get_data('kurs')->result();
		$data['master'] = $this->m_data->get_data('master')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('inquiry/v_inquiry_update', $data);
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
		// Wajib isi
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

		$data = $this->m_data->select_inquiry();

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

	public function inquiry_master()
	{
		$data['master'] = $this->m_data->get_data('master')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_master', $data);
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
		// Wajib isi
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
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->m_data->select_master();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "ID Master");
		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Brand Product");
		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "D1");
		$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "D2");
		$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "User");
		$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "Distributor");
		$rowCount++;

		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->id_master);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->brand);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->d1);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->d2);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->user);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->distributor);

			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data Master.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data Master.xlsx', NULL);
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
		$data['kurs'] = $this->m_data->get_data('kurs')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('inquiry/v_inquiry_kurs', $data);
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
			$this->session->set_flashdata('berhasil', 'Kurs ' . $this->input->post('currency', TRUE) . ' Berhasil di Tambah !');
			redirect(base_url() . 'inquiry/inquiry_kurs');
		} else {
			$this->session->set_flashdata('gagal', 'Kurs Gagal di Tambah, ada form yang belum terisi, silahkan cek kembali !!!');
			redirect(base_url() . 'inquiry/inquiry_kurs');
		}
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
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->m_data->select_kurs();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "ID Kurs");
		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Currency");
		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "Amount");
		$rowCount++;

		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->id_kurs);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->currency);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->amount);
			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data Kurs.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data Kurs.xlsx', NULL);
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

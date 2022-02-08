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
    $this->load->model('m_data');
    $session = $this->session->userdata('status');
    if ($session == '') {
      redirect(base_url() . 'login?alert=belum_login');
    }
  }

  public function buffer()
  {
    $data['title'] = 'Buffer Stock';
    $data['master'] = $this->m_data->get_data('master')->result();
    $data['buffer'] = $this->m_data->buffer();
    $data['id_add'] = $this->db->select_max('id_buffer')->get('buffer')->row();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('buffer/v_buffer', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function buffer_aksi()
  {
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
    $data['title'] = 'Arsip Buffer';
    $data['buffer'] = $this->m_data->arshipbuffer();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('buffer/v_buffer_view', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function buffer_export()
  {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $style_col = [
      'font' => ['bold' => true],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
      ]
    ];

    $style_row = [
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
      ]
    ];

    $sheet->setCellValue('A1', "DATA BUFFER STOCK");
    $sheet->mergeCells('A1:L1');
    $sheet->getStyle('A1')->getFont()->setBold(true);

    $sheet->setCellValue('A3', 'Id Buffer');
    $sheet->setCellValue('B3', 'Nama Sales');
    $sheet->setCellValue('C3', 'Tanggal');
    $sheet->setCellValue('D3', 'Brand');
    $sheet->setCellValue('E3', 'Deskripsi');
    $sheet->setCellValue('F3', 'Qty');
    $sheet->setCellValue('G3', 'Keter(sales)');
    $sheet->setCellValue('H3', 'Status');
    $sheet->setCellValue('I3', 'PR No');
    $sheet->setCellValue('J3', 'Nama WH');
    $sheet->setCellValue('K3', 'Follow Up');
    $sheet->setCellValue('L3', 'Keter(WH)');

    $sheet->getStyle('A3')->applyFromArray($style_col);
    $sheet->getStyle('B3')->applyFromArray($style_col);
    $sheet->getStyle('C3')->applyFromArray($style_col);
    $sheet->getStyle('D3')->applyFromArray($style_col);
    $sheet->getStyle('E3')->applyFromArray($style_col);
    $sheet->getStyle('F3')->applyFromArray($style_col);
    $sheet->getStyle('G3')->applyFromArray($style_col);
    $sheet->getStyle('H3')->applyFromArray($style_col);
    $sheet->getStyle('I3')->applyFromArray($style_col);
    $sheet->getStyle('J3')->applyFromArray($style_col);
    $sheet->getStyle('K3')->applyFromArray($style_col);
    $sheet->getStyle('L3')->applyFromArray($style_col);

    $data = $this->m_data->arshipbuffer();
    $x = 4;
    foreach ($data as $row) {
      $sheet->setCellValue('A' . $x, $row->id_buffer);
      $sheet->setCellValue('B' . $x, $row->sales);
      $sheet->setCellValue('C' . $x, $row->tanggal);
      $sheet->setCellValue('D' . $x, $row->brand);
      $sheet->setCellValue('E' . $x, $row->deskripsi);
      $sheet->setCellValue('F' . $x, $row->qty);
      $sheet->setCellValue('G' . $x, $row->keter);
      $sheet->setCellValue('H' . $x, $row->status);
      $sheet->setCellValue('I' . $x, $row->pr_no);
      $sheet->setCellValue('J' . $x, $row->wh);
      $sheet->setCellValue('K' . $x, $row->fu);
      $sheet->setCellValue('L' . $x, $row->ket_wh);

      $sheet->getStyle('A' . $x)->applyFromArray($style_row);
      $sheet->getStyle('B' . $x)->applyFromArray($style_row);
      $sheet->getStyle('C' . $x)->applyFromArray($style_row);
      $sheet->getStyle('D' . $x)->applyFromArray($style_row);
      $sheet->getStyle('E' . $x)->applyFromArray($style_row);
      $sheet->getStyle('F' . $x)->applyFromArray($style_row);
      $sheet->getStyle('G' . $x)->applyFromArray($style_row);
      $sheet->getStyle('H' . $x)->applyFromArray($style_row);
      $sheet->getStyle('I' . $x)->applyFromArray($style_row);
      $sheet->getStyle('J' . $x)->applyFromArray($style_row);
      $sheet->getStyle('K' . $x)->applyFromArray($style_row);
      $sheet->getStyle('L' . $x)->applyFromArray($style_row);

      $x++;
    }

    $sheet->getDefaultRowDimension()->setRowHeight(-1);

    // Set orientasi kertas jadi LANDSCAPE
    $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

    // Set judul file excel nya
    $sheet->setTitle("Laporan Buffer Stock");

    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Buffer.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
  }
}

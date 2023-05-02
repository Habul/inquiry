<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_item extends CI_Controller
{

   function __construct()
   {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    if ($this->session->userdata('status') != "telah_login") {
        redirect(base_url() . 'login?alert=belum_login');
    }
   }

   public function data()
   {
      $data['title'] = 'Master Item';
      // $jumlah_data                = $this->m_data->get_count_all('tb_log');
      // $config['base_url']         = base_url('dashboard/report/');
      // $config['total_rows']       = $jumlah_data;
      // $config['per_page']         = 10;
      // $config['first_link']       = 'First';
      // $config['last_link']        = 'Last';
      // $config['next_link']        = 'Next';
      // $config['prev_link']        = 'Prev';
      // $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
      // $config['full_tag_close']   = '</ul></nav></div>';
      // $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
      // $config['num_tag_close']    = '</span></li>';
      // $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
      // $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
      // $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
      // $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
      // $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
      // $config['prev_tagl_close']  = '</span>Next</li>';
      // $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
      // $config['first_tagl_close'] = '</span></li>';
      // $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
      // $config['last_tagl_close']  = '</span></li>';
      // $this->pagination->initialize($config);
      // $page                       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // $data['links']              = $this->pagination->create_links();

      $data['master'] = $this->m_data->get_index_wheredesc('addtime', ['status !=' => '1'], 'master_item')->result();
      $data['master_ok'] = $this->m_data->get_index_wheredesc('addtime', ['status' => '1'], 'master_item')->result();
      $this->load->view('dashboard/v_header', $data);
      $this->load->view('it/v_master_item', $data);
      $this->load->view('dashboard/v_footer', $data);
   }

   public function add()
   {
      $this->form_validation->set_rules('merk', 'Merk', 'required');
      $this->form_validation->set_rules('kelompok', 'Kelompok', 'required');
      $this->form_validation->set_rules('part_number', 'part_number', 'required');
      $this->form_validation->set_rules('nama', 'Nama', 'required');
      $this->form_validation->set_rules('type', 'Type', 'required');

      if ($this->form_validation->run() != false) {
         $user = $this->input->post('user');
         $merk = $this->input->post('merk');
         $kelompok = $this->input->post('kelompok');
         $part_number = $this->input->post('part_number');
         $nama = $this->input->post('nama');
         $type = $this->input->post('type');
         $satuan = $this->input->post('satuan');

         $data = array(
            'user' => $user,
            'merk' => $merk,
            'kelompok' => $kelompok,
            'part_number' => $part_number,
            'nama' => $nama,
            'type' => $type,
            'satuan' => $satuan,
            'addtime' => mdate('%Y-%m-%d %H:%i:%s')
         );

         $this->m_data->insert_data($data, 'master_item');
         $this->session->set_flashdata('berhasil', 'Add Data successfully, Merk : ' . $merk . ' !');
         redirect(base_url() . 'master_item/data');
      } else {
         $this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
         redirect(base_url() . 'master_item/data');
      }
   }

   public function edit()
   {
      $this->form_validation->set_rules('merk', 'Merk', 'required');
      $this->form_validation->set_rules('nama', 'Nama', 'required');

      if ($this->form_validation->run() != false) {
         $id = $this->input->post('id');
         $merk = $this->input->post('merk');
         $kelompok = $this->input->post('kelompok');
         $part_number = $this->input->post('part_number');
         $nama = $this->input->post('nama');
         $satuan = $this->input->post('satuan');
         $type = $this->input->post('type');

         $where = array(
            'id' => $id
         );

         $data = array(
            'merk' => $merk,
            'kelompok' => $kelompok,
            'part_number' => $part_number,
            'nama' => $nama,
            'satuan' => $satuan,
            'type' => $type,
            'addtime' => mdate('%Y-%m-%d %H:%i:%s')
         );

         $this->m_data->update_data($where, $data, 'master_item');
         $this->session->set_flashdata('berhasil', 'Edit Data successfully, Judul : ' . $merk . ' !');
         redirect(base_url() . 'master_item/data');
      } else {
         $this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
         redirect(base_url() . 'master_item/data');
      }
   }

   public function update()
   {
      $this->form_validation->set_rules('status', 'Status', 'required');

      if ($this->form_validation->run() != false) {
         $id = $this->input->post('id');
         $status = $this->input->post('status');
         $merk = $this->input->post('merk');

         $where = array(
            'id' => $id
         );

         $data = array(
            'status' => $status
         );

         $this->m_data->update_data($where, $data, 'master_item');
         $this->session->set_flashdata('berhasil', 'Update Data successfully, Merk : ' . $merk . ' !');
         redirect(base_url() . 'master_item/data');
      } else {
         $this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
         redirect(base_url() . 'master_item/data');
      }
   }

   public function delete()
   {
      $id = $this->input->post('id');
      $this->m_data->delete_data(['id' => $id], 'master_item');
      $this->session->set_flashdata('berhasil', 'Data has been deleted !');
      redirect(base_url() . 'master_item/data');
   }

   public function update_it()
   {
      $this->form_validation->set_rules('status', 'Status', 'required');

      if ($this->form_validation->run() != false) {
         $id = $this->input->post('id');
         $merk = $this->input->post('merk');
         $type = $this->input->post('type');
         $status_it = $this->input->post('status_it');

         $where = array(
            'id' => $id
         );

         $data = array(
            'type' => $type,
            'status_it' => $status_it,
         );

         $this->m_data->update_data($where, $data, 'master_item');
         $this->session->set_flashdata('berhasil', 'Update Data successfully, Merk : ' . $merk . ' !');
         redirect(base_url() . 'master_item/data');
      } else {
         $this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
         redirect(base_url() . 'master_item/data');
      }
   }

   public function approve_system()
   {
      $status = $this->input->post('status');
      for ($i = 0; $i < sizeof($status); $i++) {
         $where = array(
            'id' => $status[$i]
         );

         $data = array(
            'status' => '1'
         );

         $this->m_data->update_data($where, $data, 'master_item');
      }
      $this->session->set_flashdata('berhasil', 'Approve system by ' . ucwords($this->session->userdata('nama')) . '!');
      redirect(base_url() . 'master_item/data');
   }

   public function approve_system_it()
   {
      $status_it = $this->input->post('status_it');
      for ($i = 0; $i < sizeof($status_it); $i++) {
         $where = array(
            'id' => $status_it[$i]
         );

         $data = array(
            'status_it' => '1'
         );

         $this->m_data->update_data($where, $data, 'master_item');
      }
      $this->session->set_flashdata('berhasil', 'Approve system by ' . ucwords($this->session->userdata('nama')) . '!');
      redirect(base_url() . 'master_item/data');
   }
}

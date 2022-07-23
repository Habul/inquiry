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
      $id = $this->input->post('id');
      $status_it = $this->input->post('status_it');

      $id = [
         'id' => $id,
      ];

      $data = [
         'status_it' => $status_it,
      ];

      $result = $this->db->get_where('master_item', $id);

      if ($result->num_rows() < 1) {
         $this->m_data->update_data($id, $data, 'master_item');
      }
      $this->session->set_flashdata('berhasil', 'Approve system successfully!');
   }
}

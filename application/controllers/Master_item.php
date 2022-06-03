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
      $data['master'] = $this->m_data->get_data('master_item')->result();
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
         $addtime = mdate('%Y-%m-%d %H:%i:%s');

         $data = array(
            'user' => $user,
            'merk' => $merk,
            'kelompok' => $kelompok,
            'part_number' => $part_number,
            'nama' => $nama,
            'type' => $type,
            'satuan' => $satuan,
            'addtime' => $addtime
         );

         $this->m_data->insert_data($data, 'master_item');
         $this->session->set_flashdata('berhasil', 'Add Data successfully, Judul : ' . $merk . ' !');
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
         $addtime = mdate('%Y-%m-%d %H:%i:%s');

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
            'addtime' => $addtime,
         );

         $this->m_data->update_data($where, $data, 'master_item');
         $this->session->set_flashdata('berhasil', 'Edit Data successfully, Judul : ' . $merk . ' !');
         redirect(base_url() . 'master_item/data');
      } else {
         $this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
         redirect(base_url() . 'master_item/data');
      }
   }

   public function delete()
   {
      $id = $this->input->post('no_id');
      $this->m_data->delete_data(['id' => $id], 'Master_item');
      $this->session->set_flashdata('berhasil', 'Data has been deleted !');
      redirect(base_url() . 'master_item/data');
   }
}

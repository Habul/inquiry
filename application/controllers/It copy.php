<?php

defined('BASEPATH') or exit('No direct script access allowed');

class It extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        }
    }

    public function data()
    {
        $data['title'] = 'Data Penting';
        $data['penting'] = $this->m_data->get_index('datapenting_it', 'addtime')->result();
        $data['id_add'] = $this->db->select_max('no_id')->get('datapenting_it')->row();
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('it/v_it', $data);
        $this->load->view('dashboard/v_footer', $data);
    }

    public function data_aksi()
    {
        $this->form_validation->set_rules('no_id', 'No Id', 'required');
        $this->form_validation->set_rules('judul', 'Judul', 'required');

        if ($this->form_validation->run() != false) {
            $id = $this->input->post('no_id');
            $judul = $this->input->post('judul');
            $isi = $this->input->post('isi');
            $addtime = mdate('%Y-%m-%d %H:%i:%s');

            $data = array(
              'no_id' => $id,
              'judul' => $judul,
              'isi' => $isi,
              'addtime' => $addtime
            );

            $this->m_data->insert_data($data, 'datapenting_it');

            if (!empty($_FILES['file']['name'])) {

                $config['upload_path']   = './gambar/datait/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|zip|7z';
                $config['overwrite']  = true;
                $config['max_size']     = 5072;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $gambar = $this->upload->data();

                    $id = $this->input->post('no_id');
                    $file = $gambar['file_name'];

                    $this->db->query("UPDATE datapenting_it SET `file`='$file' WHERE no_id='$id'");
                }
            }
            $this->session->set_flashdata('berhasil', 'Add Data successfully, Judul : ' . $this->input->post('judul', true) . ' !');
            redirect(base_url() . 'it/data');
        } else {
            $this->session->set_flashdata('gagal', 'Data failed to Add, Please repeat !');
            redirect(base_url() . 'it/data');
        }
    }

    public function data_edit()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('no_id');
            $judul = $this->input->post('judul');
            $isi = $this->input->post('isi');
            $addtime = mdate('%Y-%m-%d %H:%i:%s');

            $where = array(
              'no_id' => $id
            );

            $data = array(
              'judul' => $judul,
              'isi' => $isi,
              'addtime' => $addtime,
            );

            $this->m_data->update_data($where, $data, 'datapenting_it');

            if (!empty($_FILES['file']['name'])) {

                $config['upload_path']   = './gambar/datait/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|zip|7z';
                $config['overwrite']  = true;
                $config['max_size']     = 5072;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $gambar = $this->upload->data();

                    $id = $this->input->post('no_id');
                    $file = $gambar['file_name'];

                    $this->db->query("UPDATE datapenting_it SET `file`='$file' WHERE no_id='$id'");
                }
            }
            $this->session->set_flashdata('berhasil', 'Edit Data successfully, Judul : ' . $this->input->post('judul', true) . ' !');
            redirect(base_url() . 'it/data');
        } else {
            $this->session->set_flashdata('gagal', 'Data failed to Update, Please repeat !');
            redirect(base_url() . 'it/data');
        }
    }

    public function data_hapus()
    {
        $id = $this->input->post('no_id');
        {
            $where = array(
              'no_id' => $id
            );
            $this->m_data->delete_data($where, 'datapenting_it');
            $this->session->set_flashdata('berhasil', 'Data has been deleted !');
            redirect(base_url() . 'it/data');
        }
    }
}

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
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('it/v_it');
        $this->load->view('dashboard/v_footer');
        $this->load->view('it/v_ajax_it');
    }

    public function ajax_it()
    {
        header('Content-Type: application/json');
        $list = $this->m_it->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $it) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $it->judul;
            $row[] = $it->addtime;

            $row[] = '<a class="btn-sm btn-warning" onclick="edit_it(' . "'" . $it->id . "'" . ')" title="Edit"><i class="fa fa-pencil-alt"></i></a>
            <a class="btn-sm btn-info" onclick="view_it(' . "'" . $it->id . "'" . ')" title="Edit"><i class="fa fa-search"></i></a>
            <a class="btn-sm btn-danger" onclick="delete_it(' . "'" . $it->id . "'" . ')" title="Delete"><i class="fa fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->m_it->count_all(),
            "recordsFiltered" => $this->m_it->count_filtered(),
            "data" => $data,
        );

        $this->output->set_output(json_encode($output));
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'judul' => $this->input->post('judul'),
            'isi' => $this->input->post('isi'),
            'addtime' => date('Y-m-d H:m:s'),
        );

        if(!empty($_FILES['file']['name'])) {
            $upload = $this->_do_upload();
            $data['file'] = $upload;
        }

        $this->m_it->save($data);
        echo json_encode(array("status" => true));
    }

    public function ajax_edit($id)
    {
        $data = $this->m_it->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'judul' => $this->input->post('judul'),
            'isi' => $this->input->post('isi'),
            'file' => $this->input->post('file'),
            'addtime' => date('Y-m-d H:m:s'),
        );
        $this->m_it->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete($id)
    {
        $this->m_it->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function ajax_approve($id)
    {
        $data = array(
            'status' => '1',
        );
        $this->m_it->update(array('id' => $id), $data);
        echo json_encode(array("status" => true));
    }

    private function _do_upload()
    {
        $config['upload_path']          = '/gambar/datait/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['overwrite']            = true;
        $config['max_size']             = 2048;
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('file')) { //upload and validate
            $data['inputerror'][] = 'file';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('', ''); //show ajax error
            $data['status'] = false;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if($this->input->post('judul') == '') {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Title is required';
            $data['status'] = false;
        }

        if($this->input->post('isi') == '') {
            $data['inputerror'][] = 'isi';
            $data['error_string'][] = 'Description is required';
            $data['status'] = false;
        }

        if($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}

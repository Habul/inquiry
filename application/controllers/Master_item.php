<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master_item extends CI_Controller
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
        $data['title'] = 'Master Item';
        $this->load->view('dashboard/v_header', $data);
        $this->load->view('it/v_master_item', $data);
        $this->load->view('dashboard/v_footer', $data);
    }

    public function ajax_list()
    {
        header('Content-Type: application/json');
        $this->load->model('m_side');
        $list = $this->m_side->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;

            if ($item->status == 1) {
                $status = '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Approve</span>';
            } elseif ($item->status == 2) {
                $status = '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Reject</span>';
            } else {
                $status = '<span> - </span>';
            }

            if ($item->status_it == 1) {
                $status_it = '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Approve System</span>';
                $approve = '<i class="far fa-thumbs-up"></i>';
            } elseif ($item->status_it == 2) {
                $status_it = '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Reject</span>';
                $approve = '<a class="btn-sm btn-info" title="Approve IT ?" onclick="edit_person('."'".$item->id."'".')"><i class="fas fa-thumbs-up"></i></a>';
            } else {
                $status_it = '<span> - </span>';
                $approve = '<a class="btn-sm btn-info" title="Approve IT ?" onclick="edit_person('."'".$item->id."'".')"><i class="fas fa-thumbs-up"></i></a>';
            }

            $row = array();
            $row[] = $no;
            $row[] = $item->user;
            $row[] = $item->merk;
            $row[] = strtoupper($item->kelompok);
            $row[] = strtoupper($item->part_number);
            $row[] = $item->nama;
            $row[] = $item->satuan;
            $row[] = strtoupper($item->type);
            $row[] = $status;
            $row[] = $status_it;
            $row[] = $approve;

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->m_side->count_all(),
            "recordsFiltered" => $this->m_side->count_filtered(),
            "data" => $data,
        );

        $this->output->set_output(json_encode($output));
    }

    public function ajax_edit($id)
    {
        $data = $this->m_side->get_by_id($id);
        $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'dob' => $this->input->post('dob'),
        );
        $insert = $this->m_side->save($data);
        echo json_encode(array("status" => true));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'dob' => $this->input->post('dob'),
        );
        $this->m_side->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete($id)
    {
        $this->m_side->delete_by_id($id);
        echo json_encode(array("status" => true));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if ($this->input->post('firstName') == '') {
            $data['inputerror'][] = 'firstName';
            $data['error_string'][] = 'First name is required';
            $data['status'] = false;
        }

        if ($this->input->post('lastName') == '') {
            $data['inputerror'][] = 'lastName';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = false;
        }

        if ($this->input->post('dob') == '') {
            $data['inputerror'][] = 'dob';
            $data['error_string'][] = 'Date of Birth is required';
            $data['status'] = false;
        }

        if ($this->input->post('gender') == '') {
            $data['inputerror'][] = 'gender';
            $data['error_string'][] = 'Please select gender';
            $data['status'] = false;
        }

        if ($this->input->post('address') == '') {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Addess is required';
            $data['status'] = false;
        }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_list_item()
    {
        header('Content-Type: application/json');
        $this->load->model('m_side2');
        $list = $this->m_side2->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->user;
            $row[] = $item->merk;
            $row[] = strtoupper($item->kelompok);
            $row[] = strtoupper($item->part_number);
            $row[] = $item->nama;
            $row[] = $item->satuan;
            $row[] = strtoupper($item->type);

            $row[] = '<a class="btn-sm btn-info" title="Approve ?" onclick="edit_person('."'".$item->id."'".')"><i class="fas fa-thumbs-up"></i></a>
            <a class="btn-sm btn-warning" onclick="edit_item('."'".$item->id."'".')" title="Edit"><i class="fa fa-pencil-alt"></i></a>
            <a class="btn-sm btn-danger" onclick="delete_item('."'".$item->id."'".')" title="Delete"><i class="fa fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->m_side2->count_all(),
            "recordsFiltered" => $this->m_side2->count_filtered(),
            "data" => $data,
        );

        $this->output->set_output(json_encode($output));
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

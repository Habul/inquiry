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
        $this->load->view('it/v_ajax_item');
    }

    public function ajax_list()
    {
        header('Content-Type: application/json');
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
                $approve = '<i class="fas fa-lock"></i>';
            } elseif ($item->status_it == 2) {
                $status_it = '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Reject</span>';
                $approve = '<a class="btn-sm btn-info" title="Approve IT ?" onclick="approve_it(' . "'" . $item->id . "'" . ')"><i class="fas fa-thumbs-up"></i></a>';
            } else {
                $status_it = '<span> - </span>';
                $approve = '<a class="btn-sm btn-info" title="Approve IT ?" onclick="approve_it(' . "'" . $item->id . "'" . ')"><i class="fas fa-thumbs-up"></i></a>';
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

    public function ajax_approve_it($id)
    {
        $data = array(
            'status_it' => '1',
        );
        $this->m_side->update(array('id' => $id), $data);
        echo json_encode(array("status" => true));
    }

    public function ajax_list_item()
    {
        header('Content-Type: application/json');
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

            if ($this->session->userdata('level') != "sales") {
                $row[] = '<a class="btn-sm btn-warning" onclick="edit_item(' . "'" . $item->id . "'" . ')" title="Edit"><i class="fa fa-pencil-alt"></i></a>
            <a class="btn-sm btn-danger" onclick="delete_item(' . "'" . $item->id . "'" . ')" title="Delete"><i class="fa fa-trash"></i></a>';
            }

            if ($this->session->userdata('level') != "engineering") {
                $row[] = '<a class="btn-sm btn-info" title="Approve ?" onclick="approve(' . "'" . $item->id . "'" . ')"><i class="fas fa-thumbs-up"></i></a>';
            }

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

    public function ajax_edit_item($id)
    {
        $data = $this->m_side2->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'user' => ucwords($this->session->userdata('nama')),
            'merk' => $this->input->post('merk'),
            'kelompok' => $this->input->post('kelompok'),
            'part_number' => $this->input->post('part_number'),
            'nama' => $this->input->post('nama'),
            'satuan' => $this->input->post('satuan'),
            'type' => $this->input->post('type'),
            'addtime' => date('Y-m-d H:m:s'),
        );
        $this->m_side2->save($data);
        echo json_encode(array("status" => true));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'merk' => $this->input->post('merk'),
            'kelompok' => $this->input->post('kelompok'),
            'part_number' => $this->input->post('part_number'),
            'nama' => $this->input->post('nama'),
            'satuan' => $this->input->post('satuan'),
            'type' => $this->input->post('type'),
        );
        $this->m_side2->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete($id)
    {
        $this->m_side2->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function ajax_approve($id)
    {
        $data = array(
            'status' => '1',
        );
        $this->m_side2->update(array('id' => $id), $data);
        echo json_encode(array("status" => true));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if ($this->input->post('merk') == '') {
            $data['inputerror'][] = 'merk';
            $data['error_string'][] = 'Brand name is required';
            $data['status'] = false;
        }

        if ($this->input->post('kelompok') == '') {
            $data['inputerror'][] = 'kelompok';
            $data['error_string'][] = 'Category is required';
            $data['status'] = false;
        }

        if ($this->input->post('part_number') == '') {
            $data['inputerror'][] = 'part_number';
            $data['error_string'][] = 'Part number is required';
            $data['status'] = false;
        }

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Assy code is required';
            $data['status'] = false;
        }

        if ($this->input->post('satuan') == '') {
            $data['inputerror'][] = 'satuan';
            $data['error_string'][] = 'Satuan is required';
            $data['status'] = false;
        }

        if ($this->input->post('type') == '') {
            $data['inputerror'][] = 'type';
            $data['error_string'][] = 'Please select tipe';
            $data['status'] = false;
        }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}

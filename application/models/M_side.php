<?php

class M_side extends CI_Model
{
    public $table = 'master_item';
    public $column_order = array(null, 'user', 'merk', 'kelompok', 'part_number', 'nama', 'satuan', 'type','status', 'status_it'); //set column field database for datatable orderable
    public $column_search = array('user', 'merk', 'kelompok', 'part_number', 'nama', 'satuan', 'type'); //set column field database for datatable searchable
    public $order = array('id' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table)->where(['status' => '1']);
        $i = 0;
        foreach ($this->column_search as $item) { // loop kolom
            if ($this->input->post('search')['value']) { // jika datatable mengirim POST untuk search
                if ($i === 0) { // looping pertama
                    $this->db->group_start();
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }
                if (count($this->column_search) - 1 == $i) { //looping terakhir
                    $this->db->group_end();
                }
            }
            $i++;
        }

        // jika datatable mengirim POST untuk order
        if ($this->input->post('order')) {
            $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table)->where(['status' => '1']);
        ;
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table)->where(['status' => '1']);
        ;
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}

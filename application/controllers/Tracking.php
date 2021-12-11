<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');

        $this->load->helper(array('form', 'url'));
        $this->load->model('m_data');
    }

    public function data_order()
    {
        $data['tracking'] = $this->m_data->get_data('tracking')->result();
        $data['unit_bisnis'] = $this->m_data->get_data('unit_bisnis')->result();
        $data['jadwal'] = $this->db->where('plan_kirim', 'NOW()')->get('tracking')->result();	
        $this->load->view('dashboard/v_header');
        $this->load->view('tracking/v_tracking', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function data_aksi()
    {
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'required');
        $this->form_validation->set_rules('group', 'Group', 'required');
       // $this->form_validation->set_rules('no_bbk', 'NO BBK', 'required');
        $this->form_validation->set_rules('nama_cust', 'Nama Customer', 'required');
        $this->form_validation->set_rules('alamat_cust', 'Alamat Customer', 'required');
        $this->form_validation->set_rules('pic_penerima', 'Pic Penerima', 'required');
        $this->form_validation->set_rules('no_penerima', 'NoHP Penerima', 'required');
        $this->form_validation->set_rules('barang', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');
        $this->form_validation->set_rules('status_brg', 'Status Barang', 'required');
        $this->form_validation->set_rules('waktu', 'waktu', 'required');
        $this->form_validation->set_rules('tanggal_kirim', 'Tanggal Kirim', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
        $this->form_validation->set_rules('note', 'Note', 'required');
        $this->form_validation->set_rules('addtime', 'Addtime', 'required');

        if ($this->form_validation->run() != false) {

            $nama_pemesan = $this->input->post('nama_pemesan');
            $group = $this->input->post('group');
            $no_bbk = $this->input->post('no_bbk');
            $nama_cust = $this->input->post('nama_cust');
            $alamat_cust = $this->input->post('alamat_cust');
            $pic_penerima = $this->input->post('pic_penerima');
            $no_penerima = $this->input->post('no_penerima');
            $barang = $this->input->post('barang');
            $jumlah = $this->input->post('jumlah');
            $status_brg = $this->input->post('status_brg');
            $waktu = $this->input->post('waktu');
            $tanggal_kirim = $this->input->post('tanggal_kirim');
            $tujuan = $this->input->post('tujuan');
            $note = $this->input->post('note');
            $addtime = $this->input->post('addtime');

            $data = array(
                'nama_pemesan' => $nama_pemesan,
                'group' => $group,
                'no_bbk' => $no_bbk,
                'nama_cust' => $nama_cust,
                'alamat_cust' => $alamat_cust,
                'pic_penerima' => $pic_penerima,
                'no_penerima' => $no_penerima,
                'barang' => $barang,
                'jumlah' => $jumlah,
                'status_brg' => $status_brg,
                'waktu' => $waktu,
                'tanggal_kirim' => $tanggal_kirim,
                'tujuan' => $tujuan,
                'note' => $note,
                'addtime' => $addtime
            );

            $this->m_data->insert_data($data, 'tracking');
            $this->session->set_flashdata('berhasil', 'Tracking Successfully added, customer name  ' . $this->input->post('nama_pemesan', TRUE) . ' !');
            redirect(base_url() . 'tracking/data_order');
        } else {
            $this->session->set_flashdata('gagal', 'Tracking failed to add, Please repeat !');
            redirect(base_url() . 'tracking/data_order');
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'required');
        $this->form_validation->set_rules('group', 'Group', 'required');
        $this->form_validation->set_rules('no_bbk', 'NO BBK', 'required');
        $this->form_validation->set_rules('nama_cust', 'Nama Customer', 'required');
        $this->form_validation->set_rules('alamat_cust', 'Alamat Customer', 'required');
        $this->form_validation->set_rules('pic_penerima', 'Pic Penerima', 'required');
        $this->form_validation->set_rules('no_penerima', 'NoHP Penerima', 'required');
        $this->form_validation->set_rules('barang', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');
        $this->form_validation->set_rules('status_brg', 'Status Barang', 'required');
        $this->form_validation->set_rules('waktu', 'waktu', 'required');
        $this->form_validation->set_rules('tanggal_kirim', 'Tanggal Kirim', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
        $this->form_validation->set_rules('note', 'Note', 'required');
        $this->form_validation->set_rules('addtime', 'Addtime', 'required');

        if ($this->form_validation->run() != false) {
            $id = $this->input->post('no_id');

            $nama_pemesan = $this->input->post('nama_pemesan');
            $group = $this->input->post('group');
            $no_bbk = $this->input->post('no_bbk');
            $nama_cust = $this->input->post('nama_cust');
            $alamat_cust = $this->input->post('alamat_cust');
            $pic_penerima = $this->input->post('pic_penerima');
            $no_penerima = $this->input->post('no_penerima');
            $barang = $this->input->post('barang');
            $jumlah = $this->input->post('jumlah');
            $status_brg = $this->input->post('status_brg');
            $waktu = $this->input->post('waktu');
            $tanggal_kirim = $this->input->post('tanggal_kirim');
            $tujuan = $this->input->post('tujuan');
            $note = $this->input->post('note');
            $addtime = $this->input->post('addtime');

            $data = array(
                'nama_pemesan' => $nama_pemesan,
                'group' => $group,
                'no_bbk' => $no_bbk,
                'nama_cust' => $nama_cust,
                'alamat_cust' => $alamat_cust,
                'pic_penerima' => $pic_penerima,
                'no_penerima' => $no_penerima,
                'barang' => $barang,
                'jumlah' => $jumlah,
                'status_brg' => $status_brg,
                'waktu' => $waktu,
                'tanggal_kirim' => $tanggal_kirim,
                'tujuan' => $tujuan,
                'note' => $note,
                'addtime' => $addtime
            );

            $where = array(
                'no_id' => $id
            );

            $this->m_data->update_data($where, $data, 'tracking');
            $this->session->set_flashdata('berhasil', 'Tracking Successfully Edit, customer name  ' . $this->input->post('nama_pemesan', TRUE) . ' !');
            redirect(base_url() . 'tracking/data_order');
        } else {
            $this->session->set_flashdata('gagal', 'Tracking failed to Edit, Please repeat !');
            redirect(base_url() . 'tracking/data_order');
        }
    }

    public function delete()
    {
        $id = $this->input->post('no_id'); {
            $where = array(
                'no_id' => $id
            );
            $this->m_data->delete_data($where, 'tracking');
            $this->session->set_flashdata('berhasil', 'Tracking has been deleted !');
            redirect(base_url() . 'tracking/data_order');
        }
    }

    public function view($id)
	{
		$where = array(
			'no_id' => $id
		);

		$data['tracking'] = $this->m_data->edit_data($where, 'tracking')->result();  
        $data['driver'] = $this->db->select('pengguna_nama')->where('pengguna_level', 'driver')->get('pengguna')->result();	
		$this->load->view('dashboard/v_header');
		$this->load->view('tracking/v_tracking_view', $data);
		$this->load->view('dashboard/v_footer');
	}

    public function update()
    {
        $this->form_validation->set_rules('plan_kirim', 'Plan Kirim', 'required');
        $this->form_validation->set_rules('nama_driver', 'Nama Driver', 'required');
        $this->form_validation->set_rules('pic_penerima_brg', 'Pic Penerima Barang', 'required');
        $this->form_validation->set_rules('status_kirim', 'Status Kirim', 'required');
        $this->form_validation->set_rules('keter_kirim', 'Keter Kirim', 'required');
        $this->form_validation->set_rules('updtime', 'Updatetime', 'required');

        if ($this->form_validation->run() != false) {
            $id = $this->input->post('no_id');

            $plan_kirim = $this->input->post('plan_kirim');
            $nama_driver = $this->input->post('nama_driver');
            $pic_penerima_brg = $this->input->post('pic_penerima_brg');
            $status_kirim = $this->input->post('status_kirim');
            $keter_kirim = $this->input->post('keter_kirim');
            $updtime = $this->input->post('updtime');

            if ($this->form_validation->run() != false) {
                $data = array(
                    'plan_kirim' => $plan_kirim,
                    'nama_driver' => $nama_driver,
                    'pic_penerima_brg' => $pic_penerima_brg,
                    'status_kirim' => $status_kirim,
                    'keter_kirim' => $keter_kirim,
                    'updtime' => $updtime
                );
            }

            $where = array(
                'no_id' => $id
            );

            $this->m_data->update_data($where, $data, 'tracking');
            $this->session->set_flashdata('berhasil', 'Tracking Successfully Update, Plan kirim : ' . $this->input->post('plan_kirim', TRUE) . ' !');
            redirect(base_url() . 'tracking/data_order');
        } else {
            $this->session->set_flashdata('gagal', 'Tracking failed to Update, Please repeat !');
            redirect(base_url() . 'tracking/data_order');
        }
    }

    public function arship()
	{
		$data['arship'] = $this->db->where('action','FINISH')->get('tracking')->result();
        $data['driver'] = $this->db->select('pengguna_nama')->where('pengguna_level', 'driver')->get('pengguna')->result();	
		$this->load->view('dashboard/v_header');
		$this->load->view('tracking/v_tracking_view', $data);
		$this->load->view('dashboard/v_footer');
	}
}

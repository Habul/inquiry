<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sj extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    if ($this->session->userdata('status') != "telah_login") {
      redirect(base_url() . 'login?alert=belum_login');
    }
  }

  public function sj_df()
  {
    $data['title'] = 'Sj Df';
    $data['sj_user_df'] = $this->m_data->get_data('sj_user_df')->result();
    $data['sj_dfh'] = $this->m_data->get_data('sj_df')->result();
    $data['sj_add'] = $this->db->select_max('no_id')->get('sj_user_df')->row();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('sj/v_sj_df', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function sj_aksi_df()
  {
    $this->form_validation->set_rules('no_delivery', 'No Delivery', 'required');
    $this->form_validation->set_rules('date_delivery', 'Date Delivery', 'required');
    $this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');

    if ($this->form_validation->run() != false) {

      $no_delivery = $this->input->post('no_delivery');
      $nomor_del = str_replace("/", "-", $no_delivery);
      $id = $this->input->post('id');
      $date_delivery = $this->input->post('date_delivery');
      $cust_name = $this->input->post('cust_name');
      $address = $this->input->post('address');
      $city = $this->input->post('city');
      $phone = $this->input->post('phone');
      $addtime = mdate("%Y-%m-%d %H:%i:%s");

      $data = array(
        'no_delivery' => $nomor_del,
        'date_delivery' => $date_delivery,
        'cust_name' => $cust_name,
        'address' => $address,
        'city' => $city,
        'phone' => $phone,
        'addtime' => $addtime
      );

      $this->m_data->insert_data($data, 'sj_user_df');
      $id = $this->input->post('id');
      $encrypt = urlencode($this->encrypt->encode($id));
      redirect(base_url() . 'sj/sj_new/?sj=' . $encrypt);
    } else {
      $this->session->set_flashdata('error', 'SJ failed to add, Please repeat !');
      redirect(base_url() . 'sj/sj_df');
    }
  }

  public function sj_new()
  {
    $id = rawurldecode($this->encrypt->decode($_GET['sj']));

    $where = array(
      'no_id' => $id
    );

    $where2 = array(
      'id_join' => $id
    );

    $data['title'] = 'Sj Df View';
    $data['sj_user_df'] = $this->m_data->edit_data($where, 'sj_user_df')->result();
    $data['sj_dfh'] = $this->m_data->edit_data($where2, 'sj_df')->result();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('sj/v_sj_view_df_new', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function sj_view_df()
  {
    $id = rawurldecode($this->encrypt->decode($_GET['sj']));

    $where = array(
      'no_id' => $id
    );

    $where2 = array(
      'id_join' => $id
    );

    $data['title'] = 'Sj Df View';
    $data['sj_user_df'] = $this->m_data->edit_data($where, 'sj_user_df')->result();
    $data['sj_dfh'] = $this->m_data->edit_data($where2, 'sj_df')->result();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('sj/v_sj_view_df', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function sj_update_df()
  {
    //$this->form_validation->set_rules('no_urut', 'No Urut', 'required');
    $this->form_validation->set_rules('descript', 'Deskripsi', 'required');
    $this->form_validation->set_rules('qty', 'Qty', 'required');

    if ($this->form_validation->run() != false) {

      $id = $this->input->post('id');
      $descript = $this->input->post('descript');
      $qty = $this->input->post('qty');

      $data = array(
        'id_join' => $id,
        'descript' => $descript,
        'qty' => $qty
      );

      $this->m_data->insert_data($data, 'sj_df');
      $this->session->set_flashdata('success', 'Successfully added Desc : ' . $this->input->post('descript', TRUE) . '  !');
      $id = $this->input->post('id');
      $encrypt = urlencode($this->encrypt->encode($id));
      redirect(base_url() . 'sj/sj_view_df/?sj=' . $encrypt);
    } else {
      $this->session->set_flashdata('error', 'SJ Desc failed to add, Please repeat !');
      $id = $this->input->post('id');
      $encrypt = urlencode($this->encrypt->encode($id));
      redirect(base_url() . 'sj/sj_view_df/?sj=' . $encrypt);
    }
  }

  public function sj_update_edit_df()
  {
    $this->form_validation->set_rules('descript', 'No Delivery', 'required');
    $this->form_validation->set_rules('qty', 'Date Delivery', 'required');

    if ($this->form_validation->run() != false) {
      $id = $this->input->post('no_id');
      $descript = $this->input->post('descript');
      $qty = $this->input->post('qty');

      if ($this->form_validation->run() != false) {
        $data = array(
          'descript' => $descript,
          'qty' => $qty
        );
      }

      $where = array(
        'no_id' => $id
      );

      $this->m_data->update_data($where, $data, 'sj_df');
      $this->session->set_flashdata('success', 'Desc successfully Update, : ' . $this->input->post('descript', TRUE) . ' !');
      $id = $this->input->post('id');
      $encrypt = urlencode($this->encrypt->encode($id));
      redirect(base_url() . 'sj/sj_view_df/?sj=' . $encrypt);
    } else {
      $this->session->set_flashdata('error', 'SJ failed to Update, Please repeat !');
      $id = $this->input->post('id');
      $encrypt = urlencode($this->encrypt->encode($id));
      redirect(base_url() . 'sj/sj_view_df/?sj=' . $encrypt);
    }
  }

  public function sj_edit_df()
  {
    //$this->form_validation->set_rules('no_delivery', 'No Delivery', 'required');
    $this->form_validation->set_rules('date_delivery', 'Date Delivery', 'required');
    $this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');

    if ($this->form_validation->run() != false) {

      $id = $this->input->post('no_id');

      $this->input->post('no_delivery');
      $date_delivery = $this->input->post('date_delivery');
      $cust_name = $this->input->post('cust_name');
      $address = $this->input->post('address');
      $city = $this->input->post('city');
      $phone = $this->input->post('phone');
      $addtime2 = mdate("%Y-%m-%d %H:%i:%s");

      if ($this->form_validation->run() != false) {
        $data = array(
          'date_delivery' => $date_delivery,
          'cust_name' => $cust_name,
          'address' => $address,
          'city' => $city,
          'phone' => $phone,
          'addtime2' => $addtime2
        );
      }

      $where = array(
        'no_id' => $id
      );
      $this->m_data->update_data($where, $data, 'sj_user_df');
      $this->session->set_flashdata('success', 'SJ successfully Update, No Po : ' . $this->input->post('no_delivery', TRUE) . ' !');
      redirect(base_url() . 'sj/sj_df');
    } else {
      $this->session->set_flashdata('error', 'SJ failed to Update, Please repeat !');
      redirect(base_url() . 'sj/sj_df');
    }
  }

  public function sj_hapus_df()
  {
    $id = $this->input->post('no_id'); {
      $where = array(
        'no_id' => $id
      );
      $where2 = array(
        'id_join' => $id
      );
      $this->m_data->delete_data($where2, 'sj_df');
      $this->m_data->delete_data($where, 'sj_user_df');
      $this->session->set_flashdata('success', 'SJ has been deleted !');
      redirect(base_url() . 'sj/sj_df');
    }
  }

  public function sj_desc_hapus_df()
  {
    $id = $this->input->post('no_id'); {
      $where = array(
        'no_id' => $id
      );
      $this->m_data->delete_data($where, 'sj_df');
      $this->session->set_flashdata('success', 'Desc has been deleted !');
      $id = $this->input->post('id');
      $encrypt = urlencode($this->encrypt->encode($id));
      redirect(base_url() . 'sj/sj_view_df/?sj=' . $encrypt);
    }
  }

  public function sj_print_df()
  {
    $id = rawurldecode($this->encrypt->decode($_GET['p']));
    $this->load->library('pdf');
    $file_pdf = 'Print SJ';
    $paper = 'A4';
    $orientation = "potrait";

    $where = array(
      'no_id' => $id
    );

    $where2 = array(
      'id_join' => $id
    );

    $data['sj_user_df'] = $this->m_data->edit_data($where, 'sj_user_df')->result();
    $data['sj_df'] = $this->m_data->edit_data($where2, 'sj_df')->result();
    $html = $this->load->view('sj/df_sj', $data, true);
    $this->pdf->generate($html, $file_pdf, $paper, $orientation);
  }

  public function sj_print_inti()
  {
    $id = rawurldecode($this->encrypt->decode($_GET['p']));
    $this->load->library('pdf');
    $file_pdf = 'Print SJ';
    $paper = 'A4';
    $orientation = "potrait";

    $where = array(
      'no_id' => $id
    );

    $where2 = array(
      'id_join' => $id
    );
    $data['sj_user_df'] = $this->m_data->edit_data($where, 'sj_user_df')->result();
    $data['sj_df'] = $this->m_data->edit_data($where2, 'sj_df')->result();
    $html = $this->load->view('sj/inti_sj', $data, true);
    $this->pdf->generate($html, $file_pdf, $paper, $orientation);
  }
}

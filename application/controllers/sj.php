<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sj extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->helper(array('form', 'url'));
    $this->load->model('m_data');
    $session = $this->session->userdata('status');
    if ($session == '') {
      redirect(base_url() . 'login?alert=belum_login');
    }
  }

  public function sj()
  {
    $data['title'] = 'Sj Hs';
    $data['sj_user'] = $this->m_data->get_data('sj_user')->result();
    $data['sj_hs'] = $this->m_data->get_data('sj_hs')->result();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('sj/v_sj', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function sj_aksi()
  {
    $this->form_validation->set_rules('no_delivery', 'No Delivery', 'required');
    $this->form_validation->set_rules('date_delivery', 'Date Delivery', 'required');
    $this->form_validation->set_rules('due_date', 'Due Date', 'required');
    $this->form_validation->set_rules('no_po', 'No PO', 'required');
    $this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');
    $this->form_validation->set_rules('addtime', 'Addtime', 'required');

    if ($this->form_validation->run() != false) {

      $no_delivery = $this->input->post('no_delivery');
      $date_delivery = $this->input->post('date_delivery');
      $due_date = $this->input->post('due_date');
      $no_po = $this->input->post('no_po');
      $cust_name = $this->input->post('cust_name');
      $address = $this->input->post('address');
      $city = $this->input->post('city');
      $phone = $this->input->post('phone');
      $addtime = $this->input->post('addtime');

      $data = array(
        'no_delivery' => $no_delivery,
        'date_delivery' => $date_delivery,
        'due_date' => $due_date,
        'no_po' => $no_po,
        'cust_name' => $cust_name,
        'address' => $address,
        'city' => $city,
        'phone' => $phone,
        'addtime' => $addtime
      );

      $this->m_data->insert_data($data, 'sj_user');
      $this->session->set_flashdata('berhasil', 'SJ successfully added, No Po : ' . $this->input->post('no_po', TRUE) . ' !');
      redirect(base_url() . 'sj/sj');
    } else {
      $this->session->set_flashdata('gagal', 'SJ failed to add, Please repeat !');
      redirect(base_url() . 'sj/sj');
    }
  }

  public function sj_update()
  {
    //$this->form_validation->set_rules('no_urut', 'No Urut', 'required');
    $this->form_validation->set_rules('descript', 'Deskripsi', 'required');
    $this->form_validation->set_rules('qty', 'Qty', 'required');

    if ($this->form_validation->run() != false) {

      $id = $this->input->post('id');
      $descript = $this->input->post('descript');
      $qty = $this->input->post('qty');

      $data = array(
        'no_po' => $id,
        'descript' => $descript,
        'qty' => $qty
      );

      $this->m_data->insert_data($data, 'sj_hs');
      $this->session->set_flashdata('berhasil', 'No Po ' . $this->input->post('id', TRUE) . ' Successfully added Desc : ' . $this->input->post('descript', TRUE) . '  !');
      redirect(base_url() . 'sj/sj');
    } else {
      $this->session->set_flashdata('gagal', 'SJ Desc failed to add, Please repeat !');
      redirect(base_url() . 'sj/sj');
    }
  }

  public function sj_update_edit()
  {
    $this->form_validation->set_rules('descript', 'No Delivery', 'required');
    $this->form_validation->set_rules('qty', 'Date Delivery', 'required');

    if ($this->form_validation->run() != false) {
      $id = $this->input->post('id');
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

      $this->m_data->update_data($where, $data, 'sj_hs');
      $this->session->set_flashdata('berhasil', 'Desc successfully Update, No Po : ' . $this->input->post('no_po', TRUE) . ' !');
      redirect(base_url() . 'sj/sj');
    } else {
      $this->session->set_flashdata('gagal', 'SJ failed to Update, Please repeat !');
      redirect(base_url() . 'sj/sj');
    }
  }

  public function sj_edit()
  {
    $this->form_validation->set_rules('no_delivery', 'No Delivery', 'required');
    $this->form_validation->set_rules('date_delivery', 'Date Delivery', 'required');
    $this->form_validation->set_rules('no_po', 'No Po', 'required');
    $this->form_validation->set_rules('due_date', 'Due Date', 'required');
    $this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');

    if ($this->form_validation->run() != false) {

      $id = $this->input->post('no_po');
      $no_delivery = $this->input->post('no_delivery');
      $date_delivery = $this->input->post('date_delivery');
      $no_po = $this->input->post('no_po');
      $due_date = $this->input->post('due_date');
      $cust_name = $this->input->post('cust_name');
      $address = $this->input->post('address');
      $city = $this->input->post('city');
      $phone = $this->input->post('phone');
      $addtime2 = $this->input->post('addtime2');

      if ($this->form_validation->run() != false) {
        $data = array(
          'no_delivery' => $no_delivery,
          'date_delivery' => $date_delivery,
          'due_date' => $due_date,
          'no_po' => $no_po,
          'cust_name' => $cust_name,
          'address' => $address,
          'city' => $city,
          'phone' => $phone,
          'addtime2' => $addtime2
        );
      }

      $where = array(
        'no_po' => $id
      );
      $this->m_data->update_data($where, $data, 'sj_user');
      $this->session->set_flashdata('berhasil', 'SJ successfully Update, No Po : ' . $this->input->post('no_po', TRUE) . ' !');
      redirect(base_url() . 'sj/sj');
    } else {
      $this->session->set_flashdata('gagal', 'SJ failed to Update, Please repeat !');
      redirect(base_url() . 'sj/sj');
    }
  }

  public function sj_hapus()
  {
    $id = $this->input->post('no_po'); {
      $where = array(
        'no_po' => $id
      );
      $this->m_data->delete_data($where, 'sj_hs');
      $this->m_data->delete_data($where, 'sj_user');
      $this->session->set_flashdata('berhasil', 'SJ has been deleted !');
      redirect(base_url() . 'sj/sj');
    }
  }

  public function sj_desc_hapus()
  {
    $id = $this->input->post('no_id'); {
      $where = array(
        'no_id' => $id
      );
      $this->m_data->delete_data($where, 'sj_hs');
      $this->session->set_flashdata('berhasil', 'Desc has been deleted !');
      redirect(base_url() . 'sj/sj');
    }
  }

  public function sj_print()
  {
    $id = rawurldecode($this->encrypt->decode($_GET['p']));
    $this->load->library('pdf');
    $file_pdf = 'Print SJ';
    $paper = 'A4';
    $orientation = "POTRAIT";

    $where = array(
      'no_po' => $id
    );

    $data['sj_user'] = $this->m_data->edit_data($where, 'sj_user')->result();
    $data['sj_hs'] = $this->m_data->edit_data($where, 'sj_hs')->result();
    $html = $this->load->view('sj/hs_sj', $data, true);
    $this->pdf->generate($html, $file_pdf, $paper, $orientation);
  }


  public function sj_df()
  {
    $data['title'] = 'Sj Df';
    $data['sj_user_df'] = $this->m_data->get_data('sj_user_df')->result();
    $data['sj_dfh'] = $this->m_data->get_data('sj_df')->result();
    $this->load->view('dashboard/v_header', $data);
    $this->load->view('sj/v_sj_df', $data);
    $this->load->view('dashboard/v_footer');
  }

  public function sj_aksi_df()
  {
    $this->form_validation->set_rules('no_delivery', 'No Delivery', 'required');
    $this->form_validation->set_rules('date_delivery', 'Date Delivery', 'required');
    $this->form_validation->set_rules('due_date', 'Due Date', 'required');
    $this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');
    $this->form_validation->set_rules('addtime', 'Addtime', 'required');

    if ($this->form_validation->run() != false) {

      $no_delivery = $this->input->post('no_delivery');
      $nomor_del = str_replace("/", "-", $no_delivery);

      $date_delivery = $this->input->post('date_delivery');
      $due_date = $this->input->post('due_date');
      $cust_name = $this->input->post('cust_name');
      $address = $this->input->post('address');
      $city = $this->input->post('city');
      $phone = $this->input->post('phone');
      $addtime = $this->input->post('addtime');

      $data = array(
        'no_delivery' => $nomor_del,
        'date_delivery' => $date_delivery,
        'due_date' => $due_date,
        'cust_name' => $cust_name,
        'address' => $address,
        'city' => $city,
        'phone' => $phone,
        'addtime' => $addtime
      );

      $this->m_data->insert_data($data, 'sj_user_df');
      $this->session->set_flashdata('berhasil', 'SJ successfully added, No Delivery : ' . $this->input->post('no_delivery', TRUE) . ' !');
      redirect(base_url() . 'sj/sj_df');
    } else {
      $this->session->set_flashdata('gagal', 'SJ failed to add, Please repeat !');
      redirect(base_url() . 'sj/sj_df');
    }
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
      $this->session->set_flashdata('berhasil', 'Successfully added Desc : ' . $this->input->post('descript', TRUE) . '  !');
      redirect(base_url() . 'sj/sj_df');
    } else {
      $this->session->set_flashdata('gagal', 'SJ Desc failed to add, Please repeat !');
      redirect(base_url() . 'sj/sj_df');
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
      $this->session->set_flashdata('berhasil', 'Desc successfully Update, : ' . $this->input->post('descript', TRUE) . ' !');
      redirect(base_url() . 'sj/sj_df');
    } else {
      $this->session->set_flashdata('gagal', 'SJ failed to Update, Please repeat !');
      redirect(base_url() . 'sj/sj_df');
    }
  }

  public function sj_edit_df()
  {
    //$this->form_validation->set_rules('no_delivery', 'No Delivery', 'required');
    $this->form_validation->set_rules('date_delivery', 'Date Delivery', 'required');
    $this->form_validation->set_rules('due_date', 'Due Date', 'required');
    $this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');

    if ($this->form_validation->run() != false) {

      $id = $this->input->post('no_id');

      $this->input->post('no_delivery');
      $date_delivery = $this->input->post('date_delivery');
      $due_date = $this->input->post('due_date');
      $cust_name = $this->input->post('cust_name');
      $address = $this->input->post('address');
      $city = $this->input->post('city');
      $phone = $this->input->post('phone');
      $addtime2 = $this->input->post('addtime2');
      if ($this->form_validation->run() != false) {
        $data = array(

          'date_delivery' => $date_delivery,
          'due_date' => $due_date,
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
      $this->session->set_flashdata('berhasil', 'SJ successfully Update, No Po : ' . $this->input->post('no_delivery', TRUE) . ' !');
      redirect(base_url() . 'sj/sj_df');
    } else {
      $this->session->set_flashdata('gagal', 'SJ failed to Update, Please repeat !');
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
      $this->session->set_flashdata('berhasil', 'SJ has been deleted !');
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
      $this->session->set_flashdata('berhasil', 'Desc has been deleted !');
      redirect(base_url() . 'sj/sj_df');
    }
  }

  public function sj_print_df()
  {
    $id = rawurldecode($this->encrypt->decode($_GET['p']));
    $this->load->library('pdf');
    $file_pdf = 'Print SJ';
    $paper = 'LETTER';
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

  public function sj_print_inti($id)
  {
    $where = array(
      'no_id' => $id
    );

    $where2 = array(
      'id_join' => $id
    );
    $data['sj_user_df'] = $this->m_data->edit_data($where, 'sj_user_df')->result();
    $data['sj_df'] = $this->m_data->edit_data($where2, 'sj_df')->result();
    $this->load->view('sj/inti_sj', $data);
  }
}

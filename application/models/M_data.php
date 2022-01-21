<?php
class M_data extends CI_Model
{

  function cek_login($table, $where)
  {
    return $this->db->get_where($table, $where);
  }

  function get_data($table)
  {
    return $this->db->get($table);
  }

  // fungsi untuk menginput data ke database
  function insert_data($data, $table)
  {
    $this->db->insert($table, $data);
  }

  function insert_where($data, $table)
  {
    $this->db->insert($table, $data);
  }

  // fungsi untuk mengedit data
  function edit_data($where, $table)
  {
    return $this->db->get_where($table, $where);
  }

  // fungsi untuk mengupdate atau mengubah data di database
  function update_data($where, $data, $table)
  {
    $this->db->where($where);
    $this->db->update($table, $data);
  }

  function update_multi($where, $where2, $where3, $data, $table)
  {
    $this->db->where($where);
    $this->db->where($where2);
    $this->db->where($where3);
    $this->db->update($table, $data);
  }

  // fungsi untuk menghapus data dari database
  function delete_data($where, $table)
  {
    $this->db->delete($table, $where);
  }

  public function get_by_id($id)
  {
    $this->db->from($this->table);
    $this->db->where('id', $id);
    $query = $this->db->get();

    return $query->row();
  }

  public function tot_inquiry()
  {
    $sql = "SELECT * FROM inquiry";

    $data = $this->db->query($sql);

    return $data->num_rows();
  }

  public function tot_buffer()
  {
    $sql = "SELECT * FROM `buffer`";

    $data = $this->db->query($sql);

    return $data->num_rows();
  }

  public function select_sjhs($no_po)
  {
    $sql = "SELECT sj_hs.no_id as no_id, sj_hs.no_po as no_po, sj_hs.descript as descript, sj_hs.qty as qty FROM sj_hs INNER JOIN sj_user 
    ON sj_hs.no_po=sj_user.no_po WHERE sj_user.no_po=$no_po";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function select_sjdf($no_id)
  {
    $sql = "SELECT sj_df.no_id AS no_id, sj_df.id_join AS id_join, sj_df.descript AS descript, sj_df.qty AS qty FROM sj_df INNER JOIN sj_user_df 
    ON sj_df.id_join=sj_user_df.no_id WHERE sj_user_df.no_id=$no_id";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function select_by_sales()
  {
    $sql = "SELECT sales,COUNT(inquiry_id) AS jmlh FROM inquiry GROUP BY sales";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function select_by_brand()
  {
    $sql = "SELECT brand,COUNT(inquiry_id) AS jmlh FROM inquiry GROUP BY brand";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function suratjalan($table)
  {
    $sql = "SELECT COUNT(*) as total FROM $table WHERE EXTRACT(YEAR FROM date_delivery) = '2021'
		GROUP BY EXTRACT(MONTH FROM date_delivery) ORDER BY EXTRACT(MONTH FROM date_delivery)";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function bartracking($type)
  {
    $sql = "SELECT COUNT(*) AS total FROM driver WHERE join_id IN (SELECT no_id FROM type_vehicles WHERE TYPE='$type') AND
		EXTRACT(YEAR FROM tanggal) = '2021' GROUP BY EXTRACT(MONTH FROM tanggal) ORDER BY EXTRACT(MONTH FROM tanggal)";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function kontak($id)
  {
    $sql = "SELECT * FROM kontak where id_user = '$id'";

    $data = $this->db->query($sql);

    return $data->row();
  }

  public function total_inquiry($q = NULL)
  {
    $this->db->where('fu1', $q);
    $this->db->from('inquiry');
    return $this->db->count_all_results();
  }

  public function total_buffer($q = '-')
  {
    $this->db->where('status', $q);
    $this->db->from('buffer');
    return $this->db->count_all_results();
  }

  public function select_pengguna()
  {
    $data = $this->db->get('pengguna');
    return $data->result();
  }

  public function select_master()
  {
    $data = $this->db->get('master');
    return $data->result();
  }

  public function select_kurs()
  {
    $data = $this->db->get('kurs');
    return $data->result();
  }

  public function get_sub_kurs($id_kurs)
  {
    $query = $this->db->get_where('kurs', array('kurs' => $id_kurs));
    return $query;
  }

  public function select($id = '')
  {
    if ($id != '') {
      $this->db->where('pengguna_id', $id);
    }
    $data = $this->db->get('pengguna');
    return $data->row();
  }

  public function insert_kurs($data)
  {
    $this->db->insert_batch('kurs', $data);

    return $this->db->affected_rows();
  }

  public function check_kurs($currency)
  {
    $this->db->where('currency', $currency);
    $data = $this->db->get('kurs');

    return $data->num_rows();
  }

  public function check_master($brand)
  {
    $this->db->where('brand', $brand);
    $data = $this->db->get('master');

    return $data->num_rows();
  }

  public function insert_master($data)
  {
    $this->db->insert_batch('master', $data);

    return $this->db->affected_rows();
  }

  public function select_inquiry()
  {
    $sql = "SELECT a.sales,a.tanggal,a.inquiry_id,a.brand,a.desc,a.qty,a.deadline,a.keter,a.request,a.cek,a.fu1,a.ket_fu,a.cogs,b.currency 
    AS kurs,a.cogs_idr,a.reseller,a.new_seller,a.user,a.delivery,a.ket_purch,a.name_purch FROM inquiry a INNER JOIN kurs b ON a.kurs=b.id_kurs";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function buffer()
  {
    $sql = "SELECT * FROM `buffer` WHERE status!='approve' AND status!='finish'";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function arshipbuffer()
  {
    $sql = "SELECT * FROM `buffer` WHERE status='approve' OR status='finish'";

    $data = $this->db->query($sql);

    return $data->result();
  }
}

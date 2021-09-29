<?php 

// Model yang terstruktur. agar bisa digunakan berulang kali untuk membuat CRUD. 
// Sehingga proses pembuatan CRUD menjadi lebih cepat dan efisien.

class M_data extends CI_Model{
	
	function cek_login($table,$where){
		return $this->db->get_where($table,$where);
	}
	
	// FUNGSI CRUD
	// fungsi untuk mengambil data dari database
	function get_data($table){
		return $this->db->get($table);
	}

	public function select_inquiry() {
		$sql = "SELECT a.sales,a.tanggal,a.inquiry_id,a.brand,a.desc,a.qty,a.deadline,a.keter,a.request,a.cek,a.fu1,a.ket_fu,a.cogs,b.currency as kurs,a.cogs_idr,a.reseller,a.new_seller,a.user,a.delivery,a.ket_purch,a.name_purch 
		FROM inquiry a, kurs b WHERE a.kurs=b.id_kurs";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_buffer() {
		$sql = "SELECT * FROM `buffer` where `status`='approve'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	// fungsi untuk menginput data ke database
	function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	// fungsi untuk mengedit data
	function edit_data($where,$table){
		return $this->db->get_where($table,$where);
	}

	// fungsi untuk mengupdate atau mengubah data di database
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	// fungsi untuk menghapus data dari database
	function delete_data($where,$table){
		$this->db->delete($table,$where);
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function tot_inquiry() {
		$sql = "SELECT * FROM inquiry";

		$data = $this->db->query($sql);

		return $data->num_rows();
	}

	public function tot_buffer() {
		$sql = "SELECT * FROM `buffer`";

		$data = $this->db->query($sql);

		return $data->num_rows();
	}

	public function select_all_inquiry() {
		$sql = "SELECT a.sales,a.tanggal,a.inquiry_id,b.brand,a.desc,a.qty,a.deadline,a.keter,a.request,a.cek,a.fu1,a.ket_fu,a.cogs,c.currency as kurs,a.cogs_idr,a.reseller,a.new_seller,a.user,a.delivery,a.ket_purch,a.name_purch FROM inquiry a,MASTER b, kurs c 
		WHERE a.brand=b.id_master AND a.kurs=c.id_kurs";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_sales($id) {
		$sql = "SELECT COUNT(sales) AS jmlh FROM inquiry where sales = '{$id}'";

		$data = $this->db->query($sql);
		
		return $data->row();
	}

		public function select_by_brand($id) {
		$sql = "SELECT COUNT(brand) AS jmlh FROM inquiry where brand = '{$id}'";

		$data = $this->db->query($sql);
		
		return $data->row();
	}

	public function total_rows($q = NULL) {
		$this->db->where('fu1', $q);
		$this->db->from('inquiry');
		return $this->db->count_all_results();
		
	}

	public function select_pengguna() {
		$data = $this->db->get('pengguna');
		return $data->result();
	}

	public function select_master() {
		$data = $this->db->get('master');
		return $data->result();
	}

	public function select_kurs() {
		$data = $this->db->get('kurs');
		return $data->result();
	}

	public function get_sub_kurs($id_kurs){
		$query = $this->db->get_where('kurs', array('kurs' => $id_kurs));
		return $query;
	}

	public function select($id = '') {
		if ($id != '') {
			$this->db->where('pengguna_id', $id);
		}
		$data = $this->db->get('pengguna');
		return $data->row();
	}

	function get_kurs(){
		$this->db->select('id_kurs,currency,amount');
		$this->db->from('kurs');
		$query = $this->db->get();
		return $query;
	}

	function get_master(){
		$this->db->select('id_master,brand,d1,d2,user');
		$this->db->from('master');
		$this->db->order_by('brand',"ASC");
		$query = $this->db->get();
		return $query;
	}

	public function insert_kurs($data) {
		$this->db->replace('kurs', $data);
		
		return $this->db->affected_rows();
	}

	public function check_kurs($nama) {
		$this->db->where('currency', $nama);
		$data = $this->db->get('kurs');

		return $data->num_rows();
	}

	public function check_master($nama) {
		$this->db->where('brand', $nama);
		$data = $this->db->get('master');

		return $data->num_rows();
	}

	public function insert_master($data) {
		$this->db->replace('master', $data);
		
		return $this->db->affected_rows();
	}
}

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
	// AKHIR FUNGSI CRUD

	public function select_null() {
		$sql = "SELECT * FROM inquiry where fu1 is null";

		$data = $this->db->query($sql);

		return $data->num_rows();
	}

	public function select_not_null() {
		$sql = "SELECT * FROM inquiry WHERE fu1 IS NOT NULL";

		$data = $this->db->query($sql);

		return $data->num_rows();
	}

	public function select_all_inquiry() {
		$sql = "SELECT * FROM inquiry where fu1 is NOT NULL";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_inquiry($id) {
		$sql = "SELECT COUNT(*) AS jml FROM inquiry WHERE sales = {$id}";

		$data = $this->db->query($sql);
		
		return $data->row();
	}

	public function total_rows($q = NULL) {
		$this->db->like('fu1', $q);
		$this->db->from('inquiry');
		return $this->db->count_all_results();
		
	}

	public function select_all() {
		$data = $this->db->get('pengguna');

		return $data->result();
	}
}
?>

<?php

class Data_model extends CI_model
{

	public function __construct()
	{
		parent::__construct();
		require_once APPPATH . "models/Fuzzification.php";
	}

	public function get_all_data_training()
	{
		$this->db->select('*');
		$this->db->from('tb_data_training');
		$this->db->where('is_deleted', 0);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get_all_data_testing()
	{
		$this->db->select('*');
		$this->db->from('tb_data_training');
		$this->db->where('is_deleted', 1);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get_all_rule()
	{
//		$this->db->select('*');
//		$this->db->from('tb_rule');
//		$query = $this->db->get();
//
//		return $query->result();

		// todo: INI DUMMY, UBAH AMBIL DARI DB YA!

		return [
			[
				"name" => "umur",
				"types" => ["tua", "muda"],
				"threshold" => [26, 46]
			],
			[
				"name" => "sum_td",
				"types" => ["normal", "pra hipertensi", "hipertensi"],
				"threshold" => [200, 230, 270]
			],
			[
				"name" => "lingkar_perut",
				"types" => ["normal", "obesitas"],
				"threshold" => [90, 100]
			],
			[
				"name" => "bmi",
				"types" => ["normal", "overweight"],
				"threshold" => [18, 27]
			],
			[
				"name" => "merokok",
				"types" => ["tidak", "ya"],
				"threshold" => [0, 1]
			],
			[
				"name" => "makanan_berlemak",
				"types" => ["jarang", "sering"],
				"threshold" => [0, 1]
			],
			[
				"name" => "k_gula",
				"types" => ["> 4sdm", "<= 4sdm"],
				"threshold" => [0, 1]
			],
			[
				"name" => "k_garam",
				"types" => ["<= 1 sdt", "> 1 sdt"],
				"threshold" => [0, 1]
			],
			[
				"name" => "olahraga",
				"types" => ["tidak", "ya"],
				"threshold" => [0, 1]
			],
			[
				"name" => "k_kafein",
				"types" => ["tidak", "<=3gelas", "> 3 gelas"],
				"threshold" => [1, 2, 3]
			],
		];
	}

	public function get_all_initialthreshold()
	{
		$this->db->select('*');
		$this->db->from('tb_initialthreshold');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_formed_tree()
	{
		// todo: INI DUMMY, UBAH AMBIL DARI DB YA!

		$get_from_db = `{"name":"sum_td","children":[{"name":"olahraga","children":[{"result":"Sedang"},{"result":"Rendah"}]},{"name":"k_kafein","children":[{"name":"olahraga","children":[{"name":"makanan_berlemak","children":[{"result":"Sedang"},{"name":"umur","children":[{"result":"Sedang"},{"result":"Tinggi"}]}]},{"result":"Rendah"}]},{"name":"umur","children":[{"name":"k_gula","children":[{"result":"Rendah"},{"result":"Sedang"}]},{"name":"merokok","children":[{"name":"k_gula","children":[{"name":"makanan_berlemak","children":[{"name":"lingkar_perut","children":[{"result":"Sedang"},{"result":"Tinggi"}]},{"result":"Tinggi"}]},{"result":"Sedang"}]},{"result":"Sedang"}]}]},{"result":"Tinggi"}]},{"result":"Tinggi"}]}`;

		return json_decode($get_from_db);
	}

	public function get_fuzzy()
	{
		$data = $this->get_all_data_training();

		$rules = $this->get_all_rule();

		$fuzzification = new Fuzzification($data, $rules);

		return $fuzzification;
	}
}

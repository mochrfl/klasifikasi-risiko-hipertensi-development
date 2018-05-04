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

		$get_from_db = '{"name":"sum_td","result":false,"children":[{"name":"olahraga","result":false,"children":[{"result":"Sedang"},{"result":"Rendah"}]},{"name":"k_kafein","result":false,"children":[{"name":"olahraga","result":false,"children":[{"name":"makanan_berlemak","result":false,"children":[{"result":"Sedang"},{"name":"umur","result":false,"children":[{"result":"Sedang"},{"result":"Tinggi"}]}]},{"result":"Rendah"}]},{"name":"umur","result":false,"children":[{"name":"k_gula","result":false,"children":[{"result":"Rendah"},{"result":"Sedang"}]},{"name":"merokok","result":false,"children":[{"name":"k_gula","result":false,"children":[{"name":"makanan_berlemak","result":false,"children":[{"name":"lingkar_perut","result":false,"children":[{"result":"Sedang"},{"result":"Tinggi"}]},{"result":"Tinggi"}]},{"result":"Sedang"}]},{"result":"Sedang"}]}]},{"result":"Tinggi"}]},{"result":"Tinggi"}]}';

		return json_decode($get_from_db);
	}

	public function pengujian()
	{
		$data = $this->get_all_data_testing();

		$rules = $this->get_all_rule();

		$fuzzy = new Fuzzification($data, $rules, false, true);

		$transpose = array();
		foreach ($fuzzy->fuzzification as $key => $a) {
			foreach ($a as $k => $v) {
				$transpose[$k][$key] = $v;
			}
		}

		$simple_tree = $this->get_formed_tree();

		print_r($simple_tree);
		$results = [];

		foreach ($transpose as $item) {
//			print_r($item);
//			echo "<br>";
			$results[] = $this->single_pengujian($item, $simple_tree);
		}

		return $results;
	}

	private function single_pengujian($data_fuzzy, $node)
	{
		if ($node->result) {
			echo "halo";
			switch ($node->result) {
				case "Rendah":
					return [1, 0, 0];
				case "Sedang":
					return [0, 1, 0];
				case "Tinggi":
					return [0, 0, 1];
			}
		}

		$result = [0, 0, 0];
		if (!isset($data_fuzzy[$node->name]))
			print_r($node->name);
		else {
			$data = $data_fuzzy[$node->name];


			foreach ($data as $key => $datum) {
				if ($datum > 0) {
					$ch_val = $this->single_pengujian($data_fuzzy, $node->children[$key]);
					foreach ($result as $k => $r) {
						$result[$k] += $datum * $ch_val[$k];
					}
				}
			}

		}
		return $result;
	}

	public function get_fuzzy()
	{
		$data = $this->get_all_data_training();

		$rules = $this->get_all_rule();

		$fuzzification = new Fuzzification($data, $rules);

		return $fuzzification;
	}
}

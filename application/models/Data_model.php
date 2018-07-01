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

	public function import_data()
	{
		//todo	ini buat import data baru
	}

	public function save_all_rule()
	{
		//todo	ini buat save rules 
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
//		todo  ini threshold ambil dr db juga, nyimpan ke db bareng sama nyimpen setting diatas
	}

	public function save_formed_tree($data_json_tree, $data_json_table)
	{
		// dipake lah ini biar rapi, dibuat function save ke db nya
		// $this->db->save();
		// todo  hasil pelatihan simpen ke db disini,
	}

	public function get_formed_tree()
	{
		// todo: INI DUMMY, UBAH AMBIL DARI DB YA!

		$get_from_db = '{"name":"sum_td","result":false,"children":[{"name":"olahraga","result":false,"children":[{"result":"Sedang"},{"name":"merokok","result":false,"children":[{"result":"Rendah"},{"name":"k_kafein","result":false,"children":[{"name":"makanan_berlemak","result":false,"children":[{"result":"Rendah"},{"result":"Sedang"}]},{"name":"umur","result":false,"children":[{"result":"Rendah"},{"result":"Sedang"}]},{"result":"Sedang"}]}]}]},{"name":"k_kafein","result":false,"children":[{"name":"olahraga","result":false,"children":[{"name":"makanan_berlemak","result":false,"children":[{"result":"Sedang"},{"name":"umur","result":false,"children":[{"result":"Sedang"},{"name":"lingkar_perut","result":false,"children":[{"result":"Tinggi"},{"result":"Tinggi"}]}]}]},{"name":"makanan_berlemak","result":false,"children":[{"result":"Rendah"},{"result":"Sedang"}]}]},{"name":"umur","result":false,"children":[{"name":"k_gula","result":false,"children":[{"result":"Rendah"},{"result":"Sedang"}]},{"name":"merokok","result":false,"children":[{"name":"k_gula","result":false,"children":[{"name":"makanan_berlemak","result":false,"children":[{"name":"lingkar_perut","result":false,"children":[{"name":"bmi","result":false,"children":[{"result":"Sedang"},{"name":"k_garam","result":false,"children":[{"result":"Tinggi"},{"result":"Sedang"}]}]},{"result":"Tinggi"}]},{"result":"Tinggi"}]},{"name":"k_garam","result":false,"children":[{"result":"Sedang"},{"result":"Tinggi"}]}]},{"name":"k_garam","result":false,"children":[{"result":"Sedang"},{"result":"Sedang"}]}]}]},{"name":"k_garam","result":false,"children":[{"result":"Sedang"},{"name":"k_gula","result":false,"children":[{"result":"Tinggi"},{"name":"olahraga","result":false,"children":[{"result":"Tinggi"},{"result":"Sedang"}]}]}]}]},{"name":"makanan_berlemak","result":false,"children":[{"name":"umur","result":false,"children":[{"name":"k_garam","result":false,"children":[{"result":"Sedang"},{"result":"Tinggi"}]},{"name":"k_kafein","result":false,"children":[{"name":"olahraga","result":false,"children":[{"result":"Sedang"},{"result":"Tinggi"}]},{"name":"k_garam","result":false,"children":[{"name":"olahraga","result":false,"children":[{"result":"Sedang"},{"result":"Tinggi"}]},{"name":"olahraga","result":false,"children":[{"result":"Tinggi"},{"name":"merokok","result":false,"children":[{"result":"Tinggi"},{"result":"Sedang"}]}]}]},{"name":"k_gula","result":false,"children":[{"result":"Tinggi"},{"result":"Tinggi"}]}]}]},{"result":"Tinggi"}]}]}';

		return json_decode($get_from_db);
	}

	public function get_formed_table_of_rules()
	{
		// todo: INI DUMMY, UBAH AMBIL DARI DB YA!

		$get_from_db = '[{"sum_td":"0","olahraga":"0","result":"Sedang"},{"sum_td":"0","olahraga":"1","merokok":"0","result":"Rendah"},{"sum_td":"0","olahraga":"1","merokok":"1","k_kafein":"0","makanan_berlemak":"0","result":"Rendah"},{"sum_td":"0","olahraga":"1","merokok":"1","k_kafein":"0","makanan_berlemak":"1","result":"Sedang"},{"sum_td":"0","olahraga":"1","merokok":"1","k_kafein":"1","umur":"0","result":"Rendah"},{"sum_td":"0","olahraga":"1","merokok":"1","k_kafein":"1","umur":"1","result":"Sedang"},{"sum_td":"0","olahraga":"1","merokok":"1","k_kafein":"2","result":"Sedang"},{"sum_td":"1","k_kafein":"0","olahraga":"0","makanan_berlemak":"0","result":"Sedang"},{"sum_td":"1","k_kafein":"0","olahraga":"0","makanan_berlemak":"1","umur":"0","result":"Sedang"},{"sum_td":"1","k_kafein":"0","olahraga":"0","makanan_berlemak":"1","umur":"1","lingkar_perut":"0","result":"Tinggi"},{"sum_td":"1","k_kafein":"0","olahraga":"0","makanan_berlemak":"1","umur":"1","lingkar_perut":"1","result":"Tinggi"},{"sum_td":"1","k_kafein":"0","olahraga":"1","makanan_berlemak":"0","result":"Rendah"},{"sum_td":"1","k_kafein":"0","olahraga":"1","makanan_berlemak":"1","result":"Sedang"},{"sum_td":"1","k_kafein":"1","umur":"0","k_gula":"0","result":"Rendah"},{"sum_td":"1","k_kafein":"1","umur":"0","k_gula":"1","result":"Sedang"},{"sum_td":"1","k_kafein":"1","umur":"1","merokok":"0","k_gula":"0","makanan_berlemak":"0","lingkar_perut":"0","bmi":"0","result":"Sedang"},{"sum_td":"1","k_kafein":"1","umur":"1","merokok":"0","k_gula":"0","makanan_berlemak":"0","lingkar_perut":"0","bmi":"1","k_garam":"0","result":"Tinggi"},{"sum_td":"1","k_kafein":"1","umur":"1","merokok":"0","k_gula":"0","makanan_berlemak":"0","lingkar_perut":"0","bmi":"1","k_garam":"1","result":"Sedang"},{"sum_td":"1","k_kafein":"1","umur":"1","merokok":"0","k_gula":"0","makanan_berlemak":"0","lingkar_perut":"1","result":"Tinggi"},{"sum_td":"1","k_kafein":"1","umur":"1","merokok":"0","k_gula":"0","makanan_berlemak":"1","result":"Tinggi"},{"sum_td":"1","k_kafein":"1","umur":"1","merokok":"0","k_gula":"1","k_garam":"0","result":"Sedang"},{"sum_td":"1","k_kafein":"1","umur":"1","merokok":"0","k_gula":"1","k_garam":"1","result":"Tinggi"},{"sum_td":"1","k_kafein":"1","umur":"1","merokok":"1","k_garam":"0","result":"Sedang"},{"sum_td":"1","k_kafein":"1","umur":"1","merokok":"1","k_garam":"1","result":"Sedang"},{"sum_td":"1","k_kafein":"2","k_garam":"0","result":"Sedang"},{"sum_td":"1","k_kafein":"2","k_garam":"1","k_gula":"0","result":"Tinggi"},{"sum_td":"1","k_kafein":"2","k_garam":"1","k_gula":"1","olahraga":"0","result":"Tinggi"},{"sum_td":"1","k_kafein":"2","k_garam":"1","k_gula":"1","olahraga":"1","result":"Sedang"},{"sum_td":"2","makanan_berlemak":"0","umur":"0","k_garam":"0","result":"Sedang"},{"sum_td":"2","makanan_berlemak":"0","umur":"0","k_garam":"1","result":"Tinggi"},{"sum_td":"2","makanan_berlemak":"0","umur":"1","k_kafein":"0","olahraga":"0","result":"Sedang"},{"sum_td":"2","makanan_berlemak":"0","umur":"1","k_kafein":"0","olahraga":"1","result":"Tinggi"},{"sum_td":"2","makanan_berlemak":"0","umur":"1","k_kafein":"1","k_garam":"0","olahraga":"0","result":"Sedang"},{"sum_td":"2","makanan_berlemak":"0","umur":"1","k_kafein":"1","k_garam":"0","olahraga":"1","result":"Tinggi"},{"sum_td":"2","makanan_berlemak":"0","umur":"1","k_kafein":"1","k_garam":"1","olahraga":"0","result":"Tinggi"},{"sum_td":"2","makanan_berlemak":"0","umur":"1","k_kafein":"1","k_garam":"1","olahraga":"1","merokok":"0","result":"Tinggi"},{"sum_td":"2","makanan_berlemak":"0","umur":"1","k_kafein":"1","k_garam":"1","olahraga":"1","merokok":"1","result":"Sedang"},{"sum_td":"2","makanan_berlemak":"0","umur":"1","k_kafein":"2","k_gula":"0","result":"Tinggi"},{"sum_td":"2","makanan_berlemak":"0","umur":"1","k_kafein":"2","k_gula":"1","result":"Tinggi"},{"sum_td":"2","makanan_berlemak":"1","result":"Tinggi"}]';

		return json_decode($get_from_db);
	}

	public function pengujian($withNode = false)
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

		if ($withNode)
			$simple_tree = $this->get_formed_tree();
		else
			$simple_tree = $this->get_formed_table_of_rules();

		$results = [];

		foreach ($transpose as $k => $item) {
			if ($withNode)
				$results[$k] = $this->single_pengujian_node($item, $simple_tree);
			else
				$results[$k] = $this->single_pengujian($item, $simple_tree);

			$max_key = 0;
			foreach ($results[$k] as $key => $datum) {
				if ($datum > $results[$k][$max_key]) {
					$max_key = $key;
				}
			}

			$results[$k][] = $data[$k]["risiko_hipertensi"];
			$results[$k][] = $data[$k]["risiko_hipertensi"] - 1 != $max_key ? 1 : 0;
		}

		return $results;
	}

	private function single_pengujian_node($data_fuzzy, $node)
	{
		//ini bukan dummy ya. emang gini prosesnya.
		if ($node->result) {
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
		$data = $data_fuzzy[$node->name];

		foreach ($data as $key => $datum) {
			if ($datum > 0) {
				$ch_val = $this->single_pengujian_node($data_fuzzy, $node->children[$key]);
				foreach ($result as $k => $r) {
					$result[$k] += $datum * $ch_val[$k];
				}
			}
		}

		return $result;
	}

	private function single_pengujian($data_fuzzy, $table)
	{
		$result_table = [];

		$max_from_all = ["Rendah" => 0, "Sedang" => 0, "Tinggi" => 0];
		foreach ($table as $key => $row) {
			$min_for_result = 1;
			foreach ($row as $name => $item) {
				if ($name === "result") {
					$result_table[$key][$name] = [$item, $min_for_result];
					if ($max_from_all[$item] < $min_for_result)
						$max_from_all[$item] = $min_for_result;
				} else {
					if ($min_for_result > $data_fuzzy[$name][$item])
						$min_for_result = $data_fuzzy[$name][$item];
					$result_table[$key][$name] = [$item, $data_fuzzy[$name][$item]];
				}
			}
		}

		return array_values($max_from_all);
	}

	public function get_fuzzy()
	{
		$data = $this->get_all_data_training();

		$rules = $this->get_all_rule();

		$fuzzification = new Fuzzification($data, $rules);

		//todo  panggil save_formed_tree disini. save ke db tree-rules nya.

		return $fuzzification;
	}
}

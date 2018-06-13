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
		$this->db->select('json_data');
        $this->db->from('tb_initial_threshold_new');
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        return json_decode($result->json_data, true);
//		$this->db->select('*');
//		$this->db->from('tb_rule');
//		$query = $this->db->get();
//
//		return $query->result();

		// todo: INI DUMMY, UBAH AMBIL DARI DB YA!
	//
	// 	$jsonObject = '[{"name":"umur","types":["tua","muda"],"threshold":[26,46]},{"name":"sum_td","types":["normal","pra hipertensi","hipertensi"],"threshold":[200,230,270]},{"name":"lingkar_perut","types":["normal","obesitas"],"threshold":[90,100]},{"name":"bmi","types":["normal","overweight"],"threshold":[18,27]},{"name":"merokok","types":["tidak","ya"],"threshold":[0,1]},{"name":"makanan_berlemak","types":["jarang","sering"],"threshold":[0,1]},{"name":"k_gula","types":["> 4sdm","<= 4sdm"],"threshold":[0,1]},{"name":"k_garam","types":["<= 1 sdt","> 1 sdt"],"threshold":[0,1]},{"name":"olahraga","types":["tidak","ya"],"threshold":[0,1]},{"name":"k_kafein","types":["tidak","<=3gelas","> 3 gelas"],"threshold":[1,2,3]}]';
	//
	// return json_decode($jsonObject, true);

		// return [
		// 	[
		// 		"name" => "umur",
		// 		"types" => ["tua", "muda"],
		// 		"threshold" => [26, 46]
		// 	],
		// 	[
		// 		"name" => "sum_td",
		// 		"types" => ["normal", "pra hipertensi", "hipertensi"],
		// 		"threshold" => [200, 230, 270]
		// 	],
		// 	[
		// 		"name" => "lingkar_perut",
		// 		"types" => ["normal", "obesitas"],
		// 		"threshold" => [90, 100]
		// 	],
		// 	[
		// 		"name" => "bmi",
		// 		"types" => ["normal", "overweight"],
		// 		"threshold" => [18, 27]
		// 	],
		// 	[
		// 		"name" => "merokok",
		// 		"types" => ["tidak", "ya"],
		// 		"threshold" => [0, 1]
		// 	],
		// 	[
		// 		"name" => "makanan_berlemak",
		// 		"types" => ["jarang", "sering"],
		// 		"threshold" => [0, 1]
		// 	],
		// 	[
		// 		"name" => "k_gula",
		// 		"types" => ["> 4sdm", "<= 4sdm"],
		// 		"threshold" => [0, 1]
		// 	],
		// 	[
		// 		"name" => "k_garam",
		// 		"types" => ["<= 1 sdt", "> 1 sdt"],
		// 		"threshold" => [0, 1]
		// 	],
		// 	[
		// 		"name" => "olahraga",
		// 		"types" => ["tidak", "ya"],
		// 		"threshold" => [0, 1]
		// 	],
		// 	[
		// 		"name" => "k_kafein",
		// 		"types" => ["tidak", "<=3gelas", "> 3 gelas"],
		// 		"threshold" => [1, 2, 3]
		// 	],
		// ];
	}

	public function get_all_initialthreshold()
	{
		$this->db->select('*');
		$this->db->from('tb_initialthreshold');
		$query = $this->db->get();

		return $query->result();
	}

	public function save_formed_tree($array_tree)
    {
        $data = array(
            'json_data' => $array_tree
        );

        $this->db->insert('tb_formed_tree', $data);
    }

		public function get_formed_tree()
	    {
	        // disinilah fungsi kenapa id harus autoincrement. Jadi data tree yang lama gausah dihapus fungsinya buat logging aja.
	        // terus gimana? masa harus ditampilin semua? engga. pake fungsi query limit. jadi data yang disave terakhir yang bakal muncul
	        $this->db->select('json_data');
	        $this->db->from('tb_formed_tree');
	        $this->db->order_by("id", "desc");
	        $this->db->limit(1);
					$query = $this->db->get();
					$result = $query->row();
					return json_decode($result->json_data);

	        // KITA COMMENT DULU BAGIAN INI KALO GA YAKIN
	        // todo: INI DUMMY, UBAH AMBIL DARI DB YA!
	        // $get_from_db = '{"name":"sum_td","result":false,"children":[{"name":"olahraga","result":false,"children":[{"result":"Sedang"},{"result":"Rendah"}]},{"name":"k_kafein","result":false,"children":[{"name":"olahraga","result":false,"children":[{"name":"makanan_berlemak","result":false,"children":[{"result":"Sedang"},{"name":"umur","result":false,"children":[{"result":"Sedang"},{"result":"Tinggi"}]}]},{"result":"Rendah"}]},{"name":"umur","result":false,"children":[{"name":"k_gula","result":false,"children":[{"result":"Rendah"},{"result":"Sedang"}]},{"name":"merokok","result":false,"children":[{"name":"k_gula","result":false,"children":[{"name":"makanan_berlemak","result":false,"children":[{"name":"lingkar_perut","result":false,"children":[{"result":"Sedang"},{"result":"Tinggi"}]},{"result":"Tinggi"}]},{"result":"Sedang"}]},{"result":"Sedang"}]}]},{"result":"Tinggi"}]},{"result":"Tinggi"}]}';
	        // return json_decode($get_from_db);
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

		// print_r($simple_tree);
		$results = [];

		echo '<pre>'.var_export($simple_tree, true). '</pre>';

		echo '<pre>'.var_export($transpose, true). '</pre>';

		echo '<pre>'.var_export($transpose[0], true). '</pre>';

		foreach ($transpose as $item) {
//			print_r($item);
//			echo "<br>";
			// $results[] = $this->single_pengujian($item, $simple_tree);
			$results[] = $this->single_pengujian($item, $simple_tree);
		}

		echo "result nih";
		echo '<pre>'.var_export($results, true). '</pre>';

		/*
		for pertama untuk melooping sebanyak results
		for kedua untuk melooping sebanyak jumlah kelas yang ada dalam results
		di for kedua merupakan proses membandingkan mana yang memiliki nilai paling maksimal diantara 3 kelas
		*/
		$finalClassification = [];
		for ($i=0; $i < count($results); $i++) {
			$maxValue = -999;
			for ($j=0; $j < count($results[$i]) ; $j++) {

				if ($j == 0) {
					$finalClassification[$i] = $results[$i][$j][0];
					$maxValue = $results[$i][$j][2];
				} else {
					if ($results[$i][$j][2] >= $maxValue) {
						$finalClassification[$i] = $results[$i][$j][0];
						$maxValue = $results[$i][$j][2];
					}
				}
			}
		}

		echo "klasifikasi akhir";
		echo '<pre>'.var_export($finalClassification, true). '</pre>';

		/*
		ambil data uji untuk dibandingkan -> $dataUjis
		*/
		$dataUjis = $this->get_all_data_testing();

		// memasukkan dataujis resiko hipertensi ke variabel baru, supaya mudah terbaca
		// kita hanya mengambil kolom kelas nya saja
		foreach ($dataUjis as $key => $dataUji) {
			$dataUjiRisikoHipertensi[] = $dataUji['risiko_hipertensi'];
		}

		// proses untuk membandingkan kelas yang seharusnya dengan kelas hasil pengujian ID3 dan mamdani
		// ada berapa jumlah data yang correct
		$dataCorrect = 0;
		for ($k=0; $k < count($dataUjiRisikoHipertensi) ; $k++) {
			if ($dataUjiRisikoHipertensi[$k] == $finalClassification[$k]) {
				$dataCorrect++;
			}
		}

		// jumlah data correct diatas dibagi dengan jumlah data uji nya lalu di kali dengan 100 untuk
		// melihat akurasi. (dalam persen)
		$accuracy = ($dataCorrect / count($finalClassification)) * 100;

		echo "data uji";
		echo '<pre>'.var_export($dataUjiRisikoHipertensi, true). '</pre>';
		echo "akurasi";
		echo '<pre>'.var_export($accuracy, true). '</pre>';


		return array($dataUjiRisikoHipertensi, $finalClassification, $accuracy);
	}

	private function single_pengujian($data_fuzzy, $node)
	{
		// echo var_export($data_fuzzy, true);
		// echo var_export($node, true);
		// echo '<pre>'. var_export($node->result). '</pre>';
		if ($node->result) {
			echo "halo";
			switch ($node->result) {
				case "Rendah":
					return array(
						array(1, 1, -999),
						array(2, 0, -999),
						array(3, 0, -999)
					);
				case "Sedang":
					return array(
						array(1, 0, -999),
						array(2, 1, -999),
						array(3, 0, -999)
					);
				case "Tinggi":
					return array(
						array(1, 0, -999),
						array(2, 0, -999),
						array(3, 1, -999)
					);
			}
		}

		$result = array(
			array(0, 0, -999),
			array(0, 0, -999),
			array(0, 0, -999)
		);
		// $maxValue = -99999;

		if (!isset($data_fuzzy[$node->name]))
			print_r($node->name);
		else {
			$data = $data_fuzzy[$node->name];


			foreach ($data as $key => $datum) {
				$ch_val = $this->single_pengujian($data_fuzzy, $node->children[$key]);

				for ($i=0; $i < count($ch_val) ; $i++) {
					if ($ch_val[$i][1] > 0) {
						$ch_val[$i][2] = max($ch_val[$i][2], $datum);
					}
				}

				if ($result[0][0] == 0) {
					for ($i=0; $i < count($result); $i++) {
						for ($j=0; $j < count($result[0]) ; $j++) {
							$result[$i][$j] = $ch_val[$i][$j];
						}
					}
					// $result = $ch_val;
				} else {
					for ($i=0; $i < count($result) ; $i++) {
						$result[$i][1] += $ch_val[$i][1];
						$result[$i][2] = max($ch_val[$i][2], $result[$i][2]);
					}
				}
			}

		}
		// return $result;
		return $result;
	}

	// private function single_pengujian($data_fuzzy, $node)
	// {
	// 	// echo var_export($data_fuzzy, true);
	// 	// echo var_export($node, true);
	// 	// echo '<pre>'. var_export($node->result). '</pre>';
	// 	if ($node->result) {
	// 		echo "halo";
	// 		switch ($node->result) {
	// 			case "Rendah":
	// 				return [1, 0, 0];
	// 			case "Sedang":
	// 				return [0, 1, 0];
	// 			case "Tinggi":
	// 				return [0, 0, 1];
	// 		}
	// 	}
	//
	// 	$result = [0, 0, 0];
	// 	// $maxValue = -99999;
	//
	// 	if (!isset($data_fuzzy[$node->name]))
	// 		print_r($node->name);
	// 	else {
	// 		$data = $data_fuzzy[$node->name];
	//
	//
	// 		foreach ($data as $key => $datum) {
	// 			if ($datum > 0) {
	// 				// $maxValue = $datum;
	// 				$ch_val = $this->single_pengujian($data_fuzzy, $node->children[$key]);
	// 				foreach ($result as $k => $r) {
	// 					$datumNew[] = $datum;
	// 					$ch_val_new[] = $ch_val[$k];
	// 					// $result[$k] += $datum * $ch_val[$k];
	// 				}
	// 			}
	// 		}
	//
	// 	}
	// 	// return $result;
	// 	return array($datumNew, $ch_val_new);
	// }



	public function get_fuzzy()
	{
		$data = $this->get_all_data_training();

		$rules = $this->get_all_rule();

		$fuzzification = new Fuzzification($data, $rules);

		return $fuzzification;
	}
}

<?php

class Data_model extends CI_model
{

	public function __construct()
	{
		parent::__construct();
		require_once APPPATH."models/Fuzzification.php";
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
		$this->db->select('*');
		$this->db->from('tb_rule');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_all_initialthreshold()
	{
		$this->db->select('*');
		$this->db->from('tb_initialthreshold');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_fuzzy() {
		$data = $this->get_all_data_training();

		$rules = [
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
				"name" => "berat_badan",
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

		$this->load->library('fuzzification');

		$fuzzification = new Fuzzification($data, $rules);

		return $fuzzification;
	}
}

<?php

class Fuzzification
{
	public static $initTotalData;
	public $isRoot = false;
	public $name;

	public $data;
	public $totalData;
	public $sum;
	public $rules;
	public $fuzzification;
	public $risk = ["Rendah", "Sedang", "Tinggi"];
	public $riskCount = [0, 0, 0];
	public $iG = [];
	public $entrophy = [];
	public $globalEntrophy;
	public $chosenRule;
	public $highestIGFrom;

	public $hasData = false;
	public $hasRules = false;
	public $isTesting = false;

	public $pernode;
	public $pernodePercentage;

	public $result = false;
	public $children = null;

	public function __construct($data, $rules, $name = false, $test = false)
	{
		$this->setData($data);
		$this->setRules($rules);
		$this->isTesting = $test;

		if ($name) {
			$this->name = $name;
		} else {
			$this->name = "root";
			$this->isRoot = true;
			self::$initTotalData = $this->totalData;
			$this->start();
		}
	}

	function start()
	{
		if ($this->totalData) {
			$this->fuzzification();
			if (!$this->isTesting) {
				$this->countEntrophy();
				$this->countIG();
				$this->extractTree();
			}
		}
	}

	function setRules($rules)
	{
		$this->rules = $rules;
		$this->hasRules = true;
	}

	function setData($data)
	{
		$this->data = $data;
		$this->hasData = true;

		$this->totalData = count($data);
		foreach ($data as $datum) {
			$this->riskCount[$datum["risiko_hipertensi"] - 1]++;
		}
	}

	function isReady()
	{
		return $this->hasData && $this->hasRules;
	}

	function fuzzification()
	{
		if ($this->isReady()) {
			foreach ($this->rules as $no => $rule) {
				$fuzzi = [];

				//init sum value
				$this->sum[$no] = [];
				foreach ($rule["types"] as $type) {
					$this->sum[$no][] = [
						"all" => 0,
						"tinggi" => 0,
						"sedang" => 0,
						"rendah" => 0
					];
				}

				foreach ($this->data as $key => $datum) {
					for ($i = 0; $i < count($rule["types"]); $i++) {
						$val = $datum[$rule["name"]];

						$fuzzi[$key][$i] = $this->calculateFuzzy($rule, $i, $val);

						$this->sum[$no][$i]["all"] += $fuzzi[$key][$i];
						if ($datum["risiko_hipertensi"] == 1)
							$this->sum[$no][$i]["rendah"] += $fuzzi[$key][$i];
						if ($datum["risiko_hipertensi"] == 2)
							$this->sum[$no][$i]["sedang"] += $fuzzi[$key][$i];
						if ($datum["risiko_hipertensi"] == 3)
							$this->sum[$no][$i]["tinggi"] += $fuzzi[$key][$i];
					}
				}

				$this->fuzzification[$rule["name"]] = $fuzzi;
			}
		}
	}

	/**
	 * @param $rule
	 * @param $i
	 * @param $val
	 * @return float|int
	 */
	function calculateFuzzy($rule, $i, $val)
	{
		$threshold = $rule["threshold"];

		if ($i == 0) {
			$fuzziVal = $val <= $threshold[$i] ?
				1
				: ($val < $threshold[$i + 1] ?
					($threshold[$i + 1] - $val) / ($threshold[$i + 1] - $threshold[$i])
					: 0);
		} else if ($i == count($rule["types"]) - 1) {
			$fuzziVal = $val >= $threshold[$i] ?
				1
				: ($val > $threshold[$i - 1] ?
					($val - $threshold[$i - 1]) / ($threshold[$i] - $threshold[$i - 1])
					: 0);
		} else {
			$fuzziVal = $val <= $threshold[$i] ?
				($val > $threshold[$i - 1] ?
					($val - $threshold[$i - 1]) / ($threshold[$i] - $threshold[$i - 1])
					: 0)
				: ($val < $threshold[$i + 1] ?
					($threshold[$i + 1] - $val) / ($threshold[$i + 1] - $threshold[$i])
					: 0);
		}
		return $fuzziVal;
	}

	function countEntrophy()
	{
		$frRendah = $this->riskCount[0] / $this->totalData;
		$frSedang = $this->riskCount[1] / $this->totalData;
		$frTinggi = $this->riskCount[2] / $this->totalData;

		$this->globalEntrophy =
			-$frRendah * log($frRendah ? $frRendah : 1, 2)
			- $frSedang * log($frSedang ? $frSedang : 1, 2)
			- $frTinggi * log($frTinggi ? $frTinggi : 1, 2);

		foreach ($this->rules as $no => $rule) {
			for ($i = 0; $i < count($rule["types"]); $i++) {
				if ($this->sum[$no][$i]["all"] > 0) {
					$frRendah = $this->sum[$no][$i]["rendah"] / $this->sum[$no][$i]["all"];
					$frSedang = $this->sum[$no][$i]["sedang"] / $this->sum[$no][$i]["all"];
					$frTinggi = $this->sum[$no][$i]["tinggi"] / $this->sum[$no][$i]["all"];

					$this->entrophy[$no][$i] =
						-$frRendah * log($frRendah ? $frRendah : 1, 2)
						- $frSedang * log($frSedang ? $frSedang : 1, 2)
						- $frTinggi * log($frTinggi ? $frTinggi : 1, 2);
				} else
					$this->entrophy[$no][$i] = 0;
			}
		}
	}

	function countIG()
	{
		$this->highestIGFrom = 0;

		foreach ($this->rules as $no => $rule) {
			$this->iG[$no] = $this->globalEntrophy;
			for ($i = 0; $i < count($rule["types"]); $i++) {
				$this->iG[$no] -= $this->sum[$no][$i]["all"] / $this->totalData * $this->entrophy[$no][$i];
			}

			if ($this->iG[$this->highestIGFrom] < $this->iG[$no]) {
				$this->highestIGFrom = $no;
			}
		}

		$this->chosenRule = $this->rules[$this->highestIGFrom]["name"];
	}

	function extractTree()
	{
		// ini buat bikin tree dari perhitungan fuzzy, IG, dll diatas.
		$this->children = [];

		$this->pernode = [];
		$this->pernodePercentage = [];

		//ini for masing2 anaknya - berdasarkan types, contoh: "normal", "pra" sama "hipertensi"
		for ($i = 0; $i < count($this->rules[$this->highestIGFrom]["types"]); $i++) {
			//untuk masing-masing anak, contoh yg normal.

			//pertama di filter dulu cuman data yg value fuzzy "normal" nya > 0 yg diambil.
			$childData = array_filter($this->data, function ($datum) use ($i) {
				return $this->fuzzification[$this->chosenRule][$datum["id"] - 1][$i] > 0;
			});

			// rules yg terpilih kan hipertensi.
			// jadi rules buat anak kan harus diilangin hipertensi nya.
			$childRules = $this->rules;
			unset($childRules[$this->highestIGFrom]);
			$childRules = array_values($childRules);
			// awalnya rules ada 10 jadi tinggal 9

			$name = $this->chosenRule . " - " . $i . " - " . $this->rules[$this->highestIGFrom]["types"][$i];

			// persiapan itung fuzzifikasi anak pake data yg udah di filter sama rules yg udah dikurangi juga.
			// untuk tipe ini aja, (masih didalam for) cth: skrg lagi looping buat type yg "normal"

			$this->children[] = new Fuzzification($childData, $childRules, $name);

			// masing2 udah ada anaknya, tp proses fuzzyfikasi anak belum dijalanin.
			// dilihat dulu apa % nya ada yg lebih dari 70?
			// cth, kalau tinggi lebih dari 70 kan berarti udah jelas resiko nya tinggi

			// nah, ini ngitung persen nya berapa, threshold hardcoded 70%
			// sesuai cth td, ini masih yg "normal" aja ya

			$thresholdK = 90;
			$thresholdN = 5;
			$sum = 0;
			for ($j = 0; $j < count($this->risk); $j++) {
				$this->pernode[$j][$i] = 0;
				foreach ($childData as $datum) {
					if ($datum["risiko_hipertensi"] == $j + 1)
						$this->pernode[$j][$i] += $this->fuzzification[$this->chosenRule][$datum["id"] - 1][$i];
				}
				$sum += $this->pernode[$j][$i];
				// ini ngitung berapa total fuzzy nya untuk masing2 "rendah", "sedang", "tinggi"
			}

			$max = 0;
			for ($j = 0; $j < count($this->risk); $j++) {
				// ini dijadiin %
				$this->pernodePercentage[$j][$i] = $this->pernode[$j][$i] / $sum * 100;
				if ($this->pernodePercentage[$j][$i] >= $this->pernodePercentage[$max][$i])
					$max = $j;
			}

			// nah kalau ternyata ngga sampe 70% (result belum di set),
			// kita jalanin fuzzifikasi, dan tree-nya bakal jadi makin dalam.
			if (!$this->children[$i]->result) {
//				kalau > 70% langsung di set result nya,
//				cth di "normal", ketemu hasil "tinggi" > 78%, yaudah.
				if ($this->pernodePercentage[$max][$i] >= $thresholdK) {
					$this->children[$i]->setResult($this->risk[$max]);

//				cek thresholdN, walaupun % kurang dari 70%, kalau datanya udah menipis tetep dipilih yang paling maks,
//				cth di "normal", ketemu hasil "tinggi" > 54%, tp data kurang dari 5%, yaudah terpaksa dipilih normal.
				} else if (count($childData) / self::$initTotalData * 100 < $thresholdN || count($childRules) <= 1) {
					$this->children[$i]->setResult($this->risk[$max]);
				} else
					$this->children[$i]->start();
			}
		}
	}


	// dibawah ini fungsi2 buat nampilin sama set data, masalah presentasi data lah.

	function setResult($val)
	{
		$this->result = $val;
	}

	function getResult()
	{
		$name = $this->prependName();
		$name = "<a href='#$name'>$this->name</a>";

		if (!$this->result) {
			return "[$name]";
		}

		return "[$name => $this->result]|";
	}

	function prependName()
	{
		return str_replace(" ", "-", $this->name);
	}

	function printTree()
	{
		$str = $this->getResult();

		if ($this->children != null) {
			$str .= "<div style='padding:10px'> [";
			foreach ($this->children as $child) {
				$str .= $child->printTree();
			}
			$str .= "]</div>";
		}

		return $str;
	}

	function arrayTree()
	{
		if ($this->chosenRule)
			$arr = [
				"name" => $this->chosenRule,
				"result" => $this->result
			];
		else
			return ["result" => $this->result];

		if ($this->children != null) {
			$arr["children"] = [];
			foreach ($this->children as $child) {
				$arr["children"][] = $child->arrayTree();
			}
		}

		return $arr;
	}

	function totalLeaf()
	{
		$total = 0;

		if ($this->children != null) {
			foreach ($this->children as $child) {
				$total += $child->totalLeaf();
			}
		} else
			return 1;

		return $total;
	}

	function tableOfRules($prevRules = [])
	{
		$tableRules = [];

		if (!$this->isRoot){
			$arr = explode(" - ", $this->name);
			$prevRules[$arr[0]] = $arr[1];
		}
		if ($this->children != null) {
			foreach ($this->children as $child) {
				foreach ($child->tableOfRules($prevRules) as $childRules) {
					$tableRules[] = $childRules;
				}
			}
		} else {
			$prevRules["result"] = $this->result;
			$tableRules[] = $prevRules;
		}

		return $tableRules;
	}

	function arrayFuzzy()
	{
		$fuzzy_data = [$this];

		if ($this->children != null) {
			foreach ($this->children as $child) {
				$fuzzy_data = array_merge($fuzzy_data, $child->arrayFuzzy());
			}
		}

		return $fuzzy_data;
	}
}

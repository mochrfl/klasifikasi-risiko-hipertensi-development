<?php

class Fuzzification
{
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
	public $highestIGFrom;

	public $hasData = false;
	public $hasRules = false;
	public $isFuzzificated = false;

	public $pernode;
	public $pernodePercentage;

	public $result = false;
	public $children = null;

	public function __construct($data, $rules, $name = false)
	{
		$this->setData($data);
		$this->setRules($rules);

		if ($name) {
			$this->name = $name;
		} else {
			$this->name = "root";
			$this->isRoot = true;

			$this->start();
		}
	}

	function start()
	{
		if ($this->totalData) {
			$this->fuzzification();
			$this->extractTree();
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

				$this->fuzzification[$no] = $fuzzi;
			}

			$this->countEntrophy();

			$this->countIG();

			$this->isFuzzificated = true;
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
	}

	function extractTree()
	{
		if ($this->isFuzzificated) {
			$this->children = [];

			$this->pernode = [];
			$this->pernodePercentage = [];

			for ($i = 0; $i < count($this->rules[$this->highestIGFrom]["types"]); $i++) {
				$childData = array_filter($this->data, function ($datum) use ($i) {
					return $this->fuzzification[$this->highestIGFrom][$datum["id"] - 1][$i] > 0;
				});

				$childRules = $this->rules;
				unset($childRules[$this->highestIGFrom]);
				$childRules = array_values($childRules);

				$name = $this->rules[$this->highestIGFrom]["name"] . " - " . $this->rules[$this->highestIGFrom]["types"][$i];
				$this->children[] = new Fuzzification($childData, $childRules, $name);

				$sum = 0;
				for ($j = 0; $j < count($this->risk); $j++) {
					$this->pernode[$j][$i] = 0;
					foreach ($childData as $datum) {
						if ($datum["risiko_hipertensi"] == $j + 1)
							$this->pernode[$j][$i] += $this->fuzzification[$this->highestIGFrom][$datum["id"] - 1][$i];
					}
					$sum += $this->pernode[$j][$i];
				}
				for ($j = 0; $j < count($this->risk); $j++) {
					$this->pernodePercentage[$j][$i] = $this->pernode[$j][$i] / $sum * 100;

					if ($this->pernodePercentage[$j][$i] >= 70) {
						$this->children[$i]->setResult($this->risk[$j]);
					}
				}

				if (!$this->children[$i]->result) {
//					echo "<br>" . $this->rules[$this->highestIGFrom]["name"] . " child no $i <br>";
//					print_r($this->entrophy);
//					echo "<br>";
//					print_r($this->riskCount);
//					echo "<br>";
//					print_r($this->totalData);
//					echo "<br>";
//					print_r($this->sum);
//					echo "<br>";
//					print_r($this->globalEntrophy);
//					echo "<br>";
					$this->children[$i]->start();
//				} else {
//					echo "<br>" . $this->rules[$this->highestIGFrom]["name"] . " child no $i <br>";
//					print_r($this->result);
//					echo "<br>";
//					print_r($this->pernodePercentage);
//					echo "<br>";
				}
			}
		}
	}

	function setResult($val)
	{
		$this->result = $val;
	}

	function getResult()
	{
		if (!$this->result) {
			return "[$this->name]";
		}

		return "[$this->name => $this->result]|";
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
}

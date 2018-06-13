<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use Tree\Node\Node;

class User extends CI_Controller {

  public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('user/home');
	}

  public function list_data()
	{
    $data['data_training'] = $this->data_model->get_all_data_training();
		$this->load->view('user/list_data', array('data_training' => $data['data_training']));
	}

  public function temp_proses_klasifikasi2() {
    $generasi = 1;
    $popSize = 7;



    // get data training
    $data['data_training'] = $this->data_model->get_all_data_training();
    // get rule
    $data['rule'] = $this->data_model->get_all_rule();

    //AMBIL DATA TRAINING
    $indexHelper = 0;
    foreach ($data['data_training'] as $row) {
      $data_training[$indexHelper][0] = $row->umur;
      $data_training[$indexHelper][1] = $row->sex;
      $data_training[$indexHelper][2] = $row->td_sistol;
      $data_training[$indexHelper][3] = $row->td_diastol;
      $data_training[$indexHelper][4] = $row->lingkar_perut;
      $data_training[$indexHelper][5] = $row->tinggi_badan;
      $data_training[$indexHelper][6] = $row->berat_badan;
      $data_training[$indexHelper][5] = $row->bmi;
      $data_training[$indexHelper][6] = $row->merokok;
      $data_training[$indexHelper][7] = $row->makanan_berlemak;
      $data_training[$indexHelper][8] = $row->k_gula;
      $data_training[$indexHelper][9] = $row->k_garam;
      $data_training[$indexHelper][10] = $row->olahraga;
      $data_training[$indexHelper][11] = $row->k_kafein;
      $data_training[$indexHelper][12] = $row->risiko_hipertensi;
      $indexHelper++;
    }

    //AMBIL RULE
    $indexHelper = 0;
    foreach ($data['rule'] as $row) {
      $rule[$indexHelper][0] = $row->umur;
      $rule[$indexHelper][1] = $row->sex;
      $rule[$indexHelper][2] = $row->tekanan_datah;
      $rule[$indexHelper][3] = $row->lingkar_perut;
      $rule[$indexHelper][4] = $row->tinggi_badan;
      $rule[$indexHelper][5] = $row->berat_badan;
      $rule[$indexHelper][6] = $row->bmi;
      $rule[$indexHelper][7] = $row->merokok;
      $rule[$indexHelper][8] = $row->makanan_berlemak;
      $rule[$indexHelper][9] = $row->k_gula;
      $rule[$indexHelper][10] = $row->k_garam;
      $rule[$indexHelper][11] = $row->olahraga;
      $rule[$indexHelper][12] = $row->k_kafein;
      $rule[$indexHelper][13] = $row->risiko_hipertensi;
      $indexHelper++;
    }

    // random kromosom
    for ($a=0; $a < $popSize ; $a++) {
			$initKromosom[$a][0] = mt_rand(20,37); // a1
			$initKromosom[$a][1] = mt_rand(38,100); // a2
			$initKromosom[$a][2] = mt_rand(60,89); // b1
      $initKromosom[$a][3] = mt_rand(90,120); // b2
      $initKromosom[$a][4] = mt_rand(16,24); // c1
      $initKromosom[$a][5] = mt_rand(25,30); // c2
      // $initKromosom[$a][6] = mt_rand(140,200); // d1
      // $initKromosom[$a][7] = mt_rand(201,230); // d2
      // $initKromosom[$a][8] = mt_rand(231,300); // d3
      $initKromosom[$a][6] = mt_rand(20,34); // e1
      $initKromosom[$a][7] = mt_rand(35,54); // e2
      $initKromosom[$a][8] = mt_rand(55,59); // e3
      $initKromosom[$a][9] = mt_rand(60,70); // e4
    }

      //inisialisasi variabel
      $kromosom = [[]];
  		$kromosomSorted = [[]];
  		$offSpringC = [[]];
  		$offSpringM = [[]];

      // LOOPING GENERASI START
      for ($b=0; $b < $generasi; $b++) {

        //cek perputaran generasi
        if($b < 1) {
  				for ($ia=0; $ia < $popSize ; $ia++) {
  					for ($ja=0; $ja < count(current($initKromosom)); $ja++) {
  						$kromosom[$ia][$ja] = $initKromosom[$ia][$ja];
  					}
  				}
  			} elseif($b > 0) {
  				for ($ib=0; $ib < $popSize ; $ib++) {
  					for ($jb=0; $jb < count(current($initKromosom)); $jb++) {
  						$kromosom[$ib][$jb] = $kromosomBaru[$ib][$jb];
  					}
  				}
  			}

        // random number dan di shuffle
        for ($wk=0; $wk < $popSize; $wk++) {
  				$randNumber[] = $wk;
  			}
  			shuffle($randNumber);
  			for ($id=0; $id < 2 ; $id++) {
  				$choosedParentC[$id] = $randNumber[$id];
  			}

        //random gen index terpilih crossover
        $choosedGenIndex = mt_rand(0,9);

        // inisialisasi variabel untuk crossover
        $offSpringCTemp = [[]];
        $offSpringCTemp = $kromosom;

        //proses crossover
        $indexHelper = 0;
        for ($ie=$choosedGenIndex; $ie < count(current($kromosom)); $ie++) {
          $tempHelper = $offSpringCTemp[$choosedParentC[0]][$ie];
          $offSpringCTemp[$choosedParentC[0]][$ie] = $offSpringCTemp[$choosedParentC[1]][$ie];
          $offSpringCTemp[$choosedParentC[1]][$ie] = $tempHelper;
        }
        for ($ifa=0; $ifa < count(current($offSpringCTemp)); $ifa++) {
          $offSpringC[0][$ifa] = $offSpringCTemp[$choosedParentC[0]][$ifa];
          $offSpringC[1][$ifa] = $offSpringCTemp[$choosedParentC[1]][$ifa];
        }

        //random parent terpilih mutasi
        $choosedParentM = mt_rand(0,count($popSize)-1);
        for ($fb=0; $fb < count(current($kromosom)); $fb++) {
  				$randNumberGenMutation[] = $fb;
  			}
        shuffle($randNumberGenMutation);
        for ($ig=0; $ig < 2; $ig++) {
          $choosedGenIndexMutation[$ig] = $randNumberGenMutation[$ig];
        }

        //inisialisas variabel untuk mutasi
        $offSpringMTemp = [[]];
        $offSpringMTemp = $kromosom;

        // proses mutasi
        $tempHelper2 = $offSpringMTemp[$choosedParentM][$choosedGenIndexMutation[0]];
        $offSpringMTemp[$choosedParentM][$choosedGenIndexMutation[0]] = $offSpringMTemp[$choosedParentM][$choosedGenIndexMutation[1]];
        $offSpringMTemp[$choosedParentM][$choosedGenIndexMutation[1]] = $tempHelper2;
        for ($ih=0; $ih < count(current($offSpringMTemp)); $ih++) {
          $offSpringM[0][$ih] = $offSpringMTemp[$choosedParentM][$ih];
        }

        // validasi hasil mutasi
        for ($ih=0; $ih < count(current($offSpringMTemp)); $ih++) {
          if ($ih % 2 != 0 && $ih < 6) {
            if($offSpringM[0][$ih] < $offSpringM[0][$ih-1]) {
              for ($iha=0; $iha < count(current($offSpringMTemp)); $iha++) {
                $offSpringM[0][$ih] = $kromosom[$choosedParentM][$ih];
              }
            }
          } elseif($ih % 2 == 0 && $ih < 6) {
            if($offSpringM[0][$ih] > $offSpringM[0][$ih+1]) {
              for ($ihb=0; $ihb < count(current($offSpringMTemp)); $ihb++) {
                $offSpringM[0][$ih] = $kromosom[$choosedParentM][$ih];
              }
            }
          } elseif($ih % 2 != 0 && $ih > 5) {
            if($ih != 9) {
              if($offSpringM[0][$ih] < $offSpringM[0][$ih-1]) {
                for ($iha=0; $iha < count(current($offSpringMTemp)); $iha++) {
                  $offSpringM[0][$ih] = $kromosom[$choosedParentM][$ih];
                }
              } elseif($offSpringM[0][$ih] > $offSpringM[0][$ih+1]) {
                for ($iha=0; $iha < count(current($offSpringMTemp)); $iha++) {
                  $offSpringM[0][$ih] = $kromosom[$choosedParentM][$ih];
                }
              }
            } elseif($ih == 9) {
              if($offSpringM[0][$ih] < $offSpringM[0][$ih-1]) {
                for ($iha=0; $iha < count(current($offSpringMTemp)); $iha++) {
                  $offSpringM[0][$ih] = $kromosom[$choosedParentM][$ih];
                }
              }
            }
          } elseif($ih % 2 == 0 && $ih > 5) {
            if($offSpringM[0][$ih] > $offSpringM[0][$ih+1]) {
              for ($ihb=0; $ihb < count(current($offSpringMTemp)); $ihb++) {
                $offSpringM[0][$ih] = $kromosom[$choosedParentM][$ih];
              }
            } elseif($offSpringM[0][$ih] > $offSpringM[0][$ih+1]) {
              for ($iha=0; $iha < count(current($offSpringMTemp)); $iha++) {
                $offSpringM[0][$ih] = $kromosom[$choosedParentM][$ih];
              }
            }
          }
        }

        //masukin ke kromosom baru dari kromosom + crossover + mutasi
        $kromosomBaruLength = count($kromosom)+count($offSpringC)+count($offSpringM);

        $d = 0;
  			$e = 0;

  			$kromosomBaru = [[]];
  			for($ih=0;$ih<$kromosomBaruLength;$ih++) {
  				if($ih >= count($kromosom) && $ih < (count($kromosom) + count($offSpringC)) ) {
            for ($iha=0; $iha < count(current($kromosom)) ; $iha++) {
              $kromosomBaru[$ih][$iha] = $offSpringC[$d][$iha];
            }
						$d++;
  				} elseif($ih > count($kromosom) &&  $ih >= (count($kromosom) + count($offSpringC)) ) {
            for ($ihb=0; $ihb < count(current($kromosom)); $ihb++) {
              $kromosomBaru[$ih][$ihb] = $offSpringC[$e][$ihb];
            }
  					$e++;
  				} elseif($ih < count($kromosom)) {
            for ($ihc=0; $ihc < count(current($kromosom)); $ihc++) {
              $kromosomBaru[$ih][$ihc] = $kromosom[$ih][$ihc];
            }
  				}
        }

        //MEMBERSHIP DEGREE RULE
        for ($j=0; $j < count($data_training) ; $j++) {

          for ($ja=0; $ja < count($kromosomBaru); $ja++) {

            for ($i=0; $i < count($rule); $i++) {
              if(strcmp($rule[$i][0], 'muda')) {
                if($data_training[$j][0] < $kromosomBaru[$ja][0]) {
                  $membershipDegree[$i][0] = 1;
                } elseif ( ($kromosomBaru[$ja][0] < $data_training[$j][0]) && ($data_training[$j][0] < $kromosomBaru[$ja][1]) ) {
                  $membershipDegree[$i][0] = ($kromosomBaru[$ja][1] - $data_training[$j][0]) / ($kromosomBaru[$ja][1] - $kromosomBaru[$ja][0]);
                } else {
                  $membershipDegree[$i][0] = 0;
                }
              } elseif(strcmp($rule[$i][0], 'tua')) {
                //rumus membership degree tua
              } else {
                $membershipDegree[$i][0] = 9999;
              }

            if(strcmp($rule[$i][2], 'lk')) {
              if($data_training[$j][1] < $kromosomBaru[$ja][2]) {
                $membershipDegree[$i][1] = 1;
              } elseif ( ($kromosomBaru[$ja][2] < $data_training[$j][1]) && ($data_training[$j][1] < $kromosomBaru[$ja][3]) ) {
                $membershipDegree[$i][2] = ($kromosomBaru[$ja][3] - $data_training[$j][1]) / ($kromosomBaru[$ja][3] - $kromosomBaru[$ja][2]);
              } else {
                $membershipDegree[$i][2] = 0;
              }
            } elseif(strcmp($rule[$i][2], 'pr')) {
              //rumus membership degree pr
            } else {
              $membershipDegree[$i][2] = 9999;
            }

            if(strcmp($rule[$i][2], 'lk')) {
              if($data_training[$j][1] ) {
                $membershipDegree[$i][1] = 1;
              }  else {
                $membershipDegree[$i][1] = 9999;
              }
            } elseif(strcmp($rule[$i][2], 'pr')) {
              //rumus membership degree pr
            } else {
              $membershipDegree[$i][2] = 9999;
            }



      }





  }







  public function proses_klasifikasi()
  {
    // get data training
    $data['data_training'] = $this->data_model->get_all_data_training();
    $data['initial_threshold'] = $this->initialthreshold_model->get_all_initial_threshold();

    $indexHelper = 0;
    foreach ($data['data_training'] as $row) {
      $data_training[$indexHelper][0] = $row->umur;
      $data_training[$indexHelper][1] = $row->sex;
      $data_training[$indexHelper][2] = $row->td_sistol;
      $data_training[$indexHelper][3] = $row->td_diastol;
      $data_training[$indexHelper][4] = $row->sum_td;
      $data_training[$indexHelper][5] = $row->lingkar_perut;
      $data_training[$indexHelper][6] = $row->tinggi_badan;
      $data_training[$indexHelper][7] = $row->berat_badan;
      $data_training[$indexHelper][8] = $row->bmi;
      $data_training[$indexHelper][9] = $row->merokok;
      $data_training[$indexHelper][10] = $row->makanan_berlemak;
      $data_training[$indexHelper][11] = $row->k_gula;
      $data_training[$indexHelper][12] = $row->k_garam;
      $data_training[$indexHelper][13] = $row->olahraga;
      $data_training[$indexHelper][14] = $row->k_kafein;
      $data_training[$indexHelper][15] = $row->risiko_hipertensi;
      $indexHelper++;
    }

    $a = 0;
    foreach ($data['initial_threshold'] as $row) {
      $initThreshold[$a][0] = $row->minimumvalue;
      $initThreshold[$a][1] = $row->maximumvalue;
      $initThreshold[$a][3] = $row->category;
      $initThreshold[$a][4] = $row->description;
      $initThreshold[$a][3] = $row->categoryorder;
      $initThreshold[$a][3] = $row->descriptionorder;
      $a++;
    }

    // MENCARI MEMBERSHIP DEGREE
    for ($b=0; $b < count($data_training) ; $b++) {

      // UMUR
      //membership degree muda
      if($data_training[$b][0] <= $initThreshold[0][1]) {
        $membershipDegree[$b][0] = 1;
      } elseif ( ($data_training[$b][0] > $initThreshold[0][1]) && ($data_training[$b][0] < $initThreshold[1][1]) ) {
        $membershipDegree[$b][0] = ($initThreshold[1][1] - $data_training[$b][0]) / ($initThreshold[1][1] - $initThreshold[0][1]);
      } else {
        $membershipDegree[$b][0] = 0;
      }

      // membership degree tua
      if($data_training[$b][0] <= $initThreshold[0][1]) {
        $membershipDegree[$b][1] = 0;
      } elseif ( ($data_training[$b][0] > $initThreshold[0][1]) && ($data_training[$b][0] < $initThreshold[1][1]) ) {
        $membershipDegree[$b][1] = ($data_training[$b][0] - $initThreshold[0][1]) / ($initThreshold[1][1] - $initThreshold[0][1]);
      } else {
        $membershipDegree[$b][1] = 1;
      }

      // TEKANAN DARAH
      // membership degree normal
      if($data_training[$b][4] <= $initThreshold[2][1]) {
        $membershipDegree[$b][2] = 1;
      } elseif ( ($data_training[$b][4] > $initThreshold[2][1]) && ($data_training[$b][4] < $initThreshold[3][1]) ) {
        $membershipDegree[$b][2] = ($initThreshold[3][1] - $data_training[$b][4]) / ($initThreshold[3][1] - $initThreshold[2][1]);
      } else {
        $membershipDegree[$b][2] = 0;
      }

      // membership degree pra hipertensi
      if( ($data_training[$b][4] > $initThreshold[2][1]) && ($data_training[$b][4] < $initThreshold[3][1]) ) {
        $membershipDegree[$b][3] = ($data_training[$b][4] - $initThreshold[2][1]) / ($initThreshold[3][1] - $initThreshold[2][1]);
      } elseif ( ($initThreshold[2][1] <= $data_training[$b][4]) && ($data_training[$b][4] < $initThreshold[4][1]) ) {
        $membershipDegree[$b][3] = ($initThreshold[4][1] - $data_training[$b][4]) / ($initThreshold[4][1] - $initThreshold[3][1]);
      } elseif ( ($data_training[$b][4] <= $initThreshold[2][1]) || ($data_training[$b][4] >= $initThreshold[4][1]) )   {
        $membershipDegree[$b][3] = 0;
      }

      // membership degree hipertensi
      if($data_training[$b][4] <= $initThreshold[3][1]) {
        $membershipDegree[$b][4] = 0;
      } elseif ( ($initThreshold[3][1] < $data_training[$b][4] ) && ($data_training[$b][4] < $initThreshold[4][1]) ) {
        $membershipDegree[$b][4] = ($data_training[$b][4] - $initThreshold[3][1]) / ($initThreshold[4][1] - $initThreshold[3][1]);
      } else {
        $membershipDegree[$b][4] = 1;
      }

      // LINGKAR PERUT
      //membership degree normal
      if($data_training[$b][5] <= $initThreshold[5][1]) {
        $membershipDegree[$b][5] = 1;
      } elseif ( ($data_training[$b][5] > $initThreshold[5][1]) && ($data_training[$b][5] < $initThreshold[6][1]) ) {
        $membershipDegree[$b][5] = ($initThreshold[6][1] - $data_training[$b][5]) / ($initThreshold[6][1] - $initThreshold[5][1]);
      } else {
        $membershipDegree[$b][5] = 0;
      }

      // membership degree obesitas
      if($data_training[$b][5] <= $initThreshold[5][1]) {
        $membershipDegree[$b][6] = 0;
      } elseif ( ($data_training[$b][5] > $initThreshold[5][1]) && ($data_training[$b][5] < $initThreshold[6][1]) ) {
        $membershipDegree[$b][6] = ($data_training[$b][5] - $initThreshold[5][1]) / ($initThreshold[6][1] - $initThreshold[5][1]);
      } else {
        $membershipDegree[$b][6] = 1;
      }

      // BMI
      //membership degree normal
      if($data_training[$b][8] <= $initThreshold[7][1]) {
        $membershipDegree[$b][7] = 1;
      } elseif ( ($data_training[$b][8] > $initThreshold[7][1]) && ($data_training[$b][8] < $initThreshold[8][1]) ) {
        $membershipDegree[$b][7] = ($initThreshold[8][1] - $data_training[$b][8]) / ($initThreshold[8][1] - $initThreshold[7][1]);
      } else {
        $membershipDegree[$b][7] = 0;
      }

      // membership degree obesitas
      if($data_training[$b][8] <= $initThreshold[7][1]) {
        $membershipDegree[$b][8] = 0;
      } elseif ( ($data_training[$b][8] > $initThreshold[7][1]) && ($data_training[$b][8] < $initThreshold[8][1]) ) {
        $membershipDegree[$b][8] = ($data_training[$b][8] - $initThreshold[7][1]) / ($initThreshold[8][1] - $initThreshold[7][1]);
      } else {
        $membershipDegree[$b][8] = 1;
      }

      //MEROKOK
      //membership degree merokok(1 = ya, 0 = tidak)
      if($data_training[$b][9] == $initThreshold[9][1]) {
        $membershipDegree[$b][9] = 1;
        $membershipDegree[$b][10] = 0;
      } elseif ($data_training[$b][9] == $initThreshold[9][0]) {
        $membershipDegree[$b][9] = 0;
        $membershipDegree[$b][10] = 1;
      }

      //MAKANAN BERLEMAK
      //jarang dan sering
      if($data_training[$b][10] == $initThreshold[10][1]) {
        $membershipDegree[$b][11] = 0;
        $membershipDegree[$b][12] = 1;
      } elseif ($data_training[$b][10] == $initThreshold[10][0]) {
        $membershipDegree[$b][11] = 1;
        $membershipDegree[$b][12] = 0;
      }

      //KONSUMSI GULA
      //<= 4 dan > 4
      if($data_training[$b][11] == $initThreshold[11][1]) {
        $membershipDegree[$b][13] = 0;
        $membershipDegree[$b][14] = 1;
      } elseif ($data_training[$b][11] == $initThreshold[11][0]) {
        $membershipDegree[$b][13] = 1;
        $membershipDegree[$b][14] = 0;
      }

      //KONSUMSI GARAM
      //<= 1 dan > 1
      if($data_training[$b][12] == $initThreshold[12][1]) {
        $membershipDegree[$b][15] = 0;
        $membershipDegree[$b][16] = 1;
      } elseif ($data_training[$b][12] == $initThreshold[12][0]) {
        $membershipDegree[$b][15] = 1;
        $membershipDegree[$b][16] = 0;
      }

      //OLAHRGAGA
      //Ya dan tidak
      if($data_training[$b][13] == $initThreshold[13][1]) {
        $membershipDegree[$b][17] = 1;
        $membershipDegree[$b][18] = 0;
      } elseif ($data_training[$b][13] == $initThreshold[13][0]) {
        $membershipDegree[$b][17] = 0;
        $membershipDegree[$b][18] = 1;
      }

      // KAFEIN
      //membership degree konsumsi kafein(1 = tidak, 2 = <=3sdt, 3 = >3sdt)
      if($data_training[$b][14] == 1) {
        $membershipDegree[$b][19] = 1;
        $membershipDegree[$b][20] = 0;
        $membershipDegree[$b][21] = 0;
      } elseif ($data_training[$b][14] == 2) {
        $membershipDegree[$b][19] = 0;
        $membershipDegree[$b][20] = 1;
        $membershipDegree[$b][21] = 0;
      } elseif ($data_training[$b][14] == 3) {
        $membershipDegree[$b][19] = 0;
        $membershipDegree[$b][20] = 0;
        $membershipDegree[$b][21] = 1;
      }

    }

    /**
     * SEHARUSNYA DISINI SUDAH MULAI LOOPING
     */
    //NGITUNG SUM
    $sumMembershipDegree = [];

    for ($caa=0; $caa < count(current($membershipDegree)); $caa++) {
      $sumMembershipDegree[$caa] = 0;
    }

    for ($c=0; $c < count(current($membershipDegree)) ; $c++) {
      for ($ca=0; $ca < count($membershipDegree) ; $ca++) {
        $sumMembershipDegree[$c] += $membershipDegree[$ca][$c];
      }
    }

    //NGITUNG SUM MEMBERSHIP DEGREE PER KELAS (Rendah Sedang Tinggi) = specificSumMembershipDegree
    $specificSumMembershipDegree = [];
    for ($d=0; $d < 3 ; $d++) {
      for ($da=0; $da < count(current($membershipDegree)); $da++) {
        $specificSumMembershipDegree[$d][$da] = 0;
      }
    }

    for ($e=0; $e < count(current($membershipDegree)); $e++) {
      for ($ea=0; $ea < count($data_training); $ea++) {
        if ($data_training[$ea][15] == 1) {
          $specificSumMembershipDegree[0][$e] += $membershipDegree[$ea][$e];
        } elseif ($data_training[$ea][15] == 2) {
          $specificSumMembershipDegree[1][$e] += $membershipDegree[$ea][$e];
        } elseif ($data_training[$ea][15] == 3) {
          $specificSumMembershipDegree[2][$e] += $membershipDegree[$ea][$e];
        }
      }
    }

    $FCT = 70/100;
    $LDT = 10/100;

    //CARI ENTROPY TOTAL
    $jmlKelas1 = $jmlKelas2 = $jmlKelas3 = 0;
    for ($j=0; $j < count($data_training); $j++) {
      if ($data_training[$j][15] == 1) {
        $jmlKelas1++;
      } elseif ($data_training[$j][15] == 2) {
        $jmlKelas2++;
      } elseif ($data_training[$j][15] == 3) {
        $jmlKelas3++;
      }
    }

    $log[0] = $jmlKelas1 / count($data_training);
    $log[1] = $jmlKelas2 / count($data_training);
    $log[2] = $jmlKelas3 / count($data_training);

    $allEntropy = -(($jmlKelas1 / count($data_training)) * (log($log[0], 2))) -
                (($jmlKelas2 / count($data_training)) * (log($log[1], 2))) -
                (($jmlKelas3 / count($data_training)) * (log($log[2], 2)));

    // MENCARI ENTROPY MASING-MASING MEMBERSHIP DEGREE (22 entropy)
    $entropy = [];
    $tempLog = 0;
    for ($f=0; $f < count(current($specificSumMembershipDegree)); $f++) {
      $x = 0;
      for ($fa=0; $fa < count($specificSumMembershipDegree); $fa++) {

        ($specificSumMembershipDegree[$fa][$f]/$sumMembershipDegree[$f]) == 0 ? $tempLog = 0 : $tempLog = log(($specificSumMembershipDegree[$fa][$f]/$sumMembershipDegree[$f]),2);

        $x += -(($specificSumMembershipDegree[$fa][$f]/$sumMembershipDegree[$f])*$tempLog);
      }
      $entropy[$f] = $x;
    }

    /**
     * NOTE:
     * Entropy atribut dengan 3 batasan ada pada T.Darah, dan KAFEIN
     * T.Darah indeks ke 2-3-4, Kafein pada indeks ke 19-20-21
     * IG T. Darah = 1, IG Kafein = 9
     */
    //initialize information gain
    for ($g=0; $g < 10 ; $g++) {
      $informationGain[$g] = 0;
    }
    //set ig tekanan darah
    for ($g=2; $g < 5 ; $g++) {
      $informationGain[1] -= (($sumMembershipDegree[$g]/count($data_training))*$entropy[$g]);
    }
    //set ig kafein
    for ($g=19; $g < 22 ; $g++) {
      $informationGain[9] -= (($sumMembershipDegree[$g]/count($data_training))*$entropy[$g]);
    }
    //set other ig
    $helper = 0;
    for ($g=0; $g < 10 ; $g++) {
      if ($informationGain[$g]==0) {
        for ($ga=0; $ga < 2; $ga++) {
          $informationGain[$g] -= (($sumMembershipDegree[$helper]/count($data_training))*$entropy[$helper]);
          $helper++;
        }
      } else {
        $helper +=3;
      }
    }
    for ($g=0; $g < 10 ; $g++) {
      $informationGain[$g] += $allEntropy;
    }

    //cari information gain terbesar + indeks nya
    $maxIg =  max($informationGain);
    $maxIgIndexTemp = array_keys($informationGain, max($informationGain));
    $maxIgIndex = $maxIgIndexTemp[0];

    if ($maxIgIndex==1 || $maxIgIndex==9) {
      $maxLoopRoot = 3;
    } else {
      $maxLoopRoot = 2;
    }

    for ($h=0; $h < $maxLoopRoot; $h++) {
      # code...
    }

    // $node = $this->buatNode($maxIgIndex);
    // $this->buatChild($node, 5);
    $node = new Node();
    $node->setValue([
      'attribute' => $attribute,
      'is_stop' => 0,
    ]);
    $cok = new Node('child');
    $node->addChild($cok);

    // $pikachu = 5*log(0/24.3,2);

    echo '<pre>' . var_export($membershipDegree, true) . '</pre>';
    echo '<pre>' . var_export($sumMembershipDegree, true) . '</pre>';
    echo '<pre>' . var_export($specificSumMembershipDegree, true) . '</pre>';
    echo '<pre>' . var_export($allEntropy, true) . '</pre>';
    echo '<pre>' . var_export($entropy, true) . '</pre>';
    echo '<pre>' . var_export($informationGain, true) . '</pre>';
    echo '<pre>' . var_export($maxIg, true) . '</pre>';
    echo '<pre>' . var_export($maxIgIndex, true) . '</pre>';
    echo '<pre>' . var_export($cok->getParent(), true) . '</pre>';

    // $root = (new Node('root'))
    // ->addChild($child1 = new Node('child1'))
    // ->addChild($child2 = new Node('child2'))
    // ->addChild($child3 = new Node('child3'));



    // $this->load->view('user/classification_result', array('data_training' => $data_training,
    //                                                       'sum' => $sum));
  }

  public function buatNode($attribute)
  {
    $node = new Node();
    $node->setValue([
      'attribute' => $attribute,
      'is_stop' => 0,
    ]);
    return $node;
  }

  public function buatChild($node, $attribute)
  {
    $node->addChild($this->buatNode($attribute));
    return $node;
  }
}
?>

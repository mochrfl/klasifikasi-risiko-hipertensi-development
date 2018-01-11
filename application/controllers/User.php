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

    // $pikachu = 5*log(0/24.3,2);

    echo '<pre>' . var_export($membershipDegree, true) . '</pre>';
    echo '<pre>' . var_export($sumMembershipDegree, true) . '</pre>';
    echo '<pre>' . var_export($specificSumMembershipDegree, true) . '</pre>';
    echo '<pre>' . var_export($allEntropy, true) . '</pre>';
    echo '<pre>' . var_export($entropy, true) . '</pre>';
    echo '<pre>' . var_export($informationGain, true) . '</pre>';
    // echo '<pre>' . var_export($pikachu, true) . '</pre>';

    // $root = (new Node('root'))
    // ->addChild($child1 = new Node('child1'))
    // ->addChild($child2 = new Node('child2'))
    // ->addChild($child3 = new Node('child3'));



    // $this->load->view('user/classification_result', array('data_training' => $data_training,
    //                                                       'sum' => $sum));

      // //entropy masing masing atribut
      // $total = [];
      // for ($jc=0; $jc < count($certainSumMembershipDegree[0]); $jc++) {
      //     $x = 0;
      //     for ($jca=0; $jca < count($certainSumMembershipDegree); $jca++) {
      //         $x += -(($certainSumMembershipDegree[$jca][$jc]/$sumMembershipDegree[$jc])*log(($certainSumMembershipDegree[$jca][$jc]/$sumMembershipDegree[$jc]),2));
      //     }
      //     $total[$jc] =$x;
      //     // echo "Total atribut " + $total[$i];
      // }
      //
      // for ($je=0; $je < count($total) ; $je++) {
      //   if(is_nan($total[$je])) {
      //     $total[$je] = 0;
      //   }
      // }
      //
      //
      // if($loop == 0) {
      //   $root = 99999;
      //   $childNode = 99999;
      // }
      //
      // $informationGain = array_fill(0, 12, null);
      //
      // if($root != $informationGain[0] || $childNode != $informationGain[0] || $loop == 0) {
      //   $informationGain[0] = $entropyS - (($sumMembershipDegree[0] / count($data_training)) * $total[0]) - (($sumMembershipDegree[1] / count($data_training)) * $total[1]) ;
      // } if ($root != $informationGain[1] || $childNode != $informationGain[1] || $loop == 0) {
      //   $informationGain[1] = $entropyS - (($sumMembershipDegree[2] / count($data_training)) * $total[2]) - (($sumMembershipDegree[3] / count($data_training)) * $total[3]) ;
      // } if ($root != $informationGain[2] || $childNode != $informationGain[2] || $loop == 0) {
      //   $informationGain[2] = $entropyS - (($sumMembershipDegree[4] / count($data_training)) * $total[4]) - (($sumMembershipDegree[5] / count($data_training)) * $total[5]) - (($sumMembershipDegree[6] / count($data_training)) * $total[6]) ;
      // } if ($root != $informationGain[3] || $childNode != $informationGain[3] || $loop == 0) {
      //   $informationGain[3] = $entropyS - (($sumMembershipDegree[7] / count($data_training)) * $total[7]) - (($sumMembershipDegree[8] / count($data_training)) * $total[8]) - (($sumMembershipDegree[9] / count($data_training)) * $total[9]) ;
      // } if ($root != $informationGain[4] || $childNode != $informationGain[4] || $loop == 0) {
      //   $informationGain[4] = $entropyS - (($sumMembershipDegree[10] / count($data_training)) * $total[10]) - (($sumMembershipDegree[11] / count($data_training)) * $total[11]) ;
      // } if ($root != $informationGain[5] || $childNode != $informationGain[5] || $loop == 0) {
      //   $informationGain[5] = $entropyS - (($sumMembershipDegree[12] / count($data_training)) * $total[12]) - (($sumMembershipDegree[13] / count($data_training)) * $total[13]) ;
      // } if ($root != $informationGain[6] || $childNode != $informationGain[6] || $loop == 0) {
      //   $informationGain[6] = $entropyS - (($sumMembershipDegree[14] / count($data_training)) * $total[14]) - (($sumMembershipDegree[15] / count($data_training)) * $total[15]) ;
      // } if ($root != $informationGain[7] || $childNode != $informationGain[7] || $loop == 0) {
      //   $informationGain[7] = $entropyS - (($sumMembershipDegree[16] / count($data_training)) * $total[16]) - (($sumMembershipDegree[17] / count($data_training)) * $total[17]) ;
      // } if ($root != $informationGain[8] || $childNode != $informationGain[8] || $loop == 0) {
      //   $informationGain[8] = $entropyS - (($sumMembershipDegree[18] / count($data_training)) * $total[18]) - (($sumMembershipDegree[19] / count($data_training)) * $total[19]) ;
      // } if ($root != $informationGain[9] || $childNode != $informationGain[9] || $loop == 0) {
      //   $informationGain[9] = $entropyS - (($sumMembershipDegree[20] / count($data_training)) * $total[20]) - (($sumMembershipDegree[21] / count($data_training)) * $total[21]) ;
      // } if ($root != $informationGain[10] || $childNode != $informationGain[10] || $loop == 0) {
      //   $informationGain[10] = $entropyS - (($sumMembershipDegree[22] / count($data_training)) * $total[22]) - (($sumMembershipDegree[23] / count($data_training)) * $total[23]) ;
      // } if ($root != $informationGain[11] || $childNode != $informationGain[11] || $loop == 0) {
      //   $informationGain[11] = $entropyS - (($sumMembershipDegree[24] / count($data_training)) * $total[24]) - (($sumMembershipDegree[25] / count($data_training)) * $total[25]) - (($sumMembershipDegree[26] / count($data_training)) * $total[26]) ;
      // }
      //
      // for ($i = 0; $i < count($informationGain) ; $i++) {
      //   $index[$i] = $i;
      // }
      //
      // for ($i = 0; $i < count($informationGain) ; $i++) {
      //   for ($j = 1; $j < (count($informationGain) - $i); $j++) {
      //     if($informationGain[$j-1] < $informationGain[$j]){
      //       $temp = $informationGain[$j-1];
      //       $informationGain[$j-1] = $informationGain[$j];
      //       $informationGain[$j] = $temp;
      //
      //       $tempIndex = $index[$j-1];
      //       $index[$j-1] = $index[$j];
      //       $index[$j] = $tempIndex;
      //     }
      //   }
      // }
      //
      // // for ($i = 0; $i < count($informationGain) ; $i++) {
      // //   if ($i = 0){
      // //     $root = $informationGain[$i];
      // //   } else {
      // //     $childNode[$i] = $informationGain[$i];
      // //   }
      // // }
      //
      // // if($i == 0) {
      // //   $root = max($informationGain);
      // // } else {
      // //   $childNode[$loop] = max($informationGain);
      // // }
      //
      // $temp = 0;
      // $proporsi = array_fill(0, 3, array_fill(0, 27, 0));
      //
      // for ($jd=0; $jd < count($data_training); $jd++) {
      //   if ($data_training[$jd][12] == 0) {
      //     // 0 pertama proporsi kelas ke 0, 0 kedua atributnya
      //     $proporsi[0][0] = $proporsi[0][0] + $membershipDegree['umur']['muda'][$jd];
      //     $proporsi[0][1] = $proporsi[0][1] + $membershipDegree['umur']['tua'][$jd];
      //     $proporsi[0][2] = $proporsi[0][2] + $membershipDegree['sex']['lk'][$jd];
      //     $proporsi[0][3] = $proporsi[0][3] + $membershipDegree['sex']['pr'][$jd];
      //     $proporsi[0][4] = $proporsi[0][4] + $membershipDegree['td_sistol']['normal'][$jd];
      //     $proporsi[0][5] = $proporsi[0][5] + $membershipDegree['td_sistol']['prahipertensi'][$jd];
      //     $proporsi[0][6] = $proporsi[0][6] + $membershipDegree['td_sistol']['hipertensi'][$jd];
      //     $proporsi[0][7] = $proporsi[0][7] + $membershipDegree['td_diastol']['normal'][$jd];
      //     $proporsi[0][8] = $proporsi[0][8] + $membershipDegree['td_diastol']['prahipertensi'][$jd];
      //     $proporsi[0][9] = $proporsi[0][9] + $membershipDegree['td_diastol']['hipertensi'][$jd];
      //     $proporsi[0][10] = $proporsi[0][10] + $membershipDegree['lingkar_perut']['kecil'][$jd];
      //     $proporsi[0][11] = $proporsi[0][11] + $membershipDegree['lingkar_perut']['besar'][$jd];
      //     $proporsi[0][12] = $proporsi[0][12] + $membershipDegree['bmi']['normal'][$jd];
      //     $proporsi[0][13] = $proporsi[0][13] + $membershipDegree['bmi']['ow'][$jd];
      //     $proporsi[0][14] = $proporsi[0][14] + $membershipDegree['merokok']['ya'][$jd];
      //     $proporsi[0][15] = $proporsi[0][15] + $membershipDegree['merokok']['tdk'][$jd];
      //     $proporsi[0][16] = $proporsi[0][16] + $membershipDegree['makanan_berlemak']['sering'][$jd];
      //     $proporsi[0][17] = $proporsi[0][17] + $membershipDegree['makanan_berlemak']['jarang'][$jd];
      //     $proporsi[0][18] = $proporsi[0][18] + $membershipDegree['k_gula']['>4sdm'][$jd];
      //     $proporsi[0][19] = $proporsi[0][19] + $membershipDegree['k_gula']['<=4sdm'][$jd];
      //     $proporsi[0][20] = $proporsi[0][20] + $membershipDegree['k_garam']['>1sdt'][$jd];
      //     $proporsi[0][21] = $proporsi[0][21] + $membershipDegree['k_garam']['<=1sdt'][$jd];
      //     $proporsi[0][22] = $proporsi[0][22] + $membershipDegree['olahraga']['ya'][$jd];
      //     $proporsi[0][23] = $proporsi[0][23] + $membershipDegree['olahraga']['tdk'][$jd];
      //     $proporsi[0][24] = $proporsi[0][24] + $membershipDegree['k_kafein']['tdk'][$jd];
      //     $proporsi[0][25] = $proporsi[0][25] + $membershipDegree['k_kafein']['<=3sdt'][$jd];
      //     $proporsi[0][26] = $proporsi[0][26] + $membershipDegree['k_kafein']['>3sdt'][$jd];
      //
      //   } elseif ($data_training[$jd][12] == 1) {
      //     // 0 pertama proporsi kelas ke 0, 0 kedua atributnya
      //     $proporsi[1][0] = $proporsi[1][0] + $membershipDegree['umur']['muda'][$jd];
      //     $proporsi[1][1] = $proporsi[1][1] + $membershipDegree['umur']['tua'][$jd];
      //     $proporsi[1][2] = $proporsi[1][2] + $membershipDegree['sex']['lk'][$jd];
      //     $proporsi[1][3] = $proporsi[1][3] + $membershipDegree['sex']['pr'][$jd];
      //     $proporsi[1][4] = $proporsi[1][4] + $membershipDegree['td_sistol']['normal'][$jd];
      //     $proporsi[1][5] = $proporsi[1][5] + $membershipDegree['td_sistol']['prahipertensi'][$jd];
      //     $proporsi[1][6] = $proporsi[1][6] + $membershipDegree['td_sistol']['hipertensi'][$jd];
      //     $proporsi[1][7] = $proporsi[1][7] + $membershipDegree['td_diastol']['normal'][$jd];
      //     $proporsi[1][8] = $proporsi[1][8] + $membershipDegree['td_diastol']['prahipertensi'][$jd];
      //     $proporsi[1][9] = $proporsi[1][9] + $membershipDegree['td_diastol']['hipertensi'][$jd];
      //     $proporsi[1][10] = $proporsi[1][10] + $membershipDegree['lingkar_perut']['kecil'][$jd];
      //     $proporsi[1][11] = $proporsi[1][11] + $membershipDegree['lingkar_perut']['besar'][$jd];
      //     $proporsi[1][12] = $proporsi[1][12] + $membershipDegree['bmi']['normal'][$jd];
      //     $proporsi[1][13] = $proporsi[1][13] + $membershipDegree['bmi']['ow'][$jd];
      //     $proporsi[1][14] = $proporsi[1][14] + $membershipDegree['merokok']['ya'][$jd];
      //     $proporsi[1][15] = $proporsi[1][15] + $membershipDegree['merokok']['tdk'][$jd];
      //     $proporsi[1][16] = $proporsi[1][16] + $membershipDegree['makanan_berlemak']['sering'][$jd];
      //     $proporsi[1][17] = $proporsi[1][17] + $membershipDegree['makanan_berlemak']['jarang'][$jd];
      //     $proporsi[1][18] = $proporsi[1][18] + $membershipDegree['k_gula']['>4sdm'][$jd];
      //     $proporsi[1][19] = $proporsi[1][19] + $membershipDegree['k_gula']['<=4sdm'][$jd];
      //     $proporsi[1][20] = $proporsi[1][20] + $membershipDegree['k_garam']['>1sdt'][$jd];
      //     $proporsi[1][21] = $proporsi[1][21] + $membershipDegree['k_garam']['<=1sdt'][$jd];
      //     $proporsi[1][22] = $proporsi[1][22] + $membershipDegree['olahraga']['ya'][$jd];
      //     $proporsi[1][23] = $proporsi[1][23] + $membershipDegree['olahraga']['tdk'][$jd];
      //     $proporsi[1][24] = $proporsi[1][24] + $membershipDegree['k_kafein']['tdk'][$jd];
      //     $proporsi[1][25] = $proporsi[1][25] + $membershipDegree['k_kafein']['<=3sdt'][$jd];
      //     $proporsi[1][26] = $proporsi[1][26] + $membershipDegree['k_kafein']['>3sdt'][$jd];
      //   } elseif ($data_training[$jd][12] == 2) {
      //     // 0 pertama proporsi kelas ke 0, 0 kedua atributnya
      //     $proporsi[2][0] = $proporsi[2][0] + $membershipDegree['umur']['muda'][$jd];
      //     $proporsi[2][1] = $proporsi[2][1] + $membershipDegree['umur']['tua'][$jd];
      //     $proporsi[2][2] = $proporsi[2][2] + $membershipDegree['sex']['lk'][$jd];
      //     $proporsi[2][3] = $proporsi[2][3] + $membershipDegree['sex']['pr'][$jd];
      //     $proporsi[2][4] = $proporsi[2][4] + $membershipDegree['td_sistol']['normal'][$jd];
      //     $proporsi[2][5] = $proporsi[2][5] + $membershipDegree['td_sistol']['prahipertensi'][$jd];
      //     $proporsi[2][6] = $proporsi[2][6] + $membershipDegree['td_sistol']['hipertensi'][$jd];
      //     $proporsi[2][7] = $proporsi[2][7] + $membershipDegree['td_diastol']['normal'][$jd];
      //     $proporsi[2][8] = $proporsi[2][8] + $membershipDegree['td_diastol']['prahipertensi'][$jd];
      //     $proporsi[2][9] = $proporsi[2][9] + $membershipDegree['td_diastol']['hipertensi'][$jd];
      //     $proporsi[2][10] = $proporsi[2][10] + $membershipDegree['lingkar_perut']['kecil'][$jd];
      //     $proporsi[2][11] = $proporsi[2][11] + $membershipDegree['lingkar_perut']['besar'][$jd];
      //     $proporsi[2][12] = $proporsi[2][12] + $membershipDegree['bmi']['normal'][$jd];
      //     $proporsi[2][13] = $proporsi[2][13] + $membershipDegree['bmi']['ow'][$jd];
      //     $proporsi[2][14] = $proporsi[2][14] + $membershipDegree['merokok']['ya'][$jd];
      //     $proporsi[2][15] = $proporsi[2][15] + $membershipDegree['merokok']['tdk'][$jd];
      //     $proporsi[2][16] = $proporsi[2][16] + $membershipDegree['makanan_berlemak']['sering'][$jd];
      //     $proporsi[2][17] = $proporsi[2][17] + $membershipDegree['makanan_berlemak']['jarang'][$jd];
      //     $proporsi[2][18] = $proporsi[2][18] + $membershipDegree['k_gula']['>4sdm'][$jd];
      //     $proporsi[2][19] = $proporsi[2][19] + $membershipDegree['k_gula']['<=4sdm'][$jd];
      //     $proporsi[2][20] = $proporsi[2][20] + $membershipDegree['k_garam']['>1sdt'][$jd];
      //     $proporsi[2][21] = $proporsi[2][21] + $membershipDegree['k_garam']['<=1sdt'][$jd];
      //     $proporsi[2][22] = $proporsi[2][22] + $membershipDegree['olahraga']['ya'][$jd];
      //     $proporsi[2][23] = $proporsi[2][23] + $membershipDegree['olahraga']['tdk'][$jd];
      //     $proporsi[2][24] = $proporsi[2][24] + $membershipDegree['k_kafein']['tdk'][$jd];
      //     $proporsi[2][25] = $proporsi[2][25] + $membershipDegree['k_kafein']['<=3sdt'][$jd];
      //     $proporsi[2][26] = $proporsi[2][26] + $membershipDegree['k_kafein']['>3sdt'][$jd];
      //   }
      // }
      //
      // // for ($jf=0; $jf < count($proporsi); $jf++) {
      //   $proporsiFinal[0][0] = ($proporsi[0][0] / ($proporsi[0][0] + $proporsi[1][0] + $proporsi[2][0])) * 100;
      //   $proporsiFinal[0][1] = ($proporsi[0][1] / ($proporsi[0][1] + $proporsi[1][1] + $proporsi[2][1])) * 100;
      //   $proporsiFinal[0][2] = ($proporsi[0][2] / ($proporsi[0][2] + $proporsi[1][2] + $proporsi[2][2])) * 100;
      //   $proporsiFinal[0][3] = ($proporsi[0][3] / ($proporsi[0][3] + $proporsi[1][3] + $proporsi[2][3])) * 100;
      //   $proporsiFinal[0][4] = ($proporsi[0][4] / ($proporsi[0][4] + $proporsi[1][4] + $proporsi[2][4])) * 100;
      //   $proporsiFinal[0][5] = ($proporsi[0][5] / ($proporsi[0][5] + $proporsi[1][5] + $proporsi[2][5])) * 100;
      //   $proporsiFinal[0][6] = ($proporsi[0][6] / ($proporsi[0][6] + $proporsi[1][6] + $proporsi[2][6])) * 100;
      //   $proporsiFinal[0][7] = ($proporsi[0][7] / ($proporsi[0][7] + $proporsi[1][7] + $proporsi[2][7])) * 100;
      //   $proporsiFinal[0][8] = ($proporsi[0][8] / ($proporsi[0][8] + $proporsi[1][8] + $proporsi[2][8])) * 100;
      //   $proporsiFinal[0][9] = ($proporsi[0][9] / ($proporsi[0][9] + $proporsi[1][9] + $proporsi[2][9])) * 100;
      //   $proporsiFinal[0][10] = ($proporsi[0][10] / ($proporsi[0][10] + $proporsi[1][10] + $proporsi[2][10])) * 100;
      //   $proporsiFinal[0][11] = ($proporsi[0][11] / ($proporsi[0][11] + $proporsi[1][11] + $proporsi[2][11])) * 100;
      //   $proporsiFinal[0][12] = ($proporsi[0][12] / ($proporsi[0][12] + $proporsi[1][12] + $proporsi[2][12])) * 100;
      //   $proporsiFinal[0][13] = ($proporsi[0][13] / ($proporsi[0][13] + $proporsi[1][13] + $proporsi[2][13])) * 100;
      //   $proporsiFinal[0][14] = ($proporsi[0][14] / ($proporsi[0][14] + $proporsi[1][14] + $proporsi[2][14])) * 100;
      //   $proporsiFinal[0][15] = ($proporsi[0][15] / ($proporsi[0][15] + $proporsi[1][15] + $proporsi[2][15])) * 100;
      //   $proporsiFinal[0][16] = ($proporsi[0][16] / ($proporsi[0][16] + $proporsi[1][16] + $proporsi[2][16])) * 100;
      //   $proporsiFinal[0][17] = ($proporsi[0][17] / ($proporsi[0][17] + $proporsi[1][17] + $proporsi[2][17])) * 100;
      //   $proporsiFinal[0][18] = ($proporsi[0][18] / ($proporsi[0][18] + $proporsi[1][18] + $proporsi[2][18])) * 100;
      //   $proporsiFinal[0][19] = ($proporsi[0][19] / ($proporsi[0][19] + $proporsi[1][19] + $proporsi[2][19])) * 100;
      //   $proporsiFinal[0][20] = ($proporsi[0][20] / ($proporsi[0][20] + $proporsi[1][20] + $proporsi[2][20])) * 100;
      //   $proporsiFinal[0][21] = ($proporsi[0][21] / ($proporsi[0][21] + $proporsi[1][21] + $proporsi[2][21])) * 100;
      //   $proporsiFinal[0][22] = ($proporsi[0][22] / ($proporsi[0][22] + $proporsi[1][22] + $proporsi[2][22])) * 100;
      //   $proporsiFinal[0][23] = ($proporsi[0][23] / ($proporsi[0][23] + $proporsi[1][23] + $proporsi[2][23])) * 100;
      //   $proporsiFinal[0][24] = ($proporsi[0][24] / ($proporsi[0][24] + $proporsi[1][24] + $proporsi[2][24])) * 100;
      //   $proporsiFinal[0][25] = ($proporsi[0][25] / ($proporsi[0][25] + $proporsi[1][25] + $proporsi[2][25])) * 100;
      //   $proporsiFinal[0][26] = ($proporsi[0][26] / ($proporsi[0][26] + $proporsi[1][26] + $proporsi[2][26])) * 100;
      //
      //
      //   $proporsiFinal[1][0] = ($proporsi[1][0] / ($proporsi[0][0] + $proporsi[1][0] + $proporsi[2][0])) * 100;
      //   $proporsiFinal[1][1] = ($proporsi[1][1] / ($proporsi[0][1] + $proporsi[1][1] + $proporsi[2][1])) * 100;
      //   $proporsiFinal[1][2] = ($proporsi[1][2] / ($proporsi[0][2] + $proporsi[1][2] + $proporsi[2][2])) * 100;
      //   $proporsiFinal[1][3] = ($proporsi[1][3] / ($proporsi[0][3] + $proporsi[1][3] + $proporsi[2][3])) * 100;
      //   $proporsiFinal[1][4] = ($proporsi[1][4] / ($proporsi[0][4] + $proporsi[1][4] + $proporsi[2][4])) * 100;
      //   $proporsiFinal[1][5] = ($proporsi[1][5] / ($proporsi[0][5] + $proporsi[1][5] + $proporsi[2][5])) * 100;
      //   $proporsiFinal[1][6] = ($proporsi[1][6] / ($proporsi[0][6] + $proporsi[1][6] + $proporsi[2][6])) * 100;
      //   $proporsiFinal[1][7] = ($proporsi[1][7] / ($proporsi[0][7] + $proporsi[1][7] + $proporsi[2][7])) * 100;
      //   $proporsiFinal[1][8] = ($proporsi[1][8] / ($proporsi[0][8] + $proporsi[1][8] + $proporsi[2][8])) * 100;
      //   $proporsiFinal[1][9] = ($proporsi[1][9] / ($proporsi[0][9] + $proporsi[1][9] + $proporsi[2][9])) * 100;
      //   $proporsiFinal[1][10] = ($proporsi[1][10] / ($proporsi[0][10] + $proporsi[1][10] + $proporsi[2][10])) * 100;
      //   $proporsiFinal[1][11] = ($proporsi[1][11] / ($proporsi[0][11] + $proporsi[1][11] + $proporsi[2][11])) * 100;
      //   $proporsiFinal[1][12] = ($proporsi[1][12] / ($proporsi[0][12] + $proporsi[1][12] + $proporsi[2][12])) * 100;
      //   $proporsiFinal[1][13] = ($proporsi[1][13] / ($proporsi[0][13] + $proporsi[1][13] + $proporsi[2][13])) * 100;
      //   $proporsiFinal[1][14] = ($proporsi[1][14] / ($proporsi[0][14] + $proporsi[1][14] + $proporsi[2][14])) * 100;
      //   $proporsiFinal[1][15] = ($proporsi[1][15] / ($proporsi[0][15] + $proporsi[1][15] + $proporsi[2][15])) * 100;
      //   $proporsiFinal[1][16] = ($proporsi[1][16] / ($proporsi[0][16] + $proporsi[1][16] + $proporsi[2][16])) * 100;
      //   $proporsiFinal[1][17] = ($proporsi[1][17] / ($proporsi[0][17] + $proporsi[1][17] + $proporsi[2][17])) * 100;
      //   $proporsiFinal[1][18] = ($proporsi[1][18] / ($proporsi[0][18] + $proporsi[1][18] + $proporsi[2][18])) * 100;
      //   $proporsiFinal[1][19] = ($proporsi[1][19] / ($proporsi[0][19] + $proporsi[1][19] + $proporsi[2][19])) * 100;
      //   $proporsiFinal[1][20] = ($proporsi[1][20] / ($proporsi[0][20] + $proporsi[1][20] + $proporsi[2][20])) * 100;
      //   $proporsiFinal[1][21] = ($proporsi[1][21] / ($proporsi[0][21] + $proporsi[1][21] + $proporsi[2][21])) * 100;
      //   $proporsiFinal[1][22] = ($proporsi[1][22] / ($proporsi[0][22] + $proporsi[1][22] + $proporsi[2][22])) * 100;
      //   $proporsiFinal[1][23] = ($proporsi[1][23] / ($proporsi[0][23] + $proporsi[1][23] + $proporsi[2][23])) * 100;
      //   $proporsiFinal[1][24] = ($proporsi[1][24] / ($proporsi[0][24] + $proporsi[1][24] + $proporsi[2][24])) * 100;
      //   $proporsiFinal[1][25] = ($proporsi[1][25] / ($proporsi[0][25] + $proporsi[1][25] + $proporsi[2][25])) * 100;
      //   $proporsiFinal[1][26] = ($proporsi[1][26] / ($proporsi[0][26] + $proporsi[1][26] + $proporsi[2][26])) * 100;
      //
      //   $proporsiFinal[2][0] = ($proporsi[2][0] / ($proporsi[0][0] + $proporsi[1][0] + $proporsi[2][0])) * 100;
      //   $proporsiFinal[2][1] = ($proporsi[2][1] / ($proporsi[0][1] + $proporsi[1][1] + $proporsi[2][1])) * 100;
      //   $proporsiFinal[2][2] = ($proporsi[2][2] / ($proporsi[0][2] + $proporsi[1][2] + $proporsi[2][2])) * 100;
      //   $proporsiFinal[2][3] = ($proporsi[2][3] / ($proporsi[0][3] + $proporsi[1][3] + $proporsi[2][3])) * 100;
      //   $proporsiFinal[2][4] = ($proporsi[2][4] / ($proporsi[0][4] + $proporsi[1][4] + $proporsi[2][4])) * 100;
      //   $proporsiFinal[2][5] = ($proporsi[2][5] / ($proporsi[0][5] + $proporsi[1][5] + $proporsi[2][5])) * 100;
      //   $proporsiFinal[2][6] = ($proporsi[2][6] / ($proporsi[0][6] + $proporsi[1][6] + $proporsi[2][6])) * 100;
      //   $proporsiFinal[2][7] = ($proporsi[2][7] / ($proporsi[0][7] + $proporsi[1][7] + $proporsi[2][7])) * 100;
      //   $proporsiFinal[2][8] = ($proporsi[2][8] / ($proporsi[0][8] + $proporsi[1][8] + $proporsi[2][8])) * 100;
      //   $proporsiFinal[2][9] = ($proporsi[2][9] / ($proporsi[0][9] + $proporsi[1][9] + $proporsi[2][9])) * 100;
      //   $proporsiFinal[2][10] = ($proporsi[2][10] / ($proporsi[0][10] + $proporsi[1][10] + $proporsi[2][10])) * 100;
      //   $proporsiFinal[2][11] = ($proporsi[2][11] / ($proporsi[0][11] + $proporsi[1][11] + $proporsi[2][11])) * 100;
      //   $proporsiFinal[2][12] = ($proporsi[2][12] / ($proporsi[0][12] + $proporsi[1][12] + $proporsi[2][12])) * 100;
      //   $proporsiFinal[2][13] = ($proporsi[2][13] / ($proporsi[0][13] + $proporsi[1][13] + $proporsi[2][13])) * 100;
      //   $proporsiFinal[2][14] = ($proporsi[2][14] / ($proporsi[0][14] + $proporsi[1][14] + $proporsi[2][14])) * 100;
      //   $proporsiFinal[2][15] = ($proporsi[2][15] / ($proporsi[0][15] + $proporsi[1][15] + $proporsi[2][15])) * 100;
      //   $proporsiFinal[2][16] = ($proporsi[2][16] / ($proporsi[0][16] + $proporsi[1][16] + $proporsi[2][16])) * 100;
      //   $proporsiFinal[2][17] = ($proporsi[2][17] / ($proporsi[0][17] + $proporsi[1][17] + $proporsi[2][17])) * 100;
      //   $proporsiFinal[2][18] = ($proporsi[2][18] / ($proporsi[0][18] + $proporsi[1][18] + $proporsi[2][18])) * 100;
      //   $proporsiFinal[2][19] = ($proporsi[2][19] / ($proporsi[0][19] + $proporsi[1][19] + $proporsi[2][19])) * 100;
      //   $proporsiFinal[2][20] = ($proporsi[2][20] / ($proporsi[0][20] + $proporsi[1][20] + $proporsi[2][20])) * 100;
      //   $proporsiFinal[2][21] = ($proporsi[2][21] / ($proporsi[0][21] + $proporsi[1][21] + $proporsi[2][21])) * 100;
      //   $proporsiFinal[2][22] = ($proporsi[2][22] / ($proporsi[0][22] + $proporsi[1][22] + $proporsi[2][22])) * 100;
      //   $proporsiFinal[2][23] = ($proporsi[2][23] / ($proporsi[0][23] + $proporsi[1][23] + $proporsi[2][23])) * 100;
      //   $proporsiFinal[2][24] = ($proporsi[2][24] / ($proporsi[0][24] + $proporsi[1][24] + $proporsi[2][24])) * 100;
      //   $proporsiFinal[2][25] = ($proporsi[2][25] / ($proporsi[0][25] + $proporsi[1][25] + $proporsi[2][25])) * 100;
      //   $proporsiFinal[2][26] = ($proporsi[2][26] / ($proporsi[0][26] + $proporsi[1][26] + $proporsi[2][26])) * 100;
      // }





		}
  }

  // function createTree($list, $parent){
  //   $tree = array();
  //   foreach ($parent as $k=>$l){
  //       if(isset($list[$l['id']])){
  //           $l['children'] = createTree($list, $list[$l['id']]);
  //       }
  //       $tree[] = $l;
  //   }
  //   return $tree;
  // }
?>

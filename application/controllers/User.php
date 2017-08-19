<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
    // HARD CODE
    $generasi = 1;
    $popSize = 7;

    // get data training
    $data['data_training'] = $this->data_model->get_all_data_training();

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
  						$kromosom[$ib][$jb] = $kromosomSorted[$ib][$jb];
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


        // masuk aturan id3
        $indexHelper = 0;
        foreach ($data['data_training'] as $row) {
          $data_training[$indexHelper][0] = $row->umur;
          $data_training[$indexHelper][1] = $row->sex;
          $data_training[$indexHelper][2] = $row->td_sistol;
          $data_training[$indexHelper][3] = $row->td_diastol;
          $data_training[$indexHelper][4] = $row->lingkar_perut;
          // $data_training[$indexHelper][5] = $row->tinggi_badan;
          // $data_training[$indexHelper][6] = $row->berat_badan;
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




        // START LOOPING POP SIZE UNTUK CARI AKURASI TERBAIK

        $membershipDegree = [[]];


        for ($j=0; $j < count($kromosomBaru) ; $j++) {

          //MEMBERSHIP FUNCTION UMUR
          for ($ja=0; $ja < count($data_training); $ja++) {
            //membership degree muda
            if($data_training[$ja][0] < $kromosomBaru[$j][0]) {
              $membershipDegree['umur']['muda'][$ja] = 1;
            } elseif ( ($kromosomBaru[$j][0] < $data_training[$ja][0]) && ($data_training[$ja][0] < $kromosomBaru[$j][1]) ) {
              $membershipDegree['umur']['muda'][$ja] = ($kromosomBaru[$j][1] - $data_training[$ja][0]) / ($kromosomBaru[$j][1] - $kromosomBaru[$j][0]);
            } else {
              $membershipDegree['umur']['muda'][$ja] = 0;
            }
              //array sum md muda
              // echo array_sum($membershipDegree['umur']['muda'][$ja]);

            //membership degree tua
            if($data_training[$ja][0] <= $kromosomBaru[$j][0]) {
              $membershipDegree['umur']['tua'][$ja] = 0;
            } elseif ( ($kromosomBaru[$j][0] < $data_training[$ja][0]) && ($data_training[$ja][0] < $kromosomBaru[$j][1]) ) {
              $membershipDegree['umur']['tua'][$ja] = ($data_training[$ja][0] - $kromosomBaru[$j][0] ) / ($kromosomBaru[$j][1] - $kromosomBaru[$j][0]);
            } else {
              $membershipDegree['umur']['tua'][$ja] = 1;
            }

            //membership degree sex(1 = Laki=Laki, 0 = perempuan)
            if($data_training[$ja][1] == 1) {
              $membershipDegree['sex']['lk'][$ja] = 1;
              $membershipDegree['sex']['pr'][$ja] = 0;
            } elseif ($data_training[$ja][1] == 0) {
              $membershipDegree['sex']['lk'][$ja] = 0;
              $membershipDegree['sex']['pr'][$ja] = 1;
            }

          //membership degree t. darah sistol normal
          if($data_training[$ja][2] <= 120) {
            $membershipDegree['td_sistol']['normal'][$ja] = 1;
          } elseif ( (120 < $data_training[$ja][2]) && ($data_training[$ja][2] < 140) ) {
            $membershipDegree['td_sistol']['normal'][$ja] = (140 - $data_training[$ja][2]) / (140 - 120);
          } else {
            $membershipDegree['td_sistol']['normal'][$ja] = 0;
          }

          //membership degree t. darah sistol prahipertensi
          if( (120 < $data_training[$ja][2]) && ($data_training[$ja][2] < 140) ) {
            $membershipDegree['td_sistol']['prahipertensi'][$ja] = ($data_training[$ja][2] - 120) / (140 - 120);
          } elseif ( (140 <= $data_training[$ja][2]) && ($data_training[$ja][2] < 160) ) {
            $membershipDegree['td_sistol']['prahipertensi'][$ja] = (160 - $data_training[$ja][2]) / (160 - 140);
          } elseif( ($data_training[$ja][2] <= 120) || ($data_training[$ja][2] >= 160)) {
            $membershipDegree['td_sistol']['prahipertensi'][$ja] = 0;
          }

          //membership degree t. darah sistol hipertensi
          if($data_training[$ja][2] <= 140) {
            $membershipDegree['td_sistol']['hipertensi'][$ja] = 0;
          } elseif ( (140 < $data_training[$ja][2]) && ($data_training[$ja][2] < 160) ) {
            $membershipDegree['td_sistol']['hipertensi'][$ja] = ($data_training[$ja][2] - 140) / (160 - 140);
          } else {
            $membershipDegree['td_sistol']['hipertensi'][$ja] = 1;
          }

          //membership degree t. darah diastol normal
          if($data_training[$ja][3] <= 80) {
            $membershipDegree['td_diastol']['normal'][$ja] = 1;
          } elseif ( (80 < $data_training[$ja][3]) && ($data_training[$ja][3] < 90) ) {
            $membershipDegree['td_diastol']['normal'][$ja] = (90 - $data_training[$ja][3]) / (90 - 80);
          } else {
            $membershipDegree['td_diastol']['normal'][$ja] = 0;
          }

          //membership degree t. darah diastol prahipertensi
          if( (80 < $data_training[$ja][3]) && ($data_training[$ja][3] < 90) ) {
            $membershipDegree['td_diastol']['prahipertensi'][$ja] = ($data_training[$ja][3] - 80) / (90 - 80);
          } elseif ( (90 <= $data_training[$ja][3]) && ($data_training[$ja][3] < 100) ) {
            $membershipDegree['td_diastol']['prahipertensi'][$ja] = (100 - $data_training[$ja][3]) / (100 - 90);
          } elseif( ($data_training[$ja][3] <= 80 ) || ($data_training[$ja][3] >= 100)) {
            $membershipDegree['td_diastol']['prahipertensi'][$ja] = 0;
          }

          //membership degree t. darah diastol hipertensi
          if($data_training[$ja][3] <= 90) {
            $membershipDegree['td_diastol']['hipertensi'][$ja] = 0;
          } elseif ( (90 < $data_training[$ja][3]) && ($data_training[$ja][3] < 100) ) {
            $membershipDegree['td_diastol']['hipertensi'][$ja] = ($data_training[$ja][3] - 90) / (100 - 90);
          } else {
            $membershipDegree['td_diastol']['hipertensi'][$ja] = 1;
          }

          //membership degree l.perut kecil
          if($data_training[$ja][4] < $kromosomBaru[$j][2]) {
            $membershipDegree['lingkar_perut']['kecil'][$ja] = 1;
          } elseif ( ($kromosomBaru[$j][2] < $data_training[$ja][4]) && ($data_training[$ja][4] < $kromosomBaru[$j][3]) ) {
            $membershipDegree['lingkar_perut']['kecil'][$ja] = ($kromosomBaru[$j][3] - $data_training[$ja][4]) / ($kromosomBaru[$j][3] - $kromosomBaru[$j][2]);
          } else {
            $membershipDegree['lingkar_perut']['kecil'][$ja] = 0;
          }

          //membership degree l.perut besar
          if($data_training[$ja][4] <= $kromosomBaru[$j][2]) {
            $membershipDegree['lingkar_perut']['besar'][$ja] = 0;
          } elseif ( ($kromosomBaru[$j][2] < $data_training[$ja][4]) && ($data_training[$ja][4] < $kromosomBaru[$j][3]) ) {
            $membershipDegree['lingkar_perut']['besar'][$ja] = ($data_training[$ja][4] - $kromosomBaru[$j][2] ) / ($kromosomBaru[$j][3] - $kromosomBaru[$j][2]);
          } else {
            $membershipDegree['lingkar_perut']['besar'][$ja] = 1;
          }

          //membership degree BMI Normal
          if($data_training[$ja][5] < $kromosomBaru[$j][4]) {
            $membershipDegree['bmi']['normal'][$ja] = 1;
          } elseif ( ($kromosomBaru[$j][4] < $data_training[$ja][5]) && ($data_training[$ja][5] < $kromosomBaru[$j][5]) ) {
            $membershipDegree['bmi']['normal'][$ja] = ($kromosomBaru[$j][5] - $data_training[$ja][5]) / ($kromosomBaru[$j][5] - $kromosomBaru[$j][4]);
          } else {
            $membershipDegree['bmi']['normal'][$ja] = 0;
          }

          //membership degree BMI Overweight
          if($data_training[$ja][5] <= $kromosomBaru[$j][4]) {
            $membershipDegree['bmi']['ow'][$ja] = 0;
          } elseif ( ($kromosomBaru[$j][4] < $data_training[$ja][5]) && ($data_training[$ja][5] < $kromosomBaru[$j][5]) ) {
            $membershipDegree['bmi']['ow'][$ja] = ($data_training[$ja][5] - $kromosomBaru[$j][4] ) / ($kromosomBaru[$j][5] - $kromosomBaru[$j][4]);
          } else {
            $membershipDegree['bmi']['ow'][$ja] = 1;
          }

          //membership degree merokok(1 = ya, 0 = tidak)
          if($data_training[$ja][6] == 1) {
            $membershipDegree['merokok']['ya'][$ja] = 1;
            $membershipDegree['merokok']['tdk'][$ja] = 0;
          } elseif ($data_training[$ja][6] == 0) {
            $membershipDegree['merokok']['ya'][$ja] = 0;
            $membershipDegree['merokok']['tdk'][$ja] = 1;
          }

          //membership degree makanan berlemak(0 = jarang, 1 = sering)
          if($data_training[$ja][7] == 1) {
            $membershipDegree['makanan_berlemak']['sering'][$ja] = 1;
            $membershipDegree['makanan_berlemak']['jarang'][$ja] = 0;
          } elseif ($data_training[$ja][7] == 0) {
            $membershipDegree['makanan_berlemak']['sering'][$ja] = 0;
            $membershipDegree['makanan_berlemak']['jarang'][$ja] = 1;
          }

          //membership degree konsumsi gula(1 = >4sdm, 0 = <=4sdm)
          if($data_training[$ja][8] == 1) {
            $membershipDegree['k_gula']['>4sdm'][$ja] = 1;
            $membershipDegree['k_gula']['<=4sdm'][$ja] = 0;
          } elseif ($data_training[$ja][8] == 0) {
            $membershipDegree['k_gula']['>4sdm'][$ja] = 0;
            $membershipDegree['k_gula']['<=4sdm'][$ja] = 1;
          }

          //membership degree konsumsi garam(1 = <=1sdt, 0 = >1sdt)
          if($data_training[$ja][9] == 1) {
            $membershipDegree['k_garam']['>1sdt'][$ja] = 1;
            $membershipDegree['k_garam']['<=1sdt'][$ja] = 0;
          } elseif ($data_training[$ja][9] == 0) {
            $membershipDegree['k_garam']['>1sdt'][$ja] = 0;
            $membershipDegree['k_garam']['<=1sdt'][$ja] = 1;
          }

          //membership degree Olahraga(1 = ya, 0 = tidak)
          if($data_training[$ja][10] == 1) {
            $membershipDegree['olahraga']['ya'][$ja] = 1;
            $membershipDegree['olahraga']['tdk'][$ja] = 0;
          } elseif ($data_training[$ja][10] == 0) {
            $membershipDegree['olahraga']['ya'][$ja] = 0;
            $membershipDegree['olahraga']['tdk'][$ja] = 1;
          }

          //membership degree konsumsi kafein(1 = tidak, 2 = <=3sdt, 3 = >3sdt)
          if($data_training[$ja][11] == 1) {
            $membershipDegree['k_kafein']['tdk'][$ja] = 1;
            $membershipDegree['k_kafein']['<=3sdt'][$ja] = 0;
            $membershipDegree['k_kafein']['>3sdt'][$ja] = 0;
          } elseif ($data_training[$ja][11] == 2) {
            $membershipDegree['k_kafein']['tdk'][$ja] = 0;
            $membershipDegree['k_kafein']['<=3sdt'][$ja] = 1;
            $membershipDegree['k_kafein']['>3sdt'][$ja] = 0;
          } elseif ($data_training[$ja][11] == 3) {
            $membershipDegree['k_kafein']['tdk'][$ja] = 0;
            $membershipDegree['k_kafein']['<=3sdt'][$ja] = 0;
            $membershipDegree['k_kafein']['>3sdt'][$ja] = 1;
          }



        }
      }
      // END OF LOOPING GENERASI

        // $sum = 0;
          $sumMembershipDegree[0] = array_sum($membershipDegree['umur']['muda']);
        // echo $sumMembershipDegree[0];
        $sumMembershipDegree[1] = array_sum($membershipDegree['umur']['tua']);
        $sumMembershipDegree[2] = array_sum($membershipDegree['sex']['lk']);
        $sumMembershipDegree[3] = array_sum($membershipDegree['sex']['pr']);
        $sumMembershipDegree[4] = array_sum($membershipDegree['td_sistol']['normal']);
        $sumMembershipDegree[5] = array_sum($membershipDegree['td_sistol']['prahipertensi']);
        $sumMembershipDegree[6] = array_sum($membershipDegree['td_sistol']['hipertensi']);
        $sumMembershipDegree[7] = array_sum($membershipDegree['td_diastol']['normal']);
        $sumMembershipDegree[8] = array_sum($membershipDegree['td_diastol']['prahipertensi']);
        $sumMembershipDegree[9] = array_sum($membershipDegree['td_diastol']['hipertensi']);
        $sumMembershipDegree[10] = array_sum($membershipDegree['lingkar_perut']['kecil']);
        $sumMembershipDegree[11] = array_sum($membershipDegree['lingkar_perut']['besar']);
        $sumMembershipDegree[12] = array_sum($membershipDegree['bmi']['normal']);
        $sumMembershipDegree[13] = array_sum($membershipDegree['bmi']['ow']);
        $sumMembershipDegree[14] = array_sum($membershipDegree['merokok']['ya']);
        $sumMembershipDegree[15] = array_sum($membershipDegree['merokok']['tdk']);
        $sumMembershipDegree[16] = array_sum($membershipDegree['makanan_berlemak']['sering']);
        $sumMembershipDegree[17] = array_sum($membershipDegree['makanan_berlemak']['jarang']);
        $sumMembershipDegree[18] = array_sum($membershipDegree['k_gula']['>4sdm']);
        $sumMembershipDegree[19] = array_sum($membershipDegree['k_gula']['<=4sdm']);
        $sumMembershipDegree[20] = array_sum($membershipDegree['k_garam']['>1sdt']);
        $sumMembershipDegree[21] = array_sum($membershipDegree['k_garam']['<=1sdt']);
        $sumMembershipDegree[22] = array_sum($membershipDegree['olahraga']['ya']);
        $sumMembershipDegree[23] = array_sum($membershipDegree['olahraga']['tdk']);
        $sumMembershipDegree[24] = array_sum($membershipDegree['k_kafein']['tdk']);
        $sumMembershipDegree[25] = array_sum($membershipDegree['k_kafein']['<=3sdt']);
        $sumMembershipDegree[26] = array_sum($membershipDegree['k_kafein']['>3sdt']);
      //
      // // ini
      $certainSumMembershipDegree =[[]];

      //rendah

      for ($jb=0; $jb < 3; $jb++) {
        for ($jba=0; $jba < count($sumMembershipDegree); $jba++) {
          $certainSumMembershipDegree[$jb][$jba] = 0;
        }
      }

      for ($k=0; $k < count($data_training); $k++) {
        if ($data_training[$k][12] == 1) {
          $certainSumMembershipDegree[0][0] += $membershipDegree['umur']['muda'][$k];
          $certainSumMembershipDegree[0][1] += $membershipDegree['umur']['tua'][$k];
          $certainSumMembershipDegree[0][2] += $membershipDegree['sex']['lk'][$k];
          $certainSumMembershipDegree[0][3] += $membershipDegree['sex']['pr'][$k];
          $certainSumMembershipDegree[0][4] += $membershipDegree['td_sistol']['normal'][$k];
          $certainSumMembershipDegree[0][5] += $membershipDegree['td_sistol']['prahipertensi'][$k];
          $certainSumMembershipDegree[0][6] += $membershipDegree['td_sistol']['hipertensi'][$k];
          $certainSumMembershipDegree[0][7] += $membershipDegree['td_diastol']['normal'][$k];
          $certainSumMembershipDegree[0][8] += $membershipDegree['td_diastol']['prahipertensi'][$k];
          $certainSumMembershipDegree[0][9] += $membershipDegree['td_diastol']['hipertensi'][$k];
          $certainSumMembershipDegree[0][10] += $membershipDegree['lingkar_perut']['kecil'][$k];
          $certainSumMembershipDegree[0][11] += $membershipDegree['lingkar_perut']['besar'][$k];
          $certainSumMembershipDegree[0][12] += $membershipDegree['bmi']['normal'][$k];
          $certainSumMembershipDegree[0][13] += $membershipDegree['bmi']['ow'][$k];
          $certainSumMembershipDegree[0][14] += $membershipDegree['merokok']['ya'][$k];
          $certainSumMembershipDegree[0][15] += $membershipDegree['merokok']['tdk'][$k];
          $certainSumMembershipDegree[0][16] += $membershipDegree['makanan_berlemak']['sering'][$k];
          $certainSumMembershipDegree[0][17] += $membershipDegree['makanan_berlemak']['jarang'][$k];
          $certainSumMembershipDegree[0][18] += $membershipDegree['k_gula']['>4sdm'][$k];
          $certainSumMembershipDegree[0][19] += $membershipDegree['k_gula']['<=4sdm'][$k];
          $certainSumMembershipDegree[0][20] += $membershipDegree['k_garam']['>1sdt'][$k];
          $certainSumMembershipDegree[0][21] += $membershipDegree['k_garam']['<=1sdt'][$k];
          $certainSumMembershipDegree[0][22] += $membershipDegree['olahraga']['ya'][$k];
          $certainSumMembershipDegree[0][23] += $membershipDegree['olahraga']['tdk'][$k];
          $certainSumMembershipDegree[0][24] += $membershipDegree['k_kafein']['tdk'][$k];
          $certainSumMembershipDegree[0][25] += $membershipDegree['k_kafein']['<=3sdt'][$k];
          $certainSumMembershipDegree[0][26] + $membershipDegree['k_kafein']['>3sdt'][$k];

        } elseif ($data_training[$k][12] == 2) {
          $certainSumMembershipDegree[1][0] += $membershipDegree['umur']['muda'][$k];
          $certainSumMembershipDegree[1][1] += $membershipDegree['umur']['tua'][$k];
          $certainSumMembershipDegree[1][2] += $membershipDegree['sex']['lk'][$k];
          $certainSumMembershipDegree[1][3] += $membershipDegree['sex']['pr'][$k];
          $certainSumMembershipDegree[1][4] += $membershipDegree['td_sistol']['normal'][$k];
          $certainSumMembershipDegree[1][5] += $membershipDegree['td_sistol']['prahipertensi'][$k];
          $certainSumMembershipDegree[1][6] += $membershipDegree['td_sistol']['hipertensi'][$k];
          $certainSumMembershipDegree[1][7] += $membershipDegree['td_diastol']['normal'][$k];
          $certainSumMembershipDegree[1][8] += $membershipDegree['td_diastol']['prahipertensi'][$k];
          $certainSumMembershipDegree[1][9] += $membershipDegree['td_diastol']['hipertensi'][$k];
          $certainSumMembershipDegree[1][10] += $membershipDegree['lingkar_perut']['kecil'][$k];
          $certainSumMembershipDegree[1][11] += $membershipDegree['lingkar_perut']['besar'][$k];
          $certainSumMembershipDegree[1][12] += $membershipDegree['bmi']['normal'][$k];
          $certainSumMembershipDegree[1][13] += $membershipDegree['bmi']['ow'][$k];
          $certainSumMembershipDegree[1][14] += $membershipDegree['merokok']['ya'][$k];
          $certainSumMembershipDegree[1][15] += $membershipDegree['merokok']['tdk'][$k];
          $certainSumMembershipDegree[1][16] += $membershipDegree['makanan_berlemak']['sering'][$k];
          $certainSumMembershipDegree[1][17] += $membershipDegree['makanan_berlemak']['jarang'][$k];
          $certainSumMembershipDegree[1][18] += $membershipDegree['k_gula']['>4sdm'][$k];
          $certainSumMembershipDegree[1][19] += $membershipDegree['k_gula']['<=4sdm'][$k];
          $certainSumMembershipDegree[1][20] += $membershipDegree['k_garam']['>1sdt'][$k];
          $certainSumMembershipDegree[1][21] += $membershipDegree['k_garam']['<=1sdt'][$k];
          $certainSumMembershipDegree[1][22] += $membershipDegree['olahraga']['ya'][$k];
          $certainSumMembershipDegree[1][23] += $membershipDegree['olahraga']['tdk'][$k];
          $certainSumMembershipDegree[1][24] += $membershipDegree['k_kafein']['tdk'][$k];
          $certainSumMembershipDegree[1][25] += $membershipDegree['k_kafein']['<=3sdt'][$k];
          $certainSumMembershipDegree[1][26] += $membershipDegree['k_kafein']['>3sdt'][$k];

        } elseif ($data_training[$k][12] == 3) {
          $certainSumMembershipDegree[2][0] += $membershipDegree['umur']['muda'][$k];
          $certainSumMembershipDegree[2][1] += $membershipDegree['umur']['tua'][$k];
          $certainSumMembershipDegree[2][2] += $membershipDegree['sex']['lk'][$k];
          $certainSumMembershipDegree[2][3] += $membershipDegree['sex']['pr'][$k];
          $certainSumMembershipDegree[2][4] += $membershipDegree['td_sistol']['normal'][$k];
          $certainSumMembershipDegree[2][5] += $membershipDegree['td_sistol']['prahipertensi'][$k];
          $certainSumMembershipDegree[2][6] += $membershipDegree['td_sistol']['hipertensi'][$k];
          $certainSumMembershipDegree[2][7] += $membershipDegree['td_diastol']['normal'][$k];
          $certainSumMembershipDegree[2][8] += $membershipDegree['td_diastol']['prahipertensi'][$k];
          $certainSumMembershipDegree[2][9] += $membershipDegree['td_diastol']['hipertensi'][$k];
          $certainSumMembershipDegree[2][10] += $membershipDegree['lingkar_perut']['kecil'][$k];
          $certainSumMembershipDegree[2][11] += $membershipDegree['lingkar_perut']['besar'][$k];
          $certainSumMembershipDegree[2][12] += $membershipDegree['bmi']['normal'][$k];
          $certainSumMembershipDegree[2][13] += $membershipDegree['bmi']['ow'][$k];
          $certainSumMembershipDegree[2][14] += $membershipDegree['merokok']['ya'][$k];
          $certainSumMembershipDegree[2][15] += $membershipDegree['merokok']['tdk'][$k];
          $certainSumMembershipDegree[2][16] += $membershipDegree['makanan_berlemak']['sering'][$k];
          $certainSumMembershipDegree[2][17] += $membershipDegree['makanan_berlemak']['jarang'][$k];
          $certainSumMembershipDegree[2][18] += $membershipDegree['k_gula']['>4sdm'][$k];
          $certainSumMembershipDegree[2][19] += $membershipDegree['k_gula']['<=4sdm'][$k];
          $certainSumMembershipDegree[2][20] += $membershipDegree['k_garam']['>1sdt'][$k];
          $certainSumMembershipDegree[2][21] += $membershipDegree['k_garam']['<=1sdt'][$k];
          $certainSumMembershipDegree[2][22] += $membershipDegree['olahraga']['ya'][$k];
          $certainSumMembershipDegree[2][23] += $membershipDegree['olahraga']['tdk'][$k];
          $certainSumMembershipDegree[2][24] += $membershipDegree['k_kafein']['tdk'][$k];
          $certainSumMembershipDegree[2][25] += $membershipDegree['k_kafein']['<=3sdt'][$k];
          $certainSumMembershipDegree[2][26] += $membershipDegree['k_kafein']['>3sdt'][$k];

        }
      }

      //entropy masing masing atribut
      $total = [];
      for ($jc=0; $jc < count($certainSumMembershipDegree[0]); $jc++) {
          $x = 0;
          for ($jca=0; $jca < count($certainSumMembershipDegree); $jca++) {
              $x += -(($certainSumMembershipDegree[$jca][$jc]/$sumMembershipDegree[$jc])*log(($certainSumMembershipDegree[$jca][$jc]/$sumMembershipDegree[$jc]),2));
          }
          $total[$jc] =$x;
          // echo "Total atribut " + $total[$i];
      }

      for ($je=0; $je < count($total) ; $je++) {
        if(is_nan($total[$je])) {
          $total[$je] = 0;
        }
      }

      // cari entropy total
      $jmlKelas1 = 0;
      $jmlKelas2 = 0;
      $jmlKelas3 = 0;

      for ($j=0; $j < count($data_training); $j++) {
        if ($data_training[$j][12] == 1) {
          $jmlKelas1++;
        } elseif ($data_training[$j][12] == 2) {
          $jmlKelas2++;
        } elseif ($data_training[$j][12] == 3) {
          $jmlKelas3++;
        }
      }

      $log[0] = $jmlKelas1 / count($data_training);
      $log[1] = $jmlKelas2 / count($data_training);
      $log[2] = $jmlKelas3 / count($data_training);

      $entropyS = -(($jmlKelas1 / count($data_training)) * (log($log[0], 2))) -
                  (($jmlKelas2 / count($data_training)) * (log($log[1], 2))) -
                  (($jmlKelas3 / count($data_training)) * (log($log[2], 2)));

      $loop = 0;


      if($loop == 0) {
        $root = 99999;
        $childNode = 99999;
      }

      $informationGain = array_fill(0, 12, null);

      if($root != $informationGain[0] || $childNode != $informationGain[0] || $loop == 0) {
        $informationGain[0] = $entropyS - (($sumMembershipDegree[0] / count($data_training)) * $total[0]) - (($sumMembershipDegree[1] / count($data_training)) * $total[1]) ;
      } if ($root != $informationGain[1] || $childNode != $informationGain[1] || $loop == 0) {
        $informationGain[1] = $entropyS - (($sumMembershipDegree[2] / count($data_training)) * $total[2]) - (($sumMembershipDegree[3] / count($data_training)) * $total[3]) ;
      } if ($root != $informationGain[2] || $childNode != $informationGain[2] || $loop == 0) {
        $informationGain[2] = $entropyS - (($sumMembershipDegree[4] / count($data_training)) * $total[4]) - (($sumMembershipDegree[5] / count($data_training)) * $total[5]) - (($sumMembershipDegree[6] / count($data_training)) * $total[6]) ;
      } if ($root != $informationGain[3] || $childNode != $informationGain[3] || $loop == 0) {
        $informationGain[3] = $entropyS - (($sumMembershipDegree[7] / count($data_training)) * $total[7]) - (($sumMembershipDegree[8] / count($data_training)) * $total[8]) - (($sumMembershipDegree[9] / count($data_training)) * $total[9]) ;
      } if ($root != $informationGain[4] || $childNode != $informationGain[4] || $loop == 0) {
        $informationGain[4] = $entropyS - (($sumMembershipDegree[10] / count($data_training)) * $total[10]) - (($sumMembershipDegree[11] / count($data_training)) * $total[11]) ;
      } if ($root != $informationGain[5] || $childNode != $informationGain[5] || $loop == 0) {
        $informationGain[5] = $entropyS - (($sumMembershipDegree[12] / count($data_training)) * $total[12]) - (($sumMembershipDegree[13] / count($data_training)) * $total[13]) ;
      } if ($root != $informationGain[6] || $childNode != $informationGain[6] || $loop == 0) {
        $informationGain[6] = $entropyS - (($sumMembershipDegree[14] / count($data_training)) * $total[14]) - (($sumMembershipDegree[15] / count($data_training)) * $total[15]) ;
      } if ($root != $informationGain[7] || $childNode != $informationGain[7] || $loop == 0) {
        $informationGain[7] = $entropyS - (($sumMembershipDegree[16] / count($data_training)) * $total[16]) - (($sumMembershipDegree[17] / count($data_training)) * $total[17]) ;
      } if ($root != $informationGain[8] || $childNode != $informationGain[8] || $loop == 0) {
        $informationGain[8] = $entropyS - (($sumMembershipDegree[18] / count($data_training)) * $total[18]) - (($sumMembershipDegree[19] / count($data_training)) * $total[19]) ;
      } if ($root != $informationGain[9] || $childNode != $informationGain[9] || $loop == 0) {
        $informationGain[9] = $entropyS - (($sumMembershipDegree[20] / count($data_training)) * $total[20]) - (($sumMembershipDegree[21] / count($data_training)) * $total[21]) ;
      } if ($root != $informationGain[10] || $childNode != $informationGain[10] || $loop == 0) {
        $informationGain[10] = $entropyS - (($sumMembershipDegree[22] / count($data_training)) * $total[22]) - (($sumMembershipDegree[23] / count($data_training)) * $total[23]) ;
      } if ($root != $informationGain[11] || $childNode != $informationGain[11] || $loop == 0) {
        $informationGain[11] = $entropyS - (($sumMembershipDegree[24] / count($data_training)) * $total[24]) - (($sumMembershipDegree[25] / count($data_training)) * $total[25]) - (($sumMembershipDegree[26] / count($data_training)) * $total[26]) ;
      }

      for ($i = 0; $i < count($informationGain) ; $i++) {
        $index[$i] = $i;
      }

      for ($i = 0; $i < count($informationGain) ; $i++) {
        for ($j = 1; $j < (count($informationGain) - $i); $j++) {
          if($informationGain[$j-1] < $informationGain[$j]){
            $temp = $informationGain[$j-1];
            $informationGain[$j-1] = $informationGain[$j];
            $informationGain[$j] = $temp;

            $tempIndex = $index[$j-1];
            $index[$j-1] = $index[$j];
            $index[$j] = $tempIndex;
          }
        }
      }

      // for ($i = 0; $i < count($informationGain) ; $i++) {
      //   if ($i = 0){
      //     $root = $informationGain[$i];
      //   } else {
      //     $childNode[$i] = $informationGain[$i];
      //   }
      // }

      // if($i == 0) {
      //   $root = max($informationGain);
      // } else {
      //   $childNode[$loop] = max($informationGain);
      // }

      $temp = 0;
      $proporsi = array_fill(0, 3, array_fill(0, 27, 0));

      for ($jd=0; $jd < count($data_training); $jd++) {
        if ($data_training[$jd][12] == 0) {
          // 0 pertama proporsi kelas ke 0, 0 kedua atributnya
          $proporsi[0][0] = $proporsi[0][0] + $membershipDegree['umur']['muda'][$jd];
          $proporsi[0][1] = $proporsi[0][1] + $membershipDegree['umur']['tua'][$jd];
          $proporsi[0][2] = $proporsi[0][2] + $membershipDegree['sex']['lk'][$jd];
          $proporsi[0][3] = $proporsi[0][3] + $membershipDegree['sex']['pr'][$jd];
          $proporsi[0][4] = $proporsi[0][4] + $membershipDegree['td_sistol']['normal'][$jd];
          $proporsi[0][5] = $proporsi[0][5] + $membershipDegree['td_sistol']['prahipertensi'][$jd];
          $proporsi[0][6] = $proporsi[0][6] + $membershipDegree['td_sistol']['hipertensi'][$jd];
          $proporsi[0][7] = $proporsi[0][7] + $membershipDegree['td_diastol']['normal'][$jd];
          $proporsi[0][8] = $proporsi[0][8] + $membershipDegree['td_diastol']['prahipertensi'][$jd];
          $proporsi[0][9] = $proporsi[0][9] + $membershipDegree['td_diastol']['hipertensi'][$jd];
          $proporsi[0][10] = $proporsi[0][10] + $membershipDegree['lingkar_perut']['kecil'][$jd];
          $proporsi[0][11] = $proporsi[0][11] + $membershipDegree['lingkar_perut']['besar'][$jd];
          $proporsi[0][12] = $proporsi[0][12] + $membershipDegree['bmi']['normal'][$jd];
          $proporsi[0][13] = $proporsi[0][13] + $membershipDegree['bmi']['ow'][$jd];
          $proporsi[0][14] = $proporsi[0][14] + $membershipDegree['merokok']['ya'][$jd];
          $proporsi[0][15] = $proporsi[0][15] + $membershipDegree['merokok']['tdk'][$jd];
          $proporsi[0][16] = $proporsi[0][16] + $membershipDegree['makanan_berlemak']['sering'][$jd];
          $proporsi[0][17] = $proporsi[0][17] + $membershipDegree['makanan_berlemak']['jarang'][$jd];
          $proporsi[0][18] = $proporsi[0][18] + $membershipDegree['k_gula']['>4sdm'][$jd];
          $proporsi[0][19] = $proporsi[0][19] + $membershipDegree['k_gula']['<=4sdm'][$jd];
          $proporsi[0][20] = $proporsi[0][20] + $membershipDegree['k_garam']['>1sdt'][$jd];
          $proporsi[0][21] = $proporsi[0][21] + $membershipDegree['k_garam']['<=1sdt'][$jd];
          $proporsi[0][22] = $proporsi[0][22] + $membershipDegree['olahraga']['ya'][$jd];
          $proporsi[0][23] = $proporsi[0][23] + $membershipDegree['olahraga']['tdk'][$jd];
          $proporsi[0][24] = $proporsi[0][24] + $membershipDegree['k_kafein']['tdk'][$jd];
          $proporsi[0][25] = $proporsi[0][25] + $membershipDegree['k_kafein']['<=3sdt'][$jd];
          $proporsi[0][26] = $proporsi[0][26] + $membershipDegree['k_kafein']['>3sdt'][$jd];

        } elseif ($data_training[$jd][12] == 1) {
          // 0 pertama proporsi kelas ke 0, 0 kedua atributnya
          $proporsi[1][0] = $proporsi[1][0] + $membershipDegree['umur']['muda'][$jd];
          $proporsi[1][1] = $proporsi[1][1] + $membershipDegree['umur']['tua'][$jd];
          $proporsi[1][2] = $proporsi[1][2] + $membershipDegree['sex']['lk'][$jd];
          $proporsi[1][3] = $proporsi[1][3] + $membershipDegree['sex']['pr'][$jd];
          $proporsi[1][4] = $proporsi[1][4] + $membershipDegree['td_sistol']['normal'][$jd];
          $proporsi[1][5] = $proporsi[1][5] + $membershipDegree['td_sistol']['prahipertensi'][$jd];
          $proporsi[1][6] = $proporsi[1][6] + $membershipDegree['td_sistol']['hipertensi'][$jd];
          $proporsi[1][7] = $proporsi[1][7] + $membershipDegree['td_diastol']['normal'][$jd];
          $proporsi[1][8] = $proporsi[1][8] + $membershipDegree['td_diastol']['prahipertensi'][$jd];
          $proporsi[1][9] = $proporsi[1][9] + $membershipDegree['td_diastol']['hipertensi'][$jd];
          $proporsi[1][10] = $proporsi[1][10] + $membershipDegree['lingkar_perut']['kecil'][$jd];
          $proporsi[1][11] = $proporsi[1][11] + $membershipDegree['lingkar_perut']['besar'][$jd];
          $proporsi[1][12] = $proporsi[1][12] + $membershipDegree['bmi']['normal'][$jd];
          $proporsi[1][13] = $proporsi[1][13] + $membershipDegree['bmi']['ow'][$jd];
          $proporsi[1][14] = $proporsi[1][14] + $membershipDegree['merokok']['ya'][$jd];
          $proporsi[1][15] = $proporsi[1][15] + $membershipDegree['merokok']['tdk'][$jd];
          $proporsi[1][16] = $proporsi[1][16] + $membershipDegree['makanan_berlemak']['sering'][$jd];
          $proporsi[1][17] = $proporsi[1][17] + $membershipDegree['makanan_berlemak']['jarang'][$jd];
          $proporsi[1][18] = $proporsi[1][18] + $membershipDegree['k_gula']['>4sdm'][$jd];
          $proporsi[1][19] = $proporsi[1][19] + $membershipDegree['k_gula']['<=4sdm'][$jd];
          $proporsi[1][20] = $proporsi[1][20] + $membershipDegree['k_garam']['>1sdt'][$jd];
          $proporsi[1][21] = $proporsi[1][21] + $membershipDegree['k_garam']['<=1sdt'][$jd];
          $proporsi[1][22] = $proporsi[1][22] + $membershipDegree['olahraga']['ya'][$jd];
          $proporsi[1][23] = $proporsi[1][23] + $membershipDegree['olahraga']['tdk'][$jd];
          $proporsi[1][24] = $proporsi[1][24] + $membershipDegree['k_kafein']['tdk'][$jd];
          $proporsi[1][25] = $proporsi[1][25] + $membershipDegree['k_kafein']['<=3sdt'][$jd];
          $proporsi[1][26] = $proporsi[1][26] + $membershipDegree['k_kafein']['>3sdt'][$jd];
        } elseif ($data_training[$jd][12] == 2) {
          // 0 pertama proporsi kelas ke 0, 0 kedua atributnya
          $proporsi[2][0] = $proporsi[2][0] + $membershipDegree['umur']['muda'][$jd];
          $proporsi[2][1] = $proporsi[2][1] + $membershipDegree['umur']['tua'][$jd];
          $proporsi[2][2] = $proporsi[2][2] + $membershipDegree['sex']['lk'][$jd];
          $proporsi[2][3] = $proporsi[2][3] + $membershipDegree['sex']['pr'][$jd];
          $proporsi[2][4] = $proporsi[2][4] + $membershipDegree['td_sistol']['normal'][$jd];
          $proporsi[2][5] = $proporsi[2][5] + $membershipDegree['td_sistol']['prahipertensi'][$jd];
          $proporsi[2][6] = $proporsi[2][6] + $membershipDegree['td_sistol']['hipertensi'][$jd];
          $proporsi[2][7] = $proporsi[2][7] + $membershipDegree['td_diastol']['normal'][$jd];
          $proporsi[2][8] = $proporsi[2][8] + $membershipDegree['td_diastol']['prahipertensi'][$jd];
          $proporsi[2][9] = $proporsi[2][9] + $membershipDegree['td_diastol']['hipertensi'][$jd];
          $proporsi[2][10] = $proporsi[2][10] + $membershipDegree['lingkar_perut']['kecil'][$jd];
          $proporsi[2][11] = $proporsi[2][11] + $membershipDegree['lingkar_perut']['besar'][$jd];
          $proporsi[2][12] = $proporsi[2][12] + $membershipDegree['bmi']['normal'][$jd];
          $proporsi[2][13] = $proporsi[2][13] + $membershipDegree['bmi']['ow'][$jd];
          $proporsi[2][14] = $proporsi[2][14] + $membershipDegree['merokok']['ya'][$jd];
          $proporsi[2][15] = $proporsi[2][15] + $membershipDegree['merokok']['tdk'][$jd];
          $proporsi[2][16] = $proporsi[2][16] + $membershipDegree['makanan_berlemak']['sering'][$jd];
          $proporsi[2][17] = $proporsi[2][17] + $membershipDegree['makanan_berlemak']['jarang'][$jd];
          $proporsi[2][18] = $proporsi[2][18] + $membershipDegree['k_gula']['>4sdm'][$jd];
          $proporsi[2][19] = $proporsi[2][19] + $membershipDegree['k_gula']['<=4sdm'][$jd];
          $proporsi[2][20] = $proporsi[2][20] + $membershipDegree['k_garam']['>1sdt'][$jd];
          $proporsi[2][21] = $proporsi[2][21] + $membershipDegree['k_garam']['<=1sdt'][$jd];
          $proporsi[2][22] = $proporsi[2][22] + $membershipDegree['olahraga']['ya'][$jd];
          $proporsi[2][23] = $proporsi[2][23] + $membershipDegree['olahraga']['tdk'][$jd];
          $proporsi[2][24] = $proporsi[2][24] + $membershipDegree['k_kafein']['tdk'][$jd];
          $proporsi[2][25] = $proporsi[2][25] + $membershipDegree['k_kafein']['<=3sdt'][$jd];
          $proporsi[2][26] = $proporsi[2][26] + $membershipDegree['k_kafein']['>3sdt'][$jd];
        }
      }

      // for ($jf=0; $jf < count($proporsi); $jf++) {
        $proporsiFinal[0][0] = ($proporsi[0][0] / ($proporsi[0][0] + $proporsi[1][0] + $proporsi[2][0])) * 100;
        $proporsiFinal[0][1] = ($proporsi[0][1] / ($proporsi[0][1] + $proporsi[1][1] + $proporsi[2][1])) * 100;
        $proporsiFinal[0][2] = ($proporsi[0][2] / ($proporsi[0][2] + $proporsi[1][2] + $proporsi[2][2])) * 100;
        $proporsiFinal[0][3] = ($proporsi[0][3] / ($proporsi[0][3] + $proporsi[1][3] + $proporsi[2][3])) * 100;
        $proporsiFinal[0][4] = ($proporsi[0][4] / ($proporsi[0][4] + $proporsi[1][4] + $proporsi[2][4])) * 100;
        $proporsiFinal[0][5] = ($proporsi[0][5] / ($proporsi[0][5] + $proporsi[1][5] + $proporsi[2][5])) * 100;
        $proporsiFinal[0][6] = ($proporsi[0][6] / ($proporsi[0][6] + $proporsi[1][6] + $proporsi[2][6])) * 100;
        $proporsiFinal[0][7] = ($proporsi[0][7] / ($proporsi[0][7] + $proporsi[1][7] + $proporsi[2][7])) * 100;
        $proporsiFinal[0][8] = ($proporsi[0][8] / ($proporsi[0][8] + $proporsi[1][8] + $proporsi[2][8])) * 100;
        $proporsiFinal[0][9] = ($proporsi[0][9] / ($proporsi[0][9] + $proporsi[1][9] + $proporsi[2][9])) * 100;
        $proporsiFinal[0][10] = ($proporsi[0][10] / ($proporsi[0][10] + $proporsi[1][10] + $proporsi[2][10])) * 100;
        $proporsiFinal[0][11] = ($proporsi[0][11] / ($proporsi[0][11] + $proporsi[1][11] + $proporsi[2][11])) * 100;
        $proporsiFinal[0][12] = ($proporsi[0][12] / ($proporsi[0][12] + $proporsi[1][12] + $proporsi[2][12])) * 100;
        $proporsiFinal[0][13] = ($proporsi[0][13] / ($proporsi[0][13] + $proporsi[1][13] + $proporsi[2][13])) * 100;
        $proporsiFinal[0][14] = ($proporsi[0][14] / ($proporsi[0][14] + $proporsi[1][14] + $proporsi[2][14])) * 100;
        $proporsiFinal[0][15] = ($proporsi[0][15] / ($proporsi[0][15] + $proporsi[1][15] + $proporsi[2][15])) * 100;
        $proporsiFinal[0][16] = ($proporsi[0][16] / ($proporsi[0][16] + $proporsi[1][16] + $proporsi[2][16])) * 100;
        $proporsiFinal[0][17] = ($proporsi[0][17] / ($proporsi[0][17] + $proporsi[1][17] + $proporsi[2][17])) * 100;
        $proporsiFinal[0][18] = ($proporsi[0][18] / ($proporsi[0][18] + $proporsi[1][18] + $proporsi[2][18])) * 100;
        $proporsiFinal[0][19] = ($proporsi[0][19] / ($proporsi[0][19] + $proporsi[1][19] + $proporsi[2][19])) * 100;
        $proporsiFinal[0][20] = ($proporsi[0][20] / ($proporsi[0][20] + $proporsi[1][20] + $proporsi[2][20])) * 100;
        $proporsiFinal[0][21] = ($proporsi[0][21] / ($proporsi[0][21] + $proporsi[1][21] + $proporsi[2][21])) * 100;
        $proporsiFinal[0][22] = ($proporsi[0][22] / ($proporsi[0][22] + $proporsi[1][22] + $proporsi[2][22])) * 100;
        $proporsiFinal[0][23] = ($proporsi[0][23] / ($proporsi[0][23] + $proporsi[1][23] + $proporsi[2][23])) * 100;
        $proporsiFinal[0][24] = ($proporsi[0][24] / ($proporsi[0][24] + $proporsi[1][24] + $proporsi[2][24])) * 100;
        $proporsiFinal[0][25] = ($proporsi[0][25] / ($proporsi[0][25] + $proporsi[1][25] + $proporsi[2][25])) * 100;
        $proporsiFinal[0][26] = ($proporsi[0][26] / ($proporsi[0][26] + $proporsi[1][26] + $proporsi[2][26])) * 100;


        $proporsiFinal[1][0] = ($proporsi[1][0] / ($proporsi[0][0] + $proporsi[1][0] + $proporsi[2][0])) * 100;
        $proporsiFinal[1][1] = ($proporsi[1][1] / ($proporsi[0][1] + $proporsi[1][1] + $proporsi[2][1])) * 100;
        $proporsiFinal[1][2] = ($proporsi[1][2] / ($proporsi[0][2] + $proporsi[1][2] + $proporsi[2][2])) * 100;
        $proporsiFinal[1][3] = ($proporsi[1][3] / ($proporsi[0][3] + $proporsi[1][3] + $proporsi[2][3])) * 100;
        $proporsiFinal[1][4] = ($proporsi[1][4] / ($proporsi[0][4] + $proporsi[1][4] + $proporsi[2][4])) * 100;
        $proporsiFinal[1][5] = ($proporsi[1][5] / ($proporsi[0][5] + $proporsi[1][5] + $proporsi[2][5])) * 100;
        $proporsiFinal[1][6] = ($proporsi[1][6] / ($proporsi[0][6] + $proporsi[1][6] + $proporsi[2][6])) * 100;
        $proporsiFinal[1][7] = ($proporsi[1][7] / ($proporsi[0][7] + $proporsi[1][7] + $proporsi[2][7])) * 100;
        $proporsiFinal[1][8] = ($proporsi[1][8] / ($proporsi[0][8] + $proporsi[1][8] + $proporsi[2][8])) * 100;
        $proporsiFinal[1][9] = ($proporsi[1][9] / ($proporsi[0][9] + $proporsi[1][9] + $proporsi[2][9])) * 100;
        $proporsiFinal[1][10] = ($proporsi[1][10] / ($proporsi[0][10] + $proporsi[1][10] + $proporsi[2][10])) * 100;
        $proporsiFinal[1][11] = ($proporsi[1][11] / ($proporsi[0][11] + $proporsi[1][11] + $proporsi[2][11])) * 100;
        $proporsiFinal[1][12] = ($proporsi[1][12] / ($proporsi[0][12] + $proporsi[1][12] + $proporsi[2][12])) * 100;
        $proporsiFinal[1][13] = ($proporsi[1][13] / ($proporsi[0][13] + $proporsi[1][13] + $proporsi[2][13])) * 100;
        $proporsiFinal[1][14] = ($proporsi[1][14] / ($proporsi[0][14] + $proporsi[1][14] + $proporsi[2][14])) * 100;
        $proporsiFinal[1][15] = ($proporsi[1][15] / ($proporsi[0][15] + $proporsi[1][15] + $proporsi[2][15])) * 100;
        $proporsiFinal[1][16] = ($proporsi[1][16] / ($proporsi[0][16] + $proporsi[1][16] + $proporsi[2][16])) * 100;
        $proporsiFinal[1][17] = ($proporsi[1][17] / ($proporsi[0][17] + $proporsi[1][17] + $proporsi[2][17])) * 100;
        $proporsiFinal[1][18] = ($proporsi[1][18] / ($proporsi[0][18] + $proporsi[1][18] + $proporsi[2][18])) * 100;
        $proporsiFinal[1][19] = ($proporsi[1][19] / ($proporsi[0][19] + $proporsi[1][19] + $proporsi[2][19])) * 100;
        $proporsiFinal[1][20] = ($proporsi[1][20] / ($proporsi[0][20] + $proporsi[1][20] + $proporsi[2][20])) * 100;
        $proporsiFinal[1][21] = ($proporsi[1][21] / ($proporsi[0][21] + $proporsi[1][21] + $proporsi[2][21])) * 100;
        $proporsiFinal[1][22] = ($proporsi[1][22] / ($proporsi[0][22] + $proporsi[1][22] + $proporsi[2][22])) * 100;
        $proporsiFinal[1][23] = ($proporsi[1][23] / ($proporsi[0][23] + $proporsi[1][23] + $proporsi[2][23])) * 100;
        $proporsiFinal[1][24] = ($proporsi[1][24] / ($proporsi[0][24] + $proporsi[1][24] + $proporsi[2][24])) * 100;
        $proporsiFinal[1][25] = ($proporsi[1][25] / ($proporsi[0][25] + $proporsi[1][25] + $proporsi[2][25])) * 100;
        $proporsiFinal[1][26] = ($proporsi[1][26] / ($proporsi[0][26] + $proporsi[1][26] + $proporsi[2][26])) * 100;

        $proporsiFinal[2][0] = ($proporsi[2][0] / ($proporsi[0][0] + $proporsi[1][0] + $proporsi[2][0])) * 100;
        $proporsiFinal[2][1] = ($proporsi[2][1] / ($proporsi[0][1] + $proporsi[1][1] + $proporsi[2][1])) * 100;
        $proporsiFinal[2][2] = ($proporsi[2][2] / ($proporsi[0][2] + $proporsi[1][2] + $proporsi[2][2])) * 100;
        $proporsiFinal[2][3] = ($proporsi[2][3] / ($proporsi[0][3] + $proporsi[1][3] + $proporsi[2][3])) * 100;
        $proporsiFinal[2][4] = ($proporsi[2][4] / ($proporsi[0][4] + $proporsi[1][4] + $proporsi[2][4])) * 100;
        $proporsiFinal[2][5] = ($proporsi[2][5] / ($proporsi[0][5] + $proporsi[1][5] + $proporsi[2][5])) * 100;
        $proporsiFinal[2][6] = ($proporsi[2][6] / ($proporsi[0][6] + $proporsi[1][6] + $proporsi[2][6])) * 100;
        $proporsiFinal[2][7] = ($proporsi[2][7] / ($proporsi[0][7] + $proporsi[1][7] + $proporsi[2][7])) * 100;
        $proporsiFinal[2][8] = ($proporsi[2][8] / ($proporsi[0][8] + $proporsi[1][8] + $proporsi[2][8])) * 100;
        $proporsiFinal[2][9] = ($proporsi[2][9] / ($proporsi[0][9] + $proporsi[1][9] + $proporsi[2][9])) * 100;
        $proporsiFinal[2][10] = ($proporsi[2][10] / ($proporsi[0][10] + $proporsi[1][10] + $proporsi[2][10])) * 100;
        $proporsiFinal[2][11] = ($proporsi[2][11] / ($proporsi[0][11] + $proporsi[1][11] + $proporsi[2][11])) * 100;
        $proporsiFinal[2][12] = ($proporsi[2][12] / ($proporsi[0][12] + $proporsi[1][12] + $proporsi[2][12])) * 100;
        $proporsiFinal[2][13] = ($proporsi[2][13] / ($proporsi[0][13] + $proporsi[1][13] + $proporsi[2][13])) * 100;
        $proporsiFinal[2][14] = ($proporsi[2][14] / ($proporsi[0][14] + $proporsi[1][14] + $proporsi[2][14])) * 100;
        $proporsiFinal[2][15] = ($proporsi[2][15] / ($proporsi[0][15] + $proporsi[1][15] + $proporsi[2][15])) * 100;
        $proporsiFinal[2][16] = ($proporsi[2][16] / ($proporsi[0][16] + $proporsi[1][16] + $proporsi[2][16])) * 100;
        $proporsiFinal[2][17] = ($proporsi[2][17] / ($proporsi[0][17] + $proporsi[1][17] + $proporsi[2][17])) * 100;
        $proporsiFinal[2][18] = ($proporsi[2][18] / ($proporsi[0][18] + $proporsi[1][18] + $proporsi[2][18])) * 100;
        $proporsiFinal[2][19] = ($proporsi[2][19] / ($proporsi[0][19] + $proporsi[1][19] + $proporsi[2][19])) * 100;
        $proporsiFinal[2][20] = ($proporsi[2][20] / ($proporsi[0][20] + $proporsi[1][20] + $proporsi[2][20])) * 100;
        $proporsiFinal[2][21] = ($proporsi[2][21] / ($proporsi[0][21] + $proporsi[1][21] + $proporsi[2][21])) * 100;
        $proporsiFinal[2][22] = ($proporsi[2][22] / ($proporsi[0][22] + $proporsi[1][22] + $proporsi[2][22])) * 100;
        $proporsiFinal[2][23] = ($proporsi[2][23] / ($proporsi[0][23] + $proporsi[1][23] + $proporsi[2][23])) * 100;
        $proporsiFinal[2][24] = ($proporsi[2][24] / ($proporsi[0][24] + $proporsi[1][24] + $proporsi[2][24])) * 100;
        $proporsiFinal[2][25] = ($proporsi[2][25] / ($proporsi[0][25] + $proporsi[1][25] + $proporsi[2][25])) * 100;
        $proporsiFinal[2][26] = ($proporsi[2][26] / ($proporsi[0][26] + $proporsi[1][26] + $proporsi[2][26])) * 100;
      // }



      echo '<pre>' . var_export($informationGain, true) . '</pre>';
      echo '<pre>' . var_export($index, true) . '</pre>';
      echo '<pre>' . var_export($proporsiFinal, true) . '</pre>';
      echo '<pre>' . var_export($entropyS, true) . '</pre>';
      // echo '<pre>' . var_export($sumEntropy, true) . '</pre>';
      // echo '<pre>' . var_export($item, true) . '</pre>';

      // echo '<pre>' . var_export($kromosom, true) . '</pre>';

      // var_dump($kromosom);

      // $this->load->view('user/classification_result', array('offspring_c' => $offSpringC,
      //                                                       'offspring_m' => $offSpringM,
      //                                                       'kromosom' => $kromosom,
      //                                                       'kromosom_baru' => $kromosomBaru,
      //                                                       'membership_degree' => $membershipDegree,
      //                                                       'data_training' => $data_training,
      //                                                       'sum' => $sum));

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


}
?>

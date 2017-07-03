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

        // cari entropy
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
        $entropyS = -( (($jmlKelas1 / count($data_training)) * (log($jmlKelas1, 2) / count($data_training))) -
                    (($jmlKelas2 / count($data_training)) * (log($jmlKelas2, 2) / count($data_training))) -
                    (($jmlKelas3 / count($data_training)) * (log($jmlKelas3, 2) / count($data_training))) );


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
      } // END OF LOOPING GENERASI

        // $sum = 0;
        $sumMembershipDegree[0] = array_sum($membershipDegree['umur']['muda']);
        $sumMembershipDegree[1] = array_sum($membershipDegree['umur']['tua']);
        $sumMembershipDegree[3] = array_sum($membershipDegree['sex']['lk']);
        $sumMembershipDegree[4] = array_sum($membershipDegree['sex']['pr']);
        $sumMembershipDegree[5] = array_sum($membershipDegree['td_sistol']['normal']);
        $sumMembershipDegree[6] = array_sum($membershipDegree['td_sistol']['prahipertensi']);
        $sumMembershipDegree[7] = array_sum($membershipDegree['td_sistol']['hipertensi']);
        $sumMembershipDegree[8] = array_sum($membershipDegree['td_diastol']['normal']);
        $sumMembershipDegree[9] = array_sum($membershipDegree['td_diastol']['prahipertensi']);
        $sumMembershipDegree[10] = array_sum($membershipDegree['td_diastol']['hipertensi']);
        $sumMembershipDegree[11] = array_sum($membershipDegree['lingkar_perut']['kecil']);
        $sumMembershipDegree[12] = array_sum($membershipDegree['lingkar_perut']['besar']);
        $sumMembershipDegree[13] = array_sum($membershipDegree['bmi']['normal']);
        $sumMembershipDegree[14] = array_sum($membershipDegree['bmi']['ow']);
        $sumMembershipDegree[15] = array_sum($membershipDegree['merokok']['ya']);
        $sumMembershipDegree[16] = array_sum($membershipDegree['merokok']['tdk']);
        $sumMembershipDegree[17] = array_sum($membershipDegree['makanan_berlemak']['sering']);
        $sumMembershipDegree[18] = array_sum($membershipDegree['makanan_berlemak']['jarang']);
        $sumMembershipDegree[19] = array_sum($membershipDegree['k_gula']['>4sdm']);
        $sumMembershipDegree[20] = array_sum($membershipDegree['k_gula']['<=4sdm']);
        $sumMembershipDegree[21] = array_sum($membershipDegree['k_garam']['>1sdt']);
        $sumMembershipDegree[22] = array_sum($membershipDegree['k_garam']['<=1sdt']);
        $sumMembershipDegree[23] = array_sum($membershipDegree['olahraga']['ya']);
        $sumMembershipDegree[24] = array_sum($membershipDegree['olahraga']['tdk']);
        $sumMembershipDegree[25] = array_sum($membershipDegree['k_kafein']['tdk']);
        $sumMembershipDegree[26] = array_sum($membershipDegree['k_kafein']['<=3sdt']);
        $sumMembershipDegree[27] = array_sum($membershipDegree['k_kafein']['>3sdt']);

      // ini
      $certainSumMembershipDegree =[];

      for ($k=0; $k < count($data_training); $k++) {
        if ($data_training[$k][12] == 1) {
          $certainSumMembershipDegree['rendah']['umur']['muda'] = $certainSumMembershipDegree['rendah']['umur']['muda'] + $membershipDegree['umur']['muda'][$k];
          $certainSumMembershipDegree['rendah']['umur']['tua'] = $certainSumMembershipDegree['rendah']['umur']['tua'] + $membershipDegree['umur']['tua'][$k];
          $certainSumMembershipDegree['rendah']['sex']['lk'] = $certainSumMembershipDegree['rendah']['sex']['lk'] + $membershipDegree['sex']['lk'][$k];
          $certainSumMembershipDegree['rendah']['sex']['pr'] = $certainSumMembershipDegree['rendah']['sex']['pr'] + $membershipDegree['sex']['pr'][$k];
          $certainSumMembershipDegree['rendah']['td_sistol']['normal'] = $certainSumMembershipDegree['rendah']['td_sistol']['normal'] + $membershipDegree['td_sistol']['normal'][$k];
          $certainSumMembershipDegree['rendah']['td_sistol']['prahipertensi'] = $certainSumMembershipDegree['rendah']['td_sistol']['prahipertensi'] + $membershipDegree['td_sistol']['prahipertensi'][$k];
          $certainSumMembershipDegree['rendah']['td_sistol']['hipertensi'] = $certainSumMembershipDegree['rendah']['td_sistol']['hipertensi'] + $membershipDegree['td_sistol']['hipertensi'][$k];
          $certainSumMembershipDegree['rendah']['td_diastol']['normal'] = $certainSumMembershipDegree['rendah']['td_diastol']['normal'] + $membershipDegree['td_diastol']['normal'][$k];
          $certainSumMembershipDegree['rendah']['td_diastol']['prahipertensi'] = $certainSumMembershipDegree['rendah']['td_diastol']['prahipertensi'] + $membershipDegree['td_diastol']['prahipertensi'][$k];
          $certainSumMembershipDegree['rendah']['td_diastol']['hipertensi'] = $certainSumMembershipDegree['rendah']['td_diastol']['hipertensi'] + $membershipDegree['td_diastol']['hipertensi'][$k];
          $certainSumMembershipDegree['rendah']['lingkar_perut']['kecil'] = $certainSumMembershipDegree['rendah']['lingkar_perut']['kecil'] + $membershipDegree['lingkar_perut']['kecil'][$k];
          $certainSumMembershipDegree['rendah']['lingkar_perut']['besar'] = $certainSumMembershipDegree['rendah']['lingkar_perut']['besar'] + $membershipDegree['lingkar_perut']['besar'][$k];
          $certainSumMembershipDegree['rendah']['bmi']['normal'] = $certainSumMembershipDegree['rendah']['bmi']['normal'] + $membershipDegree['bmi']['normal'][$k];
          $certainSumMembershipDegree['rendah']['bmi']['ow'] = $certainSumMembershipDegree['rendah']['bmi']['ow'] + $membershipDegree['bmi']['ow'][$k];
          $certainSumMembershipDegree['rendah']['merokok']['ya'] = $certainSumMembershipDegree['rendah']['merokok']['ya'] + $membershipDegree['merokok']['ya'][$k];
          $certainSumMembershipDegree['rendah']['merokok']['tdk'] = $certainSumMembershipDegree['rendah']['merokok']['tdk'] + $membershipDegree['merokok']['tdk'][$k];
          $certainSumMembershipDegree['rendah']['makanan_berlemak']['sering'] = $certainSumMembershipDegree['rendah']['makanan_berlemak']['sering'] + $membershipDegree['makanan_berlemak']['sering'][$k];
          $certainSumMembershipDegree['rendah']['makanan_berlemak']['jarang'] = $certainSumMembershipDegree['rendah']['makanan_berlemak']['jarang'] + $membershipDegree['makanan_berlemak']['jarang'][$k];
          $certainSumMembershipDegree['rendah']['k_gula']['>4sdm'] = $certainSumMembershipDegree['rendah']['k_gula']['>4sdm'] + $membershipDegree['k_gula']['>4sdm'][$k];
          $certainSumMembershipDegree['rendah']['k_gula']['<=4sdm'] = $certainSumMembershipDegree['rendah']['k_gula']['<=4sdm'] + $membershipDegree['k_gula']['<=4sdm'][$k];
          $certainSumMembershipDegree['rendah']['k_garam']['>1sdt'] = $certainSumMembershipDegree['rendah']['k_garam']['>1sdt'] + $membershipDegree['k_garam']['>1sdt'][$k];
          $certainSumMembershipDegree['rendah']['k_garam']['<=1sdt'] = $certainSumMembershipDegree['rendah']['k_garam']['<=1sdt'] + $membershipDegree['k_garam']['<=1sdt'][$k];
          $certainSumMembershipDegree['rendah']['olahraga']['ya'] = $certainSumMembershipDegree['rendah']['olahraga']['ya'] + $membershipDegree['olahraga']['ya'][$k];
          $certainSumMembershipDegree['rendah']['olahraga']['tdk'] = $certainSumMembershipDegree['rendah']['olahraga']['tdk'] + $membershipDegree['olahraga']['tdk'][$k];
          $certainSumMembershipDegree['rendah']['k_kafein']['tdk'] = $certainSumMembershipDegree['rendah']['k_kafein']['tdk'] + $membershipDegree['k_kafein']['tdk'][$k];
          $certainSumMembershipDegree['rendah']['k_kafein']['<=3sdt'] = $certainSumMembershipDegree['rendah']['k_kafein']['<=3sdt'] + $membershipDegree['k_kafein']['<=3sdt'][$k];
          $certainSumMembershipDegree['rendah']['k_kafein']['>3sdt'] = $certainSumMembershipDegree['rendah']['k_kafein']['>3sdt'] + $membershipDegree['k_kafein']['>3sdt'][$k];

        } elseif ($data_training[$k][12] == 2) {
          $certainSumMembershipDegree['sedang']['umur']['muda'] = $certainSumMembershipDegree['sedang']['umur']['muda'] + $membershipDegree['umur']['muda'][$k];
          $certainSumMembershipDegree['sedang']['umur']['tua'] = $certainSumMembershipDegree['sedang']['umur']['tua'] + $membershipDegree['umur']['tua'][$k];
          $certainSumMembershipDegree['sedang']['sex']['lk'] = $certainSumMembershipDegree['sedang']['sex']['lk'] + $membershipDegree['sex']['lk'][$k];
          $certainSumMembershipDegree['sedang']['sex']['pr'] = $certainSumMembershipDegree['sedang']['sex']['pr'] + $membershipDegree['sex']['pr'][$k];
          $certainSumMembershipDegree['sedang']['td_sistol']['normal'] = $certainSumMembershipDegree['sedang']['td_sistol']['normal'] + $membershipDegree['td_sistol']['normal'][$k];
          $certainSumMembershipDegree['sedang']['td_sistol']['prahipertensi'] = $certainSumMembershipDegree['sedang']['td_sistol']['prahipertensi'] + $membershipDegree['td_sistol']['prahipertensi'][$k];
          $certainSumMembershipDegree['sedang']['td_sistol']['hipertensi'] = $certainSumMembershipDegree['rendah']['td_sistol']['hipertensi'] + $membershipDegree['td_sistol']['hipertensi'][$k];
          $certainSumMembershipDegree['sedang']['td_diastol']['normal'] = $certainSumMembershipDegree['sedang']['td_diastol']['normal'] + $membershipDegree['td_diastol']['normal'][$k];
          $certainSumMembershipDegree['sedang']['td_diastol']['prahipertensi'] = $certainSumMembershipDegree['sedang']['td_diastol']['prahipertensi'] + $membershipDegree['td_diastol']['prahipertensi'][$k];
          $certainSumMembershipDegree['sedang']['td_diastol']['hipertensi'] = $certainSumMembershipDegree['sedang']['td_diastol']['hipertensi'] + $membershipDegree['td_diastol']['hipertensi'][$k];
          $certainSumMembershipDegree['sedang']['lingkar_perut']['kecil'] = $certainSumMembershipDegree['sedang']['lingkar_perut']['kecil'] + $membershipDegree['lingkar_perut']['kecil'][$k];
          $certainSumMembershipDegree['sedang']['lingkar_perut']['besar'] = $certainSumMembershipDegree['sedang']['lingkar_perut']['besar'] + $membershipDegree['lingkar_perut']['besar'][$k];
          $certainSumMembershipDegree['sedang']['bmi']['normal'] = $certainSumMembershipDegree['sedang']['bmi']['normal'] + $membershipDegree['bmi']['normal'][$k];
          $certainSumMembershipDegree['sedang']['bmi']['ow'] = $certainSumMembershipDegree['sedang']['bmi']['ow'] + $membershipDegree['bmi']['ow'][$k];
          $certainSumMembershipDegree['sedang']['merokok']['ya'] = $certainSumMembershipDegree['sedang']['merokok']['ya'] + $membershipDegree['merokok']['ya'][$k];
          $certainSumMembershipDegree['sedang']['merokok']['tdk'] = $certainSumMembershipDegree['sedang']['merokok']['tdk'] + $membershipDegree['merokok']['tdk'][$k];
          $certainSumMembershipDegree['sedang']['makanan_berlemak']['sering'] = $certainSumMembershipDegree['sedang']['makanan_berlemak']['sering'] + $membershipDegree['makanan_berlemak']['sering'][$k];
          $certainSumMembershipDegree['sedang']['makanan_berlemak']['jarang'] = $certainSumMembershipDegree['sedang']['makanan_berlemak']['jarang'] + $membershipDegree['makanan_berlemak']['jarang'][$k];
          $certainSumMembershipDegree['sedang']['k_gula']['>4sdm'] = $certainSumMembershipDegree['sedang']['k_gula']['>4sdm'] + $membershipDegree['k_gula']['>4sdm'][$k];
          $certainSumMembershipDegree['sedang']['k_gula']['<=4sdm'] = $certainSumMembershipDegree['sedang']['k_gula']['<=4sdm'] + $membershipDegree['k_gula']['<=4sdm'][$k];
          $certainSumMembershipDegree['sedang']['k_garam']['>1sdt'] = $certainSumMembershipDegree['sedang']['k_garam']['>1sdt'] + $membershipDegree['k_garam']['>1sdt'][$k];
          $certainSumMembershipDegree['sedang']['k_garam']['<=1sdt'] = $certainSumMembershipDegree['sedang']['k_garam']['<=1sdt'] + $membershipDegree['k_garam']['<=1sdt'][$k];
          $certainSumMembershipDegree['sedang']['olahraga']['ya'] = $certainSumMembershipDegree['sedang']['olahraga']['ya'] + $membershipDegree['olahraga']['ya'][$k];
          $certainSumMembershipDegree['sedang']['olahraga']['tdk'] = $certainSumMembershipDegree['sedang']['olahraga']['tdk'] + $membershipDegree['olahraga']['tdk'][$k];
          $certainSumMembershipDegree['sedang']['k_kafein']['tdk'] = $certainSumMembershipDegree['sedang']['k_kafein']['tdk'] + $membershipDegree['k_kafein']['tdk'][$k];
          $certainSumMembershipDegree['sedang']['k_kafein']['<=3sdt'] = $certainSumMembershipDegree['sedang']['k_kafein']['<=3sdt'] + $membershipDegree['k_kafein']['<=3sdt'][$k];
          $certainSumMembershipDegree['sedang']['k_kafein']['>3sdt'] = $certainSumMembershipDegree['sedang']['k_kafein']['>3sdt'] + $membershipDegree['k_kafein']['>3sdt'][$k];

        } elseif ($data_training[$k][12] == 3) {
          $certainSumMembershipDegree['tinggi']['umur']['muda'] = $certainSumMembershipDegree['tinggi']['umur']['muda'] + $membershipDegree['umur']['muda'][$k];
          $certainSumMembershipDegree['tinggi']['umur']['tua'] = $certainSumMembershipDegree['tinggi']['umur']['tua'] + $membershipDegree['umur']['tua'][$k];
          $certainSumMembershipDegree['tinggi']['sex']['lk'] = $certainSumMembershipDegree['tinggi']['sex']['lk'] + $membershipDegree['sex']['lk'][$k];
          $certainSumMembershipDegree['tinggi']['sex']['pr'] = $certainSumMembershipDegree['tinggi']['sex']['pr'] + $membershipDegree['sex']['pr'][$k];
          $certainSumMembershipDegree['tinggi']['td_sistol']['normal'] = $certainSumMembershipDegree['tinggi']['td_sistol']['normal'] + $membershipDegree['td_sistol']['normal'][$k];
          $certainSumMembershipDegree['tinggi']['td_sistol']['prahipertensi'] = $certainSumMembershipDegree['tinggi']['td_sistol']['prahipertensi'] + $membershipDegree['td_sistol']['prahipertensi'][$k];
          $certainSumMembershipDegree['tinggi']['td_sistol']['hipertensi'] = $certainSumMembershipDegree['tinggi']['td_sistol']['hipertensi'] + $membershipDegree['td_sistol']['hipertensi'][$k];
          $certainSumMembershipDegree['tinggi']['td_diastol']['normal'] = $certainSumMembershipDegree['tinggi']['td_diastol']['normal'] + $membershipDegree['td_diastol']['normal'][$k];
          $certainSumMembershipDegree['tinggi']['td_diastol']['prahipertensi'] = $certainSumMembershipDegree['tinggi']['td_diastol']['prahipertensi'] + $membershipDegree['td_diastol']['prahipertensi'][$k];
          $certainSumMembershipDegree['tinggi']['td_diastol']['hipertensi'] = $certainSumMembershipDegree['tinggi']['td_diastol']['hipertensi'] + $membershipDegree['td_diastol']['hipertensi'][$k];
          $certainSumMembershipDegree['tinggi']['lingkar_perut']['kecil'] = $certainSumMembershipDegree['tinggi']['lingkar_perut']['kecil'] + $membershipDegree['lingkar_perut']['kecil'][$k];
          $certainSumMembershipDegree['tinggi']['lingkar_perut']['besar'] = $certainSumMembershipDegree['tinggi']['lingkar_perut']['besar'] + $membershipDegree['lingkar_perut']['besar'][$k];
          $certainSumMembershipDegree['tinggi']['bmi']['normal'] = $certainSumMembershipDegree['tinggi']['bmi']['normal'] + $membershipDegree['bmi']['normal'][$k];
          $certainSumMembershipDegree['tinggi']['bmi']['ow'] = $certainSumMembershipDegree['tinggi']['bmi']['ow'] + $membershipDegree['bmi']['ow'][$k];
          $certainSumMembershipDegree['tinggi']['merokok']['ya'] = $certainSumMembershipDegree['tinggi']['merokok']['ya'] + $membershipDegree['merokok']['ya'][$k];
          $certainSumMembershipDegree['tinggi']['merokok']['tdk'] = $certainSumMembershipDegree['tinggi']['merokok']['tdk'] + $membershipDegree['merokok']['tdk'][$k];
          $certainSumMembershipDegree['tinggi']['makanan_berlemak']['sering'] = $certainSumMembershipDegree['tinggi']['makanan_berlemak']['sering'] + $membershipDegree['makanan_berlemak']['sering'][$k];
          $certainSumMembershipDegree['tinggi']['makanan_berlemak']['jarang'] = $certainSumMembershipDegree['tinggi']['makanan_berlemak']['jarang'] + $membershipDegree['makanan_berlemak']['jarang'][$k];
          $certainSumMembershipDegree['tinggi']['k_gula']['>4sdm'] = $certainSumMembershipDegree['tinggi']['k_gula']['>4sdm'] + $membershipDegree['k_gula']['>4sdm'][$k];
          $certainSumMembershipDegree['tinggi']['k_gula']['<=4sdm'] = $certainSumMembershipDegree['tinggi']['k_gula']['<=4sdm'] + $membershipDegree['k_gula']['<=4sdm'][$k];
          $certainSumMembershipDegree['tinggi']['k_garam']['>1sdt'] = $certainSumMembershipDegree['tinggi']['k_garam']['>1sdt'] + $membershipDegree['k_garam']['>1sdt'][$k];
          $certainSumMembershipDegree['tinggi']['k_garam']['<=1sdt'] = $certainSumMembershipDegree['tinggi']['k_garam']['<=1sdt'] + $membershipDegree['k_garam']['<=1sdt'][$k];
          $certainSumMembershipDegree['tinggi']['olahraga']['ya'] = $certainSumMembershipDegree['tinggi']['olahraga']['ya'] + $membershipDegree['olahraga']['ya'][$k];
          $certainSumMembershipDegree['tinggi']['olahraga']['tdk'] = $certainSumMembershipDegree['tinggi']['olahraga']['tdk'] + $membershipDegree['olahraga']['tdk'][$k];
          $certainSumMembershipDegree['tinggi']['k_kafein']['tdk'] = $certainSumMembershipDegree['tinggi']['k_kafein']['tdk'] + $membershipDegree['k_kafein']['tdk'][$k];
          $certainSumMembershipDegree['tinggi']['k_kafein']['<=3sdt'] = $certainSumMembershipDegree['tinggi']['k_kafein']['<=3sdt'] + $membershipDegree['k_kafein']['<=3sdt'][$k];
          $certainSumMembershipDegree['tinggi']['k_kafein']['>3sdt'] = $certainSumMembershipDegree['tinggi']['k_kafein']['>3sdt'] + $membershipDegree['k_kafein']['>3sdt'][$k];

        }
      }



      echo '<pre>' . var_export($item, true) . '</pre>';

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
}
?>

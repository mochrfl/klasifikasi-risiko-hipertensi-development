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
        $certainSumMembershipDegree[0][0] =0; //umur muda
        $certainSumMembershipDegree[0][1] =0; // umur tua
        $certainSumMembershipDegree[0][2] =0; //sex lk
        $certainSumMembershipDegree[0][3] =0; //sex pr
        $certainSumMembershipDegree[0][4] =0; //td_sistol normal
        $certainSumMembershipDegree[0][5] =0; //td_sistol prahipertensi
        $certainSumMembershipDegree[0][6] =0; //td_sistol hipertensi
        $certainSumMembershipDegree[0][7] =0; //td_distol normal
        $certainSumMembershipDegree[0][8] = 0; //td_distol prahipertensi
        $certainSumMembershipDegree[0][9] =0; //td_distol hipertensi
        $certainSumMembershipDegree[0][10] =0; //lingkar_perut kecil
        $certainSumMembershipDegree[0][11] = 0; //lingkar_perut besar
        $certainSumMembershipDegree[0][12] = 0; //bmi normal
        $certainSumMembershipDegree[0][13] = 0; //bmi ow
        $certainSumMembershipDegree[0][14] = 0; //merokok ya
        $certainSumMembershipDegree[0][15] = 0; //merokok tidak
        $certainSumMembershipDegree[0][16] = 0; //makanan_berlemak sering
        $certainSumMembershipDegree[0][17] = 0; //makanan_berlemak jarang
        $certainSumMembershipDegree[0][18] = 0; //k_gula >4sdm
        $certainSumMembershipDegree[0][19] = 0; //k_gula <=4sdm
        $certainSumMembershipDegree[0][20] = 0; //k_garam >1sdt
        $certainSumMembershipDegree[0][21] = 0; //k_garam <=1sdt
        $certainSumMembershipDegree[0][22] = 0; //olahraga ya
        $certainSumMembershipDegree[0][23] = 0; //olahraga tidak
        $certainSumMembershipDegree[0][24] = 0; //kafein tdk
        $certainSumMembershipDegree[0][25] = 0; //kafein <=3sdt
        $certainSumMembershipDegree[0][26] = 0; //kafein >3sdt

//sedang
        $certainSumMembershipDegree[1][0] =0; //umur muda
        $certainSumMembershipDegree[1][1] =0; // umur tua
        $certainSumMembershipDegree[1][2] =0; //sex lk
        $certainSumMembershipDegree[1][3] =0; //sex pr
        $certainSumMembershipDegree[1][4] =0; //td_sistol normal
        $certainSumMembershipDegree[1][5] =0; //td_sistol prahipertensi
        $certainSumMembershipDegree[1][6] =0; //td_sistol hipertensi
        $certainSumMembershipDegree[1][7] =0; //td_distol normal
        $certainSumMembershipDegree[1][8] = 0; //td_distol prahipertensi
        $certainSumMembershipDegree[1][9] =0; //td_distol hipertensi
        $certainSumMembershipDegree[1][10] =0; //lingkar_perut kecil
        $certainSumMembershipDegree[1][11] = 0; //lingkar_perut besar
        $certainSumMembershipDegree[1][12] = 0; //bmi normal
        $certainSumMembershipDegree[1][13] = 0; //bmi ow
        $certainSumMembershipDegree[1][14] = 0; //merokok ya
        $certainSumMembershipDegree[1][15] = 0; //merokok tidak
        $certainSumMembershipDegree[1][16] = 0; //makanan_berlemak sering
        $certainSumMembershipDegree[1][17] = 0; //makanan_berlemak jarang
        $certainSumMembershipDegree[1][18] = 0; //k_gula >4sdm
        $certainSumMembershipDegree[1][19] = 0; //k_gula <=4sdm
        $certainSumMembershipDegree[1][20] = 0; //k_garam >1sdt
        $certainSumMembershipDegree[1][21] = 0; //k_garam <=1sdt
        $certainSumMembershipDegree[1][22] = 0; //olahraga ya
        $certainSumMembershipDegree[1][23] = 0; //olahraga tidak
        $certainSumMembershipDegree[1][24] = 0; //kafein tdk
        $certainSumMembershipDegree[1][25] = 0; //kafein <=3sdt
        $certainSumMembershipDegree[1][26] = 0; //kafein >3sdt

//tinggi
        $certainSumMembershipDegree[2][0] =0; //umur muda
        $certainSumMembershipDegree[2][1] =0; // umur tua
        $certainSumMembershipDegree[2][2] =0; //sex lk
        $certainSumMembershipDegree[2][3] =0; //sex pr
        $certainSumMembershipDegree[2][4] =0; //td_sistol normal
        $certainSumMembershipDegree[2][5] =0; //td_sistol prahipertensi
        $certainSumMembershipDegree[2][6] =0; //td_sistol hipertensi
        $certainSumMembershipDegree[2][7] =0; //td_distol normal
        $certainSumMembershipDegree[2][8] = 0; //td_distol prahipertensi
        $certainSumMembershipDegree[2][9] =0; //td_distol hipertensi
        $certainSumMembershipDegree[2][10] =0; //lingkar_perut kecil
        $certainSumMembershipDegree[2][11] = 0; //lingkar_perut besar
        $certainSumMembershipDegree[2][12] = 0; //bmi normal
        $certainSumMembershipDegree[2][13] = 0; //bmi ow
        $certainSumMembershipDegree[2][14] = 0; //merokok ya
        $certainSumMembershipDegree[2][15] = 0; //merokok tidak
        $certainSumMembershipDegree[2][16] = 0; //makanan_berlemak sering
        $certainSumMembershipDegree[2][17] = 0; //makanan_berlemak jarang
        $certainSumMembershipDegree[2][18] = 0; //k_gula >4sdm
        $certainSumMembershipDegree[2][19] = 0; //k_gula <=4sdm
        $certainSumMembershipDegree[2][20] = 0; //k_garam >1sdt
        $certainSumMembershipDegree[2][21] = 0; //k_garam <=1sdt
        $certainSumMembershipDegree[2][22] = 0; //olahraga ya
        $certainSumMembershipDegree[2][23] = 0; //olahraga tidak
        $certainSumMembershipDegree[2][24] = 0; //kafein tdk
        $certainSumMembershipDegree[2][25] = 0; //kafein <=3sdt
        $certainSumMembershipDegree[2][26] = 0; //kafein >3sdt

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
for ($i=0; $i < count($certainSumMembershipDegree[0]); $i++) {
    $x = 0;
    for ($j=0; $j < count($certainSumMembershipDegree); $j++) {
        $x += -(($certainSumMembershipDegree[$j][$i]/$sumMembershipDegree[$i])*log(($certainSumMembershipDegree[$j][$i]/$sumMembershipDegree[$i]),2));
    }
    $total[$i] =$x;
    echo "Total atribut " + $total[$i];
}












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

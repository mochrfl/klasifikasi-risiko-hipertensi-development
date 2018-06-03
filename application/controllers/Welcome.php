<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Jadi di controller pisah jadi beberapa route,
	 *
	 * yang pertama route buat nampilin data latih dan testing,
	 *  - halaman daftar data
	 *  - route post import data ke db (kalau mau dibikin crud pake form bisa tp ribet, jgn)
	 *
	 * route buat setting
	 *  - ini route buat nyimpan rules dlm bentuk json. langsung json aja satu input form biar gampang.
	 *    (kalau pingin ribet bikin form input banyak, tp nanti sebelum save ke db atur jadi json array, jgn sampai salah format)
	 *
	 * route buat pelatihan
	 *  - route buat ngitung fuzzy dari data yg udah ada di db,
	 *    terus hasil tree-rules nya simpen di db,
	 *    terus hasilnya di print di layar (route index dibawah ini)
	 *
	 * route pengujian
	 *  - route ini cuman bisa kalo data tree-rules di db udah ada.
	 *    buat pengujian.
	 *    terus ditampilin data pengujiannya.
	 */
	public function index()
	{
		//ini proses perhitungan fuzzy disini
		$fuzzy = $this->data_model->get_fuzzy();


		$data_fuzzys = $fuzzy->arrayFuzzy();
		$tree = $fuzzy->printTree();
		$array_tree = json_encode($fuzzy->arrayTree());

		//ini dipisah jadi route pengujian sendiri yak
		$pengujian = $this->data_model->pengujian();

		$this->load->view('welcome_message', compact("data_fuzzys", "tree", "array_tree", "pengujian"));
	}
}

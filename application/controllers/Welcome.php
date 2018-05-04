<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$fuzzy = $this->data_model->get_fuzzy();

		$data_fuzzys = $fuzzy->arrayFuzzy();
		$tree = $fuzzy->printTree();
		$array_tree = json_encode($fuzzy->arrayTree());

		$this->load->view('welcome_message', compact("data_fuzzys", "tree", "array_tree"));
	}
}

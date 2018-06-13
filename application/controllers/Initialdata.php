<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Initialdata extends CI_Controller {
    public function index()
    {

        $data['data_training'] = $this->data_model->get_all_data_training();
        $data['data_testing'] = $this->data_model->get_all_data_testing();
        $this->load->view('user/list_data', array('data_training' => $data['data_training'],
                                             'data_testing' => $data['data_testing']));
    }
}

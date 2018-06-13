<?php

class Initialthreshold_model extends CI_model {

  public function __construct() {
		parent::__construct();
	}

  public function get_all_initial_threshold()
  {
    $this->db->select('*');
    $this->db->from('tb_initialthreshold');
    $query = $this->db->get();

    return $query->result();
  }
}

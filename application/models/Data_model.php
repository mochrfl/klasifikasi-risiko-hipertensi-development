<?php

class Data_model extends CI_model {

  public function __construct() {
		parent::__construct();
	}

	public function get_all_data_training()
	{
    $this->db->select('*');
    $this->db->from('tb_data_training');
    $query = $this->db->get();

    return $query->result();
	}

  public function get_all_rule()
	{
    $this->db->select('*');
    $this->db->from('tb_rule');
    $query = $this->db->get();

    return $query->result();
	}
}

<?php
class Behaviour_mdl extends CI_Model
{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_behaviour_list(){
		$this->db->select("*");
		$this->db->from("behaviour");
		$this->db->order_by("behaviour_id","desc");
		$q=$this->db->get();

		return $q->result();
	}


	function add_behaviour($data){
		$d=array(
				 "description"=>$this->db->escape_like_str($data->behname),
				 "active_flag"=>1
				);

		return $this->db->insert("behaviour",$d);
	}

	public function update_behaviour($data){
		$chkbehid = $this->db->escape_like_str($data->behid);
		$d=array(
				 "description"=>$this->db->escape_like_str($data->behname),
				 "active_flag"=>$this->db->escape_like_str($data->activestatus)
				);

		return $this->db->update("behaviour",$d,array("behaviour_id"=>$chkbehid));
	}
}
?>
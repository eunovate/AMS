<?php
class Notification_mdl extends CI_Model{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//get noti data
	function get_user_noti_count($userid){
		$id = $this->db->escape_like_str($userid);

		$this->db->select("*");
		$this->db->from("notification");
		$array = array('user_id' => $id, 'seen' => 0);
		$this->db->where($array);

		return $this->db->count_all_results();
	}

	//get notify list
	function get_notify_list($userid){
		$id = $this->db->escape_like_str($userid);

		//get noti data list
		$this->db->select("*");
		$this->db->from("notification");
		$array = array('user_id' => $id);
		$this->db->where($array);
		$q = $this->db->get();

		return $q->result();
	}

	
	//update notify seen status
	function notify_status($userid){
		$id = $this->db->escape_like_str($userid);
		//update seen status
		$statusdata=array(
				 "seen"=>1
				);
		$array = array('user_id' => $id);
		$this->db->where($array);
		return $this->db->update("notification",$statusdata);
	}
}
?>
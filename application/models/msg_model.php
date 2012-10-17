<?php
/**
 * 用户信息模块
 *
 *
 */
class Msg_model extends Model
{

    var $uid;
    
	var $subject;

	function __construct()
    {
        parent::Model();
    }

	// --------------------------------------------------------------------

    /**
	 * 添加新信息
	 *
	 *
	 */	
	function create()
    { 
		$datetime = time();
        $this->db->set('subject', $this->subject);
		$this->db->set('uid', $this->uid);				
		$this->db->set('dateline', $datetime);
        $this->db->set('lastline', $datetime);
        $this->db->insert('message');
        $mid = $this->db->insert_id();
        $this->db->set('mid', $mid);
        $this->db->set('is_new', '1');
        $this->db->set('num', '1');
        $this->db->set('uid', $this->uid);
        $this->db->set('dateline', $datetime);
        $this->db->set('lastline', $datetime);
        $this->db->insert('message_user');
    }

	// --------------------------------------------------------------------

    /**
	 * load by id
	 *
	 *
	 */	
    function load($id)
    {
        if (!$id){
            return array();
        }

        $query = $this->db->get_where('user',array('id' => $id));

        if ($row = $query->row_array()){
            return $row;
        }

        return array();
    }
	
    // --------------------------------------------------------------------

    /**
	 * 获取用户全部信息
	 *
	 *
	 */	
	function msglist($uid)
    {
        $sql = "select m.*,p.* from fy_message m,fy_message_user p where m.mid=p.mid and m.uid=p.uid and m.uid=".$uid."";
        $data = $this->db->query($sql)->result_array();
		return $data;
    }


	// --------------------------------------------------------------------

    /**
	 * 更新最后登录时间
	 *
	 *
	 */	
    function update_last_login($customer_id)
	{
		$datetime = time();
		$this->db->set('last_login', $datetime);	
        $this->db->where('id', $customer_id);
        return $this->db->update('user');
	}
}

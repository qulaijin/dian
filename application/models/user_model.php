<?php
/**
 * 客户
 *
 *
 */
class User_model extends Model
{

    var $name;
    
	var $email;

	var $password;

	var $dob;
    
    var $is_sendemail;

	var $password_auto;

	function __construct()
    {
        parent::Model();
    }

	// --------------------------------------------------------------------

    /**
	 * 添加新客户
	 *
	 *
	 */	
	function create()
    { 
		$datetime = time();
        $this->db->set('username', $this->name);
		$this->db->set('email', $this->email);
		$this->db->set('password', md5($this->password));					
		$this->db->set('rtime', $datetime);
		$this->db->set('updated', $datetime);
        $this->db->set('last_login', $datetime);
        return $this->db->insert('user');
    }

    // --------------------------------------------------------------------

    /**
	 * 查询该用户名是否存在
	 *
	 *
	 */	
	function check_name($name)
	{
		$query = $this->db->get_where('user',array('username' => $name));
        if ($row = $query->row_array()){
            return true;
        }
        return false;
	}
    
	// --------------------------------------------------------------------

    /**
	 * 查询该邮箱是否存在
	 *
	 *
	 */	
	function check_email($email)
	{
		$query = $this->db->get_where('user',array('email' => $email));
        if ($row = $query->row_array()){
            return true;
        }
        return false;
	}

   // --------------------------------------------------------------------

    /**
	 * 查询该用户，返回用户信息
	 *
	 *
	 */	
	function check_customer()
	{
        $query = $this->db->get_where('user',array('username' => $this->username,'password' => md5($this->password)));
        if ($row = $query->row_array()){			
            return $row;
        }
        return array();
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
	 * 更新客户信息
	 *
	 *
	 */	
	function update($id)
    {
        $datetime = time();
        if(!empty($this->password)){
        	$this->db->set('password', md5($this->password));
        }
		$this->db->set('email', $this->email);
		$this->db->set('company', $this->company);
		$this->db->set('postcode', $this->postcode);
		$this->db->set('person', $this->person);
		$this->db->set('mobile', $this->mobile);
		$this->db->set('tel', $this->tel);
		$this->db->set('fax', $this->fax);
		$this->db->set('qq', $this->qq);
		$this->db->set('pemail', $this->pemail);
		$this->db->set('website', $this->website);
		$this->db->set('companydesc', $this->companydesc);
		$this->db->set('address', $this->address);
		$this->db->set('updated', $datetime);
		
        $this->db->where('id', $id);
        return $this->db->update('user');
    }

    // --------------------------------------------------------------------

    /**
	 * 查询密码是否正确
	 *
	 *
	 */	
    function check_pwd($password)
	{
		$query = $this->db->get_where('user',array('password' => md5($password)));
        if ($row = $query->row_array()){
            return true;
        }
        return false;
	}
    
	// --------------------------------------------------------------------

    /**
	 * 更新密码
	 *
	 *
	 */	
	function update_pwd($id,$pwd)
    {
		$this->db->set('password', md5($pwd));	
        $this->db->where('id', $id);
        return $this->db->update('user');
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

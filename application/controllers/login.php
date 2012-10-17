<?php
/**
 * 登陆，注册，注销
 *
 *
 */
class Login extends Controller
{
	function __construct()
    {
        parent::Controller();
        $this->load->model('user_model');  
    }
   
    
    // --------------------------------------------------------------------

    /**
	 * 登陆，注册 界面
	 *
	 *
	 */	
    function index()
    { 
		
	    $data = array();
	    $data['title'] = '用户登录';

		$data['error_msg'] = $this->uri->segment(3, 0);
		$data['url'] = 'login';
	    $this->load->view('user/login',$data);
    }
    
 
	// --------------------------------------------------------------------

    /**
	 * 登陆
	 *
	 *
	 */	
	function check_customer()
	{
        $name = $this->input->post('username');
		$password = $this->input->post('password');	          
        $this->user_model->username = $name;
		$this->user_model->password = $password;
		$_customer = $this->user_model->check_customer();
		if ($_customer){
			$customer = array(
				   'user_name'  => $_customer['username'],
				   'user_id'  => $_customer['id'],
				   'user_in' => TRUE,
				   'user_last_login' => $_customer['last_login']
			   );
			$this->session->set_userdata($customer);
            
			$this->user_model->update_last_login($_customer['id']);
			//redirect('home');
			show_message('登陆成功!', 'user/home');
		}else{
            show_message('请登录!', 'login/index/loginerror');
            
		}
	}

	
    /**
	 * 注册
	 *
	 *
	 */	
    function regist()
    {
       $data = array();
	   $data['title'] = '用户注册';
	   $data['error_msg'] = $this->uri->segment(3, 0);
	   $data['url'] = 'regist';
	   $this->load->view('user/regist',$data);
    }
    
	/**
	 * 注册生成验证码
	 *
	 *
	 */	
	function verify()
	{
		$this->load->helper('captcha');
		code();
	}
	
	   /**
	 * 验证名字是否已存在 ajax
	 *
	 *
	 */		
	function check_name()
	{
		$qs = query_string_to_array();
	    $name = $qs['username'];
		$msg = array('Result' => 1);
		if ($name){
		    if ($this->user_model->check_name($name)){
				$msg = array('Result' => 0);
			}				
		}
        echo $msg['Result'];
		//echo json_encode($msg);
	}
	
	 // --------------------------------------------------------------------

    /**
	 * 验证邮箱是否已存在 ajax
	 *
	 *
	 */	
	function check_email()
	{
        $qs = query_string_to_array();
	    $email = $qs['email'];
		$msg = array('Result' => 1);
		if ($email){
		    if ($this->user_model->check_email($email)){
				$msg = array('Result' => 0);
			}				
		}
        
		 echo $msg['Result'];
	}
	 /**
	 * 检查注册验证码是否准确
	 *
	 *
	 */	
	function check_verify()
	{
		session_start();
		$qs = query_string_to_array();
        $Verifier = $qs['verify'];
        $msg = array('Result' => 1);
        if ($_SESSION['verify'] !== $Verifier){
			$msg = array('Result' => 0);
		}
		 echo $msg['Result'];
	}


		// --------------------------------------------------------------------

    /**
	 * 检查注册验证码是否准确
	 *
	 *
	 */	
	function _check_yzm()
	{
		session_start();
        $Verifier = $this->input->post('verify');
        if ($_SESSION['verify'] == $Verifier){
			//
		}else{
			redirect('regist/');
		}
		return;
	}	
	
	
	 /**
	 * 保存注册信息
	 *
	 *
	 */	
	function save()
	{
        $this->_check_yzm();

		$name = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
        $this->load->library('validation');
        $this->set_save_form_rules();
		if (TRUE == $this->validation->run()){           
            $this->user_model->name = $name;
		    $this->user_model->email = $email;
		    $this->user_model->password = $password;
			$this->user_model->create();
            $customer_id = $this->db->insert_id();
			$customer = array(
                   'user_name'  => $name,
				   'user_id'  => $customer_id,
                   'user_in' => TRUE
               );
            $this->session->set_userdata($customer);
			show_message('注册成功!', 'home');
		}else{
            show_message('请登录!', 'login');
		}
	}
    
    
        
	// --------------------------------------------------------------------

    /**
	 * 注册验证规则
	 *
	 *
	 */	
	function set_save_form_rules()
    {
        $rules['username'] = 'required|min_length[4]|max_length[20]|alpha_dash';	
		$rules['password'] = 'required|min_length[6]|max_length[16]|alpha_dash';	
		$rules['email'] = 'required|valid_email';	
		$this->validation->set_rules($rules);		
    }
    
	// --------------------------------------------------------------------

    /**
	 * 登出
	 *
	 *
	 */	
	function logout()
	{
		$this->session->sess_destroy();
		show_message('退出成功!', 'home');
	}


}

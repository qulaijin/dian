<?php
/**
 * 用户中心 > 个人信息
 *
 *
 */
class Home extends Controller
{
	function __construct()
    {
        parent::Controller();
        $this->load->model('user_model');
		if (!$this->session->userdata('user_in')){          		
			redirect('login');
			exit();
		}
    }
   
    function index()
    {      
       $data = array();
	   $data['title'] = '用户中心';
	   $data['userinfo'] = $this->user_model->load($this->session->userdata('user_id'));
	   $data['url'] = 'home';
	   $this->load->view('user/home',$data);
    }
    
	// --------------------------------------------------------------------


}
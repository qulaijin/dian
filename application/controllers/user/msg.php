<?php
/**
 * 用户中心 > 首页
 *
 *
 */
class Msg extends Controller
{
	function __construct()
    {
        parent::Controller();
		if (!$this->session->userdata('user_in')){          		
			//show_message('请登陆!', 'login');
			redirect('login');
			die();
		}
		 $this->load->model('user_model');
		 $this->load->model('msg_model');
    }
   

    function index()
    {
      
       $data = array();
	   $data['title'] = '用户短消息';
		$data['url'] = 'msg';
	   $data['userinfo'] = $this->user_model->load($this->session->userdata('user_id'));
	   $data['msglist'] = $this->msg_model->msglist($this->session->userdata('user_id'));
	   
	   $this->load->view('user/msg',$data);
    }
	
	
	function save(){
		$subject = $this->input->post('subject');
		if(strlen($subject) < 15){
			show_message('消息错误!', 'user/msg');
		}else{
			$uid = $this->session->userdata('user_id');
			$this->msg_model->subject = $subject;
			$this->msg_model->uid = $uid;
			$this->msg_model->create();
			show_message('发送成功!', 'user/msg');
		}
	}

}

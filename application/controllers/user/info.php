<?php
/**
 * 用户中心 > 个人信息
 *
 *
 */
class Info extends Controller
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
	   $data['title'] = '个人资料';
	   $data['userinfo'] = $this->user_model->load($this->session->userdata('user_id'));
	   $data['url'] = 'uinfo';
	   $this->load->view('user/info',$data);
    }
    
	// --------------------------------------------------------------------

    /**
	 * 提交数据
	 *
	 *
	 */	
	function save()
	{
		$password = $this->input->post('password');
		$company = $this->input->post('company');
		$person = $this->input->post('person');
	    $qq = $this->input->post('qq');
		$pemail = $this->input->post('pemail');
		$email = $this->input->post('email');
		$tel = $this->input->post('tel');
		$fax = $this->input->post('fax');
		$mobile = $this->input->post('mobile');
		$address = $this->input->post('address');
		$postcode = $this->input->post('postcode');
		$website = $this->input->post('website');
		$companydesc = $this->input->post('companydesc');
		     
		$this->user_model->password = $password;
		$this->user_model->company = $company;
		$this->user_model->mobile = $mobile;
		$this->user_model->person = $person;
		$this->user_model->email = $email;
		$this->user_model->qq = $qq;
		$this->user_model->tel = $tel;
		$this->user_model->fax = $fax;
		$this->user_model->address = $address;
		$this->user_model->postcode = $postcode;
		$this->user_model->website = $website;
		$this->user_model->companydesc = $companydesc;	
		$this->user_model->pemail = $pemail;		
		$this->user_model->update($this->session->userdata('user_id'));
		redirect('user/info');
	}

}
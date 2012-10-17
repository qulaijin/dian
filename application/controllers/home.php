<?php
/**
 * 首页
 *
 *
 */
class Home extends Controller
{
	function __construct()
    {
        parent::Controller();		
    }
   

    function index()
    {    
       $data = array();
	   $data['title'] = 'index首页';
	   $data['url'] = 'home';
	   $this->load->view('index',$data);
    }
}

?>
<?php
/**
 * 
 *
 */
class Search extends Controller
{

    /**
	 * 构造函数
	 *
	 *
	 */	
	function __construct()
    {
        parent::Controller();
		$this->load->model('search_model');
    }

    // --------------------------------------------------------------------

    /**
	 * 订单界面
	 *
	 *
	 */	
    function  index()
	{
       $data = array();
	   $data['title'] = '搜索结果';
	   $qs = query_string_to_array();
	   $key = $qs['keyword'];
	  // $this->load->view('search',$data);
	  echo $key;
	}
    
    
    function sresult(){
    	$key = $this->input->post('keyword');
    	
	  	$this->load->view('search',$data);
    }
	// --------------------------------------------------------------------

    /**
	 * 前台匹配
	 *
	 * ajax
	 */		
	function dosync()
	{
		$qs = query_string_to_array();
	    $key = $qs['q'];
	    $result = $this->search_model->fresult($key);
	    if($result){
				for($i=0;$i<count($result);$i++){
					echo $result[$i]['name']."\n";
			
				}
			}else{
				echo "暂无结果";
			}
	}
    
	
    
}
   
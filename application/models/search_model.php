<?php
/**
 * 搜索模块
 *
 *
 */
class Search_model extends Model
{

    var $keyword;

	function __construct()
    {
        parent::Model();
    }
    
	// --------------------------------------------------------------------

    /**
	 * 查询关键词
	 *
	 *
	 */	
    function fresult($keyword,$pagenum="10",$exnum="0")
	{
		
		$this->db->set('name', $keyword);	
        $sql = "select * from ".$this->db->dbprefix."products where name like '%".$keyword."%' limit 0,".$pagenum."";
        $data = $this->db->query($sql)->result_array();
		return $data;
	}
	
	// --------------------------------------------------------------------

    /**
	 * ajax查询关键词
	 *
	 *
	 */	
	 
	function sproduct($keyword,$pagenum="10",$exnum="0"){
		$this->db->set('name',$keyword);
		$sql = "select * from ".$this->db->dbprefix."products where name like '%".$keyword."%' limit 0,".$pagenum."";
        $data = $this->db->query($sql)->result_array();
		return $data;
		
	}
	
	// --------------------------------------------------------------------

    /**
	 * 查询关键词
	 *
	 *
	 */	
	
}

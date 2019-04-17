<?php
Class apiGetUser{

      private $config;     //配置

	  private $accessToken;

	  public function __construct($obj){
	  		 $this->config = $obj;
	  }	

	  //获取部门用户详情
	  public function getListByPage($accessToken = "",$deptId,$offset=0,$size=100){

	  		 if(!$accessToken){
	  		 	 $accessToken = $this->accessToken;
	  		 }

	  		 $data = ['access_token'=>$accessToken,"department_id"=>$deptId,"offset"=>$offset,"size"=>$size];
             $deptUserInfo = $this->config->get("user/listbypage",$data);

	  	     return $deptUserInfo;
	  }	
	  
	  function __set($property_name, $value)
	  { 
	        $this->$property_name = $value; 
	  }		    
}
?>
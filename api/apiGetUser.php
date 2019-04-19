<?php
Class apiGetUser{

      private $config;     //配置

	  private $accessToken;

	  private $code;

	  private $userId;

	  private $offset;

	  private $deptId;

	  private $size;

	  public function __construct($obj){
	  		 $this->config = $obj;
	  }	

	  public function setAccessToken($accessToken){
	  	     $this->accessToken = $accessToken;
	  }

	  public function setCode($code){
	  	     $this->code = $code;
	  }

	  public function setUserId($userId){
	  	     $this->userId = $userId;
	  }

	  public function setOffSet($offset){
	  	     $this->offset = $offset;
	  }

	  public function setDeptId($deptId){
	  	     $this->deptId = $deptId;
	  }

	  public function setSize($size){
	  	     $this->size = $size;
	  }
	  //获取用户userid
	  
	  public function getUserId(){

	  	     return   $this->config->get("user/getuserinfo",["access_token"=>$this->access_token,"code"=>$this->code]);

	  }

	  //获取用户详情
	  
	  public function getUserInfo(){
             
             return   $this->config->get("user/get",["access_token"=>$this->access_token,"userid"=>$this->userId]);
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
}
?>
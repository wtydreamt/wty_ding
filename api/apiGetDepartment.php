<?php
Class apiGetDepartment{

      private $config;     //配置

	  private $accessToken;

	  private $scopes;

	  public function __construct($obj){
	  		 $this->config = $obj;
	  }	

	  //获取通讯授权范围
	  
	  public function getScopes($accessToken = ""){
	  		if(!$accessToken){
	  		 	$accessToken = $this->accessToken;
	  		}
            $scopes = $this->config->get("auth/scopes",['access_token'=>$accessToken]);
            $this->scopes = $scopes;
            return $scopes;
	  }

	  //获取子部门id列表

	  public function getDeptIdsList($accessToken="",$id="1"){
	  		if(!$accessToken){
	  		 	$accessToken = $this->accessToken;
	  		}  
	  		return $scopes = $this->config->get("department/list_ids",['access_token'=>$accessToken,"id"=>$id]);         
	  }

	  //获取部门列表
	  
	  public function getDeptList($accessToken="",$id="1",$fetch_child=false){
	  		 if(!$accessToken){
	  		 	 $accessToken = $this->accessToken;
	  		 }  
	  		 return $scopes = $this->config->get("department/list",['access_token'=>$accessToken,"id"=>$id,"fetch_child"=>$fetch_child]);
	  }

	  //获取部门详情
	  
	  public function getDeptInfo($accessToken="",$id="1"){

	  		 if(!$accessToken){
	  		 	 $accessToken = $this->accessToken;
	  		 }

	  		 return $scopes = $this->config->get("department/get",['access_token'=>$accessToken,"id"=>$id]);
	  }

	  //部门数据整理
	  
	  public function deptInfoData(){

	  		$scopes = $this->scopes;

	  		if(!$scopes){
	  			echo "先获取企业通讯录授权范围";exit();
	  		}

	  		$dept_info = [];
	  		$dept_list = [];
	  		$auth_user_field = [];

	  		if($scopes->errcode == "0"){

	  		 	$authed_dept = $scopes->auth_org_scopes->authed_dept;

	  		 	$authed_user = $scopes->auth_org_scopes->authed_user;

	  		 	$auth_user_field = $scopes->auth_user_field;

	  		 	foreach($authed_dept as $key=>$val){

	  		        $dept_list[$val] = $this->getDeptList("",$val);

	  		 	}

			  	foreach($dept_list as $key=>$val){

				    $dept_info[$key] = $this->getDeptInfo("",$key);	

				    if(!empty($val->department)){
				    	foreach($val->department as $vkey=>$v){
				    		$dept_info[$v->id] = $this->getDeptInfo("",$v->id);
				    	}
				    }
			  	}

			  	return ['authed_dept'=>$dept_info,"auth_user_field"=>$auth_user_field,"authed_user"=>$authed_user];
	  		 }
	  }

	  function __set($property_name, $value)
	  { 
	        $this->$property_name = $value; 
	  }	  
}
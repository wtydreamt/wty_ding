<?php
Class apiReturn{

      private $config;        //配置

	  private $accessToken;   //企业授权令牌

	  private $call_back_tag; //监听事件类型

	  private $token;         //加解密需要用到的token，ISV(服务提供商)推荐使用注册套件时填写的token，普通企业可以随机填写

	  private $aes_key;       //数据加密密钥。用于回调数据的加密，长度固定为43个字符，从a-z, A-Z, 0-9共62个字符中选取,您可以随机生成，ISV(服务提供商)推荐使用注册套件时填写的EncodingAESKey
	  private $url;           //接收事件回调的url，必须是公网可以访问的url地址

	  public function __construct($obj){
	  		 $this->config = $obj;
	  }		

	  public function setAccessToken($accessToken){
	  	     $this->accessToken = $accessToken;
	  }

	  public function setCallBackTagOne($call_back_tag){
	  	     $this->call_back_tag = $call_back_tag;
	  }

	  public function setToken($token){
	  	     $this->token = $token;
	  }

	  public function setAesKey($aes_key){
	  	     $this->aes_key = $aes_key;
	  }

	  public function setUrl($url){
	  		 $this->url = $url;
	  }

	  //设置	全部的回调事件
	  
	  public function setCallBackTagAll(){
              $this->call_back_tag =[
              "user_add_org",
              "user_modify_org",
              "user_leave_org",
              "org_admin_add",
              "org_admin_remove",
              "org_dept_create",
              "org_dept_modify",
              "org_dept_remove",
              "org_remove",
              "org_change",
              "bpms_task_change",
              "bpms_instance_change"
             ]
	  }

	  //回调地址注册
	  
	  public function register_call_back(){

	  	     $data = ['call_back_tag'=>$this->call_back_tag,"token"=>$this->token,"aes_key"=>$this->aes_key,"url"=>$this->url];

	  	     $str_data = json_encode($data);

             return $scopes = $this->config->post("call_back/register_call_back",['access_token'=>$this->accessToken],$str_data);

	  }  

	  //回调地址查询
	  
	  public function get_call_back(){

	  	     return $scopes = $this->config->get("call_back/get_call_back",['access_token'=>$this->accessToken]);
	  }

	  //回调地址更新
	  
	  public function update_call_back(){

	  	     $data = ['call_back_tag'=>$this->call_back_tag,"token"=>$this->token,"aes_key"=>$this->aes_key,"url"=>$this->url];

	  	     $str_data = json_encode($data);

             return $scopes = $this->config->post("call_back/update_call_back",['access_token'=>$this->accessToken],$str_data);	  	
	  }

	  //删除回调事件
	  
	  public function delete_call_back(){

	  		 return $scopes = $this->config->get("call_back/delete_call_back",['access_token'=>$this->accessToken]);

	  }
}
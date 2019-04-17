<?php
Class apiGetCorpToken{

	  private $config;     //配置

	  private $accessKey;  //应用的suiteKey

	  private $timestamp;  //当前时间戳，单位是毫秒

	  private $suiteTicket;//钉钉推送的suiteTicket，测试应用可以随便填写

	  private $signature;  //以timestamp+"\n"+suiteTicket为签名的字符串

	  private $auth_corpid;//授权企业方corpId,组装为JSON结构置于http post body部分

	  private $agentid;

	  public function __construct($obj){
	  		 $this->config = $obj;
	  }	
	  
	  //获取授权令牌
	  public function getCorpToken(){
             
             $url_parameter = $this->getParameter();

             return $this->config->post("service/get_corp_token",$url_parameter,json_encode(["auth_corpid"=>$this->auth_corpid]));
	  }  

	  //获取授权信息
	  public function getAuthInfo(){
             
			 $url_parameter = $this->getParameter();

             return $this->config->post("service/get_auth_info",$url_parameter,json_encode(["auth_corpid"=>$this->auth_corpid]));
	  }

	  //获取授权应用信息
	  public function getAgentInfo(){

	  	     $url_parameter = $this->getParameter();

	  	     $data = ["auth_corpid"=>$this->auth_corpid,"suite_key"=>$this->accessKey,"agentid"=>$this->agentid];

             return $this->config->post("service/get_agent",$url_parameter,json_encode($data));	  	
	  }

	  public function getParameter(){

             $accessKey = $this->config->obj->getAccessKey();

             if(!$this->accessKey){
             	 $this->accessKey = $accessKey;
             }

             return ["accessKey"  =>$this->accessKey,
                     "timestamp"  =>$this->timestamp,
                     "suiteTicket"=>$this->suiteTicket,
                     "signature"  =>$this->signature];	  	
	  }

	  public function setSignature(){

             $parameter  = $this->timestamp."\n".$this->suiteTicket;

             $key = $this->config->obj->getSuiteSecret();

	  	     $this->signature = $this->config->obj->HmacSHA256($parameter,$key);

	  }

	  function __set($property_name, $value)
	  { 
	        $this->$property_name = $value; 
	  }

}
?>
<?php
Class apiAuthentication{

      private $obj;	

	  private $accessToken;   //授权凭证

	  private $jsapi_ticket;  //用于JSAPI的临时票据

	  private $url;           //用于回调的url

	  private $agentid;       //第三方授权应用的agentid

	  private $nonceStr;      //随机串

	  private $timeStamp;     //时间搓

	  private $corpId;        //授权方企业的corpid

	  private $signature;     //签名秘串

	  public function __construct($obj){
	  		 $this->config = $obj;
	  }	

	  public function setAccessToken($accessToken){
	  	     $this->accessToken = $accessToken;
	  }

	  public function setJsapiTicket($jsapi_ticket){
	  		 $this->jsapi_ticket = $jsapi_ticket;
	  }

	  public function setUrl($url){
	  	     $this->url = $url;
	  }

	  public function setAgentid($agentid){
	  	     $this->agentid = $agentid;
	  }

	  public function setTimeStamp($timestamp){
	  	     $this->timeStamp = $timestamp;
	  }

	  public function setCorpId($corpid){
	  	     $this->corpId = $corpid;
	  }

	  public function setSign($signature){
	  	     $this->signature = $signature;
	  }

	  public function getJsapiTicket(){

            $ticket = $this->config->get("get_jsapi_ticket",['access_token'=>$this->accessToken]);

            return $ticket;
	  }

	  public function getJsapiConfig(){

             $config = ["agentId"=>$this->agentid,
                        "corpId"=>$this->corpId,
                        "timeStamp"=>$this->timeStamp,
                        "nonceStr"=>$this->nonceStr,
                        "signature"=>$this->signature
                        ];
            return $config;            
	  }

      public function sign()
      {
          $plain = 'jsapi_ticket=' . $this->jsapi_ticket .
                   '&noncestr=' . $this->nonceStr .
                   '&timestamp=' . $this->timeStamp .
                   '&url=' . $this->url;
          return sha1($plain);
      }	

}
?>
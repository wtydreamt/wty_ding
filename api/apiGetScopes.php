<?php 
Class apiGetScopes{

	  private $config;
	  public  $scopes;

	  public function __construct($obj,$access_token){
	  		 $this->config = $obj;
	  		 $this->scopes = $this->getScopes($access_token);
	  }

	  private function getScopes($access_token){

	  		 return $scopes = $this->config->get("auth/scopes",['access_token'=>$access_token]);

	  }

}
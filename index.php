<?php
define("PATH", dirname(__FILE__));
require("Autoloader.php");

$config = new Dingconfig;

//第三方应用
$config->setAccessKey("suitecciji3mqh2tkeg3l");
$config->setSuiteSecret("t9WbFDks4voJez3k9Tf8dOVz6kPJslHyzFCU1GX3c2-5NjvW1lngsA2CHLYhyT2O");
$config->setSuiteId("5615003");

$http   = new Http($config);

 //获取第三方企业授权凭证
 $apiGetCorpToken  = new apiGetCorpToken($http);
 $time = time();
 $apiGetCorpToken->timestamp   = $time;
 $apiGetCorpToken->suiteTicket = "k9YJe99N64BaKzImN3sgRraedCZgRj7MVmBeTe4AwJBwr8FZmdMlOzCMcSRYwbApyIoctmFjfqOllA3itNB3Nq";
 $apiGetCorpToken->auth_corpid = "ding6d3a701eb0ad204335c2f4657eb6378f";
 
 $apiGetCorpToken->setSignature();

 $CorpToken = $apiGetCorpToken->getCorpToken();  //获取授权凭证

 
 $AuthInfo  = $apiGetCorpToken->getAuthInfo();   //获取企业授权信息

 print_r($AuthInfo);die;

 $apiGetCorpToken->agentid = $AuthInfo->auth_info->agent[0]->agentid;


 $AgentInfo = $apiGetCorpToken->getAgentInfo();  //获取授权应用信息
 


 $apiGetDepartment = new apiGetDepartment($http);

 $apiGetDepartment->accessToken = $CorpToken->access_token;

 $Scopes = $apiGetDepartment->getScopes();

 $apiGetDepartment->deptInfoData();

 
 $deptInfoData = $apiGetDepartment->deptInfoData();

 

 $apiGetUser = new apiGetUser($http);
 $apiGetUser->setAccessToken($CorpToken->access_token);

 
 $authed_dept =$deptInfoData['authed_dept'];
 
 $user_list = [];

 foreach($authed_dept as $key=>$val){
     $user = $apiGetUser->getListByPage("",$key);
     $user_list[$key] = $user;
 }

 print_r($user_list);die;
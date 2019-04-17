<?php
define("PATH", dirname(__FILE__));
require("Autoloader.php");

$config = new Dingconfig;
//自建应用 
$config->setAppKey("dingugluqrt4pnzmixyy");
$config->setAppSecret("-BVJMvH3Pig8KwPaYVAZEC8Sd56dvqQ3QsTjO1IjWerL14mjm4yAJWBz0eRBp15Q");

//第三方应用
$config->setAccessKey("suitecciji3mqh2tkeg3l");
$config->setSuiteSecret("t9WbFDks4voJez3k9Tf8dOVz6kPJslHyzFCU1GX3c2-5NjvW1lngsA2CHLYhyT2O");
$config->setSuiteId("5615003");
$http   = new Http($config);

$apiGetToken = new apiGetToken($http);
$token = $apiGetToken->getToken();


//获取第三方企业授权凭证
// $apiGetCorpToken  = new apiGetCorpToken($http);
// $time = time();
// $apiGetCorpToken->timestamp   = $time;
// $apiGetCorpToken->suiteTicket = "uc58L8WmFLPxkjuzu35vbBTgsnknsIEIgOLU26XCD2p9uXBJyRLwU8eVcJTqnkRhveqvDxgWzz9W58LyRTOEVD";
// $apiGetCorpToken->auth_corpid = "ding6d3a701eb0ad204335c2f4657eb6378f";
// $apiGetCorpToken->setSignature();

// $CorpToken = $apiGetCorpToken->getCorpToken(); //获取授权凭证

// $AuthInfo  = $apiGetCorpToken->getAuthInfo(); //获取企业授权信息
// $apiGetCorpToken->agentid = $AuthInfo->auth_info->agent[0]->agentid;
// $AgentInfo = $apiGetCorpToken->getAgentInfo();//获取授权应用信息

$apiGetDepartment = new apiGetDepartment($http);

$apiGetDepartment->accessToken = $token->access_token;

$apiGetDepartment->getScopes();
$apiGetDepartment->deptInfoData();

$deptInfoData = $apiGetDepartment->deptInfoData();

$apiGetUser = new apiGetUser($http);

$apiGetUser->accessToken = $token->access_token;

$authed_dept =$deptInfoData['authed_dept'];

foreach($authed_dept as $key=>$val){
    $user = $apiGetUser->getListByPage("",$key);
    print_r($user);die;
}
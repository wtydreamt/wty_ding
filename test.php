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
$apiGetCorpToken->suiteTicket = "uc58L8WmFLPxkjuzu35vbBTgsnknsIEIgOLU26XCD2p9uXBJyRLwU8eVcJTqnkRhveqvDxgWzz9W58LyRTOEVD";
$apiGetCorpToken->auth_corpid = "ding6d3a701eb0ad204335c2f4657eb6378f";
$apiGetCorpToken->setSignature();

$CorpToken = $apiGetCorpToken->getCorpToken(); //获取授权凭证

$AuthInfo  = $apiGetCorpToken->getAuthInfo(); //获取企业授权信息
$agentid   = $AuthInfo->auth_info->agent[0]->agentid;

//配置鉴权信息
// $apiAuthentication = new apiAuthentication($http);
// $apiAuthentication->setAccessToken($CorpToken->access_token);
// $apiAuthentication->setAgentid($agentid);
// $apiAuthentication->setTimeStamp($time);
// $apiAuthentication->setCorpId("ding6d3a701eb0ad204335c2f4657eb6378f");
// $JsapiTicket = $apiAuthentication->getJsapiTicket();
// $apiAuthentication->setJsapiTicket($JsapiTicket->ticket);
// $apiAuthentication->setUrl("http://wty.vaiwan.com/test.php");
// $sign = $apiAuthentication->sign();
// $apiAuthentication->setSign($sign);
// $JsapiConfig = $apiAuthentication->getJsapiConfig();




//回调地址注册
$apiReturn = new apiReturn($http);

$apiReturn->setUrl("http://wty.vaiwan.com/return.php");
$apiReturn->setToken("zheshijiamitoken");
$apiReturn->setAesKey("qwertyuiopasdfghjklzxcvbnm1234567890qwertyu");
$apiReturn->setAccessToken($CorpToken->access_token);
$apiReturn->setCallBackTagOne(['org_change']);
$call_back = $apiReturn->get_call_back();

print_r($call_back);
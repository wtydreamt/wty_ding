<?php
Class apiNotify{

      private $config;        //配置

	  private $accessToken;   //企业授权令牌

	  private $agent_id;      //企业内部应用是应用agentId，第三方企业应用是获取授权信息接口中返回的agentId

	  private $userid_list;   //接收者的用户userid列表，最大列表长度：20      

	  private $dept_id_list;  //接收者的部门id列表，最大列表长度：20,  接收者是部门id下(包括子部门下)的所有用户

	  private $to_all_user;   //是否发送给企业全部用户(ISV不能设置true) 

	  private $msg;           //消息内容，消息类型和样例参考“消息类型与数据格式”。最长不超过2048个字节

	  public function __construct($obj){

	  		 $this->config = $obj;

	  }		

	  public function workMsg(){

	  		 $data = ["agent_id"=>$this->agent_id,
	  		          "msg"     =>$this->msg];

	  		 if($this->userid_list){
	  		    $data['userid_list'] = $this->userid_list;
	  		 }
	  		 if($this->dept_id_list){
	  		    $data['dept_id_list'] = $this->dept_id_list;
	  		 }
	  		 if($this->to_all_user){
	  		    $data['to_all_user'] = $this->to_all_user;
	  		 }

	  		 $this->config->post("topapi/message/corpconversation/asyncsend_v2",['access_token'=>$this->accessToken],$string_data);	  		 
	  }

	  //工作通知消息实体
      public  function MessageData($corpid,$create_user_name,$event_name,$event_user_name,$first_user_name,$end_user_name,$user_object,$event_code,$status,$message_url,$data=""){

                $content_json = array('msgtype' => 'oa',
                	                  "oa" =>array(
                	                  'message_url'=>$message_url,
                	                  'head'=>array('bgcolor'=>'0066CC','text'=>'悦积分'),
                	                  'body'=>array('title'=>$create_user_name . '发起的' . $event_name . '申请'.$status.'，请知晓',
			                	                    'form'=>array(
				                	                  	    array('key'=>'奖扣人：','value'=>$event_user_name),
				                	                  	    array('key'=>'初审人：','value'=>$first_user_name),
				                	                  	    array('key'=>'终审人：','value'=>$end_user_name),
				                	                  	    array('key'=>'奖扣分：','value'=>$event_code)
				                	                           )
	                	                            )
	                	                       )
                	                       );
            	if($data){
            		foreach($data as $key=>$val){
            			if($val['value']){
            				array_push($content_json['oa']['body']['form'],array("key"=>$val['key'],"value"=>$val['value']));
            			}
            		}
            	}

                return $content_json;
      }

      //普通消息实体
	  public  function chatdata($arr){

                $content_json = array('msgtype' => 'oa',
                	                  "oa" =>array(
                	                  'message_url'=>$arr['message_url'],
                	                  'head'=>array('bgcolor'=>'0066CC','text'=>'悦积分'),
                	                  'body'=>array('title'=>$arr['create_user_name'] . '发起的' . $arr['event_name'] . '申请'.$arr['status'].'，请知晓',
			                	              'form'=>array(
				                	          array('key'=>'奖扣人：','value'=>$arr['event_user_name']),
				                	          array('key'=>'初审人：','value'=>$arr['first_user_name']),
				                	          array('key'=>'终审人：','value'=>$arr['end_user_name']),
				                	          array('key'=>'奖扣分：','value'=>$arr['event_code'])
				                	                    )
	                	                            )
	                	                       )
                	                       );
                return $content_json; 

	  } 
}
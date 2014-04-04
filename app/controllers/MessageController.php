<?php

class MessageController extends \BaseController {



	public function getFriendMessages(){
		$email=Input::get('email');
		
		$limit=Input::get('limit');
		$friendId=Input::get('friendId');

		$user=User::where('email',$email)->first();
		return json_encode(array('code'=>1,'message'=>'','details'=>null));
	}

	public function sendMessages(){
		$message=new Message;
		$message->user_id=Input::get('uid');
		$message->friend_id=Input::get('fid');
		$message->content=Input::get('c');
		$message->status='NOT_SEEN';
		#$message->user_id=1;
		#$message->friend_id=2;
		#$message->content='hello';
		#$message->status='NOT_SEEN';
		$message->save();
   		#return json_encode($message);
		return 'sendMessages-->success';
	}

	public function getMessages(){
		$user_id=Input::get('user_id');
		$friend_id=Input::get('friend_id');
		$msgs=Message::where('friend_id',$user_id)->where('user_id',$friend_id)->get()->toJson();
		return $msgs;
	}


}

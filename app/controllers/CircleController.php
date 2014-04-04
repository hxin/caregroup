<?php

class CircleController extends \BaseController {

	public function getMyCircles(){
		$userId=Input::get('user_id');
		$user=User::find($userId);
		$circles=Circle::where('user_id',$user->id)->get()->toJson();
		return json_encode(array('code'=>1,'message'=>'list of circles','details'=>$circles));
		
	}

	public function addCircle(){
		$userId=Input::get('user_id');
		$circleName=Input::get('circle_name');

		$circle = new Circle;
		$circle->name=$circleName;
		$circle->user_id=$userId;
		
		try{
			if($circle->save()){
				$user=User::find($userId);
				$circles=Circle::where('user_id',$user->id)->get()->toJson();
				return json_encode(array('code'=>1,'message'=>'circle added successfully','details'=>$circles));
			}else{
				return json_encode(array('code'=>0,'message'=>'circle already exists','details'=>null));
			}
		}catch(Exception $e){
			return json_encode(array('code'=>0,'message'=>'circle already exists','details'=>null));
		}
	}

	public function updateCircle(){
		$circleId=Input::get('circle_id');
		$circleName=Input::get('circle_name');

		$circle=Circle::find($circleId);
		$circle->name=$circleName;
		$circle->save();
		return json_encode(array('code'=>1,'message'=>'','details'=>null));
	}

	public function invitePersonsToCircle(){
		$circleId=Input::get('circle_id');
		$persons=Input::get('persons');
		foreach ($persons as $person) {
			
		}

		$user=User::where('email',$email)->first();
		return json_encode(array('code'=>1,'message'=>'','details'=>null));
	}

	public function showInvitations(){
		$email=Input::get('email');
		

		$user=User::where('email',$email)->first();
		return json_encode(array('code'=>1,'message'=>'','details'=>null));
	}


	public function acceptInvitation(){
		$email=Input::get('email');
		$invitationId=Input::get('invitation_id');

		$user=User::where('email',$email)->first();
		return json_encode(array('code'=>1,'message'=>'','details'=>null));
	}

	public function rejectInvitation(){
		$email=Input::get('email');
		$pwd=Input::get('pwd');
		$invitationId=Input::get('invitation_id');

		if($email && $pwd){
			$user=User::where('email',$email)->first();
			if($user && $pwd==$user->pwd){
					
					
				}
		}	
		return json_encode(array('code'=>0,'message'=>'login is not valid','details'=>null));
	}

	public function getFriendsOfCircle(){

		$circleId=Input::get('circle_id');

		$user=User::where('email',$email)->first();
		return json_encode(array('code'=>1,'message'=>'','details'=>null));
	}	

}
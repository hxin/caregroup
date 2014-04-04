<?php

class UserController extends \BaseController {

	private function getUserProfile($user){
		$profile['user_id']=$user->id;
		$profile['firstname']=$user->firstname;
		$profile['lastname']=$user->lastname;
		$profile['email']=$user->email;
		return $profile;
	}

	public function getUserInformations(){
		
		$userId=Input::get('user_id');
		if($email){
			$user=User::where('email',$email)->first();
			if($user){
					$profile =$this->getUserProfile($user);
					return json_encode(array('code'=>1,'message'=>'exist','details'=>$profile));
			}
		}	
		return json_encode(array('code'=>0,'message'=>'not exist','details'=>null));
	}

	public function isEmailExist(){
		$email=Input::get('email');
		if($email){
			$user=User::where('email',$email)->first();
			if($user){
					$profile =$this->getUserProfile($user);
					return json_encode(array('code'=>1,'message'=>'exist','details'=>$profile));
			}
		}	
		return json_encode(array('code'=>0,'message'=>'not exist','details'=>null));
	}	

	public function checkLogin(){	
		$email=Input::get('email');
		$pwd=Input::get('pwd');
		if($email && $pwd){
			$user=User::where('email',$email)->first();
			if($user && $pwd==$user->pwd){
					$profile =$this->getUserProfile($user);
					return json_encode(array('code'=>1,'message'=>'login is valid','details'=>$profile));
			}
		}	
		return json_encode(array('code'=>0,'message'=>'login is not valid','details'=>null));
	}	

	public function createAccount(){
		$email=Input::get('email');
		if($email){
			$user=User::where('email',$email)->first();
			if($user){
				return json_encode(array('code'=>0,'message'=>'a user with this email already exist','details'=>null));
			}
		}	
		$user = new User();
		$user->firstname=Input::get('firstname');
		$user->lastname=Input::get('lastname');
		$user->email=Input::get('email');
		$user->pwd=Input::get('pwd');
		

		try{
			if($user->save()){
				$profile =$this->getUserProfile($user);
				return json_encode(array('code'=>1,'message'=>'user add successfully','details'=>$profile));
			}
		}catch(Exception $e){
			return json_encode(array('code'=>10,'message'=>'invalid account information','details'=>null));
		}
		return json_encode(array('code'=>11,'message'=>'unexcpected error','details'=>null));
	}


	public function uploadPicture(){
		$email=Input::get('email');
		$pictureFile=Input::file('picture');
		if($file){
			$picture=File::get($pictureFile);
			$user=User::where('email',$email)->first();
			try{
				$user->picture=$picture;
				$profile =$this->getUserProfile($user);
				$user->save();
				return json_encode(array('code'=>1,'message'=>'picture uploaded successfully','details'=>$profile));
			}catch(Exception $e){
				return json_encode(array('code'=>2,'message'=>'invalid information','details'=>null));
			}
		}
		
	}	

	public function getPicture(){
		$userId=Input::get('user_id');
		$user=User::find($userId)->first();
		return Response::make($user->picture, 200, array('Content-Type' => 'image/jpeg'));
	}
}
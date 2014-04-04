<?php

Route::filter('authentication',function(){
	/*
	$email=Input::get('email');
	$pwd=Input::get('pwd');
	if($email && $pwd){
		$user=User::where('email',$email)->first();
		if(!($user && $pwd==$user->pwd){
			return json_encode(array('code'=>0,'message'=>'login is not valid','details'=>null));
		}
	}else{
		return json_encode(array('code'=>10,'message'=>'please send your credentials','details'=>null));
	}
	*/
	
});

Route::group(array('before' => 'authentication'), function()
{
 	 
});

Route::post('check_login', array('uses'=>'UserController@checkLogin'));
Route::post('upload_picture', array('uses'=>'UserController@uploadPicture'));
Route::post('get_picture', array('uses'=>'UserController@getPicture'));

Route::post('is_email_exists', array('uses'=>'UserController@isEmailExist'));
Route::post('create_account', array('uses'=>'UserController@createAccount'));

Route::post('get_my_circles', array('uses'=>'CircleController@getMyCircles'));
Route::post('add_circle', array('uses'=>'CircleController@addCircle'));
Route::post('invite_persons_to_circle', array('uses'=>'CircleController@invitePersonsToCircle'));

Route::get('sendmsg', array('uses'=>'MessageController@sendMessages'));
Route::get('getmsg', array('uses'=>'MessageController@getMessages'));
/*
Route::post('upload_picture', function()
{
		$user = new User();
		$user->name='picture';
		$user->surname='picture';
		$user->email='picture';
		$user->pwd='picture';
		$pictureFile=Input::file('picture');
		$picture=File::get($pictureFile);
		try{
						$user->picture=$picture;
						$user->save();
						return json_encode(array('code'=>1,'message'=>'picture uploaded successfully','details'=>null));
					}catch(Exception $e){
						return json_encode(array('code'=>2,'message'=>'invalid information','details'=>$e->getMessage()));
					}

	return 'CCDEMO';
});
Route::get('/get_picture', function()
{	
	$email='picturse';
		
		if($email){
			$user=User::where('email',$email)->first();
			if($user){
				// Get the image
				// return response
				return Response::make($user->picture, 200, array('Content-Type' => 'image/jpeg'));
			}
		}
		return json_encode(array('code'=>0,'message'=>'login is not valid','details'=>null));

	return 'CCDEMO';
});
*/
Route::get('/', function()
{
	return 'CCDEMO';
});

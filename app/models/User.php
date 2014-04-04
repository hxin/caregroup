<?php
class User extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	public static $timestamp = true;

	public function circles(){
		$this->hasMany('Circle', 'user_id');
	}

	public function messages(){
		$this->hasMany('Message', 'user_id');
	}

	public function invitations(){
		$this->hasMany('Invitation', 'user_id');
	}

}

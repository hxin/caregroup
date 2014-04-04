<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ccdemo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users', function($table){
			$table->bigIncrements('id');
			$table->string('email', 100)->unique();
			$table->string('pwd',100);
			$table->string('firstname',100);
			$table->string('lastname', 100);
			$table->binary('picture');
			$table->timestamps();
		});

		//
		Schema::create('circles', function($table){
			$table->bigIncrements('id');
			$table->string('name', 100)->unique();
			$table->timestamps();
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');

		});

		//
		Schema::create('user_circle_friends', function($table){
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('friend_id')->unsigned();
			$table->bigInteger('circle_id')->unsigned();
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('friend_id')->references('id')->on('users');
			$table->foreign('circle_id')->references('id')->on('circles');

			$table->primary(array('user_id', 'friend_id'));
		});

		//
		Schema::create('user_circle_invitations', function($table){
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('friend_id')->unsigned();
			$table->bigInteger('circle_id')->unsigned();
			$table->enum('status', array('WAITING','ACCEPTED', 'REJECTED'))->default('WAITING');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('friend_id')->references('id')->on('users');
			$table->foreign('circle_id')->references('id')->on('circles');

			$table->primary(array('user_id', 'friend_id'));
		});

		//
		Schema::create('messages', function($table){
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('friend_id')->unsigned();
			$table->string('content', 100);
			$table->enum('status', array('SEEN', 'NOT_SEEN'))->default('NOT_SEEN');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('friend_id')->references('id')->on('users');

			$table->primary(array('user_id', 'friend_id'));
		});

		//
		Schema::create('location', function($table){
			$table->bigIncrements('id');
			$table->string('name', 100);
			$table->string('address', 100);
			$table->double('lat', 10, 6);
			$table->double('lang', 10, 6);
			$table->timestamps();

			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}

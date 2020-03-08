<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use Illuminate\Http\Request;
use  JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class  AuthController extends  Controller {
	public  $loginAfterSignUp = true;

	public  function  register(Request  $request) {
		$user = new  User();
		$user->name = $request->name;
		$user->surname = $request->surname;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->save();


		if ($this->loginAfterSignUp) {
			return  $this->login($request);
		}

		return  response()->json([
			'status' => 'ok',
			'data' => $user
		], 200);
	}

	public  function  login(Request  $request) {
		$input = $request->only('email', 'password');
		$jwt_token = null;
		if (!$jwt_token = JWTAuth::attempt($input)) {
			return  response()->json([
				'status' => 'invalid_credentials',
				'message' => 'Your email or password are invalid!!!',
			], 401);
		}

		// Set expired for the token is (in minutes) 24 hours
		JWTAuth::factory()->setTTL(1440);

		return  response()->json([
			'status' => 'ok',
			'token' => $jwt_token,
			'expires_in' => auth()->factory()->getTTL() * 60 // time in seconds
		]);
	}

	public  function  logout(Request  $request) {
		$this->validate($request, [
			'token' => 'required'
		]);

		try {
			JWTAuth::invalidate($request->token);
			return  response()->json([
				'status' => 'ok',
				'message' => 'You logout your session successfully'
			]);
		} catch (JWTException  $exception) {
			return  response()->json([
				'status' => 'unknown_error',
				'message' => 'User session could not logout.'
			], 500);
		}
	}

	public  function  getAuthUser(Request  $request) {
		$this->validate($request, [
			'token' => 'required'
		]);

		$user = JWTAuth::authenticate($request->token);
		return  response()->json(['user' => $user]);
	}

}
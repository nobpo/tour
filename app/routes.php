<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('service', 'ServiceController');

Route::get('/', function()
{
	return View::make('index');
});

Route::post('/', function(){
	// $user = array(	'username' => Input::get('username'),
	// 				'password' => Input::get('password') );

	// if(Auth::attempt($user)){
	// 	return Redirect::to('/')->with('notify', 'เข้าสู่ระบบสำเร็จ');
	// }

	// return Redirect::to('/')->with('notify', 'เข้าสุ่ระบบไม่สำเร็จ');
	$condition = array();
	for ($i=1; $i <= 12; $i++) {
		if(Input::get('add'.$i)) 
			array_push($condition, $i);
	}

	if(Input::get('province') == 0 && Input::get('district') == 0){
	 	$data_temp = DB::table('tourrist_attrac')->get();
			$data = array();
			foreach ($data_temp as $key) {
				$check = 1;

				for($i = 0; $i < sizeof($condition); $i++){
					$temp = DB::table('has')->where('Tour_attr_id', $key->Tour_attr_id)->where('Add_id', $condition[$i])->get();
					if(sizeof($temp) == 0) {						
						$check = 0;
						break;
					}
				}
				if($check == 1) array_push($data, $key);

			}
			if(empty($data)) return View::make('search')->with('notify', 'ไม่พบข้อมูล');


	 	return View::make('search')->with('data', $data);
	}else {
		if(Input::get('district') == 0){
			$district = DB::table('district')->where('Province_id', Input::get('province'))->lists('District_id');
			$tour_id = DB::table('in_district')->whereIn('District_id', $district)->lists('Tour_attr_id');
			if(empty($tour_id)) return View::make('search')->with('notify', 'ไม่พบข้อมูล');
			$data_temp = DB::table('tourrist_attrac')->whereIn('Tour_attr_id', $tour_id)->get();
			$data = array();
			foreach ($data_temp as $key) {
				$check = 1;

				for($i = 0; $i < sizeof($condition); $i++){
					$temp = DB::table('has')->where('Tour_attr_id', $key->Tour_attr_id)->where('Add_id', $condition[$i])->get();
					if(sizeof($temp) == 0) {						
						$check = 0;
						break;
					}
				}
				if($check == 1) array_push($data, $key);

			}
			if(empty($data)) return View::make('search')->with('notify', 'ไม่พบข้อมูล');

			return View::make('search')->with('data', $data);
		} else {
			$tour_id = DB::table('in_district')->where('District_id', Input::get('district'))->lists('Tour_attr_id');
			if(empty($tour_id)) return View::make('search')->with('notify', 'ไม่พบข้อมูล');
			$data_temp = DB::table('tourrist_attrac')->whereIn('Tour_attr_id', $tour_id)->get();
			$data = array();
			foreach ($data_temp as $key) {
				$check = 1;

				for($i = 0; $i < sizeof($condition); $i++){
					$temp = DB::table('has')->where('Tour_attr_id', $key->Tour_attr_id)->where('Add_id', $condition[$i])->get();
					if(sizeof($temp) == 0) {						
						$check = 0;
						break;
					}
				}
				if($check == 1) array_push($data, $key);

			}
			if(empty($data)) return View::make('search')->with('notify', 'ไม่พบข้อมูล');

			return View::make('search')->with('data', $data);
		}
	}
});

Route::get('/tour/{id}', function($id){
	$tour = DB::table('tourrist_attrac')->where('Tour_attr_id', $id)->get();
	return View::make('tour_detail')->with('tour', $tour);
});

Route::controller('/tour/{id}/rate', 'RateController');

Route::get('/reg', function()
{
	return View::make('reg');
});

Route::post('/reg', function()
{
	$rules = array(
		"name_first" => "required",
		"name_last" => "required",
		"email" => "required|email",
		"username" => "required",
		"password" => "required|same:password_confirm");

	$validation = Validator::make(Input::all(), $rules);

	if($validation->fails()){
		return Redirect::to('/reg')->withErrors($validation)->withInput();
	}

	$user = new User;
	$user->name_first = Input::get('name_first');
	$user->name_last = Input::get('name_last');
	$user->email = Input::get('email');
	$user->username = Input::get('username');
	$user->password = Hash::make(Input::get('password'));

	if($user->save()) return Redirect::to('/')->with('notify', 'ลงทะเบียนสำเร็จแล้ว');

	return Redirect::to('/')->with('notify', 'Error');
});

Route::get('/login', function(){
	if(Auth::check()) return Redirect::to('/')->with('notify', 'ท่านได้เข้าสู่ระบบแล้ว');
	return View::make('login');
});

Route::post('/login', function(){
	$user = array(	'username' => Input::get('username'),
					'password' => Input::get('password') );

	if(Auth::attempt($user)){
		return Redirect::to('/')->with('notify', 'เข้าสู่ระบบสำเร็จ');
	}

	return Redirect::to('/login')->with('notify', 'เข้าสุ่ระบบไม่สำเร็จ');
});

Route::get('/logout', function(){
	Auth::logout();
	return Redirect::to('/')->with('notify', 'ออกจากระบบ');
});


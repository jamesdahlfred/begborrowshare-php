<?php

class AccountController extends \BaseController {

	/**
	 * GET /resource
	 * Display a listing of the resource.	 
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check()) {
			$results = DB::select('SELECT * FROM guests ORDER BY username');
			return Response::json($results);
		}
	}

	/**
	 * GET /resource/create
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Auth::check()) {
			return Response::json();
		}
	}

	/**
	 * POST /resource
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$account = new Account;

    $account->name = Input::get('name');
    $account->privileges = json_encode(Input::get('privileges'));
    $account->username = Input::get('username');
		$account->password = Hash::make(Input::get('password'));
    $account->email = Input::get('email');
    $account->last_ip = $_SERVER['REMOTE_ADDR'];
 
    if(!$account->save())
    {
      return Response::json($account->errors()->all(), 500);
    } else {
     	return Response::json();
   	}
	}

	/**
	 * GET /resource/{resource}
	 * Display the specified resource.
	 *
	 * @param  string  $code
	 * @return Response
	 */
	public function show($code)
	{
		$results = DB::select('SELECT code, CONCAT(attending, emotion) AS attending, allow_plusone, allow_children, guest, plusone, children, email, phone, address, appetizer, note FROM guests WHERE code = ?', array(mb_strtoupper($code)));
		if (count($results) > 0) {
			foreach ($results as $i => $j) {
				foreach ($j as $k => $val) {
					if ((substr($val, 0, 1) == '{' && substr($val, -1, 1) == '}') || (substr($val, 0, 1) == '[' && substr($val, -1, 1) == ']')) {
						$results[$i]->$k = json_decode($val);
					}
				}
			}
			return Response::json($results);
		} else {
			return Response::json(array('text' => 'That code isn\'t valid. Try again?'), 500);
		}
	}

	/**
	 * GET /resource/{resource}/edit
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$results = DB::select('SELECT * FROM guests WHERE code = ?', array($id));
		return Response::json($results);
	}

	/**
	 * PUT/PATCH /resource/{resource}
	 * Update the specified resource in storage.
	 *
	 * @param  string  $code
	 * @return Response
	 */
	public function update($code)
	{
		DB::update('UPDATE guests SET responded = ?, attending = ?, emotion = ?, guest = ?, plusone = ?, children = ?, email = ?, address = ?, phone = ?, appetizer = ?, note = ?, updated_at = ? WHERE code = ?', array(
			'1',
			substr(Input::get('attending'),0,1),
			substr(Input::get('attending'),1),
      json_encode(Input::get('guest')),
			json_encode(Input::get('plusone')),
			Input::get('children'),
			Input::get('email'),
			Input::get('address'),
			Input::get('phone'),
			Input::get('appetizer'),
			Input::get('note'),
			new DateTime,
			$code
		));
		return Response::json(array('text' => 'Response saved!'));
	}

	/**
	 * DELETE /resource/{resource}
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		DB::delete('DELETE FROM guests WHERE code = ?', array($id));
		return Response::json();
	}

}
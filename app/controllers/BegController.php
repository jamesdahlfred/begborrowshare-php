<?php

class BegController extends \BaseController {

/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($query = null)
	{
		$results = DB::table('begs')->select('id', 'title', 'description')->where('title', 'LIKE', '%' . $query . '%')->take('100')->get();
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function latest()
	{
		$results = DB::table('begs')->select('id', 'beggar', 'title', 'categories', 'description', 'created_at')->orderBy('created_at', 'desc')->take('100')->get();
		for ($i = 0; $i < count($results); $i++) {
			$results[$i]->beggar = Account::find($results[$i]->beggar);
		}
		return Response::json($results);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

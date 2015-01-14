<?php

class SearchController extends \BaseController {

	/**
	 * Get the top 100 for popular words from titles, descriptions & tags. Slow query, only use for pre-fetch.
	 *
	 * @return Response
	 */
	public function index($query = null)
	{
		$results = DB::table('things')->select('title')->take('100')->get();
		$datums = array();
		foreach ($results as $i => $j) {
			$datums[] = array(
				'val' => $j->title
			);
		}
		return Response::json($datums);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  string  $query
	 * @return Response
	 */
	public function show($query = null)
	{
		$begs = DB::table('begs')->select('id', 'title', 'description')->where('title', 'LIKE', '%' . $query . '%')->take('100')->get();
		$shares = DB::table('shares')->select('id', 'title', 'description')->where('title', 'LIKE', '%' . $query . '%')->take('100')->get();
		$things = DB::table('things')->select('id', 'title', 'description')->where('title', 'LIKE', '%' . $query . '%')->take('100')->get();

		foreach ($begs as &$value) {
		    $value->type = 'beg';
		}
		foreach ($shares as &$value) {
		    $value->type = 'borrow';
		}
		foreach ($things as &$value) {
		    $value->type = 'thing';
		}

		$results = array_merge($things, $begs, $shares);
		// $results = sort($results);
		$datums = array();
		foreach ($results as $i => $j) {
			$datums[] = array(
				'id'   				=> $j->id,
				'val'  				=> $j->title,
				'description' => $j->description,
				'type' 				=> $j->type
			);
		}
		return Response::json($datums);
	}

}

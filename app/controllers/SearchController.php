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
		$results = DB::table('things')->select('title', 'id')->where('title', 'LIKE', '%' . $query . '%')->take('10')->get();
		$datums = array();
		foreach ($results as $i => $j) {
			$datums[] = array(
				'val'  => $j->title,
				'id'   => $j->id,
				'type' => 'thing'
			);
		}
		return Response::json($datums);
	}

}

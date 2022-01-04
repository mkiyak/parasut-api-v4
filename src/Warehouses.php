<?php
namespace Parasut\API;

class Warehouses
{
	public $connector;

	/**
	 * Contacts constructor.
	 * @param Authorization $connector
	 */
	public function __construct(Authorization $connector)
	{
		$this->connector = $connector;
	}

	/**
	 * @param int $page
	 * @param int $size
	 * @return array|\stdClass
	 */
	public function list_warehouses($page = 1, $size = 25)
	{
		return $this->connector->request(
			"warehouses?page[number]=$page&page[size]=$size",
			[],
			"GET"
		);
	}

	/**
	 * Contact total count
	 * @return integer
	 */
	public function count_warehouses()
	{
		return $this->connector->request(
			"warehouses?page[number]=1&page[size]=2",
			[],
			"GET"
		)->result->meta->total_count;
	}

	/**
	 * Show warehouses
	 * @param $warehouses_id
	 * @return array|\stdClass
	 */
	public function show($warehouses_id)
	{
		return $this->connector->request(
			"warehouses/$warehouses_id",
			[],
			"GET"
		);
	}

	/**
	 * Search warehouses with params
	 * @param array $data
	 * @return array|\stdClass
	 */
	public function search($data = [])
	{
		$filter = null;
		foreach ($data as $key => $value)
		{
			if (end($data) == $value)
				$filter .= "filter[$key]=".urlencode($value);
			else
				$filter .= "filter[$key]=".urlencode($value)."&";
		}

		return $this->connector->request(
			"warehouses?$filter",
			[],
			"GET"
		);
	}

	/**
	 * Create warehouses
	 * @param $data
	 * @return array|\stdClass
	 */
	public function create($data)
	{
		return $this->connector->request(
			"warehouses",
			$data,
			"POST"
		);
	}

	/**
	 * Edit warehouses
	 * @param $warehouses_id
	 * @param array $data
	 * @return array|\stdClass
	 */
	public function edit($warehouses_id , $data = [])
	{
		return $this->connector->request(
			"warehouses/$warehouses_id",
			$data,
			"PUT"
		);
	}

	/**
	 * Delete warehouses
	 * @param $warehouses_id
	 * @return array|\stdClass
	 */
	public function delete($warehouses_id)
	{
		return $this->connector->request(
			"warehouses/$warehouses_id",
			[],
			"DELETE"
		);
	}
}

<?php
namespace Parasut\API;

class Categories
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
	public function list_categories($page = 1, $size = 25)
	{
		return $this->connector->request(
			"item_categories?page[number]=$page&page[size]=$size",
			[],
			"GET"
		);
	}

	/**
	 * Contact total count
	 * @return integer
	 */
	public function count_categorys()
	{
		return $this->connector->request(
			"item_categories?page[number]=1&page[size]=2",
			[],
			"GET"
		)->result->meta->total_count;
	}

	/**
	 * Show category
	 * @param $category_id
	 * @return array|\stdClass
	 */
	public function show($category_id)
	{
		return $this->connector->request(
			"item_categories/$category_id",
			[],
			"GET"
		);
	}

	/**
	 * Search category with params
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
			"item_categories?$filter",
			[],
			"GET"
		);
	}

	/**
	 * Create category
	 * @param $data
	 * @return array|\stdClass
	 */
	public function create($data)
	{
		return $this->connector->request(
			"item_categories",
			$data,
			"POST"
		);
	}

	/**
	 * Edit category
	 * @param $category_id
	 * @param array $data
	 * @return array|\stdClass
	 */
	public function edit($category_id , $data = [])
	{
		return $this->connector->request(
			"item_categories/$category_id",
			$data,
			"PUT"
		);
	}

	/**
	 * Delete category
	 * @param $category_id
	 * @return array|\stdClass
	 */
	public function delete($category_id)
	{
		return $this->connector->request(
			"item_categories/$category_id",
			[],
			"DELETE"
		);
	}
}

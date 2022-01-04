<?php
namespace Parasut\API;

class Tags
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
	public function list_tags($page = 1, $size = 25)
	{
		return $this->connector->request(
			"tags?page[number]=$page&page[size]=$size",
			[],
			"GET"
		);
	}

	/**
	 * Contact total count
	 * @return integer
	 */
	public function count_tags()
	{
		return $this->connector->request(
			"tags?page[number]=1&page[size]=2",
			[],
			"GET"
		)->result->meta->total_count;
	}

	/**
	 * Show tag
	 * @param $tag_id
	 * @return array|\stdClass
	 */
	public function show($tag_id)
	{
		return $this->connector->request(
			"tags/$tag_id",
			[],
			"GET"
		);
	}
	/**
	 * Create tag
	 * @param $data
	 * @return array|\stdClass
	 */
	public function create($data)
	{
		return $this->connector->request(
			"tags",
			$data,
			"POST"
		);
	}

	/**
	 * Edit tag
	 * @param $tag_id
	 * @param array $data
	 * @return array|\stdClass
	 */
	public function edit($tag_id , $data = [])
	{
		return $this->connector->request(
			"tags/$tag_id",
			$data,
			"PUT"
		);
	}

	/**
	 * Delete tag
	 * @param $tag_id
	 * @return array|\stdClass
	 */
	public function delete($tag_id)
	{
		return $this->connector->request(
			"tags/$tag_id",
			[],
			"DELETE"
		);
	}
}

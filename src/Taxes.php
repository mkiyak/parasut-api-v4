<?php
namespace Parasut\API;

class Taxes
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
	public function list_taxes($page = 1, $size = 25)
	{
		return $this->connector->request(
			"taxes?page[number]=$page&page[size]=$size",
			[],
			"GET"
		);
	}

	/**
	 * Contact total count
	 * @return integer
	 */
	public function count_taxes()
	{
		return $this->connector->request(
			"taxes?page[number]=1&page[size]=2",
			[],
			"GET"
		)->result->meta->total_count;
	}

	/**
	 * Show taxes
	 * @param $taxes_id
	 * @return array|\stdClass
	 */
	public function show($taxes_id)
	{
		return $this->connector->request(
			"taxes/$taxes_id",
			[],
			"GET"
		);
	}

	/**
	 * Search taxes with params
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
			"taxes?$filter",
			[],
			"GET"
		);
	}

	/**
	 * Create taxes
	 * @param $data
	 * @return array|\stdClass
	 */
	public function create($data)
	{
		return $this->connector->request(
			"taxes",
			$data,
			"POST"
		);
	}

	/**
	 * Edit taxes
	 * @param $taxes_id
	 * @param array $data
	 * @return array|\stdClass
	 */
	public function edit($taxes_id , $data = [])
	{
		return $this->connector->request(
			"taxes/$taxes_id",
			$data,
			"PUT"
		);
	}

	/**
	 * Delete taxes
	 * @param $taxes_id
	 * @return array|\stdClass
	 */
	public function delete($taxes_id)
	{
		return $this->connector->request(
			"taxes/$taxes_id",
			[],
			"DELETE"
		);
	}

    /**
     * @param $taxes_id
     * @param $data
     * @return array|\stdClass
     */
    public function pay($taxes_id, $data)
    {
        return $this->connector->request(
            "taxes/$taxes_id/payments",
            $data,
            'POST'
        );
    }
}

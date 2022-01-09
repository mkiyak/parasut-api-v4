<?php
namespace Parasut\API;

class Salaries
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
	public function list_salaries($page = 1, $size = 25)
	{
		return $this->connector->request(
			"salaries?page[number]=$page&page[size]=$size",
			[],
			"GET"
		);
	}

	/**
	 * Contact total count
	 * @return integer
	 */
	public function count_salaries()
	{
		return $this->connector->request(
			"salaries?page[number]=1&page[size]=2",
			[],
			"GET"
		)->result->meta->total_count;
	}

	/**
	 * Show salaries
	 * @param $salary_id
	 * @return array|\stdClass
	 */
	public function show($salary_id)
	{
		return $this->connector->request(
			"salaries/$salary_id",
			[],
			"GET"
		);
	}

	/**
	 * Search salaries with params
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
			"salaries?$filter",
			[],
			"GET"
		);
	}

	/**
	 * Create salaries
	 * @param $data
	 * @return array|\stdClass
	 */
	public function create($data)
	{
		return $this->connector->request(
			"salaries",
			$data,
			"POST"
		);
	}

	/**
	 * Edit salaries
	 * @param $salary_id
	 * @param array $data
	 * @return array|\stdClass
	 */
	public function edit($salary_id , $data = [])
	{
		return $this->connector->request(
			"salaries/$salary_id",
			$data,
			"PUT"
		);
	}

	/**
	 * Delete salaries
	 * @param $salary_id
	 * @return array|\stdClass
	 */
	public function delete($salary_id)
	{
		return $this->connector->request(
			"salaries/$salary_id",
			[],
			"DELETE"
		);
	}

    /**
     * @param $salary_id
     * @param $data
     * @return array|\stdClass
     */
    public function pay($salary_id, $data)
    {
        return $this->connector->request(
            "salaries/$salary_id/payments",
            $data,
            'POST'
        );
    }
}

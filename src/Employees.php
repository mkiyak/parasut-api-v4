<?php
namespace Parasut\API;

class Employees
{
	public $connector;

	/**
	 * Employeess constructor.
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
	public function list_employees($page = 1, $size = 25)
	{
		return $this->connector->request(
			"employees?page[number]=$page&page[size]=$size",
			[],
			"GET"
		);
	}

	/**
	 * Employees total count
	 * @return integer
	 */
	public function count_employees()
	{
		return $this->connector->request(
			"employees?page[number]=1&page[size]=2",
			[],
			"GET"
		)->result->meta->total_count;
	}

	/**
	 * Show employee
	 * @param $employee_id
	 * @return array|\stdClass
	 */
	public function show($employee_id)
	{
		return $this->connector->request(
			"employees/$employee_id",
			[],
			"GET"
		);
	}

	/**
	 * Search employee with params
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
			"employees?$filter",
			[],
			"GET"
		);
	}

	/**
	 * Create employee
	 * @param $data
	 * @return array|\stdClass
	 */
	public function create($data)
	{
		return $this->connector->request(
			"employees",
			$data,
			"POST"
		);
	}

	/**
	 * Edit employee
	 * @param $employee_id
	 * @param array $data
	 * @return array|\stdClass
	 */
	public function edit($employee_id , $data = [])
	{
		return $this->connector->request(
			"employees/$employee_id",
			$data,
			"PUT"
		);
	}

	/**
	 * Delete employee
	 * @param $employee_id
	 * @return array|\stdClass
	 */
	public function delete($employee_id)
	{
		return $this->connector->request(
			"employees/$employee_id",
			[],
			"DELETE"
		);
	}
}

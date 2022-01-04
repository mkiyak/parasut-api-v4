<?php
namespace Parasut\API;

class StockMovements
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
	public function list_stockMovements($page = 1, $size = 25)
	{
		return $this->connector->request(
			"stock_movements?page[number]=$page&page[size]=$size",
			[],
			"GET"
		);
	}
}

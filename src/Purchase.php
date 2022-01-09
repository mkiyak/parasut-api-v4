<?php
namespace Parasut\API;

class Purchase
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
	public function list_purchase($page = 1, $size = 25)
	{
		return $this->connector->request(
			"purchase_bills?page[number]=$page&page[size]=$size",
			[],
			"GET"
		);
	}

	/**
	 * Contact total count
	 * @return integer
	 */
	public function count_purchase()
	{
		return $this->connector->request(
			"purchase_bills?page[number]=1&page[size]=2",
			[],
			"GET"
		)->result->meta->total_count;
	}

	/**
	 * Show purchase
	 * @param $purchase_id
	 * @return array|\stdClass
	 */
	public function show($purchase_id)
	{
		return $this->connector->request(
			"purchase_bills/$purchase_id",
			[],
			"GET"
		);
	}

	/**
	 * Search purchase with params
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
			"purchase_bills?$filter",
			[],
			"GET"
		);
	}

	/**
	 * Create purchase
	 * @param $data
	 * @return array|\stdClass
	 */
	public function create($data, $detail = "")
	{
		return $this->connector->request(
			"purchase_bills$detail",
			$data,
			"POST"
		);
	}

	/**
	 * Edit purchase
	 * @param $purchase_id
	 * @param array $data
	 * @return array|\stdClass
	 */
	public function edit($purchase_id , $data = [], $detail = "")
	{
		return $this->connector->request(
			"purchase_bills/$purchase_id.$detail",
			$data,
			"PUT"
		);
	}

	/**
	 * Delete purchase
	 * @param $purchase_id
	 * @return array|\stdClass
	 */
	public function delete($purchase_id)
	{
		return $this->connector->request(
			"purchase_bills/$purchase_id",
			[],
			"DELETE"
		);
	}

    /**
     * @param $purchase_id
     * @return array|\stdClass
     */
    public function cancel($purchase_id)
    {
        return $this->connector->request(
            "purchase_bills/$purchase_id/cancel",
            [],
            'DELETE'
        );
    }

    /**
     * @param $purchase_id
     * @param $data
     * @return array|\stdClass
     */
    public function pay($purchase_id, $data)
    {
        return $this->connector->request(
            "purchase_bills/$purchase_id/payments",
            $data,
            'POST'
        );
    }
}

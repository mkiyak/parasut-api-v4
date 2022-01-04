<?php
try {
    $parasutAuthorization = new \Parasut\API\Authorization([
        "development" => true, //development mode
        "client_id" => "YOUR_CLIENT_ID",
        "client_secret" => "YOUR_CLIENT_SECRET",
        "username" => "YOUR_EMAIL",
        "password" => "YOUR_PASSWORD",
        "redirect_uri" => "urn:ietf:wg:oauth:2.0:oob",
        "company_id" => "YOUR_COMPANY_ID"
    ]);
} catch (\Parasut\API\Exception $e) {
    echo "Error code : " . $e->getCode()."<br>";
    echo "Error message : " . $e->getMessage();
    die;
}

$warehouses = new \Parasut\API\Warehouses($parasutAuthorization);

//warehouses list
$warehousesList = $warehouses->list_warehouses();
//warehouses list

//show warehouses
$warehouses_id = 123456; //integer
$showWarehouses = $warehouses->show($warehouses_id);
//show warehouses

//search warehouses
$searchWarehousesData1 = [
	"name" => "XXXX"
];

$searchWarehousesData2 = [
	"name" => "XXXX",
	"archived" => "XXXX"
];

$searchWarehouses1 = $warehouses->search($searchWarehousesData1);
$searchWarehouses2 = $warehouses->search($searchWarehousesData2);
//search warehouses

//create warehouses
$createWarehousesData = [
	"data" => [
		"type" => "warehouses",
		"attributes" => [
			"name" => "XXXX", //*required // Depo Adı
			"address" => "XXXX", // Adres
			"city" => "XXX", // İl
			"district" => "XXX", // İlçe
            "is_abroad" => true, // Yurt dışında
            "archived" => true, // Arşivlenme durumu
		]
	]
];
$createWarehouses = $warehouses->create($createWarehousesData);
//create warehouses

//edit warehouses
$warehouses_id = 123456; //integer
$editWarehousesData = [
	"data" => [
		"type" => "warehouses",
		"attributes" => [
            "name" => "XXXX", //*required // Depo Adı
            "address" => "XXXX", // Adres
            "city" => "XXX", // İl
            "district" => "XXX", // İlçe
            "is_abroad" => true, // Yurt dışında
            "archived" => true, // Arşivlenme durumu
		]
	]
];
$editWarehouses = $warehouses->edit($warehouses_id, $editWarehousesData);
//edit warehouses

//delete warehouses
$warehouses_id = 123456; //integer
$deleteWarehouses = $warehouses->delete($warehouses_id);
//delete warehouses


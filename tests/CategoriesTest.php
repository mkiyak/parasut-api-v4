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

$categories = new \Parasut\API\Categories($parasutAuthorization);

//category list
$categoryList = $categories->list_categories();
//category list

//show category
$category_id = 123456; //integer
$showCategory = $categories->show($category_id);
//show category

//search category
$searchCategoryData1 = [
	"name" => "XXXX"
];

$searchCategoryData2 = [
	"name" => "XXXX",
	"category_type" => "XXXX"
];

$searchCategory1 = $categories->search($searchCategoryData1);
$searchCategory2 = $categories->search($searchCategoryData2);
//search category

//create category
$createCategoryData = [
	"data" => [
		"type" => "item_categories",
		"attributes" => [
			"name" => "XXXX", //*required // Kategori Adı
			"bg_color" => "XXXX", // Arka plan rengi
			"text_color" => "person", // Yazı rengi
			"category_type" => "XXX", // Kategori Tipi
			"parent_id" => 0,
		]
	]
];
$createCategory = $categories->create($createCategoryData);
//create category

//edit category
$category_id = 123456; //integer
$editCategoryData = [
	"data" => [
		"type" => "item_categories",
		"attributes" => [
            "name" => "XXXX", //*required // Kategori Adı
            "bg_color" => "XXXX", // Arka plan rengi
            "text_color" => "person", // Yazı rengi
            "category_type" => "XXX", // Kategori Tipi
            "parent_id" => 0,
		]
	]
];
$editCategory = $categories->edit($category_id, $editCategoryData);
//edit category

//delete category
$category_id = 123456; //integer
$deleteCategory = $categories->delete($category_id);
//delete category


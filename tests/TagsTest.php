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

$tags = new \Parasut\API\Categories($parasutAuthorization);

//tag list
$tagList = $tags->list_tags();
//tag list

//show tag
$tag_id = 123456; //integer
$showTag = $tags->show($tag_id);
//show tag

//create tag
$createTagData = [
	"data" => [
		"type" => "tags",
		"attributes" => [
			"name" => "XXXX", //*required // Kategori Adı
			"bg_color" => "XXXX", // Arka plan rengi
			"text_color" => "person", // Yazı rengi
			"tag_type" => "XXX", // Kategori Tipi
			"parent_id" => 0,
		]
	]
];
$createTag = $tags->create($createTagData);
//create tag

//edit tag
$tag_id = 123456; //integer
$editTagData = [
	"data" => [
		"type" => "tags",
		"attributes" => [
            "name" => "XXXX", //*required // Kategori Adı
            "bg_color" => "XXXX", // Arka plan rengi
            "text_color" => "person", // Yazı rengi
            "tag_type" => "XXX", // Kategori Tipi
            "parent_id" => 0,
		]
	]
];
$editTag = $tags->edit($tag_id, $editTagData);
//edit tag

//delete tag
$tag_id = 123456; //integer
$deleteTag = $tags->delete($tag_id);
//delete tag


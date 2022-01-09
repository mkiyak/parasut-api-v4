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
// # Fatura İşlemleri
$taxes = new \Parasut\API\Taxes($parasutAuthorization);

// Vergi listesi
$taxesList = $taxes->list_taxes();

// Vergi görüntüleme
$taxes_id = 123456; //integer
$showtaxes = $taxes->show($taxes_id);

// Vergi arama
$searchtaxesData1 = [
    "taxes_id" => 12345
];

$searchtaxesData2 = [
    "issue_date" => "XXXX",
    "due_date" => "XXXX",
    "currency" => 'TRL', //döviz tipi // TRL, USD, EUR, GBP
    "remaining" => 4525,
];
$searchtaxes1 = $taxes->search($searchtaxesData1);
$searchtaxes2 = $taxes->search($searchtaxesData2);

// Vergi oluşturma
$createtaxesData = [
    "data" => [
        "type" => "taxes",
        "attributes" => [
            "description" => "string", //*required // Açıklama
            "issue_date" => "2022-01-09", //*required
            "due_date" => "2022-01-09", //*required
            "net_total" => 0, //*required
        ]
    ]
];
$createtaxes = $taxes->create($createtaxesData);

// Vergi düzenleme
$edittaxesData = [
    "data" => [
        "type" => "taxes",
        "attributes" => [
            "description" => "string", //*required // Açıklama
            "issue_date" => "2022-01-09", //*required
            "due_date" => "2022-01-09", //*required
            "net_total" => 0, //*required
        ]
    ]
];

$taxes_id = 123456;
$edittaxes = $taxes->edit($taxes_id, $edittaxesData);

// Vergi silme
$taxes_id = 123456;
$deletetaxes = $taxes->delete($taxes_id);

//pay Tax
$taxes_id = 123456;
$paySalaryData = [
    "data" => [
        "type" => "payments",
        "attributes" => [
            "description" => "string", // Açıklama
            "account_id" => 1234, // Kasa veya Banka id
            "date" => "YYYY-MM-DD", //ödeme tarihi
            "amount" => 123, //ödeme tutarı
            "exchange_rate" => 0
        ]
    ]
];
$taxes->pay($taxes_id, $paySalaryData);
//pay Tax